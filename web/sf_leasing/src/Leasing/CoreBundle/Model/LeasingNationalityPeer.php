<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingNationalityPeer;

use \Criteria;

class LeasingNationalityPeer extends BaseLeasingNationalityPeer
{
	public static function getIdByNationalityName($name = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::NATIONALITY_NAME, $name, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
