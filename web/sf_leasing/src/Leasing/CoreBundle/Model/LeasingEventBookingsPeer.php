<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingEventBookingsPeer;

use \Criteria;

class LeasingEventBookingsPeer extends BaseLeasingEventBookingsPeer
{
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
