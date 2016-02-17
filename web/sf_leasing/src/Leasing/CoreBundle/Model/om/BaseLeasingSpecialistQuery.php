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
use Leasing\CoreBundle\Model\LeasingBookingAssignment;
use Leasing\CoreBundle\Model\LeasingSpecialist;
use Leasing\CoreBundle\Model\LeasingSpecialistPeer;
use Leasing\CoreBundle\Model\LeasingSpecialistQuery;
use Leasing\CoreBundle\Model\LeasingSpecialistSchedule;

/**
 * @method LeasingSpecialistQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingSpecialistQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method LeasingSpecialistQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method LeasingSpecialistQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method LeasingSpecialistQuery orderByLeasingUnit($order = Criteria::ASC) Order by the leasing_unit column
 * @method LeasingSpecialistQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingSpecialistQuery groupById() Group by the id column
 * @method LeasingSpecialistQuery groupByName() Group by the name column
 * @method LeasingSpecialistQuery groupByEmail() Group by the email column
 * @method LeasingSpecialistQuery groupByMobile() Group by the mobile column
 * @method LeasingSpecialistQuery groupByLeasingUnit() Group by the leasing_unit column
 * @method LeasingSpecialistQuery groupByStatus() Group by the status column
 *
 * @method LeasingSpecialistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingSpecialistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingSpecialistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingSpecialistQuery leftJoinLeasingAppointmentAssignment($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointmentAssignment relation
 * @method LeasingSpecialistQuery rightJoinLeasingAppointmentAssignment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointmentAssignment relation
 * @method LeasingSpecialistQuery innerJoinLeasingAppointmentAssignment($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointmentAssignment relation
 *
 * @method LeasingSpecialistQuery leftJoinLeasingBookingAssignment($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookingAssignment relation
 * @method LeasingSpecialistQuery rightJoinLeasingBookingAssignment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookingAssignment relation
 * @method LeasingSpecialistQuery innerJoinLeasingBookingAssignment($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookingAssignment relation
 *
 * @method LeasingSpecialistQuery leftJoinLeasingSpecialistSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingSpecialistSchedule relation
 * @method LeasingSpecialistQuery rightJoinLeasingSpecialistSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingSpecialistSchedule relation
 * @method LeasingSpecialistQuery innerJoinLeasingSpecialistSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingSpecialistSchedule relation
 *
 * @method LeasingSpecialist findOne(PropelPDO $con = null) Return the first LeasingSpecialist matching the query
 * @method LeasingSpecialist findOneOrCreate(PropelPDO $con = null) Return the first LeasingSpecialist matching the query, or a new LeasingSpecialist object populated from the query conditions when no match is found
 *
 * @method LeasingSpecialist findOneByName(string $name) Return the first LeasingSpecialist filtered by the name column
 * @method LeasingSpecialist findOneByEmail(string $email) Return the first LeasingSpecialist filtered by the email column
 * @method LeasingSpecialist findOneByMobile(string $mobile) Return the first LeasingSpecialist filtered by the mobile column
 * @method LeasingSpecialist findOneByLeasingUnit(int $leasing_unit) Return the first LeasingSpecialist filtered by the leasing_unit column
 * @method LeasingSpecialist findOneByStatus(int $status) Return the first LeasingSpecialist filtered by the status column
 *
 * @method array findById(int $id) Return LeasingSpecialist objects filtered by the id column
 * @method array findByName(string $name) Return LeasingSpecialist objects filtered by the name column
 * @method array findByEmail(string $email) Return LeasingSpecialist objects filtered by the email column
 * @method array findByMobile(string $mobile) Return LeasingSpecialist objects filtered by the mobile column
 * @method array findByLeasingUnit(int $leasing_unit) Return LeasingSpecialist objects filtered by the leasing_unit column
 * @method array findByStatus(int $status) Return LeasingSpecialist objects filtered by the status column
 */
abstract class BaseLeasingSpecialistQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingSpecialistQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingSpecialist';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingSpecialistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingSpecialistQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingSpecialistQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingSpecialistQuery) {
            return $criteria;
        }
        $query = new LeasingSpecialistQuery(null, null, $modelAlias);

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
     * @return   LeasingSpecialist|LeasingSpecialist[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingSpecialistPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingSpecialist A model object, or null if the key is not found
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
     * @return                 LeasingSpecialist A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `email`, `mobile`, `leasing_unit`, `status` FROM `leasing_specialist` WHERE `id` = :p0';
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
            $obj = new LeasingSpecialist();
            $obj->hydrate($row);
            LeasingSpecialistPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingSpecialist|LeasingSpecialist[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingSpecialist[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingSpecialistPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingSpecialistPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingSpecialistPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingSpecialistPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistPeer::ID, $id, $comparison);
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
     * @return LeasingSpecialistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingSpecialistPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile('fooValue');   // WHERE mobile = 'fooValue'
     * $query->filterByMobile('%fooValue%'); // WHERE mobile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mobile The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobile)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mobile)) {
                $mobile = str_replace('*', '%', $mobile);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistPeer::MOBILE, $mobile, $comparison);
    }

    /**
     * Filter the query on the leasing_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByLeasingUnit(1234); // WHERE leasing_unit = 1234
     * $query->filterByLeasingUnit(array(12, 34)); // WHERE leasing_unit IN (12, 34)
     * $query->filterByLeasingUnit(array('min' => 12)); // WHERE leasing_unit >= 12
     * $query->filterByLeasingUnit(array('max' => 12)); // WHERE leasing_unit <= 12
     * </code>
     *
     * @param     mixed $leasingUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterByLeasingUnit($leasingUnit = null, $comparison = null)
    {
        if (is_array($leasingUnit)) {
            $useMinMax = false;
            if (isset($leasingUnit['min'])) {
                $this->addUsingAlias(LeasingSpecialistPeer::LEASING_UNIT, $leasingUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leasingUnit['max'])) {
                $this->addUsingAlias(LeasingSpecialistPeer::LEASING_UNIT, $leasingUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistPeer::LEASING_UNIT, $leasingUnit, $comparison);
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
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingSpecialistPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingSpecialistPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingSpecialistPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingAppointmentAssignment object
     *
     * @param   LeasingAppointmentAssignment|PropelObjectCollection $leasingAppointmentAssignment  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingSpecialistQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointmentAssignment($leasingAppointmentAssignment, $comparison = null)
    {
        if ($leasingAppointmentAssignment instanceof LeasingAppointmentAssignment) {
            return $this
                ->addUsingAlias(LeasingSpecialistPeer::ID, $leasingAppointmentAssignment->getLeasingSpecialistId(), $comparison);
        } elseif ($leasingAppointmentAssignment instanceof PropelObjectCollection) {
            return $this
                ->useLeasingAppointmentAssignmentQuery()
                ->filterByPrimaryKeys($leasingAppointmentAssignment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingAppointmentAssignment() only accepts arguments of type LeasingAppointmentAssignment or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingAppointmentAssignment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function joinLeasingAppointmentAssignment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingAppointmentAssignment');

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
            $this->addJoinObject($join, 'LeasingAppointmentAssignment');
        }

        return $this;
    }

    /**
     * Use the LeasingAppointmentAssignment relation LeasingAppointmentAssignment object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingAppointmentAssignmentQuery A secondary query class using the current class as primary query
     */
    public function useLeasingAppointmentAssignmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingAppointmentAssignment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingAppointmentAssignment', '\Leasing\CoreBundle\Model\LeasingAppointmentAssignmentQuery');
    }

    /**
     * Filter the query by a related LeasingBookingAssignment object
     *
     * @param   LeasingBookingAssignment|PropelObjectCollection $leasingBookingAssignment  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingSpecialistQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookingAssignment($leasingBookingAssignment, $comparison = null)
    {
        if ($leasingBookingAssignment instanceof LeasingBookingAssignment) {
            return $this
                ->addUsingAlias(LeasingSpecialistPeer::ID, $leasingBookingAssignment->getLeasingSpecialistId(), $comparison);
        } elseif ($leasingBookingAssignment instanceof PropelObjectCollection) {
            return $this
                ->useLeasingBookingAssignmentQuery()
                ->filterByPrimaryKeys($leasingBookingAssignment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingBookingAssignment() only accepts arguments of type LeasingBookingAssignment or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBookingAssignment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function joinLeasingBookingAssignment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBookingAssignment');

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
            $this->addJoinObject($join, 'LeasingBookingAssignment');
        }

        return $this;
    }

    /**
     * Use the LeasingBookingAssignment relation LeasingBookingAssignment object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBookingAssignmentQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBookingAssignmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBookingAssignment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBookingAssignment', '\Leasing\CoreBundle\Model\LeasingBookingAssignmentQuery');
    }

    /**
     * Filter the query by a related LeasingSpecialistSchedule object
     *
     * @param   LeasingSpecialistSchedule|PropelObjectCollection $leasingSpecialistSchedule  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingSpecialistQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingSpecialistSchedule($leasingSpecialistSchedule, $comparison = null)
    {
        if ($leasingSpecialistSchedule instanceof LeasingSpecialistSchedule) {
            return $this
                ->addUsingAlias(LeasingSpecialistPeer::ID, $leasingSpecialistSchedule->getLeasingSpecialistId(), $comparison);
        } elseif ($leasingSpecialistSchedule instanceof PropelObjectCollection) {
            return $this
                ->useLeasingSpecialistScheduleQuery()
                ->filterByPrimaryKeys($leasingSpecialistSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingSpecialistSchedule() only accepts arguments of type LeasingSpecialistSchedule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingSpecialistSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function joinLeasingSpecialistSchedule($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingSpecialistSchedule');

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
            $this->addJoinObject($join, 'LeasingSpecialistSchedule');
        }

        return $this;
    }

    /**
     * Use the LeasingSpecialistSchedule relation LeasingSpecialistSchedule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingSpecialistScheduleQuery A secondary query class using the current class as primary query
     */
    public function useLeasingSpecialistScheduleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingSpecialistSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingSpecialistSchedule', '\Leasing\CoreBundle\Model\LeasingSpecialistScheduleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingSpecialist $leasingSpecialist Object to remove from the list of results
     *
     * @return LeasingSpecialistQuery The current query, for fluid interface
     */
    public function prune($leasingSpecialist = null)
    {
        if ($leasingSpecialist) {
            $this->addUsingAlias(LeasingSpecialistPeer::ID, $leasingSpecialist->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
