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
use Leasing\CoreBundle\Model\LeasingGaDataPeer;
use Leasing\CoreBundle\Model\LeasingGaDataQuery;
use Leasing\CoreBundle\Model\LeasingLeadType;

/**
 * @method LeasingGaDataQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingGaDataQuery orderByLeadTypeId($order = Criteria::ASC) Order by the lead_type_id column
 * @method LeasingGaDataQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method LeasingGaDataQuery orderBySource($order = Criteria::ASC) Order by the source column
 * @method LeasingGaDataQuery orderByMedium($order = Criteria::ASC) Order by the medium column
 * @method LeasingGaDataQuery orderByCampaign($order = Criteria::ASC) Order by the campaign column
 * @method LeasingGaDataQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method LeasingGaDataQuery orderByDevice($order = Criteria::ASC) Order by the device column
 *
 * @method LeasingGaDataQuery groupById() Group by the id column
 * @method LeasingGaDataQuery groupByLeadTypeId() Group by the lead_type_id column
 * @method LeasingGaDataQuery groupByLeadId() Group by the lead_id column
 * @method LeasingGaDataQuery groupBySource() Group by the source column
 * @method LeasingGaDataQuery groupByMedium() Group by the medium column
 * @method LeasingGaDataQuery groupByCampaign() Group by the campaign column
 * @method LeasingGaDataQuery groupByCountry() Group by the country column
 * @method LeasingGaDataQuery groupByDevice() Group by the device column
 *
 * @method LeasingGaDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingGaDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingGaDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingGaDataQuery leftJoinLeasingLeadType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLeadType relation
 * @method LeasingGaDataQuery rightJoinLeasingLeadType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLeadType relation
 * @method LeasingGaDataQuery innerJoinLeasingLeadType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLeadType relation
 *
 * @method LeasingGaData findOne(PropelPDO $con = null) Return the first LeasingGaData matching the query
 * @method LeasingGaData findOneOrCreate(PropelPDO $con = null) Return the first LeasingGaData matching the query, or a new LeasingGaData object populated from the query conditions when no match is found
 *
 * @method LeasingGaData findOneByLeadTypeId(int $lead_type_id) Return the first LeasingGaData filtered by the lead_type_id column
 * @method LeasingGaData findOneByLeadId(int $lead_id) Return the first LeasingGaData filtered by the lead_id column
 * @method LeasingGaData findOneBySource(string $source) Return the first LeasingGaData filtered by the source column
 * @method LeasingGaData findOneByMedium(string $medium) Return the first LeasingGaData filtered by the medium column
 * @method LeasingGaData findOneByCampaign(string $campaign) Return the first LeasingGaData filtered by the campaign column
 * @method LeasingGaData findOneByCountry(string $country) Return the first LeasingGaData filtered by the country column
 * @method LeasingGaData findOneByDevice(string $device) Return the first LeasingGaData filtered by the device column
 *
 * @method array findById(int $id) Return LeasingGaData objects filtered by the id column
 * @method array findByLeadTypeId(int $lead_type_id) Return LeasingGaData objects filtered by the lead_type_id column
 * @method array findByLeadId(int $lead_id) Return LeasingGaData objects filtered by the lead_id column
 * @method array findBySource(string $source) Return LeasingGaData objects filtered by the source column
 * @method array findByMedium(string $medium) Return LeasingGaData objects filtered by the medium column
 * @method array findByCampaign(string $campaign) Return LeasingGaData objects filtered by the campaign column
 * @method array findByCountry(string $country) Return LeasingGaData objects filtered by the country column
 * @method array findByDevice(string $device) Return LeasingGaData objects filtered by the device column
 */
