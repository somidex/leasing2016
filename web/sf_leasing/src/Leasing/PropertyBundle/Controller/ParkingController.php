<?php 

namespace Leasing\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Leasing\CoreBundle\APIutils\GlobeLabs\GlobeClient;
use Leasing\CoreBundle\APIutils\VerifyEmail\VerifyEmail;

//Models
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingDocument;
use Leasing\CoreBundle\Model\LeasingLeadDocument;
use Leasing\CoreBundle\Model\LeasingBadges;
use Leasing\CoreBundle\Model\LeasingLeadBadges;
use Leasing\CoreBundle\Model\LeasingTimelineActivity;

//Peers
use Leasing\CoreBundle\Model\LeasingParkingLeadsPeer;
use Leasing\CoreBundle\Model\LeasingDocumentPeer;
use Leasing\CoreBundle\Model\LeasingLeadDocumentPeer;

//Utilities
use Leasing\CoreBundle\Utilities\Constant as C;
use Leasing\CoreBundle\Utilities\Utility as U;

class ParkingController extends Controller
{
	private $globeShortCode = '21587158';
    private $otherShortCode = '29290587158';
    private $appId = 'go7GIr57b7u7oi5dkec7oKudpoMGIe6b';
    private $appSecret = '93c19eb1666c6db1dbaf3d93b497fa609145b963df4708e05fad6fc5c92e89db';

	public function saveParkingLeadAction()
	{
		$request = $this->getRequest();

		$directory = $request->server->get('DOCUMENT_ROOT').'/secured/uploads/parking/';
		$files = $request->files->get('documents');

		$salutation = $request->request->get('salutation');
		$fname = $request->request->get('fname');
		$lname = $request->request->get('lname');
		$gender = $request->request->get('gender');

		$tmpbdate = $request->request->get('bdate');

		$bdate = new \DateTime($tmpbdate);

		$age = $request->request->get('age');
		$email = $request->request->get('email');
		$mobile = $request->request->get('mobile');
		$property = $request->request->get('property');
		$unit = $request->request->get('unit');
		$slots = $request->request->get('slots');
		$firstHeard = $request->request->get('firstHeard');
		$terms = $request->request->get('terms');
		$paymentType = $request->request->get('paymentType');
		$date = new \DateTime('now');
		
		$lead = new LeasingParkingLeads();
		$lead->setSalutation($salutation);
		$lead->setFname($fname);
		$lead->setLname($lname);
		$lead->setGender($gender);
		$lead->setAge($age);
		$lead->setBirthday($bdate->format('Y-m-d'));
		$lead->setEmail($email);
		$lead->setMobile($mobile);
		$lead->setProperty($property);
		$lead->setUnit($unit);
		$lead->setSlots($slots);
		$lead->setFirstHeard($firstHeard);
		$lead->setPaymentTerms($terms);
		$lead->setPaymentType($paymentType);
		$lead->setDateAdded($date->format(C::DATETIMEFORMAT));
		$lead->setStatus(C::PENDING);
		$lead->save();

		$code = 'PA'.U::generateCode(5, $lead->getId());
		$lead->setApplicationNumber($code);
		$lead->save();

		foreach ($files as $file) {
			$tmp = $file->getPathName();
			$fileName = $lead->getId().'_'.$lead->getLname().'_'.$lead->getApplicationNumber().'_'.$file->getClientOriginalName();
			$target = $directory.$fileName;

			if (move_uploaded_file($tmp, $target)) {
				$doc = new LeasingDocument();
				$doc->setDocument($fileName);
				$doc->save();

				$ld = new LeasingLeadDocument();
				$ld->setLeadId($lead->getId());
				$ld->setDocumentId($doc->getId());
				$ld->setLeadTypeId(C::PARKING);
				$ld->save();
			} else {
				echo -2;
				exit;
			}
		}
		
		$tl1 = new LeasingTimelineActivity();
		$tl1->setLeadTypeId(C::PARKING);
		$tl1->setLeadId($lead->getId());
		$tl1->setUser('Lead');
		$tl1->setActivity('Applied for Parking Space');
		$tl1->setTimestamp($date->format(C::DATETIMEFORMAT));
		$tl1->setStatus('Pending');
		$tl1->setStatusId(C::PENDING);
		$tl1->save();

		$this->get('session')->set('thank-you', 1);

		$client = new GlobeClient();

		$msg = "Thank you, ".$lead->getFname()." ".$lead->getLname()."! Your application reference number (ARN) is ".$lead->getApplicationNumber().". We will update you once we've reviewed your application. You can check your status in this page, http://bit.ly/as12f. Log in with your Application Reference Number. This msg is FREE.";

		$sms = $client->sms($this->globeShortCode);
		$response = $sms->sendMessage($lead->getMobile(), $msg, $this->appId, $this->appSecret);

		if ($response && !isset($response['error'])) {
			$badge = new LeasingLeadBadges();
            $badge->setBadgeId(11);
			$badge->setLeadTypeId(C::PARKING);
			$badge->setLeadId($lead->getId());
			$badge->setStatus(1);
			$badge->save();

			$tl2 = new LeasingTimelineActivity();
			$tl2->setLeadTypeId(C::PARKING);
			$tl2->setLeadId($lead->getId());
			$tl2->setUser('System');
			$tl2->setActivity('Verified mobile number');
			$tl2->setTimestamp($date->format(C::DATETIMEFORMAT));
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