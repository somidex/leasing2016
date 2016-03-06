<?php

namespace Leasing\CoreBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingLogs;
use Leasing\CoreBundle\Model\LeasingLogsPeer;
use Leasing\CoreBundle\Model\LeasingLogsQuery;

/**
 * @method LeasingLogsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingLogsQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method LeasingLogsQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method LeasingLogsQuery orderByModule($order = Criteria::ASC) Order by the module column
 * @method LeasingLogsQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method LeasingLogsQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method LeasingLogsQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 * @method LeasingLogsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method LeasingLogsQuery groupById() Group by the id column
 * @method LeasingLogsQuery groupByUser() Group by the user column
 * @method LeasingLogsQuery groupByAction() Group by the action column
 * @method LeasingLogsQuery groupByModule() Group by the module column
 * @method LeasingLogsQuery groupByContent() Group by the content column
 * @method LeasingLogsQuery groupByIp() Group by the ip column
 * @method LeasingLogsQuery groupByDatetime() Group by the datetime column
 * @method LeasingLogsQuery groupByStatus() Group by the status column
 *
 * @method LeasingLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingLogs findOne(PropelPDO $con = null) Return the first LeasingLogs matching the query
 * @method LeasingLogs findOneOrCreate(PropelPDO $con = null) Return the first LeasingLogs matching the query, or a new LeasingLogs object populated from the query conditions when no match is found
 *
 * @method LeasingLogs findOneByUser(string $user) Return the first LeasingLogs filtered by the user column
 * @method LeasingLogs findOneByAction(string $action) Return the first LeasingLogs filtered by the action column
 * @method LeasingLogs findOneByModule(string $module) Return the first LeasingLogs filtered by the module column
 * @method LeasingLogs findOneByContent(string $content) Return the first LeasingLogs filtered by the content column
 * @method LeasingLogs findOneByIp(string $ip) Return the first LeasingLogs filtered by the ip column
 * @method LeasingLogs findOneByDatetime(string $datetime) Return the first LeasingLogs filtered by the datetime column
 * @method LeasingLogs findOneByStatus(int $status) Return the first LeasingLogs filtered by the status column
 *
 * @method array findById(int $id) Return LeasingLogs objects filtered by the id column
 * @method array findByUser(string $user) Return LeasingLogs objects filtered by the user column
 * @method array findByAction(string $action) Return LeasingLogs objects filtered by the action column
 * @method array findByModule(string $module) Return LeasingLogs objects filtered by the module column
 * @method array findByContent(string $content) Return LeasingLogs objects filtered by the content column
 * @method array findByIp(string $ip) Return LeasingLogs objects filtered by the ip column
 * @method array findByDatetime(string $datetime) Return LeasingLogs objects filtered by the datetime column
 * @method array findByStatus(int $status) Return LeasingLogs objects filtered by the status column
 */
abstract class BaseLeasingLogsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingLogsQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingLogs';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingLogsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingLogsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingLogsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingLogsQuery) {
            return $criteria;
        }
        $query = new LeasingLogsQuery(null, null, $modelAlias);

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
     * @return   LeasingLogs|LeasingLogs[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingLogsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingLogsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingLogs A model object, or null if the key is not found
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
     * @return                 LeasingLogs A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `user`, `action`, `module`, `content`, `ip`, `datetime`, `status` FROM `logs` WHERE `id` = :p0';
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
            $obj = new LeasingLogs();
            $obj->hydrate($row);
            LeasingLogsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingLogs|LeasingLogs[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingLogs[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingLogsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingLogsPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingLogsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingLogsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::ID, $id, $comparison);
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
     * @return LeasingLogsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LeasingLogsPeer::USER, $user, $comparison);
    }

    /**
     * Filter the query on the action column
     *
     * Example usage:
     * <code>
     * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
     * $query->filterByAction('%fooValue%'); // WHERE action LIKE '%fooValue%'
     * </code>
     *
     * @param     string $action The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByAction($action = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($action)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $action)) {
                $action = str_replace('*', '%', $action);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::ACTION, $action, $comparison);
    }

    /**
     * Filter the query on the module column
     *
     * Example usage:
     * <code>
     * $query->filterByModule('fooValue');   // WHERE module = 'fooValue'
     * $query->filterByModule('%fooValue%'); // WHERE module LIKE '%fooValue%'
     * </code>
     *
     * @param     string $module The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByModule($module = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($module)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $module)) {
                $module = str_replace('*', '%', $module);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::MODULE, $module, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::IP, $ip, $comparison);
    }

    /**
     * Filter the query on the datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByDatetime('fooValue');   // WHERE datetime = 'fooValue'
     * $query->filterByDatetime('%fooValue%'); // WHERE datetime LIKE '%fooValue%'
     * </code>
     *
     * @param     string $datetime The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($datetime)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $datetime)) {
                $datetime = str_replace('*', '%', $datetime);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::DATETIME, $datetime, $comparison);
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
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(LeasingLogsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(LeasingLogsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLogsPeer::STATUS, $status, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   LeasingLogs $leasingLogs Object to remove from the list of results
     *
     * @return LeasingLogsQuery The current query, for fluid interface
     */
    public function prune($leasingLogs = null)
    {
        if ($leasingLogs) {
            $this->addUsingAlias(LeasingLogsPeer::ID, $leasingLogs->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
