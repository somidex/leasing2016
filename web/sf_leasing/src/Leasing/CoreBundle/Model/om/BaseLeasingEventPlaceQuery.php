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
use Leasing\CoreBundle\Model\LeasingEventInquiries;
use Leasing\CoreBundle\Model\LeasingEventPlace;
use Leasing\CoreBundle\Model\LeasingEventPlacePeer;
use Leasing\CoreBundle\Model\LeasingEventPlaceQuery;

/**
 * @method LeasingEventPlaceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingEventPlaceQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method LeasingEventPlaceQuery orderByPostId($order = Criteria::ASC) Order by the post_id column
 * @method LeasingEventPlaceQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method LeasingEventPlaceQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method LeasingEventPlaceQuery orderByShortAddress($order = Criteria::ASC) Order by the short_address column
 * @method LeasingEventPlaceQuery orderByFullAddress($order = Criteria::ASC) Order by the full_address column
 * @method LeasingEventPlaceQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method LeasingEventPlaceQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method LeasingEventPlaceQuery orderByMin($order = Criteria::ASC) Order by the min column
 * @method LeasingEventPlaceQuery orderByMax($order = Criteria::ASC) Order by the max column
 * @method LeasingEventPlaceQuery orderByReservationFee($order = Criteria::ASC) Order by the reservation_fee column
 * @method LeasingEventPlaceQuery orderBySecurityDeposit($order = Criteria::ASC) Order by the security_deposit column
 *
 * @method LeasingEventPlaceQuery groupById() Group by the id column
 * @method LeasingEventPlaceQuery groupByName() Group by the name column
 * @method LeasingEventPlaceQuery groupByPostId() Group by the post_id column
 * @method LeasingEventPlaceQuery groupBySlug() Group by the slug column
 * @method LeasingEventPlaceQuery groupByContent() Group by the content column
 * @method LeasingEventPlaceQuery groupByShortAddress() Group by the short_address column
 * @method LeasingEventPlaceQuery groupByFullAddress() Group by the full_address column
 * @method LeasingEventPlaceQuery groupByContact() Group by the contact column
 * @method LeasingEventPlaceQuery groupByEmail() Group by the email column
 * @method LeasingEventPlaceQuery groupByMin() Group by the min column
 * @method LeasingEventPlaceQuery groupByMax() Group by the max column
 * @method LeasingEventPlaceQuery groupByReservationFee() Group by the reservation_fee column
 * @method LeasingEventPlaceQuery groupBySecurityDeposit() Group by the security_deposit column
 *
 * @method LeasingEventPlaceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingEventPlaceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingEventPlaceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingEventPlaceQuery leftJoinLeasingEventBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventBookings relation
 * @method LeasingEventPlaceQuery rightJoinLeasingEventBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventBookings relation
 * @method LeasingEventPlaceQuery innerJoinLeasingEventBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventBookings relation
 *
 * @method LeasingEventPlaceQuery leftJoinLeasingEventInquiries($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventInquiries relation
 * @method LeasingEventPlaceQuery rightJoinLeasingEventInquiries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventInquiries relation
 * @method LeasingEventPlaceQuery innerJoinLeasingEventInquiries($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventInquiries relation
 *
 * @method LeasingEventPlace findOne(PropelPDO $con = null) Return the first LeasingEventPlace matching the query
 * @method LeasingEventPlace findOneOrCreate(PropelPDO $con = null) Return the first LeasingEventPlace matching the query, or a new LeasingEventPlace object populated from the query conditions when no match is found
 *
 * @method LeasingEventPlace findOneByName(string $name) Return the first LeasingEventPlace filtered by the name column
 * @method LeasingEventPlace findOneByPostId(int $post_id) Return the first LeasingEventPlace filtered by the post_id column
 * @method LeasingEventPlace findOneBySlug(string $slug) Return the first LeasingEventPlace filtered by the slug column
 * @method LeasingEventPlace findOneByContent(string $content) Return the first LeasingEventPlace filtered by the content column
 * @method LeasingEventPlace findOneByShortAddress(string $short_address) Return the first LeasingEventPlace filtered by the short_address column
 * @method LeasingEventPlace findOneByFullAddress(string $full_address) Return the first LeasingEventPlace filtered by the full_address column
 * @method LeasingEventPlace findOneByContact(string $contact) Return the first LeasingEventPlace filtered by the contact column
 * @method LeasingEventPlace findOneByEmail(string $email) Return the first LeasingEventPlace filtered by the email column
 * @method LeasingEventPlace findOneByMin(int $min) Return the first LeasingEventPlace filtered by the min column
 * @method LeasingEventPlace findOneByMax(int $max) Return the first LeasingEventPlace filtered by the max column
 * @method LeasingEventPlace findOneByReservationFee(int $reservation_fee) Return the first LeasingEventPlace filtered by the reservation_fee column
 * @method LeasingEventPlace findOneBySecurityDeposit(int $security_deposit) Return the first LeasingEventPlace filtered by the security_deposit column
 *
 * @method array findById(int $id) Return LeasingEventPlace objects filtered by the id column
 * @method array findByName(string $name) Return LeasingEventPlace objects filtered by the name column
 * @method array findByPostId(int $post_id) Return LeasingEventPlace objects filtered by the post_id column
 * @method array findBySlug(string $slug) Return LeasingEventPlace objects filtered by the slug column
 * @method array findByContent(string $content) Return LeasingEventPlace objects filtered by the content column
 * @method array findByShortAddress(string $short_address) Return LeasingEventPlace objects filtered by the short_address column
 * @method array findByFullAddress(string $full_address) Return LeasingEventPlace objects filtered by the full_address column
 * @method array findByContact(string $contact) Return LeasingEventPlace objects filtered by the contact column
 * @method array findByEmail(string $email) Return LeasingEventPlace objects filtered by the email column
 * @method array findByMin(int $min) Return LeasingEventPlace objects filtered by the min column
 * @method array findByMax(int $max) Return LeasingEventPlace objects filtered by the max column
 * @method array findByReservationFee(int $reservation_fee) Return LeasingEventPlace objects filtered by the reservation_fee column
 * @method array findBySecurityDeposit(int $security_deposit) Return LeasingEventPlace objects filtered by the security_deposit column
 */
abstract class BaseLeasingEventPlaceQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingEventPlaceQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingEventPlace';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingEventPlaceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingEventPlaceQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingEventPlaceQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingEventPlaceQuery) {
            return $criteria;
        }
        $query = new LeasingEventPlaceQuery(null, null, $modelAlias);

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
     * @return   LeasingEventPlace|LeasingEventPlace[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingEventPlacePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventPlacePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingEventPlace A model object, or null if the key is not found
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
     * @return                 LeasingEventPlace A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `post_id`, `slug`, `content`, `short_address`, `full_address`, `contact`, `email`, `min`, `max`, `reservation_fee`, `security_deposit` FROM `event_place` WHERE `id` = :p0';
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
            $obj = new LeasingEventPlace();
            $obj->hydrate($row);
            LeasingEventPlacePeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingEventPlace|LeasingEventPlace[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingEventPlace[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingEventPlacePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingEventPlacePeer::ID, $keys, Criteria::IN);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::ID, $id, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventPlacePeer::NAME, $name, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByPostId($postId = null, $comparison = null)
    {
        if (is_array($postId)) {
            $useMinMax = false;
            if (isset($postId['min'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::POST_ID, $postId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postId['max'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::POST_ID, $postId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::POST_ID, $postId, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventPlacePeer::SLUG, $slug, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventPlacePeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the short_address column
     *
     * Example usage:
     * <code>
     * $query->filterByShortAddress('fooValue');   // WHERE short_address = 'fooValue'
     * $query->filterByShortAddress('%fooValue%'); // WHERE short_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByShortAddress($shortAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $shortAddress)) {
                $shortAddress = str_replace('*', '%', $shortAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::SHORT_ADDRESS, $shortAddress, $comparison);
    }

    /**
     * Filter the query on the full_address column
     *
     * Example usage:
     * <code>
     * $query->filterByFullAddress('fooValue');   // WHERE full_address = 'fooValue'
     * $query->filterByFullAddress('%fooValue%'); // WHERE full_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fullAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByFullAddress($fullAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fullAddress)) {
                $fullAddress = str_replace('*', '%', $fullAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::FULL_ADDRESS, $fullAddress, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventPlacePeer::CONTACT, $contact, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventPlacePeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the min column
     *
     * Example usage:
     * <code>
     * $query->filterByMin(1234); // WHERE min = 1234
     * $query->filterByMin(array(12, 34)); // WHERE min IN (12, 34)
     * $query->filterByMin(array('min' => 12)); // WHERE min >= 12
     * $query->filterByMin(array('max' => 12)); // WHERE min <= 12
     * </code>
     *
     * @param     mixed $min The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByMin($min = null, $comparison = null)
    {
        if (is_array($min)) {
            $useMinMax = false;
            if (isset($min['min'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::MIN, $min['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($min['max'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::MIN, $min['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::MIN, $min, $comparison);
    }

    /**
     * Filter the query on the max column
     *
     * Example usage:
     * <code>
     * $query->filterByMax(1234); // WHERE max = 1234
     * $query->filterByMax(array(12, 34)); // WHERE max IN (12, 34)
     * $query->filterByMax(array('min' => 12)); // WHERE max >= 12
     * $query->filterByMax(array('max' => 12)); // WHERE max <= 12
     * </code>
     *
     * @param     mixed $max The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByMax($max = null, $comparison = null)
    {
        if (is_array($max)) {
            $useMinMax = false;
            if (isset($max['min'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::MAX, $max['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($max['max'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::MAX, $max['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::MAX, $max, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterByReservationFee($reservationFee = null, $comparison = null)
    {
        if (is_array($reservationFee)) {
            $useMinMax = false;
            if (isset($reservationFee['min'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::RESERVATION_FEE, $reservationFee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reservationFee['max'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::RESERVATION_FEE, $reservationFee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::RESERVATION_FEE, $reservationFee, $comparison);
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function filterBySecurityDeposit($securityDeposit = null, $comparison = null)
    {
        if (is_array($securityDeposit)) {
            $useMinMax = false;
            if (isset($securityDeposit['min'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::SECURITY_DEPOSIT, $securityDeposit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($securityDeposit['max'])) {
                $this->addUsingAlias(LeasingEventPlacePeer::SECURITY_DEPOSIT, $securityDeposit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventPlacePeer::SECURITY_DEPOSIT, $securityDeposit, $comparison);
    }

    /**
     * Filter the query by a related LeasingEventBookings object
     *
     * @param   LeasingEventBookings|PropelObjectCollection $leasingEventBookings  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventPlaceQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventBookings($leasingEventBookings, $comparison = null)
    {
        if ($leasingEventBookings instanceof LeasingEventBookings) {
            return $this
                ->addUsingAlias(LeasingEventPlacePeer::ID, $leasingEventBookings->getEventPlaceId(), $comparison);
        } elseif ($leasingEventBookings instanceof PropelObjectCollection) {
            return $this
                ->useLeasingEventBookingsQuery()
                ->filterByPrimaryKeys($leasingEventBookings->getPrimaryKeys())
                ->endUse();
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
     * @return LeasingEventPlaceQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingEventInquiries object
     *
     * @param   LeasingEventInquiries|PropelObjectCollection $leasingEventInquiries  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventPlaceQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventInquiries($leasingEventInquiries, $comparison = null)
    {
        if ($leasingEventInquiries instanceof LeasingEventInquiries) {
            return $this
                ->addUsingAlias(LeasingEventPlacePeer::ID, $leasingEventInquiries->getEventPlaceId(), $comparison);
        } elseif ($leasingEventInquiries instanceof PropelObjectCollection) {
            return $this
                ->useLeasingEventInquiriesQuery()
                ->filterByPrimaryKeys($leasingEventInquiries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingEventInquiries() only accepts arguments of type LeasingEventInquiries or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingEventInquiries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function joinLeasingEventInquiries($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingEventInquiries');

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
            $this->addJoinObject($join, 'LeasingEventInquiries');
        }

        return $this;
    }

    /**
     * Use the LeasingEventInquiries relation LeasingEventInquiries object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingEventInquiriesQuery A secondary query class using the current class as primary query
     */
    public function useLeasingEventInquiriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingEventInquiries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingEventInquiries', '\Leasing\CoreBundle\Model\LeasingEventInquiriesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingEventPlace $leasingEventPlace Object to remove from the list of results
     *
     * @return LeasingEventPlaceQuery The current query, for fluid interface
     */
    public function prune($leasingEventPlace = null)
    {
        if ($leasingEventPlace) {
            $this->addUsingAlias(LeasingEventPlacePeer::ID, $leasingEventPlace->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
