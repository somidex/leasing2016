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
use Leasing\CoreBundle\Model\LeasingCalendarPeer;
use Leasing\CoreBundle\Model\LeasingCalendarQuery;
use Leasing\CoreBundle\Model\LeasingUnitCalendar;

/**
 * @method LeasingCalendarQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingCalendarQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method LeasingCalendarQuery orderByCalendarPostId($order = Criteria::ASC) Order by the calendar_post_id column
 * @method LeasingCalendarQuery orderByAvailability($order = Criteria::ASC) Order by the availability column
 * @method LeasingCalendarQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method LeasingCalendarQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method LeasingCalendarQuery groupById() Group by the id column
 * @method LeasingCalendarQuery groupByName() Group by the name column
 * @method LeasingCalendarQuery groupByCalendarPostId() Group by the calendar_post_id column
 * @method LeasingCalendarQuery groupByAvailability() Group by the availability column
 * @method LeasingCalendarQuery groupByStartDate() Group by the start_date column
 * @method LeasingCalendarQuery groupByEndDate() Group by the end_date column
 *
 * @method LeasingCalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingCalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingCalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingCalendarQuery leftJoinLeasingUnitCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitCalendar relation
 * @method LeasingCalendarQuery rightJoinLeasingUnitCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitCalendar relation
 * @method LeasingCalendarQuery innerJoinLeasingUnitCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitCalendar relation
 *
 * @method LeasingCalendar findOne(PropelPDO $con = null) Return the first LeasingCalendar matching the query
 * @method LeasingCalendar findOneOrCreate(PropelPDO $con = null) Return the first LeasingCalendar matching the query, or a new LeasingCalendar object populated from the query conditions when no match is found
 *
 * @method LeasingCalendar findOneByName(string $name) Return the first LeasingCalendar filtered by the name column
 * @method LeasingCalendar findOneByCalendarPostId(int $calendar_post_id) Return the first LeasingCalendar filtered by the calendar_post_id column
 * @method LeasingCalendar findOneByAvailability(string $availability) Return the first LeasingCalendar filtered by the availability column
 * @method LeasingCalendar findOneByStartDate(string $start_date) Return the first LeasingCalendar filtered by the start_date column
 * @method LeasingCalendar findOneByEndDate(string $end_date) Return the first LeasingCalendar filtered by the end_date column
 *
 * @method array findById(int $id) Return LeasingCalendar objects filtered by the id column
 * @method array findByName(string $name) Return LeasingCalendar objects filtered by the name column
 * @method array findByCalendarPostId(int $calendar_post_id) Return LeasingCalendar objects filtered by the calendar_post_id column
 * @method array findByAvailability(string $availability) Return LeasingCalendar objects filtered by the availability column
 * @method array findByStartDate(string $start_date) Return LeasingCalendar objects filtered by the start_date column
 * @method array findByEndDate(string $end_date) Return LeasingCalendar objects filtered by the end_date column
 */
abstract class BaseLeasingCalendarQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingCalendarQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingCalendar';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingCalendarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingCalendarQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingCalendarQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingCalendarQuery) {
            return $criteria;
        }
        $query = new LeasingCalendarQuery(null, null, $modelAlias);

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
     * @return   LeasingCalendar|LeasingCalendar[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingCalendarPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingCalendarPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingCalendar A model object, or null if the key is not found
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
     * @return                 LeasingCalendar A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `calendar_post_id`, `availability`, `start_date`, `end_date` FROM `calendar` WHERE `id` = :p0';
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
            $obj = new LeasingCalendar();
            $obj->hydrate($row);
            LeasingCalendarPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingCalendar|LeasingCalendar[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingCalendar[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingCalendarPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingCalendarPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingCalendarPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingCalendarPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingCalendarPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingCalendarPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the calendar_post_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarPostId(1234); // WHERE calendar_post_id = 1234
     * $query->filterByCalendarPostId(array(12, 34)); // WHERE calendar_post_id IN (12, 34)
     * $query->filterByCalendarPostId(array('min' => 12)); // WHERE calendar_post_id >= 12
     * $query->filterByCalendarPostId(array('max' => 12)); // WHERE calendar_post_id <= 12
     * </code>
     *
     * @param     mixed $calendarPostId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByCalendarPostId($calendarPostId = null, $comparison = null)
    {
        if (is_array($calendarPostId)) {
            $useMinMax = false;
            if (isset($calendarPostId['min'])) {
                $this->addUsingAlias(LeasingCalendarPeer::CALENDAR_POST_ID, $calendarPostId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calendarPostId['max'])) {
                $this->addUsingAlias(LeasingCalendarPeer::CALENDAR_POST_ID, $calendarPostId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingCalendarPeer::CALENDAR_POST_ID, $calendarPostId, $comparison);
    }

    /**
     * Filter the query on the availability column
     *
     * Example usage:
     * <code>
     * $query->filterByAvailability('fooValue');   // WHERE availability = 'fooValue'
     * $query->filterByAvailability('%fooValue%'); // WHERE availability LIKE '%fooValue%'
     * </code>
     *
     * @param     string $availability The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByAvailability($availability = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($availability)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $availability)) {
                $availability = str_replace('*', '%', $availability);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingCalendarPeer::AVAILABILITY, $availability, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('fooValue');   // WHERE start_date = 'fooValue'
     * $query->filterByStartDate('%fooValue%'); // WHERE start_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startDate)) {
                $startDate = str_replace('*', '%', $startDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingCalendarPeer::START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('fooValue');   // WHERE end_date = 'fooValue'
     * $query->filterByEndDate('%fooValue%'); // WHERE end_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endDate)) {
                $endDate = str_replace('*', '%', $endDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingCalendarPeer::END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query by a related LeasingUnitCalendar object
     *
     * @param   LeasingUnitCalendar|PropelObjectCollection $leasingUnitCalendar  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingCalendarQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitCalendar($leasingUnitCalendar, $comparison = null)
    {
        if ($leasingUnitCalendar instanceof LeasingUnitCalendar) {
            return $this
                ->addUsingAlias(LeasingCalendarPeer::ID, $leasingUnitCalendar->getCalendarId(), $comparison);
        } elseif ($leasingUnitCalendar instanceof PropelObjectCollection) {
            return $this
                ->useLeasingUnitCalendarQuery()
                ->filterByPrimaryKeys($leasingUnitCalendar->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingUnitCalendar() only accepts arguments of type LeasingUnitCalendar or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitCalendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function joinLeasingUnitCalendar($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitCalendar');

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
            $this->addJoinObject($join, 'LeasingUnitCalendar');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitCalendar relation LeasingUnitCalendar object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitCalendarQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitCalendarQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitCalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitCalendar', '\Leasing\CoreBundle\Model\LeasingUnitCalendarQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingCalendar $leasingCalendar Object to remove from the list of results
     *
     * @return LeasingCalendarQuery The current query, for fluid interface
     */
    public function prune($leasingCalendar = null)
    {
        if ($leasingCalendar) {
            $this->addUsingAlias(LeasingCalendarPeer::ID, $leasingCalendar->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
