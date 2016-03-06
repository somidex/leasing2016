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
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetails;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsPeer;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsQuery;

/**
 * @method LeasingParkingPaymentDetailsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingParkingPaymentDetailsQuery orderByParkingLeadId($order = Criteria::ASC) Order by the parking_lead_id column
 * @method LeasingParkingPaymentDetailsQuery orderBySlots($order = Criteria::ASC) Order by the slots column
 * @method LeasingParkingPaymentDetailsQuery orderByMonthlyCost($order = Criteria::ASC) Order by the monthly_cost column
 * @method LeasingParkingPaymentDetailsQuery orderByPeriod($order = Criteria::ASC) Order by the period column
 * @method LeasingParkingPaymentDetailsQuery orderByTotalCost($order = Criteria::ASC) Order by the total_cost column
 * @method LeasingParkingPaymentDetailsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingParkingPaymentDetailsQuery groupById() Group by the id column
 * @method LeasingParkingPaymentDetailsQuery groupByParkingLeadId() Group by the parking_lead_id column
 * @method LeasingParkingPaymentDetailsQuery groupBySlots() Group by the slots column
 * @method LeasingParkingPaymentDetailsQuery groupByMonthlyCost() Group by the monthly_cost column
 * @method LeasingParkingPaymentDetailsQuery groupByPeriod() Group by the period column
 * @method LeasingParkingPaymentDetailsQuery groupByTotalCost() Group by the total_cost column
 * @method LeasingParkingPaymentDetailsQuery groupByStatus() Group by the status column
 *
 * @method LeasingParkingPaymentDetailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingParkingPaymentDetailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingParkingPaymentDetailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingParkingPaymentDetailsQuery leftJoinLeasingParkingLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingParkingLeads relation
 * @method LeasingParkingPaymentDetailsQuery rightJoinLeasingParkingLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingParkingLeads relation
 * @method LeasingParkingPaymentDetailsQuery innerJoinLeasingParkingLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingParkingLeads relation
 *
 * @method LeasingParkingPaymentDetails findOne(PropelPDO $con = null) Return the first LeasingParkingPaymentDetails matching the query
 * @method LeasingParkingPaymentDetails findOneOrCreate(PropelPDO $con = null) Return the first LeasingParkingPaymentDetails matching the query, or a new LeasingParkingPaymentDetails object populated from the query conditions when no match is found
 *
 * @method LeasingParkingPaymentDetails findOneByParkingLeadId(int $parking_lead_id) Return the first LeasingParkingPaymentDetails filtered by the parking_lead_id column
 * @method LeasingParkingPaymentDetails findOneBySlots(int $slots) Return the first LeasingParkingPaymentDetails filtered by the slots column
 * @method LeasingParkingPaymentDetails findOneByMonthlyCost(double $monthly_cost) Return the first LeasingParkingPaymentDetails filtered by the monthly_cost column
 * @method LeasingParkingPaymentDetails findOneByPeriod(int $period) Return the first LeasingParkingPaymentDetails filtered by the period column
 * @method LeasingParkingPaymentDetails findOneByTotalCost(double $total_cost) Return the first LeasingParkingPaymentDetails filtered by the total_cost column
 * @method LeasingParkingPaymentDetails findOneByStatus(int $status) Return the first LeasingParkingPaymentDetails filtered by the status column
 *
 * @method array findById(int $id) Return LeasingParkingPaymentDetails objects filtered by the id column
 * @method array findByParkingLeadId(int $parking_lead_id) Return LeasingParkingPaymentDetails objects filtered by the parking_lead_id column
 * @method array findBySlots(int $slots) Return LeasingParkingPaymentDetails objects filtered by the slots column
 * @method array findByMonthlyCost(double $monthly_cost) Return LeasingParkingPaymentDetails objects filtered by the monthly_cost column
 * @method array findByPeriod(int $period) Return LeasingParkingPaymentDetails objects filtered by the period column
 * @method array findByTotalCost(double $total_cost) Return LeasingParkingPaymentDetails objects filtered by the total_cost column
 * @method array findByStatus(int $status) Return LeasingParkingPaymentDetails objects filtered by the status column
 */
