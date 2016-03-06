<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingSpecialistPeer;
use Leasing\CoreBundle\Model\LeasingSpecialistSchedule;
use Leasing\CoreBundle\Model\LeasingSpecialistSchedulePeer;
use Leasing\CoreBundle\Model\map\LeasingSpecialistScheduleTableMap;

abstract class BaseLeasingSpecialistSchedulePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'leasing_specialist_schedule';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingSpecialistSchedule';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingSpecialistScheduleTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 7;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 7;

    /** the column name for the id field */
    const ID = 'leasing_specialist_schedule.id';

    /** the column name for the leasing_specialist_id field */
    const LEASING_SPECIALIST_ID = 'leasing_specialist_schedule.leasing_specialist_id';

    /** the column name for the lead_type_id field */
    const LEAD_TYPE_ID = 'leasing_specialist_schedule.lead_type_id';

    /** the column name for the lead_id field */
    const LEAD_ID = 'leasing_specialist_schedule.lead_id';

    /** the column name for the date field */
    const DATE = 'leasing_specialist_schedule.date';

    /** the column name for the time field */
    const TIME = 'leasing_specialist_schedule.time';

    /** the column name for the status field */
    const STATUS = 'leasing_specialist_schedule.status';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingSpecialistSchedule objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingSpecialistSchedule[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingSpecialistSchedulePeer::$fieldNames[LeasingSpecialistSchedulePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'LeasingSpecialistId', 'LeadTypeId', 'LeadId', 'Date', 'Time', 'Status', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'leasingSpecialistId', 'leadTypeId', 'leadId', 'date', 'time', 'status', ),
        BasePeer::TYPE_COLNAME => array (LeasingSpecialistSchedulePeer::ID, LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, LeasingSpecialistSchedulePeer::LEAD_TYPE_ID, LeasingSpecialistSchedulePeer::LEAD_ID, LeasingSpecialistSchedulePeer::DATE, LeasingSpecialistSchedulePeer::TIME, LeasingSpecialistSchedulePeer::STATUS, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'LEASING_SPECIALIST_ID', 'LEAD_TYPE_ID', 'LEAD_ID', 'DATE', 'TIME', 'STATUS', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'leasing_specialist_id', 'lead_type_id', 'lead_id', 'date', 'time', 'status', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingSpecialistSchedulePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'LeasingSpecialistId' => 1, 'LeadTypeId' => 2, 'LeadId' => 3, 'Date' => 4, 'Time' => 5, 'Status' => 6, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'leasingSpecialistId' => 1, 'leadTypeId' => 2, 'leadId' => 3, 'date' => 4, 'time' => 5, 'status' => 6, ),
        BasePeer::TYPE_COLNAME => array (LeasingSpecialistSchedulePeer::ID => 0, LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID => 1, LeasingSpecialistSchedulePeer::LEAD_TYPE_ID => 2, LeasingSpecialistSchedulePeer::LEAD_ID => 3, LeasingSpecialistSchedulePeer::DATE => 4, LeasingSpecialistSchedulePeer::TIME => 5, LeasingSpecialistSchedulePeer::STATUS => 6, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'LEASING_SPECIALIST_ID' => 1, 'LEAD_TYPE_ID' => 2, 'LEAD_ID' => 3, 'DATE' => 4, 'TIME' => 5, 'STATUS' => 6, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'leasing_specialist_id' => 1, 'lead_type_id' => 2, 'lead_id' => 3, 'date' => 4, 'time' => 5, 'status' => 6, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
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
        $toNames = LeasingSpecialistSchedulePeer::getFieldNames($toType);
        $key = isset(LeasingSpecialistSchedulePeer::$fieldKeys[$fromType][$name]) ? LeasingSpecialistSchedulePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingSpecialistSchedulePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingSpecialistSchedulePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingSpecialistSchedulePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingSpecialistSchedulePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingSpecialistSchedulePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::ID);
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID);
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::LEAD_TYPE_ID);
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::LEAD_ID);
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::DATE);
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::TIME);
            $criteria->addSelectColumn(LeasingSpecialistSchedulePeer::STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.leasing_specialist_id');
            $criteria->addSelectColumn($alias . '.lead_type_id');
            $criteria->addSelectColumn($alias . '.lead_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.time');
            $criteria->addSelectColumn($alias . '.status');
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
        $criteria->setPrimaryTableName(LeasingSpecialistSchedulePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingSpecialistSchedulePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingSpecialistSchedule
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingSpecialistSchedulePeer::doSelect($critcopy, $con);
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
        return LeasingSpecialistSchedulePeer::populateObjects(LeasingSpecialistSchedulePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingSpecialistSchedulePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);

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
     * @param LeasingSpecialistSchedule $obj A LeasingSpecialistSchedule object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingSpecialistSchedulePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingSpecialistSchedule object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingSpecialistSchedule) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingSpecialistSchedule object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingSpecialistSchedulePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingSpecialistSchedule Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingSpecialistSchedulePeer::$instances[$key])) {
                return LeasingSpecialistSchedulePeer::$instances[$key];
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
        foreach (LeasingSpecialistSchedulePeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingSpecialistSchedulePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to leasing_specialist_schedule
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
        $cls = LeasingSpecialistSchedulePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingSpecialistSchedulePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingSpecialistSchedulePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingSpecialistSchedulePeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingSpecialistSchedule object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingSpecialistSchedulePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingSpecialistSchedulePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingSpecialistSchedulePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingSpecialistSchedulePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingSpecialistSchedulePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingSpecialist table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingSpecialist(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingSpecialistSchedulePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingSpecialistSchedulePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, LeasingSpecialistPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingSpecialistSchedule objects pre-filled with their LeasingSpecialist objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingSpecialistSchedule objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingSpecialist(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);
        }

        LeasingSpecialistSchedulePeer::addSelectColumns($criteria);
        $startcol = LeasingSpecialistSchedulePeer::NUM_HYDRATE_COLUMNS;
        LeasingSpecialistPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, LeasingSpecialistPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingSpecialistSchedulePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingSpecialistSchedulePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingSpecialistSchedulePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingSpecialistSchedulePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingSpecialistPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingSpecialistPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingSpecialistPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingSpecialistPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingSpecialistSchedule) to $obj2 (LeasingSpecialist)
                $obj2->addLeasingSpecialistSchedule($obj1);

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
        $criteria->setPrimaryTableName(LeasingSpecialistSchedulePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingSpecialistSchedulePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, LeasingSpecialistPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingSpecialistSchedule objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingSpecialistSchedule objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);
        }

        LeasingSpecialistSchedulePeer::addSelectColumns($criteria);
        $startcol2 = LeasingSpecialistSchedulePeer::NUM_HYDRATE_COLUMNS;

        LeasingSpecialistPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingSpecialistPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingSpecialistSchedulePeer::LEASING_SPECIALIST_ID, LeasingSpecialistPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingSpecialistSchedulePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingSpecialistSchedulePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingSpecialistSchedulePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingSpecialistSchedulePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingSpecialist rows

            $key2 = LeasingSpecialistPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingSpecialistPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingSpecialistPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingSpecialistPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingSpecialistSchedule) to the collection in $obj2 (LeasingSpecialist)
                $obj2->addLeasingSpecialistSchedule($obj1);
            } // if joined row not null

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
        return Propel::getDatabaseMap(LeasingSpecialistSchedulePeer::DATABASE_NAME)->getTable(LeasingSpecialistSchedulePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingSpecialistSchedulePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingSpecialistSchedulePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingSpecialistScheduleTableMap());
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
        return LeasingSpecialistSchedulePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingSpecialistSchedule or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingSpecialistSchedule object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingSpecialistSchedule object
        }

        if ($criteria->containsKey(LeasingSpecialistSchedulePeer::ID) && $criteria->keyContainsValue(LeasingSpecialistSchedulePeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingSpecialistSchedulePeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingSpecialistSchedule or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingSpecialistSchedule object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingSpecialistSchedulePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingSpecialistSchedulePeer::ID);
            $value = $criteria->remove(LeasingSpecialistSchedulePeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingSpecialistSchedulePeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingSpecialistSchedulePeer::TABLE_NAME);
            }

        } else { // $values is LeasingSpecialistSchedule object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the leasing_specialist_schedule table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingSpecialistSchedulePeer::TABLE_NAME, $con, LeasingSpecialistSchedulePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingSpecialistSchedulePeer::clearInstancePool();
            LeasingSpecialistSchedulePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingSpecialistSchedule or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingSpecialistSchedule object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingSpecialistSchedulePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingSpecialistSchedule) { // it's a model object
            // invalidate the cache for this single object
            LeasingSpecialistSchedulePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingSpecialistSchedulePeer::DATABASE_NAME);
            $criteria->add(LeasingSpecialistSchedulePeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingSpecialistSchedulePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingSpecialistSchedulePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingSpecialistSchedulePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingSpecialistSchedule object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingSpecialistSchedule $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingSpecialistSchedulePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingSpecialistSchedulePeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingSpecialistSchedulePeer::DATABASE_NAME, LeasingSpecialistSchedulePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingSpecialistSchedule
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingSpecialistSchedulePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingSpecialistSchedulePeer::DATABASE_NAME);
        $criteria->add(LeasingSpecialistSchedulePeer::ID, $pk);

        $v = LeasingSpecialistSchedulePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingSpecialistSchedule[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingSpecialistSchedulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingSpecialistSchedulePeer::DATABASE_NAME);
            $criteria->add(LeasingSpecialistSchedulePeer::ID, $pks, Criteria::IN);
            $objs = LeasingSpecialistSchedulePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingSpecialistSchedulePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingSpecialistSchedulePeer::buildTableMap();

