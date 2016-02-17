<?php

namespace Leasing\CoreBundle\Model;

use Leasing\CoreBundle\Model\om\BaseLeasingLeadDocumentPeer;

use \Criteria;

class LeasingLeadDocumentPeer extends BaseLeasingLeadDocumentPeer
{
	public static function getLeadDocumentByLeadId($leadType, $id, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c1 = $c->getNewCriterion(self::LEAD_TYPE_ID, $leadType, Criteria::EQUAL);
		$c2 = $c->getNewCriterion(self::LEAD_ID, $id, Criteria::EQUAL);

		$c1->addAnd($c2);
		$c->add($c1);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
