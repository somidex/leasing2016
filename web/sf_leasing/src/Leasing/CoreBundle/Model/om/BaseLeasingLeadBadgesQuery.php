<?php

namespace Leasing\CoreBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingBadges;
use Leasing\CoreBundle\Model\LeasingLeadBadges;
use Leasing\CoreBundle\Model\LeasingLeadBadgesPeer;
use Leasing\CoreBundle\Model\LeasingLeadBadgesQuery;

/**
 * @method LeasingLeadBadgesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingLeadBadgesQuery orderByBadgeId($order = Criteria::ASC) Order by the badge_id column
 * @method LeasingLeadBadgesQuery orderByLeadTypeId($order = Criteria::ASC) Order by the lead_type_id column
 * @method LeasingLeadBadgesQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method LeasingLeadBadgesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingLeadBadgesQuery groupById() Group by the id column
 * @method LeasingLeadBadgesQuery groupByBadgeId() Group by the badge_id column
 * @method LeasingLeadBadgesQuery groupByLeadTypeId() Group by the lead_type_id column
 * @method LeasingLeadBadgesQuery groupByLeadId() Group by the lead_id column
 * @method LeasingLeadBadgesQuery groupByStatus() Group by the status column
 *
 * @method LeasingLeadBadgesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingLeadBadgesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingLeadBadgesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingLeadBadgesQuery leftJoinLeasingBadges($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBadges relation
 * @method LeasingLeadBadgesQuery rightJoinLeasingBadges($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBadges relation
 * @method LeasingLeadBadgesQuery innerJoinLeasingBadges($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBadges relation
 *
 * @method LeasingLeadBadges findOne(PropelPDO $con = null) Return the first LeasingLeadBadges matching the query
 * @method LeasingLeadBadges findOneOrCreate(PropelPDO $con = null) Return the first LeasingLeadBadges matching the query, or a new LeasingLeadBadges object populated from the query conditions when no match is found
 *
 * @method LeasingLeadBadges findOneByBadgeId(int $badge_id) Return the first LeasingLeadBadges filtered by the badge_id column
 * @method LeasingLeadBadges findOneByLeadTypeId(int $lead_type_id) Return the first LeasingLeadBadges filtered by the lead_type_id column
 * @method LeasingLeadBadges findOneByLeadId(int $lead_id) Return the first LeasingLeadBadges filtered by the lead_id column
 * @method LeasingLeadBadges findOneByStatus(int $status) Return the first LeasingLeadBadges filtered by the status column
 *
 * @method array findById(int $id) Return LeasingLeadBadges objects filtered by the id column
 * @method array findByBadgeId(int $badge_id) Return LeasingLeadBadges objects filtered by the badge_id column
 * @method array findByLeadTypeId(int $lead_type_id) Return LeasingLeadBadges objects filtered by the lead_type_id column
 * @method array findByLeadId(int $lead_id) Return LeasingLeadBadges objects filtered by the lead_id column
 * @method array findByStatus(int $status) Return LeasingLeadBadges objects filtered by the status column
 */
abstract class BaseLeasingLeadBadgesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingLeadBadgesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingLeadBadges';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingLeadBadgesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingLeadBadgesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingLeadBadgesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingLeadBadgesQuery) {
            return $criteria;
        }
        $query = new LeasingLeadBadgesQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   LeasingLeadBadges|LeasingLeadBadges[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingLeadBadgesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingLeadBadgesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 LeasingLeadBadges A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 LeasingLeadBadges A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `badge_id`, `lead_type_id`, `lead_id`, `status` FROM `lead_badges` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new LeasingLeadBadges();
            $obj->hydrate($row);
            LeasingLeadBadgesPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return LeasingLeadBadges|LeasingLeadBadges[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|LeasingLeadBadges[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingLeadBadgesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingLeadBadgesPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadBadgesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the badge_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBadgeId(1234); // WHERE badge_id = 1234
     * $query->filterByBadgeId(array(12, 34)); // WHERE badge_id IN (12, 34)
     * $query->filterByBadgeId(array('min' => 12)); // WHERE badge_id >= 12
     * $query->filterByBadgeId(array('max' => 12)); // WHERE badge_id <= 12
     * </code>
     *
     * @see       filterByLeasingBadges()
     *
     * @param     mixed $badgeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterByBadgeId($badgeId = null, $comparison = null)
    {
        if (is_array($badgeId)) {
            $useMinMax = false;
            if (isset($badgeId['min'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::BADGE_ID, $badgeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($badgeId['max'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::BADGE_ID, $badgeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadBadgesPeer::BADGE_ID, $badgeId, $comparison);
    }

    /**
     * Filter the query on the lead_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeadTypeId(1234); // WHERE lead_type_id = 1234
     * $query->filterByLeadTypeId(array(12, 34)); // WHERE lead_type_id IN (12, 34)
     * $query->filterByLeadTypeId(array('min' => 12)); // WHERE lead_type_id >= 12
     * $query->filterByLeadTypeId(array('max' => 12)); // WHERE lead_type_id <= 12
     * </code>
     *
     * @param     mixed $leadTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterByLeadTypeId($leadTypeId = null, $comparison = null)
    {
        if (is_array($leadTypeId)) {
            $useMinMax = false;
            if (isset($leadTypeId['min'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::LEAD_TYPE_ID, $leadTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadTypeId['max'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::LEAD_TYPE_ID, $leadTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadBadgesPeer::LEAD_TYPE_ID, $leadTypeId, $comparison);
    }

    /**
     * Filter the query on the lead_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeadId(1234); // WHERE lead_id = 1234
     * $query->filterByLeadId(array(12, 34)); // WHERE lead_id IN (12, 34)
     * $query->filterByLeadId(array('min' => 12)); // WHERE lead_id >= 12
     * $query->filterByLeadId(array('max' => 12)); // WHERE lead_id <= 12
     * </code>
     *
     * @param     mixed $leadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadBadgesPeer::LEAD_ID, $leadId, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status >= 12
     * $query->filterByStatus(array('max' => 12)); // WHERE status <= 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingLeadBadgesPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadBadgesPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingBadges object
     *
     * @param   LeasingBadges|PropelObjectCollection $leasingBadges The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingLeadBadgesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBadges($leasingBadges, $comparison = null)
    {
        if ($leasingBadges instanceof LeasingBadges) {
            return $this
                ->addUsingAlias(LeasingLeadBadgesPeer::BADGE_ID, $leasingBadges->getId(), $comparison);
        } elseif ($leasingBadges instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingLeadBadgesPeer::BADGE_ID, $leasingBadges->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingBadges() only accepts arguments of type LeasingBadges or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBadges relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function joinLeasingBadges($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBadges');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'LeasingBadges');
        }

        return $this;
    }

    /**
     * Use the LeasingBadges relation LeasingBadges object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBadgesQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBadgesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBadges($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBadges', '\Leasing\CoreBundle\Model\LeasingBadgesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingLeadBadges $leasingLeadBadges Object to remove from the list of results
     *
     * @return LeasingLeadBadgesQuery The current query, for fluid interface
     */
    public function prune($leasingLeadBadges = null)
    {
        if ($leasingLeadBadges) {
            $this->addUsingAlias(LeasingLeadBadgesPeer::ID, $leasingLeadBadges->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
