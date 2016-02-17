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
use Leasing\CoreBundle\Model\LeasingBadges;
use Leasing\CoreBundle\Model\LeasingBadgesPeer;
use Leasing\CoreBundle\Model\LeasingBadgesQuery;
use Leasing\CoreBundle\Model\LeasingLeadBadges;

/**
 * @method LeasingBadgesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingBadgesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingBadgesQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 * @method LeasingBadgesQuery orderByBadgeClass($order = Criteria::ASC) Order by the badge_class column
 * @method LeasingBadgesQuery orderByBadgeText($order = Criteria::ASC) Order by the badge_text column
 * @method LeasingBadgesQuery orderByBackgroundColor($order = Criteria::ASC) Order by the background_color column
 * @method LeasingBadgesQuery orderByTextColor($order = Criteria::ASC) Order by the text_color column
 * @method LeasingBadgesQuery orderByBadgeIcon($order = Criteria::ASC) Order by the badge_icon column
 *
 * @method LeasingBadgesQuery groupById() Group by the id column
 * @method LeasingBadgesQuery groupByStatus() Group by the status column
 * @method LeasingBadgesQuery groupByStatusId() Group by the status_id column
 * @method LeasingBadgesQuery groupByBadgeClass() Group by the badge_class column
 * @method LeasingBadgesQuery groupByBadgeText() Group by the badge_text column
 * @method LeasingBadgesQuery groupByBackgroundColor() Group by the background_color column
 * @method LeasingBadgesQuery groupByTextColor() Group by the text_color column
 * @method LeasingBadgesQuery groupByBadgeIcon() Group by the badge_icon column
 *
 * @method LeasingBadgesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingBadgesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingBadgesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingBadgesQuery leftJoinLeasingLeadBadges($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLeadBadges relation
 * @method LeasingBadgesQuery rightJoinLeasingLeadBadges($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLeadBadges relation
 * @method LeasingBadgesQuery innerJoinLeasingLeadBadges($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLeadBadges relation
 *
 * @method LeasingBadges findOne(PropelPDO $con = null) Return the first LeasingBadges matching the query
 * @method LeasingBadges findOneOrCreate(PropelPDO $con = null) Return the first LeasingBadges matching the query, or a new LeasingBadges object populated from the query conditions when no match is found
 *
 * @method LeasingBadges findOneByStatus(string $status) Return the first LeasingBadges filtered by the status column
 * @method LeasingBadges findOneByStatusId(int $status_id) Return the first LeasingBadges filtered by the status_id column
 * @method LeasingBadges findOneByBadgeClass(string $badge_class) Return the first LeasingBadges filtered by the badge_class column
 * @method LeasingBadges findOneByBadgeText(string $badge_text) Return the first LeasingBadges filtered by the badge_text column
 * @method LeasingBadges findOneByBackgroundColor(string $background_color) Return the first LeasingBadges filtered by the background_color column
 * @method LeasingBadges findOneByTextColor(string $text_color) Return the first LeasingBadges filtered by the text_color column
 * @method LeasingBadges findOneByBadgeIcon(string $badge_icon) Return the first LeasingBadges filtered by the badge_icon column
 *
 * @method array findById(int $id) Return LeasingBadges objects filtered by the id column
 * @method array findByStatus(string $status) Return LeasingBadges objects filtered by the status column
 * @method array findByStatusId(int $status_id) Return LeasingBadges objects filtered by the status_id column
 * @method array findByBadgeClass(string $badge_class) Return LeasingBadges objects filtered by the badge_class column
 * @method array findByBadgeText(string $badge_text) Return LeasingBadges objects filtered by the badge_text column
 * @method array findByBackgroundColor(string $background_color) Return LeasingBadges objects filtered by the background_color column
 * @method array findByTextColor(string $text_color) Return LeasingBadges objects filtered by the text_color column
 * @method array findByBadgeIcon(string $badge_icon) Return LeasingBadges objects filtered by the badge_icon column
 */
