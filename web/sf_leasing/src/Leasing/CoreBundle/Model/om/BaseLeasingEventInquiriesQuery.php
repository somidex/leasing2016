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
use Leasing\CoreBundle\Model\LeasingEventInquiries;
use Leasing\CoreBundle\Model\LeasingEventInquiriesPeer;
use Leasing\CoreBundle\Model\LeasingEventInquiriesQuery;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventPlace;

/**
 * @method LeasingEventInquiriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingEventInquiriesQuery orderByEventPlaceId($order = Criteria::ASC) Order by the event_place_id column
 * @method LeasingEventInquiriesQuery orderByEventLeadsId($order = Criteria::ASC) Order by the event_leads_id column
 * @method LeasingEventInquiriesQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method LeasingEventInquiriesQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method LeasingEventInquiriesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingEventInquiriesQuery orderByPrevStatus($order = Criteria::ASC) Order by the prev_status column
 *
 * @method LeasingEventInquiriesQuery groupById() Group by the id column
 * @method LeasingEventInquiriesQuery groupByEventPlaceId() Group by the event_place_id column
 * @method LeasingEventInquiriesQuery groupByEventLeadsId() Group by the event_leads_id column
 * @method LeasingEventInquiriesQuery groupByMessage() Group by the message column
 * @method LeasingEventInquiriesQuery groupByDateAdded() Group by the date_added column
 * @method LeasingEventInquiriesQuery groupByStatus() Group by the status column
 * @method LeasingEventInquiriesQuery groupByPrevStatus() Group by the prev_status column
 *
 * @method LeasingEventInquiriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingEventInquiriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingEventInquiriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingEventInquiriesQuery leftJoinLeasingEventPlace($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventPlace relation
 * @method LeasingEventInquiriesQuery rightJoinLeasingEventPlace($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventPlace relation
 * @method LeasingEventInquiriesQuery innerJoinLeasingEventPlace($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventPlace relation
 *
 * @method LeasingEventInquiriesQuery leftJoinLeasingEventLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventLeads relation
 * @method LeasingEventInquiriesQuery rightJoinLeasingEventLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventLeads relation
 * @method LeasingEventInquiriesQuery innerJoinLeasingEventLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventLeads relation
 *
 * @method LeasingEventInquiries findOne(PropelPDO $con = null) Return the first LeasingEventInquiries matching the query
 * @method LeasingEventInquiries findOneOrCreate(PropelPDO $con = null) Return the first LeasingEventInquiries matching the query, or a new LeasingEventInquiries object populated from the query conditions when no match is found
 *
 * @method LeasingEventInquiries findOneByEventPlaceId(int $event_place_id) Return the first LeasingEventInquiries filtered by the event_place_id column
 * @method LeasingEventInquiries findOneByEventLeadsId(int $event_leads_id) Return the first LeasingEventInquiries filtered by the event_leads_id column
 * @method LeasingEventInquiries findOneByMessage(string $message) Return the first LeasingEventInquiries filtered by the message column
 * @method LeasingEventInquiries findOneByDateAdded(string $date_added) Return the first LeasingEventInquiries filtered by the date_added column
 * @method LeasingEventInquiries findOneByStatus(int $status) Return the first LeasingEventInquiries filtered by the status column
 * @method LeasingEventInquiries findOneByPrevStatus(int $prev_status) Return the first LeasingEventInquiries filtered by the prev_status column
 *
 * @method array findById(int $id) Return LeasingEventInquiries objects filtered by the id column
 * @method array findByEventPlaceId(int $event_place_id) Return LeasingEventInquiries objects filtered by the event_place_id column
 * @method array findByEventLeadsId(int $event_leads_id) Return LeasingEventInquiries objects filtered by the event_leads_id column
 * @method array findByMessage(string $message) Return LeasingEventInquiries objects filtered by the message column
 * @method array findByDateAdded(string $date_added) Return LeasingEventInquiries objects filtered by the date_added column
 * @method array findByStatus(int $status) Return LeasingEventInquiries objects filtered by the status column
 * @method array findByPrevStatus(int $prev_status) Return LeasingEventInquiries objects filtered by the prev_status column
 */
abstract class BaseLeasingEventInquiriesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingEventInquiriesQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingEventInquiries';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingEventInquiriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingEventInquiriesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingEventInquiriesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingEventInquiriesQuery) {
            return $criteria;
        }
        $query = new LeasingEventInquiriesQuery(null, null, $modelAlias);

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
     * @return   LeasingEventInquiries|LeasingEventInquiries[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingEventInquiriesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventInquiriesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingEventInquiries A model object, or null if the key is not found
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
     * @return                 LeasingEventInquiries A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `event_place_id`, `event_leads_id`, `message`, `date_added`, `status`, `prev_status` FROM `event_inquiries` WHERE `id` = :p0';
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
            $obj = new LeasingEventInquiries();
            $obj->hydrate($row);
            LeasingEventInquiriesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingEventInquiries|LeasingEventInquiries[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingEventInquiries[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingEventInquiriesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingEventInquiriesPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventInquiriesPeer::ID, $id, $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByEventPlaceId($eventPlaceId = null, $comparison = null)
    {
        if (is_array($eventPlaceId)) {
            $useMinMax = false;
            if (isset($eventPlaceId['min'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::EVENT_PLACE_ID, $eventPlaceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventPlaceId['max'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::EVENT_PLACE_ID, $eventPlaceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventInquiriesPeer::EVENT_PLACE_ID, $eventPlaceId, $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByEventLeadsId($eventLeadsId = null, $comparison = null)
    {
        if (is_array($eventLeadsId)) {
            $useMinMax = false;
            if (isset($eventLeadsId['min'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::EVENT_LEADS_ID, $eventLeadsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventLeadsId['max'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::EVENT_LEADS_ID, $eventLeadsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventInquiriesPeer::EVENT_LEADS_ID, $eventLeadsId, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingEventInquiriesPeer::MESSAGE, $message, $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingEventInquiriesPeer::DATE_ADDED, $dateAdded, $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventInquiriesPeer::STATUS, $status, $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function filterByPrevStatus($prevStatus = null, $comparison = null)
    {
        if (is_array($prevStatus)) {
            $useMinMax = false;
            if (isset($prevStatus['min'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::PREV_STATUS, $prevStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevStatus['max'])) {
                $this->addUsingAlias(LeasingEventInquiriesPeer::PREV_STATUS, $prevStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingEventInquiriesPeer::PREV_STATUS, $prevStatus, $comparison);
    }

    /**
     * Filter the query by a related LeasingEventPlace object
     *
     * @param   LeasingEventPlace|PropelObjectCollection $leasingEventPlace The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingEventInquiriesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventPlace($leasingEventPlace, $comparison = null)
    {
        if ($leasingEventPlace instanceof LeasingEventPlace) {
            return $this
                ->addUsingAlias(LeasingEventInquiriesPeer::EVENT_PLACE_ID, $leasingEventPlace->getId(), $comparison);
        } elseif ($leasingEventPlace instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingEventInquiriesPeer::EVENT_PLACE_ID, $leasingEventPlace->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
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
     * @return                 LeasingEventInquiriesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventLeads($leasingEventLeads, $comparison = null)
    {
        if ($leasingEventLeads instanceof LeasingEventLeads) {
            return $this
                ->addUsingAlias(LeasingEventInquiriesPeer::EVENT_LEADS_ID, $leasingEventLeads->getId(), $comparison);
        } elseif ($leasingEventLeads instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingEventInquiriesPeer::EVENT_LEADS_ID, $leasingEventLeads->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   LeasingEventInquiries $leasingEventInquiries Object to remove from the list of results
     *
     * @return LeasingEventInquiriesQuery The current query, for fluid interface
     */
    public function prune($leasingEventInquiries = null)
    {
        if ($leasingEventInquiries) {
            $this->addUsingAlias(LeasingEventInquiriesPeer::ID, $leasingEventInquiries->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
