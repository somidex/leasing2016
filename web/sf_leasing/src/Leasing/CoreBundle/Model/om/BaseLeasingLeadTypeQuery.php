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
use Leasing\CoreBundle\Model\LeasingGaData;
use Leasing\CoreBundle\Model\LeasingLeadDocument;
use Leasing\CoreBundle\Model\LeasingLeadType;
use Leasing\CoreBundle\Model\LeasingLeadTypePeer;
use Leasing\CoreBundle\Model\LeasingLeadTypeQuery;
use Leasing\CoreBundle\Model\LeasingTimelineActivity;

/**
 * @method LeasingLeadTypeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingLeadTypeQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method LeasingLeadTypeQuery groupById() Group by the id column
 * @method LeasingLeadTypeQuery groupByName() Group by the name column
 *
 * @method LeasingLeadTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingLeadTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingLeadTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingLeadTypeQuery leftJoinLeasingGaData($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingGaData relation
 * @method LeasingLeadTypeQuery rightJoinLeasingGaData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingGaData relation
 * @method LeasingLeadTypeQuery innerJoinLeasingGaData($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingGaData relation
 *
 * @method LeasingLeadTypeQuery leftJoinLeasingLeadDocument($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLeadDocument relation
 * @method LeasingLeadTypeQuery rightJoinLeasingLeadDocument($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLeadDocument relation
 * @method LeasingLeadTypeQuery innerJoinLeasingLeadDocument($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLeadDocument relation
 *
 * @method LeasingLeadTypeQuery leftJoinLeasingTimelineActivity($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingTimelineActivity relation
 * @method LeasingLeadTypeQuery rightJoinLeasingTimelineActivity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingTimelineActivity relation
 * @method LeasingLeadTypeQuery innerJoinLeasingTimelineActivity($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingTimelineActivity relation
 *
 * @method LeasingLeadType findOne(PropelPDO $con = null) Return the first LeasingLeadType matching the query
 * @method LeasingLeadType findOneOrCreate(PropelPDO $con = null) Return the first LeasingLeadType matching the query, or a new LeasingLeadType object populated from the query conditions when no match is found
 *
 * @method LeasingLeadType findOneByName(string $name) Return the first LeasingLeadType filtered by the name column
 *
 * @method array findById(int $id) Return LeasingLeadType objects filtered by the id column
 * @method array findByName(string $name) Return LeasingLeadType objects filtered by the name column
 */
abstract class BaseLeasingLeadTypeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingLeadTypeQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingLeadType';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingLeadTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingLeadTypeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingLeadTypeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingLeadTypeQuery) {
            return $criteria;
        }
        $query = new LeasingLeadTypeQuery(null, null, $modelAlias);

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
     * @return   LeasingLeadType|LeasingLeadType[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingLeadTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingLeadTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingLeadType A model object, or null if the key is not found
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
     * @return                 LeasingLeadType A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name` FROM `lead_type` WHERE `id` = :p0';
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
            $obj = new LeasingLeadType();
            $obj->hydrate($row);
            LeasingLeadTypePeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingLeadType|LeasingLeadType[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingLeadType[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingLeadTypePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingLeadTypePeer::ID, $keys, Criteria::IN);
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
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingLeadTypePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingLeadTypePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadTypePeer::ID, $id, $comparison);
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
     * @return LeasingLeadTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingLeadTypePeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related LeasingGaData object
     *
     * @param   LeasingGaData|PropelObjectCollection $leasingGaData  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingLeadTypeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingGaData($leasingGaData, $comparison = null)
    {
        if ($leasingGaData instanceof LeasingGaData) {
            return $this
                ->addUsingAlias(LeasingLeadTypePeer::ID, $leasingGaData->getLeadTypeId(), $comparison);
        } elseif ($leasingGaData instanceof PropelObjectCollection) {
            return $this
                ->useLeasingGaDataQuery()
                ->filterByPrimaryKeys($leasingGaData->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingGaData() only accepts arguments of type LeasingGaData or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingGaData relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function joinLeasingGaData($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingGaData');

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
            $this->addJoinObject($join, 'LeasingGaData');
        }

        return $this;
    }

    /**
     * Use the LeasingGaData relation LeasingGaData object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingGaDataQuery A secondary query class using the current class as primary query
     */
    public function useLeasingGaDataQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingGaData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingGaData', '\Leasing\CoreBundle\Model\LeasingGaDataQuery');
    }

    /**
     * Filter the query by a related LeasingLeadDocument object
     *
     * @param   LeasingLeadDocument|PropelObjectCollection $leasingLeadDocument  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingLeadTypeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLeadDocument($leasingLeadDocument, $comparison = null)
    {
        if ($leasingLeadDocument instanceof LeasingLeadDocument) {
            return $this
                ->addUsingAlias(LeasingLeadTypePeer::ID, $leasingLeadDocument->getLeadTypeId(), $comparison);
        } elseif ($leasingLeadDocument instanceof PropelObjectCollection) {
            return $this
                ->useLeasingLeadDocumentQuery()
                ->filterByPrimaryKeys($leasingLeadDocument->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingLeadDocument() only accepts arguments of type LeasingLeadDocument or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingLeadDocument relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function joinLeasingLeadDocument($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingLeadDocument');

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
            $this->addJoinObject($join, 'LeasingLeadDocument');
        }

        return $this;
    }

    /**
     * Use the LeasingLeadDocument relation LeasingLeadDocument object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingLeadDocumentQuery A secondary query class using the current class as primary query
     */
    public function useLeasingLeadDocumentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingLeadDocument($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingLeadDocument', '\Leasing\CoreBundle\Model\LeasingLeadDocumentQuery');
    }

    /**
     * Filter the query by a related LeasingTimelineActivity object
     *
     * @param   LeasingTimelineActivity|PropelObjectCollection $leasingTimelineActivity  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingLeadTypeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingTimelineActivity($leasingTimelineActivity, $comparison = null)
    {
        if ($leasingTimelineActivity instanceof LeasingTimelineActivity) {
            return $this
                ->addUsingAlias(LeasingLeadTypePeer::ID, $leasingTimelineActivity->getLeadTypeId(), $comparison);
        } elseif ($leasingTimelineActivity instanceof PropelObjectCollection) {
            return $this
                ->useLeasingTimelineActivityQuery()
                ->filterByPrimaryKeys($leasingTimelineActivity->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingTimelineActivity() only accepts arguments of type LeasingTimelineActivity or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingTimelineActivity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function joinLeasingTimelineActivity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingTimelineActivity');

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
            $this->addJoinObject($join, 'LeasingTimelineActivity');
        }

        return $this;
    }

    /**
     * Use the LeasingTimelineActivity relation LeasingTimelineActivity object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingTimelineActivityQuery A secondary query class using the current class as primary query
     */
    public function useLeasingTimelineActivityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingTimelineActivity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingTimelineActivity', '\Leasing\CoreBundle\Model\LeasingTimelineActivityQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingLeadType $leasingLeadType Object to remove from the list of results
     *
     * @return LeasingLeadTypeQuery The current query, for fluid interface
     */
    public function prune($leasingLeadType = null)
    {
        if ($leasingLeadType) {
            $this->addUsingAlias(LeasingLeadTypePeer::ID, $leasingLeadType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
