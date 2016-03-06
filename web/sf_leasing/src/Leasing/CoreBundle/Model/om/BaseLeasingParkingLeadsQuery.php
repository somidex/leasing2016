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
use Leasing\CoreBundle\Model\LeasingParkingLeadsPeer;
use Leasing\CoreBundle\Model\LeasingParkingLeadsQuery;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetails;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;

/**
 * @method LeasingParkingLeadsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingParkingLeadsQuery orderByApplicationNumber($order = Criteria::ASC) Order by the application_number column
 * @method LeasingParkingLeadsQuery orderBySalutation($order = Criteria::ASC) Order by the salutation column
 * @method LeasingParkingLeadsQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method LeasingParkingLeadsQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method LeasingParkingLeadsQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method LeasingParkingLeadsQuery orderByAge($order = Criteria::ASC) Order by the age column
 * @method LeasingParkingLeadsQuery orderByBirthday($order = Criteria::ASC) Order by the birthday column
 * @method LeasingParkingLeadsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method LeasingParkingLeadsQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method LeasingParkingLeadsQuery orderByProperty($order = Criteria::ASC) Order by the property column
 * @method LeasingParkingLeadsQuery orderByUnit($order = Criteria::ASC) Order by the unit column
 * @method LeasingParkingLeadsQuery orderBySlots($order = Criteria::ASC) Order by the slots column
 * @method LeasingParkingLeadsQuery orderByPsNumber($order = Criteria::ASC) Order by the ps_number column
 * @method LeasingParkingLeadsQuery orderByFirstHeard($order = Criteria::ASC) Order by the first_heard column
 * @method LeasingParkingLeadsQuery orderByPaymentTerms($order = Criteria::ASC) Order by the payment_terms column
 * @method LeasingParkingLeadsQuery orderByPaymentType($order = Criteria::ASC) Order by the payment_type column
 * @method LeasingParkingLeadsQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method LeasingParkingLeadsQuery orderByDateApproved($order = Criteria::ASC) Order by the date_approved column
 * @method LeasingParkingLeadsQuery orderByDateEnrolled($order = Criteria::ASC) Order by the date_enrolled column
 * @method LeasingParkingLeadsQuery orderByDateExpiry($order = Criteria::ASC) Order by the date_expiry column
 * @method LeasingParkingLeadsQuery orderByDateRenewal($order = Criteria::ASC) Order by the date_renewal column
 * @method LeasingParkingLeadsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingParkingLeadsQuery orderByPrevStatus($order = Criteria::ASC) Order by the prev_status column
 * @method LeasingParkingLeadsQuery orderByClientIp($order = Criteria::ASC) Order by the client_ip column
 * @method LeasingParkingLeadsQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method LeasingParkingLeadsQuery orderByCampaign($order = Criteria::ASC) Order by the campaign column
 * @method LeasingParkingLeadsQuery orderByMedium($order = Criteria::ASC) Order by the medium column
 * @method LeasingParkingLeadsQuery orderBySource($order = Criteria::ASC) Order by the source column
 * @method LeasingParkingLeadsQuery orderByGacountry($order = Criteria::ASC) Order by the gacountry column
 * @method LeasingParkingLeadsQuery orderByProcessing($order = Criteria::ASC) Order by the processing column
 * @method LeasingParkingLeadsQuery orderByProcessedBy($order = Criteria::ASC) Order by the processed_by column
 *
 * @method LeasingParkingLeadsQuery groupById() Group by the id column
 * @method LeasingParkingLeadsQuery groupByApplicationNumber() Group by the application_number column
 * @method LeasingParkingLeadsQuery groupBySalutation() Group by the salutation column
 * @method LeasingParkingLeadsQuery groupByFname() Group by the fname column
 * @method LeasingParkingLeadsQuery groupByLname() Group by the lname column
 * @method LeasingParkingLeadsQuery groupByGender() Group by the gender column
 * @method LeasingParkingLeadsQuery groupByAge() Group by the age column
 * @method LeasingParkingLeadsQuery groupByBirthday() Group by the birthday column
 * @method LeasingParkingLeadsQuery groupByEmail() Group by the email column
 * @method LeasingParkingLeadsQuery groupByMobile() Group by the mobile column
 * @method LeasingParkingLeadsQuery groupByProperty() Group by the property column
 * @method LeasingParkingLeadsQuery groupByUnit() Group by the unit column
 * @method LeasingParkingLeadsQuery groupBySlots() Group by the slots column
 * @method LeasingParkingLeadsQuery groupByPsNumber() Group by the ps_number column
 * @method LeasingParkingLeadsQuery groupByFirstHeard() Group by the first_heard column
 * @method LeasingParkingLeadsQuery groupByPaymentTerms() Group by the payment_terms column
 * @method LeasingParkingLeadsQuery groupByPaymentType() Group by the payment_type column
 * @method LeasingParkingLeadsQuery groupByDateAdded() Group by the date_added column
 * @method LeasingParkingLeadsQuery groupByDateApproved() Group by the date_approved column
 * @method LeasingParkingLeadsQuery groupByDateEnrolled() Group by the date_enrolled column
 * @method LeasingParkingLeadsQuery groupByDateExpiry() Group by the date_expiry column
 * @method LeasingParkingLeadsQuery groupByDateRenewal() Group by the date_renewal column
 * @method LeasingParkingLeadsQuery groupByStatus() Group by the status column
 * @method LeasingParkingLeadsQuery groupByPrevStatus() Group by the prev_status column
 * @method LeasingParkingLeadsQuery groupByClientIp() Group by the client_ip column
 * @method LeasingParkingLeadsQuery groupByClientId() Group by the client_id column
 * @method LeasingParkingLeadsQuery groupByCampaign() Group by the campaign column
 * @method LeasingParkingLeadsQuery groupByMedium() Group by the medium column
 * @method LeasingParkingLeadsQuery groupBySource() Group by the source column
 * @method LeasingParkingLeadsQuery groupByGacountry() Group by the gacountry column
 * @method LeasingParkingLeadsQuery groupByProcessing() Group by the processing column
 * @method LeasingParkingLeadsQuery groupByProcessedBy() Group by the processed_by column
 *
 * @method LeasingParkingLeadsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingParkingLeadsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingParkingLeadsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingParkingLeadsQuery leftJoinLeasingParkingPaymentDetails($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingParkingPaymentDetails relation
 * @method LeasingParkingLeadsQuery rightJoinLeasingParkingPaymentDetails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingParkingPaymentDetails relation
 * @method LeasingParkingLeadsQuery innerJoinLeasingParkingPaymentDetails($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingParkingPaymentDetails relation
 *
 * @method LeasingParkingLeadsQuery leftJoinLeasingPaymentTransactions($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingParkingLeadsQuery rightJoinLeasingPaymentTransactions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingParkingLeadsQuery innerJoinLeasingPaymentTransactions($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingPaymentTransactions relation
 *
 * @method LeasingParkingLeads findOne(PropelPDO $con = null) Return the first LeasingParkingLeads matching the query
 * @method LeasingParkingLeads findOneOrCreate(PropelPDO $con = null) Return the first LeasingParkingLeads matching the query, or a new LeasingParkingLeads object populated from the query conditions when no match is found
 *
 * @method LeasingParkingLeads findOneByApplicationNumber(string $application_number) Return the first LeasingParkingLeads filtered by the application_number column
 * @method LeasingParkingLeads findOneBySalutation(string $salutation) Return the first LeasingParkingLeads filtered by the salutation column
 * @method LeasingParkingLeads findOneByFname(string $fname) Return the first LeasingParkingLeads filtered by the fname column
 * @method LeasingParkingLeads findOneByLname(string $lname) Return the first LeasingParkingLeads filtered by the lname column
 * @method LeasingParkingLeads findOneByGender(string $gender) Return the first LeasingParkingLeads filtered by the gender column
 * @method LeasingParkingLeads findOneByAge(string $age) Return the first LeasingParkingLeads filtered by the age column
 * @method LeasingParkingLeads findOneByBirthday(string $birthday) Return the first LeasingParkingLeads filtered by the birthday column
 * @method LeasingParkingLeads findOneByEmail(string $email) Return the first LeasingParkingLeads filtered by the email column
 * @method LeasingParkingLeads findOneByMobile(string $mobile) Return the first LeasingParkingLeads filtered by the mobile column
 * @method LeasingParkingLeads findOneByProperty(string $property) Return the first LeasingParkingLeads filtered by the property column
 * @method LeasingParkingLeads findOneByUnit(string $unit) Return the first LeasingParkingLeads filtered by the unit column
 * @method LeasingParkingLeads findOneBySlots(int $slots) Return the first LeasingParkingLeads filtered by the slots column
 * @method LeasingParkingLeads findOneByPsNumber(string $ps_number) Return the first LeasingParkingLeads filtered by the ps_number column
 * @method LeasingParkingLeads findOneByFirstHeard(string $first_heard) Return the first LeasingParkingLeads filtered by the first_heard column
 * @method LeasingParkingLeads findOneByPaymentTerms(string $payment_terms) Return the first LeasingParkingLeads filtered by the payment_terms column
 * @method LeasingParkingLeads findOneByPaymentType(int $payment_type) Return the first LeasingParkingLeads filtered by the payment_type column
 * @method LeasingParkingLeads findOneByDateAdded(string $date_added) Return the first LeasingParkingLeads filtered by the date_added column
 * @method LeasingParkingLeads findOneByDateApproved(string $date_approved) Return the first LeasingParkingLeads filtered by the date_approved column
 * @method LeasingParkingLeads findOneByDateEnrolled(string $date_enrolled) Return the first LeasingParkingLeads filtered by the date_enrolled column
 * @method LeasingParkingLeads findOneByDateExpiry(string $date_expiry) Return the first LeasingParkingLeads filtered by the date_expiry column
 * @method LeasingParkingLeads findOneByDateRenewal(string $date_renewal) Return the first LeasingParkingLeads filtered by the date_renewal column
 * @method LeasingParkingLeads findOneByStatus(int $status) Return the first LeasingParkingLeads filtered by the status column
 * @method LeasingParkingLeads findOneByPrevStatus(int $prev_status) Return the first LeasingParkingLeads filtered by the prev_status column
 * @method LeasingParkingLeads findOneByClientIp(string $client_ip) Return the first LeasingParkingLeads filtered by the client_ip column
 * @method LeasingParkingLeads findOneByClientId(string $client_id) Return the first LeasingParkingLeads filtered by the client_id column
 * @method LeasingParkingLeads findOneByCampaign(string $campaign) Return the first LeasingParkingLeads filtered by the campaign column
 * @method LeasingParkingLeads findOneByMedium(string $medium) Return the first LeasingParkingLeads filtered by the medium column
 * @method LeasingParkingLeads findOneBySource(string $source) Return the first LeasingParkingLeads filtered by the source column
 * @method LeasingParkingLeads findOneByGacountry(string $gacountry) Return the first LeasingParkingLeads filtered by the gacountry column
 * @method LeasingParkingLeads findOneByProcessing(int $processing) Return the first LeasingParkingLeads filtered by the processing column
 * @method LeasingParkingLeads findOneByProcessedBy(string $processed_by) Return the first LeasingParkingLeads filtered by the processed_by column
 *
 * @method array findById(int $id) Return LeasingParkingLeads objects filtered by the id column
 * @method array findByApplicationNumber(string $application_number) Return LeasingParkingLeads objects filtered by the application_number column
 * @method array findBySalutation(string $salutation) Return LeasingParkingLeads objects filtered by the salutation column
 * @method array findByFname(string $fname) Return LeasingParkingLeads objects filtered by the fname column
 * @method array findByLname(string $lname) Return LeasingParkingLeads objects filtered by the lname column
 * @method array findByGender(string $gender) Return LeasingParkingLeads objects filtered by the gender column
 * @method array findByAge(string $age) Return LeasingParkingLeads objects filtered by the age column
 * @method array findByBirthday(string $birthday) Return LeasingParkingLeads objects filtered by the birthday column
 * @method array findByEmail(string $email) Return LeasingParkingLeads objects filtered by the email column
 * @method array findByMobile(string $mobile) Return LeasingParkingLeads objects filtered by the mobile column
 * @method array findByProperty(string $property) Return LeasingParkingLeads objects filtered by the property column
 * @method array findByUnit(string $unit) Return LeasingParkingLeads objects filtered by the unit column
 * @method array findBySlots(int $slots) Return LeasingParkingLeads objects filtered by the slots column
 * @method array findByPsNumber(string $ps_number) Return LeasingParkingLeads objects filtered by the ps_number column
 * @method array findByFirstHeard(string $first_heard) Return LeasingParkingLeads objects filtered by the first_heard column
 * @method array findByPaymentTerms(string $payment_terms) Return LeasingParkingLeads objects filtered by the payment_terms column
 * @method array findByPaymentType(int $payment_type) Return LeasingParkingLeads objects filtered by the payment_type column
 * @method array findByDateAdded(string $date_added) Return LeasingParkingLeads objects filtered by the date_added column
 * @method array findByDateApproved(string $date_approved) Return LeasingParkingLeads objects filtered by the date_approved column
 * @method array findByDateEnrolled(string $date_enrolled) Return LeasingParkingLeads objects filtered by the date_enrolled column
 * @method array findByDateExpiry(string $date_expiry) Return LeasingParkingLeads objects filtered by the date_expiry column
 * @method array findByDateRenewal(string $date_renewal) Return LeasingParkingLeads objects filtered by the date_renewal column
 * @method array findByStatus(int $status) Return LeasingParkingLeads objects filtered by the status column
 * @method array findByPrevStatus(int $prev_status) Return LeasingParkingLeads objects filtered by the prev_status column
 * @method array findByClientIp(string $client_ip) Return LeasingParkingLeads objects filtered by the client_ip column
 * @method array findByClientId(string $client_id) Return LeasingParkingLeads objects filtered by the client_id column
 * @method array findByCampaign(string $campaign) Return LeasingParkingLeads objects filtered by the campaign column
 * @method array findByMedium(string $medium) Return LeasingParkingLeads objects filtered by the medium column
 * @method array findBySource(string $source) Return LeasingParkingLeads objects filtered by the source column
 * @method array findByGacountry(string $gacountry) Return LeasingParkingLeads objects filtered by the gacountry column
 * @method array findByProcessing(int $processing) Return LeasingParkingLeads objects filtered by the processing column
 * @method array findByProcessedBy(string $processed_by) Return LeasingParkingLeads objects filtered by the processed_by column
 */
abstract class BaseLeasingParkingLeadsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingParkingLeadsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingParkingLeads';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingParkingLeadsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingParkingLeadsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingParkingLeadsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingParkingLeadsQuery) {
            return $criteria;
        }
        $query = new LeasingParkingLeadsQuery(null, null, $modelAlias);

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
     * @return   LeasingParkingLeads|LeasingParkingLeads[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingParkingLeadsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingParkingLeads A model object, or null if the key is not found
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
     * @return                 LeasingParkingLeads A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `application_number`, `salutation`, `fname`, `lname`, `gender`, `age`, `birthday`, `email`, `mobile`, `property`, `unit`, `slots`, `ps_number`, `first_heard`, `payment_terms`, `payment_type`, `date_added`, `date_approved`, `date_enrolled`, `date_expiry`, `date_renewal`, `status`, `prev_status`, `client_ip`, `client_id`, `campaign`, `medium`, `source`, `gacountry`, `processing`, `processed_by` FROM `parking_leads` WHERE `id` = :p0';
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
            $obj = new LeasingParkingLeads();
            $obj->hydrate($row);
            LeasingParkingLeadsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingParkingLeads|LeasingParkingLeads[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingParkingLeads[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingParkingLeadsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingParkingLeadsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::ID, $id, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingParkingLeadsPeer::APPLICATION_NUMBER, $applicationNumber, $comparison);
    }

    /**
     * Filter the query on the salutation column
     *
     * Example usage:
     * <code>
     * $query->filterBySalutation('fooValue');   // WHERE salutation = 'fooValue'
     * $query->filterBySalutation('%fooValue%'); // WHERE salutation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $salutation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterBySalutation($salutation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salutation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $salutation)) {
                $salutation = str_replace('*', '%', $salutation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::SALUTATION, $salutation, $comparison);
    }

    /**
     * Filter the query on the fname column
     *
     * Example usage:
     * <code>
     * $query->filterByFname('fooValue');   // WHERE fname = 'fooValue'
     * $query->filterByFname('%fooValue%'); // WHERE fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fname)) {
                $fname = str_replace('*', '%', $fname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::FNAME, $fname, $comparison);
    }

    /**
     * Filter the query on the lname column
     *
     * Example usage:
     * <code>
     * $query->filterByLname('fooValue');   // WHERE lname = 'fooValue'
     * $query->filterByLname('%fooValue%'); // WHERE lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lname)) {
                $lname = str_replace('*', '%', $lname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::LNAME, $lname, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%'); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gender)) {
                $gender = str_replace('*', '%', $gender);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the age column
     *
     * Example usage:
     * <code>
     * $query->filterByAge('fooValue');   // WHERE age = 'fooValue'
     * $query->filterByAge('%fooValue%'); // WHERE age LIKE '%fooValue%'
     * </code>
     *
     * @param     string $age The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByAge($age = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($age)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $age)) {
                $age = str_replace('*', '%', $age);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::AGE, $age, $comparison);
    }

    /**
     * Filter the query on the birthday column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthday('fooValue');   // WHERE birthday = 'fooValue'
     * $query->filterByBirthday('%fooValue%'); // WHERE birthday LIKE '%fooValue%'
     * </code>
     *
     * @param     string $birthday The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByBirthday($birthday = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($birthday)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $birthday)) {
                $birthday = str_replace('*', '%', $birthday);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::BIRTHDAY, $birthday, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingParkingLeadsPeer::EMAIL, $email, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingParkingLeadsPeer::MOBILE, $mobile, $comparison);
    }

    /**
     * Filter the query on the property column
     *
     * Example usage:
     * <code>
     * $query->filterByProperty('fooValue');   // WHERE property = 'fooValue'
     * $query->filterByProperty('%fooValue%'); // WHERE property LIKE '%fooValue%'
     * </code>
     *
     * @param     string $property The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByProperty($property = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($property)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $property)) {
                $property = str_replace('*', '%', $property);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PROPERTY, $property, $comparison);
    }

    /**
     * Filter the query on the unit column
     *
     * Example usage:
     * <code>
     * $query->filterByUnit('fooValue');   // WHERE unit = 'fooValue'
     * $query->filterByUnit('%fooValue%'); // WHERE unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $unit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByUnit($unit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $unit)) {
                $unit = str_replace('*', '%', $unit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::UNIT, $unit, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterBySlots($slots = null, $comparison = null)
    {
        if (is_array($slots)) {
            $useMinMax = false;
            if (isset($slots['min'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::SLOTS, $slots['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($slots['max'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::SLOTS, $slots['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::SLOTS, $slots, $comparison);
    }

    /**
     * Filter the query on the ps_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPsNumber('fooValue');   // WHERE ps_number = 'fooValue'
     * $query->filterByPsNumber('%fooValue%'); // WHERE ps_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $psNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByPsNumber($psNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($psNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $psNumber)) {
                $psNumber = str_replace('*', '%', $psNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PS_NUMBER, $psNumber, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingParkingLeadsPeer::FIRST_HEARD, $firstHeard, $comparison);
    }

    /**
     * Filter the query on the payment_terms column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentTerms('fooValue');   // WHERE payment_terms = 'fooValue'
     * $query->filterByPaymentTerms('%fooValue%'); // WHERE payment_terms LIKE '%fooValue%'
     * </code>
     *
     * @param     string $paymentTerms The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByPaymentTerms($paymentTerms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentTerms)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $paymentTerms)) {
                $paymentTerms = str_replace('*', '%', $paymentTerms);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PAYMENT_TERMS, $paymentTerms, $comparison);
    }

    /**
     * Filter the query on the payment_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentType(1234); // WHERE payment_type = 1234
     * $query->filterByPaymentType(array(12, 34)); // WHERE payment_type IN (12, 34)
     * $query->filterByPaymentType(array('min' => 12)); // WHERE payment_type >= 12
     * $query->filterByPaymentType(array('max' => 12)); // WHERE payment_type <= 12
     * </code>
     *
     * @param     mixed $paymentType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByPaymentType($paymentType = null, $comparison = null)
    {
        if (is_array($paymentType)) {
            $useMinMax = false;
            if (isset($paymentType['min'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::PAYMENT_TYPE, $paymentType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentType['max'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::PAYMENT_TYPE, $paymentType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PAYMENT_TYPE, $paymentType, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingParkingLeadsPeer::DATE_ADDED, $dateAdded, $comparison);
    }

    /**
     * Filter the query on the date_approved column
     *
     * Example usage:
     * <code>
     * $query->filterByDateApproved('fooValue');   // WHERE date_approved = 'fooValue'
     * $query->filterByDateApproved('%fooValue%'); // WHERE date_approved LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dateApproved The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByDateApproved($dateApproved = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateApproved)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dateApproved)) {
                $dateApproved = str_replace('*', '%', $dateApproved);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::DATE_APPROVED, $dateApproved, $comparison);
    }

    /**
     * Filter the query on the date_enrolled column
     *
     * Example usage:
     * <code>
     * $query->filterByDateEnrolled('fooValue');   // WHERE date_enrolled = 'fooValue'
     * $query->filterByDateEnrolled('%fooValue%'); // WHERE date_enrolled LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dateEnrolled The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByDateEnrolled($dateEnrolled = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateEnrolled)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dateEnrolled)) {
                $dateEnrolled = str_replace('*', '%', $dateEnrolled);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::DATE_ENROLLED, $dateEnrolled, $comparison);
    }

    /**
     * Filter the query on the date_expiry column
     *
     * Example usage:
     * <code>
     * $query->filterByDateExpiry('fooValue');   // WHERE date_expiry = 'fooValue'
     * $query->filterByDateExpiry('%fooValue%'); // WHERE date_expiry LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dateExpiry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByDateExpiry($dateExpiry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateExpiry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dateExpiry)) {
                $dateExpiry = str_replace('*', '%', $dateExpiry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::DATE_EXPIRY, $dateExpiry, $comparison);
    }

    /**
     * Filter the query on the date_renewal column
     *
     * Example usage:
     * <code>
     * $query->filterByDateRenewal('fooValue');   // WHERE date_renewal = 'fooValue'
     * $query->filterByDateRenewal('%fooValue%'); // WHERE date_renewal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dateRenewal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByDateRenewal($dateRenewal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateRenewal)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dateRenewal)) {
                $dateRenewal = str_replace('*', '%', $dateRenewal);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::DATE_RENEWAL, $dateRenewal, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::STATUS, $status, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByPrevStatus($prevStatus = null, $comparison = null)
    {
        if (is_array($prevStatus)) {
            $useMinMax = false;
            if (isset($prevStatus['min'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::PREV_STATUS, $prevStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevStatus['max'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::PREV_STATUS, $prevStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PREV_STATUS, $prevStatus, $comparison);
    }

    /**
     * Filter the query on the client_ip column
     *
     * Example usage:
     * <code>
     * $query->filterByClientIp('fooValue');   // WHERE client_ip = 'fooValue'
     * $query->filterByClientIp('%fooValue%'); // WHERE client_ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientIp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByClientIp($clientIp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientIp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clientIp)) {
                $clientIp = str_replace('*', '%', $clientIp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::CLIENT_IP, $clientIp, $comparison);
    }

    /**
     * Filter the query on the client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClientId('fooValue');   // WHERE client_id = 'fooValue'
     * $query->filterByClientId('%fooValue%'); // WHERE client_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clientId)) {
                $clientId = str_replace('*', '%', $clientId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the campaign column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaign('fooValue');   // WHERE campaign = 'fooValue'
     * $query->filterByCampaign('%fooValue%'); // WHERE campaign LIKE '%fooValue%'
     * </code>
     *
     * @param     string $campaign The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByCampaign($campaign = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campaign)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $campaign)) {
                $campaign = str_replace('*', '%', $campaign);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::CAMPAIGN, $campaign, $comparison);
    }

    /**
     * Filter the query on the medium column
     *
     * Example usage:
     * <code>
     * $query->filterByMedium('fooValue');   // WHERE medium = 'fooValue'
     * $query->filterByMedium('%fooValue%'); // WHERE medium LIKE '%fooValue%'
     * </code>
     *
     * @param     string $medium The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByMedium($medium = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($medium)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $medium)) {
                $medium = str_replace('*', '%', $medium);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::MEDIUM, $medium, $comparison);
    }

    /**
     * Filter the query on the source column
     *
     * Example usage:
     * <code>
     * $query->filterBySource('fooValue');   // WHERE source = 'fooValue'
     * $query->filterBySource('%fooValue%'); // WHERE source LIKE '%fooValue%'
     * </code>
     *
     * @param     string $source The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterBySource($source = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($source)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $source)) {
                $source = str_replace('*', '%', $source);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::SOURCE, $source, $comparison);
    }

    /**
     * Filter the query on the gacountry column
     *
     * Example usage:
     * <code>
     * $query->filterByGacountry('fooValue');   // WHERE gacountry = 'fooValue'
     * $query->filterByGacountry('%fooValue%'); // WHERE gacountry LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gacountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByGacountry($gacountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gacountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gacountry)) {
                $gacountry = str_replace('*', '%', $gacountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::GACOUNTRY, $gacountry, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function filterByProcessing($processing = null, $comparison = null)
    {
        if (is_array($processing)) {
            $useMinMax = false;
            if (isset($processing['min'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::PROCESSING, $processing['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($processing['max'])) {
                $this->addUsingAlias(LeasingParkingLeadsPeer::PROCESSING, $processing['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PROCESSING, $processing, $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingParkingLeadsPeer::PROCESSED_BY, $processedBy, $comparison);
    }

    /**
     * Filter the query by a related LeasingParkingPaymentDetails object
     *
     * @param   LeasingParkingPaymentDetails|PropelObjectCollection $leasingParkingPaymentDetails  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingParkingLeadsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingParkingPaymentDetails($leasingParkingPaymentDetails, $comparison = null)
    {
        if ($leasingParkingPaymentDetails instanceof LeasingParkingPaymentDetails) {
            return $this
                ->addUsingAlias(LeasingParkingLeadsPeer::ID, $leasingParkingPaymentDetails->getParkingLeadId(), $comparison);
        } elseif ($leasingParkingPaymentDetails instanceof PropelObjectCollection) {
            return $this
                ->useLeasingParkingPaymentDetailsQuery()
                ->filterByPrimaryKeys($leasingParkingPaymentDetails->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingParkingPaymentDetails() only accepts arguments of type LeasingParkingPaymentDetails or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingParkingPaymentDetails relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function joinLeasingParkingPaymentDetails($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingParkingPaymentDetails');

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
            $this->addJoinObject($join, 'LeasingParkingPaymentDetails');
        }

        return $this;
    }

    /**
     * Use the LeasingParkingPaymentDetails relation LeasingParkingPaymentDetails object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingParkingPaymentDetailsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingParkingPaymentDetails($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingParkingPaymentDetails', '\Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsQuery');
    }

    /**
     * Filter the query by a related LeasingPaymentTransactions object
     *
     * @param   LeasingPaymentTransactions|PropelObjectCollection $leasingPaymentTransactions  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingParkingLeadsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingPaymentTransactions($leasingPaymentTransactions, $comparison = null)
    {
        if ($leasingPaymentTransactions instanceof LeasingPaymentTransactions) {
            return $this
                ->addUsingAlias(LeasingParkingLeadsPeer::ID, $leasingPaymentTransactions->getParkingLeadsId(), $comparison);
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
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
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
     * @param   LeasingParkingLeads $leasingParkingLeads Object to remove from the list of results
     *
     * @return LeasingParkingLeadsQuery The current query, for fluid interface
     */
    public function prune($leasingParkingLeads = null)
    {
        if ($leasingParkingLeads) {
            $this->addUsingAlias(LeasingParkingLeadsPeer::ID, $leasingParkingLeads->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
