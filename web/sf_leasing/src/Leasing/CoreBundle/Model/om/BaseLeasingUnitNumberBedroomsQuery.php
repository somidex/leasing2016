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
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedrooms;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsPeer;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsQuery;

/**
 * @method LeasingUnitNumberBedroomsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingUnitNumberBedroomsQuery orderByBedrooms($order = Criteria::ASC) Order by the bedrooms column
 * @method LeasingUnitNumberBedroomsQuery orderByBrCode($order = Criteria::ASC) Order by the br_code column
 *
 * @method LeasingUnitNumberBedroomsQuery groupById() Group by the id column
 * @method LeasingUnitNumberBedroomsQuery groupByBedrooms() Group by the bedrooms column
 * @method LeasingUnitNumberBedroomsQuery groupByBrCode() Group by the br_code column
 *
 * @method LeasingUnitNumberBedroomsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingUnitNumberBedroomsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingUnitNumberBedroomsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingUnitNumberBedroomsQuery leftJoinLeasingUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingUnitNumberBedroomsQuery rightJoinLeasingUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingUnit relation
 * @method LeasingUnitNumberBedroomsQuery innerJoinLeasingUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingUnit relation
 *
 * @method LeasingUnitNumberBedrooms findOne(PropelPDO $con = null) Return the first LeasingUnitNumberBedrooms matching the query
 * @method LeasingUnitNumberBedrooms findOneOrCreate(PropelPDO $con = null) Return the first LeasingUnitNumberBedrooms matching the query, or a new LeasingUnitNumberBedrooms object populated from the query conditions when no match is found
 *
 * @method LeasingUnitNumberBedrooms findOneByBedrooms(string $bedrooms) Return the first LeasingUnitNumberBedrooms filtered by the bedrooms column
 * @method LeasingUnitNumberBedrooms findOneByBrCode(string $br_code) Return the first LeasingUnitNumberBedrooms filtered by the br_code column
 *
 * @method array findById(int $id) Return LeasingUnitNumberBedrooms objects filtered by the id column
 * @method array findByBedrooms(string $bedrooms) Return LeasingUnitNumberBedrooms objects filtered by the bedrooms column
 * @method array findByBrCode(string $br_code) Return LeasingUnitNumberBedrooms objects filtered by the br_code column
 */
abstract class BaseLeasingUnitNumberBedroomsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingUnitNumberBedroomsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingUnitNumberBedrooms';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingUnitNumberBedroomsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingUnitNumberBedroomsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingUnitNumberBedroomsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingUnitNumberBedroomsQuery) {
            return $criteria;
        }
        $query = new LeasingUnitNumberBedroomsQuery(null, null, $modelAlias);

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
     * @return   LeasingUnitNumberBedrooms|LeasingUnitNumberBedrooms[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingUnitNumberBedroomsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitNumberBedroomsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingUnitNumberBedrooms A model object, or null if the key is not found
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
     * @return                 LeasingUnitNumberBedrooms A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `bedrooms`, `br_code` FROM `unit_no_br` WHERE `id` = :p0';
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
            $obj = new LeasingUnitNumberBedrooms();
            $obj->hydrate($row);
            LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingUnitNumberBedrooms|LeasingUnitNumberBedrooms[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingUnitNumberBedrooms[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the bedrooms column
     *
     * Example usage:
     * <code>
     * $query->filterByBedrooms('fooValue');   // WHERE bedrooms = 'fooValue'
     * $query->filterByBedrooms('%fooValue%'); // WHERE bedrooms LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bedrooms The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     */
    public function filterByBedrooms($bedrooms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bedrooms)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bedrooms)) {
                $bedrooms = str_replace('*', '%', $bedrooms);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::BEDROOMS, $bedrooms, $comparison);
    }

    /**
     * Filter the query on the br_code column
     *
     * Example usage:
     * <code>
     * $query->filterByBrCode('fooValue');   // WHERE br_code = 'fooValue'
     * $query->filterByBrCode('%fooValue%'); // WHERE br_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $brCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     */
    public function filterByBrCode($brCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $brCode)) {
                $brCode = str_replace('*', '%', $brCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::BR_CODE, $brCode, $comparison);
    }

    /**
     * Filter the query by a related LeasingUnit object
     *
     * @param   LeasingUnit|PropelObjectCollection $leasingUnit  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingUnit($leasingUnit, $comparison = null)
    {
        if ($leasingUnit instanceof LeasingUnit) {
            return $this
                ->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $leasingUnit->getBrId(), $comparison);
        } elseif ($leasingUnit instanceof PropelObjectCollection) {
            return $this
                ->useLeasingUnitQuery()
                ->filterByPrimaryKeys($leasingUnit->getPrimaryKeys())
                ->endUse();
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
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   LeasingUnitNumberBedrooms $leasingUnitNumberBedrooms Object to remove from the list of results
     *
     * @return LeasingUnitNumberBedroomsQuery The current query, for fluid interface
     */
    public function prune($leasingUnitNumberBedrooms = null)
    {
        if ($leasingUnitNumberBedrooms) {
            $this->addUsingAlias(LeasingUnitNumberBedroomsPeer::ID, $leasingUnitNumberBedrooms->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
