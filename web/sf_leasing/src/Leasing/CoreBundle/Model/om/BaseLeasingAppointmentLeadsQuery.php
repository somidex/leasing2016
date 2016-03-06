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
use Leasing\CoreBundle\Model\LeasingAppointmentLeads;
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsPeer;
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery;
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingCountry;
use Leasing\CoreBundle\Model\LeasingNationality;

/**
 * @method LeasingAppointmentLeadsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingAppointmentLeadsQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method LeasingAppointmentLeadsQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method LeasingAppointmentLeadsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method LeasingAppointmentLeadsQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method LeasingAppointmentLeadsQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method LeasingAppointmentLeadsQuery orderByNationalityId($order = Criteria::ASC) Order by the nationality_id column
 * @method LeasingAppointmentLeadsQuery orderByClientIp($order = Criteria::ASC) Order by the client_ip column
 * @method LeasingAppointmentLeadsQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method LeasingAppointmentLeadsQuery orderByCampaign($order = Criteria::ASC) Order by the campaign column
 * @method LeasingAppointmentLeadsQuery orderByMedium($order = Criteria::ASC) Order by the medium column
 * @method LeasingAppointmentLeadsQuery orderBySource($order = Criteria::ASC) Order by the source column
 * @method LeasingAppointmentLeadsQuery orderByGacountry($order = Criteria::ASC) Order by the gacountry column
 *
 * @method LeasingAppointmentLeadsQuery groupById() Group by the id column
 * @method LeasingAppointmentLeadsQuery groupByFname() Group by the fname column
 * @method LeasingAppointmentLeadsQuery groupByLname() Group by the lname column
 * @method LeasingAppointmentLeadsQuery groupByEmail() Group by the email column
 * @method LeasingAppointmentLeadsQuery groupByMobile() Group by the mobile column
 * @method LeasingAppointmentLeadsQuery groupByCountryId() Group by the country_id column
 * @method LeasingAppointmentLeadsQuery groupByNationalityId() Group by the nationality_id column
 * @method LeasingAppointmentLeadsQuery groupByClientIp() Group by the client_ip column
 * @method LeasingAppointmentLeadsQuery groupByClientId() Group by the client_id column
 * @method LeasingAppointmentLeadsQuery groupByCampaign() Group by the campaign column
 * @method LeasingAppointmentLeadsQuery groupByMedium() Group by the medium column
 * @method LeasingAppointmentLeadsQuery groupBySource() Group by the source column
 * @method LeasingAppointmentLeadsQuery groupByGacountry() Group by the gacountry column
 *
 * @method LeasingAppointmentLeadsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingAppointmentLeadsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingAppointmentLeadsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingAppointmentLeadsQuery leftJoinLeasingCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingCountry relation
 * @method LeasingAppointmentLeadsQuery rightJoinLeasingCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingCountry relation
 * @method LeasingAppointmentLeadsQuery innerJoinLeasingCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingCountry relation
 *
 * @method LeasingAppointmentLeadsQuery leftJoinLeasingNationality($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingNationality relation
 * @method LeasingAppointmentLeadsQuery rightJoinLeasingNationality($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingNationality relation
 * @method LeasingAppointmentLeadsQuery innerJoinLeasingNationality($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingNationality relation
 *
 * @method LeasingAppointmentLeadsQuery leftJoinLeasingAppointments($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointments relation
 * @method LeasingAppointmentLeadsQuery rightJoinLeasingAppointments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointments relation
 * @method LeasingAppointmentLeadsQuery innerJoinLeasingAppointments($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointments relation
 *
 * @method LeasingAppointmentLeads findOne(PropelPDO $con = null) Return the first LeasingAppointmentLeads matching the query
 * @method LeasingAppointmentLeads findOneOrCreate(PropelPDO $con = null) Return the first LeasingAppointmentLeads matching the query, or a new LeasingAppointmentLeads object populated from the query conditions when no match is found
 *
 * @method LeasingAppointmentLeads findOneByFname(string $fname) Return the first LeasingAppointmentLeads filtered by the fname column
 * @method LeasingAppointmentLeads findOneByLname(string $lname) Return the first LeasingAppointmentLeads filtered by the lname column
 * @method LeasingAppointmentLeads findOneByEmail(string $email) Return the first LeasingAppointmentLeads filtered by the email column
 * @method LeasingAppointmentLeads findOneByMobile(string $mobile) Return the first LeasingAppointmentLeads filtered by the mobile column
 * @method LeasingAppointmentLeads findOneByCountryId(int $country_id) Return the first LeasingAppointmentLeads filtered by the country_id column
 * @method LeasingAppointmentLeads findOneByNationalityId(int $nationality_id) Return the first LeasingAppointmentLeads filtered by the nationality_id column
 * @method LeasingAppointmentLeads findOneByClientIp(string $client_ip) Return the first LeasingAppointmentLeads filtered by the client_ip column
 * @method LeasingAppointmentLeads findOneByClientId(string $client_id) Return the first LeasingAppointmentLeads filtered by the client_id column
 * @method LeasingAppointmentLeads findOneByCampaign(string $campaign) Return the first LeasingAppointmentLeads filtered by the campaign column
 * @method LeasingAppointmentLeads findOneByMedium(string $medium) Return the first LeasingAppointmentLeads filtered by the medium column
 * @method LeasingAppointmentLeads findOneBySource(string $source) Return the first LeasingAppointmentLeads filtered by the source column
 * @method LeasingAppointmentLeads findOneByGacountry(string $gacountry) Return the first LeasingAppointmentLeads filtered by the gacountry column
 *
 * @method array findById(int $id) Return LeasingAppointmentLeads objects filtered by the id column
 * @method array findByFname(string $fname) Return LeasingAppointmentLeads objects filtered by the fname column
 * @method array findByLname(string $lname) Return LeasingAppointmentLeads objects filtered by the lname column
 * @method array findByEmail(string $email) Return LeasingAppointmentLeads objects filtered by the email column
 * @method array findByMobile(string $mobile) Return LeasingAppointmentLeads objects filtered by the mobile column
 * @method array findByCountryId(int $country_id) Return LeasingAppointmentLeads objects filtered by the country_id column
 * @method array findByNationalityId(int $nationality_id) Return LeasingAppointmentLeads objects filtered by the nationality_id column
 * @method array findByClientIp(string $client_ip) Return LeasingAppointmentLeads objects filtered by the client_ip column
 * @method array findByClientId(string $client_id) Return LeasingAppointmentLeads objects filtered by the client_id column
 * @method array findByCampaign(string $campaign) Return LeasingAppointmentLeads objects filtered by the campaign column
 * @method array findByMedium(string $medium) Return LeasingAppointmentLeads objects filtered by the medium column
 * @method array findBySource(string $source) Return LeasingAppointmentLeads objects filtered by the source column
 * @method array findByGacountry(string $gacountry) Return LeasingAppointmentLeads objects filtered by the gacountry column
 */
abstract class BaseLeasingAppointmentLeadsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingAppointmentLeadsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingAppointmentLeads';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingAppointmentLeadsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingAppointmentLeadsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingAppointmentLeadsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingAppointmentLeadsQuery) {
            return $criteria;
        }
        $query = new LeasingAppointmentLeadsQuery(null, null, $modelAlias);

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
     * @return   LeasingAppointmentLeads|LeasingAppointmentLeads[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingAppointmentLeadsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingAppointmentLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingAppointmentLeads A model object, or null if the key is not found
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
     * @return                 LeasingAppointmentLeads A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `fname`, `lname`, `email`, `mobile`, `country_id`, `nationality_id`, `client_ip`, `client_id`, `campaign`, `medium`, `source`, `gacountry` FROM `appointment_leads` WHERE `id` = :p0';
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
            $obj = new LeasingAppointmentLeads();
            $obj->hydrate($row);
            LeasingAppointmentLeadsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingAppointmentLeads|LeasingAppointmentLeads[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingAppointmentLeads[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $id, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::FNAME, $fname, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::LNAME, $lname, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::EMAIL, $email, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::MOBILE, $mobile, $comparison);
    }

    /**
     * Filter the query on the country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryId(1234); // WHERE country_id = 1234
     * $query->filterByCountryId(array(12, 34)); // WHERE country_id IN (12, 34)
     * $query->filterByCountryId(array('min' => 12)); // WHERE country_id >= 12
     * $query->filterByCountryId(array('max' => 12)); // WHERE country_id <= 12
     * </code>
     *
     * @see       filterByLeasingCountry()
     *
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(LeasingAppointmentLeadsPeer::COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(LeasingAppointmentLeadsPeer::COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::COUNTRY_ID, $countryId, $comparison);
    }

    /**
     * Filter the query on the nationality_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNationalityId(1234); // WHERE nationality_id = 1234
     * $query->filterByNationalityId(array(12, 34)); // WHERE nationality_id IN (12, 34)
     * $query->filterByNationalityId(array('min' => 12)); // WHERE nationality_id >= 12
     * $query->filterByNationalityId(array('max' => 12)); // WHERE nationality_id <= 12
     * </code>
     *
     * @see       filterByLeasingNationality()
     *
     * @param     mixed $nationalityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function filterByNationalityId($nationalityId = null, $comparison = null)
    {
        if (is_array($nationalityId)) {
            $useMinMax = false;
            if (isset($nationalityId['min'])) {
                $this->addUsingAlias(LeasingAppointmentLeadsPeer::NATIONALITY_ID, $nationalityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nationalityId['max'])) {
                $this->addUsingAlias(LeasingAppointmentLeadsPeer::NATIONALITY_ID, $nationalityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::NATIONALITY_ID, $nationalityId, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::CLIENT_IP, $clientIp, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::CLIENT_ID, $clientId, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::CAMPAIGN, $campaign, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::MEDIUM, $medium, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::SOURCE, $source, $comparison);
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingAppointmentLeadsPeer::GACOUNTRY, $gacountry, $comparison);
    }

    /**
     * Filter the query by a related LeasingCountry object
     *
     * @param   LeasingCountry|PropelObjectCollection $leasingCountry The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentLeadsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingCountry($leasingCountry, $comparison = null)
    {
        if ($leasingCountry instanceof LeasingCountry) {
            return $this
                ->addUsingAlias(LeasingAppointmentLeadsPeer::COUNTRY_ID, $leasingCountry->getId(), $comparison);
        } elseif ($leasingCountry instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingAppointmentLeadsPeer::COUNTRY_ID, $leasingCountry->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingCountry() only accepts arguments of type LeasingCountry or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingCountry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function joinLeasingCountry($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingCountry');

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
            $this->addJoinObject($join, 'LeasingCountry');
        }

        return $this;
    }

    /**
     * Use the LeasingCountry relation LeasingCountry object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingCountryQuery A secondary query class using the current class as primary query
     */
    public function useLeasingCountryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingCountry', '\Leasing\CoreBundle\Model\LeasingCountryQuery');
    }

    /**
     * Filter the query by a related LeasingNationality object
     *
     * @param   LeasingNationality|PropelObjectCollection $leasingNationality The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentLeadsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingNationality($leasingNationality, $comparison = null)
    {
        if ($leasingNationality instanceof LeasingNationality) {
            return $this
                ->addUsingAlias(LeasingAppointmentLeadsPeer::NATIONALITY_ID, $leasingNationality->getId(), $comparison);
        } elseif ($leasingNationality instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingAppointmentLeadsPeer::NATIONALITY_ID, $leasingNationality->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingNationality() only accepts arguments of type LeasingNationality or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingNationality relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function joinLeasingNationality($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingNationality');

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
            $this->addJoinObject($join, 'LeasingNationality');
        }

        return $this;
    }

    /**
     * Use the LeasingNationality relation LeasingNationality object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingNationalityQuery A secondary query class using the current class as primary query
     */
    public function useLeasingNationalityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingNationality($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingNationality', '\Leasing\CoreBundle\Model\LeasingNationalityQuery');
    }

    /**
     * Filter the query by a related LeasingAppointments object
     *
     * @param   LeasingAppointments|PropelObjectCollection $leasingAppointments  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingAppointmentLeadsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointments($leasingAppointments, $comparison = null)
    {
        if ($leasingAppointments instanceof LeasingAppointments) {
            return $this
                ->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $leasingAppointments->getAppointmentLeadsId(), $comparison);
        } elseif ($leasingAppointments instanceof PropelObjectCollection) {
            return $this
                ->useLeasingAppointmentsQuery()
                ->filterByPrimaryKeys($leasingAppointments->getPrimaryKeys())
                ->endUse();
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
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
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
     * @param   LeasingAppointmentLeads $leasingAppointmentLeads Object to remove from the list of results
     *
     * @return LeasingAppointmentLeadsQuery The current query, for fluid interface
     */
    public function prune($leasingAppointmentLeads = null)
    {
        if ($leasingAppointmentLeads) {
            $this->addUsingAlias(LeasingAppointmentLeadsPeer::ID, $leasingAppointmentLeads->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
