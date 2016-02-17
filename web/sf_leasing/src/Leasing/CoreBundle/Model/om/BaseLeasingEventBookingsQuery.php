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
use Leasing\CoreBundle\Model\LeasingEventBookingsPeer;
use Leasing\CoreBundle\Model\LeasingEventBookingsQuery;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetails;
use Leasing\CoreBundle\Model\LeasingEventPlace;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;

/**
 * @method LeasingEventBookingsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingEventBookingsQuery orderByApplicationNumber($order = Criteria::ASC) Order by the application_number column
 * @method LeasingEventBookingsQuery orderByEventPlaceId($order = Criteria::ASC) Order by the event_place_id column
 * @method LeasingEventBookingsQuery orderByEventPlaceSpecific($order = Criteria::ASC) Order by the event_place_specific column
 * @method LeasingEventBookingsQuery orderByEventLeadsId($order = Criteria::ASC) Order by the event_leads_id column
 * @method LeasingEventBookingsQuery orderByEventDate($order = Criteria::ASC) Order by the event_date column
 * @method LeasingEventBookingsQuery orderByEventStartTime($order = Criteria::ASC) Order by the event_start_time column
 * @method LeasingEventBookingsQuery orderByEventEndTime($order = Criteria::ASC) Order by the event_end_time column
 * @method LeasingEventBookingsQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method LeasingEventBookingsQuery orderByFirstHeard($order = Criteria::ASC) Order by the first_heard column
 * @method LeasingEventBookingsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingEventBookingsQuery orderByPrevStatus($order = Criteria::ASC) Order by the prev_status column
 * @method LeasingEventBookingsQuery orderByProcessing($order = Criteria::ASC) Order by the processing column
 * @method LeasingEventBookingsQuery orderByProcessedBy($order = Criteria::ASC) Order by the processed_by column
 *
 * @method LeasingEventBookingsQuery groupById() Group by the id column
 * @method LeasingEventBookingsQuery groupByApplicationNumber() Group by the application_number column
 * @method LeasingEventBookingsQuery groupByEventPlaceId() Group by the event_place_id column
 * @method LeasingEventBookingsQuery groupByEventPlaceSpecific() Group by the event_place_specific column
 * @method LeasingEventBookingsQuery groupByEventLeadsId() Group by the event_leads_id column
 * @method LeasingEventBookingsQuery groupByEventDate() Group by the event_date column
 * @method LeasingEventBookingsQuery groupByEventStartTime() Group by the event_start_time column
 * @method LeasingEventBookingsQuery groupByEventEndTime() Group by the event_end_time column
 * @method LeasingEventBookingsQuery groupByDateAdded() Group by the date_added column
 * @method LeasingEventBookingsQuery groupByFirstHeard() Group by the first_heard column
 * @method LeasingEventBookingsQuery groupByStatus() Group by the status column
 * @method LeasingEventBookingsQuery groupByPrevStatus() Group by the prev_status column
 * @method LeasingEventBookingsQuery groupByProcessing() Group by the processing column
 * @method LeasingEventBookingsQuery groupByProcessedBy() Group by the processed_by column
 *
 * @method LeasingEventBookingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingEventBookingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingEventBookingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingEventBookingsQuery leftJoinLeasingEventPlace($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventPlace relation
 * @method LeasingEventBookingsQuery rightJoinLeasingEventPlace($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventPlace relation
 * @method LeasingEventBookingsQuery innerJoinLeasingEventPlace($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventPlace relation
 *
 * @method LeasingEventBookingsQuery leftJoinLeasingEventLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventLeads relation
 * @method LeasingEventBookingsQuery rightJoinLeasingEventLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventLeads relation
 * @method LeasingEventBookingsQuery innerJoinLeasingEventLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventLeads relation
 *
 * @method LeasingEventBookingsQuery leftJoinLeasingEventPaymentDetails($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventPaymentDetails relation
 * @method LeasingEventBookingsQuery rightJoinLeasingEventPaymentDetails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventPaymentDetails relation
 * @method LeasingEventBookingsQuery innerJoinLeasingEventPaymentDetails($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventPaymentDetails relation
 *
 * @method LeasingEventBookingsQuery leftJoinLeasingPaymentTransactions($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingEventBookingsQuery rightJoinLeasingPaymentTransactions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingEventBookingsQuery innerJoinLeasingPaymentTransactions($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingPaymentTransactions relation
 *
 * @method LeasingEventBookings findOne(PropelPDO $con = null) Return the first LeasingEventBookings matching the query
 * @method LeasingEventBookings findOneOrCreate(PropelPDO $con = null) Return the first LeasingEventBookings matching the query, or a new LeasingEventBookings object populated from the query conditions when no match is found
 *
 * @method LeasingEventBookings findOneByApplicationNumber(string $application_number) Return the first LeasingEventBookings filtered by the application_number column
 * @method LeasingEventBookings findOneByEventPlaceId(int $event_place_id) Return the first LeasingEventBookings filtered by the event_place_id column
 * @method LeasingEventBookings findOneByEventPlaceSpecific(string $event_place_specific) Return the first LeasingEventBookings filtered by the event_place_specific column
 * @method LeasingEventBookings findOneByEventLeadsId(int $event_leads_id) Return the first LeasingEventBookings filtered by the event_leads_id column
 * @method LeasingEventBookings findOneByEventDate(string $event_date) Return the first LeasingEventBookings filtered by the event_date column
 * @method LeasingEventBookings findOneByEventStartTime(string $event_start_time) Return the first LeasingEventBookings filtered by the event_start_time column
 * @method LeasingEventBookings findOneByEventEndTime(string $event_end_time) Return the first LeasingEventBookings filtered by the event_end_time column
 * @method LeasingEventBookings findOneByDateAdded(string $date_added) Return the first LeasingEventBookings filtered by the date_added column
 * @method LeasingEventBookings findOneByFirstHeard(string $first_heard) Return the first LeasingEventBookings filtered by the first_heard column
 * @method LeasingEventBookings findOneByStatus(int $status) Return the first LeasingEventBookings filtered by the status column
 * @method LeasingEventBookings findOneByPrevStatus(int $prev_status) Return the first LeasingEventBookings filtered by the prev_status column
 * @method LeasingEventBookings findOneByProcessing(int $processing) Return the first LeasingEventBookings filtered by the processing column
 * @method LeasingEventBookings findOneByProcessedBy(string $processed_by) Return the first LeasingEventBookings filtered by the processed_by column
 *
 * @method array findById(int $id) Return LeasingEventBookings objects filtered by the id column
 * @method array findByApplicationNumber(string $application_number) Return LeasingEventBookings objects filtered by the application_number column
 * @method array findByEventPlaceId(int $event_place_id) Return LeasingEventBookings objects filtered by the event_place_id column
 * @method array findByEventPlaceSpecific(string $event_place_specific) Return LeasingEventBookings objects filtered by the event_place_specific column
 * @method array findByEventLeadsId(int $event_leads_id) Return LeasingEventBookings objects filtered by the event_leads_id column
 * @method array findByEventDate(string $event_date) Return LeasingEventBookings objects filtered by the event_date column
 * @method array findByEventStartTime(string $event_start_time) Return LeasingEventBookings objects filtered by the event_start_time column
 * @method array findByEventEndTime(string $event_end_time) Return LeasingEventBookings objects filtered by the event_end_time column
 * @method array findByDateAdded(string $date_added) Return LeasingEventBookings objects filtered by the date_added column
 * @method array findByFirstHeard(string $first_heard) Return LeasingEventBookings objects filtered by the first_heard column
 * @method array findByStatus(int $status) Return LeasingEventBookings objects filtered by the status column
 * @method array findByPrevStatus(int $prev_status) Return LeasingEventBookings objects filtered by the prev_status column
 * @method array findByProcessing(int $processing) Return LeasingEventBookings objects filtered by the processing column
 * @method array findByProcessedBy(string $processed_by) Return LeasingEventBookings objects filtered by the processed_by column
 */
abstract class BaseLeasingEventBookingsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingEventBookingsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingEventBookings';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingEventBookingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingEventBookingsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingEventBookingsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingEventBookingsQuery) {
            return $criteria;
        }
        $query = new LeasingEventBookingsQuery(null, null, $modelAlias);

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
     * @return   LeasingEventBookings|LeasingEventBookings[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingEventBookingsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingEventBookings A model object, or null if the key is not found
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
     * @return                 LeasingEventBookings A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `application_number`, `event_place_id`, `event_place_specific`, `event_leads_id`, `event_date`, `event_start_time`, `event_end_time`, `date_added`, `first_heard`, `status`, `prev_status`, `processing`, `processed_by` FROM `event_bookings` WHERE `id` = :p0';
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
            $obj = new LeasingEventBookings();
            $obj->hydrate($row);
            LeasingEventBookingsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingEventBookings|LeasingEventBookings[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingEventBookings[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingEventBookingsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingEventBookingsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the application_number column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicationNumber('fooValue');   // WHERE application_number = 'fooValue'
     * $query->filterByApplicationNumber('%fooValue%'); // WHERE application_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicationNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByApplicationNumber($applicationNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicationNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicationNumber)) {
                $applicationNumber = str_replace('*', '%', $applicationNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::APPLICATION_NUMBER, $applicationNumber, $comparison);
    }

    /**
     * Filter the query on the event_place_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventPlaceId(1234); // WHERE event_place_id = 1234
     * $query->filterByEventPlaceId(array(12, 34)); // WHERE event_place_id IN (12, 34)
     * $query->filterByEventPlaceId(array('min' => 12)); // WHERE event_place_id >= 12
     * $query->filterByEventPlaceId(array('max' => 12)); // WHERE event_place_id <= 12
     * </code>
     *
     * @see       filterByLeasingEventPlace()
     *
     * @param     mixed $eventPlaceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByEventPlaceId($eventPlaceId = null, $comparison = null)
    {
        if (is_array($eventPlaceId)) {
            $useMinMax = false;
            if (isset($eventPlaceId['min'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_PLACE_ID, $eventPlaceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventPlaceId['max'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_PLACE_ID, $eventPlaceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_PLACE_ID, $eventPlaceId, $comparison);
    }

    /**
     * Filter the query on the event_place_specific column
     *
     * Example usage:
     * <code>
     * $query->filterByEventPlaceSpecific('fooValue');   // WHERE event_place_specific = 'fooValue'
     * $query->filterByEventPlaceSpecific('%fooValue%'); // WHERE event_place_specific LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventPlaceSpecific The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByEventPlaceSpecific($eventPlaceSpecific = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventPlaceSpecific)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eventPlaceSpecific)) {
                $eventPlaceSpecific = str_replace('*', '%', $eventPlaceSpecific);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC, $eventPlaceSpecific, $comparison);
    }

    /**
     * Filter the query on the event_leads_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventLeadsId(1234); // WHERE event_leads_id = 1234
     * $query->filterByEventLeadsId(array(12, 34)); // WHERE event_leads_id IN (12, 34)
     * $query->filterByEventLeadsId(array('min' => 12)); // WHERE event_leads_id >= 12
     * $query->filterByEventLeadsId(array('max' => 12)); // WHERE event_leads_id <= 12
     * </code>
     *
     * @see       filterByLeasingEventLeads()
     *
     * @param     mixed $eventLeadsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByEventLeadsId($eventLeadsId = null, $comparison = null)
    {
        if (is_array($eventLeadsId)) {
            $useMinMax = false;
            if (isset($eventLeadsId['min'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_LEADS_ID, $eventLeadsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventLeadsId['max'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_LEADS_ID, $eventLeadsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_LEADS_ID, $eventLeadsId, $comparison);
    }

    /**
     * Filter the query on the event_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEventDate('fooValue');   // WHERE event_date = 'fooValue'
     * $query->filterByEventDate('%fooValue%'); // WHERE event_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByEventDate($eventDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eventDate)) {
                $eventDate = str_replace('*', '%', $eventDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_DATE, $eventDate, $comparison);
    }

    /**
     * Filter the query on the event_start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByEventStartTime('fooValue');   // WHERE event_start_time = 'fooValue'
     * $query->filterByEventStartTime('%fooValue%'); // WHERE event_start_time LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventStartTime The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByEventStartTime($eventStartTime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventStartTime)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eventStartTime)) {
                $eventStartTime = str_replace('*', '%', $eventStartTime);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_START_TIME, $eventStartTime, $comparison);
    }

    /**
     * Filter the query on the event_end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByEventEndTime('fooValue');   // WHERE event_end_time = 'fooValue'
     * $query->filterByEventEndTime('%fooValue%'); // WHERE event_end_time LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventEndTime The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByEventEndTime($eventEndTime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventEndTime)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eventEndTime)) {
                $eventEndTime = str_replace('*', '%', $eventEndTime);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::EVENT_END_TIME, $eventEndTime, $comparison);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventBookingsPeer::DATE_ADDED, $dateAdded, $comparison);
    }

    /**
     * Filter the query on the first_heard column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstHeard('fooValue');   // WHERE first_heard = 'fooValue'
     * $query->filterByFirstHeard('%fooValue%'); // WHERE first_heard LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstHeard The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByFirstHeard($firstHeard = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstHeard)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstHeard)) {
                $firstHeard = str_replace('*', '%', $firstHeard);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::FIRST_HEARD, $firstHeard, $comparison);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::STATUS, $status, $comparison);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByPrevStatus($prevStatus = null, $comparison = null)
    {
        if (is_array($prevStatus)) {
            $useMinMax = false;
            if (isset($prevStatus['min'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::PREV_STATUS, $prevStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevStatus['max'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::PREV_STATUS, $prevStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::PREV_STATUS, $prevStatus, $comparison);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function filterByProcessing($processing = null, $comparison = null)
    {
        if (is_array($processing)) {
            $useMinMax = false;
            if (isset($processing['min'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::PROCESSING, $processing['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($processing['max'])) {
                $this->addUsingAlias(LeasingEventBookingsPeer::PROCESSING, $processing['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventBookingsPeer::PROCESSING, $processing, $comparison);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventBookingsPeer::PROCESSED_BY, $processedBy, $comparison);
    }

    /**
     * Filter the query by a related LeasingEventPlace object
     *
     * @param   LeasingEventPlace|PropelObjectCollection $leasingEventPlace The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventPlace($leasingEventPlace, $comparison = null)
    {
        if ($leasingEventPlace instanceof LeasingEventPlace) {
            return $this
                ->addUsingAlias(LeasingEventBookingsPeer::EVENT_PLACE_ID, $leasingEventPlace->getId(), $comparison);
        } elseif ($leasingEventPlace instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingEventBookingsPeer::EVENT_PLACE_ID, $leasingEventPlace->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingEventPlace() only accepts arguments of type LeasingEventPlace or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingEventPlace relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function joinLeasingEventPlace($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingEventPlace');

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
            $this->addJoinObject($join, 'LeasingEventPlace');
        }

        return $this;
    }

    /**
     * Use the LeasingEventPlace relation LeasingEventPlace object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingEventPlaceQuery A secondary query class using the current class as primary query
     */
    public function useLeasingEventPlaceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingEventPlace($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingEventPlace', '\Leasing\CoreBundle\Model\LeasingEventPlaceQuery');
    }

    /**
     * Filter the query by a related LeasingEventLeads object
     *
     * @param   LeasingEventLeads|PropelObjectCollection $leasingEventLeads The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventLeads($leasingEventLeads, $comparison = null)
    {
        if ($leasingEventLeads instanceof LeasingEventLeads) {
            return $this
                ->addUsingAlias(LeasingEventBookingsPeer::EVENT_LEADS_ID, $leasingEventLeads->getId(), $comparison);
        } elseif ($leasingEventLeads instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingEventBookingsPeer::EVENT_LEADS_ID, $leasingEventLeads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingEventLeads() only accepts arguments of type LeasingEventLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingEventLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function joinLeasingEventLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingEventLeads');

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
            $this->addJoinObject($join, 'LeasingEventLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingEventLeads relation LeasingEventLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingEventLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingEventLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingEventLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingEventLeads', '\Leasing\CoreBundle\Model\LeasingEventLeadsQuery');
    }

    /**
     * Filter the query by a related LeasingEventPaymentDetails object
     *
     * @param   LeasingEventPaymentDetails|PropelObjectCollection $leasingEventPaymentDetails  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventPaymentDetails($leasingEventPaymentDetails, $comparison = null)
    {
        if ($leasingEventPaymentDetails instanceof LeasingEventPaymentDetails) {
            return $this
                ->addUsingAlias(LeasingEventBookingsPeer::ID, $leasingEventPaymentDetails->getEventBookingsId(), $comparison);
        } elseif ($leasingEventPaymentDetails instanceof PropelObjectCollection) {
            return $this
                ->useLeasingEventPaymentDetailsQuery()
                ->filterByPrimaryKeys($leasingEventPaymentDetails->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingEventPaymentDetails() only accepts arguments of type LeasingEventPaymentDetails or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingEventPaymentDetails relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function joinLeasingEventPaymentDetails($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingEventPaymentDetails');

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
            $this->addJoinObject($join, 'LeasingEventPaymentDetails');
        }

        return $this;
    }

    /**
     * Use the LeasingEventPaymentDetails relation LeasingEventPaymentDetails object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingEventPaymentDetailsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingEventPaymentDetailsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingEventPaymentDetails($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingEventPaymentDetails', '\Leasing\CoreBundle\Model\LeasingEventPaymentDetailsQuery');
    }

    /**
     * Filter the query by a related LeasingPaymentTransactions object
     *
     * @param   LeasingPaymentTransactions|PropelObjectCollection $leasingPaymentTransactions  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventBookingsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingPaymentTransactions($leasingPaymentTransactions, $comparison = null)
    {
        if ($leasingPaymentTransactions instanceof LeasingPaymentTransactions) {
            return $this
                ->addUsingAlias(LeasingEventBookingsPeer::ID, $leasingPaymentTransactions->getEventBookingsId(), $comparison);
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
     * @return LeasingEventBookingsQuery The current query, for fluid interface
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
     * @param   LeasingEventBookings $leasingEventBookings Object to remove from the list of results
     *
     * @return LeasingEventBookingsQuery The current query, for fluid interface
     */
    public function prune($leasingEventBookings = null)
    {
        if ($leasingEventBookings) {
            $this->addUsingAlias(LeasingEventBookingsPeer::ID, $leasingEventBookings->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
