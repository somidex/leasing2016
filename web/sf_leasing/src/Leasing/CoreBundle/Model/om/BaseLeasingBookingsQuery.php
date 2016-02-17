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
use Leasing\CoreBundle\Model\LeasingBookingLeads;
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingBookingsPeer;
use Leasing\CoreBundle\Model\LeasingBookingsQuery;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingUnit;

/**
 * @method LeasingBookingsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingBookingsQuery orderByBookingLeadsId($order = Criteria::ASC) Order by the booking_leads_id column
 * @method LeasingBookingsQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method LeasingBookingsQuery orderByCheckIn($order = Criteria::ASC) Order by the check_in column
 * @method LeasingBookingsQuery orderByCheckOut($order = Criteria::ASC) Order by the check_out column
 * @method LeasingBookingsQuery orderByConfirmationCode($order = Criteria::ASC) Order by the confirmation_code column
 * @method LeasingBookingsQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method LeasingBookingsQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method LeasingBookingsQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method LeasingBookingsQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method LeasingBookingsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingBookingsQuery orderByPrevStatus($order = Criteria::ASC) Order by the prev_status column
 * @method LeasingBookingsQuery orderByProcessing($order = Criteria::ASC) Order by the processing column
 * @method LeasingBookingsQuery orderByProcessedBy($order = Criteria::ASC) Order by the processed_by column
 *
 * @method LeasingBookingsQuery groupById() Group by the id column
 * @method LeasingBookingsQuery groupByBookingLeadsId() Group by the booking_leads_id column
 * @method LeasingBookingsQuery groupByUnitId() Group by the unit_id column
 * @method LeasingBookingsQuery groupByCheckIn() Group by the check_in column
 * @method LeasingBookingsQuery groupByCheckOut() Group by the check_out column
 * @method LeasingBookingsQuery groupByConfirmationCode() Group by the confirmation_code column
 * @method LeasingBookingsQuery groupByStartDate() Group by the start_date column
 * @method LeasingBookingsQuery groupByEndDate() Group by the end_date column
 * @method LeasingBookingsQuery groupByNotes() Group by the notes column
 * @method LeasingBookingsQuery groupByDateAdded() Group by the date_added column
 * @method LeasingBookingsQuery groupByStatus() Group by the status column
 * @method LeasingBookingsQuery groupByPrevStatus() Group by the prev_status column
 * @method LeasingBookingsQuery groupByProcessing() Group by the processing column
 * @method LeasingBookingsQuery groupByProcessedBy() Group by the processed_by column
 *
 * @method LeasingBookingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingBookingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingBookingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingBookingsQuery leftJoinLeasingBookingLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookingLeads relation
 * @method LeasingBookingsQuery rightJoinLeasingBookingLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookingLeads relation
 * @method LeasingBookingsQuery innerJoinLeasingBookingLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookingLeads relation
 *
 * @method LeasingBookingsQuery leftJoinLeasingUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingBookingsQuery rightJoinLeasingUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingBookingsQuery innerJoinLeasingUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnit relation
 *
 * @method LeasingBookingsQuery leftJoinLeasingBookingAssignment($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookingAssignment relation
 * @method LeasingBookingsQuery rightJoinLeasingBookingAssignment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookingAssignment relation
 * @method LeasingBookingsQuery innerJoinLeasingBookingAssignment($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookingAssignment relation
 *
 * @method LeasingBookingsQuery leftJoinLeasingPaymentTransactions($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingBookingsQuery rightJoinLeasingPaymentTransactions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingBookingsQuery innerJoinLeasingPaymentTransactions($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingPaymentTransactions relation
 *
 * @method LeasingBookings findOne(PropelPDO $con = null) Return the first LeasingBookings matching the query
 * @method LeasingBookings findOneOrCreate(PropelPDO $con = null) Return the first LeasingBookings matching the query, or a new LeasingBookings object populated from the query conditions when no match is found
 *
 * @method LeasingBookings findOneByBookingLeadsId(int $booking_leads_id) Return the first LeasingBookings filtered by the booking_leads_id column
 * @method LeasingBookings findOneByUnitId(int $unit_id) Return the first LeasingBookings filtered by the unit_id column
 * @method LeasingBookings findOneByCheckIn(string $check_in) Return the first LeasingBookings filtered by the check_in column
 * @method LeasingBookings findOneByCheckOut(string $check_out) Return the first LeasingBookings filtered by the check_out column
 * @method LeasingBookings findOneByConfirmationCode(string $confirmation_code) Return the first LeasingBookings filtered by the confirmation_code column
 * @method LeasingBookings findOneByStartDate(string $start_date) Return the first LeasingBookings filtered by the start_date column
 * @method LeasingBookings findOneByEndDate(string $end_date) Return the first LeasingBookings filtered by the end_date column
 * @method LeasingBookings findOneByNotes(string $notes) Return the first LeasingBookings filtered by the notes column
 * @method LeasingBookings findOneByDateAdded(string $date_added) Return the first LeasingBookings filtered by the date_added column
 * @method LeasingBookings findOneByStatus(int $status) Return the first LeasingBookings filtered by the status column
 * @method LeasingBookings findOneByPrevStatus(int $prev_status) Return the first LeasingBookings filtered by the prev_status column
 * @method LeasingBookings findOneByProcessing(int $processing) Return the first LeasingBookings filtered by the processing column
 * @method LeasingBookings findOneByProcessedBy(string $processed_by) Return the first LeasingBookings filtered by the processed_by column
 *
 * @method array findById(int $id) Return LeasingBookings objects filtered by the id column
 * @method array findByBookingLeadsId(int $booking_leads_id) Return LeasingBookings objects filtered by the booking_leads_id column
 * @method array findByUnitId(int $unit_id) Return LeasingBookings objects filtered by the unit_id column
 * @method array findByCheckIn(string $check_in) Return LeasingBookings objects filtered by the check_in column
 * @method array findByCheckOut(string $check_out) Return LeasingBookings objects filtered by the check_out column
 * @method array findByConfirmationCode(string $confirmation_code) Return LeasingBookings objects filtered by the confirmation_code column
 * @method array findByStartDate(string $start_date) Return LeasingBookings objects filtered by the start_date column
 * @method array findByEndDate(string $end_date) Return LeasingBookings objects filtered by the end_date column
 * @method array findByNotes(string $notes) Return LeasingBookings objects filtered by the notes column
 * @method array findByDateAdded(string $date_added) Return LeasingBookings objects filtered by the date_added column
 * @method array findByStatus(int $status) Return LeasingBookings objects filtered by the status column
 * @method array findByPrevStatus(int $prev_status) Return LeasingBookings objects filtered by the prev_status column
 * @method array findByProcessing(int $processing) Return LeasingBookings objects filtered by the processing column
 * @method array findByProcessedBy(string $processed_by) Return LeasingBookings objects filtered by the processed_by column
 */
