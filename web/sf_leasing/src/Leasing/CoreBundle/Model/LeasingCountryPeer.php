<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingCountryPeer;

use \Criteria;

class LeasingCountryPeer extends BaseLeasingCountryPeer
{
	public static function getIdByCountryName($name = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::COUNTRY_NAME, $name, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
