<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingEventPaymentDetailsPeer;

use \Criteria;

class LeasingEventPaymentDetailsPeer extends BaseLeasingEventPaymentDetailsPeer
{
	public static function getEventPaymentDetailsByEventBookingId($id, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::EVENT_BOOKINGS_ID, $id, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
