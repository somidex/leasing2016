<?php

namespace Leasing\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

//Models
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingCalendar;
use Leasing\CoreBundle\Model\LeasingUnitCalendar;
use Leasing\CoreBundle\Model\LeasingEventPlace;
use Leasing\CoreBundle\Model\LeasingAppointmentLeads;
use Leasing\CoreBundle\Model\LeasingAppointments;

//Peers
use Leasing\CoreBundle\Model\LeasingUnitPeer;
use Leasing\CoreBundle\Model\LeasingUnitTypePeer;
use Leasing\CoreBundle\Model\LeasingLocationPeer;
use Leasing\CoreBundle\Model\LeasingLeaseTypePeer;
use Leasing\CoreBundle\Model\LeasingCalendarPeer;
use Leasing\CoreBundle\Model\LeasingUnitCalendarPeer;
use Leasing\CoreBundle\Model\LeasingEventPlacePeer;
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsPeer;
use Leasing\CoreBundle\Model\LeasingAppointmentsPeer;
use Leasing\CoreBundle\Model\LeasingCountryPeer;
use Leasing\CoreBundle\Model\LeasingNationalityPeer;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsPeer;
use Leasing\CoreBundle\Model\LeasingUnitDressUpPeer;

//Utilities
use Leasing\CoreBundle\Utilities\Constant as C;
use Leasing\CoreBundle\Utilities\Utility as U;

class MainController extends Controller
{
	protected $key = "36cc3e3b641fae24903a0558b12f057c0210a0c9104b2fc0221656050acf76b3c4ad2364ba8a87e253c671d1a5cafb4547dbe0164cd70f06a804ca583d203bd7";

    public function indexAction()
    {
    	return new Response();
    }

    public function searchPropertyAction()
    {
    	$request = $this->getRequest();
    	$key = $request->query->get('web_service_key');

    	if ($key) {
    		$loc = $request->query->get('location');
    		$price = $request->query->get('price');
    		$type = $request->query->get('type');
    		$br = $request->query->get('br');
    		$dressUp = $request->query->get('dressUp');

    		$result = array();

    		if ($type == 'events') {
    			if ($price) {
    				$ePrice = explode('-', $price);
	    			$tmpMin = str_replace('k', '000', $ePrice[0]);
	    			$min = (int)$tmpMin;

	    			if (count($ePrice) > 1) {
	    				$tmpMax = str_replace('k', '000', $ePrice[1]);
		    			$max = (int)$tmpMax;
	    			}
    			}

    			$plcSrch = LeasingEventPlacePeer::getSearchedPlace($loc);

    			foreach ($plcSrch as $p) {
    				if ($price) :
	    				if (defined($max)) {
		    				if ($min >= $p->getMin() && $max <= $p->getMax()) {
		    					array_push($result, $p->getPostId());
		    				}
		    			} else {
		    				if ($min >= $p->getMin() && $min <= $p->getMax()) {
		    					array_push($result, $p->getPostId());
		    				}
		    			}
		    		else :
	    				array_push($result, $p->getPostId());
	    			endif;
    			}

    		} else {
    			$locId = null;
    			$typeId = null;
    			$brId = null;
    			$dressUpId = null;

    			if ($loc) {
    				//Location ID
		    		$tmpLoc = LeasingLocationPeer::getLocationMatchName($loc);
		    		$locId = $tmpLoc->getId();
    			}
    			
	    		if ($type) {
	    			//Type ID
		    		$tmpType = LeasingUnitTypePeer::getTypeMatchName($type);
		    		$typeId = $tmpType->getId();
	    		}

	    		if ($br) {
	    			//Bedrooms
		    		$tmpBr = LeasingUnitNumberBedroomsPeer::getNumberOfBrMatchCode($br);
		    		$brId = $tmpBr->getId();
	    		}

	    		if ($dressUp) {
	    			//Dress Up
		    		$tmpDressUp = LeasingUnitDressUpPeer::getDressUpMatchName($dressUp);
		    		$dressUpId = $tmpDressUp->getId();
	    		}

	    		if ($price) {
	    			$ePrice = explode('-', $price);
	    			$tmpMin = str_replace('k', '', $ePrice[0]);
	    			$min = (int)$tmpMin;

	    			if (count($ePrice) > 1) {
	    				$tmpMax = str_replace('k', '', $ePrice[1]);
		    			$max = (int)$tmpMax;
	    			}
	    		}

	    		/*if ($locId && $typeId && $brId && $dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $typeId, $brId, $dressUpId);
	    		} elseif ($locId && $typeId && $brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $typeId, $brId);
	    		} elseif ($locId && $typeId && !$brId && $dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $typeId, $dressUpId);
	    		} elseif ($locId && !$typeId && $brId && $dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $brId, $dressUpId);
	    		} elseif (!$locId && $typeId && $brId && $dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($typeId, $brId, $dressUpId);
	    		} elseif ($locId && $typeId && !$brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $typeId);
	    		} elseif ($locId && !$typeId && $brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $brId);
	    		} elseif (!$locId && $typeId && $brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit(null, $typeId, $brId, null);
	    		} elseif ($locId && !$typeId && !$brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit($locId);
	    		} elseif (!$locId && $typeId && !$brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit(null, $typeId, null, null);
	    		} elseif (!$locId && !$typeId && $brId && !$dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit(null, null, $brId, null);
	    		} elseif (!$locId && !$typeId && !$brId && $dressUpId) {
	    			$unitSrch = LeasingUnitPeer::getSearchedUnit(null, null, null, $dressUpId);
	    		}*/
	    		$unitSrch = LeasingUnitPeer::getSearchedUnit($locId, $typeId, $brId, $dressUpId);

    			foreach ($unitSrch as $u) {
    				if ($price) {
    					$unitPrice = str_replace('K/mo', '', $u->getPriceRange());
    					$eUnitPrice = explode('-', $unitPrice);

    					if (count($eUnitPrice) > 1) {
    						if (defined($max)) {
    							if ($min >= $eUnitPrice[0] && $max <= $eUnitPrice[1]) {
    								array_push($result, $u->getPostId());
    							}
    						} else {
    							if ($min >= $eUnitPrice[0] && $min <= $eUnitPrice[1]) {
    								array_push($result, $u->getPostId());
    							}
    						}
    					} else {
    						if ($min >= $eUnitPrice[0]) {
    							array_push($result, $u->getPostId());
    						}
    					}
    				} else {
    					array_push($result, $u->getPostId());
    				}
    			}
    		}

    		return new JsonResponse($result);
    	} else {
    		throw new AccessDeniedHttpException();
    	}
    }

