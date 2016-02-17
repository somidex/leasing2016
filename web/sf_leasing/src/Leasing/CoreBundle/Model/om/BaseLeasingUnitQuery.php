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
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingLeaseType;
use Leasing\CoreBundle\Model\LeasingLocation;
use Leasing\CoreBundle\Model\LeasingPriceRange;
use Leasing\CoreBundle\Model\LeasingProjects;
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitCalendar;
use Leasing\CoreBundle\Model\LeasingUnitDressUp;
use Leasing\CoreBundle\Model\LeasingUnitFeatures;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedrooms;
use Leasing\CoreBundle\Model\LeasingUnitPeer;
use Leasing\CoreBundle\Model\LeasingUnitQuery;
use Leasing\CoreBundle\Model\LeasingUnitType;

/**
 * @method LeasingUnitQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingUnitQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method LeasingUnitQuery orderByPostId($order = Criteria::ASC) Order by the post_id column
 * @method LeasingUnitQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method LeasingUnitQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method LeasingUnitQuery orderByAvailability($order = Criteria::ASC) Order by the availability column
 * @method LeasingUnitQuery orderByPriceRange($order = Criteria::ASC) Order by the price_range column
 * @method LeasingUnitQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingUnitQuery orderByUnitTypeId($order = Criteria::ASC) Order by the unit_type_id column
 * @method LeasingUnitQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method LeasingUnitQuery orderByLeaseTypeId($order = Criteria::ASC) Order by the lease_type_id column
 * @method LeasingUnitQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method LeasingUnitQuery orderByBrId($order = Criteria::ASC) Order by the br_id column
 * @method LeasingUnitQuery orderByDressUpId($order = Criteria::ASC) Order by the dress_up_id column
 *
 * @method LeasingUnitQuery groupById() Group by the id column
 * @method LeasingUnitQuery groupByName() Group by the name column
 * @method LeasingUnitQuery groupByPostId() Group by the post_id column
 * @method LeasingUnitQuery groupBySlug() Group by the slug column
 * @method LeasingUnitQuery groupByContent() Group by the content column
 * @method LeasingUnitQuery groupByAvailability() Group by the availability column
 * @method LeasingUnitQuery groupByPriceRange() Group by the price_range column
 * @method LeasingUnitQuery groupByStatus() Group by the status column
 * @method LeasingUnitQuery groupByUnitTypeId() Group by the unit_type_id column
 * @method LeasingUnitQuery groupByLocationId() Group by the location_id column
 * @method LeasingUnitQuery groupByLeaseTypeId() Group by the lease_type_id column
 * @method LeasingUnitQuery groupByProjectId() Group by the project_id column
 * @method LeasingUnitQuery groupByBrId() Group by the br_id column
 * @method LeasingUnitQuery groupByDressUpId() Group by the dress_up_id column
 *
 * @method LeasingUnitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingUnitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingUnitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingUnitQuery leftJoinLeasingUnitType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitType relation
 * @method LeasingUnitQuery rightJoinLeasingUnitType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitType relation
 * @method LeasingUnitQuery innerJoinLeasingUnitType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitType relation
 *
 * @method LeasingUnitQuery leftJoinLeasingLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLocation relation
 * @method LeasingUnitQuery rightJoinLeasingLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLocation relation
 * @method LeasingUnitQuery innerJoinLeasingLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLocation relation
 *
 * @method LeasingUnitQuery leftJoinLeasingLeaseType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLeaseType relation
 * @method LeasingUnitQuery rightJoinLeasingLeaseType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLeaseType relation
 * @method LeasingUnitQuery innerJoinLeasingLeaseType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLeaseType relation
 *
 * @method LeasingUnitQuery leftJoinLeasingProjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingProjects relation
 * @method LeasingUnitQuery rightJoinLeasingProjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingProjects relation
 * @method LeasingUnitQuery innerJoinLeasingProjects($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingProjects relation
 *
 * @method LeasingUnitQuery leftJoinLeasingUnitDressUp($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitDressUp relation
 * @method LeasingUnitQuery rightJoinLeasingUnitDressUp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitDressUp relation
 * @method LeasingUnitQuery innerJoinLeasingUnitDressUp($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitDressUp relation
 *
 * @method LeasingUnitQuery leftJoinLeasingUnitNumberBedrooms($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitNumberBedrooms relation
 * @method LeasingUnitQuery rightJoinLeasingUnitNumberBedrooms($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitNumberBedrooms relation
 * @method LeasingUnitQuery innerJoinLeasingUnitNumberBedrooms($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitNumberBedrooms relation
 *
 * @method LeasingUnitQuery leftJoinLeasingAppointments($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointments relation
 * @method LeasingUnitQuery rightJoinLeasingAppointments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointments relation
 * @method LeasingUnitQuery innerJoinLeasingAppointments($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointments relation
 *
 * @method LeasingUnitQuery leftJoinLeasingBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookings relation
 * @method LeasingUnitQuery rightJoinLeasingBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookings relation
 * @method LeasingUnitQuery innerJoinLeasingBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookings relation
 *
 * @method LeasingUnitQuery leftJoinLeasingPriceRange($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingPriceRange relation
 * @method LeasingUnitQuery rightJoinLeasingPriceRange($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingPriceRange relation
 * @method LeasingUnitQuery innerJoinLeasingPriceRange($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingPriceRange relation
 *
 * @method LeasingUnitQuery leftJoinLeasingTenants($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingTenants relation
 * @method LeasingUnitQuery rightJoinLeasingTenants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingTenants relation
 * @method LeasingUnitQuery innerJoinLeasingTenants($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingTenants relation
 *
 * @method LeasingUnitQuery leftJoinLeasingUnitCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitCalendar relation
 * @method LeasingUnitQuery rightJoinLeasingUnitCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitCalendar relation
 * @method LeasingUnitQuery innerJoinLeasingUnitCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitCalendar relation
 *
 * @method LeasingUnitQuery leftJoinLeasingUnitFeatures($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnitFeatures relation
 * @method LeasingUnitQuery rightJoinLeasingUnitFeatures($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnitFeatures relation
 * @method LeasingUnitQuery innerJoinLeasingUnitFeatures($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnitFeatures relation
 *
 * @method LeasingUnit findOne(PropelPDO $con = null) Return the first LeasingUnit matching the query
 * @method LeasingUnit findOneOrCreate(PropelPDO $con = null) Return the first LeasingUnit matching the query, or a new LeasingUnit object populated from the query conditions when no match is found
 *
 * @method LeasingUnit findOneByName(string $name) Return the first LeasingUnit filtered by the name column
 * @method LeasingUnit findOneByPostId(int $post_id) Return the first LeasingUnit filtered by the post_id column
 * @method LeasingUnit findOneBySlug(string $slug) Return the first LeasingUnit filtered by the slug column
 * @method LeasingUnit findOneByContent(string $content) Return the first LeasingUnit filtered by the content column
 * @method LeasingUnit findOneByAvailability(int $availability) Return the first LeasingUnit filtered by the availability column
 * @method LeasingUnit findOneByPriceRange(string $price_range) Return the first LeasingUnit filtered by the price_range column
 * @method LeasingUnit findOneByStatus(int $status) Return the first LeasingUnit filtered by the status column
 * @method LeasingUnit findOneByUnitTypeId(int $unit_type_id) Return the first LeasingUnit filtered by the unit_type_id column
 * @method LeasingUnit findOneByLocationId(int $location_id) Return the first LeasingUnit filtered by the location_id column
 * @method LeasingUnit findOneByLeaseTypeId(int $lease_type_id) Return the first LeasingUnit filtered by the lease_type_id column
 * @method LeasingUnit findOneByProjectId(int $project_id) Return the first LeasingUnit filtered by the project_id column
 * @method LeasingUnit findOneByBrId(int $br_id) Return the first LeasingUnit filtered by the br_id column
 * @method LeasingUnit findOneByDressUpId(int $dress_up_id) Return the first LeasingUnit filtered by the dress_up_id column
 *
 * @method array findById(int $id) Return LeasingUnit objects filtered by the id column
 * @method array findByName(string $name) Return LeasingUnit objects filtered by the name column
 * @method array findByPostId(int $post_id) Return LeasingUnit objects filtered by the post_id column
 * @method array findBySlug(string $slug) Return LeasingUnit objects filtered by the slug column
 * @method array findByContent(string $content) Return LeasingUnit objects filtered by the content column
 * @method array findByAvailability(int $availability) Return LeasingUnit objects filtered by the availability column
 * @method array findByPriceRange(string $price_range) Return LeasingUnit objects filtered by the price_range column
 * @method array findByStatus(int $status) Return LeasingUnit objects filtered by the status column
 * @method array findByUnitTypeId(int $unit_type_id) Return LeasingUnit objects filtered by the unit_type_id column
 * @method array findByLocationId(int $location_id) Return LeasingUnit objects filtered by the location_id column
 * @method array findByLeaseTypeId(int $lease_type_id) Return LeasingUnit objects filtered by the lease_type_id column
 * @method array findByProjectId(int $project_id) Return LeasingUnit objects filtered by the project_id column
 * @method array findByBrId(int $br_id) Return LeasingUnit objects filtered by the br_id column
 * @method array findByDressUpId(int $dress_up_id) Return LeasingUnit objects filtered by the dress_up_id column
 */
