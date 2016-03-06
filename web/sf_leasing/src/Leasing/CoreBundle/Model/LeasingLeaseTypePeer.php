<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingLeaseTypePeer;

use \Criteria;

class LeasingLeaseTypePeer extends BaseLeasingLeaseTypePeer
{
	public static function getLeaseTypeByName($name = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::NAME, $name, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