    public function savePropertyAction()
    {
    	$request = $this->getRequest();

    	$uType = LeasingUnitTypePeer::getTypeByName($request->request->get('type'));
    	$uLoc = LeasingLocationPeer::getLocationByName($request->request->get('loc'));

    	//Lease Type
    	$lt = json_decode($request->request->get('lease'));

    	if (count($lt > 1)) {
    		$leaseType = 'both';
    	} else {
    		$leaseType = $lt[0];
    	}

    	$uLease = LeasingLeaseTypePeer::getLeaseTypeByName($leaseType);
    	$unit = LeasingUnitPeer::getUnitByPostId($request->request->get('post_id'));

    	if (empty($unit)) {
    		$unit = new LeasingUnit();
    	}

		$unit->setName($request->request->get('name'));
		$unit->setPostId($request->request->get('post_id'));
		$unit->setContent($request->request->get('content'));
		$unit->setAvailability($request->request->get('avail'));
		$unit->setPriceRange($request->request->get('price'));
		$unit->setStatus(C::ACTIVE);
		$unit->setUnitTypeId($uType->getId());
		$unit->setLocationId($uLoc->getId());
		$unit->setLeaseTypeId($uLease->getId());
		$unit->save();

    	return new RedirectResponse('http://leasing.dmcihomes.com.local/wp-admin/post.php');
    }

    public function saveCalendarAction()
    {
    	$request = $this->getRequest();

    	$calendar = LeasingCalendarPeer::getCalendarByPostId($request->request->get('calendar_post_id'));
    	$units = json_decode($request->request->get('units'));

    	if (empty($calendar)) {
			$calendar = new LeasingCalendar();
		}

		$calendar->setName($request->request->get('name'));
		$calendar->setCalendarPostId($request->request->get('calendar_post_id'));
		$calendar->setAvailability($request->request->get('availability'));
		$calendar->setStartDate($request->request->get('start_date'));
		$calendar->setEndDate($request->request->get('end_date'));
		$calendar->save();

		$uc = LeasingUnitCalendarPeer::getUnitCalendarByCalendarId($calendar->getId());

		if (empty($uc)) {
			foreach ($units as $unit) {
				$u = LeasingUnitPeer::getUnitByPostId($unit);

				$uc = new LeasingUnitCalendar();
				$uc->setCalendarId($calendar->getId());
				$uc->setUnitId($u->getId());
				$uc->setStatus(C::ACTIVE);
				$uc->save();
			}
		} else {
				
	    	foreach ($uc as $u) {
				$u->setStatus(C::DELETE);
				$u->save();
	    	}

			foreach ($units as $unit) {
				$fl = 0;
				$lu = LeasingUnitPeer::getUnitByPostId($unit);

				foreach ($uc as $u) {
					if ($u->getUnitId() == $lu->getId()) {
						$fl = 1;
						$u->setStatus(C::ACTIVE);
						$u->save();
					}
				}

				if ($fl == 0) {
					$u = new LeasingUnitCalendar();
					$u->setCalendarId($calendar->getId());
					$u->setUnitId($u->getId());
					$u->setStatus(C::ACTIVE);
					$u->save();
				}
			}
		}

    	return new RedirectResponse('http://leasing.dmcihomes.com.local/wp-admin/post.php');
    }

    public function saveEventAction()
    {
    	$request = $this->getRequest();

    	$ep = LeasingEventPlacePeer::getEventPlaceByPostId($request->request->get('post_id'));

    	if (empty($ep)) {
    		$ep = new LeasingEventPlace();
    	}

    	$ep->setName($request->request->get('name'));
    	$ep->setPostId($request->request->get('post_id'));
    	$ep->setContent($request->request->get('content'));
    	$ep->setShortAddress($request->request->get('short_address'));
    	$ep->setFullAddress($request->request->get('full_address'));
    	$ep->setContact($request->request->get('contact'));
    	$ep->setEmail($request->request->get('email'));
    	$ep->save();

    	return new RedirectResponse('http://leasing.dmcihomes.com.local/wp-admin/post.php');
    }
}
