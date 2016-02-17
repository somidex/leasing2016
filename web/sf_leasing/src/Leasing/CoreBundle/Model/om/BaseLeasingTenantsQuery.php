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
use Leasing\CoreBundle\Model\LeasingAccountType;
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingTenantsPeer;
use Leasing\CoreBundle\Model\LeasingTenantsQuery;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitOwner;

/**
 * @method LeasingTenantsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingTenantsQuery orderByAccountType($order = Criteria::ASC) Order by the account_type column
 * @method LeasingTenantsQuery orderByBuilding($order = Criteria::ASC) Order by the building column
 * @method LeasingTenantsQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method LeasingTenantsQuery orderByPsNumber($order = Criteria::ASC) Order by the ps_number column
 * @method LeasingTenantsQuery orderByUnitOwnerId($order = Criteria::ASC) Order by the unit_owner_id column
 * @method LeasingTenantsQuery orderByTenantName($order = Criteria::ASC) Order by the tenant_name column
 * @method LeasingTenantsQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method LeasingTenantsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method LeasingTenantsQuery orderByLeaseStartDate($order = Criteria::ASC) Order by the lease_start_date column
 * @method LeasingTenantsQuery orderByLeaseEndDate($order = Criteria::ASC) Order by the lease_end_date column
 * @method LeasingTenantsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingTenantsQuery orderByPrevStatus($order = Criteria::ASC) Order by the prev_status column
 *
 * @method LeasingTenantsQuery groupById() Group by the id column
 * @method LeasingTenantsQuery groupByAccountType() Group by the account_type column
 * @method LeasingTenantsQuery groupByBuilding() Group by the building column
 * @method LeasingTenantsQuery groupByUnitId() Group by the unit_id column
 * @method LeasingTenantsQuery groupByPsNumber() Group by the ps_number column
 * @method LeasingTenantsQuery groupByUnitOwnerId() Group by the unit_owner_id column
 * @method LeasingTenantsQuery groupByTenantName() Group by the tenant_name column
 * @method LeasingTenantsQuery groupByContact() Group by the contact column
 * @method LeasingTenantsQuery groupByEmail() Group by the email column
 * @method LeasingTenantsQuery groupByLeaseStartDate() Group by the lease_start_date column
 * @method LeasingTenantsQuery groupByLeaseEndDate() Group by the lease_end_date column
 * @method LeasingTenantsQuery groupByStatus() Group by the status column
 * @method LeasingTenantsQuery groupByPrevStatus() Group by the prev_status column
 *
 * @method LeasingTenantsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingTenantsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingTenantsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingTenantsQuery leftJoinLeasingAccountType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAccountType relation
 * @method LeasingTenantsQuery rightJoinLeasingAccountType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAccountType relation
 * @method LeasingTenantsQuery innerJoinLeasingAccountType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAccountType relation
 *
 * @method LeasingTenantsQuery leftJoinLeasingUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingTenantsQuery rightJoinLeasingUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingTenantsQuery innerJoinLeasingUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnit relation
 *
 * @method LeasingTenantsQuery leftJoinLeasingUnitOwner($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitOwner relation
 * @method LeasingTenantsQuery rightJoinLeasingUnitOwner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitOwner relation
 * @method LeasingTenantsQuery innerJoinLeasingUnitOwner($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitOwner relation
 *
 * @method LeasingTenants findOne(PropelPDO $con = null) Return the first LeasingTenants matching the query
 * @method LeasingTenants findOneOrCreate(PropelPDO $con = null) Return the first LeasingTenants matching the query, or a new LeasingTenants object populated from the query conditions when no match is found
 *
 * @method LeasingTenants findOneByAccountType(int $account_type) Return the first LeasingTenants filtered by the account_type column
 * @method LeasingTenants findOneByBuilding(string $building) Return the first LeasingTenants filtered by the building column
 * @method LeasingTenants findOneByUnitId(int $unit_id) Return the first LeasingTenants filtered by the unit_id column
 * @method LeasingTenants findOneByPsNumber(string $ps_number) Return the first LeasingTenants filtered by the ps_number column
 * @method LeasingTenants findOneByUnitOwnerId(int $unit_owner_id) Return the first LeasingTenants filtered by the unit_owner_id column
 * @method LeasingTenants findOneByTenantName(string $tenant_name) Return the first LeasingTenants filtered by the tenant_name column
 * @method LeasingTenants findOneByContact(string $contact) Return the first LeasingTenants filtered by the contact column
 * @method LeasingTenants findOneByEmail(string $email) Return the first LeasingTenants filtered by the email column
 * @method LeasingTenants findOneByLeaseStartDate(string $lease_start_date) Return the first LeasingTenants filtered by the lease_start_date column
 * @method LeasingTenants findOneByLeaseEndDate(string $lease_end_date) Return the first LeasingTenants filtered by the lease_end_date column
 * @method LeasingTenants findOneByStatus(int $status) Return the first LeasingTenants filtered by the status column
 * @method LeasingTenants findOneByPrevStatus(int $prev_status) Return the first LeasingTenants filtered by the prev_status column
 *
 * @method array findById(int $id) Return LeasingTenants objects filtered by the id column
 * @method array findByAccountType(int $account_type) Return LeasingTenants objects filtered by the account_type column
 * @method array findByBuilding(string $building) Return LeasingTenants objects filtered by the building column
 * @method array findByUnitId(int $unit_id) Return LeasingTenants objects filtered by the unit_id column
 * @method array findByPsNumber(string $ps_number) Return LeasingTenants objects filtered by the ps_number column
 * @method array findByUnitOwnerId(int $unit_owner_id) Return LeasingTenants objects filtered by the unit_owner_id column
 * @method array findByTenantName(string $tenant_name) Return LeasingTenants objects filtered by the tenant_name column
 * @method array findByContact(string $contact) Return LeasingTenants objects filtered by the contact column
 * @method array findByEmail(string $email) Return LeasingTenants objects filtered by the email column
 * @method array findByLeaseStartDate(string $lease_start_date) Return LeasingTenants objects filtered by the lease_start_date column
 * @method array findByLeaseEndDate(string $lease_end_date) Return LeasingTenants objects filtered by the lease_end_date column
 * @method array findByStatus(int $status) Return LeasingTenants objects filtered by the status column
 * @method array findByPrevStatus(int $prev_status) Return LeasingTenants objects filtered by the prev_status column
 */
