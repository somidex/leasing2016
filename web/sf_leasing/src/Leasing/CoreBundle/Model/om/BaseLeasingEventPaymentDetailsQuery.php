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
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetails;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetailsPeer;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetailsQuery;

/**
 * @method LeasingEventPaymentDetailsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingEventPaymentDetailsQuery orderByEventBookingsId($order = Criteria::ASC) Order by the event_bookings_id column
 * @method LeasingEventPaymentDetailsQuery orderByRentalCost($order = Criteria::ASC) Order by the rental_cost column
 * @method LeasingEventPaymentDetailsQuery orderByReservationFee($order = Criteria::ASC) Order by the reservation_fee column
 * @method LeasingEventPaymentDetailsQuery orderBySecurityDeposit($order = Criteria::ASC) Order by the security_deposit column
 * @method LeasingEventPaymentDetailsQuery orderByPayable($order = Criteria::ASC) Order by the payable column
 * @method LeasingEventPaymentDetailsQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 * @method LeasingEventPaymentDetailsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingEventPaymentDetailsQuery groupById() Group by the id column
 * @method LeasingEventPaymentDetailsQuery groupByEventBookingsId() Group by the event_bookings_id column
 * @method LeasingEventPaymentDetailsQuery groupByRentalCost() Group by the rental_cost column
 * @method LeasingEventPaymentDetailsQuery groupByReservationFee() Group by the reservation_fee column
 * @method LeasingEventPaymentDetailsQuery groupBySecurityDeposit() Group by the security_deposit column
 * @method LeasingEventPaymentDetailsQuery groupByPayable() Group by the payable column
 * @method LeasingEventPaymentDetailsQuery groupByBalance() Group by the balance column
 * @method LeasingEventPaymentDetailsQuery groupByStatus() Group by the status column
 *
 * @method LeasingEventPaymentDetailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingEventPaymentDetailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingEventPaymentDetailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingEventPaymentDetailsQuery leftJoinLeasingEventBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventBookings relation
 * @method LeasingEventPaymentDetailsQuery rightJoinLeasingEventBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventBookings relation
 * @method LeasingEventPaymentDetailsQuery innerJoinLeasingEventBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventBookings relation
 *
 * @method LeasingEventPaymentDetails findOne(PropelPDO $con = null) Return the first LeasingEventPaymentDetails matching the query
 * @method LeasingEventPaymentDetails findOneOrCreate(PropelPDO $con = null) Return the first LeasingEventPaymentDetails matching the query, or a new LeasingEventPaymentDetails object populated from the query conditions when no match is found
 *
 * @method LeasingEventPaymentDetails findOneByEventBookingsId(int $event_bookings_id) Return the first LeasingEventPaymentDetails filtered by the event_bookings_id column
 * @method LeasingEventPaymentDetails findOneByRentalCost(double $rental_cost) Return the first LeasingEventPaymentDetails filtered by the rental_cost column
 * @method LeasingEventPaymentDetails findOneByReservationFee(double $reservation_fee) Return the first LeasingEventPaymentDetails filtered by the reservation_fee column
 * @method LeasingEventPaymentDetails findOneBySecurityDeposit(double $security_deposit) Return the first LeasingEventPaymentDetails filtered by the security_deposit column
 * @method LeasingEventPaymentDetails findOneByPayable(double $payable) Return the first LeasingEventPaymentDetails filtered by the payable column
 * @method LeasingEventPaymentDetails findOneByBalance(double $balance) Return the first LeasingEventPaymentDetails filtered by the balance column
 * @method LeasingEventPaymentDetails findOneByStatus(int $status) Return the first LeasingEventPaymentDetails filtered by the status column
 *
 * @method array findById(int $id) Return LeasingEventPaymentDetails objects filtered by the id column
 * @method array findByEventBookingsId(int $event_bookings_id) Return LeasingEventPaymentDetails objects filtered by the event_bookings_id column
 * @method array findByRentalCost(double $rental_cost) Return LeasingEventPaymentDetails objects filtered by the rental_cost column
 * @method array findByReservationFee(double $reservation_fee) Return LeasingEventPaymentDetails objects filtered by the reservation_fee column
 * @method array findBySecurityDeposit(double $security_deposit) Return LeasingEventPaymentDetails objects filtered by the security_deposit column
 * @method array findByPayable(double $payable) Return LeasingEventPaymentDetails objects filtered by the payable column
 * @method array findByBalance(double $balance) Return LeasingEventPaymentDetails objects filtered by the balance column
 * @method array findByStatus(int $status) Return LeasingEventPaymentDetails objects filtered by the status column
 */
abstract class BaseLeasingEventPaymentDetailsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingEventPaymentDetailsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingEventPaymentDetails';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingEventPaymentDetailsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingEventPaymentDetailsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingEventPaymentDetailsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingEventPaymentDetailsQuery) {
            return $criteria;
        }
        $query = new LeasingEventPaymentDetailsQuery(null, null, $modelAlias);

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
     * @return   LeasingEventPaymentDetails|LeasingEventPaymentDetails[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingEventPaymentDetailsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingEventPaymentDetails A model object, or null if the key is not found
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
     * @return                 LeasingEventPaymentDetails A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `event_bookings_id`, `rental_cost`, `reservation_fee`, `security_deposit`, `payable`, `balance`, `status` FROM `event_payment_details` WHERE `id` = :p0';
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
            $obj = new LeasingEventPaymentDetails();
            $obj->hydrate($row);
            LeasingEventPaymentDetailsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingEventPaymentDetails|LeasingEventPaymentDetails[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingEventPaymentDetails[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the event_bookings_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventBookingsId(1234); // WHERE event_bookings_id = 1234
     * $query->filterByEventBookingsId(array(12, 34)); // WHERE event_bookings_id IN (12, 34)
     * $query->filterByEventBookingsId(array('min' => 12)); // WHERE event_bookings_id >= 12
     * $query->filterByEventBookingsId(array('max' => 12)); // WHERE event_bookings_id <= 12
     * </code>
     *
     * @see       filterByLeasingEventBookings()
     *
     * @param     mixed $eventBookingsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByEventBookingsId($eventBookingsId = null, $comparison = null)
    {
        if (is_array($eventBookingsId)) {
            $useMinMax = false;
            if (isset($eventBookingsId['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID, $eventBookingsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventBookingsId['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID, $eventBookingsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID, $eventBookingsId, $comparison);
    }

    /**
     * Filter the query on the rental_cost column
     *
     * Example usage:
     * <code>
     * $query->filterByRentalCost(1234); // WHERE rental_cost = 1234
     * $query->filterByRentalCost(array(12, 34)); // WHERE rental_cost IN (12, 34)
     * $query->filterByRentalCost(array('min' => 12)); // WHERE rental_cost >= 12
     * $query->filterByRentalCost(array('max' => 12)); // WHERE rental_cost <= 12
     * </code>
     *
     * @param     mixed $rentalCost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByRentalCost($rentalCost = null, $comparison = null)
    {
        if (is_array($rentalCost)) {
            $useMinMax = false;
            if (isset($rentalCost['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::RENTAL_COST, $rentalCost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rentalCost['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::RENTAL_COST, $rentalCost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::RENTAL_COST, $rentalCost, $comparison);
    }

    /**
     * Filter the query on the reservation_fee column
     *
     * Example usage:
     * <code>
     * $query->filterByReservationFee(1234); // WHERE reservation_fee = 1234
     * $query->filterByReservationFee(array(12, 34)); // WHERE reservation_fee IN (12, 34)
     * $query->filterByReservationFee(array('min' => 12)); // WHERE reservation_fee >= 12
     * $query->filterByReservationFee(array('max' => 12)); // WHERE reservation_fee <= 12
     * </code>
     *
     * @param     mixed $reservationFee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByReservationFee($reservationFee = null, $comparison = null)
    {
        if (is_array($reservationFee)) {
            $useMinMax = false;
            if (isset($reservationFee['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::RESERVATION_FEE, $reservationFee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reservationFee['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::RESERVATION_FEE, $reservationFee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::RESERVATION_FEE, $reservationFee, $comparison);
    }

    /**
     * Filter the query on the security_deposit column
     *
     * Example usage:
     * <code>
     * $query->filterBySecurityDeposit(1234); // WHERE security_deposit = 1234
     * $query->filterBySecurityDeposit(array(12, 34)); // WHERE security_deposit IN (12, 34)
     * $query->filterBySecurityDeposit(array('min' => 12)); // WHERE security_deposit >= 12
     * $query->filterBySecurityDeposit(array('max' => 12)); // WHERE security_deposit <= 12
     * </code>
     *
     * @param     mixed $securityDeposit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterBySecurityDeposit($securityDeposit = null, $comparison = null)
    {
        if (is_array($securityDeposit)) {
            $useMinMax = false;
            if (isset($securityDeposit['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT, $securityDeposit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($securityDeposit['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT, $securityDeposit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT, $securityDeposit, $comparison);
    }

    /**
     * Filter the query on the payable column
     *
     * Example usage:
     * <code>
     * $query->filterByPayable(1234); // WHERE payable = 1234
     * $query->filterByPayable(array(12, 34)); // WHERE payable IN (12, 34)
     * $query->filterByPayable(array('min' => 12)); // WHERE payable >= 12
     * $query->filterByPayable(array('max' => 12)); // WHERE payable <= 12
     * </code>
     *
     * @param     mixed $payable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByPayable($payable = null, $comparison = null)
    {
        if (is_array($payable)) {
            $useMinMax = false;
            if (isset($payable['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::PAYABLE, $payable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($payable['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::PAYABLE, $payable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::PAYABLE, $payable, $comparison);
    }

    /**
     * Filter the query on the balance column
     *
     * Example usage:
     * <code>
     * $query->filterByBalance(1234); // WHERE balance = 1234
     * $query->filterByBalance(array(12, 34)); // WHERE balance IN (12, 34)
     * $query->filterByBalance(array('min' => 12)); // WHERE balance >= 12
     * $query->filterByBalance(array('max' => 12)); // WHERE balance <= 12
     * </code>
     *
     * @param     mixed $balance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByBalance($balance = null, $comparison = null)
    {
        if (is_array($balance)) {
            $useMinMax = false;
            if (isset($balance['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($balance['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::BALANCE, $balance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::BALANCE, $balance, $comparison);
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
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingEventPaymentDetailsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPaymentDetailsPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingEventBookings object
     *
     * @param   LeasingEventBookings|PropelObjectCollection $leasingEventBookings The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventPaymentDetailsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventBookings($leasingEventBookings, $comparison = null)
    {
        if ($leasingEventBookings instanceof LeasingEventBookings) {
            return $this
                ->addUsingAlias(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID, $leasingEventBookings->getId(), $comparison);
        } elseif ($leasingEventBookings instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID, $leasingEventBookings->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingEventBookings() only accepts arguments of type LeasingEventBookings or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingEventBookings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function joinLeasingEventBookings($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingEventBookings');

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
            $this->addJoinObject($join, 'LeasingEventBookings');
        }

        return $this;
    }

    /**
     * Use the LeasingEventBookings relation LeasingEventBookings object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingEventBookingsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingEventBookingsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingEventBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingEventBookings', '\Leasing\CoreBundle\Model\LeasingEventBookingsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingEventPaymentDetails $leasingEventPaymentDetails Object to remove from the list of results
     *
     * @return LeasingEventPaymentDetailsQuery The current query, for fluid interface
     */
    public function prune($leasingEventPaymentDetails = null)
    {
        if ($leasingEventPaymentDetails) {
            $this->addUsingAlias(LeasingEventPaymentDetailsPeer::ID, $leasingEventPaymentDetails->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
