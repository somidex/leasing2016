<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingUnitCalendarPeer;

use \Criteria;

class LeasingUnitCalendarPeer extends BaseLeasingUnitCalendarPeer
{
	public static function getUnitCalendarByCalendarId($calId = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::CALENDAR_ID, $calId, Criteria::EQUAL);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
