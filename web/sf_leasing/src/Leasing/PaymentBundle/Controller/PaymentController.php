<?php

namespace Leasing\PaymentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Leasing\CoreBundle\APIutils\GlobeLabs\GlobeClient;
use Leasing\CoreBundle\APIutils\Paymaya\Checkout;

//Peers
use Leasing\CoreBundle\Model\LeasingEventBookingsPeer;
use Leasing\CoreBundle\Model\LeasingParkingLeadsPeer;
use Leasing\CoreBundle\Model\LeasingStatusPeer;
use Leasing\CoreBundle\Model\LeasingLeadDocumentPeer;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetailsPeer;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsPeer;

class PaymentController extends Controller
{
    protected $key = "36cc3e3b641fae24903a0558b12f057c0210a0c9104b2fc0221656050acf76b3c4ad2364ba8a87e253c671d1a5cafb4547dbe0164cd70f06a804ca583d203bd7";

    public function retrieveApplicationAction()
    {
    	$request = $this->getRequest();

    	$leadType = $request->request->get('leadType');
    	$refNum = $request->request->get('refNum');
        $details = array();

    	if ($leadType && $refNum) {
    		switch ($leadType) {
    			case 1:
    				$parkingApp = LeasingParkingLeadsPeer::getRecords($refNum);

                    if (!empty($parkingApp)) {
                        $status = LeasingStatusPeer::retrieveByPK($parkingApp->getStatus());
                        $leadDocs = LeasingLeadDocumentPeer::getLeadDocumentByLeadId($leadType, $parkingApp->getId());
                        $docs = array();
                        $payment = LeasingParkingPaymentDetailsPeer::getDetailsByParkingLeadId($parkingApp->getId());

                        foreach ($leadDocs as $ld) {
                            $docs[$ld->getId()] = $ld->getLeasingDocument()->getDocument();
                        }

                        $details = array(
                            'parkingAppId' => $parkingApp->getId(),
                            'refNum' => $parkingApp->getApplicationNumber(),
                            'name' => $parkingApp->getFname().' '.$parkingApp->getLname(),
                            'mobile' => $parkingApp->getMobile(),
                            'email' => $parkingApp->getEmail(),
                            'reqStatus' => $status->getStatus(),
                            'property' => $parkingApp->getProperty(),
                            'unit' => $parkingApp->getUnit(),
                            'slots' => $parkingApp->getSlots(),
                            'paymentTerms' => $parkingApp->getPaymentTerms(),
                            'docs' => $docs,
                            'payment' => $payment,
                            'paymentType' => $parkingApp->getPaymentType()
                        );
                        return $this->render('LeasingPaymentBundle::parkingPayment.html.twig', array(
                            'details' => $details
                        ));
                    } else {
                        echo -1;
                        exit;
                    }
                    
    				break;
    			case 2:
    				$eventApp = LeasingEventBookingsPeer::getRecords($refNum);

                    if (!empty($eventApp)) {
                        $status = LeasingStatusPeer::retrieveByPK($eventApp->getStatus());
                        $leadDocs = LeasingLeadDocumentPeer::getLeadDocumentByLeadId($leadType, $eventApp->getId());
                        $docs = array();
                        $payment = LeasingEventPaymentDetailsPeer::getEventPaymentDetailsByEventBookingId($eventApp->getId());

                        foreach ($leadDocs as $ld) {
                            $docs[$ld->getId()] = $ld->getLeasingDocument()->getDocument();
                        }

                        $details = array(
                            'eventAppId' => $eventApp->getId(),
                            'refNum' => $eventApp->getApplicationNumber(),
                            'name' => $eventApp->getLeasingEventLeads()->getFname().' '.$eventApp->getLeasingEventLeads()->getLname(),
                            'mobile' => $eventApp->getLeasingEventLeads()->getMobile(),
                            'email' => $eventApp->getLeasingEventLeads()->getEmail(),
                            'reqStatus' => $status->getStatus(),
                            'eventPlace' => $eventApp->getLeasingEventPlace()->getName(),
                            'eventDate' => $eventApp->getEventDate(),
                            'eventTime' => $eventApp->getEventStartTime().' - '.$eventApp->getEventEndTime(),
                            'docs' => $docs,
                            'payment' => $payment
                        );

                        return $this->render('LeasingPaymentBundle::eventPayment.html.twig', array(
                            'details' => $details
                        ));
                    } else {
                        echo -1;
                        exit;
                    }
    				break;
    			default:
    				break;
    		}

            echo -2;
            exit;
    	} else {
    		throw new AccessDeniedHttpException();
    	}
    }

