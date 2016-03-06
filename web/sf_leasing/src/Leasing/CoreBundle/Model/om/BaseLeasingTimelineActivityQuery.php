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
use Leasing\CoreBundle\Model\LeasingLeadType;
use Leasing\CoreBundle\Model\LeasingStatus;
use Leasing\CoreBundle\Model\LeasingTimelineActivity;
use Leasing\CoreBundle\Model\LeasingTimelineActivityPeer;
use Leasing\CoreBundle\Model\LeasingTimelineActivityQuery;

/**
 * @method LeasingTimelineActivityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingTimelineActivityQuery orderByLeadTypeId($order = Criteria::ASC) Order by the lead_type_id column
 * @method LeasingTimelineActivityQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method LeasingTimelineActivityQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method LeasingTimelineActivityQuery orderByActivity($order = Criteria::ASC) Order by the activity column
 * @method LeasingTimelineActivityQuery orderByTimestamp($order = Criteria::ASC) Order by the timestamp column
 * @method LeasingTimelineActivityQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method LeasingTimelineActivityQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingTimelineActivityQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 *
 * @method LeasingTimelineActivityQuery groupById() Group by the id column
 * @method LeasingTimelineActivityQuery groupByLeadTypeId() Group by the lead_type_id column
 * @method LeasingTimelineActivityQuery groupByLeadId() Group by the lead_id column
 * @method LeasingTimelineActivityQuery groupByUser() Group by the user column
 * @method LeasingTimelineActivityQuery groupByActivity() Group by the activity column
 * @method LeasingTimelineActivityQuery groupByTimestamp() Group by the timestamp column
 * @method LeasingTimelineActivityQuery groupByNotes() Group by the notes column
 * @method LeasingTimelineActivityQuery groupByStatus() Group by the status column
 * @method LeasingTimelineActivityQuery groupByStatusId() Group by the status_id column
 *
 * @method LeasingTimelineActivityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingTimelineActivityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingTimelineActivityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingTimelineActivityQuery leftJoinLeasingLeadType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLeadType relation
 * @method LeasingTimelineActivityQuery rightJoinLeasingLeadType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLeadType relation
 * @method LeasingTimelineActivityQuery innerJoinLeasingLeadType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLeadType relation
 *
 * @method LeasingTimelineActivityQuery leftJoinLeasingStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingStatus relation
 * @method LeasingTimelineActivityQuery rightJoinLeasingStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingStatus relation
 * @method LeasingTimelineActivityQuery innerJoinLeasingStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingStatus relation
 *
 * @method LeasingTimelineActivity findOne(PropelPDO $con = null) Return the first LeasingTimelineActivity matching the query
 * @method LeasingTimelineActivity findOneOrCreate(PropelPDO $con = null) Return the first LeasingTimelineActivity matching the query, or a new LeasingTimelineActivity object populated from the query conditions when no match is found
 *
 * @method LeasingTimelineActivity findOneByLeadTypeId(int $lead_type_id) Return the first LeasingTimelineActivity filtered by the lead_type_id column
 * @method LeasingTimelineActivity findOneByLeadId(int $lead_id) Return the first LeasingTimelineActivity filtered by the lead_id column
 * @method LeasingTimelineActivity findOneByUser(string $user) Return the first LeasingTimelineActivity filtered by the user column
 * @method LeasingTimelineActivity findOneByActivity(string $activity) Return the first LeasingTimelineActivity filtered by the activity column
 * @method LeasingTimelineActivity findOneByTimestamp(string $timestamp) Return the first LeasingTimelineActivity filtered by the timestamp column
 * @method LeasingTimelineActivity findOneByNotes(string $notes) Return the first LeasingTimelineActivity filtered by the notes column
 * @method LeasingTimelineActivity findOneByStatus(string $status) Return the first LeasingTimelineActivity filtered by the status column
 * @method LeasingTimelineActivity findOneByStatusId(int $status_id) Return the first LeasingTimelineActivity filtered by the status_id column
 *
 * @method array findById(int $id) Return LeasingTimelineActivity objects filtered by the id column
 * @method array findByLeadTypeId(int $lead_type_id) Return LeasingTimelineActivity objects filtered by the lead_type_id column
 * @method array findByLeadId(int $lead_id) Return LeasingTimelineActivity objects filtered by the lead_id column
 * @method array findByUser(string $user) Return LeasingTimelineActivity objects filtered by the user column
 * @method array findByActivity(string $activity) Return LeasingTimelineActivity objects filtered by the activity column
 * @method array findByTimestamp(string $timestamp) Return LeasingTimelineActivity objects filtered by the timestamp column
 * @method array findByNotes(string $notes) Return LeasingTimelineActivity objects filtered by the notes column
 * @method array findByStatus(string $status) Return LeasingTimelineActivity objects filtered by the status column
 * @method array findByStatusId(int $status_id) Return LeasingTimelineActivity objects filtered by the status_id column
 */
abstract class BaseLeasingTimelineActivityQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingTimelineActivityQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingTimelineActivity';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingTimelineActivityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingTimelineActivityQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingTimelineActivityQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingTimelineActivityQuery) {
            return $criteria;
        }
        $query = new LeasingTimelineActivityQuery(null, null, $modelAlias);

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
     * @return   LeasingTimelineActivity|LeasingTimelineActivity[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingTimelineActivityPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingTimelineActivityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingTimelineActivity A model object, or null if the key is not found
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
     * @return                 LeasingTimelineActivity A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `lead_type_id`, `lead_id`, `user`, `activity`, `timestamp`, `notes`, `status`, `status_id` FROM `timeline_activity` WHERE `id` = :p0';
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
            $obj = new LeasingTimelineActivity();
            $obj->hydrate($row);
            LeasingTimelineActivityPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingTimelineActivity|LeasingTimelineActivity[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingTimelineActivity[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingTimelineActivityPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingTimelineActivityPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the lead_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeadTypeId(1234); // WHERE lead_type_id = 1234
     * $query->filterByLeadTypeId(array(12, 34)); // WHERE lead_type_id IN (12, 34)
     * $query->filterByLeadTypeId(array('min' => 12)); // WHERE lead_type_id >= 12
     * $query->filterByLeadTypeId(array('max' => 12)); // WHERE lead_type_id <= 12
     * </code>
     *
     * @see       filterByLeasingLeadType()
     *
     * @param     mixed $leadTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByLeadTypeId($leadTypeId = null, $comparison = null)
    {
        if (is_array($leadTypeId)) {
            $useMinMax = false;
            if (isset($leadTypeId['min'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::LEAD_TYPE_ID, $leadTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadTypeId['max'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::LEAD_TYPE_ID, $leadTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::LEAD_TYPE_ID, $leadTypeId, $comparison);
    }

    /**
     * Filter the query on the lead_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeadId(1234); // WHERE lead_id = 1234
     * $query->filterByLeadId(array(12, 34)); // WHERE lead_id IN (12, 34)
     * $query->filterByLeadId(array('min' => 12)); // WHERE lead_id >= 12
     * $query->filterByLeadId(array('max' => 12)); // WHERE lead_id <= 12
     * </code>
     *
     * @param     mixed $leadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::LEAD_ID, $leadId, $comparison);
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterByUser('fooValue');   // WHERE user = 'fooValue'
     * $query->filterByUser('%fooValue%'); // WHERE user LIKE '%fooValue%'
     * </code>
     *
     * @param     string $user The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByUser($user = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($user)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $user)) {
                $user = str_replace('*', '%', $user);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::USER, $user, $comparison);
    }

    /**
     * Filter the query on the activity column
     *
     * Example usage:
     * <code>
     * $query->filterByActivity('fooValue');   // WHERE activity = 'fooValue'
     * $query->filterByActivity('%fooValue%'); // WHERE activity LIKE '%fooValue%'
     * </code>
     *
     * @param     string $activity The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByActivity($activity = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activity)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $activity)) {
                $activity = str_replace('*', '%', $activity);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::ACTIVITY, $activity, $comparison);
    }

    /**
     * Filter the query on the timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByTimestamp('fooValue');   // WHERE timestamp = 'fooValue'
     * $query->filterByTimestamp('%fooValue%'); // WHERE timestamp LIKE '%fooValue%'
     * </code>
     *
     * @param     string $timestamp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByTimestamp($timestamp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timestamp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $timestamp)) {
                $timestamp = str_replace('*', '%', $timestamp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::TIMESTAMP, $timestamp, $comparison);
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
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingTimelineActivityPeer::NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusId(1234); // WHERE status_id = 1234
     * $query->filterByStatusId(array(12, 34)); // WHERE status_id IN (12, 34)
     * $query->filterByStatusId(array('min' => 12)); // WHERE status_id >= 12
     * $query->filterByStatusId(array('max' => 12)); // WHERE status_id <= 12
     * </code>
     *
     * @see       filterByLeasingStatus()
     *
     * @param     mixed $statusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function filterByStatusId($statusId = null, $comparison = null)
    {
        if (is_array($statusId)) {
            $useMinMax = false;
            if (isset($statusId['min'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusId['max'])) {
                $this->addUsingAlias(LeasingTimelineActivityPeer::STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingTimelineActivityPeer::STATUS_ID, $statusId, $comparison);
    }

    /**
     * Filter the query by a related LeasingLeadType object
     *
     * @param   LeasingLeadType|PropelObjectCollection $leasingLeadType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingTimelineActivityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLeadType($leasingLeadType, $comparison = null)
    {
        if ($leasingLeadType instanceof LeasingLeadType) {
            return $this
                ->addUsingAlias(LeasingTimelineActivityPeer::LEAD_TYPE_ID, $leasingLeadType->getId(), $comparison);
        } elseif ($leasingLeadType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingTimelineActivityPeer::LEAD_TYPE_ID, $leasingLeadType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingLeadType() only accepts arguments of type LeasingLeadType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingLeadType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function joinLeasingLeadType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingLeadType');

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
            $this->addJoinObject($join, 'LeasingLeadType');
        }

        return $this;
    }

    /**
     * Use the LeasingLeadType relation LeasingLeadType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingLeadTypeQuery A secondary query class using the current class as primary query
     */
    public function useLeasingLeadTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingLeadType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingLeadType', '\Leasing\CoreBundle\Model\LeasingLeadTypeQuery');
    }

    /**
     * Filter the query by a related LeasingStatus object
     *
     * @param   LeasingStatus|PropelObjectCollection $leasingStatus The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingTimelineActivityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingStatus($leasingStatus, $comparison = null)
    {
        if ($leasingStatus instanceof LeasingStatus) {
            return $this
                ->addUsingAlias(LeasingTimelineActivityPeer::STATUS_ID, $leasingStatus->getId(), $comparison);
        } elseif ($leasingStatus instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingTimelineActivityPeer::STATUS_ID, $leasingStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingStatus() only accepts arguments of type LeasingStatus or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function joinLeasingStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingStatus');

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
            $this->addJoinObject($join, 'LeasingStatus');
        }

        return $this;
    }

    /**
     * Use the LeasingStatus relation LeasingStatus object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingStatusQuery A secondary query class using the current class as primary query
     */
    public function useLeasingStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingStatus', '\Leasing\CoreBundle\Model\LeasingStatusQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingTimelineActivity $leasingTimelineActivity Object to remove from the list of results
     *
     * @return LeasingTimelineActivityQuery The current query, for fluid interface
     */
    public function prune($leasingTimelineActivity = null)
    {
        if ($leasingTimelineActivity) {
            $this->addUsingAlias(LeasingTimelineActivityPeer::ID, $leasingTimelineActivity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