abstract class BaseLeasingGaDataQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingGaDataQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingGaData';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingGaDataQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingGaDataQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingGaDataQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingGaDataQuery) {
            return $criteria;
        }
        $query = new LeasingGaDataQuery(null, null, $modelAlias);

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
     * @return   LeasingGaData|LeasingGaData[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingGaDataPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingGaDataPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingGaData A model object, or null if the key is not found
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
     * @return                 LeasingGaData A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `lead_type_id`, `lead_id`, `source`, `medium`, `campaign`, `country`, `device` FROM `ga_data` WHERE `id` = :p0';
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
            $obj = new LeasingGaData();
            $obj->hydrate($row);
            LeasingGaDataPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingGaData|LeasingGaData[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingGaData[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingGaDataPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingGaDataPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingGaDataPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingGaDataPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::ID, $id, $comparison);
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
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByLeadTypeId($leadTypeId = null, $comparison = null)
    {
        if (is_array($leadTypeId)) {
            $useMinMax = false;
            if (isset($leadTypeId['min'])) {
                $this->addUsingAlias(LeasingGaDataPeer::LEAD_TYPE_ID, $leadTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadTypeId['max'])) {
                $this->addUsingAlias(LeasingGaDataPeer::LEAD_TYPE_ID, $leadTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::LEAD_TYPE_ID, $leadTypeId, $comparison);
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
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeasingGaDataPeer::LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeasingGaDataPeer::LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::LEAD_ID, $leadId, $comparison);
    }

    /**
     * Filter the query on the source column
     *
     * Example usage:
     * <code>
     * $query->filterBySource('fooValue');   // WHERE source = 'fooValue'
     * $query->filterBySource('%fooValue%'); // WHERE source LIKE '%fooValue%'
     * </code>
     *
     * @param     string $source The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterBySource($source = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($source)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $source)) {
                $source = str_replace('*', '%', $source);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::SOURCE, $source, $comparison);
    }

    /**
     * Filter the query on the medium column
     *
     * Example usage:
     * <code>
     * $query->filterByMedium('fooValue');   // WHERE medium = 'fooValue'
     * $query->filterByMedium('%fooValue%'); // WHERE medium LIKE '%fooValue%'
     * </code>
     *
     * @param     string $medium The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByMedium($medium = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($medium)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $medium)) {
                $medium = str_replace('*', '%', $medium);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::MEDIUM, $medium, $comparison);
    }

    /**
     * Filter the query on the campaign column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaign('fooValue');   // WHERE campaign = 'fooValue'
     * $query->filterByCampaign('%fooValue%'); // WHERE campaign LIKE '%fooValue%'
     * </code>
     *
     * @param     string $campaign The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByCampaign($campaign = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campaign)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $campaign)) {
                $campaign = str_replace('*', '%', $campaign);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::CAMPAIGN, $campaign, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the device column
     *
     * Example usage:
     * <code>
     * $query->filterByDevice('fooValue');   // WHERE device = 'fooValue'
     * $query->filterByDevice('%fooValue%'); // WHERE device LIKE '%fooValue%'
     * </code>
     *
     * @param     string $device The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function filterByDevice($device = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($device)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $device)) {
                $device = str_replace('*', '%', $device);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LeasingGaDataPeer::DEVICE, $device, $comparison);
    }

    /**
     * Filter the query by a related LeasingLeadType object
     *
     * @param   LeasingLeadType|PropelObjectCollection $leasingLeadType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingGaDataQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLeadType($leasingLeadType, $comparison = null)
    {
        if ($leasingLeadType instanceof LeasingLeadType) {
            return $this
                ->addUsingAlias(LeasingGaDataPeer::LEAD_TYPE_ID, $leasingLeadType->getId(), $comparison);
        } elseif ($leasingLeadType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingGaDataPeer::LEAD_TYPE_ID, $leasingLeadType->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingGaDataQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   LeasingGaData $leasingGaData Object to remove from the list of results
     *
     * @return LeasingGaDataQuery The current query, for fluid interface
     */
    public function prune($leasingGaData = null)
    {
        if ($leasingGaData) {
            $this->addUsingAlias(LeasingGaDataPeer::ID, $leasingGaData->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
