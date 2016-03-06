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
use Leasing\CoreBundle\Model\LeasingSpecialist;
use Leasing\CoreBundle\Model\LeasingSpecialistSchedule;
use Leasing\CoreBundle\Model\LeasingSpecialistSchedulePeer;
use Leasing\CoreBundle\Model\LeasingSpecialistScheduleQuery;

/**
 * @method LeasingSpecialistScheduleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingSpecialistScheduleQuery orderByLeasingSpecialistId($order = Criteria::ASC) Order by the leasing_specialist_id column
 * @method LeasingSpecialistScheduleQuery orderByLeadTypeId($order = Criteria::ASC) Order by the lead_type_id column
 * @method LeasingSpecialistScheduleQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method LeasingSpecialistScheduleQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method LeasingSpecialistScheduleQuery orderByTime($order = Criteria::ASC) Order by the time column
 * @method LeasingSpecialistScheduleQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingSpecialistScheduleQuery groupById() Group by the id column
 * @method LeasingSpecialistScheduleQuery groupByLeasingSpecialistId() Group by the leasing_specialist_id column
 * @method LeasingSpecialistScheduleQuery groupByLeadTypeId() Group by the lead_type_id column
 * @method LeasingSpecialistScheduleQuery groupByLeadId() Group by the lead_id column
 * @method LeasingSpecialistScheduleQuery groupByDate() Group by the date column
 * @method LeasingSpecialistScheduleQuery groupByTime() Group by the time column
 * @method LeasingSpecialistScheduleQuery groupByStatus() Group by the status column
 *
 * @method LeasingSpecialistScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingSpecialistScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingSpecialistScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingSpecialistScheduleQuery leftJoinLeasingSpecialist($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingSpecialist relation
 * @method LeasingSpecialistScheduleQuery rightJoinLeasingSpecialist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingSpecialist relation
 * @method LeasingSpecialistScheduleQuery innerJoinLeasingSpecialist($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingSpecialist relation
 *
 * @method LeasingSpecialistSchedule findOne(PropelPDO $con = null) Return the first LeasingSpecialistSchedule matching the query
 * @method LeasingSpecialistSchedule findOneOrCreate(PropelPDO $con = null) Return the first LeasingSpecialistSchedule matching the query, or a new LeasingSpecialistSchedule object populated from the query conditions when no match is found
 *
 * @method LeasingSpecialistSchedule findOneByLeasingSpecialistId(int $leasing_specialist_id) Return the first LeasingSpecialistSchedule filtered by the leasing_specialist_id column
 * @method LeasingSpecialistSchedule findOneByLeadTypeId(int $lead_type_id) Return the first LeasingSpecialistSchedule filtered by the lead_type_id column
 * @method LeasingSpecialistSchedule findOneByLeadId(int $lead_id) Return the first LeasingSpecialistSchedule filtered by the lead_id column
 * @method LeasingSpecialistSchedule findOneByDate(string $date) Return the first LeasingSpecialistSchedule filtered by the date column
 * @method LeasingSpecialistSchedule findOneByTime(string $time) Return the first LeasingSpecialistSchedule filtered by the time column
 * @method LeasingSpecialistSchedule findOneByStatus(int $status) Return the first LeasingSpecialistSchedule filtered by the status column
 *
 * @method array findById(int $id) Return LeasingSpecialistSchedule objects filtered by the id column
 * @method array findByLeasingSpecialistId(int $leasing_specialist_id) Return LeasingSpecialistSchedule objects filtered by the leasing_specialist_id column
 * @method array findByLeadTypeId(int $lead_type_id) Return LeasingSpecialistSchedule objects filtered by the lead_type_id column
 * @method array findByLeadId(int $lead_id) Return LeasingSpecialistSchedule objects filtered by the lead_id column
 * @method array findByDate(string $date) Return LeasingSpecialistSchedule objects filtered by the date column
 * @method array findByTime(string $time) Return LeasingSpecialistSchedule objects filtered by the time column
 * @method array findByStatus(int $status) Return LeasingSpecialistSchedule objects filtered by the status column
 */
abstract class BaseLeasingSpecialistScheduleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingSpecialistScheduleQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingSpecialistSchedule';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingSpecialistScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingSpecialistScheduleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingSpecialistScheduleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingSpecialistScheduleQuery) {
            return $criteria;
        }
        $query = new LeasingSpecialistScheduleQuery(null, null, $modelAlias);

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
     * @return   LeasingSpecialistSchedule|LeasingSpecialistSchedule[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingSpecialistSchedulePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingSpecialistSchedule A model object, or null if the key is not found
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
     * @return                 LeasingSpecialistSchedule A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `leasing_specialist_id`, `lead_type_id`, `lead_id`, `date`, `time`, `status` FROM `leasing_specialist_schedule` WHERE `id` = :p0';
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
            $obj = new LeasingSpecialistSchedule();
            $obj->hydrate($row);
            LeasingSpecialistSchedulePeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingSpecialistSchedule|LeasingSpecialistSchedule[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingSpecialistSchedule[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::ID, $keys, Criteria::IN);
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
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the leasing_specialist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeasingSpecialistId(1234); // WHERE leasing_specialist_id = 1234
     * $query->filterByLeasingSpecialistId(array(12, 34)); // WHERE leasing_specialist_id IN (12, 34)
     * $query->filterByLeasingSpecialistId(array('min' => 12)); // WHERE leasing_specialist_id >= 12
     * $query->filterByLeasingSpecialistId(array('max' => 12)); // WHERE leasing_specialist_id <= 12
     * </code>
     *
     * @see       filterByLeasingSpecialist()
     *
     * @param     mixed $leasingSpecialistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByLeasingSpecialistId($leasingSpecialistId = null, $comparison = null)
    {
        if (is_array($leasingSpecialistId)) {
            $useMinMax = false;
            if (isset($leasingSpecialistId['min'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, $leasingSpecialistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leasingSpecialistId['max'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, $leasingSpecialistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, $leasingSpecialistId, $comparison);
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
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByLeadTypeId($leadTypeId = null, $comparison = null)
    {
        if (is_array($leadTypeId)) {
            $useMinMax = false;
            if (isset($leadTypeId['min'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEAD_TYPE_ID, $leadTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadTypeId['max'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEAD_TYPE_ID, $leadTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEAD_TYPE_ID, $leadTypeId, $comparison);
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
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::LEAD_ID, $leadId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('fooValue');   // WHERE date = 'fooValue'
     * $query->filterByDate('%fooValue%'); // WHERE date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $date The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($date)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $date)) {
                $date = str_replace('*', '%', $date);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('fooValue');   // WHERE time = 'fooValue'
     * $query->filterByTime('%fooValue%'); // WHERE time LIKE '%fooValue%'
     * </code>
     *
     * @param     string $time The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($time)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $time)) {
                $time = str_replace('*', '%', $time);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::TIME, $time, $comparison);
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
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingSpecialistSchedulePeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistSchedulePeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingSpecialist object
     *
     * @param   LeasingSpecialist|PropelObjectCollection $leasingSpecialist The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingSpecialistScheduleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingSpecialist($leasingSpecialist, $comparison = null)
    {
        if ($leasingSpecialist instanceof LeasingSpecialist) {
            return $this
                ->addUsingAlias(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, $leasingSpecialist->getId(), $comparison);
        } elseif ($leasingSpecialist instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, $leasingSpecialist->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingSpecialist() only accepts arguments of type LeasingSpecialist or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingSpecialist relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function joinLeasingSpecialist($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingSpecialist');

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
            $this->addJoinObject($join, 'LeasingSpecialist');
        }

        return $this;
    }

    /**
     * Use the LeasingSpecialist relation LeasingSpecialist object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingSpecialistQuery A secondary query class using the current class as primary query
     */
    public function useLeasingSpecialistQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingSpecialist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingSpecialist', '\Leasing\CoreBundle\Model\LeasingSpecialistQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingSpecialistSchedule $leasingSpecialistSchedule Object to remove from the list of results
     *
     * @return LeasingSpecialistScheduleQuery The current query, for fluid interface
     */
    public function prune($leasingSpecialistSchedule = null)
    {
        if ($leasingSpecialistSchedule) {
            $this->addUsingAlias(LeasingSpecialistSchedulePeer::ID, $leasingSpecialistSchedule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
