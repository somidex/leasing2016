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
use Leasing\CoreBundle\Model\LeasingAppointmentAssignment;
use Leasing\CoreBundle\Model\LeasingAppointmentAssignmentPeer;
use Leasing\CoreBundle\Model\LeasingAppointmentAssignmentQuery;
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingSpecialist;

/**
 * @method LeasingAppointmentAssignmentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingAppointmentAssignmentQuery orderByLeasingSpecialistId($order = Criteria::ASC) Order by the leasing_specialist_id column
 * @method LeasingAppointmentAssignmentQuery orderByAppointmentsId($order = Criteria::ASC) Order by the appointments_id column
 * @method LeasingAppointmentAssignmentQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingAppointmentAssignmentQuery groupById() Group by the id column
 * @method LeasingAppointmentAssignmentQuery groupByLeasingSpecialistId() Group by the leasing_specialist_id column
 * @method LeasingAppointmentAssignmentQuery groupByAppointmentsId() Group by the appointments_id column
 * @method LeasingAppointmentAssignmentQuery groupByStatus() Group by the status column
 *
 * @method LeasingAppointmentAssignmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingAppointmentAssignmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingAppointmentAssignmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingAppointmentAssignmentQuery leftJoinLeasingSpecialist($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingSpecialist relation
 * @method LeasingAppointmentAssignmentQuery rightJoinLeasingSpecialist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingSpecialist relation
 * @method LeasingAppointmentAssignmentQuery innerJoinLeasingSpecialist($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingSpecialist relation
 *
 * @method LeasingAppointmentAssignmentQuery leftJoinLeasingAppointments($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointments relation
 * @method LeasingAppointmentAssignmentQuery rightJoinLeasingAppointments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointments relation
 * @method LeasingAppointmentAssignmentQuery innerJoinLeasingAppointments($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointments relation
 *
 * @method LeasingAppointmentAssignment findOne(PropelPDO $con = null) Return the first LeasingAppointmentAssignment matching the query
 * @method LeasingAppointmentAssignment findOneOrCreate(PropelPDO $con = null) Return the first LeasingAppointmentAssignment matching the query, or a new LeasingAppointmentAssignment object populated from the query conditions when no match is found
 *
 * @method LeasingAppointmentAssignment findOneByLeasingSpecialistId(int $leasing_specialist_id) Return the first LeasingAppointmentAssignment filtered by the leasing_specialist_id column
 * @method LeasingAppointmentAssignment findOneByAppointmentsId(int $appointments_id) Return the first LeasingAppointmentAssignment filtered by the appointments_id column
 * @method LeasingAppointmentAssignment findOneByStatus(int $status) Return the first LeasingAppointmentAssignment filtered by the status column
 *
 * @method array findById(int $id) Return LeasingAppointmentAssignment objects filtered by the id column
 * @method array findByLeasingSpecialistId(int $leasing_specialist_id) Return LeasingAppointmentAssignment objects filtered by the leasing_specialist_id column
 * @method array findByAppointmentsId(int $appointments_id) Return LeasingAppointmentAssignment objects filtered by the appointments_id column
 * @method array findByStatus(int $status) Return LeasingAppointmentAssignment objects filtered by the status column
 */
abstract class BaseLeasingAppointmentAssignmentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingAppointmentAssignmentQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingAppointmentAssignment';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingAppointmentAssignmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingAppointmentAssignmentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingAppointmentAssignmentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingAppointmentAssignmentQuery) {
            return $criteria;
        }
        $query = new LeasingAppointmentAssignmentQuery(null, null, $modelAlias);

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
     * @return   LeasingAppointmentAssignment|LeasingAppointmentAssignment[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingAppointmentAssignmentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingAppointmentAssignmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingAppointmentAssignment A model object, or null if the key is not found
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
     * @return                 LeasingAppointmentAssignment A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `leasing_specialist_id`, `appointments_id`, `status` FROM `appointment_assignment` WHERE `id` = :p0';
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
            $obj = new LeasingAppointmentAssignment();
            $obj->hydrate($row);
            LeasingAppointmentAssignmentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingAppointmentAssignment|LeasingAppointmentAssignment[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingAppointmentAssignment[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingAppointmentAssignmentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingAppointmentAssignmentPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentAssignmentPeer::ID, $id, $comparison);
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
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function filterByLeasingSpecialistId($leasingSpecialistId = null, $comparison = null)
    {
        if (is_array($leasingSpecialistId)) {
            $useMinMax = false;
            if (isset($leasingSpecialistId['min'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leasingSpecialistId['max'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialistId, $comparison);
    }

    /**
     * Filter the query on the appointments_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAppointmentsId(1234); // WHERE appointments_id = 1234
     * $query->filterByAppointmentsId(array(12, 34)); // WHERE appointments_id IN (12, 34)
     * $query->filterByAppointmentsId(array('min' => 12)); // WHERE appointments_id >= 12
     * $query->filterByAppointmentsId(array('max' => 12)); // WHERE appointments_id <= 12
     * </code>
     *
     * @see       filterByLeasingAppointments()
     *
     * @param     mixed $appointmentsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function filterByAppointmentsId($appointmentsId = null, $comparison = null)
    {
        if (is_array($appointmentsId)) {
            $useMinMax = false;
            if (isset($appointmentsId['min'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::APPOINTMENTS_ID, $appointmentsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($appointmentsId['max'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::APPOINTMENTS_ID, $appointmentsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentAssignmentPeer::APPOINTMENTS_ID, $appointmentsId, $comparison);
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
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingAppointmentAssignmentPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentAssignmentPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingSpecialist object
     *
     * @param   LeasingSpecialist|PropelObjectCollection $leasingSpecialist The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentAssignmentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingSpecialist($leasingSpecialist, $comparison = null)
    {
        if ($leasingSpecialist instanceof LeasingSpecialist) {
            return $this
                ->addUsingAlias(LeasingAppointmentAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialist->getId(), $comparison);
        } elseif ($leasingSpecialist instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingAppointmentAssignmentPeer::LEASING_SPECIALIST_ID, $leasingSpecialist->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingAppointments object
     *
     * @param   LeasingAppointments|PropelObjectCollection $leasingAppointments The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentAssignmentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointments($leasingAppointments, $comparison = null)
    {
        if ($leasingAppointments instanceof LeasingAppointments) {
            return $this
                ->addUsingAlias(LeasingAppointmentAssignmentPeer::APPOINTMENTS_ID, $leasingAppointments->getId(), $comparison);
        } elseif ($leasingAppointments instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingAppointmentAssignmentPeer::APPOINTMENTS_ID, $leasingAppointments->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingAppointments() only accepts arguments of type LeasingAppointments or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingAppointments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function joinLeasingAppointments($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingAppointments');

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
            $this->addJoinObject($join, 'LeasingAppointments');
        }

        return $this;
    }

    /**
     * Use the LeasingAppointments relation LeasingAppointments object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingAppointmentsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingAppointmentsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingAppointments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingAppointments', '\Leasing\CoreBundle\Model\LeasingAppointmentsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingAppointmentAssignment $leasingAppointmentAssignment Object to remove from the list of results
     *
     * @return LeasingAppointmentAssignmentQuery The current query, for fluid interface
     */
    public function prune($leasingAppointmentAssignment = null)
    {
        if ($leasingAppointmentAssignment) {
            $this->addUsingAlias(LeasingAppointmentAssignmentPeer::ID, $leasingAppointmentAssignment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