abstract class BaseLeasingBadgesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingBadgesQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingBadges';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingBadgesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingBadgesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingBadgesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingBadgesQuery) {
            return $criteria;
        }
        $query = new LeasingBadgesQuery(null, null, $modelAlias);

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
     * @return   LeasingBadges|LeasingBadges[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingBadgesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingBadgesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingBadges A model object, or null if the key is not found
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
     * @return                 LeasingBadges A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `status`, `status_id`, `badge_class`, `badge_text`, `background_color`, `text_color`, `badge_icon` FROM `badges` WHERE `id` = :p0';
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
            $obj = new LeasingBadges();
            $obj->hydrate($row);
            LeasingBadgesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingBadges|LeasingBadges[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingBadges[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingBadgesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingBadgesPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingBadgesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingBadgesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::ID, $id, $comparison);
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
     * @return LeasingBadgesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingBadgesPeer::STATUS, $status, $comparison);
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
     * @param     mixed $statusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByStatusId($statusId = null, $comparison = null)
    {
        if (is_array($statusId)) {
            $useMinMax = false;
            if (isset($statusId['min'])) {
                $this->addUsingAlias(LeasingBadgesPeer::STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusId['max'])) {
                $this->addUsingAlias(LeasingBadgesPeer::STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::STATUS_ID, $statusId, $comparison);
    }

    /**
     * Filter the query on the badge_class column
     *
     * Example usage:
     * <code>
     * $query->filterByBadgeClass('fooValue');   // WHERE badge_class = 'fooValue'
     * $query->filterByBadgeClass('%fooValue%'); // WHERE badge_class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $badgeClass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByBadgeClass($badgeClass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($badgeClass)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $badgeClass)) {
                $badgeClass = str_replace('*', '%', $badgeClass);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::BADGE_CLASS, $badgeClass, $comparison);
    }

    /**
     * Filter the query on the badge_text column
     *
     * Example usage:
     * <code>
     * $query->filterByBadgeText('fooValue');   // WHERE badge_text = 'fooValue'
     * $query->filterByBadgeText('%fooValue%'); // WHERE badge_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $badgeText The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByBadgeText($badgeText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($badgeText)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $badgeText)) {
                $badgeText = str_replace('*', '%', $badgeText);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::BADGE_TEXT, $badgeText, $comparison);
    }

    /**
     * Filter the query on the background_color column
     *
     * Example usage:
     * <code>
     * $query->filterByBackgroundColor('fooValue');   // WHERE background_color = 'fooValue'
     * $query->filterByBackgroundColor('%fooValue%'); // WHERE background_color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $backgroundColor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByBackgroundColor($backgroundColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($backgroundColor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $backgroundColor)) {
                $backgroundColor = str_replace('*', '%', $backgroundColor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::BACKGROUND_COLOR, $backgroundColor, $comparison);
    }

    /**
     * Filter the query on the text_color column
     *
     * Example usage:
     * <code>
     * $query->filterByTextColor('fooValue');   // WHERE text_color = 'fooValue'
     * $query->filterByTextColor('%fooValue%'); // WHERE text_color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $textColor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByTextColor($textColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($textColor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $textColor)) {
                $textColor = str_replace('*', '%', $textColor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::TEXT_COLOR, $textColor, $comparison);
    }

    /**
     * Filter the query on the badge_icon column
     *
     * Example usage:
     * <code>
     * $query->filterByBadgeIcon('fooValue');   // WHERE badge_icon = 'fooValue'
     * $query->filterByBadgeIcon('%fooValue%'); // WHERE badge_icon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $badgeIcon The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function filterByBadgeIcon($badgeIcon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($badgeIcon)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $badgeIcon)) {
                $badgeIcon = str_replace('*', '%', $badgeIcon);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingBadgesPeer::BADGE_ICON, $badgeIcon, $comparison);
    }

    /**
     * Filter the query by a related LeasingLeadBadges object
     *
     * @param   LeasingLeadBadges|PropelObjectCollection $leasingLeadBadges  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingBadgesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLeadBadges($leasingLeadBadges, $comparison = null)
    {
        if ($leasingLeadBadges instanceof LeasingLeadBadges) {
            return $this
                ->addUsingAlias(LeasingBadgesPeer::ID, $leasingLeadBadges->getBadgeId(), $comparison);
        } elseif ($leasingLeadBadges instanceof PropelObjectCollection) {
            return $this
                ->useLeasingLeadBadgesQuery()
                ->filterByPrimaryKeys($leasingLeadBadges->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingLeadBadges() only accepts arguments of type LeasingLeadBadges or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingLeadBadges relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function joinLeasingLeadBadges($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingLeadBadges');

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
            $this->addJoinObject($join, 'LeasingLeadBadges');
        }

        return $this;
    }

    /**
     * Use the LeasingLeadBadges relation LeasingLeadBadges object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingLeadBadgesQuery A secondary query class using the current class as primary query
     */
    public function useLeasingLeadBadgesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingLeadBadges($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingLeadBadges', '\Leasing\CoreBundle\Model\LeasingLeadBadgesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingBadges $leasingBadges Object to remove from the list of results
     *
     * @return LeasingBadgesQuery The current query, for fluid interface
     */
    public function prune($leasingBadges = null)
    {
        if ($leasingBadges) {
            $this->addUsingAlias(LeasingBadgesPeer::ID, $leasingBadges->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
