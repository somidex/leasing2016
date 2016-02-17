<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingAppointmentLeadsPeer;

use \Criteria;

class LeasingAppointmentLeadsPeer extends BaseLeasingAppointmentLeadsPeer
{
	public static function getAppointmentLeadsByEmail($email = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::EMAIL, $email, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
