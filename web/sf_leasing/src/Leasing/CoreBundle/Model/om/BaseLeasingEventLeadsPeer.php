<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingCountryPeer;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventLeadsPeer;
use Leasing\CoreBundle\Model\LeasingNationalityPeer;
use Leasing\CoreBundle\Model\map\LeasingEventLeadsTableMap;

abstract class BaseLeasingEventLeadsPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'event_leads';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingEventLeads';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingEventLeadsTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 17;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 17;

    /** the column name for the id field */
    const ID = 'event_leads.id';

    /** the column name for the fname field */
    const FNAME = 'event_leads.fname';

    /** the column name for the lname field */
    const LNAME = 'event_leads.lname';

    /** the column name for the birthdate field */
    const BIRTHDATE = 'event_leads.birthdate';

    /** the column name for the age field */
    const AGE = 'event_leads.age';

    /** the column name for the gender field */
    const GENDER = 'event_leads.gender';

    /** the column name for the email field */
    const EMAIL = 'event_leads.email';

    /** the column name for the mobile field */
    const MOBILE = 'event_leads.mobile';

    /** the column name for the country_id field */
    const COUNTRY_ID = 'event_leads.country_id';

    /** the column name for the nationality_id field */
    const NATIONALITY_ID = 'event_leads.nationality_id';

    /** the column name for the event_lead_type field */
    const EVENT_LEAD_TYPE = 'event_leads.event_lead_type';

    /** the column name for the client_ip field */
    const CLIENT_IP = 'event_leads.client_ip';

    /** the column name for the client_id field */
    const CLIENT_ID = 'event_leads.client_id';

    /** the column name for the campaign field */
    const CAMPAIGN = 'event_leads.campaign';

    /** the column name for the medium field */
    const MEDIUM = 'event_leads.medium';

    /** the column name for the source field */
    const SOURCE = 'event_leads.source';

    /** the column name for the gacountry field */
    const GACOUNTRY = 'event_leads.gacountry';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingEventLeads objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingEventLeads[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingEventLeadsPeer::$fieldNames[LeasingEventLeadsPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Fname', 'Lname', 'Birthdate', 'Age', 'Gender', 'Email', 'Mobile', 'CountryId', 'NationalityId', 'EventLeadType', 'ClientIp', 'ClientId', 'Campaign', 'Medium', 'Source', 'Gacountry', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'fname', 'lname', 'birthdate', 'age', 'gender', 'email', 'mobile', 'countryId', 'nationalityId', 'eventLeadType', 'clientIp', 'clientId', 'campaign', 'medium', 'source', 'gacountry', ),
        BasePeer::TYPE_COLNAME => array (LeasingEventLeadsPeer::ID, LeasingEventLeadsPeer::FNAME, LeasingEventLeadsPeer::LNAME, LeasingEventLeadsPeer::BIRTHDATE, LeasingEventLeadsPeer::AGE, LeasingEventLeadsPeer::GENDER, LeasingEventLeadsPeer::EMAIL, LeasingEventLeadsPeer::MOBILE, LeasingEventLeadsPeer::COUNTRY_ID, LeasingEventLeadsPeer::NATIONALITY_ID, LeasingEventLeadsPeer::EVENT_LEAD_TYPE, LeasingEventLeadsPeer::CLIENT_IP, LeasingEventLeadsPeer::CLIENT_ID, LeasingEventLeadsPeer::CAMPAIGN, LeasingEventLeadsPeer::MEDIUM, LeasingEventLeadsPeer::SOURCE, LeasingEventLeadsPeer::GACOUNTRY, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'FNAME', 'LNAME', 'BIRTHDATE', 'AGE', 'GENDER', 'EMAIL', 'MOBILE', 'COUNTRY_ID', 'NATIONALITY_ID', 'EVENT_LEAD_TYPE', 'CLIENT_IP', 'CLIENT_ID', 'CAMPAIGN', 'MEDIUM', 'SOURCE', 'GACOUNTRY', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'fname', 'lname', 'birthdate', 'age', 'gender', 'email', 'mobile', 'country_id', 'nationality_id', 'event_lead_type', 'client_ip', 'client_id', 'campaign', 'medium', 'source', 'gacountry', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingEventLeadsPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Fname' => 1, 'Lname' => 2, 'Birthdate' => 3, 'Age' => 4, 'Gender' => 5, 'Email' => 6, 'Mobile' => 7, 'CountryId' => 8, 'NationalityId' => 9, 'EventLeadType' => 10, 'ClientIp' => 11, 'ClientId' => 12, 'Campaign' => 13, 'Medium' => 14, 'Source' => 15, 'Gacountry' => 16, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'fname' => 1, 'lname' => 2, 'birthdate' => 3, 'age' => 4, 'gender' => 5, 'email' => 6, 'mobile' => 7, 'countryId' => 8, 'nationalityId' => 9, 'eventLeadType' => 10, 'clientIp' => 11, 'clientId' => 12, 'campaign' => 13, 'medium' => 14, 'source' => 15, 'gacountry' => 16, ),
        BasePeer::TYPE_COLNAME => array (LeasingEventLeadsPeer::ID => 0, LeasingEventLeadsPeer::FNAME => 1, LeasingEventLeadsPeer::LNAME => 2, LeasingEventLeadsPeer::BIRTHDATE => 3, LeasingEventLeadsPeer::AGE => 4, LeasingEventLeadsPeer::GENDER => 5, LeasingEventLeadsPeer::EMAIL => 6, LeasingEventLeadsPeer::MOBILE => 7, LeasingEventLeadsPeer::COUNTRY_ID => 8, LeasingEventLeadsPeer::NATIONALITY_ID => 9, LeasingEventLeadsPeer::EVENT_LEAD_TYPE => 10, LeasingEventLeadsPeer::CLIENT_IP => 11, LeasingEventLeadsPeer::CLIENT_ID => 12, LeasingEventLeadsPeer::CAMPAIGN => 13, LeasingEventLeadsPeer::MEDIUM => 14, LeasingEventLeadsPeer::SOURCE => 15, LeasingEventLeadsPeer::GACOUNTRY => 16, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'FNAME' => 1, 'LNAME' => 2, 'BIRTHDATE' => 3, 'AGE' => 4, 'GENDER' => 5, 'EMAIL' => 6, 'MOBILE' => 7, 'COUNTRY_ID' => 8, 'NATIONALITY_ID' => 9, 'EVENT_LEAD_TYPE' => 10, 'CLIENT_IP' => 11, 'CLIENT_ID' => 12, 'CAMPAIGN' => 13, 'MEDIUM' => 14, 'SOURCE' => 15, 'GACOUNTRY' => 16, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'fname' => 1, 'lname' => 2, 'birthdate' => 3, 'age' => 4, 'gender' => 5, 'email' => 6, 'mobile' => 7, 'country_id' => 8, 'nationality_id' => 9, 'event_lead_type' => 10, 'client_ip' => 11, 'client_id' => 12, 'campaign' => 13, 'medium' => 14, 'source' => 15, 'gacountry' => 16, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
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
        $toNames = LeasingEventLeadsPeer::getFieldNames($toType);
        $key = isset(LeasingEventLeadsPeer::$fieldKeys[$fromType][$name]) ? LeasingEventLeadsPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingEventLeadsPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingEventLeadsPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingEventLeadsPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingEventLeadsPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingEventLeadsPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingEventLeadsPeer::ID);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::FNAME);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::LNAME);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::BIRTHDATE);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::AGE);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::GENDER);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::EMAIL);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::MOBILE);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::COUNTRY_ID);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::NATIONALITY_ID);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::EVENT_LEAD_TYPE);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::CLIENT_IP);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::CLIENT_ID);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::CAMPAIGN);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::MEDIUM);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::SOURCE);
            $criteria->addSelectColumn(LeasingEventLeadsPeer::GACOUNTRY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.fname');
            $criteria->addSelectColumn($alias . '.lname');
            $criteria->addSelectColumn($alias . '.birthdate');
            $criteria->addSelectColumn($alias . '.age');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.country_id');
            $criteria->addSelectColumn($alias . '.nationality_id');
            $criteria->addSelectColumn($alias . '.event_lead_type');
            $criteria->addSelectColumn($alias . '.client_ip');
            $criteria->addSelectColumn($alias . '.client_id');
            $criteria->addSelectColumn($alias . '.campaign');
            $criteria->addSelectColumn($alias . '.medium');
            $criteria->addSelectColumn($alias . '.source');
            $criteria->addSelectColumn($alias . '.gacountry');
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
        $criteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingEventLeads
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingEventLeadsPeer::doSelect($critcopy, $con);
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
        return LeasingEventLeadsPeer::populateObjects(LeasingEventLeadsPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

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
     * @param LeasingEventLeads $obj A LeasingEventLeads object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingEventLeadsPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingEventLeads object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingEventLeads) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingEventLeads object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingEventLeadsPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingEventLeads Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingEventLeadsPeer::$instances[$key])) {
                return LeasingEventLeadsPeer::$instances[$key];
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
        foreach (LeasingEventLeadsPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingEventLeadsPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to event_leads
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
        $cls = LeasingEventLeadsPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingEventLeadsPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingEventLeadsPeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingEventLeads object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingEventLeadsPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingEventLeadsPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingEventLeadsPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingCountry table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingCountry(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventLeadsPeer::COUNTRY_ID, LeasingCountryPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingNationality table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLeasingNationality(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventLeadsPeer::NATIONALITY_ID, LeasingNationalityPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingEventLeads objects pre-filled with their LeasingCountry objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventLeads objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingCountry(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);
        }

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol = LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;
        LeasingCountryPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingEventLeadsPeer::COUNTRY_ID, LeasingCountryPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventLeadsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingEventLeadsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventLeadsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingCountryPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingCountryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingCountryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingCountryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingEventLeads) to $obj2 (LeasingCountry)
                $obj2->addLeasingEventLeads($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingEventLeads objects pre-filled with their LeasingNationality objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventLeads objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLeasingNationality(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);
        }

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol = LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;
        LeasingNationalityPeer::addSelectColumns($criteria);

        $criteria->addJoin(LeasingEventLeadsPeer::NATIONALITY_ID, LeasingNationalityPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventLeadsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = LeasingEventLeadsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventLeadsPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LeasingNationalityPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LeasingNationalityPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingNationalityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LeasingNationalityPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (LeasingEventLeads) to $obj2 (LeasingNationality)
                $obj2->addLeasingEventLeads($obj1);

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
        $criteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventLeadsPeer::COUNTRY_ID, LeasingCountryPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingEventLeadsPeer::NATIONALITY_ID, LeasingNationalityPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingEventLeads objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventLeads objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);
        }

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingCountryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingCountryPeer::NUM_HYDRATE_COLUMNS;

        LeasingNationalityPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + LeasingNationalityPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingEventLeadsPeer::COUNTRY_ID, LeasingCountryPeer::ID, $join_behavior);

        $criteria->addJoin(LeasingEventLeadsPeer::NATIONALITY_ID, LeasingNationalityPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventLeadsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingEventLeadsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventLeadsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined LeasingCountry rows

            $key2 = LeasingCountryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LeasingCountryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LeasingCountryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingCountryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (LeasingEventLeads) to the collection in $obj2 (LeasingCountry)
                $obj2->addLeasingEventLeads($obj1);
            } // if joined row not null

            // Add objects for joined LeasingNationality rows

            $key3 = LeasingNationalityPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = LeasingNationalityPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = LeasingNationalityPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    LeasingNationalityPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (LeasingEventLeads) to the collection in $obj3 (LeasingNationality)
                $obj3->addLeasingEventLeads($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related LeasingCountry table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingCountry(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventLeadsPeer::NATIONALITY_ID, LeasingNationalityPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related LeasingNationality table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptLeasingNationality(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingEventLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(LeasingEventLeadsPeer::COUNTRY_ID, LeasingCountryPeer::ID, $join_behavior);

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
     * Selects a collection of LeasingEventLeads objects pre-filled with all related objects except LeasingCountry.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventLeads objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingCountry(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);
        }

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingNationalityPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingNationalityPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingEventLeadsPeer::NATIONALITY_ID, LeasingNationalityPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventLeadsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingEventLeadsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventLeadsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingNationality rows

                $key2 = LeasingNationalityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingNationalityPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingNationalityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingNationalityPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingEventLeads) to the collection in $obj2 (LeasingNationality)
                $obj2->addLeasingEventLeads($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of LeasingEventLeads objects pre-filled with all related objects except LeasingNationality.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of LeasingEventLeads objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptLeasingNationality(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);
        }

        LeasingEventLeadsPeer::addSelectColumns($criteria);
        $startcol2 = LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS;

        LeasingCountryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LeasingCountryPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(LeasingEventLeadsPeer::COUNTRY_ID, LeasingCountryPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = LeasingEventLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = LeasingEventLeadsPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = LeasingEventLeadsPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                LeasingEventLeadsPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined LeasingCountry rows

                $key2 = LeasingCountryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = LeasingCountryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = LeasingCountryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LeasingCountryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (LeasingEventLeads) to the collection in $obj2 (LeasingCountry)
                $obj2->addLeasingEventLeads($obj1);

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
        return Propel::getDatabaseMap(LeasingEventLeadsPeer::DATABASE_NAME)->getTable(LeasingEventLeadsPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingEventLeadsPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingEventLeadsPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingEventLeadsTableMap());
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
        return LeasingEventLeadsPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingEventLeads or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingEventLeads object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingEventLeads object
        }

        if ($criteria->containsKey(LeasingEventLeadsPeer::ID) && $criteria->keyContainsValue(LeasingEventLeadsPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingEventLeadsPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingEventLeads or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingEventLeads object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingEventLeadsPeer::ID);
            $value = $criteria->remove(LeasingEventLeadsPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingEventLeadsPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingEventLeadsPeer::TABLE_NAME);
            }

        } else { // $values is LeasingEventLeads object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the event_leads table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingEventLeadsPeer::TABLE_NAME, $con, LeasingEventLeadsPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingEventLeadsPeer::clearInstancePool();
            LeasingEventLeadsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingEventLeads or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingEventLeads object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingEventLeadsPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingEventLeads) { // it's a model object
            // invalidate the cache for this single object
            LeasingEventLeadsPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingEventLeadsPeer::DATABASE_NAME);
            $criteria->add(LeasingEventLeadsPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingEventLeadsPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingEventLeadsPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingEventLeadsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingEventLeads object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingEventLeads $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingEventLeadsPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingEventLeadsPeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingEventLeadsPeer::DATABASE_NAME, LeasingEventLeadsPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingEventLeads
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingEventLeadsPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingEventLeadsPeer::DATABASE_NAME);
        $criteria->add(LeasingEventLeadsPeer::ID, $pk);

        $v = LeasingEventLeadsPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingEventLeads[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingEventLeadsPeer::DATABASE_NAME);
            $criteria->add(LeasingEventLeadsPeer::ID, $pks, Criteria::IN);
            $objs = LeasingEventLeadsPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingEventLeadsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingEventLeadsPeer::buildTableMap();

