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
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentValidity;
use Leasing\CoreBundle\Model\LeasingPaymentValidityPeer;
use Leasing\CoreBundle\Model\LeasingPaymentValidityQuery;

/**
 * @method LeasingPaymentValidityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingPaymentValidityQuery orderByLeadTypeId($order = Criteria::ASC) Order by the lead_type_id column
 * @method LeasingPaymentValidityQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method LeasingPaymentValidityQuery orderByPeriod($order = Criteria::ASC) Order by the period column
 * @method LeasingPaymentValidityQuery orderByTransactionId($order = Criteria::ASC) Order by the transaction_id column
 * @method LeasingPaymentValidityQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 * @method LeasingPaymentValidityQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingPaymentValidityQuery groupById() Group by the id column
 * @method LeasingPaymentValidityQuery groupByLeadTypeId() Group by the lead_type_id column
 * @method LeasingPaymentValidityQuery groupByLeadId() Group by the lead_id column
 * @method LeasingPaymentValidityQuery groupByPeriod() Group by the period column
 * @method LeasingPaymentValidityQuery groupByTransactionId() Group by the transaction_id column
 * @method LeasingPaymentValidityQuery groupByBalance() Group by the balance column
 * @method LeasingPaymentValidityQuery groupByStatus() Group by the status column
 *
 * @method LeasingPaymentValidityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingPaymentValidityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingPaymentValidityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingPaymentValidityQuery leftJoinLeasingPaymentTransactions($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingPaymentValidityQuery rightJoinLeasingPaymentTransactions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingPaymentTransactions relation
 * @method LeasingPaymentValidityQuery innerJoinLeasingPaymentTransactions($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingPaymentTransactions relation
 *
 * @method LeasingPaymentValidity findOne(PropelPDO $con = null) Return the first LeasingPaymentValidity matching the query
 * @method LeasingPaymentValidity findOneOrCreate(PropelPDO $con = null) Return the first LeasingPaymentValidity matching the query, or a new LeasingPaymentValidity object populated from the query conditions when no match is found
 *
 * @method LeasingPaymentValidity findOneByLeadTypeId(int $lead_type_id) Return the first LeasingPaymentValidity filtered by the lead_type_id column
 * @method LeasingPaymentValidity findOneByLeadId(int $lead_id) Return the first LeasingPaymentValidity filtered by the lead_id column
 * @method LeasingPaymentValidity findOneByPeriod(int $period) Return the first LeasingPaymentValidity filtered by the period column
 * @method LeasingPaymentValidity findOneByTransactionId(int $transaction_id) Return the first LeasingPaymentValidity filtered by the transaction_id column
 * @method LeasingPaymentValidity findOneByBalance(double $balance) Return the first LeasingPaymentValidity filtered by the balance column
 * @method LeasingPaymentValidity findOneByStatus(int $status) Return the first LeasingPaymentValidity filtered by the status column
 *
 * @method array findById(int $id) Return LeasingPaymentValidity objects filtered by the id column
 * @method array findByLeadTypeId(int $lead_type_id) Return LeasingPaymentValidity objects filtered by the lead_type_id column
 * @method array findByLeadId(int $lead_id) Return LeasingPaymentValidity objects filtered by the lead_id column
 * @method array findByPeriod(int $period) Return LeasingPaymentValidity objects filtered by the period column
 * @method array findByTransactionId(int $transaction_id) Return LeasingPaymentValidity objects filtered by the transaction_id column
 * @method array findByBalance(double $balance) Return LeasingPaymentValidity objects filtered by the balance column
 * @method array findByStatus(int $status) Return LeasingPaymentValidity objects filtered by the status column
 */
abstract class BaseLeasingPaymentValidityQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingPaymentValidityQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingPaymentValidity';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingPaymentValidityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingPaymentValidityQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingPaymentValidityQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingPaymentValidityQuery) {
            return $criteria;
        }
        $query = new LeasingPaymentValidityQuery(null, null, $modelAlias);

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
     * @return   LeasingPaymentValidity|LeasingPaymentValidity[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingPaymentValidityPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentValidityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingPaymentValidity A model object, or null if the key is not found
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
     * @return                 LeasingPaymentValidity A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `lead_type_id`, `lead_id`, `period`, `transaction_id`, `balance`, `status` FROM `payment_validity` WHERE `id` = :p0';
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
            $obj = new LeasingPaymentValidity();
            $obj->hydrate($row);
            LeasingPaymentValidityPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingPaymentValidity|LeasingPaymentValidity[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingPaymentValidity[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingPaymentValidityPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingPaymentValidityPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::ID, $id, $comparison);
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
     * @param     mixed $leadTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByLeadTypeId($leadTypeId = null, $comparison = null)
    {
        if (is_array($leadTypeId)) {
            $useMinMax = false;
            if (isset($leadTypeId['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::LEAD_TYPE_ID, $leadTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadTypeId['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::LEAD_TYPE_ID, $leadTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::LEAD_TYPE_ID, $leadTypeId, $comparison);
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
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::LEAD_ID, $leadId, $comparison);
    }

    /**
     * Filter the query on the period column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriod(1234); // WHERE period = 1234
     * $query->filterByPeriod(array(12, 34)); // WHERE period IN (12, 34)
     * $query->filterByPeriod(array('min' => 12)); // WHERE period >= 12
     * $query->filterByPeriod(array('max' => 12)); // WHERE period <= 12
     * </code>
     *
     * @param     mixed $period The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByPeriod($period = null, $comparison = null)
    {
        if (is_array($period)) {
            $useMinMax = false;
            if (isset($period['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::PERIOD, $period['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($period['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::PERIOD, $period['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::PERIOD, $period, $comparison);
    }

    /**
     * Filter the query on the transaction_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionId(1234); // WHERE transaction_id = 1234
     * $query->filterByTransactionId(array(12, 34)); // WHERE transaction_id IN (12, 34)
     * $query->filterByTransactionId(array('min' => 12)); // WHERE transaction_id >= 12
     * $query->filterByTransactionId(array('max' => 12)); // WHERE transaction_id <= 12
     * </code>
     *
     * @see       filterByLeasingPaymentTransactions()
     *
     * @param     mixed $transactionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByTransactionId($transactionId = null, $comparison = null)
    {
        if (is_array($transactionId)) {
            $useMinMax = false;
            if (isset($transactionId['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::TRANSACTION_ID, $transactionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transactionId['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::TRANSACTION_ID, $transactionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::TRANSACTION_ID, $transactionId, $comparison);
    }

    /**
     * Filter the query on the balance column
     *
     * Example usage:
     * <code>
     * $query->filterByBalance(1234); // WHERE balance = 1234
     * $query->filterByBalance(array(12, 34)); // WHERE balance IN (12, 34)
     * $query->filterByBalance(array('min' => 12)); // WHERE balance >= 12
     * $query->filterByBalance(array('max' => 12)); // WHERE balance <= 12
     * </code>
     *
     * @param     mixed $balance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByBalance($balance = null, $comparison = null)
    {
        if (is_array($balance)) {
            $useMinMax = false;
            if (isset($balance['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($balance['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::BALANCE, $balance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::BALANCE, $balance, $comparison);
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
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingPaymentValidityPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentValidityPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related LeasingPaymentTransactions object
     *
     * @param   LeasingPaymentTransactions|PropelObjectCollection $leasingPaymentTransactions The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingPaymentValidityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingPaymentTransactions($leasingPaymentTransactions, $comparison = null)
    {
        if ($leasingPaymentTransactions instanceof LeasingPaymentTransactions) {
            return $this
                ->addUsingAlias(LeasingPaymentValidityPeer::TRANSACTION_ID, $leasingPaymentTransactions->getId(), $comparison);
        } elseif ($leasingPaymentTransactions instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingPaymentValidityPeer::TRANSACTION_ID, $leasingPaymentTransactions->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingPaymentTransactions() only accepts arguments of type LeasingPaymentTransactions or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingPaymentTransactions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function joinLeasingPaymentTransactions($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingPaymentTransactions');

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
            $this->addJoinObject($join, 'LeasingPaymentTransactions');
        }

        return $this;
    }

    /**
     * Use the LeasingPaymentTransactions relation LeasingPaymentTransactions object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingPaymentTransactionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingPaymentTransactions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingPaymentTransactions', '\Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingPaymentValidity $leasingPaymentValidity Object to remove from the list of results
     *
     * @return LeasingPaymentValidityQuery The current query, for fluid interface
     */
    public function prune($leasingPaymentValidity = null)
    {
        if ($leasingPaymentValidity) {
            $this->addUsingAlias(LeasingPaymentValidityPeer::ID, $leasingPaymentValidity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
