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
use Leasing\CoreBundle\Model\LeasingFeatures;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitFeatures;
use Leasing\CoreBundle\Model\LeasingUnitFeaturesPeer;
use Leasing\CoreBundle\Model\LeasingUnitFeaturesQuery;

/**
 * @method LeasingUnitFeaturesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingUnitFeaturesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method LeasingUnitFeaturesQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method LeasingUnitFeaturesQuery orderByFeaturesId($order = Criteria::ASC) Order by the features_id column
 *
 * @method LeasingUnitFeaturesQuery groupById() Group by the id column
 * @method LeasingUnitFeaturesQuery groupByStatus() Group by the status column
 * @method LeasingUnitFeaturesQuery groupByUnitId() Group by the unit_id column
 * @method LeasingUnitFeaturesQuery groupByFeaturesId() Group by the features_id column
 *
 * @method LeasingUnitFeaturesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingUnitFeaturesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingUnitFeaturesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingUnitFeaturesQuery leftJoinLeasingUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingUnitFeaturesQuery rightJoinLeasingUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingUnitFeaturesQuery innerJoinLeasingUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnit relation
 *
 * @method LeasingUnitFeaturesQuery leftJoinLeasingFeatures($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingFeatures relation
 * @method LeasingUnitFeaturesQuery rightJoinLeasingFeatures($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingFeatures relation
 * @method LeasingUnitFeaturesQuery innerJoinLeasingFeatures($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingFeatures relation
 *
 * @method LeasingUnitFeatures findOne(PropelPDO $con = null) Return the first LeasingUnitFeatures matching the query
 * @method LeasingUnitFeatures findOneOrCreate(PropelPDO $con = null) Return the first LeasingUnitFeatures matching the query, or a new LeasingUnitFeatures object populated from the query conditions when no match is found
 *
 * @method LeasingUnitFeatures findOneByStatus(int $status) Return the first LeasingUnitFeatures filtered by the status column
 * @method LeasingUnitFeatures findOneByUnitId(int $unit_id) Return the first LeasingUnitFeatures filtered by the unit_id column
 * @method LeasingUnitFeatures findOneByFeaturesId(int $features_id) Return the first LeasingUnitFeatures filtered by the features_id column
 *
 * @method array findById(int $id) Return LeasingUnitFeatures objects filtered by the id column
 * @method array findByStatus(int $status) Return LeasingUnitFeatures objects filtered by the status column
 * @method array findByUnitId(int $unit_id) Return LeasingUnitFeatures objects filtered by the unit_id column
 * @method array findByFeaturesId(int $features_id) Return LeasingUnitFeatures objects filtered by the features_id column
 */
abstract class BaseLeasingUnitFeaturesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingUnitFeaturesQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingUnitFeatures';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingUnitFeaturesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingUnitFeaturesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingUnitFeaturesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingUnitFeaturesQuery) {
            return $criteria;
        }
        $query = new LeasingUnitFeaturesQuery(null, null, $modelAlias);

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
     * @return   LeasingUnitFeatures|LeasingUnitFeatures[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingUnitFeaturesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitFeaturesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingUnitFeatures A model object, or null if the key is not found
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
     * @return                 LeasingUnitFeatures A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `status`, `unit_id`, `features_id` FROM `unit_features` WHERE `id` = :p0';
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
            $obj = new LeasingUnitFeatures();
            $obj->hydrate($row);
            LeasingUnitFeaturesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingUnitFeatures|LeasingUnitFeatures[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingUnitFeatures[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingUnitFeaturesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingUnitFeaturesPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitFeaturesPeer::ID, $id, $comparison);
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
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitFeaturesPeer::STATUS, $status, $comparison);
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
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitFeaturesPeer::UNIT_ID, $unitId, $comparison);
    }

    /**
     * Filter the query on the features_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFeaturesId(1234); // WHERE features_id = 1234
     * $query->filterByFeaturesId(array(12, 34)); // WHERE features_id IN (12, 34)
     * $query->filterByFeaturesId(array('min' => 12)); // WHERE features_id >= 12
     * $query->filterByFeaturesId(array('max' => 12)); // WHERE features_id <= 12
     * </code>
     *
     * @see       filterByLeasingFeatures()
     *
     * @param     mixed $featuresId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function filterByFeaturesId($featuresId = null, $comparison = null)
    {
        if (is_array($featuresId)) {
            $useMinMax = false;
            if (isset($featuresId['min'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::FEATURES_ID, $featuresId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($featuresId['max'])) {
                $this->addUsingAlias(LeasingUnitFeaturesPeer::FEATURES_ID, $featuresId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitFeaturesPeer::FEATURES_ID, $featuresId, $comparison);
    }

    /**
     * Filter the query by a related LeasingUnit object
     *
     * @param   LeasingUnit|PropelObjectCollection $leasingUnit The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitFeaturesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnit($leasingUnit, $comparison = null)
    {
        if ($leasingUnit instanceof LeasingUnit) {
            return $this
                ->addUsingAlias(LeasingUnitFeaturesPeer::UNIT_ID, $leasingUnit->getId(), $comparison);
        } elseif ($leasingUnit instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitFeaturesPeer::UNIT_ID, $leasingUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingFeatures object
     *
     * @param   LeasingFeatures|PropelObjectCollection $leasingFeatures The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitFeaturesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingFeatures($leasingFeatures, $comparison = null)
    {
        if ($leasingFeatures instanceof LeasingFeatures) {
            return $this
                ->addUsingAlias(LeasingUnitFeaturesPeer::FEATURES_ID, $leasingFeatures->getId(), $comparison);
        } elseif ($leasingFeatures instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingUnitFeaturesPeer::FEATURES_ID, $leasingFeatures->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingFeatures() only accepts arguments of type LeasingFeatures or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingFeatures relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function joinLeasingFeatures($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingFeatures');

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
            $this->addJoinObject($join, 'LeasingFeatures');
        }

        return $this;
    }

    /**
     * Use the LeasingFeatures relation LeasingFeatures object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingFeaturesQuery A secondary query class using the current class as primary query
     */
    public function useLeasingFeaturesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingFeatures($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingFeatures', '\Leasing\CoreBundle\Model\LeasingFeaturesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingUnitFeatures $leasingUnitFeatures Object to remove from the list of results
     *
     * @return LeasingUnitFeaturesQuery The current query, for fluid interface
     */
    public function prune($leasingUnitFeatures = null)
    {
        if ($leasingUnitFeatures) {
            $this->addUsingAlias(LeasingUnitFeaturesPeer::ID, $leasingUnitFeatures->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
