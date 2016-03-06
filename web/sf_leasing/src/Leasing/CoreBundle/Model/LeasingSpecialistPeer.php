<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingSpecialistPeer;

use \Criteria;

class LeasingSpecialistPeer extends BaseLeasingSpecialistPeer
{
	public static function getAllSpecialistsByLeasingUnit($leasingUnit, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::LEASING_UNIT, $leasingUnit, Criteria::EQUAL);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