abstract class BaseLeasingBookingsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingBookingsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingBookings';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingBookingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingBookingsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingBookingsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingBookingsQuery) {
            return $criteria;
        }
        $query = new LeasingBookingsQuery(null, null, $modelAlias);

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
     * @return   LeasingBookings|LeasingBookings[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingBookingsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingBookings A model object, or null if the key is not found
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
     * @return                 LeasingBookings A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `booking_leads_id`, `unit_id`, `check_in`, `check_out`, `confirmation_code`, `start_date`, `end_date`, `notes`, `date_added`, `status`, `prev_status`, `processing`, `processed_by` FROM `bookings` WHERE `id` = :p0';
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
            $obj = new LeasingBookings();
            $obj->hydrate($row);
            LeasingBookingsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingBookings|LeasingBookings[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingBookings[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingBookingsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingBookingsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingBookingsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingBookingsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the booking_leads_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingLeadsId(1234); // WHERE booking_leads_id = 1234
     * $query->filterByBookingLeadsId(array(12, 34)); // WHERE booking_leads_id IN (12, 34)
     * $query->filterByBookingLeadsId(array('min' => 12)); // WHERE booking_leads_id >= 12
     * $query->filterByBookingLeadsId(array('max' => 12)); // WHERE booking_leads_id <= 12
     * </code>
     *
     * @see       filterByLeasingBookingLeads()
     *
     * @param     mixed $bookingLeadsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByBookingLeadsId($bookingLeadsId = null, $comparison = null)
    {
        if (is_array($bookingLeadsId)) {
            $useMinMax = false;
            if (isset($bookingLeadsId['min'])) {
                $this->addUsingAlias(LeasingBookingsPeer::BOOKING_LEADS_ID, $bookingLeadsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingLeadsId['max'])) {
                $this->addUsingAlias(LeasingBookingsPeer::BOOKING_LEADS_ID, $bookingLeadsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::BOOKING_LEADS_ID, $bookingLeadsId, $comparison);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(LeasingBookingsPeer::UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(LeasingBookingsPeer::UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::UNIT_ID, $unitId, $comparison);
    }

    /**
     * Filter the query on the check_in column
     *
     * Example usage:
     * <code>
     * $query->filterByCheckIn('fooValue');   // WHERE check_in = 'fooValue'
     * $query->filterByCheckIn('%fooValue%'); // WHERE check_in LIKE '%fooValue%'
     * </code>
     *
     * @param     string $checkIn The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByCheckIn($checkIn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($checkIn)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $checkIn)) {
                $checkIn = str_replace('*', '%', $checkIn);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::CHECK_IN, $checkIn, $comparison);
    }

    /**
     * Filter the query on the check_out column
     *
     * Example usage:
     * <code>
     * $query->filterByCheckOut('fooValue');   // WHERE check_out = 'fooValue'
     * $query->filterByCheckOut('%fooValue%'); // WHERE check_out LIKE '%fooValue%'
     * </code>
     *
     * @param     string $checkOut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByCheckOut($checkOut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($checkOut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $checkOut)) {
                $checkOut = str_replace('*', '%', $checkOut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::CHECK_OUT, $checkOut, $comparison);
    }

    /**
     * Filter the query on the confirmation_code column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmationCode('fooValue');   // WHERE confirmation_code = 'fooValue'
     * $query->filterByConfirmationCode('%fooValue%'); // WHERE confirmation_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $confirmationCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByConfirmationCode($confirmationCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($confirmationCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $confirmationCode)) {
                $confirmationCode = str_replace('*', '%', $confirmationCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::CONFIRMATION_CODE, $confirmationCode, $comparison);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingBookingsPeer::START_DATE, $startDate, $comparison);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingBookingsPeer::END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%'); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $notes)) {
                $notes = str_replace('*', '%', $notes);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the date_added column
     *
     * Example usage:
     * <code>
     * $query->filterByDateAdded('fooValue');   // WHERE date_added = 'fooValue'
     * $query->filterByDateAdded('%fooValue%'); // WHERE date_added LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dateAdded The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByDateAdded($dateAdded = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateAdded)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dateAdded)) {
                $dateAdded = str_replace('*', '%', $dateAdded);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::DATE_ADDED, $dateAdded, $comparison);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingBookingsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingBookingsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the prev_status column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevStatus(1234); // WHERE prev_status = 1234
     * $query->filterByPrevStatus(array(12, 34)); // WHERE prev_status IN (12, 34)
     * $query->filterByPrevStatus(array('min' => 12)); // WHERE prev_status >= 12
     * $query->filterByPrevStatus(array('max' => 12)); // WHERE prev_status <= 12
     * </code>
     *
     * @param     mixed $prevStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByPrevStatus($prevStatus = null, $comparison = null)
    {
        if (is_array($prevStatus)) {
            $useMinMax = false;
            if (isset($prevStatus['min'])) {
                $this->addUsingAlias(LeasingBookingsPeer::PREV_STATUS, $prevStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevStatus['max'])) {
                $this->addUsingAlias(LeasingBookingsPeer::PREV_STATUS, $prevStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::PREV_STATUS, $prevStatus, $comparison);
    }

    /**
     * Filter the query on the processing column
     *
     * Example usage:
     * <code>
     * $query->filterByProcessing(1234); // WHERE processing = 1234
     * $query->filterByProcessing(array(12, 34)); // WHERE processing IN (12, 34)
     * $query->filterByProcessing(array('min' => 12)); // WHERE processing >= 12
     * $query->filterByProcessing(array('max' => 12)); // WHERE processing <= 12
     * </code>
     *
     * @param     mixed $processing The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByProcessing($processing = null, $comparison = null)
    {
        if (is_array($processing)) {
            $useMinMax = false;
            if (isset($processing['min'])) {
                $this->addUsingAlias(LeasingBookingsPeer::PROCESSING, $processing['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($processing['max'])) {
                $this->addUsingAlias(LeasingBookingsPeer::PROCESSING, $processing['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::PROCESSING, $processing, $comparison);
    }

    /**
     * Filter the query on the processed_by column
     *
     * Example usage:
     * <code>
     * $query->filterByProcessedBy('fooValue');   // WHERE processed_by = 'fooValue'
     * $query->filterByProcessedBy('%fooValue%'); // WHERE processed_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $processedBy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function filterByProcessedBy($processedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($processedBy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $processedBy)) {
                $processedBy = str_replace('*', '%', $processedBy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBookingsPeer::PROCESSED_BY, $processedBy, $comparison);
    }

    /**
     * Filter the query by a related LeasingBookingLeads object
     *
     * @param   LeasingBookingLeads|PropelObjectCollection $leasingBookingLeads The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookingLeads($leasingBookingLeads, $comparison = null)
    {
        if ($leasingBookingLeads instanceof LeasingBookingLeads) {
            return $this
                ->addUsingAlias(LeasingBookingsPeer::BOOKING_LEADS_ID, $leasingBookingLeads->getId(), $comparison);
        } elseif ($leasingBookingLeads instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingBookingsPeer::BOOKING_LEADS_ID, $leasingBookingLeads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingBookingLeads() only accepts arguments of type LeasingBookingLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBookingLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function joinLeasingBookingLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBookingLeads');

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
            $this->addJoinObject($join, 'LeasingBookingLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingBookingLeads relation LeasingBookingLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBookingLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBookingLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBookingLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBookingLeads', '\Leasing\CoreBundle\Model\LeasingBookingLeadsQuery');
    }

    /**
     * Filter the query by a related LeasingUnit object
     *
     * @param   LeasingUnit|PropelObjectCollection $leasingUnit The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnit($leasingUnit, $comparison = null)
    {
        if ($leasingUnit instanceof LeasingUnit) {
            return $this
                ->addUsingAlias(LeasingBookingsPeer::UNIT_ID, $leasingUnit->getId(), $comparison);
        } elseif ($leasingUnit instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingBookingsPeer::UNIT_ID, $leasingUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingBookingAssignment object
     *
     * @param   LeasingBookingAssignment|PropelObjectCollection $leasingBookingAssignment  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookingAssignment($leasingBookingAssignment, $comparison = null)
    {
        if ($leasingBookingAssignment instanceof LeasingBookingAssignment) {
            return $this
                ->addUsingAlias(LeasingBookingsPeer::ID, $leasingBookingAssignment->getBookingsId(), $comparison);
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
     * @return LeasingBookingsQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingPaymentTransactions object
     *
     * @param   LeasingPaymentTransactions|PropelObjectCollection $leasingPaymentTransactions  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingPaymentTransactions($leasingPaymentTransactions, $comparison = null)
    {
        if ($leasingPaymentTransactions instanceof LeasingPaymentTransactions) {
            return $this
                ->addUsingAlias(LeasingBookingsPeer::ID, $leasingPaymentTransactions->getBookingsId(), $comparison);
        } elseif ($leasingPaymentTransactions instanceof PropelObjectCollection) {
            return $this
                ->useLeasingPaymentTransactionsQuery()
                ->filterByPrimaryKeys($leasingPaymentTransactions->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingPaymentTransactions() only accepts arguments of type LeasingPaymentTransactions or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingPaymentTransactions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function joinLeasingPaymentTransactions($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingPaymentTransactions');

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
            $this->addJoinObject($join, 'LeasingPaymentTransactions');
        }

        return $this;
    }

    /**
     * Use the LeasingPaymentTransactions relation LeasingPaymentTransactions object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingPaymentTransactionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingPaymentTransactions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingPaymentTransactions', '\Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingBookings $leasingBookings Object to remove from the list of results
     *
     * @return LeasingBookingsQuery The current query, for fluid interface
     */
    public function prune($leasingBookings = null)
    {
        if ($leasingBookings) {
            $this->addUsingAlias(LeasingBookingsPeer::ID, $leasingBookings->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
