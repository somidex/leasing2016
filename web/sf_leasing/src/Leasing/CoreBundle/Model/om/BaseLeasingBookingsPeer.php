<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingBookingLeadsPeer;
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingBookingsPeer;
use Leasing\CoreBundle\Model\LeasingUnitPeer;
use Leasing\CoreBundle\Model\map\LeasingBookingsTableMap;

abstract class BaseLeasingBookingsPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'bookings';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingBookings';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingBookingsTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 14;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 14;

    /** the column name for the id field */
    const ID = 'bookings.id';

    /** the column name for the booking_leads_id field */
    const BOOKING_LEADS_ID = 'bookings.booking_leads_id';

    /** the column name for the unit_id field */
    const UNIT_ID = 'bookings.unit_id';

    /** the column name for the check_in field */
    const CHECK_IN = 'bookings.check_in';

    /** the column name for the check_out field */
    const CHECK_OUT = 'bookings.check_out';

    /** the column name for the confirmation_code field */
    const CONFIRMATION_CODE = 'bookings.confirmation_code';

    /** the column name for the start_date field */
    const START_DATE = 'bookings.start_date';

    /** the column name for the end_date field */
    const END_DATE = 'bookings.end_date';

    /** the column name for the notes field */
    const NOTES = 'bookings.notes';

    /** the column name for the date_added field */
    const DATE_ADDED = 'bookings.date_added';

    /** the column name for the status field */
    const STATUS = 'bookings.status';

    /** the column name for the prev_status field */
    const PREV_STATUS = 'bookings.prev_status';

    /** the column name for the processing field */
    const PROCESSING = 'bookings.processing';

    /** the column name for the processed_by field */
    const PROCESSED_BY = 'bookings.processed_by';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingBookings objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingBookings[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingBookingsPeer::$fieldNames[LeasingBookingsPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'BookingLeadsId', 'UnitId', 'CheckIn', 'CheckOut', 'ConfirmationCode', 'StartDate', 'EndDate', 'Notes', 'DateAdded', 'Status', 'PrevStatus', 'Processing', 'ProcessedBy', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'bookingLeadsId', 'unitId', 'checkIn', 'checkOut', 'confirmationCode', 'startDate', 'endDate', 'notes', 'dateAdded', 'status', 'prevStatus', 'processing', 'processedBy', ),
        BasePeer::TYPE_COLNAME => array (LeasingBookingsPeer::ID, LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingsPeer::UNIT_ID, LeasingBookingsPeer::CHECK_IN, LeasingBookingsPeer::CHECK_OUT, LeasingBookingsPeer::CONFIRMATION_CODE, LeasingBookingsPeer::START_DATE, LeasingBookingsPeer::END_DATE, LeasingBookingsPeer::NOTES, LeasingBookingsPeer::DATE_ADDED, LeasingBookingsPeer::STATUS, LeasingBookingsPeer::PREV_STATUS, LeasingBookingsPeer::PROCESSING, LeasingBookingsPeer::PROCESSED_BY, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'BOOKING_LEADS_ID', 'UNIT_ID', 'CHECK_IN', 'CHECK_OUT', 'CONFIRMATION_CODE', 'START_DATE', 'END_DATE', 'NOTES', 'DATE_ADDED', 'STATUS', 'PREV_STATUS', 'PROCESSING', 'PROCESSED_BY', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'booking_leads_id', 'unit_id', 'check_in', 'check_out', 'confirmation_code', 'start_date', 'end_date', 'notes', 'date_added', 'status', 'prev_status', 'processing', 'processed_by', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingBookingsPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'BookingLeadsId' => 1, 'UnitId' => 2, 'CheckIn' => 3, 'CheckOut' => 4, 'ConfirmationCode' => 5, 'StartDate' => 6, 'EndDate' => 7, 'Notes' => 8, 'DateAdded' => 9, 'Status' => 10, 'PrevStatus' => 11, 'Processing' => 12, 'ProcessedBy' => 13, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'bookingLeadsId' => 1, 'unitId' => 2, 'checkIn' => 3, 'checkOut' => 4, 'confirmationCode' => 5, 'startDate' => 6, 'endDate' => 7, 'notes' => 8, 'dateAdded' => 9, 'status' => 10, 'prevStatus' => 11, 'processing' => 12, 'processedBy' => 13, ),
        BasePeer::TYPE_COLNAME => array (LeasingBookingsPeer::ID => 0, LeasingBookingsPeer::BOOKING_LEADS_ID => 1, LeasingBookingsPeer::UNIT_ID => 2, LeasingBookingsPeer::CHECK_IN => 3, LeasingBookingsPeer::CHECK_OUT => 4, LeasingBookingsPeer::CONFIRMATION_CODE => 5, LeasingBookingsPeer::START_DATE => 6, LeasingBookingsPeer::END_DATE => 7, LeasingBookingsPeer::NOTES => 8, LeasingBookingsPeer::DATE_ADDED => 9, LeasingBookingsPeer::STATUS => 10, LeasingBookingsPeer::PREV_STATUS => 11, LeasingBookingsPeer::PROCESSING => 12, LeasingBookingsPeer::PROCESSED_BY => 13, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'BOOKING_LEADS_ID' => 1, 'UNIT_ID' => 2, 'CHECK_IN' => 3, 'CHECK_OUT' => 4, 'CONFIRMATION_CODE' => 5, 'START_DATE' => 6, 'END_DATE' => 7, 'NOTES' => 8, 'DATE_ADDED' => 9, 'STATUS' => 10, 'PREV_STATUS' => 11, 'PROCESSING' => 12, 'PROCESSED_BY' => 13, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'booking_leads_id' => 1, 'unit_id' => 2, 'check_in' => 3, 'check_out' => 4, 'confirmation_code' => 5, 'start_date' => 6, 'end_date' => 7, 'notes' => 8, 'date_added' => 9, 'status' => 10, 'prev_status' => 11, 'processing' => 12, 'processed_by' => 13, ),
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
        $toNames = LeasingBookingsPeer::getFieldNames($toType);
        $key = isset(LeasingBookingsPeer::$fieldKeys[$fromType][$name]) ? LeasingBookingsPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingBookingsPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingBookingsPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingBookingsPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingBookingsPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingBookingsPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingBookingsPeer::ID);
            $criteria->addSelectColumn(LeasingBookingsPeer::BOOKING_LEADS_ID);
            $criteria->addSelectColumn(LeasingBookingsPeer::UNIT_ID);
            $criteria->addSelectColumn(LeasingBookingsPeer::CHECK_IN);
            $criteria->addSelectColumn(LeasingBookingsPeer::CHECK_OUT);
            $criteria->addSelectColumn(LeasingBookingsPeer::CONFIRMATION_CODE);
            $criteria->addSelectColumn(LeasingBookingsPeer::START_DATE);
            $criteria->addSelectColumn(LeasingBookingsPeer::END_DATE);
            $criteria->addSelectColumn(LeasingBookingsPeer::NOTES);
            $criteria->addSelectColumn(LeasingBookingsPeer::DATE_ADDED);
            $criteria->addSelectColumn(LeasingBookingsPeer::STATUS);
            $criteria->addSelectColumn(LeasingBookingsPeer::PREV_STATUS);
            $criteria->addSelectColumn(LeasingBookingsPeer::PROCESSING);
            $criteria->addSelectColumn(LeasingBookingsPeer::PROCESSED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.booking_leads_id');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.check_in');
            $criteria->addSelectColumn($alias . '.check_out');
            $criteria->addSelectColumn($alias . '.confirmation_code');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.date_added');
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
        $criteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingBookings
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingBookingsPeer::doSelect($critcopy, $con);
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
        return LeasingBookingsPeer::populateObjects(LeasingBookingsPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

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
     * @param LeasingBookings $obj A LeasingBookings object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingBookingsPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingBookings object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingBookings) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingBookings object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingBookingsPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingBookings Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingBookingsPeer::$instances[$key])) {
                return LeasingBookingsPeer::$instances[$key];
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
        foreach (LeasingBookingsPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingBookingsPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to bookings
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
        $cls = LeasingBookingsPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingBookingsPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingBookingsPeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingBookings object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingBookingsPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingBookingsPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingBookingsPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingBookingLeads table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingBookingLeads(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingLeadsPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingUnit table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingUnit(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingBookingsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingBookings objects pre-filled with their LeasingBookingLeads objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingBookingLeads(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);
        }

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol = LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;
        LeasingBookingLeadsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingLeadsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingBookingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingBookingLeadsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingBookingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingBookingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingBookings) to $obj2 (LeasingBookingLeads)
                $obj2->addLeasingBookings($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingBookings objects pre-filled with their LeasingUnit objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingUnit(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);
        }

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol = LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;
        LeasingUnitPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingBookingsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingUnitPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingUnitPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingUnitPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingBookings) to $obj2 (LeasingUnit)
                $obj2->addLeasingBookings($obj1);

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
        $criteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingBookingsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingBookings objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);
        }

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingBookingLeadsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingBookingLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingBookingsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingBookingLeads rows

            $key2 = LeasingBookingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingBookingLeadsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingBookingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingBookingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingBookings) to the collection in $obj2 (LeasingBookingLeads)
                $obj2->addLeasingBookings($obj1);
            } // if joined row not null

            // Add objects for joined LeasingUnit rows

            $key3 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = LeasingUnitPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = LeasingUnitPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingUnitPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (LeasingBookings) to the collection in $obj3 (LeasingUnit)
                $obj3->addLeasingBookings($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingBookingLeads table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingBookingLeads(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingBookingsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingUnit table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingUnit(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingBookingsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingLeadsPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingBookings objects pre-filled with all related objects except LeasingBookingLeads.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingBookingLeads(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);
        }

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingBookingsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingUnit rows

                $key2 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingUnitPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingUnitPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingUnitPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingBookings) to the collection in $obj2 (LeasingUnit)
                $obj2->addLeasingBookings($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingBookings objects pre-filled with all related objects except LeasingUnit.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingBookings objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingUnit(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);
        }

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingBookingLeadsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingBookingLeadsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingBookingsPeer::BOOKING_LEADS_ID, LeasingBookingLeadsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingBookingsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingBookingsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingBookingsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingBookingLeads rows

                $key2 = LeasingBookingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingBookingLeadsPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingBookingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingBookingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingBookings) to the collection in $obj2 (LeasingBookingLeads)
                $obj2->addLeasingBookings($obj1);

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
        return Propel::getDatabaseMap(LeasingBookingsPeer::DATABASE_NAME)->getTable(LeasingBookingsPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingBookingsPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingBookingsPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingBookingsTableMap());
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
        return LeasingBookingsPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingBookings or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingBookings object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingBookings object
        }

        if ($criteria->containsKey(LeasingBookingsPeer::ID) && $criteria->keyContainsValue(LeasingBookingsPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingBookingsPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingBookings or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingBookings object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingBookingsPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingBookingsPeer::ID);
            $value = $criteria->remove(LeasingBookingsPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingBookingsPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingBookingsPeer::TABLE_NAME);
            }

        } else { // $values is LeasingBookings object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the bookings table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingBookingsPeer::TABLE_NAME, $con, LeasingBookingsPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingBookingsPeer::clearInstancePool();
            LeasingBookingsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingBookings or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingBookings object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingBookingsPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingBookings) { // it's a model object
            // invalidate the cache for this single object
            LeasingBookingsPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingBookingsPeer::DATABASE_NAME);
            $criteria->add(LeasingBookingsPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingBookingsPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingBookingsPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingBookingsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingBookings object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingBookings $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingBookingsPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingBookingsPeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingBookingsPeer::DATABASE_NAME, LeasingBookingsPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingBookings
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingBookingsPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingBookingsPeer::DATABASE_NAME);
        $criteria->add(LeasingBookingsPeer::ID, $pk);

        $v = LeasingBookingsPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingBookings[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingBookingsPeer::DATABASE_NAME);
            $criteria->add(LeasingBookingsPeer::ID, $pks, Criteria::IN);
            $objs = LeasingBookingsPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingBookingsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingBookingsPeer::buildTableMap();