abstract class BaseLeasingTenantsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingTenantsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingTenants';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingTenantsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingTenantsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingTenantsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingTenantsQuery) {
            return $criteria;
        }
        $query = new LeasingTenantsQuery(null, null, $modelAlias);

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
     * @return   LeasingTenants|LeasingTenants[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingTenantsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingTenants A model object, or null if the key is not found
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
     * @return                 LeasingTenants A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `account_type`, `building`, `unit_id`, `ps_number`, `unit_owner_id`, `tenant_name`, `contact`, `email`, `lease_start_date`, `lease_end_date`, `status`, `prev_status` FROM `tenants` WHERE `id` = :p0';
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
            $obj = new LeasingTenants();
            $obj->hydrate($row);
            LeasingTenantsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingTenants|LeasingTenants[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingTenants[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingTenantsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingTenantsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingTenantsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingTenantsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the account_type column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountType(1234); // WHERE account_type = 1234
     * $query->filterByAccountType(array(12, 34)); // WHERE account_type IN (12, 34)
     * $query->filterByAccountType(array('min' => 12)); // WHERE account_type >= 12
     * $query->filterByAccountType(array('max' => 12)); // WHERE account_type <= 12
     * </code>
     *
     * @see       filterByLeasingAccountType()
     *
     * @param     mixed $accountType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByAccountType($accountType = null, $comparison = null)
    {
        if (is_array($accountType)) {
            $useMinMax = false;
            if (isset($accountType['min'])) {
                $this->addUsingAlias(LeasingTenantsPeer::ACCOUNT_TYPE, $accountType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountType['max'])) {
                $this->addUsingAlias(LeasingTenantsPeer::ACCOUNT_TYPE, $accountType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::ACCOUNT_TYPE, $accountType, $comparison);
    }

    /**
     * Filter the query on the building column
     *
     * Example usage:
     * <code>
     * $query->filterByBuilding('fooValue');   // WHERE building = 'fooValue'
     * $query->filterByBuilding('%fooValue%'); // WHERE building LIKE '%fooValue%'
     * </code>
     *
     * @param     string $building The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByBuilding($building = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($building)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $building)) {
                $building = str_replace('*', '%', $building);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::BUILDING, $building, $comparison);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(LeasingTenantsPeer::UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(LeasingTenantsPeer::UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::UNIT_ID, $unitId, $comparison);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingTenantsPeer::PS_NUMBER, $psNumber, $comparison);
    }

    /**
     * Filter the query on the unit_owner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitOwnerId(1234); // WHERE unit_owner_id = 1234
     * $query->filterByUnitOwnerId(array(12, 34)); // WHERE unit_owner_id IN (12, 34)
     * $query->filterByUnitOwnerId(array('min' => 12)); // WHERE unit_owner_id >= 12
     * $query->filterByUnitOwnerId(array('max' => 12)); // WHERE unit_owner_id <= 12
     * </code>
     *
     * @see       filterByLeasingUnitOwner()
     *
     * @param     mixed $unitOwnerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByUnitOwnerId($unitOwnerId = null, $comparison = null)
    {
        if (is_array($unitOwnerId)) {
            $useMinMax = false;
            if (isset($unitOwnerId['min'])) {
                $this->addUsingAlias(LeasingTenantsPeer::UNIT_OWNER_ID, $unitOwnerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitOwnerId['max'])) {
                $this->addUsingAlias(LeasingTenantsPeer::UNIT_OWNER_ID, $unitOwnerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::UNIT_OWNER_ID, $unitOwnerId, $comparison);
    }

    /**
     * Filter the query on the tenant_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTenantName('fooValue');   // WHERE tenant_name = 'fooValue'
     * $query->filterByTenantName('%fooValue%'); // WHERE tenant_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tenantName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByTenantName($tenantName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tenantName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tenantName)) {
                $tenantName = str_replace('*', '%', $tenantName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::TENANT_NAME, $tenantName, $comparison);
    }

    /**
     * Filter the query on the contact column
     *
     * Example usage:
     * <code>
     * $query->filterByContact('fooValue');   // WHERE contact = 'fooValue'
     * $query->filterByContact('%fooValue%'); // WHERE contact LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contact The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByContact($contact = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contact)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contact)) {
                $contact = str_replace('*', '%', $contact);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::CONTACT, $contact, $comparison);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingTenantsPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the lease_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaseStartDate('fooValue');   // WHERE lease_start_date = 'fooValue'
     * $query->filterByLeaseStartDate('%fooValue%'); // WHERE lease_start_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $leaseStartDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByLeaseStartDate($leaseStartDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaseStartDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $leaseStartDate)) {
                $leaseStartDate = str_replace('*', '%', $leaseStartDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::LEASE_START_DATE, $leaseStartDate, $comparison);
    }

    /**
     * Filter the query on the lease_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaseEndDate('fooValue');   // WHERE lease_end_date = 'fooValue'
     * $query->filterByLeaseEndDate('%fooValue%'); // WHERE lease_end_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $leaseEndDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByLeaseEndDate($leaseEndDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaseEndDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $leaseEndDate)) {
                $leaseEndDate = str_replace('*', '%', $leaseEndDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::LEASE_END_DATE, $leaseEndDate, $comparison);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingTenantsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingTenantsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::STATUS, $status, $comparison);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function filterByPrevStatus($prevStatus = null, $comparison = null)
    {
        if (is_array($prevStatus)) {
            $useMinMax = false;
            if (isset($prevStatus['min'])) {
                $this->addUsingAlias(LeasingTenantsPeer::PREV_STATUS, $prevStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevStatus['max'])) {
                $this->addUsingAlias(LeasingTenantsPeer::PREV_STATUS, $prevStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTenantsPeer::PREV_STATUS, $prevStatus, $comparison);
    }

    /**
     * Filter the query by a related LeasingAccountType object
     *
     * @param   LeasingAccountType|PropelObjectCollection $leasingAccountType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingTenantsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAccountType($leasingAccountType, $comparison = null)
    {
        if ($leasingAccountType instanceof LeasingAccountType) {
            return $this
                ->addUsingAlias(LeasingTenantsPeer::ACCOUNT_TYPE, $leasingAccountType->getId(), $comparison);
        } elseif ($leasingAccountType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingTenantsPeer::ACCOUNT_TYPE, $leasingAccountType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingAccountType() only accepts arguments of type LeasingAccountType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingAccountType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function joinLeasingAccountType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingAccountType');

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
            $this->addJoinObject($join, 'LeasingAccountType');
        }

        return $this;
    }

    /**
     * Use the LeasingAccountType relation LeasingAccountType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingAccountTypeQuery A secondary query class using the current class as primary query
     */
    public function useLeasingAccountTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingAccountType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingAccountType', '\Leasing\CoreBundle\Model\LeasingAccountTypeQuery');
    }

    /**
     * Filter the query by a related LeasingUnit object
     *
     * @param   LeasingUnit|PropelObjectCollection $leasingUnit The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingTenantsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnit($leasingUnit, $comparison = null)
    {
        if ($leasingUnit instanceof LeasingUnit) {
            return $this
                ->addUsingAlias(LeasingTenantsPeer::UNIT_ID, $leasingUnit->getId(), $comparison);
        } elseif ($leasingUnit instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingTenantsPeer::UNIT_ID, $leasingUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingTenantsQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingUnitOwner object
     *
     * @param   LeasingUnitOwner|PropelObjectCollection $leasingUnitOwner The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingTenantsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitOwner($leasingUnitOwner, $comparison = null)
    {
        if ($leasingUnitOwner instanceof LeasingUnitOwner) {
            return $this
                ->addUsingAlias(LeasingTenantsPeer::UNIT_OWNER_ID, $leasingUnitOwner->getId(), $comparison);
        } elseif ($leasingUnitOwner instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingTenantsPeer::UNIT_OWNER_ID, $leasingUnitOwner->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingUnitOwner() only accepts arguments of type LeasingUnitOwner or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitOwner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function joinLeasingUnitOwner($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitOwner');

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
            $this->addJoinObject($join, 'LeasingUnitOwner');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitOwner relation LeasingUnitOwner object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitOwnerQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitOwnerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitOwner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitOwner', '\Leasing\CoreBundle\Model\LeasingUnitOwnerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingTenants $leasingTenants Object to remove from the list of results
     *
     * @return LeasingTenantsQuery The current query, for fluid interface
     */
    public function prune($leasingTenants = null)
    {
        if ($leasingTenants) {
            $this->addUsingAlias(LeasingTenantsPeer::ID, $leasingTenants->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