abstract class BaseLeasingUnitQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingUnitQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingUnit';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingUnitQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingUnitQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingUnitQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingUnitQuery) {
            return $criteria;
        }
        $query = new LeasingUnitQuery(null, null, $modelAlias);

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
     * @return   LeasingUnit|LeasingUnit[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingUnitPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingUnit A model object, or null if the key is not found
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
     * @return                 LeasingUnit A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `post_id`, `slug`, `content`, `availability`, `price_range`, `status`, `unit_type_id`, `location_id`, `lease_type_id`, `project_id`, `br_id`, `dress_up_id` FROM `unit` WHERE `id` = :p0';
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
            $obj = new LeasingUnit();
            $obj->hydrate($row);
            LeasingUnitPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingUnit|LeasingUnit[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingUnit[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingUnitPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingUnitPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::ID, $id, $comparison);
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
     * @return LeasingUnitQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingUnitPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the post_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPostId(1234); // WHERE post_id = 1234
     * $query->filterByPostId(array(12, 34)); // WHERE post_id IN (12, 34)
     * $query->filterByPostId(array('min' => 12)); // WHERE post_id >= 12
     * $query->filterByPostId(array('max' => 12)); // WHERE post_id <= 12
     * </code>
     *
     * @param     mixed $postId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByPostId($postId = null, $comparison = null)
    {
        if (is_array($postId)) {
            $useMinMax = false;
            if (isset($postId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::POST_ID, $postId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::POST_ID, $postId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::POST_ID, $postId, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the availability column
     *
     * Example usage:
     * <code>
     * $query->filterByAvailability(1234); // WHERE availability = 1234
     * $query->filterByAvailability(array(12, 34)); // WHERE availability IN (12, 34)
     * $query->filterByAvailability(array('min' => 12)); // WHERE availability >= 12
     * $query->filterByAvailability(array('max' => 12)); // WHERE availability <= 12
     * </code>
     *
     * @param     mixed $availability The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByAvailability($availability = null, $comparison = null)
    {
        if (is_array($availability)) {
            $useMinMax = false;
            if (isset($availability['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::AVAILABILITY, $availability['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($availability['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::AVAILABILITY, $availability['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::AVAILABILITY, $availability, $comparison);
    }

    /**
     * Filter the query on the price_range column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceRange('fooValue');   // WHERE price_range = 'fooValue'
     * $query->filterByPriceRange('%fooValue%'); // WHERE price_range LIKE '%fooValue%'
     * </code>
     *
     * @param     string $priceRange The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByPriceRange($priceRange = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($priceRange)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $priceRange)) {
                $priceRange = str_replace('*', '%', $priceRange);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::PRICE_RANGE, $priceRange, $comparison);
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
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the unit_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitTypeId(1234); // WHERE unit_type_id = 1234
     * $query->filterByUnitTypeId(array(12, 34)); // WHERE unit_type_id IN (12, 34)
     * $query->filterByUnitTypeId(array('min' => 12)); // WHERE unit_type_id >= 12
     * $query->filterByUnitTypeId(array('max' => 12)); // WHERE unit_type_id <= 12
     * </code>
     *
     * @see       filterByLeasingUnitType()
     *
     * @param     mixed $unitTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByUnitTypeId($unitTypeId = null, $comparison = null)
    {
        if (is_array($unitTypeId)) {
            $useMinMax = false;
            if (isset($unitTypeId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::UNIT_TYPE_ID, $unitTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitTypeId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::UNIT_TYPE_ID, $unitTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::UNIT_TYPE_ID, $unitTypeId, $comparison);
    }

    /**
     * Filter the query on the location_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE location_id = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE location_id IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE location_id >= 12
     * $query->filterByLocationId(array('max' => 12)); // WHERE location_id <= 12
     * </code>
     *
     * @see       filterByLeasingLocation()
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the lease_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaseTypeId(1234); // WHERE lease_type_id = 1234
     * $query->filterByLeaseTypeId(array(12, 34)); // WHERE lease_type_id IN (12, 34)
     * $query->filterByLeaseTypeId(array('min' => 12)); // WHERE lease_type_id >= 12
     * $query->filterByLeaseTypeId(array('max' => 12)); // WHERE lease_type_id <= 12
     * </code>
     *
     * @see       filterByLeasingLeaseType()
     *
     * @param     mixed $leaseTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByLeaseTypeId($leaseTypeId = null, $comparison = null)
    {
        if (is_array($leaseTypeId)) {
            $useMinMax = false;
            if (isset($leaseTypeId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::LEASE_TYPE_ID, $leaseTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaseTypeId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::LEASE_TYPE_ID, $leaseTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::LEASE_TYPE_ID, $leaseTypeId, $comparison);
    }

    /**
     * Filter the query on the project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectId(1234); // WHERE project_id = 1234
     * $query->filterByProjectId(array(12, 34)); // WHERE project_id IN (12, 34)
     * $query->filterByProjectId(array('min' => 12)); // WHERE project_id >= 12
     * $query->filterByProjectId(array('max' => 12)); // WHERE project_id <= 12
     * </code>
     *
     * @see       filterByLeasingProjects()
     *
     * @param     mixed $projectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByProjectId($projectId = null, $comparison = null)
    {
        if (is_array($projectId)) {
            $useMinMax = false;
            if (isset($projectId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::PROJECT_ID, $projectId, $comparison);
    }

    /**
     * Filter the query on the br_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrId(1234); // WHERE br_id = 1234
     * $query->filterByBrId(array(12, 34)); // WHERE br_id IN (12, 34)
     * $query->filterByBrId(array('min' => 12)); // WHERE br_id >= 12
     * $query->filterByBrId(array('max' => 12)); // WHERE br_id <= 12
     * </code>
     *
     * @see       filterByLeasingUnitNumberBedrooms()
     *
     * @param     mixed $brId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByBrId($brId = null, $comparison = null)
    {
        if (is_array($brId)) {
            $useMinMax = false;
            if (isset($brId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::BR_ID, $brId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::BR_ID, $brId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::BR_ID, $brId, $comparison);
    }

    /**
     * Filter the query on the dress_up_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDressUpId(1234); // WHERE dress_up_id = 1234
     * $query->filterByDressUpId(array(12, 34)); // WHERE dress_up_id IN (12, 34)
     * $query->filterByDressUpId(array('min' => 12)); // WHERE dress_up_id >= 12
     * $query->filterByDressUpId(array('max' => 12)); // WHERE dress_up_id <= 12
     * </code>
     *
     * @see       filterByLeasingUnitDressUp()
     *
     * @param     mixed $dressUpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function filterByDressUpId($dressUpId = null, $comparison = null)
    {
        if (is_array($dressUpId)) {
            $useMinMax = false;
            if (isset($dressUpId['min'])) {
                $this->addUsingAlias(LeasingUnitPeer::DRESS_UP_ID, $dressUpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dressUpId['max'])) {
                $this->addUsingAlias(LeasingUnitPeer::DRESS_UP_ID, $dressUpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitPeer::DRESS_UP_ID, $dressUpId, $comparison);
    }

    /**
     * Filter the query by a related LeasingUnitType object
     *
     * @param   LeasingUnitType|PropelObjectCollection $leasingUnitType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitType($leasingUnitType, $comparison = null)
    {
        if ($leasingUnitType instanceof LeasingUnitType) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::UNIT_TYPE_ID, $leasingUnitType->getId(), $comparison);
        } elseif ($leasingUnitType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitPeer::UNIT_TYPE_ID, $leasingUnitType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingUnitType() only accepts arguments of type LeasingUnitType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingUnitType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitType');

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
            $this->addJoinObject($join, 'LeasingUnitType');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitType relation LeasingUnitType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitTypeQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitType', '\Leasing\CoreBundle\Model\LeasingUnitTypeQuery');
    }

    /**
     * Filter the query by a related LeasingLocation object
     *
     * @param   LeasingLocation|PropelObjectCollection $leasingLocation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLocation($leasingLocation, $comparison = null)
    {
        if ($leasingLocation instanceof LeasingLocation) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::LOCATION_ID, $leasingLocation->getId(), $comparison);
        } elseif ($leasingLocation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitPeer::LOCATION_ID, $leasingLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingLocation() only accepts arguments of type LeasingLocation or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingLocation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingLocation');

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
            $this->addJoinObject($join, 'LeasingLocation');
        }

        return $this;
    }

    /**
     * Use the LeasingLocation relation LeasingLocation object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingLocationQuery A secondary query class using the current class as primary query
     */
    public function useLeasingLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingLocation', '\Leasing\CoreBundle\Model\LeasingLocationQuery');
    }

    /**
     * Filter the query by a related LeasingLeaseType object
     *
     * @param   LeasingLeaseType|PropelObjectCollection $leasingLeaseType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLeaseType($leasingLeaseType, $comparison = null)
    {
        if ($leasingLeaseType instanceof LeasingLeaseType) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::LEASE_TYPE_ID, $leasingLeaseType->getId(), $comparison);
        } elseif ($leasingLeaseType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitPeer::LEASE_TYPE_ID, $leasingLeaseType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingLeaseType() only accepts arguments of type LeasingLeaseType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingLeaseType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingLeaseType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingLeaseType');

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
            $this->addJoinObject($join, 'LeasingLeaseType');
        }

        return $this;
    }

    /**
     * Use the LeasingLeaseType relation LeasingLeaseType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingLeaseTypeQuery A secondary query class using the current class as primary query
     */
    public function useLeasingLeaseTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingLeaseType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingLeaseType', '\Leasing\CoreBundle\Model\LeasingLeaseTypeQuery');
    }

    /**
     * Filter the query by a related LeasingProjects object
     *
     * @param   LeasingProjects|PropelObjectCollection $leasingProjects The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingProjects($leasingProjects, $comparison = null)
    {
        if ($leasingProjects instanceof LeasingProjects) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::PROJECT_ID, $leasingProjects->getId(), $comparison);
        } elseif ($leasingProjects instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitPeer::PROJECT_ID, $leasingProjects->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingProjects() only accepts arguments of type LeasingProjects or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingProjects relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingProjects($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingProjects');

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
            $this->addJoinObject($join, 'LeasingProjects');
        }

        return $this;
    }

    /**
     * Use the LeasingProjects relation LeasingProjects object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingProjectsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingProjectsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingProjects($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingProjects', '\Leasing\CoreBundle\Model\LeasingProjectsQuery');
    }

    /**
     * Filter the query by a related LeasingUnitDressUp object
     *
     * @param   LeasingUnitDressUp|PropelObjectCollection $leasingUnitDressUp The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitDressUp($leasingUnitDressUp, $comparison = null)
    {
        if ($leasingUnitDressUp instanceof LeasingUnitDressUp) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::DRESS_UP_ID, $leasingUnitDressUp->getId(), $comparison);
        } elseif ($leasingUnitDressUp instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitPeer::DRESS_UP_ID, $leasingUnitDressUp->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingUnitDressUp() only accepts arguments of type LeasingUnitDressUp or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitDressUp relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingUnitDressUp($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitDressUp');

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
            $this->addJoinObject($join, 'LeasingUnitDressUp');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitDressUp relation LeasingUnitDressUp object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitDressUpQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitDressUpQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitDressUp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitDressUp', '\Leasing\CoreBundle\Model\LeasingUnitDressUpQuery');
    }

    /**
     * Filter the query by a related LeasingUnitNumberBedrooms object
     *
     * @param   LeasingUnitNumberBedrooms|PropelObjectCollection $leasingUnitNumberBedrooms The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitNumberBedrooms($leasingUnitNumberBedrooms, $comparison = null)
    {
        if ($leasingUnitNumberBedrooms instanceof LeasingUnitNumberBedrooms) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::BR_ID, $leasingUnitNumberBedrooms->getId(), $comparison);
        } elseif ($leasingUnitNumberBedrooms instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitPeer::BR_ID, $leasingUnitNumberBedrooms->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingUnitNumberBedrooms() only accepts arguments of type LeasingUnitNumberBedrooms or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitNumberBedrooms relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingUnitNumberBedrooms($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitNumberBedrooms');

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
            $this->addJoinObject($join, 'LeasingUnitNumberBedrooms');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitNumberBedrooms relation LeasingUnitNumberBedrooms object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitNumberBedroomsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitNumberBedrooms($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitNumberBedrooms', '\Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsQuery');
    }

    /**
     * Filter the query by a related LeasingAppointments object
     *
     * @param   LeasingAppointments|PropelObjectCollection $leasingAppointments  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointments($leasingAppointments, $comparison = null)
    {
        if ($leasingAppointments instanceof LeasingAppointments) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::ID, $leasingAppointments->getUnitId(), $comparison);
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
     * @return LeasingUnitQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingBookings object
     *
     * @param   LeasingBookings|PropelObjectCollection $leasingBookings  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookings($leasingBookings, $comparison = null)
    {
        if ($leasingBookings instanceof LeasingBookings) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::ID, $leasingBookings->getUnitId(), $comparison);
        } elseif ($leasingBookings instanceof PropelObjectCollection) {
            return $this
                ->useLeasingBookingsQuery()
                ->filterByPrimaryKeys($leasingBookings->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingBookings() only accepts arguments of type LeasingBookings or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBookings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingBookings($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBookings');

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
            $this->addJoinObject($join, 'LeasingBookings');
        }

        return $this;
    }

    /**
     * Use the LeasingBookings relation LeasingBookings object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBookingsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBookingsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBookings', '\Leasing\CoreBundle\Model\LeasingBookingsQuery');
    }

    /**
     * Filter the query by a related LeasingPriceRange object
     *
     * @param   LeasingPriceRange|PropelObjectCollection $leasingPriceRange  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingPriceRange($leasingPriceRange, $comparison = null)
    {
        if ($leasingPriceRange instanceof LeasingPriceRange) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::ID, $leasingPriceRange->getUnitId(), $comparison);
        } elseif ($leasingPriceRange instanceof PropelObjectCollection) {
            return $this
                ->useLeasingPriceRangeQuery()
                ->filterByPrimaryKeys($leasingPriceRange->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingPriceRange() only accepts arguments of type LeasingPriceRange or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingPriceRange relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingPriceRange($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingPriceRange');

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
            $this->addJoinObject($join, 'LeasingPriceRange');
        }

        return $this;
    }

    /**
     * Use the LeasingPriceRange relation LeasingPriceRange object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingPriceRangeQuery A secondary query class using the current class as primary query
     */
    public function useLeasingPriceRangeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingPriceRange($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingPriceRange', '\Leasing\CoreBundle\Model\LeasingPriceRangeQuery');
    }

    /**
     * Filter the query by a related LeasingTenants object
     *
     * @param   LeasingTenants|PropelObjectCollection $leasingTenants  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingTenants($leasingTenants, $comparison = null)
    {
        if ($leasingTenants instanceof LeasingTenants) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::ID, $leasingTenants->getUnitId(), $comparison);
        } elseif ($leasingTenants instanceof PropelObjectCollection) {
            return $this
                ->useLeasingTenantsQuery()
                ->filterByPrimaryKeys($leasingTenants->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingTenants() only accepts arguments of type LeasingTenants or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingTenants relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingTenants($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingTenants');

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
            $this->addJoinObject($join, 'LeasingTenants');
        }

        return $this;
    }

    /**
     * Use the LeasingTenants relation LeasingTenants object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingTenantsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingTenantsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingTenants($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingTenants', '\Leasing\CoreBundle\Model\LeasingTenantsQuery');
    }

    /**
     * Filter the query by a related LeasingUnitCalendar object
     *
     * @param   LeasingUnitCalendar|PropelObjectCollection $leasingUnitCalendar  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitCalendar($leasingUnitCalendar, $comparison = null)
    {
        if ($leasingUnitCalendar instanceof LeasingUnitCalendar) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::ID, $leasingUnitCalendar->getUnitId(), $comparison);
        } elseif ($leasingUnitCalendar instanceof PropelObjectCollection) {
            return $this
                ->useLeasingUnitCalendarQuery()
                ->filterByPrimaryKeys($leasingUnitCalendar->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingUnitCalendar() only accepts arguments of type LeasingUnitCalendar or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitCalendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingUnitCalendar($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitCalendar');

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
            $this->addJoinObject($join, 'LeasingUnitCalendar');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitCalendar relation LeasingUnitCalendar object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitCalendarQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitCalendarQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitCalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitCalendar', '\Leasing\CoreBundle\Model\LeasingUnitCalendarQuery');
    }

    /**
     * Filter the query by a related LeasingUnitFeatures object
     *
     * @param   LeasingUnitFeatures|PropelObjectCollection $leasingUnitFeatures  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnitFeatures($leasingUnitFeatures, $comparison = null)
    {
        if ($leasingUnitFeatures instanceof LeasingUnitFeatures) {
            return $this
                ->addUsingAlias(LeasingUnitPeer::ID, $leasingUnitFeatures->getUnitId(), $comparison);
        } elseif ($leasingUnitFeatures instanceof PropelObjectCollection) {
            return $this
                ->useLeasingUnitFeaturesQuery()
                ->filterByPrimaryKeys($leasingUnitFeatures->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingUnitFeatures() only accepts arguments of type LeasingUnitFeatures or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingUnitFeatures relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function joinLeasingUnitFeatures($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingUnitFeatures');

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
            $this->addJoinObject($join, 'LeasingUnitFeatures');
        }

        return $this;
    }

    /**
     * Use the LeasingUnitFeatures relation LeasingUnitFeatures object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingUnitFeaturesQuery A secondary query class using the current class as primary query
     */
    public function useLeasingUnitFeaturesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingUnitFeatures($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingUnitFeatures', '\Leasing\CoreBundle\Model\LeasingUnitFeaturesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingUnit $leasingUnit Object to remove from the list of results
     *
     * @return LeasingUnitQuery The current query, for fluid interface
     */
    public function prune($leasingUnit = null)
    {
        if ($leasingUnit) {
            $this->addUsingAlias(LeasingUnitPeer::ID, $leasingUnit->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
