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
use Leasing\CoreBundle\Model\LeasingCalendar;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitCalendar;
use Leasing\CoreBundle\Model\LeasingUnitCalendarPeer;
use Leasing\CoreBundle\Model\LeasingUnitCalendarQuery;

/**
 * @method LeasingUnitCalendarQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingUnitCalendarQuery orderByCalendarId($order = Criteria::ASC) Order by the calendar_id column
 * @method LeasingUnitCalendarQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method LeasingUnitCalendarQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingUnitCalendarQuery groupById() Group by the id column
 * @method LeasingUnitCalendarQuery groupByCalendarId() Group by the calendar_id column
 * @method LeasingUnitCalendarQuery groupByUnitId() Group by the unit_id column
 * @method LeasingUnitCalendarQuery groupByStatus() Group by the status column
 *
 * @method LeasingUnitCalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingUnitCalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingUnitCalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingUnitCalendarQuery leftJoinLeasingCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingCalendar relation
 * @method LeasingUnitCalendarQuery rightJoinLeasingCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingCalendar relation
 * @method LeasingUnitCalendarQuery innerJoinLeasingCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingCalendar relation
 *
 * @method LeasingUnitCalendarQuery leftJoinLeasingUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingUnitCalendarQuery rightJoinLeasingUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingUnitCalendarQuery innerJoinLeasingUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnit relation
 *
 * @method LeasingUnitCalendar findOne(PropelPDO $con = null) Return the first LeasingUnitCalendar matching the query
 * @method LeasingUnitCalendar findOneOrCreate(PropelPDO $con = null) Return the first LeasingUnitCalendar matching the query, or a new LeasingUnitCalendar object populated from the query conditions when no match is found
 *
 * @method LeasingUnitCalendar findOneByCalendarId(int $calendar_id) Return the first LeasingUnitCalendar filtered by the calendar_id column
 * @method LeasingUnitCalendar findOneByUnitId(int $unit_id) Return the first LeasingUnitCalendar filtered by the unit_id column
 * @method LeasingUnitCalendar findOneByStatus(int $status) Return the first LeasingUnitCalendar filtered by the status column
 *
 * @method array findById(int $id) Return LeasingUnitCalendar objects filtered by the id column
 * @method array findByCalendarId(int $calendar_id) Return LeasingUnitCalendar objects filtered by the calendar_id column
 * @method array findByUnitId(int $unit_id) Return LeasingUnitCalendar objects filtered by the unit_id column
 * @method array findByStatus(int $status) Return LeasingUnitCalendar objects filtered by the status column
 */
abstract class BaseLeasingUnitCalendarQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingUnitCalendarQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingUnitCalendar';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingUnitCalendarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingUnitCalendarQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingUnitCalendarQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingUnitCalendarQuery) {
            return $criteria;
        }
        $query = new LeasingUnitCalendarQuery(null, null, $modelAlias);

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
     * @return   LeasingUnitCalendar|LeasingUnitCalendar[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingUnitCalendarPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitCalendarPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingUnitCalendar A model object, or null if the key is not found
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
     * @return                 LeasingUnitCalendar A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `calendar_id`, `unit_id`, `status` FROM `unit_calendar` WHERE `id` = :p0';
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
            $obj = new LeasingUnitCalendar();
            $obj->hydrate($row);
            LeasingUnitCalendarPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingUnitCalendar|LeasingUnitCalendar[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingUnitCalendar[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingUnitCalendarPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingUnitCalendarPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitCalendarPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the calendar_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarId(1234); // WHERE calendar_id = 1234
     * $query->filterByCalendarId(array(12, 34)); // WHERE calendar_id IN (12, 34)
     * $query->filterByCalendarId(array('min' => 12)); // WHERE calendar_id >= 12
     * $query->filterByCalendarId(array('max' => 12)); // WHERE calendar_id <= 12
     * </code>
     *
     * @see       filterByLeasingCalendar()
     *
     * @param     mixed $calendarId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function filterByCalendarId($calendarId = null, $comparison = null)
    {
        if (is_array($calendarId)) {
            $useMinMax = false;
            if (isset($calendarId['min'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::CALENDAR_ID, $calendarId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calendarId['max'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::CALENDAR_ID, $calendarId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitCalendarPeer::CALENDAR_ID, $calendarId, $comparison);
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id >= 12
     * $query->filterByUnitId(array('max' => 12)); // WHERE unit_id <= 12
     * </code>
     *
     * @see       filterByLeasingUnit()
     *
     * @param     mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitCalendarPeer::UNIT_ID, $unitId, $comparison);
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
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingUnitCalendarPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitCalendarPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingCalendar object
     *
     * @param   LeasingCalendar|PropelObjectCollection $leasingCalendar The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitCalendarQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingCalendar($leasingCalendar, $comparison = null)
    {
        if ($leasingCalendar instanceof LeasingCalendar) {
            return $this
                ->addUsingAlias(LeasingUnitCalendarPeer::CALENDAR_ID, $leasingCalendar->getId(), $comparison);
        } elseif ($leasingCalendar instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitCalendarPeer::CALENDAR_ID, $leasingCalendar->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingCalendar() only accepts arguments of type LeasingCalendar or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingCalendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function joinLeasingCalendar($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingCalendar');

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
            $this->addJoinObject($join, 'LeasingCalendar');
        }

        return $this;
    }

    /**
     * Use the LeasingCalendar relation LeasingCalendar object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingCalendarQuery A secondary query class using the current class as primary query
     */
    public function useLeasingCalendarQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingCalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingCalendar', '\Leasing\CoreBundle\Model\LeasingCalendarQuery');
    }

    /**
     * Filter the query by a related LeasingUnit object
     *
     * @param   LeasingUnit|PropelObjectCollection $leasingUnit The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitCalendarQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnit($leasingUnit, $comparison = null)
    {
        if ($leasingUnit instanceof LeasingUnit) {
            return $this
                ->addUsingAlias(LeasingUnitCalendarPeer::UNIT_ID, $leasingUnit->getId(), $comparison);
        } elseif ($leasingUnit instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitCalendarPeer::UNIT_ID, $leasingUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingUnit() only accepts arguments of type LeasingUnit or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function joinLeasingUnit($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnit');

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
            $this->addJoinObject($join, 'LeasingUnit');
        }

        return $this;
    }

    /**
     * Use the LeasingUnit relation LeasingUnit object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnit', '\Leasing\CoreBundle\Model\LeasingUnitQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingUnitCalendar $leasingUnitCalendar Object to remove from the list of results
     *
     * @return LeasingUnitCalendarQuery The current query, for fluid interface
     */
    public function prune($leasingUnitCalendar = null)
    {
        if ($leasingUnitCalendar) {
            $this->addUsingAlias(LeasingUnitCalendarPeer::ID, $leasingUnitCalendar->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
