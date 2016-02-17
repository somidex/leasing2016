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
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsPeer;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery;
use Leasing\CoreBundle\Model\LeasingPaymentValidity;

/**
 * @method LeasingPaymentTransactionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingPaymentTransactionsQuery orderByTransactionType($order = Criteria::ASC) Order by the transaction_type column
 * @method LeasingPaymentTransactionsQuery orderByTransactionDate($order = Criteria::ASC) Order by the transaction_date column
 * @method LeasingPaymentTransactionsQuery orderByTransactionCode($order = Criteria::ASC) Order by the transaction_code column
 * @method LeasingPaymentTransactionsQuery orderByTransactionCost($order = Criteria::ASC) Order by the transaction_cost column
 * @method LeasingPaymentTransactionsQuery orderByTax($order = Criteria::ASC) Order by the tax column
 * @method LeasingPaymentTransactionsQuery orderByFee($order = Criteria::ASC) Order by the fee column
 * @method LeasingPaymentTransactionsQuery orderByAmountPaid($order = Criteria::ASC) Order by the amount_paid column
 * @method LeasingPaymentTransactionsQuery orderByParkingLeadsId($order = Criteria::ASC) Order by the parking_leads_id column
 * @method LeasingPaymentTransactionsQuery orderByEventBookingsId($order = Criteria::ASC) Order by the event_bookings_id column
 * @method LeasingPaymentTransactionsQuery orderByBookingsId($order = Criteria::ASC) Order by the bookings_id column
 * @method LeasingPaymentTransactionsQuery orderByProcessedBy($order = Criteria::ASC) Order by the processed_by column
 *
 * @method LeasingPaymentTransactionsQuery groupById() Group by the id column
 * @method LeasingPaymentTransactionsQuery groupByTransactionType() Group by the transaction_type column
 * @method LeasingPaymentTransactionsQuery groupByTransactionDate() Group by the transaction_date column
 * @method LeasingPaymentTransactionsQuery groupByTransactionCode() Group by the transaction_code column
 * @method LeasingPaymentTransactionsQuery groupByTransactionCost() Group by the transaction_cost column
 * @method LeasingPaymentTransactionsQuery groupByTax() Group by the tax column
 * @method LeasingPaymentTransactionsQuery groupByFee() Group by the fee column
 * @method LeasingPaymentTransactionsQuery groupByAmountPaid() Group by the amount_paid column
 * @method LeasingPaymentTransactionsQuery groupByParkingLeadsId() Group by the parking_leads_id column
 * @method LeasingPaymentTransactionsQuery groupByEventBookingsId() Group by the event_bookings_id column
 * @method LeasingPaymentTransactionsQuery groupByBookingsId() Group by the bookings_id column
 * @method LeasingPaymentTransactionsQuery groupByProcessedBy() Group by the processed_by column
 *
 * @method LeasingPaymentTransactionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingPaymentTransactionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingPaymentTransactionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingPaymentTransactionsQuery leftJoinLeasingParkingLeads($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingParkingLeads relation
 * @method LeasingPaymentTransactionsQuery rightJoinLeasingParkingLeads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingParkingLeads relation
 * @method LeasingPaymentTransactionsQuery innerJoinLeasingParkingLeads($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingParkingLeads relation
 *
 * @method LeasingPaymentTransactionsQuery leftJoinLeasingEventBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingEventBookings relation
 * @method LeasingPaymentTransactionsQuery rightJoinLeasingEventBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingEventBookings relation
 * @method LeasingPaymentTransactionsQuery innerJoinLeasingEventBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingEventBookings relation
 *
 * @method LeasingPaymentTransactionsQuery leftJoinLeasingBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingBookings relation
 * @method LeasingPaymentTransactionsQuery rightJoinLeasingBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingBookings relation
 * @method LeasingPaymentTransactionsQuery innerJoinLeasingBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingBookings relation
 *
 * @method LeasingPaymentTransactionsQuery leftJoinLeasingPaymentValidity($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingPaymentValidity relation
 * @method LeasingPaymentTransactionsQuery rightJoinLeasingPaymentValidity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingPaymentValidity relation
 * @method LeasingPaymentTransactionsQuery innerJoinLeasingPaymentValidity($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingPaymentValidity relation
 *
 * @method LeasingPaymentTransactions findOne(PropelPDO $con = null) Return the first LeasingPaymentTransactions matching the query
 * @method LeasingPaymentTransactions findOneOrCreate(PropelPDO $con = null) Return the first LeasingPaymentTransactions matching the query, or a new LeasingPaymentTransactions object populated from the query conditions when no match is found
 *
 * @method LeasingPaymentTransactions findOneByTransactionType(int $transaction_type) Return the first LeasingPaymentTransactions filtered by the transaction_type column
 * @method LeasingPaymentTransactions findOneByTransactionDate(string $transaction_date) Return the first LeasingPaymentTransactions filtered by the transaction_date column
 * @method LeasingPaymentTransactions findOneByTransactionCode(string $transaction_code) Return the first LeasingPaymentTransactions filtered by the transaction_code column
 * @method LeasingPaymentTransactions findOneByTransactionCost(double $transaction_cost) Return the first LeasingPaymentTransactions filtered by the transaction_cost column
 * @method LeasingPaymentTransactions findOneByTax(double $tax) Return the first LeasingPaymentTransactions filtered by the tax column
 * @method LeasingPaymentTransactions findOneByFee(double $fee) Return the first LeasingPaymentTransactions filtered by the fee column
 * @method LeasingPaymentTransactions findOneByAmountPaid(double $amount_paid) Return the first LeasingPaymentTransactions filtered by the amount_paid column
 * @method LeasingPaymentTransactions findOneByParkingLeadsId(int $parking_leads_id) Return the first LeasingPaymentTransactions filtered by the parking_leads_id column
 * @method LeasingPaymentTransactions findOneByEventBookingsId(int $event_bookings_id) Return the first LeasingPaymentTransactions filtered by the event_bookings_id column
 * @method LeasingPaymentTransactions findOneByBookingsId(int $bookings_id) Return the first LeasingPaymentTransactions filtered by the bookings_id column
 * @method LeasingPaymentTransactions findOneByProcessedBy(string $processed_by) Return the first LeasingPaymentTransactions filtered by the processed_by column
 *
 * @method array findById(int $id) Return LeasingPaymentTransactions objects filtered by the id column
 * @method array findByTransactionType(int $transaction_type) Return LeasingPaymentTransactions objects filtered by the transaction_type column
 * @method array findByTransactionDate(string $transaction_date) Return LeasingPaymentTransactions objects filtered by the transaction_date column
 * @method array findByTransactionCode(string $transaction_code) Return LeasingPaymentTransactions objects filtered by the transaction_code column
 * @method array findByTransactionCost(double $transaction_cost) Return LeasingPaymentTransactions objects filtered by the transaction_cost column
 * @method array findByTax(double $tax) Return LeasingPaymentTransactions objects filtered by the tax column
 * @method array findByFee(double $fee) Return LeasingPaymentTransactions objects filtered by the fee column
 * @method array findByAmountPaid(double $amount_paid) Return LeasingPaymentTransactions objects filtered by the amount_paid column
 * @method array findByParkingLeadsId(int $parking_leads_id) Return LeasingPaymentTransactions objects filtered by the parking_leads_id column
 * @method array findByEventBookingsId(int $event_bookings_id) Return LeasingPaymentTransactions objects filtered by the event_bookings_id column
 * @method array findByBookingsId(int $bookings_id) Return LeasingPaymentTransactions objects filtered by the bookings_id column
 * @method array findByProcessedBy(string $processed_by) Return LeasingPaymentTransactions objects filtered by the processed_by column
 */
abstract class BaseLeasingPaymentTransactionsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingPaymentTransactionsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingPaymentTransactions';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingPaymentTransactionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingPaymentTransactionsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingPaymentTransactionsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingPaymentTransactionsQuery) {
            return $criteria;
        }
        $query = new LeasingPaymentTransactionsQuery(null, null, $modelAlias);

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
     * @return   LeasingPaymentTransactions|LeasingPaymentTransactions[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingPaymentTransactionsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingPaymentTransactions A model object, or null if the key is not found
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
     * @return                 LeasingPaymentTransactions A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `transaction_type`, `transaction_date`, `transaction_code`, `transaction_cost`, `tax`, `fee`, `amount_paid`, `parking_leads_id`, `event_bookings_id`, `bookings_id`, `processed_by` FROM `payment_transactions` WHERE `id` = :p0';
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
            $obj = new LeasingPaymentTransactions();
            $obj->hydrate($row);
            LeasingPaymentTransactionsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingPaymentTransactions|LeasingPaymentTransactions[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingPaymentTransactions[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the transaction_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionType(1234); // WHERE transaction_type = 1234
     * $query->filterByTransactionType(array(12, 34)); // WHERE transaction_type IN (12, 34)
     * $query->filterByTransactionType(array('min' => 12)); // WHERE transaction_type >= 12
     * $query->filterByTransactionType(array('max' => 12)); // WHERE transaction_type <= 12
     * </code>
     *
     * @param     mixed $transactionType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByTransactionType($transactionType = null, $comparison = null)
    {
        if (is_array($transactionType)) {
            $useMinMax = false;
            if (isset($transactionType['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE, $transactionType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transactionType['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE, $transactionType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE, $transactionType, $comparison);
    }

    /**
     * Filter the query on the transaction_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionDate('fooValue');   // WHERE transaction_date = 'fooValue'
     * $query->filterByTransactionDate('%fooValue%'); // WHERE transaction_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transactionDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByTransactionDate($transactionDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transactionDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $transactionDate)) {
                $transactionDate = str_replace('*', '%', $transactionDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_DATE, $transactionDate, $comparison);
    }

    /**
     * Filter the query on the transaction_code column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionCode('fooValue');   // WHERE transaction_code = 'fooValue'
     * $query->filterByTransactionCode('%fooValue%'); // WHERE transaction_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transactionCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByTransactionCode($transactionCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transactionCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $transactionCode)) {
                $transactionCode = str_replace('*', '%', $transactionCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_CODE, $transactionCode, $comparison);
    }

    /**
     * Filter the query on the transaction_cost column
     *
     * Example usage:
     * <code>
     * $query->filterByTransactionCost(1234); // WHERE transaction_cost = 1234
     * $query->filterByTransactionCost(array(12, 34)); // WHERE transaction_cost IN (12, 34)
     * $query->filterByTransactionCost(array('min' => 12)); // WHERE transaction_cost >= 12
     * $query->filterByTransactionCost(array('max' => 12)); // WHERE transaction_cost <= 12
     * </code>
     *
     * @param     mixed $transactionCost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByTransactionCost($transactionCost = null, $comparison = null)
    {
        if (is_array($transactionCost)) {
            $useMinMax = false;
            if (isset($transactionCost['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_COST, $transactionCost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transactionCost['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_COST, $transactionCost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::TRANSACTION_COST, $transactionCost, $comparison);
    }

    /**
     * Filter the query on the tax column
     *
     * Example usage:
     * <code>
     * $query->filterByTax(1234); // WHERE tax = 1234
     * $query->filterByTax(array(12, 34)); // WHERE tax IN (12, 34)
     * $query->filterByTax(array('min' => 12)); // WHERE tax >= 12
     * $query->filterByTax(array('max' => 12)); // WHERE tax <= 12
     * </code>
     *
     * @param     mixed $tax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByTax($tax = null, $comparison = null)
    {
        if (is_array($tax)) {
            $useMinMax = false;
            if (isset($tax['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::TAX, $tax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tax['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::TAX, $tax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::TAX, $tax, $comparison);
    }

    /**
     * Filter the query on the fee column
     *
     * Example usage:
     * <code>
     * $query->filterByFee(1234); // WHERE fee = 1234
     * $query->filterByFee(array(12, 34)); // WHERE fee IN (12, 34)
     * $query->filterByFee(array('min' => 12)); // WHERE fee >= 12
     * $query->filterByFee(array('max' => 12)); // WHERE fee <= 12
     * </code>
     *
     * @param     mixed $fee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByFee($fee = null, $comparison = null)
    {
        if (is_array($fee)) {
            $useMinMax = false;
            if (isset($fee['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::FEE, $fee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fee['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::FEE, $fee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::FEE, $fee, $comparison);
    }

    /**
     * Filter the query on the amount_paid column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountPaid(1234); // WHERE amount_paid = 1234
     * $query->filterByAmountPaid(array(12, 34)); // WHERE amount_paid IN (12, 34)
     * $query->filterByAmountPaid(array('min' => 12)); // WHERE amount_paid >= 12
     * $query->filterByAmountPaid(array('max' => 12)); // WHERE amount_paid <= 12
     * </code>
     *
     * @param     mixed $amountPaid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByAmountPaid($amountPaid = null, $comparison = null)
    {
        if (is_array($amountPaid)) {
            $useMinMax = false;
            if (isset($amountPaid['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::AMOUNT_PAID, $amountPaid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountPaid['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::AMOUNT_PAID, $amountPaid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::AMOUNT_PAID, $amountPaid, $comparison);
    }

    /**
     * Filter the query on the parking_leads_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParkingLeadsId(1234); // WHERE parking_leads_id = 1234
     * $query->filterByParkingLeadsId(array(12, 34)); // WHERE parking_leads_id IN (12, 34)
     * $query->filterByParkingLeadsId(array('min' => 12)); // WHERE parking_leads_id >= 12
     * $query->filterByParkingLeadsId(array('max' => 12)); // WHERE parking_leads_id <= 12
     * </code>
     *
     * @see       filterByLeasingParkingLeads()
     *
     * @param     mixed $parkingLeadsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByParkingLeadsId($parkingLeadsId = null, $comparison = null)
    {
        if (is_array($parkingLeadsId)) {
            $useMinMax = false;
            if (isset($parkingLeadsId['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, $parkingLeadsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parkingLeadsId['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, $parkingLeadsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, $parkingLeadsId, $comparison);
    }

    /**
     * Filter the query on the event_bookings_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventBookingsId(1234); // WHERE event_bookings_id = 1234
     * $query->filterByEventBookingsId(array(12, 34)); // WHERE event_bookings_id IN (12, 34)
     * $query->filterByEventBookingsId(array('min' => 12)); // WHERE event_bookings_id >= 12
     * $query->filterByEventBookingsId(array('max' => 12)); // WHERE event_bookings_id <= 12
     * </code>
     *
     * @see       filterByLeasingEventBookings()
     *
     * @param     mixed $eventBookingsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByEventBookingsId($eventBookingsId = null, $comparison = null)
    {
        if (is_array($eventBookingsId)) {
            $useMinMax = false;
            if (isset($eventBookingsId['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, $eventBookingsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventBookingsId['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, $eventBookingsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, $eventBookingsId, $comparison);
    }

    /**
     * Filter the query on the bookings_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingsId(1234); // WHERE bookings_id = 1234
     * $query->filterByBookingsId(array(12, 34)); // WHERE bookings_id IN (12, 34)
     * $query->filterByBookingsId(array('min' => 12)); // WHERE bookings_id >= 12
     * $query->filterByBookingsId(array('max' => 12)); // WHERE bookings_id <= 12
     * </code>
     *
     * @see       filterByLeasingBookings()
     *
     * @param     mixed $bookingsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByBookingsId($bookingsId = null, $comparison = null)
    {
        if (is_array($bookingsId)) {
            $useMinMax = false;
            if (isset($bookingsId['min'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::BOOKINGS_ID, $bookingsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingsId['max'])) {
                $this->addUsingAlias(LeasingPaymentTransactionsPeer::BOOKINGS_ID, $bookingsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::BOOKINGS_ID, $bookingsId, $comparison);
    }

    /**
     * Filter the query on the processed_by column
     *
     * Example usage:
     * <code>
     * $query->filterByProcessedBy('fooValue');   // WHERE processed_by = 'fooValue'
     * $query->filterByProcessedBy('%fooValue%'); // WHERE processed_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $processedBy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function filterByProcessedBy($processedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($processedBy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $processedBy)) {
                $processedBy = str_replace('*', '%', $processedBy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingPaymentTransactionsPeer::PROCESSED_BY, $processedBy, $comparison);
    }

    /**
     * Filter the query by a related LeasingParkingLeads object
     *
     * @param   LeasingParkingLeads|PropelObjectCollection $leasingParkingLeads The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingPaymentTransactionsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingParkingLeads($leasingParkingLeads, $comparison = null)
    {
        if ($leasingParkingLeads instanceof LeasingParkingLeads) {
            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, $leasingParkingLeads->getId(), $comparison);
        } elseif ($leasingParkingLeads instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, $leasingParkingLeads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingParkingLeads() only accepts arguments of type LeasingParkingLeads or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingParkingLeads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function joinLeasingParkingLeads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingParkingLeads');

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
            $this->addJoinObject($join, 'LeasingParkingLeads');
        }

        return $this;
    }

    /**
     * Use the LeasingParkingLeads relation LeasingParkingLeads object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingParkingLeadsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingParkingLeadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingParkingLeads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingParkingLeads', '\Leasing\CoreBundle\Model\LeasingParkingLeadsQuery');
    }

    /**
     * Filter the query by a related LeasingEventBookings object
     *
     * @param   LeasingEventBookings|PropelObjectCollection $leasingEventBookings The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingPaymentTransactionsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingEventBookings($leasingEventBookings, $comparison = null)
    {
        if ($leasingEventBookings instanceof LeasingEventBookings) {
            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, $leasingEventBookings->getId(), $comparison);
        } elseif ($leasingEventBookings instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, $leasingEventBookings->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
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
     * Filter the query by a related LeasingBookings object
     *
     * @param   LeasingBookings|PropelObjectCollection $leasingBookings The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingPaymentTransactionsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingBookings($leasingBookings, $comparison = null)
    {
        if ($leasingBookings instanceof LeasingBookings) {
            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::BOOKINGS_ID, $leasingBookings->getId(), $comparison);
        } elseif ($leasingBookings instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::BOOKINGS_ID, $leasingBookings->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingBookings() only accepts arguments of type LeasingBookings or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingBookings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function joinLeasingBookings($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingBookings');

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
            $this->addJoinObject($join, 'LeasingBookings');
        }

        return $this;
    }

    /**
     * Use the LeasingBookings relation LeasingBookings object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingBookingsQuery A secondary query class using the current class as primary query
     */
    public function useLeasingBookingsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingBookings', '\Leasing\CoreBundle\Model\LeasingBookingsQuery');
    }

    /**
     * Filter the query by a related LeasingPaymentValidity object
     *
     * @param   LeasingPaymentValidity|PropelObjectCollection $leasingPaymentValidity  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingPaymentTransactionsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingPaymentValidity($leasingPaymentValidity, $comparison = null)
    {
        if ($leasingPaymentValidity instanceof LeasingPaymentValidity) {
            return $this
                ->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $leasingPaymentValidity->getTransactionId(), $comparison);
        } elseif ($leasingPaymentValidity instanceof PropelObjectCollection) {
            return $this
                ->useLeasingPaymentValidityQuery()
                ->filterByPrimaryKeys($leasingPaymentValidity->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeasingPaymentValidity() only accepts arguments of type LeasingPaymentValidity or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingPaymentValidity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function joinLeasingPaymentValidity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingPaymentValidity');

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
            $this->addJoinObject($join, 'LeasingPaymentValidity');
        }

        return $this;
    }

    /**
     * Use the LeasingPaymentValidity relation LeasingPaymentValidity object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingPaymentValidityQuery A secondary query class using the current class as primary query
     */
    public function useLeasingPaymentValidityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingPaymentValidity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingPaymentValidity', '\Leasing\CoreBundle\Model\LeasingPaymentValidityQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingPaymentTransactions $leasingPaymentTransactions Object to remove from the list of results
     *
     * @return LeasingPaymentTransactionsQuery The current query, for fluid interface
     */
    public function prune($leasingPaymentTransactions = null)
    {
        if ($leasingPaymentTransactions) {
            $this->addUsingAlias(LeasingPaymentTransactionsPeer::ID, $leasingPaymentTransactions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
