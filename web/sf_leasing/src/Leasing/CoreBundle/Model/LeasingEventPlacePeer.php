<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingEventPlacePeer;

use \Criteria;

class LeasingEventPlacePeer extends BaseLeasingEventPlacePeer
{
	public static function getEventPlaceByPostId($postId = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::POST_ID, $postId, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}

	public static function getSearchedPlace($location = null, $min = null, $max = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$location = "%".$location."%";

		if ($location) {
			$c->add(self::SHORT_ADDRESS, $location, Criteria::LIKE);
		}

		/*if ($min && $max) {
			$cp1 = $c->getNewCriterion(self::MIN, $min, Criteria::GREATER_EQUAL);
			$cp2 = $c->getNewCriterion(self::MAX, $max, Criteria::LESS_EQUAL);
			$cp1->addAnd($cp2);
			$c->add($cp1);
		} elseif ($min && !$max) {
			$c->add(self::MIN, $min, Criteria::GREATER_EQUAL);
		} elseif (!$min && $max) {
			$c->add(self::MAX, $max, Criteria::LESS_EQUAL);
		}*/

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
