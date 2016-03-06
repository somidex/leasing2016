<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingUnitNumberBedroomsPeer;

use \Criteria;

class LeasingUnitNumberBedroomsPeer extends BaseLeasingUnitNumberBedroomsPeer
{
	public static function getNumberOfBrMatchCode($code = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$code = "%".$code."%";

		$c->add(self::BR_CODE, $code, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
