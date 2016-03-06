<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingAccountTypePeer;
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingTenantsPeer;
use Leasing\CoreBundle\Model\LeasingUnitOwnerPeer;
use Leasing\CoreBundle\Model\LeasingUnitPeer;
use Leasing\CoreBundle\Model\map\LeasingTenantsTableMap;

abstract class BaseLeasingTenantsPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'tenants';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingTenants';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingTenantsTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 13;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 13;

    /** the column name for the id field */
    const ID = 'tenants.id';

    /** the column name for the account_type field */
    const ACCOUNT_TYPE = 'tenants.account_type';

    /** the column name for the building field */
    const BUILDING = 'tenants.building';

    /** the column name for the unit_id field */
    const UNIT_ID = 'tenants.unit_id';

    /** the column name for the ps_number field */
    const PS_NUMBER = 'tenants.ps_number';

    /** the column name for the unit_owner_id field */
    const UNIT_OWNER_ID = 'tenants.unit_owner_id';

    /** the column name for the tenant_name field */
    const TENANT_NAME = 'tenants.tenant_name';

    /** the column name for the contact field */
    const CONTACT = 'tenants.contact';

    /** the column name for the email field */
    const EMAIL = 'tenants.email';

    /** the column name for the lease_start_date field */
    const LEASE_START_DATE = 'tenants.lease_start_date';

    /** the column name for the lease_end_date field */
    const LEASE_END_DATE = 'tenants.lease_end_date';

    /** the column name for the status field */
    const STATUS = 'tenants.status';

    /** the column name for the prev_status field */
    const PREV_STATUS = 'tenants.prev_status';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingTenants objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingTenants[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingTenantsPeer::$fieldNames[LeasingTenantsPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'AccountType', 'Building', 'UnitId', 'PsNumber', 'UnitOwnerId', 'TenantName', 'Contact', 'Email', 'LeaseStartDate', 'LeaseEndDate', 'Status', 'PrevStatus', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'accountType', 'building', 'unitId', 'psNumber', 'unitOwnerId', 'tenantName', 'contact', 'email', 'leaseStartDate', 'leaseEndDate', 'status', 'prevStatus', ),
        BasePeer::TYPE_COLNAME => array (LeasingTenantsPeer::ID, LeasingTenantsPeer::ACCOUNT_TYPE, LeasingTenantsPeer::BUILDING, LeasingTenantsPeer::UNIT_ID, LeasingTenantsPeer::PS_NUMBER, LeasingTenantsPeer::UNIT_OWNER_ID, LeasingTenantsPeer::TENANT_NAME, LeasingTenantsPeer::CONTACT, LeasingTenantsPeer::EMAIL, LeasingTenantsPeer::LEASE_START_DATE, LeasingTenantsPeer::LEASE_END_DATE, LeasingTenantsPeer::STATUS, LeasingTenantsPeer::PREV_STATUS, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'ACCOUNT_TYPE', 'BUILDING', 'UNIT_ID', 'PS_NUMBER', 'UNIT_OWNER_ID', 'TENANT_NAME', 'CONTACT', 'EMAIL', 'LEASE_START_DATE', 'LEASE_END_DATE', 'STATUS', 'PREV_STATUS', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'account_type', 'building', 'unit_id', 'ps_number', 'unit_owner_id', 'tenant_name', 'contact', 'email', 'lease_start_date', 'lease_end_date', 'status', 'prev_status', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingTenantsPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AccountType' => 1, 'Building' => 2, 'UnitId' => 3, 'PsNumber' => 4, 'UnitOwnerId' => 5, 'TenantName' => 6, 'Contact' => 7, 'Email' => 8, 'LeaseStartDate' => 9, 'LeaseEndDate' => 10, 'Status' => 11, 'PrevStatus' => 12, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'accountType' => 1, 'building' => 2, 'unitId' => 3, 'psNumber' => 4, 'unitOwnerId' => 5, 'tenantName' => 6, 'contact' => 7, 'email' => 8, 'leaseStartDate' => 9, 'leaseEndDate' => 10, 'status' => 11, 'prevStatus' => 12, ),
        BasePeer::TYPE_COLNAME => array (LeasingTenantsPeer::ID => 0, LeasingTenantsPeer::ACCOUNT_TYPE => 1, LeasingTenantsPeer::BUILDING => 2, LeasingTenantsPeer::UNIT_ID => 3, LeasingTenantsPeer::PS_NUMBER => 4, LeasingTenantsPeer::UNIT_OWNER_ID => 5, LeasingTenantsPeer::TENANT_NAME => 6, LeasingTenantsPeer::CONTACT => 7, LeasingTenantsPeer::EMAIL => 8, LeasingTenantsPeer::LEASE_START_DATE => 9, LeasingTenantsPeer::LEASE_END_DATE => 10, LeasingTenantsPeer::STATUS => 11, LeasingTenantsPeer::PREV_STATUS => 12, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'ACCOUNT_TYPE' => 1, 'BUILDING' => 2, 'UNIT_ID' => 3, 'PS_NUMBER' => 4, 'UNIT_OWNER_ID' => 5, 'TENANT_NAME' => 6, 'CONTACT' => 7, 'EMAIL' => 8, 'LEASE_START_DATE' => 9, 'LEASE_END_DATE' => 10, 'STATUS' => 11, 'PREV_STATUS' => 12, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'account_type' => 1, 'building' => 2, 'unit_id' => 3, 'ps_number' => 4, 'unit_owner_id' => 5, 'tenant_name' => 6, 'contact' => 7, 'email' => 8, 'lease_start_date' => 9, 'lease_end_date' => 10, 'status' => 11, 'prev_status' => 12, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $toNames = LeasingTenantsPeer::getFieldNames($toType);
        $key = isset(LeasingTenantsPeer::$fieldKeys[$fromType][$name]) ? LeasingTenantsPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingTenantsPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingTenantsPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingTenantsPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingTenantsPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingTenantsPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingTenantsPeer::ID);
            $criteria->addSelectColumn(LeasingTenantsPeer::ACCOUNT_TYPE);
            $criteria->addSelectColumn(LeasingTenantsPeer::BUILDING);
            $criteria->addSelectColumn(LeasingTenantsPeer::UNIT_ID);
            $criteria->addSelectColumn(LeasingTenantsPeer::PS_NUMBER);
            $criteria->addSelectColumn(LeasingTenantsPeer::UNIT_OWNER_ID);
            $criteria->addSelectColumn(LeasingTenantsPeer::TENANT_NAME);
            $criteria->addSelectColumn(LeasingTenantsPeer::CONTACT);
            $criteria->addSelectColumn(LeasingTenantsPeer::EMAIL);
            $criteria->addSelectColumn(LeasingTenantsPeer::LEASE_START_DATE);
            $criteria->addSelectColumn(LeasingTenantsPeer::LEASE_END_DATE);
            $criteria->addSelectColumn(LeasingTenantsPeer::STATUS);
            $criteria->addSelectColumn(LeasingTenantsPeer::PREV_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.account_type');
            $criteria->addSelectColumn($alias . '.building');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.ps_number');
            $criteria->addSelectColumn($alias . '.unit_owner_id');
            $criteria->addSelectColumn($alias . '.tenant_name');
            $criteria->addSelectColumn($alias . '.contact');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.lease_start_date');
            $criteria->addSelectColumn($alias . '.lease_end_date');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.prev_status');
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
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingTenants
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingTenantsPeer::doSelect($critcopy, $con);
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
        return LeasingTenantsPeer::populateObjects(LeasingTenantsPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

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
     * @param LeasingTenants $obj A LeasingTenants object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingTenantsPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingTenants object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingTenants) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingTenants object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingTenantsPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingTenants Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingTenantsPeer::$instances[$key])) {
                return LeasingTenantsPeer::$instances[$key];
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
        foreach (LeasingTenantsPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingTenantsPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to tenants
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
        $cls = LeasingTenantsPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingTenantsPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingTenantsPeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingTenants object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingTenantsPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingTenantsPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingTenantsPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingAccountType table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingAccountType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

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
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingUnitOwner table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingUnitOwner(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingTenants objects pre-filled with their LeasingAccountType objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingAccountType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;
        LeasingAccountTypePeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingAccountTypePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingAccountTypePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingAccountTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingAccountTypePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingTenants) to $obj2 (LeasingAccountType)
                $obj2->addLeasingTenants($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingTenants objects pre-filled with their LeasingUnit objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingUnit(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;
        LeasingUnitPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (LeasingTenants) to $obj2 (LeasingUnit)
                $obj2->addLeasingTenants($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingTenants objects pre-filled with their LeasingUnitOwner objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingUnitOwner(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;
        LeasingUnitOwnerPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingUnitOwnerPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingUnitOwnerPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingUnitOwnerPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingUnitOwnerPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingTenants) to $obj2 (LeasingUnitOwner)
                $obj2->addLeasingTenants($obj1);

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
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingTenants objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;

        LeasingAccountTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingAccountTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitOwnerPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + LeasingUnitOwnerPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingAccountType rows

            $key2 = LeasingAccountTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingAccountTypePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingAccountTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingAccountTypePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj2 (LeasingAccountType)
                $obj2->addLeasingTenants($obj1);
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

                // Add the $obj1 (LeasingTenants) to the collection in $obj3 (LeasingUnit)
                $obj3->addLeasingTenants($obj1);
            } // if joined row not null

            // Add objects for joined LeasingUnitOwner rows

            $key4 = LeasingUnitOwnerPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = LeasingUnitOwnerPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = LeasingUnitOwnerPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    LeasingUnitOwnerPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj4 (LeasingUnitOwner)
                $obj4->addLeasingTenants($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingAccountType table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingAccountType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);

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
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingUnitOwner table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingUnitOwner(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingTenantsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingTenants objects pre-filled with all related objects except LeasingAccountType.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingAccountType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitOwnerPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingUnitOwnerPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (LeasingTenants) to the collection in $obj2 (LeasingUnit)
                $obj2->addLeasingTenants($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitOwner rows

                $key3 = LeasingUnitOwnerPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingUnitOwnerPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingUnitOwnerPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingUnitOwnerPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj3 (LeasingUnitOwner)
                $obj3->addLeasingTenants($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingTenants objects pre-filled with all related objects except LeasingUnit.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
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
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;

        LeasingAccountTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingAccountTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitOwnerPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingUnitOwnerPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_OWNER_ID, LeasingUnitOwnerPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingAccountType rows

                $key2 = LeasingAccountTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingAccountTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingAccountTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingAccountTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj2 (LeasingAccountType)
                $obj2->addLeasingTenants($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnitOwner rows

                $key3 = LeasingUnitOwnerPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingUnitOwnerPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingUnitOwnerPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingUnitOwnerPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj3 (LeasingUnitOwner)
                $obj3->addLeasingTenants($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingTenants objects pre-filled with all related objects except LeasingUnitOwner.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingTenants objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingUnitOwner(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);
        }

        LeasingTenantsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS;

        LeasingAccountTypePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingAccountTypePeer::NUM_HYDRATE_COLUMNS;

        LeasingUnitPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingUnitPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingTenantsPeer::ACCOUNT_TYPE, LeasingAccountTypePeer::ID, $join_behavior);

        $criteria->addJoin(LeasingTenantsPeer::UNIT_ID, LeasingUnitPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingTenantsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingTenantsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingTenantsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingTenantsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingAccountType rows

                $key2 = LeasingAccountTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingAccountTypePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingAccountTypePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingAccountTypePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj2 (LeasingAccountType)
                $obj2->addLeasingTenants($obj1);

            } // if joined row is not null

                // Add objects for joined LeasingUnit rows

                $key3 = LeasingUnitPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = LeasingUnitPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = LeasingUnitPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingUnitPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (LeasingTenants) to the collection in $obj3 (LeasingUnit)
                $obj3->addLeasingTenants($obj1);

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
        return Propel::getDatabaseMap(LeasingTenantsPeer::DATABASE_NAME)->getTable(LeasingTenantsPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingTenantsPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingTenantsPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingTenantsTableMap());
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
        return LeasingTenantsPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingTenants or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingTenants object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingTenants object
        }

        if ($criteria->containsKey(LeasingTenantsPeer::ID) && $criteria->keyContainsValue(LeasingTenantsPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingTenantsPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingTenants or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingTenants object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingTenantsPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingTenantsPeer::ID);
            $value = $criteria->remove(LeasingTenantsPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingTenantsPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingTenantsPeer::TABLE_NAME);
            }

        } else { // $values is LeasingTenants object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the tenants table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingTenantsPeer::TABLE_NAME, $con, LeasingTenantsPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingTenantsPeer::clearInstancePool();
            LeasingTenantsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingTenants or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingTenants object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingTenantsPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingTenants) { // it's a model object
            // invalidate the cache for this single object
            LeasingTenantsPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingTenantsPeer::DATABASE_NAME);
            $criteria->add(LeasingTenantsPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingTenantsPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingTenantsPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingTenantsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingTenants object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingTenants $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingTenantsPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingTenantsPeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingTenantsPeer::DATABASE_NAME, LeasingTenantsPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingTenants
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingTenantsPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingTenantsPeer::DATABASE_NAME);
        $criteria->add(LeasingTenantsPeer::ID, $pk);

        $v = LeasingTenantsPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingTenants[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingTenantsPeer::DATABASE_NAME);
            $criteria->add(LeasingTenantsPeer::ID, $pks, Criteria::IN);
            $objs = LeasingTenantsPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingTenantsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingTenantsPeer::buildTableMap();

