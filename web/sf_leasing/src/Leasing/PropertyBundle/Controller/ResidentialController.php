<?php

namespace Leasing\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Leasing\CoreBundle\APIutils\GlobeLabs\GlobeClient;
use Leasing\CoreBundle\APIutils\VerifyEmail\VerifyEmail;

//Models
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingAppointmentLeads;
use Leasing\CoreBundle\Model\LeasingTimelineActivity;
use Leasing\CoreBundle\Model\LeasingBadges;
use Leasing\CoreBundle\Model\LeasingLeadBadges;

//Peers
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsPeer;
use Leasing\CoreBundle\Model\LeasingCountryPeer;
use Leasing\CoreBundle\Model\LeasingNationalityPeer;
use Leasing\CoreBundle\Model\LeasingUnitPeer;

//Utilities
use Leasing\CoreBundle\Utilities\Constant as C;
use Leasing\CoreBundle\Utilities\Utility as U;

class ResidentialController extends Controller
{
	private $globeShortCode = '21587158';
    private $otherShortCode = '29290587158';
    private $appId = 'go7GIr57b7u7oi5dkec7oKudpoMGIe6b';
    private $appSecret = '93c19eb1666c6db1dbaf3d93b497fa609145b963df4708e05fad6fc5c92e89db';

	public function saveAppointmentRequestAction()
	{
		$request = $this->getRequest();

    	$postid = $request->request->get('unitid');
    	$date = $request->request->get('date');
    	$time = $request->request->get('time');
    	$fname = $request->request->get('fname');
    	$lname = $request->request->get('lname');
    	$contact = $request->request->get('contact');
    	$email = $request->request->get('email');
    	$country = LeasingCountryPeer::getIdByCountryName($request->request->get('country'));
    	$nationality = LeasingNationalityPeer::getIdByNationalityName($request->request->get('nationality'));
    	$notes = $request->request->get('notes');
    	$clientIp = $request->request->get('clientIp');
        $firstHeard = $request->request->get('firstHeard');

    	//UNIT DETAILS
    	$unit = LeasingUnitPeer::getUnitByPostId($postid);

    	$lead = new LeasingAppointmentLeads();
        $lead->setFname($fname);
        $lead->setLname($lname);
        $lead->setEmail($email);
        $lead->setMobile($contact);
        $lead->setCountryId($country->getId());
        $lead->setNationalityId($nationality->getId());
        $lead->setClientIp($clientIp);
        $lead->save();

    	$now = new \DateTime('now');

    	$app = new LeasingAppointments();
    	$app->setAppointmentLeadsId($lead->getId());
    	$app->setUnitId($unit->getId());
    	$app->setPreferredDate($date);
    	$app->setPreferredTime($time);
        $app->setFirstHeard($firstHeard);
    	$app->setNotes($notes);
    	$app->setDateAdded($now->format(C::DATETIMEFORMAT));
    	$app->setStatus(C::PENDING);
    	$app->setPrevStatus(C::PENDING);
    	$app->save();

    	$tl1 = new LeasingTimelineActivity();
    	$tl1->setLeadTypeId(C::APPOINTMENT);
    	$tl1->setLeadId($lead->getId());
    	$tl1->setUser('Lead');
    	$tl1->setActivity('Requested Unit Viewing');
    	$tl1->setTimestamp($now->format(C::DATETIMEFORMAT));
    	$tl1->setStatus('Pending');
    	$tl1->setStatusId(C::PENDING);
    	$tl1->save();

    	$this->get('session')->set('thank-you', 1);

		$client = new GlobeClient();

		$msg = "Thank you, ".$lead->getFname()." ".$lead->getLname()."! Your request to view ".$app->getLeasingUnit()->getName()." is now being processed. We will update you ASAP once an agent is assigned to assist you. This msg is FREE.";

		$sms = $client->sms($this->globeShortCode);
		$response = $sms->sendMessage($lead->getMobile(), $msg, $this->appId, $this->appSecret);

		if ($response && !isset($response['error'])) {
			$badge = new LeasingLeadBadges();
            $badge->setBadgeId(11);
			$badge->setLeadTypeId(C::APPOINTMENT);
			$badge->setLeadId($lead->getId());
			$badge->setStatus(1);
			$badge->save();

			$tl2 = new LeasingTimelineActivity();
			$tl2->setLeadTypeId(C::APPOINTMENT);
			$tl2->setLeadId($lead->getId());
			$tl2->setUser('System');
			$tl2->setActivity('Verified mobile number');
			$tl2->setTimestamp($now->format(C::DATETIMEFORMAT));
			$tl2->setStatus('Mobile Verified');
			$tl2->setStatusId(C::MOBILE_VERIFIED);
			$tl2->save();
		}

        $ve = VerifyEmail::verifyThisEmail($lead->getEmail());
        if ($ve = 'valid') {
            $badge = new LeasingLeadBadges();
            $badge->setBadgeId(12);
            $badge->setLeadTypeId(C::PARKING);
            $badge->setLeadId($lead->getId());
            $badge->setStatus(1);
            $badge->save();

            $tl3 = new LeasingTimelineActivity();
            $tl3->setLeadTypeId(C::PARKING);
            $tl3->setLeadId($lead->getId());
            $tl3->setUser('System');
            $tl3->setActivity('Verified email address');
            $tl3->setTimestamp($now->format(C::DATETIMEFORMAT));
            $tl3->setStatus('Email Verified');
            $tl3->setStatusId(C::EMAIL_VERIFIED);
            $tl3->save();
        }

    	echo 1;
    	exit;

    	return new Response();
	}
}

?>