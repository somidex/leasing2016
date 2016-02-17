<?php

namespace Leasing\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Leasing\CoreBundle\APIutils\GlobeLabs\GlobeClient;
use Leasing\CoreBundle\APIutils\VerifyEmail\VerifyEmail;

//Models
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventInquiries;
use Leasing\CoreBundle\Model\LeasingDocument;
use Leasing\CoreBundle\Model\LeasingLeadDocument;
use Leasing\CoreBundle\Model\LeasingBadges;
use Leasing\CoreBundle\Model\LeasingLeadBadges;
use Leasing\CoreBundle\Model\LeasingTimelineActivity;

//Peers
use Leasing\CoreBundle\Model\LeasingEventPlacePeer;

//Utilities
use Leasing\CoreBundle\Utilities\Constant as C;
use Leasing\CoreBundle\Utilities\Utility as U;

class EventController extends Controller
{
	private $globeShortCode = '21587158';
    private $otherShortCode = '29290587158';
    private $appId = 'go7GIr57b7u7oi5dkec7oKudpoMGIe6b';
    private $appSecret = '93c19eb1666c6db1dbaf3d93b497fa609145b963df4708e05fad6fc5c92e89db';

    public function saveEventBookingAction()
    {
    	$request = $this->getRequest();

        $directory = $request->server->get('DOCUMENT_ROOT').'/secured/uploads/events/';
        $files = $request->files->get('documents');

        $salutation = $request->request->get('salutation');
        $fname = $request->request->get('fname');
        $lname = $request->request->get('lname');
        $gender = $request->request->get('gender');
        $age = $request->request->get('age');
        $email = $request->request->get('email');
        $mobile = $request->request->get('mobile');

        $tmpbdate = $request->request->get('bdate');
        $bdate = new \DateTime($tmpbdate);

        $tmpEventDate = $request->request->get('eventDate');
        $eventDate = new \DateTime($tmpEventDate);

        $eventTimeFrom = $request->request->get('eventTimeFrom');
        $eventTimeTo = $request->request->get('eventTimeTo');
        $eventPostId = $request->request->get('postId');
        $eventSpecific = $request->request->get('eventSpecific');
        $firstHeard = $request->request->get('firstHeard');

        $date = new \DateTime('now');

        $eventPlace = LeasingEventPlacePeer::getEventPlaceByPostId($eventPostId);

        $eventLead = new LeasingEventLeads();
        $eventLead->setFname($fname);
        $eventLead->setLname($lname);
        $eventLead->setBirthdate($bdate->format('Y-m-d'));
        $eventLead->setAge($age);
        $eventLead->setGender($gender);
        $eventLead->setMobile($mobile);
        $eventLead->setEmail($email);
        $eventLead->setEventLeadType(1);
        $eventLead->save();

        $eventBooking = new LeasingEventBookings();
        $eventBooking->setEventPlaceId($eventPlace->getId());
        $eventBooking->setEventPlaceSpecific($eventSpecific);
        $eventBooking->setEventLeadsId($eventLead->getId());
        $eventBooking->setEventDate($eventDate->format('Y-m-d'));
        $eventBooking->setEventStartTime($eventTimeFrom);
        $eventBooking->setEventEndTime($eventTimeTo);
        $eventBooking->setDateAdded($date->format(C::DATETIMEFORMAT));
        $eventBooking->setFirstHeard($firstHeard);
        $eventBooking->setStatus(C::PENDING);
        $eventBooking->setPrevStatus(C::PENDING);
        $eventBooking->save();

        $code = 'EV'.U::generateCode(5, $eventBooking->getId());
        $eventBooking->setApplicationNumber($code);
        $eventBooking->save();

        $tl1 = new LeasingTimelineActivity();
        $tl1->setLeadTypeId(C::EVENT);
        $tl1->setLeadId($eventBooking->getId());
        $tl1->setUser('Lead');
        $tl1->setActivity('Requested for Event Space Rental');
        $tl1->setTimestamp($date->format(C::DATETIMEFORMAT));
        $tl1->setStatus('Pending');
        $tl1->setStatusId(C::PENDING);
        $tl1->save();

        foreach ($files as $file) {
            $tmp = $file->getPathName();
            $fileName = $eventBooking->getId().'_'.$eventLead->getLname().'_'.$eventBooking->getApplicationNumber().'_'.$file->getClientOriginalName();
            $target = $directory.$fileName;

            if (move_uploaded_file($tmp, $target)) {
                $doc = new LeasingDocument();
                $doc->setDocument($fileName);
                $doc->save();

                $ld = new LeasingLeadDocument();
                $ld->setLeadId($eventBooking->getId());
                $ld->setDocumentId($doc->getId());
                $ld->setLeadTypeId(C::EVENT);
                $ld->save();
            } else {
                echo -2;
                exit;
            }
        }

        $this->get('session')->set('thank-you', 1);

        $client = new GlobeClient();

        $msg = "Thank you, ".$eventLead->getFname()." ".$eventLead->getLname()."! Your application reference number (ARN) is ".$eventBooking->getApplicationNumber().". We will update you ASAP once we've reviewed your application. You can check your status in this page, http://bit.ly/as12f. Log in with your last name and ARN. This msg is FREE.";

        $sms = $client->sms($this->globeShortCode);
        $response = $sms->sendMessage($eventLead->getMobile(), $msg, $this->appId, $this->appSecret);

        if ($response && !isset($response['error'])) {
            $badge = new LeasingLeadBadges();
            $badge->setBadgeId(11);
            $badge->setLeadTypeId(C::EVENT);
            $badge->setLeadId($eventBooking->getId());
            $badge->setStatus(1);
            $badge->save();

            $tl2 = new LeasingTimelineActivity();
            $tl2->setLeadTypeId(C::EVENT);
            $tl2->setLeadId($eventBooking->getId());
            $tl2->setUser('System');
            $tl2->setActivity('Verified mobile number');
            $tl2->setTimestamp($date->format(C::DATETIMEFORMAT));
            $tl2->setStatus('Mobile Verified');
            $tl2->setStatusId(C::MOBILE_VERIFIED);
            $tl2->save();
        }

        $ve = VerifyEmail::verifyThisEmail($eventLead->getEmail());
        if ($ve = 'valid') {
            $badge = new LeasingLeadBadges();
            $badge->setBadgeId(12);
            $badge->setLeadTypeId(C::EVENT);
            $badge->setLeadId($eventBooking->getId());
            $badge->setStatus(1);
            $badge->save();

            $tl3 = new LeasingTimelineActivity();
            $tl3->setLeadTypeId(C::EVENT);
            $tl3->setLeadId($eventBooking->getId());
            $tl3->setUser('System');
            $tl3->setActivity('Verified email address');
            $tl3->setTimestamp($date->format(C::DATETIMEFORMAT));
            $tl3->setStatus('Email Verified');
            $tl3->setStatusId(C::EMAIL_VERIFIED);
            $tl3->save();
        }

        echo 1;
        exit;
    }
}

?>