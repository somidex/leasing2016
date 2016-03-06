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
use Leasing\CoreBundle\Model\LeasingBookingAssignment;
use Leasing\CoreBundle\Model\LeasingBookingAssignmentPeer;
use Leasing\CoreBundle\Model\LeasingBookingAssignmentQuery;
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingSpecialist;

/**
 * @method LeasingBookingAssignmentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingBookingAssignmentQuery orderByLeasingSpecialistId($order = Criteria::ASC) Order by the leasing_specialist_id column
 * @method LeasingBookingAssignmentQuery orderByBookingsId($order = Criteria::ASC) Order by the bookings_id column
 *
 * @method LeasingBookingAssignmentQuery groupById() Group by the id column
 * @method LeasingBookingAssignmentQuery groupByLeasingSpecialistId() Group by the leasing_specialist_id column
 * @method LeasingBookingAssignmentQuery groupByBookingsId() Group by the bookings_id column
 *
 * @method LeasingBookingAssignmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingBookingAssignmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingBookingAssignmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingBookingAssignmentQuery leftJoinLeasingSpecialist($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingSpecialist relation
 * @method LeasingBookingAssignmentQuery rightJoinLeasingSpecialist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingSpecialist relation
 * @method LeasingBookingAssignmentQuery innerJoinLeasingSpecialist($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingSpecialist relation
 *
 * @method LeasingBookingAssignmentQuery leftJoinLeasingBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookings relation
 * @method LeasingBookingAssignmentQuery rightJoinLeasingBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookings relation
 * @method LeasingBookingAssignmentQuery innerJoinLeasingBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookings relation
 *
 * @method LeasingBookingAssignment findOne(PropelPDO $con = null) Return the first LeasingBookingAssignment matching the query
 * @method LeasingBookingAssignment findOneOrCreate(PropelPDO $con = null) Return the first LeasingBookingAssignment matching the query, or a new LeasingBookingAssignment object populated from the query conditions when no match is found
 *
 * @method LeasingBookingAssignment findOneByLeasingSpecialistId(int $leasing_specialist_id) Return the first LeasingBookingAssignment filtered by the leasing_specialist_id column
 * @method LeasingBookingAssignment findOneByBookingsId(int $bookings_id) Return the first LeasingBookingAssignment filtered by the bookings_id column
 *
 * @method array findById(int $id) Return LeasingBookingAssignment objects filtered by the id column
 * @method array findByLeasingSpecialistId(int $leasing_specialist_id) Return LeasingBookingAssignment objects filtered by the leasing_specialist_id column
 * @method array findByBookingsId(int $bookings_id) Return LeasingBookingAssignment objects filtered by the bookings_id column
 */
abstract class BaseLeasingBookingAssignmentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingBookingAssignmentQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingBookingAssignment';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingBookingAssignmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingBookingAssignmentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingBookingAssignmentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingBookingAssignmentQuery) {
            return $criteria;
        }
        $query = new LeasingBookingAssignmentQuery(null, null, $modelAlias);

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
     * @return   LeasingBookingAssignment|LeasingBookingAssignment[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingBookingAssignmentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingAssignmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingBookingAssignment A model object, or null if the key is not found
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
     * @return                 LeasingBookingAssignment A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `leasing_specialist_id`, `bookings_id` FROM `booking_assignment` WHERE `id` = :p0';
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
            $obj = new LeasingBookingAssignment();
            $obj->hydrate($row);
            LeasingBookingAssignmentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingBookingAssignment|LeasingBookingAssignment[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingBookingAssignment[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingBookingAssignmentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingBookingAssignmentPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingBookingAssignmentPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingBookingAssignmentPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingAssignmentPeer::ID, $id, $comparison);
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
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function filterByLeasingSpecialistId($leasingSpecialistId = null, $comparison = null)
    {
        if (is_array($leasingSpecialistId)) {
            $useMinMax = false;
            if (isset($leasingSpecialistId['min'])) {
                $this->addUsingAlias(LeasingBookingAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leasingSpecialistId['max'])) {
                $this->addUsingAlias(LeasingBookingAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialistId, $comparison);
    }

    /**
     * Filter the query on the bookings_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingsId(1234); // WHERE bookings_id = 1234
     * $query->filterByBookingsId(array(12, 34)); // WHERE bookings_id IN (12, 34)
     * $query->filterByBookingsId(array('min' => 12)); // WHERE bookings_id >= 12
     * $query->filterByBookingsId(array('max' => 12)); // WHERE bookings_id <= 12
     * </code>
     *
     * @see       filterByLeasingBookings()
     *
     * @param     mixed $bookingsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function filterByBookingsId($bookingsId = null, $comparison = null)
    {
        if (is_array($bookingsId)) {
            $useMinMax = false;
            if (isset($bookingsId['min'])) {
                $this->addUsingAlias(LeasingBookingAssignmentPeer::BOOKINGS_ID, $bookingsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingsId['max'])) {
                $this->addUsingAlias(LeasingBookingAssignmentPeer::BOOKINGS_ID, $bookingsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingAssignmentPeer::BOOKINGS_ID, $bookingsId, $comparison);
    }

    /**
     * Filter the query by a related LeasingSpecialist object
     *
     * @param   LeasingSpecialist|PropelObjectCollection $leasingSpecialist The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBookingAssignmentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingSpecialist($leasingSpecialist, $comparison = null)
    {
        if ($leasingSpecialist instanceof LeasingSpecialist) {
            return $this
                ->addUsingAlias(LeasingBookingAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialist->getId(), $comparison);
        } elseif ($leasingSpecialist instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingBookingAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialist->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingBookings object
     *
     * @param   LeasingBookings|PropelObjectCollection $leasingBookings The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBookingAssignmentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookings($leasingBookings, $comparison = null)
    {
        if ($leasingBookings instanceof LeasingBookings) {
            return $this
                ->addUsingAlias(LeasingBookingAssignmentPeer::BOOKINGS_ID, $leasingBookings->getId(), $comparison);
        } elseif ($leasingBookings instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingBookingAssignmentPeer::BOOKINGS_ID, $leasingBookings->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingBookings() only accepts arguments of type LeasingBookings or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBookings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function joinLeasingBookings($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBookings');

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
            $this->addJoinObject($join, 'LeasingBookings');
        }

        return $this;
    }

    /**
     * Use the LeasingBookings relation LeasingBookings object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBookingsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBookingsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBookings', '\Leasing\CoreBundle\Model\LeasingBookingsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingBookingAssignment $leasingBookingAssignment Object to remove from the list of results
     *
     * @return LeasingBookingAssignmentQuery The current query, for fluid interface
     */
    public function prune($leasingBookingAssignment = null)
    {
        if ($leasingBookingAssignment) {
            $this->addUsingAlias(LeasingBookingAssignmentPeer::ID, $leasingBookingAssignment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
