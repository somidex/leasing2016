<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingBookingsPeer;
use Leasing\CoreBundle\Model\LeasingEventBookingsPeer;
use Leasing\CoreBundle\Model\LeasingParkingLeadsPeer;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsPeer;
use Leasing\CoreBundle\Model\map\LeasingPaymentTransactionsTableMap;

abstract class BaseLeasingPaymentTransactionsPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'payment_transactions';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingPaymentTransactions';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingPaymentTransactionsTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 12;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 12;

    /** the column name for the id field */
    const ID = 'payment_transactions.id';

    /** the column name for the transaction_type field */
    const TRANSACTION_TYPE = 'payment_transactions.transaction_type';

    /** the column name for the transaction_date field */
    const TRANSACTION_DATE = 'payment_transactions.transaction_date';

    /** the column name for the transaction_code field */
    const TRANSACTION_CODE = 'payment_transactions.transaction_code';

    /** the column name for the transaction_cost field */
    const TRANSACTION_COST = 'payment_transactions.transaction_cost';

    /** the column name for the tax field */
    const TAX = 'payment_transactions.tax';

    /** the column name for the fee field */
    const FEE = 'payment_transactions.fee';

    /** the column name for the amount_paid field */
    const AMOUNT_PAID = 'payment_transactions.amount_paid';

    /** the column name for the parking_leads_id field */
    const PARKING_LEADS_ID = 'payment_transactions.parking_leads_id';

    /** the column name for the event_bookings_id field */
    const EVENT_BOOKINGS_ID = 'payment_transactions.event_bookings_id';

    /** the column name for the bookings_id field */
    const BOOKINGS_ID = 'payment_transactions.bookings_id';

    /** the column name for the processed_by field */
    const PROCESSED_BY = 'payment_transactions.processed_by';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingPaymentTransactions objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingPaymentTransactions[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingPaymentTransactionsPeer::$fieldNames[LeasingPaymentTransactionsPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'TransactionType', 'TransactionDate', 'TransactionCode', 'TransactionCost', 'Tax', 'Fee', 'AmountPaid', 'ParkingLeadsId', 'EventBookingsId', 'BookingsId', 'ProcessedBy', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'transactionType', 'transactionDate', 'transactionCode', 'transactionCost', 'tax', 'fee', 'amountPaid', 'parkingLeadsId', 'eventBookingsId', 'bookingsId', 'processedBy', ),
        BasePeer::TYPE_COLNAME => array (LeasingPaymentTransactionsPeer::ID, LeasingPaymentTransactionsPeer::TRANSACTION_TYPE, LeasingPaymentTransactionsPeer::TRANSACTION_DATE, LeasingPaymentTransactionsPeer::TRANSACTION_CODE, LeasingPaymentTransactionsPeer::TRANSACTION_COST, LeasingPaymentTransactionsPeer::TAX, LeasingPaymentTransactionsPeer::FEE, LeasingPaymentTransactionsPeer::AMOUNT_PAID, LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingPaymentTransactionsPeer::PROCESSED_BY, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TRANSACTION_TYPE', 'TRANSACTION_DATE', 'TRANSACTION_CODE', 'TRANSACTION_COST', 'TAX', 'FEE', 'AMOUNT_PAID', 'PARKING_LEADS_ID', 'EVENT_BOOKINGS_ID', 'BOOKINGS_ID', 'PROCESSED_BY', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'transaction_type', 'transaction_date', 'transaction_code', 'transaction_cost', 'tax', 'fee', 'amount_paid', 'parking_leads_id', 'event_bookings_id', 'bookings_id', 'processed_by', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingPaymentTransactionsPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TransactionType' => 1, 'TransactionDate' => 2, 'TransactionCode' => 3, 'TransactionCost' => 4, 'Tax' => 5, 'Fee' => 6, 'AmountPaid' => 7, 'ParkingLeadsId' => 8, 'EventBookingsId' => 9, 'BookingsId' => 10, 'ProcessedBy' => 11, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'transactionType' => 1, 'transactionDate' => 2, 'transactionCode' => 3, 'transactionCost' => 4, 'tax' => 5, 'fee' => 6, 'amountPaid' => 7, 'parkingLeadsId' => 8, 'eventBookingsId' => 9, 'bookingsId' => 10, 'processedBy' => 11, ),
        BasePeer::TYPE_COLNAME => array (LeasingPaymentTransactionsPeer::ID => 0, LeasingPaymentTransactionsPeer::TRANSACTION_TYPE => 1, LeasingPaymentTransactionsPeer::TRANSACTION_DATE => 2, LeasingPaymentTransactionsPeer::TRANSACTION_CODE => 3, LeasingPaymentTransactionsPeer::TRANSACTION_COST => 4, LeasingPaymentTransactionsPeer::TAX => 5, LeasingPaymentTransactionsPeer::FEE => 6, LeasingPaymentTransactionsPeer::AMOUNT_PAID => 7, LeasingPaymentTransactionsPeer::PARKING_LEADS_ID => 8, LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID => 9, LeasingPaymentTransactionsPeer::BOOKINGS_ID => 10, LeasingPaymentTransactionsPeer::PROCESSED_BY => 11, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TRANSACTION_TYPE' => 1, 'TRANSACTION_DATE' => 2, 'TRANSACTION_CODE' => 3, 'TRANSACTION_COST' => 4, 'TAX' => 5, 'FEE' => 6, 'AMOUNT_PAID' => 7, 'PARKING_LEADS_ID' => 8, 'EVENT_BOOKINGS_ID' => 9, 'BOOKINGS_ID' => 10, 'PROCESSED_BY' => 11, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'transaction_type' => 1, 'transaction_date' => 2, 'transaction_code' => 3, 'transaction_cost' => 4, 'tax' => 5, 'fee' => 6, 'amount_paid' => 7, 'parking_leads_id' => 8, 'event_bookings_id' => 9, 'bookings_id' => 10, 'processed_by' => 11, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $toNames = LeasingPaymentTransactionsPeer::getFieldNames($toType);
        $key = isset(LeasingPaymentTransactionsPeer::$fieldKeys[$fromType][$name]) ? LeasingPaymentTransactionsPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingPaymentTransactionsPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingPaymentTransactionsPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingPaymentTransactionsPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingPaymentTransactionsPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingPaymentTransactionsPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::ID);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::TRANSACTION_DATE);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::TRANSACTION_CODE);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::TRANSACTION_COST);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::TAX);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::FEE);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::AMOUNT_PAID);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::BOOKINGS_ID);
            $criteria->addSelectColumn(LeasingPaymentTransactionsPeer::PROCESSED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.transaction_type');
            $criteria->addSelectColumn($alias . '.transaction_date');
            $criteria->addSelectColumn($alias . '.transaction_code');
            $criteria->addSelectColumn($alias . '.transaction_cost');
            $criteria->addSelectColumn($alias . '.tax');
            $criteria->addSelectColumn($alias . '.fee');
            $criteria->addSelectColumn($alias . '.amount_paid');
            $criteria->addSelectColumn($alias . '.parking_leads_id');
            $criteria->addSelectColumn($alias . '.event_bookings_id');
            $criteria->addSelectColumn($alias . '.bookings_id');
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
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingPaymentTransactions
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingPaymentTransactionsPeer::doSelect($critcopy, $con);
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
        return LeasingPaymentTransactionsPeer::populateObjects(LeasingPaymentTransactionsPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

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
     * @param LeasingPaymentTransactions $obj A LeasingPaymentTransactions object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingPaymentTransactionsPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingPaymentTransactions object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingPaymentTransactions) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingPaymentTransactions object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingPaymentTransactionsPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingPaymentTransactions Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingPaymentTransactionsPeer::$instances[$key])) {
                return LeasingPaymentTransactionsPeer::$instances[$key];
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
        foreach (LeasingPaymentTransactionsPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingPaymentTransactionsPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to payment_transactions
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
        $cls = LeasingPaymentTransactionsPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingPaymentTransactionsPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingPaymentTransactions object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingPaymentTransactionsPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingPaymentTransactionsPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingPaymentTransactionsPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingParkingLeads table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingParkingLeads(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingEventBookings table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingEventBookings(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingBookings table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingBookings(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with their LeasingParkingLeads objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingParkingLeads(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;
        LeasingParkingLeadsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingParkingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingParkingLeadsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingParkingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingParkingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to $obj2 (LeasingParkingLeads)
                $obj2->addLeasingPaymentTransactions($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with their LeasingEventBookings objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingEventBookings(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;
        LeasingEventBookingsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingEventBookingsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingEventBookingsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingEventBookingsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to $obj2 (LeasingEventBookings)
                $obj2->addLeasingPaymentTransactions($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with their LeasingBookings objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingBookings(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;
        LeasingBookingsPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingBookingsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingBookingsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingBookingsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to $obj2 (LeasingBookings)
                $obj2->addLeasingPaymentTransactions($obj1);

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
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;

        LeasingParkingLeadsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingParkingLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingParkingLeads rows

            $key2 = LeasingParkingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingParkingLeadsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingParkingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingParkingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj2 (LeasingParkingLeads)
                $obj2->addLeasingPaymentTransactions($obj1);
            } // if joined row not null

            // Add objects for joined LeasingEventBookings rows

            $key3 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = LeasingEventBookingsPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = LeasingEventBookingsPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingEventBookingsPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj3 (LeasingEventBookings)
                $obj3->addLeasingPaymentTransactions($obj1);
            } // if joined row not null

            // Add objects for joined LeasingBookings rows

            $key4 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = LeasingBookingsPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = LeasingBookingsPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingBookingsPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj4 (LeasingBookings)
                $obj4->addLeasingPaymentTransactions($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingParkingLeads table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingParkingLeads(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingEventBookings table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingEventBookings(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingBookings table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingBookings(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with all related objects except LeasingParkingLeads.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingParkingLeads(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingEventBookings rows

                $key2 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingEventBookingsPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingEventBookingsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingEventBookingsPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj2 (LeasingEventBookings)
                $obj2->addLeasingPaymentTransactions($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingBookings rows

                $key3 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingBookingsPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingBookingsPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingBookingsPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj3 (LeasingBookings)
                $obj3->addLeasingPaymentTransactions($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with all related objects except LeasingEventBookings.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingEventBookings(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;

        LeasingParkingLeadsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingParkingLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingBookingsPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingBookingsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::BOOKINGS_ID, LeasingBookingsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingParkingLeads rows

                $key2 = LeasingParkingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingParkingLeadsPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingParkingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingParkingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj2 (LeasingParkingLeads)
                $obj2->addLeasingPaymentTransactions($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingBookings rows

                $key3 = LeasingBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingBookingsPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingBookingsPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingBookingsPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj3 (LeasingBookings)
                $obj3->addLeasingPaymentTransactions($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingPaymentTransactions objects pre-filled with all related objects except LeasingBookings.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingPaymentTransactions objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingBookings(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        }

        LeasingPaymentTransactionsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS;

        LeasingParkingLeadsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingParkingLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingEventBookingsPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, LeasingParkingLeadsPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, LeasingEventBookingsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingPaymentTransactionsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingPaymentTransactionsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingPaymentTransactionsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingPaymentTransactionsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingParkingLeads rows

                $key2 = LeasingParkingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingParkingLeadsPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingParkingLeadsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingParkingLeadsPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj2 (LeasingParkingLeads)
                $obj2->addLeasingPaymentTransactions($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingEventBookings rows

                $key3 = LeasingEventBookingsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingEventBookingsPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingEventBookingsPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingEventBookingsPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingPaymentTransactions) to the collection in $obj3 (LeasingEventBookings)
                $obj3->addLeasingPaymentTransactions($obj1);

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
        return Propel::getDatabaseMap(LeasingPaymentTransactionsPeer::DATABASE_NAME)->getTable(LeasingPaymentTransactionsPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingPaymentTransactionsPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingPaymentTransactionsPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingPaymentTransactionsTableMap());
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
        return LeasingPaymentTransactionsPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingPaymentTransactions or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingPaymentTransactions object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingPaymentTransactions object
        }

        if ($criteria->containsKey(LeasingPaymentTransactionsPeer::ID) && $criteria->keyContainsValue(LeasingPaymentTransactionsPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingPaymentTransactionsPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingPaymentTransactions or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingPaymentTransactions object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingPaymentTransactionsPeer::ID);
            $value = $criteria->remove(LeasingPaymentTransactionsPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingPaymentTransactionsPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingPaymentTransactionsPeer::TABLE_NAME);
            }

        } else { // $values is LeasingPaymentTransactions object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the payment_transactions table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingPaymentTransactionsPeer::TABLE_NAME, $con, LeasingPaymentTransactionsPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingPaymentTransactionsPeer::clearInstancePool();
            LeasingPaymentTransactionsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingPaymentTransactions or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingPaymentTransactions object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingPaymentTransactionsPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingPaymentTransactions) { // it's a model object
            // invalidate the cache for this single object
            LeasingPaymentTransactionsPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingPaymentTransactionsPeer::DATABASE_NAME);
            $criteria->add(LeasingPaymentTransactionsPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingPaymentTransactionsPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingPaymentTransactionsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingPaymentTransactions object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingPaymentTransactions $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingPaymentTransactionsPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingPaymentTransactionsPeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingPaymentTransactionsPeer::DATABASE_NAME, LeasingPaymentTransactionsPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingPaymentTransactions
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingPaymentTransactionsPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        $criteria->add(LeasingPaymentTransactionsPeer::ID, $pk);

        $v = LeasingPaymentTransactionsPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingPaymentTransactions[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingPaymentTransactionsPeer::DATABASE_NAME);
            $criteria->add(LeasingPaymentTransactionsPeer::ID, $pks, Criteria::IN);
            $objs = LeasingPaymentTransactionsPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingPaymentTransactionsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingPaymentTransactionsPeer::buildTableMap();

