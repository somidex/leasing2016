<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingParkingPaymentDetailsPeer;

use \Criteria;

class LeasingParkingPaymentDetailsPeer extends BaseLeasingParkingPaymentDetailsPeer
{
	public static function getDetailsByParkingLeadId($id, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::PARKING_LEAD_ID, $id, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
