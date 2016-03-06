<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingParkingLeadsPeer;

use \Criteria;

class LeasingParkingLeadsPeer extends BaseLeasingParkingLeadsPeer
{
	public static function getLeadByEmail($email = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::EMAIL, $email, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}

	public static function getRecords($ref, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::APPLICATION_NUMBER, $ref, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
