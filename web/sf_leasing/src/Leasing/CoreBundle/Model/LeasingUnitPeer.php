<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingUnitPeer;

use \Criteria;

class LeasingUnitPeer extends BaseLeasingUnitPeer
{
	public static function getUnitByName($name = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::NAME, $name, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}

	public static function getUnitByPostId($postId = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::POST_ID, $postId, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}

	public static function getSearchedUnit($loc = null, $type = null, $br = null, $dress = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		if ($loc) {
			$c->add(self::LOCATION_ID, $loc, Criteria::EQUAL);
		}

		if ($type) {
			$c->add(self::UNIT_TYPE_ID, $type, Criteria::EQUAL);
		}

		if ($br) {
			$c->add(self::BR_ID, $br, Criteria::EQUAL);
		}

		if ($dress) {
			$c->add(self::DRESS_UP_ID, $dress, Criteria::EQUAL);
		}

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
