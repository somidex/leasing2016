<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingLeaseTypePeer;
use Leasing\CoreBundle\Model\LeasingLocationPeer;
use Leasing\CoreBundle\Model\LeasingProjectsPeer;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitDressUpPeer;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsPeer;
use Leasing\CoreBundle\Model\LeasingUnitPeer;
use Leasing\CoreBundle\Model\LeasingUnitTypePeer;
use Leasing\CoreBundle\Model\map\LeasingUnitTableMap;

abstract class BaseLeasingUnitPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'unit';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingUnit';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingUnitTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 14;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 14;

    /** the column name for the id field */
    const ID = 'unit.id';

    /** the column name for the name field */
    const NAME = 'unit.name';

    /** the column name for the post_id field */
    const POST_ID = 'unit.post_id';

    /** the column name for the slug field */
    const SLUG = 'unit.slug';

    /** the column name for the content field */
    const CONTENT = 'unit.content';

    /** the column name for the availability field */
    const AVAILABILITY = 'unit.availability';

    /** the column name for the price_range field */
    const PRICE_RANGE = 'unit.price_range';

    /** the column name for the status field */
    const STATUS = 'unit.status';

    /** the column name for the unit_type_id field */
    const UNIT_TYPE_ID = 'unit.unit_type_id';

    /** the column name for the location_id field */
    const LOCATION_ID = 'unit.location_id';

    /** the column name for the lease_type_id field */
    const LEASE_TYPE_ID = 'unit.lease_type_id';

    /** the column name for the project_id field */
    const PROJECT_ID = 'unit.project_id';

    /** the column name for the br_id field */
    const BR_ID = 'unit.br_id';

    /** the column name for the dress_up_id field */
    const DRESS_UP_ID = 'unit.dress_up_id';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingUnit objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingUnit[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingUnitPeer::$fieldNames[LeasingUnitPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'PostId', 'Slug', 'Content', 'Availability', 'PriceRange', 'Status', 'UnitTypeId', 'LocationId', 'LeaseTypeId', 'ProjectId', 'BrId', 'DressUpId', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'postId', 'slug', 'content', 'availability', 'priceRange', 'status', 'unitTypeId', 'locationId', 'leaseTypeId', 'projectId', 'brId', 'dressUpId', ),
        BasePeer::TYPE_COLNAME => array (LeasingUnitPeer::ID, LeasingUnitPeer::NAME, LeasingUnitPeer::POST_ID, LeasingUnitPeer::SLUG, LeasingUnitPeer::CONTENT, LeasingUnitPeer::AVAILABILITY, LeasingUnitPeer::PRICE_RANGE, LeasingUnitPeer::STATUS, LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitPeer::LOCATION_ID, LeasingUnitPeer::LEASE_TYPE_ID, LeasingUnitPeer::PROJECT_ID, LeasingUnitPeer::BR_ID, LeasingUnitPeer::DRESS_UP_ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NAME', 'POST_ID', 'SLUG', 'CONTENT', 'AVAILABILITY', 'PRICE_RANGE', 'STATUS', 'UNIT_TYPE_ID', 'LOCATION_ID', 'LEASE_TYPE_ID', 'PROJECT_ID', 'BR_ID', 'DRESS_UP_ID', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'post_id', 'slug', 'content', 'availability', 'price_range', 'status', 'unit_type_id', 'location_id', 'lease_type_id', 'project_id', 'br_id', 'dress_up_id', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingUnitPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'PostId' => 2, 'Slug' => 3, 'Content' => 4, 'Availability' => 5, 'PriceRange' => 6, 'Status' => 7, 'UnitTypeId' => 8, 'LocationId' => 9, 'LeaseTypeId' => 10, 'ProjectId' => 11, 'BrId' => 12, 'DressUpId' => 13, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'postId' => 2, 'slug' => 3, 'content' => 4, 'availability' => 5, 'priceRange' => 6, 'status' => 7, 'unitTypeId' => 8, 'locationId' => 9, 'leaseTypeId' => 10, 'projectId' => 11, 'brId' => 12, 'dressUpId' => 13, ),
        BasePeer::TYPE_COLNAME => array (LeasingUnitPeer::ID => 0, LeasingUnitPeer::NAME => 1, LeasingUnitPeer::POST_ID => 2, LeasingUnitPeer::SLUG => 3, LeasingUnitPeer::CONTENT => 4, LeasingUnitPeer::AVAILABILITY => 5, LeasingUnitPeer::PRICE_RANGE => 6, LeasingUnitPeer::STATUS => 7, LeasingUnitPeer::UNIT_TYPE_ID => 8, LeasingUnitPeer::LOCATION_ID => 9, LeasingUnitPeer::LEASE_TYPE_ID => 10, LeasingUnitPeer::PROJECT_ID => 11, LeasingUnitPeer::BR_ID => 12, LeasingUnitPeer::DRESS_UP_ID => 13, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NAME' => 1, 'POST_ID' => 2, 'SLUG' => 3, 'CONTENT' => 4, 'AVAILABILITY' => 5, 'PRICE_RANGE' => 6, 'STATUS' => 7, 'UNIT_TYPE_ID' => 8, 'LOCATION_ID' => 9, 'LEASE_TYPE_ID' => 10, 'PROJECT_ID' => 11, 'BR_ID' => 12, 'DRESS_UP_ID' => 13, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'post_id' => 2, 'slug' => 3, 'content' => 4, 'availability' => 5, 'price_range' => 6, 'status' => 7, 'unit_type_id' => 8, 'location_id' => 9, 'lease_type_id' => 10, 'project_id' => 11, 'br_id' => 12, 'dress_up_id' => 13, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = LeasingUnitPeer::getFieldNames($toType);
        $key = isset(LeasingUnitPeer::$fieldKeys[$fromType][$name]) ? LeasingUnitPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingUnitPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, LeasingUnitPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingUnitPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. LeasingUnitPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingUnitPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(LeasingUnitPeer::ID);
            $criteria->addSelectColumn(LeasingUnitPeer::NAME);
            $criteria->addSelectColumn(LeasingUnitPeer::POST_ID);
            $criteria->addSelectColumn(LeasingUnitPeer::SLUG);
            $criteria->addSelectColumn(LeasingUnitPeer::CONTENT);
            $criteria->addSelectColumn(LeasingUnitPeer::AVAILABILITY);
            $criteria->addSelectColumn(LeasingUnitPeer::PRICE_RANGE);
            $criteria->addSelectColumn(LeasingUnitPeer::STATUS);
            $criteria->addSelectColumn(LeasingUnitPeer::UNIT_TYPE_ID);
            $criteria->addSelectColumn(LeasingUnitPeer::LOCATION_ID);
            $criteria->addSelectColumn(LeasingUnitPeer::LEASE_TYPE_ID);
            $criteria->addSelectColumn(LeasingUnitPeer::PROJECT_ID);
            $criteria->addSelectColumn(LeasingUnitPeer::BR_ID);
            $criteria->addSelectColumn(LeasingUnitPeer::DRESS_UP_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.post_id');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.content');
            $criteria->addSelectColumn($alias . '.availability');
            $criteria->addSelectColumn($alias . '.price_range');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.unit_type_id');
            $criteria->addSelectColumn($alias . '.location_id');
            $criteria->addSelectColumn($alias . '.lease_type_id');
            $criteria->addSelectColumn($alias . '.project_id');
            $criteria->addSelectColumn($alias . '.br_id');
            $criteria->addSelectColumn($alias . '.dress_up_id');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return LeasingUnit
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingUnitPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return LeasingUnitPeer::populateObjects(LeasingUnitPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param LeasingUnit $obj A LeasingUnit object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingUnitPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A LeasingUnit object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingUnit) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingUnit object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingUnitPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingUnit Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingUnitPeer::$instances[$key])) {
                return LeasingUnitPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (LeasingUnitPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingUnitPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to unit
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = LeasingUnitPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingUnitPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingUnitPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (LeasingUnit object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingUnitPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingUnitPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingUnitPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingUnitType table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingUnitType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingLocation table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingLocation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingLeaseType table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingLeaseType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingProjects table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingProjects(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingUnitDressUp table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingUnitDressUp(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingUnitNumberBedrooms table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingUnitNumberBedrooms(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with their LeasingUnitType objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingUnitType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        LeasingUnitTypePeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingUnit) to $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with their LeasingLocation objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingLocation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        LeasingLocationPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingLocationPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingLocationPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingLocationPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingUnit) to $obj2 (LeasingLocation)
                $obj2->addLeasingUnit($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with their LeasingLeaseType objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingLeaseType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        LeasingLeaseTypePeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingLeaseTypePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingLeaseTypePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingUnit) to $obj2 (LeasingLeaseType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with their LeasingProjects objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingProjects(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        LeasingProjectsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingProjectsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingProjectsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingProjectsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingUnit) to $obj2 (LeasingProjects)
                $obj2->addLeasingUnit($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with their LeasingUnitDressUp objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingUnitDressUp(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        LeasingUnitDressUpPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingUnitDressUpPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingUnit) to $obj2 (LeasingUnitDressUp)
                $obj2->addLeasingUnit($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with their LeasingUnitNumberBedrooms objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingUnitNumberBedrooms(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;
        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingUnit) to $obj2 (LeasingUnitNumberBedrooms)
                $obj2->addLeasingUnit($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingLocationPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLocationPeer::NUM_HYDRATE_COLUMNS;

        LeasingLeaseTypePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingLeaseTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingProjectsPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingProjectsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitDressUpPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitDressUpPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + LeasingUnitNumberBedroomsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingUnitType rows

            $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);
            } // if joined row not null

            // Add objects for joined LeasingLocation rows

            $key3 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = LeasingLocationPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = LeasingLocationPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLocationPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLocation)
                $obj3->addLeasingUnit($obj1);
            } // if joined row not null

            // Add objects for joined LeasingLeaseType rows

            $key4 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = LeasingLeaseTypePeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingLeaseTypePeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingLeaseType)
                $obj4->addLeasingUnit($obj1);
            } // if joined row not null

            // Add objects for joined LeasingProjects rows

            $key5 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = LeasingProjectsPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = LeasingProjectsPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingProjectsPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingProjects)
                $obj5->addLeasingUnit($obj1);
            } // if joined row not null

            // Add objects for joined LeasingUnitDressUp rows

            $key6 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol6);
            if ($key6 !== null) {
                $obj6 = LeasingUnitDressUpPeer::getInstanceFromPool($key6);
                if (!$obj6) {

                    $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj6, $key6);
                } // if obj6 loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitDressUp)
                $obj6->addLeasingUnit($obj1);
            } // if joined row not null

            // Add objects for joined LeasingUnitNumberBedrooms rows

            $key7 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol7);
            if ($key7 !== null) {
                $obj7 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key7);
                if (!$obj7) {

                    $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj7, $key7);
                } // if obj7 loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj7 (LeasingUnitNumberBedrooms)
                $obj7->addLeasingUnit($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingUnitType table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingUnitType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingLocation table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingLocation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingLeaseType table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingLeaseType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingProjects table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingProjects(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingUnitDressUp table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingUnitDressUp(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingUnitNumberBedrooms table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingUnitNumberBedrooms(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingUnitPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects except LeasingUnitType.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingUnitType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingLocationPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingLocationPeer::NUM_HYDRATE_COLUMNS;

        LeasingLeaseTypePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLeaseTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingProjectsPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingProjectsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitDressUpPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingUnitDressUpPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitNumberBedroomsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingLocation rows

                $key2 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingLocationPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingLocationPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingLocationPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingLocation)
                $obj2->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLeaseType rows

                $key3 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingLeaseTypePeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLeaseTypePeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLeaseType)
                $obj3->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingProjects rows

                $key4 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = LeasingProjectsPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = LeasingProjectsPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingProjectsPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingProjects)
                $obj4->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitDressUp rows

                $key5 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = LeasingUnitDressUpPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingUnitDressUp)
                $obj5->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitNumberBedrooms rows

                $key6 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitNumberBedrooms)
                $obj6->addLeasingUnit($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects except LeasingLocation.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingLocation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingLeaseTypePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLeaseTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingProjectsPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingProjectsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitDressUpPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingUnitDressUpPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitNumberBedroomsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingUnitType rows

                $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLeaseType rows

                $key3 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingLeaseTypePeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLeaseTypePeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLeaseType)
                $obj3->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingProjects rows

                $key4 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = LeasingProjectsPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = LeasingProjectsPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingProjectsPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingProjects)
                $obj4->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitDressUp rows

                $key5 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = LeasingUnitDressUpPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingUnitDressUp)
                $obj5->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitNumberBedrooms rows

                $key6 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitNumberBedrooms)
                $obj6->addLeasingUnit($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects except LeasingLeaseType.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingLeaseType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingLocationPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLocationPeer::NUM_HYDRATE_COLUMNS;

        LeasingProjectsPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingProjectsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitDressUpPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingUnitDressUpPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitNumberBedroomsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingUnitType rows

                $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLocation rows

                $key3 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingLocationPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingLocationPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLocationPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLocation)
                $obj3->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingProjects rows

                $key4 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = LeasingProjectsPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = LeasingProjectsPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingProjectsPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingProjects)
                $obj4->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitDressUp rows

                $key5 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = LeasingUnitDressUpPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingUnitDressUp)
                $obj5->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitNumberBedrooms rows

                $key6 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitNumberBedrooms)
                $obj6->addLeasingUnit($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects except LeasingProjects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingProjects(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingLocationPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLocationPeer::NUM_HYDRATE_COLUMNS;

        LeasingLeaseTypePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingLeaseTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitDressUpPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingUnitDressUpPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitNumberBedroomsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingUnitType rows

                $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLocation rows

                $key3 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingLocationPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingLocationPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLocationPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLocation)
                $obj3->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLeaseType rows

                $key4 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = LeasingLeaseTypePeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingLeaseTypePeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingLeaseType)
                $obj4->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitDressUp rows

                $key5 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = LeasingUnitDressUpPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingUnitDressUp)
                $obj5->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitNumberBedrooms rows

                $key6 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitNumberBedrooms)
                $obj6->addLeasingUnit($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects except LeasingUnitDressUp.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingUnitDressUp(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingLocationPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLocationPeer::NUM_HYDRATE_COLUMNS;

        LeasingLeaseTypePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingLeaseTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingProjectsPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingProjectsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitNumberBedroomsPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitNumberBedroomsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::BR_ID, LeasingUnitNumberBedroomsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingUnitType rows

                $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLocation rows

                $key3 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingLocationPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingLocationPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLocationPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLocation)
                $obj3->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLeaseType rows

                $key4 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = LeasingLeaseTypePeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingLeaseTypePeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingLeaseType)
                $obj4->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingProjects rows

                $key5 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = LeasingProjectsPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = LeasingProjectsPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingProjectsPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingProjects)
                $obj5->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitNumberBedrooms rows

                $key6 = LeasingUnitNumberBedroomsPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = LeasingUnitNumberBedroomsPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = LeasingUnitNumberBedroomsPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitNumberBedroomsPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitNumberBedrooms)
                $obj6->addLeasingUnit($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingUnit objects pre-filled with all related objects except LeasingUnitNumberBedrooms.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingUnit objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingUnitNumberBedrooms(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);
        }

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol2 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingLocationPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingLocationPeer::NUM_HYDRATE_COLUMNS;

        LeasingLeaseTypePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingLeaseTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingProjectsPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + LeasingProjectsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitDressUpPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + LeasingUnitDressUpPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingUnitPeer::UNIT_TYPE_ID, LeasingUnitTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LOCATION_ID, LeasingLocationPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::LEASE_TYPE_ID, LeasingLeaseTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::PROJECT_ID, LeasingProjectsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingUnitPeer::DRESS_UP_ID, LeasingUnitDressUpPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingUnitPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingUnitPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingUnitPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingUnitType rows

                $key2 = LeasingUnitTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingUnitTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingUnitTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj2 (LeasingUnitType)
                $obj2->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLocation rows

                $key3 = LeasingLocationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingLocationPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingLocationPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingLocationPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj3 (LeasingLocation)
                $obj3->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingLeaseType rows

                $key4 = LeasingLeaseTypePeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = LeasingLeaseTypePeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = LeasingLeaseTypePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingLeaseTypePeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj4 (LeasingLeaseType)
                $obj4->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingProjects rows

                $key5 = LeasingProjectsPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = LeasingProjectsPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = LeasingProjectsPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    LeasingProjectsPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj5 (LeasingProjects)
                $obj5->addLeasingUnit($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitDressUp rows

                $key6 = LeasingUnitDressUpPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = LeasingUnitDressUpPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = LeasingUnitDressUpPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    LeasingUnitDressUpPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (LeasingUnit) to the collection in $obj6 (LeasingUnitDressUp)
                $obj6->addLeasingUnit($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(LeasingUnitPeer::DATABASE_NAME)->getTable(LeasingUnitPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingUnitPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingUnitPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingUnitTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return LeasingUnitPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingUnit or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingUnit object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingUnit object
        }

        if ($criteria->containsKey(LeasingUnitPeer::ID) && $criteria->keyContainsValue(LeasingUnitPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingUnitPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a LeasingUnit or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingUnit object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingUnitPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingUnitPeer::ID);
            $value = $criteria->remove(LeasingUnitPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingUnitPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingUnitPeer::TABLE_NAME);
            }

        } else { // $values is LeasingUnit object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the unit table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingUnitPeer::TABLE_NAME, $con, LeasingUnitPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingUnitPeer::clearInstancePool();
            LeasingUnitPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingUnit or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingUnit object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingUnitPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingUnit) { // it's a model object
            // invalidate the cache for this single object
            LeasingUnitPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingUnitPeer::DATABASE_NAME);
            $criteria->add(LeasingUnitPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingUnitPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingUnitPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingUnitPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingUnit object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingUnit $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingUnitPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingUnitPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(LeasingUnitPeer::DATABASE_NAME, LeasingUnitPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingUnit
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingUnitPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingUnitPeer::DATABASE_NAME);
        $criteria->add(LeasingUnitPeer::ID, $pk);

        $v = LeasingUnitPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingUnit[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingUnitPeer::DATABASE_NAME);
            $criteria->add(LeasingUnitPeer::ID, $pks, Criteria::IN);
            $objs = LeasingUnitPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingUnitPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingUnitPeer::buildTableMap();

