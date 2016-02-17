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
use Leasing\CoreBundle\Model\LeasingBookingLeads;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingNationality;
use Leasing\CoreBundle\Model\LeasingNationalityPeer;
use Leasing\CoreBundle\Model\LeasingNationalityQuery;

/**
 * @method LeasingNationalityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingNationalityQuery orderByNationalityName($order = Criteria::ASC) Order by the nationality_name column
 *
 * @method LeasingNationalityQuery groupById() Group by the id column
 * @method LeasingNationalityQuery groupByNationalityName() Group by the nationality_name column
 *
 * @method LeasingNationalityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingNationalityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingNationalityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingNationalityQuery leftJoinLeasingAppointmentLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingAppointmentLeads relation
 * @method LeasingNationalityQuery rightJoinLeasingAppointmentLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingAppointmentLeads relation
 * @method LeasingNationalityQuery innerJoinLeasingAppointmentLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingAppointmentLeads relation
 *
 * @method LeasingNationalityQuery leftJoinLeasingBookingLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookingLeads relation
 * @method LeasingNationalityQuery rightJoinLeasingBookingLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookingLeads relation
 * @method LeasingNationalityQuery innerJoinLeasingBookingLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookingLeads relation
 *
 * @method LeasingNationalityQuery leftJoinLeasingEventLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventLeads relation
 * @method LeasingNationalityQuery rightJoinLeasingEventLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventLeads relation
 * @method LeasingNationalityQuery innerJoinLeasingEventLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventLeads relation
 *
 * @method LeasingNationality findOne(PropelPDO $con = null) Return the first LeasingNationality matching the query
 * @method LeasingNationality findOneOrCreate(PropelPDO $con = null) Return the first LeasingNationality matching the query, or a new LeasingNationality object populated from the query conditions when no match is found
 *
 * @method LeasingNationality findOneByNationalityName(string $nationality_name) Return the first LeasingNationality filtered by the nationality_name column
 *
 * @method array findById(int $id) Return LeasingNationality objects filtered by the id column
 * @method array findByNationalityName(string $nationality_name) Return LeasingNationality objects filtered by the nationality_name column
 */
abstract class BaseLeasingNationalityQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingNationalityQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingNationality';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingNationalityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingNationalityQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingNationalityQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingNationalityQuery) {
            return $criteria;
        }
        $query = new LeasingNationalityQuery(null, null, $modelAlias);

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
     * @return   LeasingNationality|LeasingNationality[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingNationalityPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingNationalityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingNationality A model object, or null if the key is not found
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
     * @return                 LeasingNationality A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `nationality_name` FROM `nationality` WHERE `id` = :p0';
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
            $obj = new LeasingNationality();
            $obj->hydrate($row);
            LeasingNationalityPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingNationality|LeasingNationality[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingNationality[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingNationalityPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingNationalityPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingNationalityPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingNationalityPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingNationalityPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the nationality_name column
     *
     * Example usage:
     * <code>
     * $query->filterByNationalityName('fooValue');   // WHERE nationality_name = 'fooValue'
     * $query->filterByNationalityName('%fooValue%'); // WHERE nationality_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nationalityName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function filterByNationalityName($nationalityName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nationalityName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nationalityName)) {
                $nationalityName = str_replace('*', '%', $nationalityName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingNationalityPeer::NATIONALITY_NAME, $nationalityName, $comparison);
    }

    /**
     * Filter the query by a related LeasingAppointmentLeads object
     *
     * @param   LeasingAppointmentLeads|PropelObjectCollection $leasingAppointmentLeads  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingNationalityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingAppointmentLeads($leasingAppointmentLeads, $comparison = null)
    {
        if ($leasingAppointmentLeads instanceof LeasingAppointmentLeads) {
            return $this
                ->addUsingAlias(LeasingNationalityPeer::ID, $leasingAppointmentLeads->getNationalityId(), $comparison);
        } elseif ($leasingAppointmentLeads instanceof PropelObjectCollection) {
            return $this
                ->useLeasingAppointmentLeadsQuery()
                ->filterByPrimaryKeys($leasingAppointmentLeads->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingAppointmentLeads() only accepts arguments of type LeasingAppointmentLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingAppointmentLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function joinLeasingAppointmentLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingAppointmentLeads');

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
            $this->addJoinObject($join, 'LeasingAppointmentLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingAppointmentLeads relation LeasingAppointmentLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingAppointmentLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingAppointmentLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingAppointmentLeads', '\Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery');
    }

    /**
     * Filter the query by a related LeasingBookingLeads object
     *
     * @param   LeasingBookingLeads|PropelObjectCollection $leasingBookingLeads  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingNationalityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookingLeads($leasingBookingLeads, $comparison = null)
    {
        if ($leasingBookingLeads instanceof LeasingBookingLeads) {
            return $this
                ->addUsingAlias(LeasingNationalityPeer::ID, $leasingBookingLeads->getNationalityId(), $comparison);
        } elseif ($leasingBookingLeads instanceof PropelObjectCollection) {
            return $this
                ->useLeasingBookingLeadsQuery()
                ->filterByPrimaryKeys($leasingBookingLeads->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingBookingLeads() only accepts arguments of type LeasingBookingLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBookingLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function joinLeasingBookingLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBookingLeads');

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
            $this->addJoinObject($join, 'LeasingBookingLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingBookingLeads relation LeasingBookingLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBookingLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBookingLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBookingLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBookingLeads', '\Leasing\CoreBundle\Model\LeasingBookingLeadsQuery');
    }

    /**
     * Filter the query by a related LeasingEventLeads object
     *
     * @param   LeasingEventLeads|PropelObjectCollection $leasingEventLeads  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingNationalityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventLeads($leasingEventLeads, $comparison = null)
    {
        if ($leasingEventLeads instanceof LeasingEventLeads) {
            return $this
                ->addUsingAlias(LeasingNationalityPeer::ID, $leasingEventLeads->getNationalityId(), $comparison);
        } elseif ($leasingEventLeads instanceof PropelObjectCollection) {
            return $this
                ->useLeasingEventLeadsQuery()
                ->filterByPrimaryKeys($leasingEventLeads->getPrimaryKeys())
                ->endUse();
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
     * @return LeasingNationalityQuery The current query, for fluid interface
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
     * @param   LeasingNationality $leasingNationality Object to remove from the list of results
     *
     * @return LeasingNationalityQuery The current query, for fluid interface
     */
    public function prune($leasingNationality = null)
    {
        if ($leasingNationality) {
            $this->addUsingAlias(LeasingNationalityPeer::ID, $leasingNationality->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
