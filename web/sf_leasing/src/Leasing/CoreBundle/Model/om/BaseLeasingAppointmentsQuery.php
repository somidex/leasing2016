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
use Leasing\CoreBundle\Model\LeasingAppointmentLeads;
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingAppointmentsPeer;
use Leasing\CoreBundle\Model\LeasingAppointmentsQuery;
use Leasing\CoreBundle\Model\LeasingUnit;

/**
 * @method LeasingAppointmentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingAppointmentsQuery orderByAppointmentLeadsId($order = Criteria::ASC) Order by the appointment_leads_id column
 * @method LeasingAppointmentsQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method LeasingAppointmentsQuery orderByPreferredDate($order = Criteria::ASC) Order by the preferred_date column
 * @method LeasingAppointmentsQuery orderByPreferredTime($order = Criteria::ASC) Order by the preferred_time column
 * @method LeasingAppointmentsQuery orderByConfirmationCode($order = Criteria::ASC) Order by the confirmation_code column
 * @method LeasingAppointmentsQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method LeasingAppointmentsQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method LeasingAppointmentsQuery orderByFirstHeard($order = Criteria::ASC) Order by the first_heard column
 * @method LeasingAppointmentsQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method LeasingAppointmentsQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method LeasingAppointmentsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingAppointmentsQuery orderByPrevStatus($order = Criteria::ASC) Order by the prev_status column
 * @method LeasingAppointmentsQuery orderByProcessing($order = Criteria::ASC) Order by the processing column
 * @method LeasingAppointmentsQuery orderByProcessedBy($order = Criteria::ASC) Order by the processed_by column
 *
 * @method LeasingAppointmentsQuery groupById() Group by the id column
 * @method LeasingAppointmentsQuery groupByAppointmentLeadsId() Group by the appointment_leads_id column
 * @method LeasingAppointmentsQuery groupByUnitId() Group by the unit_id column
 * @method LeasingAppointmentsQuery groupByPreferredDate() Group by the preferred_date column
 * @method LeasingAppointmentsQuery groupByPreferredTime() Group by the preferred_time column
 * @method LeasingAppointmentsQuery groupByConfirmationCode() Group by the confirmation_code column
 * @method LeasingAppointmentsQuery groupByStartDate() Group by the start_date column
 * @method LeasingAppointmentsQuery groupByEndDate() Group by the end_date column
 * @method LeasingAppointmentsQuery groupByFirstHeard() Group by the first_heard column
 * @method LeasingAppointmentsQuery groupByNotes() Group by the notes column
 * @method LeasingAppointmentsQuery groupByDateAdded() Group by the date_added column
 * @method LeasingAppointmentsQuery groupByStatus() Group by the status column
 * @method LeasingAppointmentsQuery groupByPrevStatus() Group by the prev_status column
 * @method LeasingAppointmentsQuery groupByProcessing() Group by the processing column
 * @method LeasingAppointmentsQuery groupByProcessedBy() Group by the processed_by column
 *
 * @method LeasingAppointmentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingAppointmentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingAppointmentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingAppointmentsQuery leftJoinLeasingAppointmentLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointmentLeads relation
 * @method LeasingAppointmentsQuery rightJoinLeasingAppointmentLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointmentLeads relation
 * @method LeasingAppointmentsQuery innerJoinLeasingAppointmentLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointmentLeads relation
 *
 * @method LeasingAppointmentsQuery leftJoinLeasingUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingAppointmentsQuery rightJoinLeasingUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingAppointmentsQuery innerJoinLeasingUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnit relation
 *
 * @method LeasingAppointmentsQuery leftJoinLeasingAppointmentAssignment($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointmentAssignment relation
 * @method LeasingAppointmentsQuery rightJoinLeasingAppointmentAssignment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointmentAssignment relation
 * @method LeasingAppointmentsQuery innerJoinLeasingAppointmentAssignment($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointmentAssignment relation
 *
 * @method LeasingAppointments findOne(PropelPDO $con = null) Return the first LeasingAppointments matching the query
 * @method LeasingAppointments findOneOrCreate(PropelPDO $con = null) Return the first LeasingAppointments matching the query, or a new LeasingAppointments object populated from the query conditions when no match is found
 *
 * @method LeasingAppointments findOneByAppointmentLeadsId(int $appointment_leads_id) Return the first LeasingAppointments filtered by the appointment_leads_id column
 * @method LeasingAppointments findOneByUnitId(int $unit_id) Return the first LeasingAppointments filtered by the unit_id column
 * @method LeasingAppointments findOneByPreferredDate(string $preferred_date) Return the first LeasingAppointments filtered by the preferred_date column
 * @method LeasingAppointments findOneByPreferredTime(string $preferred_time) Return the first LeasingAppointments filtered by the preferred_time column
 * @method LeasingAppointments findOneByConfirmationCode(string $confirmation_code) Return the first LeasingAppointments filtered by the confirmation_code column
 * @method LeasingAppointments findOneByStartDate(string $start_date) Return the first LeasingAppointments filtered by the start_date column
 * @method LeasingAppointments findOneByEndDate(string $end_date) Return the first LeasingAppointments filtered by the end_date column
 * @method LeasingAppointments findOneByFirstHeard(string $first_heard) Return the first LeasingAppointments filtered by the first_heard column
 * @method LeasingAppointments findOneByNotes(string $notes) Return the first LeasingAppointments filtered by the notes column
 * @method LeasingAppointments findOneByDateAdded(string $date_added) Return the first LeasingAppointments filtered by the date_added column
 * @method LeasingAppointments findOneByStatus(int $status) Return the first LeasingAppointments filtered by the status column
 * @method LeasingAppointments findOneByPrevStatus(int $prev_status) Return the first LeasingAppointments filtered by the prev_status column
 * @method LeasingAppointments findOneByProcessing(int $processing) Return the first LeasingAppointments filtered by the processing column
 * @method LeasingAppointments findOneByProcessedBy(string $processed_by) Return the first LeasingAppointments filtered by the processed_by column
 *
 * @method array findById(int $id) Return LeasingAppointments objects filtered by the id column
 * @method array findByAppointmentLeadsId(int $appointment_leads_id) Return LeasingAppointments objects filtered by the appointment_leads_id column
 * @method array findByUnitId(int $unit_id) Return LeasingAppointments objects filtered by the unit_id column
 * @method array findByPreferredDate(string $preferred_date) Return LeasingAppointments objects filtered by the preferred_date column
 * @method array findByPreferredTime(string $preferred_time) Return LeasingAppointments objects filtered by the preferred_time column
 * @method array findByConfirmationCode(string $confirmation_code) Return LeasingAppointments objects filtered by the confirmation_code column
 * @method array findByStartDate(string $start_date) Return LeasingAppointments objects filtered by the start_date column
 * @method array findByEndDate(string $end_date) Return LeasingAppointments objects filtered by the end_date column
 * @method array findByFirstHeard(string $first_heard) Return LeasingAppointments objects filtered by the first_heard column
 * @method array findByNotes(string $notes) Return LeasingAppointments objects filtered by the notes column
 * @method array findByDateAdded(string $date_added) Return LeasingAppointments objects filtered by the date_added column
 * @method array findByStatus(int $status) Return LeasingAppointments objects filtered by the status column
 * @method array findByPrevStatus(int $prev_status) Return LeasingAppointments objects filtered by the prev_status column
 * @method array findByProcessing(int $processing) Return LeasingAppointments objects filtered by the processing column
 * @method array findByProcessedBy(string $processed_by) Return LeasingAppointments objects filtered by the processed_by column
 */
abstract class BaseLeasingAppointmentsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingAppointmentsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingAppointments';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingAppointmentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingAppointmentsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingAppointmentsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingAppointmentsQuery) {
            return $criteria;
        }
        $query = new LeasingAppointmentsQuery(null, null, $modelAlias);

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
     * @return   LeasingAppointments|LeasingAppointments[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingAppointmentsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingAppointmentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingAppointments A model object, or null if the key is not found
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
     * @return                 LeasingAppointments A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `appointment_leads_id`, `unit_id`, `preferred_date`, `preferred_time`, `confirmation_code`, `start_date`, `end_date`, `first_heard`, `notes`, `date_added`, `status`, `prev_status`, `processing`, `processed_by` FROM `appointments` WHERE `id` = :p0';
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
            $obj = new LeasingAppointments();
            $obj->hydrate($row);
            LeasingAppointmentsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingAppointments|LeasingAppointments[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingAppointments[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingAppointmentsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingAppointmentsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the appointment_leads_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAppointmentLeadsId(1234); // WHERE appointment_leads_id = 1234
     * $query->filterByAppointmentLeadsId(array(12, 34)); // WHERE appointment_leads_id IN (12, 34)
     * $query->filterByAppointmentLeadsId(array('min' => 12)); // WHERE appointment_leads_id >= 12
     * $query->filterByAppointmentLeadsId(array('max' => 12)); // WHERE appointment_leads_id <= 12
     * </code>
     *
     * @see       filterByLeasingAppointmentLeads()
     *
     * @param     mixed $appointmentLeadsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByAppointmentLeadsId($appointmentLeadsId = null, $comparison = null)
    {
        if (is_array($appointmentLeadsId)) {
            $useMinMax = false;
            if (isset($appointmentLeadsId['min'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID, $appointmentLeadsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($appointmentLeadsId['max'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID, $appointmentLeadsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID, $appointmentLeadsId, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::UNIT_ID, $unitId, $comparison);
    }

    /**
     * Filter the query on the preferred_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPreferredDate('fooValue');   // WHERE preferred_date = 'fooValue'
     * $query->filterByPreferredDate('%fooValue%'); // WHERE preferred_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $preferredDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByPreferredDate($preferredDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($preferredDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $preferredDate)) {
                $preferredDate = str_replace('*', '%', $preferredDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::PREFERRED_DATE, $preferredDate, $comparison);
    }

    /**
     * Filter the query on the preferred_time column
     *
     * Example usage:
     * <code>
     * $query->filterByPreferredTime('fooValue');   // WHERE preferred_time = 'fooValue'
     * $query->filterByPreferredTime('%fooValue%'); // WHERE preferred_time LIKE '%fooValue%'
     * </code>
     *
     * @param     string $preferredTime The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByPreferredTime($preferredTime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($preferredTime)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $preferredTime)) {
                $preferredTime = str_replace('*', '%', $preferredTime);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::PREFERRED_TIME, $preferredTime, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::CONFIRMATION_CODE, $confirmationCode, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::START_DATE, $startDate, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::END_DATE, $endDate, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::FIRST_HEARD, $firstHeard, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::NOTES, $notes, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::DATE_ADDED, $dateAdded, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::STATUS, $status, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByPrevStatus($prevStatus = null, $comparison = null)
    {
        if (is_array($prevStatus)) {
            $useMinMax = false;
            if (isset($prevStatus['min'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::PREV_STATUS, $prevStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevStatus['max'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::PREV_STATUS, $prevStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::PREV_STATUS, $prevStatus, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function filterByProcessing($processing = null, $comparison = null)
    {
        if (is_array($processing)) {
            $useMinMax = false;
            if (isset($processing['min'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::PROCESSING, $processing['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($processing['max'])) {
                $this->addUsingAlias(LeasingAppointmentsPeer::PROCESSING, $processing['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentsPeer::PROCESSING, $processing, $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentsPeer::PROCESSED_BY, $processedBy, $comparison);
    }

    /**
     * Filter the query by a related LeasingAppointmentLeads object
     *
     * @param   LeasingAppointmentLeads|PropelObjectCollection $leasingAppointmentLeads The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointmentLeads($leasingAppointmentLeads, $comparison = null)
    {
        if ($leasingAppointmentLeads instanceof LeasingAppointmentLeads) {
            return $this
                ->addUsingAlias(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID, $leasingAppointmentLeads->getId(), $comparison);
        } elseif ($leasingAppointmentLeads instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID, $leasingAppointmentLeads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingAppointmentLeads() only accepts arguments of type LeasingAppointmentLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingAppointmentLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function joinLeasingAppointmentLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingAppointmentLeads');

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
            $this->addJoinObject($join, 'LeasingAppointmentLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingAppointmentLeads relation LeasingAppointmentLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingAppointmentLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingAppointmentLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingAppointmentLeads', '\Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery');
    }

    /**
     * Filter the query by a related LeasingUnit object
     *
     * @param   LeasingUnit|PropelObjectCollection $leasingUnit The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnit($leasingUnit, $comparison = null)
    {
        if ($leasingUnit instanceof LeasingUnit) {
            return $this
                ->addUsingAlias(LeasingAppointmentsPeer::UNIT_ID, $leasingUnit->getId(), $comparison);
        } elseif ($leasingUnit instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingAppointmentsPeer::UNIT_ID, $leasingUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingAppointmentAssignment object
     *
     * @param   LeasingAppointmentAssignment|PropelObjectCollection $leasingAppointmentAssignment  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointmentAssignment($leasingAppointmentAssignment, $comparison = null)
    {
        if ($leasingAppointmentAssignment instanceof LeasingAppointmentAssignment) {
            return $this
                ->addUsingAlias(LeasingAppointmentsPeer::ID, $leasingAppointmentAssignment->getAppointmentsId(), $comparison);
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
     * @return LeasingAppointmentsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   LeasingAppointments $leasingAppointments Object to remove from the list of results
     *
     * @return LeasingAppointmentsQuery The current query, for fluid interface
     */
    public function prune($leasingAppointments = null)
    {
        if ($leasingAppointments) {
            $this->addUsingAlias(LeasingAppointmentsPeer::ID, $leasingAppointments->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