abstract class BaseLeasingParkingPaymentDetailsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingParkingPaymentDetailsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingParkingPaymentDetails';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingParkingPaymentDetailsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingParkingPaymentDetailsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingParkingPaymentDetailsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingParkingPaymentDetailsQuery) {
            return $criteria;
        }
        $query = new LeasingParkingPaymentDetailsQuery(null, null, $modelAlias);

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
     * @return   LeasingParkingPaymentDetails|LeasingParkingPaymentDetails[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingParkingPaymentDetailsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingParkingPaymentDetails A model object, or null if the key is not found
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
     * @return                 LeasingParkingPaymentDetails A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `parking_lead_id`, `slots`, `monthly_cost`, `period`, `total_cost`, `status` FROM `parking_payment_details` WHERE `id` = :p0';
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
            $obj = new LeasingParkingPaymentDetails();
            $obj->hydrate($row);
            LeasingParkingPaymentDetailsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingParkingPaymentDetails|LeasingParkingPaymentDetails[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingParkingPaymentDetails[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the parking_lead_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParkingLeadId(1234); // WHERE parking_lead_id = 1234
     * $query->filterByParkingLeadId(array(12, 34)); // WHERE parking_lead_id IN (12, 34)
     * $query->filterByParkingLeadId(array('min' => 12)); // WHERE parking_lead_id >= 12
     * $query->filterByParkingLeadId(array('max' => 12)); // WHERE parking_lead_id <= 12
     * </code>
     *
     * @see       filterByLeasingParkingLeads()
     *
     * @param     mixed $parkingLeadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByParkingLeadId($parkingLeadId = null, $comparison = null)
    {
        if (is_array($parkingLeadId)) {
            $useMinMax = false;
            if (isset($parkingLeadId['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID, $parkingLeadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parkingLeadId['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID, $parkingLeadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID, $parkingLeadId, $comparison);
    }

    /**
     * Filter the query on the slots column
     *
     * Example usage:
     * <code>
     * $query->filterBySlots(1234); // WHERE slots = 1234
     * $query->filterBySlots(array(12, 34)); // WHERE slots IN (12, 34)
     * $query->filterBySlots(array('min' => 12)); // WHERE slots >= 12
     * $query->filterBySlots(array('max' => 12)); // WHERE slots <= 12
     * </code>
     *
     * @param     mixed $slots The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterBySlots($slots = null, $comparison = null)
    {
        if (is_array($slots)) {
            $useMinMax = false;
            if (isset($slots['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::SLOTS, $slots['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($slots['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::SLOTS, $slots['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::SLOTS, $slots, $comparison);
    }

    /**
     * Filter the query on the monthly_cost column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthlyCost(1234); // WHERE monthly_cost = 1234
     * $query->filterByMonthlyCost(array(12, 34)); // WHERE monthly_cost IN (12, 34)
     * $query->filterByMonthlyCost(array('min' => 12)); // WHERE monthly_cost >= 12
     * $query->filterByMonthlyCost(array('max' => 12)); // WHERE monthly_cost <= 12
     * </code>
     *
     * @param     mixed $monthlyCost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByMonthlyCost($monthlyCost = null, $comparison = null)
    {
        if (is_array($monthlyCost)) {
            $useMinMax = false;
            if (isset($monthlyCost['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::MONTHLY_COST, $monthlyCost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($monthlyCost['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::MONTHLY_COST, $monthlyCost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::MONTHLY_COST, $monthlyCost, $comparison);
    }

    /**
     * Filter the query on the period column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriod(1234); // WHERE period = 1234
     * $query->filterByPeriod(array(12, 34)); // WHERE period IN (12, 34)
     * $query->filterByPeriod(array('min' => 12)); // WHERE period >= 12
     * $query->filterByPeriod(array('max' => 12)); // WHERE period <= 12
     * </code>
     *
     * @param     mixed $period The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByPeriod($period = null, $comparison = null)
    {
        if (is_array($period)) {
            $useMinMax = false;
            if (isset($period['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::PERIOD, $period['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($period['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::PERIOD, $period['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::PERIOD, $period, $comparison);
    }

    /**
     * Filter the query on the total_cost column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalCost(1234); // WHERE total_cost = 1234
     * $query->filterByTotalCost(array(12, 34)); // WHERE total_cost IN (12, 34)
     * $query->filterByTotalCost(array('min' => 12)); // WHERE total_cost >= 12
     * $query->filterByTotalCost(array('max' => 12)); // WHERE total_cost <= 12
     * </code>
     *
     * @param     mixed $totalCost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByTotalCost($totalCost = null, $comparison = null)
    {
        if (is_array($totalCost)) {
            $useMinMax = false;
            if (isset($totalCost['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::TOTAL_COST, $totalCost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalCost['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::TOTAL_COST, $totalCost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::TOTAL_COST, $totalCost, $comparison);
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
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingParkingLeads object
     *
     * @param   LeasingParkingLeads|PropelObjectCollection $leasingParkingLeads The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingParkingLeads($leasingParkingLeads, $comparison = null)
    {
        if ($leasingParkingLeads instanceof LeasingParkingLeads) {
            return $this
                ->addUsingAlias(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID, $leasingParkingLeads->getId(), $comparison);
        } elseif ($leasingParkingLeads instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID, $leasingParkingLeads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingParkingLeads() only accepts arguments of type LeasingParkingLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingParkingLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function joinLeasingParkingLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingParkingLeads');

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
            $this->addJoinObject($join, 'LeasingParkingLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingParkingLeads relation LeasingParkingLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingParkingLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingParkingLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingParkingLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingParkingLeads', '\Leasing\CoreBundle\Model\LeasingParkingLeadsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingParkingPaymentDetails $leasingParkingPaymentDetails Object to remove from the list of results
     *
     * @return LeasingParkingPaymentDetailsQuery The current query, for fluid interface
     */
    public function prune($leasingParkingPaymentDetails = null)
    {
        if ($leasingParkingPaymentDetails) {
            $this->addUsingAlias(LeasingParkingPaymentDetailsPeer::ID, $leasingParkingPaymentDetails->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
