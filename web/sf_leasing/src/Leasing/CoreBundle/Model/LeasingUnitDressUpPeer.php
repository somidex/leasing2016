<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingUnitDressUpPeer;

use \Criteria;

class LeasingUnitDressUpPeer extends BaseLeasingUnitDressUpPeer
{
	public static function getDressUpMatchName($name = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$name = "%".$name."%";

		$c->add(self::DRESS_UP, $name, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
