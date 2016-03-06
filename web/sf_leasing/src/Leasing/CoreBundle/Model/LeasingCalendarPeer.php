<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingCalendarPeer;

use \Criteria;

class LeasingCalendarPeer extends BaseLeasingCalendarPeer
{
	public static function getCalendarByPostId($postId = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::CALENDAR_POST_ID, $postId, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
