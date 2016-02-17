<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventBookingsPeer;
use Leasing\CoreBundle\Model\LeasingEventLeadsPeer;
use Leasing\CoreBundle\Model\LeasingEventPlacePeer;
use Leasing\CoreBundle\Model\map\LeasingEventBookingsTableMap;

abstract class BaseLeasingEventBookingsPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'event_bookings';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingEventBookings';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingEventBookingsTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 14;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 14;

    /** the column name for the id field */
    const ID = 'event_bookings.id';

    /** the column name for the application_number field */
    const APPLICATION_NUMBER = 'event_bookings.application_number';

    /** the column name for the event_place_id field */
    const EVENT_PLACE_ID = 'event_bookings.event_place_id';

    /** the column name for the event_place_specific field */
    const EVENT_PLACE_SPECIFIC = 'event_bookings.event_place_specific';

    /** the column name for the event_leads_id field */
    const EVENT_LEADS_ID = 'event_bookings.event_leads_id';

    /** the column name for the event_date field */
    const EVENT_DATE = 'event_bookings.event_date';

    /** the column name for the event_start_time field */
    const EVENT_START_TIME = 'event_bookings.event_start_time';

    /** the column name for the event_end_time field */
    const EVENT_END_TIME = 'event_bookings.event_end_time';

    /** the column name for the date_added field */
    const DATE_ADDED = 'event_bookings.date_added';

    /** the column name for the first_heard field */
    const FIRST_HEARD = 'event_bookings.first_heard';

    /** the column name for the status field */
    const STATUS = 'event_bookings.status';

    /** the column name for the prev_status field */
    const PREV_STATUS = 'event_bookings.prev_status';

    /** the column name for the processing field */
    const PROCESSING = 'event_bookings.processing';

    /** the column name for the processed_by field */
    const PROCESSED_BY = 'event_bookings.processed_by';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingEventBookings objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingEventBookings[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingEventBookingsPeer::$fieldNames[LeasingEventBookingsPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationNumber', 'EventPlaceId', 'EventPlaceSpecific', 'EventLeadsId', 'EventDate', 'EventStartTime', 'EventEndTime', 'DateAdded', 'FirstHeard', 'Status', 'PrevStatus', 'Processing', 'ProcessedBy', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'applicationNumber', 'eventPlaceId', 'eventPlaceSpecific', 'eventLeadsId', 'eventDate', 'eventStartTime', 'eventEndTime', 'dateAdded', 'firstHeard', 'status', 'prevStatus', 'processing', 'processedBy', ),
        BasePeer::TYPE_COLNAME => array (LeasingEventBookingsPeer::ID, LeasingEventBookingsPeer::APPLICATION_NUMBER, LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC, LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventBookingsPeer::EVENT_DATE, LeasingEventBookingsPeer::EVENT_START_TIME, LeasingEventBookingsPeer::EVENT_END_TIME, LeasingEventBookingsPeer::DATE_ADDED, LeasingEventBookingsPeer::FIRST_HEARD, LeasingEventBookingsPeer::STATUS, LeasingEventBookingsPeer::PREV_STATUS, LeasingEventBookingsPeer::PROCESSING, LeasingEventBookingsPeer::PROCESSED_BY, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'APPLICATION_NUMBER', 'EVENT_PLACE_ID', 'EVENT_PLACE_SPECIFIC', 'EVENT_LEADS_ID', 'EVENT_DATE', 'EVENT_START_TIME', 'EVENT_END_TIME', 'DATE_ADDED', 'FIRST_HEARD', 'STATUS', 'PREV_STATUS', 'PROCESSING', 'PROCESSED_BY', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'application_number', 'event_place_id', 'event_place_specific', 'event_leads_id', 'event_date', 'event_start_time', 'event_end_time', 'date_added', 'first_heard', 'status', 'prev_status', 'processing', 'processed_by', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingEventBookingsPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationNumber' => 1, 'EventPlaceId' => 2, 'EventPlaceSpecific' => 3, 'EventLeadsId' => 4, 'EventDate' => 5, 'EventStartTime' => 6, 'EventEndTime' => 7, 'DateAdded' => 8, 'FirstHeard' => 9, 'Status' => 10, 'PrevStatus' => 11, 'Processing' => 12, 'ProcessedBy' => 13, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'applicationNumber' => 1, 'eventPlaceId' => 2, 'eventPlaceSpecific' => 3, 'eventLeadsId' => 4, 'eventDate' => 5, 'eventStartTime' => 6, 'eventEndTime' => 7, 'dateAdded' => 8, 'firstHeard' => 9, 'status' => 10, 'prevStatus' => 11, 'processing' => 12, 'processedBy' => 13, ),
        BasePeer::TYPE_COLNAME => array (LeasingEventBookingsPeer::ID => 0, LeasingEventBookingsPeer::APPLICATION_NUMBER => 1, LeasingEventBookingsPeer::EVENT_PLACE_ID => 2, LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC => 3, LeasingEventBookingsPeer::EVENT_LEADS_ID => 4, LeasingEventBookingsPeer::EVENT_DATE => 5, LeasingEventBookingsPeer::EVENT_START_TIME => 6, LeasingEventBookingsPeer::EVENT_END_TIME => 7, LeasingEventBookingsPeer::DATE_ADDED => 8, LeasingEventBookingsPeer::FIRST_HEARD => 9, LeasingEventBookingsPeer::STATUS => 10, LeasingEventBookingsPeer::PREV_STATUS => 11, LeasingEventBookingsPeer::PROCESSING => 12, LeasingEventBookingsPeer::PROCESSED_BY => 13, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'APPLICATION_NUMBER' => 1, 'EVENT_PLACE_ID' => 2, 'EVENT_PLACE_SPECIFIC' => 3, 'EVENT_LEADS_ID' => 4, 'EVENT_DATE' => 5, 'EVENT_START_TIME' => 6, 'EVENT_END_TIME' => 7, 'DATE_ADDED' => 8, 'FIRST_HEARD' => 9, 'STATUS' => 10, 'PREV_STATUS' => 11, 'PROCESSING' => 12, 'PROCESSED_BY' => 13, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_number' => 1, 'event_place_id' => 2, 'event_place_specific' => 3, 'event_leads_id' => 4, 'event_date' => 5, 'event_start_time' => 6, 'event_end_time' => 7, 'date_added' => 8, 'first_heard' => 9, 'status' => 10, 'prev_status' => 11, 'processing' => 12, 'processed_by' => 13, ),
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
        $toNames = LeasingEventBookingsPeer::getFieldNames($toType);
        $key = isset(LeasingEventBookingsPeer::$fieldKeys[$fromType][$name]) ? LeasingEventBookingsPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingEventBookingsPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingEventBookingsPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingEventBookingsPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingEventBookingsPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingEventBookingsPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingEventBookingsPeer::ID);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::APPLICATION_NUMBER);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::EVENT_PLACE_ID);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::EVENT_LEADS_ID);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::EVENT_DATE);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::EVENT_START_TIME);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::EVENT_END_TIME);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::DATE_ADDED);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::FIRST_HEARD);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::STATUS);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::PREV_STATUS);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::PROCESSING);
            $criteria->addSelectColumn(LeasingEventBookingsPeer::PROCESSED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.application_number');
            $criteria->addSelectColumn($alias . '.event_place_id');
            $criteria->addSelectColumn($alias . '.event_place_specific');
            $criteria->addSelectColumn($alias . '.event_leads_id');
            $criteria->addSelectColumn($alias . '.event_date');
            $criteria->addSelectColumn($alias . '.event_start_time');
            $criteria->addSelectColumn($alias . '.event_end_time');
            $criteria->addSelectColumn($alias . '.date_added');
            $criteria->addSelectColumn($alias . '.first_heard');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.prev_status');
            $criteria->addSelectColumn($alias . '.processing');
            $criteria->addSelectColumn($alias . '.processed_by');
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
        $criteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingEventBookings
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingEventBookingsPeer::doSelect($critcopy, $con);
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
        return LeasingEventBookingsPeer::populateObjects(LeasingEventBookingsPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

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
     * @param LeasingEventBookings $obj A LeasingEventBookings object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingEventBookingsPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingEventBookings object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingEventBookings) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingEventBookings object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingEventBookingsPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingEventBookings Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingEventBookingsPeer::$instances[$key])) {
                return LeasingEventBookingsPeer::$instances[$key];
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
        foreach (LeasingEventBookingsPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingEventBookingsPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to event_bookings
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
        $cls = LeasingEventBookingsPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingEventBookingsPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingEventBookingsPeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingEventBookings object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingEventBookingsPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingEventBookingsPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingEventBookingsPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingEventPlace table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingEventPlace(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventPlacePeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingEventLeads table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingEventLeads(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventLeadsPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingEventBookings objects pre-filled with their LeasingEventPlace objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingEventPlace(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);
        }

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol = LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;
        LeasingEventPlacePeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventPlacePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingEventBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingEventPlacePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingEventPlacePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingEventPlacePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingEventPlacePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingEventBookings) to $obj2 (LeasingEventPlace)
                $obj2->addLeasingEventBookings($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingEventBookings objects pre-filled with their LeasingEventLeads objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingEventLeads(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);
        }

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol = LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;
        LeasingEventLeadsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventLeadsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingEventBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingEventLeadsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingEventLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingEventLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingEventBookings) to $obj2 (LeasingEventLeads)
                $obj2->addLeasingEventBookings($obj1);

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
        $criteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventPlacePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventLeadsPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingEventBookings objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);
        }

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingEventPlacePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingEventPlacePeer::NUM_HYDRATE_COLUMNS;

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventPlacePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventLeadsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingEventBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingEventPlace rows

            $key2 = LeasingEventPlacePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingEventPlacePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingEventPlacePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingEventPlacePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingEventBookings) to the collection in $obj2 (LeasingEventPlace)
                $obj2->addLeasingEventBookings($obj1);
            } // if joined row not null

            // Add objects for joined LeasingEventLeads rows

            $key3 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = LeasingEventLeadsPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = LeasingEventLeadsPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingEventLeadsPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (LeasingEventBookings) to the collection in $obj3 (LeasingEventLeads)
                $obj3->addLeasingEventBookings($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingEventPlace table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingEventPlace(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventLeadsPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingEventLeads table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingEventLeads(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventPlacePeer::ID, $join_behavior);

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
     * Selects a collection of LeasingEventBookings objects pre-filled with all related objects except LeasingEventPlace.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingEventPlace(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);
        }

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_LEADS_ID, LeasingEventLeadsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingEventBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingEventLeads rows

                $key2 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingEventLeadsPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingEventLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingEventLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingEventBookings) to the collection in $obj2 (LeasingEventLeads)
                $obj2->addLeasingEventBookings($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingEventBookings objects pre-filled with all related objects except LeasingEventLeads.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingEventLeads(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);
        }

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingEventPlacePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingEventPlacePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingEventBookingsPeer::EVENT_PLACE_ID, LeasingEventPlacePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingEventBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingEventPlace rows

                $key2 = LeasingEventPlacePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingEventPlacePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingEventPlacePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingEventPlacePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingEventBookings) to the collection in $obj2 (LeasingEventPlace)
                $obj2->addLeasingEventBookings($obj1);

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
        return Propel::getDatabaseMap(LeasingEventBookingsPeer::DATABASE_NAME)->getTable(LeasingEventBookingsPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingEventBookingsPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingEventBookingsPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingEventBookingsTableMap());
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
        return LeasingEventBookingsPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingEventBookings or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingEventBookings object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingEventBookings object
        }

        if ($criteria->containsKey(LeasingEventBookingsPeer::ID) && $criteria->keyContainsValue(LeasingEventBookingsPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingEventBookingsPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingEventBookings or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingEventBookings object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingEventBookingsPeer::ID);
            $value = $criteria->remove(LeasingEventBookingsPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingEventBookingsPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingEventBookingsPeer::TABLE_NAME);
            }

        } else { // $values is LeasingEventBookings object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the event_bookings table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingEventBookingsPeer::TABLE_NAME, $con, LeasingEventBookingsPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingEventBookingsPeer::clearInstancePool();
            LeasingEventBookingsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingEventBookings or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingEventBookings object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingEventBookingsPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingEventBookings) { // it's a model object
            // invalidate the cache for this single object
            LeasingEventBookingsPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingEventBookingsPeer::DATABASE_NAME);
            $criteria->add(LeasingEventBookingsPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingEventBookingsPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingEventBookingsPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingEventBookingsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingEventBookings object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingEventBookings $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingEventBookingsPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingEventBookingsPeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingEventBookingsPeer::DATABASE_NAME, LeasingEventBookingsPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingEventBookings
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingEventBookingsPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingEventBookingsPeer::DATABASE_NAME);
        $criteria->add(LeasingEventBookingsPeer::ID, $pk);

        $v = LeasingEventBookingsPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingEventBookings[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingEventBookingsPeer::DATABASE_NAME);
            $criteria->add(LeasingEventBookingsPeer::ID, $pks, Criteria::IN);
            $objs = LeasingEventBookingsPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingEventBookingsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingEventBookingsPeer::buildTableMap();

