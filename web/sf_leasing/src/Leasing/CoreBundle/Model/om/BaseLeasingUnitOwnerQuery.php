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
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingUnitOwner;
use Leasing\CoreBundle\Model\LeasingUnitOwnerPeer;
use Leasing\CoreBundle\Model\LeasingUnitOwnerQuery;

/**
 * @method LeasingUnitOwnerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingUnitOwnerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method LeasingUnitOwnerQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method LeasingUnitOwnerQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method LeasingUnitOwnerQuery orderByRepresentative($order = Criteria::ASC) Order by the representative column
 * @method LeasingUnitOwnerQuery orderByRepContact($order = Criteria::ASC) Order by the rep_contact column
 * @method LeasingUnitOwnerQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingUnitOwnerQuery groupById() Group by the id column
 * @method LeasingUnitOwnerQuery groupByName() Group by the name column
 * @method LeasingUnitOwnerQuery groupByContact() Group by the contact column
 * @method LeasingUnitOwnerQuery groupByEmail() Group by the email column
 * @method LeasingUnitOwnerQuery groupByRepresentative() Group by the representative column
 * @method LeasingUnitOwnerQuery groupByRepContact() Group by the rep_contact column
 * @method LeasingUnitOwnerQuery groupByStatus() Group by the status column
 *
 * @method LeasingUnitOwnerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingUnitOwnerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingUnitOwnerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingUnitOwnerQuery leftJoinLeasingTenants($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingTenants relation
 * @method LeasingUnitOwnerQuery rightJoinLeasingTenants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingTenants relation
 * @method LeasingUnitOwnerQuery innerJoinLeasingTenants($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingTenants relation
 *
 * @method LeasingUnitOwner findOne(PropelPDO $con = null) Return the first LeasingUnitOwner matching the query
 * @method LeasingUnitOwner findOneOrCreate(PropelPDO $con = null) Return the first LeasingUnitOwner matching the query, or a new LeasingUnitOwner object populated from the query conditions when no match is found
 *
 * @method LeasingUnitOwner findOneByName(string $name) Return the first LeasingUnitOwner filtered by the name column
 * @method LeasingUnitOwner findOneByContact(string $contact) Return the first LeasingUnitOwner filtered by the contact column
 * @method LeasingUnitOwner findOneByEmail(string $email) Return the first LeasingUnitOwner filtered by the email column
 * @method LeasingUnitOwner findOneByRepresentative(string $representative) Return the first LeasingUnitOwner filtered by the representative column
 * @method LeasingUnitOwner findOneByRepContact(string $rep_contact) Return the first LeasingUnitOwner filtered by the rep_contact column
 * @method LeasingUnitOwner findOneByStatus(int $status) Return the first LeasingUnitOwner filtered by the status column
 *
 * @method array findById(int $id) Return LeasingUnitOwner objects filtered by the id column
 * @method array findByName(string $name) Return LeasingUnitOwner objects filtered by the name column
 * @method array findByContact(string $contact) Return LeasingUnitOwner objects filtered by the contact column
 * @method array findByEmail(string $email) Return LeasingUnitOwner objects filtered by the email column
 * @method array findByRepresentative(string $representative) Return LeasingUnitOwner objects filtered by the representative column
 * @method array findByRepContact(string $rep_contact) Return LeasingUnitOwner objects filtered by the rep_contact column
 * @method array findByStatus(int $status) Return LeasingUnitOwner objects filtered by the status column
 */
abstract class BaseLeasingUnitOwnerQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingUnitOwnerQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingUnitOwner';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingUnitOwnerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingUnitOwnerQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingUnitOwnerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingUnitOwnerQuery) {
            return $criteria;
        }
        $query = new LeasingUnitOwnerQuery(null, null, $modelAlias);

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
     * @return   LeasingUnitOwner|LeasingUnitOwner[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingUnitOwnerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitOwnerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingUnitOwner A model object, or null if the key is not found
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
     * @return                 LeasingUnitOwner A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `contact`, `email`, `representative`, `rep_contact`, `status` FROM `unit_owner` WHERE `id` = :p0';
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
            $obj = new LeasingUnitOwner();
            $obj->hydrate($row);
            LeasingUnitOwnerPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingUnitOwner|LeasingUnitOwner[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingUnitOwner[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingUnitOwnerPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingUnitOwnerPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingUnitOwnerPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingUnitOwnerPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitOwnerPeer::ID, $id, $comparison);
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingUnitOwnerPeer::NAME, $name, $comparison);
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingUnitOwnerPeer::CONTACT, $contact, $comparison);
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingUnitOwnerPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the representative column
     *
     * Example usage:
     * <code>
     * $query->filterByRepresentative('fooValue');   // WHERE representative = 'fooValue'
     * $query->filterByRepresentative('%fooValue%'); // WHERE representative LIKE '%fooValue%'
     * </code>
     *
     * @param     string $representative The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function filterByRepresentative($representative = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($representative)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $representative)) {
                $representative = str_replace('*', '%', $representative);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitOwnerPeer::REPRESENTATIVE, $representative, $comparison);
    }

    /**
     * Filter the query on the rep_contact column
     *
     * Example usage:
     * <code>
     * $query->filterByRepContact('fooValue');   // WHERE rep_contact = 'fooValue'
     * $query->filterByRepContact('%fooValue%'); // WHERE rep_contact LIKE '%fooValue%'
     * </code>
     *
     * @param     string $repContact The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function filterByRepContact($repContact = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($repContact)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $repContact)) {
                $repContact = str_replace('*', '%', $repContact);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingUnitOwnerPeer::REP_CONTACT, $repContact, $comparison);
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingUnitOwnerPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingUnitOwnerPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingUnitOwnerPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingTenants object
     *
     * @param   LeasingTenants|PropelObjectCollection $leasingTenants  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingUnitOwnerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingTenants($leasingTenants, $comparison = null)
    {
        if ($leasingTenants instanceof LeasingTenants) {
            return $this
                ->addUsingAlias(LeasingUnitOwnerPeer::ID, $leasingTenants->getUnitOwnerId(), $comparison);
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
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   LeasingUnitOwner $leasingUnitOwner Object to remove from the list of results
     *
     * @return LeasingUnitOwnerQuery The current query, for fluid interface
     */
    public function prune($leasingUnitOwner = null)
    {
        if ($leasingUnitOwner) {
            $this->addUsingAlias(LeasingUnitOwnerPeer::ID, $leasingUnitOwner->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
