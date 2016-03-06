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
use Leasing\CoreBundle\Model\LeasingDocument;
use Leasing\CoreBundle\Model\LeasingLeadDocument;
use Leasing\CoreBundle\Model\LeasingLeadDocumentPeer;
use Leasing\CoreBundle\Model\LeasingLeadDocumentQuery;
use Leasing\CoreBundle\Model\LeasingLeadType;

/**
 * @method LeasingLeadDocumentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LeasingLeadDocumentQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method LeasingLeadDocumentQuery orderByDocumentId($order = Criteria::ASC) Order by the document_id column
 * @method LeasingLeadDocumentQuery orderByLeadTypeId($order = Criteria::ASC) Order by the lead_type_id column
 *
 * @method LeasingLeadDocumentQuery groupById() Group by the id column
 * @method LeasingLeadDocumentQuery groupByLeadId() Group by the lead_id column
 * @method LeasingLeadDocumentQuery groupByDocumentId() Group by the document_id column
 * @method LeasingLeadDocumentQuery groupByLeadTypeId() Group by the lead_type_id column
 *
 * @method LeasingLeadDocumentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LeasingLeadDocumentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LeasingLeadDocumentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LeasingLeadDocumentQuery leftJoinLeasingDocument($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingDocument relation
 * @method LeasingLeadDocumentQuery rightJoinLeasingDocument($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingDocument relation
 * @method LeasingLeadDocumentQuery innerJoinLeasingDocument($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingDocument relation
 *
 * @method LeasingLeadDocumentQuery leftJoinLeasingLeadType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeasingLeadType relation
 * @method LeasingLeadDocumentQuery rightJoinLeasingLeadType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeasingLeadType relation
 * @method LeasingLeadDocumentQuery innerJoinLeasingLeadType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeasingLeadType relation
 *
 * @method LeasingLeadDocument findOne(PropelPDO $con = null) Return the first LeasingLeadDocument matching the query
 * @method LeasingLeadDocument findOneOrCreate(PropelPDO $con = null) Return the first LeasingLeadDocument matching the query, or a new LeasingLeadDocument object populated from the query conditions when no match is found
 *
 * @method LeasingLeadDocument findOneByLeadId(int $lead_id) Return the first LeasingLeadDocument filtered by the lead_id column
 * @method LeasingLeadDocument findOneByDocumentId(int $document_id) Return the first LeasingLeadDocument filtered by the document_id column
 * @method LeasingLeadDocument findOneByLeadTypeId(int $lead_type_id) Return the first LeasingLeadDocument filtered by the lead_type_id column
 *
 * @method array findById(int $id) Return LeasingLeadDocument objects filtered by the id column
 * @method array findByLeadId(int $lead_id) Return LeasingLeadDocument objects filtered by the lead_id column
 * @method array findByDocumentId(int $document_id) Return LeasingLeadDocument objects filtered by the document_id column
 * @method array findByLeadTypeId(int $lead_type_id) Return LeasingLeadDocument objects filtered by the lead_type_id column
 */
abstract class BaseLeasingLeadDocumentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLeasingLeadDocumentQuery object.
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
            $modelName = 'Leasing\\CoreBundle\\Model\\LeasingLeadDocument';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LeasingLeadDocumentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LeasingLeadDocumentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LeasingLeadDocumentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LeasingLeadDocumentQuery) {
            return $criteria;
        }
        $query = new LeasingLeadDocumentQuery(null, null, $modelAlias);

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
     * @return   LeasingLeadDocument|LeasingLeadDocument[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LeasingLeadDocumentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LeasingLeadDocumentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 LeasingLeadDocument A model object, or null if the key is not found
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
     * @return                 LeasingLeadDocument A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `lead_id`, `document_id`, `lead_type_id` FROM `lead_document` WHERE `id` = :p0';
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
            $obj = new LeasingLeadDocument();
            $obj->hydrate($row);
            LeasingLeadDocumentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return LeasingLeadDocument|LeasingLeadDocument[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|LeasingLeadDocument[]|mixed the list of results, formatted by the current formatter
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
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeasingLeadDocumentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeasingLeadDocumentPeer::ID, $keys, Criteria::IN);
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
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadDocumentPeer::ID, $id, $comparison);
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
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadDocumentPeer::LEAD_ID, $leadId, $comparison);
    }

    /**
     * Filter the query on the document_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentId(1234); // WHERE document_id = 1234
     * $query->filterByDocumentId(array(12, 34)); // WHERE document_id IN (12, 34)
     * $query->filterByDocumentId(array('min' => 12)); // WHERE document_id >= 12
     * $query->filterByDocumentId(array('max' => 12)); // WHERE document_id <= 12
     * </code>
     *
     * @see       filterByLeasingDocument()
     *
     * @param     mixed $documentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function filterByDocumentId($documentId = null, $comparison = null)
    {
        if (is_array($documentId)) {
            $useMinMax = false;
            if (isset($documentId['min'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::DOCUMENT_ID, $documentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($documentId['max'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::DOCUMENT_ID, $documentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadDocumentPeer::DOCUMENT_ID, $documentId, $comparison);
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
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function filterByLeadTypeId($leadTypeId = null, $comparison = null)
    {
        if (is_array($leadTypeId)) {
            $useMinMax = false;
            if (isset($leadTypeId['min'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::LEAD_TYPE_ID, $leadTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadTypeId['max'])) {
                $this->addUsingAlias(LeasingLeadDocumentPeer::LEAD_TYPE_ID, $leadTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeasingLeadDocumentPeer::LEAD_TYPE_ID, $leadTypeId, $comparison);
    }

    /**
     * Filter the query by a related LeasingDocument object
     *
     * @param   LeasingDocument|PropelObjectCollection $leasingDocument The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingLeadDocumentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingDocument($leasingDocument, $comparison = null)
    {
        if ($leasingDocument instanceof LeasingDocument) {
            return $this
                ->addUsingAlias(LeasingLeadDocumentPeer::DOCUMENT_ID, $leasingDocument->getId(), $comparison);
        } elseif ($leasingDocument instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingLeadDocumentPeer::DOCUMENT_ID, $leasingDocument->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeasingDocument() only accepts arguments of type LeasingDocument or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeasingDocument relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function joinLeasingDocument($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeasingDocument');

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
            $this->addJoinObject($join, 'LeasingDocument');
        }

        return $this;
    }

    /**
     * Use the LeasingDocument relation LeasingDocument object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Leasing\CoreBundle\Model\LeasingDocumentQuery A secondary query class using the current class as primary query
     */
    public function useLeasingDocumentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeasingDocument($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeasingDocument', '\Leasing\CoreBundle\Model\LeasingDocumentQuery');
    }

    /**
     * Filter the query by a related LeasingLeadType object
     *
     * @param   LeasingLeadType|PropelObjectCollection $leasingLeadType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LeasingLeadDocumentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeasingLeadType($leasingLeadType, $comparison = null)
    {
        if ($leasingLeadType instanceof LeasingLeadType) {
            return $this
                ->addUsingAlias(LeasingLeadDocumentPeer::LEAD_TYPE_ID, $leasingLeadType->getId(), $comparison);
        } elseif ($leasingLeadType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LeasingLeadDocumentPeer::LEAD_TYPE_ID, $leasingLeadType->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
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
     * @param   LeasingLeadDocument $leasingLeadDocument Object to remove from the list of results
     *
     * @return LeasingLeadDocumentQuery The current query, for fluid interface
     */
    public function prune($leasingLeadDocument = null)
    {
        if ($leasingLeadDocument) {
            $this->addUsingAlias(LeasingLeadDocumentPeer::ID, $leasingLeadDocument->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