    public function paymayaAction()
    {
        $request = $this->getRequest();

        $webKey = $request->request->get('web_service_key');

        if ($webKey && $webKey == $this->key) {
            $totalAmt = array(
                "currency" => "PHP",
                "value" => 13009.80,
                "details" => array(
                    "subtotal" => 11398.624,
                    "serviceCharge" => 50.00,
                    "tax" => 1561.176
                )
            );

            $buyer = array(
                "firstName" => "Juan",
                "lastName" => "dela Cruz",
                "contact" => array(
                    "phone" => "09173176758",
                    "email" => "dexter.loor@searchoptmedia.com"
                ),
                "shippingAddress" => array(
                    "line1" => "Unit 407 Belmira Bldg",
                    "line2" => "Cypress Towers, Brgy Ususan",
                    "city" => "Taguig City",
                    "state" => "Metro Manila",
                    "zipCode" => "1632",
                    "countryCode" => "PH"
                ),
                "billingAddress" => array(
                    "line1" => "Unit 407 Belmira Bldg",
                    "line2" => "Cypress Towers, Brgy Ususan",
                    "city" => "Taguig City",
                    "state" => "Metro Manila",
                    "zipCode" => "1632",
                    "countryCode" => "PH"
                )
            );

            $items = array(
                array(
                    "name" => "DMCI Leasing Events Rental Downpayment",
                    "code" => "DMCILSD_EVRENT",
                    "description" => "Downpayment for Events Place Rental",
                    "quantity" => 1,
                    "amount" => array(
                        "value" => 6504.90,
                        "details" => array()
                    )
                ),
                array(
                    "name" => "DMCI Leasing Events Rental Downpayment",
                    "code" => "DMCILSD_EVRENT",
                    "description" => "Downpayment for Events Place Rental",
                    "quantity" => 1,
                    "amount" => array(
                        "value" => 6504.90,
                        "details" => array()
                    )
                )
            );

            /*$redirectUrl = array(
                "success" => $this->generateUrl('leasing_payment_success'),
                "failure" => $this->generateUrl('leasing_payment_failure'),
                "cancel" => $this->generateUrl('leasing_payment_cancel'),
            );*/

            $redirectUrl = array(
                "success" => "http://dmcileasing.searchoptmedia.com/secured/payment/success",
                "failure" => "http://dmcileasing.searchoptmedia.com/secured/payment/failure",
                "cancel" => "http://dmcileasing.searchoptmedia.com/secured/payment/cancel"
            );

            $requestReferenceNumber = "ASDF123Q";

            $data = array(
                'totalAmount' => $totalAmt,
                'buyer' => $buyer,
                'items' => $items,
                'redirectUrl' => $redirectUrl,
                'requestReferenceNumber' => $requestReferenceNumber,
                'metadata' => array()
            );

            $ch = new Checkout();
            $res = $ch->initiateCheckout($data);

            echo "<pre>";var_dump($res);exit;

            return new Response();
        } else {
            throw new AccessDeniedHttpException();
        }
    }

    public function paymayaSuccessAction()
    {
        $request = $this->getRequest();

        echo "<pre>";var_dump($request->request->all());exit;

        return new Response();
    }

    public function paymayaFailureAction()
    {
        $request = $this->getRequest();

        echo "<pre>";var_dump($request->request->all());exit;

        return new Response();
    }

    public function paymayaCancelAction()
    {
        $request = $this->getRequest();

        echo "<pre>";var_dump($request->request->all());exit;

        return new Response();
    }
}
