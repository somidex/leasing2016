<?php

namespace Leasing\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingParkingLeadsPeer;
use Leasing\CoreBundle\Model\map\LeasingParkingLeadsTableMap;

abstract class BaseLeasingParkingLeadsPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'parking_leads';

    /** the related Propel class for this table */
    const OM_CLASS = 'Leasing\\CoreBundle\\Model\\LeasingParkingLeads';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Leasing\\CoreBundle\\Model\\map\\LeasingParkingLeadsTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 32;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 32;

    /** the column name for the id field */
    const ID = 'parking_leads.id';

    /** the column name for the application_number field */
    const APPLICATION_NUMBER = 'parking_leads.application_number';

    /** the column name for the salutation field */
    const SALUTATION = 'parking_leads.salutation';

    /** the column name for the fname field */
    const FNAME = 'parking_leads.fname';

    /** the column name for the lname field */
    const LNAME = 'parking_leads.lname';

    /** the column name for the gender field */
    const GENDER = 'parking_leads.gender';

    /** the column name for the age field */
    const AGE = 'parking_leads.age';

    /** the column name for the birthday field */
    const BIRTHDAY = 'parking_leads.birthday';

    /** the column name for the email field */
    const EMAIL = 'parking_leads.email';

    /** the column name for the mobile field */
    const MOBILE = 'parking_leads.mobile';

    /** the column name for the property field */
    const PROPERTY = 'parking_leads.property';

    /** the column name for the unit field */
    const UNIT = 'parking_leads.unit';

    /** the column name for the slots field */
    const SLOTS = 'parking_leads.slots';

    /** the column name for the ps_number field */
    const PS_NUMBER = 'parking_leads.ps_number';

    /** the column name for the first_heard field */
    const FIRST_HEARD = 'parking_leads.first_heard';

    /** the column name for the payment_terms field */
    const PAYMENT_TERMS = 'parking_leads.payment_terms';

    /** the column name for the payment_type field */
    const PAYMENT_TYPE = 'parking_leads.payment_type';

    /** the column name for the date_added field */
    const DATE_ADDED = 'parking_leads.date_added';

    /** the column name for the date_approved field */
    const DATE_APPROVED = 'parking_leads.date_approved';

    /** the column name for the date_enrolled field */
    const DATE_ENROLLED = 'parking_leads.date_enrolled';

    /** the column name for the date_expiry field */
    const DATE_EXPIRY = 'parking_leads.date_expiry';

    /** the column name for the date_renewal field */
    const DATE_RENEWAL = 'parking_leads.date_renewal';

    /** the column name for the status field */
    const STATUS = 'parking_leads.status';

    /** the column name for the prev_status field */
    const PREV_STATUS = 'parking_leads.prev_status';

    /** the column name for the client_ip field */
    const CLIENT_IP = 'parking_leads.client_ip';

    /** the column name for the client_id field */
    const CLIENT_ID = 'parking_leads.client_id';

    /** the column name for the campaign field */
    const CAMPAIGN = 'parking_leads.campaign';

    /** the column name for the medium field */
    const MEDIUM = 'parking_leads.medium';

    /** the column name for the source field */
    const SOURCE = 'parking_leads.source';

    /** the column name for the gacountry field */
    const GACOUNTRY = 'parking_leads.gacountry';

    /** the column name for the processing field */
    const PROCESSING = 'parking_leads.processing';

    /** the column name for the processed_by field */
    const PROCESSED_BY = 'parking_leads.processed_by';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of LeasingParkingLeads objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array LeasingParkingLeads[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. LeasingParkingLeadsPeer::$fieldNames[LeasingParkingLeadsPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationNumber', 'Salutation', 'Fname', 'Lname', 'Gender', 'Age', 'Birthday', 'Email', 'Mobile', 'Property', 'Unit', 'Slots', 'PsNumber', 'FirstHeard', 'PaymentTerms', 'PaymentType', 'DateAdded', 'DateApproved', 'DateEnrolled', 'DateExpiry', 'DateRenewal', 'Status', 'PrevStatus', 'ClientIp', 'ClientId', 'Campaign', 'Medium', 'Source', 'Gacountry', 'Processing', 'ProcessedBy', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'applicationNumber', 'salutation', 'fname', 'lname', 'gender', 'age', 'birthday', 'email', 'mobile', 'property', 'unit', 'slots', 'psNumber', 'firstHeard', 'paymentTerms', 'paymentType', 'dateAdded', 'dateApproved', 'dateEnrolled', 'dateExpiry', 'dateRenewal', 'status', 'prevStatus', 'clientIp', 'clientId', 'campaign', 'medium', 'source', 'gacountry', 'processing', 'processedBy', ),
        BasePeer::TYPE_COLNAME => array (LeasingParkingLeadsPeer::ID, LeasingParkingLeadsPeer::APPLICATION_NUMBER, LeasingParkingLeadsPeer::SALUTATION, LeasingParkingLeadsPeer::FNAME, LeasingParkingLeadsPeer::LNAME, LeasingParkingLeadsPeer::GENDER, LeasingParkingLeadsPeer::AGE, LeasingParkingLeadsPeer::BIRTHDAY, LeasingParkingLeadsPeer::EMAIL, LeasingParkingLeadsPeer::MOBILE, LeasingParkingLeadsPeer::PROPERTY, LeasingParkingLeadsPeer::UNIT, LeasingParkingLeadsPeer::SLOTS, LeasingParkingLeadsPeer::PS_NUMBER, LeasingParkingLeadsPeer::FIRST_HEARD, LeasingParkingLeadsPeer::PAYMENT_TERMS, LeasingParkingLeadsPeer::PAYMENT_TYPE, LeasingParkingLeadsPeer::DATE_ADDED, LeasingParkingLeadsPeer::DATE_APPROVED, LeasingParkingLeadsPeer::DATE_ENROLLED, LeasingParkingLeadsPeer::DATE_EXPIRY, LeasingParkingLeadsPeer::DATE_RENEWAL, LeasingParkingLeadsPeer::STATUS, LeasingParkingLeadsPeer::PREV_STATUS, LeasingParkingLeadsPeer::CLIENT_IP, LeasingParkingLeadsPeer::CLIENT_ID, LeasingParkingLeadsPeer::CAMPAIGN, LeasingParkingLeadsPeer::MEDIUM, LeasingParkingLeadsPeer::SOURCE, LeasingParkingLeadsPeer::GACOUNTRY, LeasingParkingLeadsPeer::PROCESSING, LeasingParkingLeadsPeer::PROCESSED_BY, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'APPLICATION_NUMBER', 'SALUTATION', 'FNAME', 'LNAME', 'GENDER', 'AGE', 'BIRTHDAY', 'EMAIL', 'MOBILE', 'PROPERTY', 'UNIT', 'SLOTS', 'PS_NUMBER', 'FIRST_HEARD', 'PAYMENT_TERMS', 'PAYMENT_TYPE', 'DATE_ADDED', 'DATE_APPROVED', 'DATE_ENROLLED', 'DATE_EXPIRY', 'DATE_RENEWAL', 'STATUS', 'PREV_STATUS', 'CLIENT_IP', 'CLIENT_ID', 'CAMPAIGN', 'MEDIUM', 'SOURCE', 'GACOUNTRY', 'PROCESSING', 'PROCESSED_BY', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'application_number', 'salutation', 'fname', 'lname', 'gender', 'age', 'birthday', 'email', 'mobile', 'property', 'unit', 'slots', 'ps_number', 'first_heard', 'payment_terms', 'payment_type', 'date_added', 'date_approved', 'date_enrolled', 'date_expiry', 'date_renewal', 'status', 'prev_status', 'client_ip', 'client_id', 'campaign', 'medium', 'source', 'gacountry', 'processing', 'processed_by', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. LeasingParkingLeadsPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationNumber' => 1, 'Salutation' => 2, 'Fname' => 3, 'Lname' => 4, 'Gender' => 5, 'Age' => 6, 'Birthday' => 7, 'Email' => 8, 'Mobile' => 9, 'Property' => 10, 'Unit' => 11, 'Slots' => 12, 'PsNumber' => 13, 'FirstHeard' => 14, 'PaymentTerms' => 15, 'PaymentType' => 16, 'DateAdded' => 17, 'DateApproved' => 18, 'DateEnrolled' => 19, 'DateExpiry' => 20, 'DateRenewal' => 21, 'Status' => 22, 'PrevStatus' => 23, 'ClientIp' => 24, 'ClientId' => 25, 'Campaign' => 26, 'Medium' => 27, 'Source' => 28, 'Gacountry' => 29, 'Processing' => 30, 'ProcessedBy' => 31, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'applicationNumber' => 1, 'salutation' => 2, 'fname' => 3, 'lname' => 4, 'gender' => 5, 'age' => 6, 'birthday' => 7, 'email' => 8, 'mobile' => 9, 'property' => 10, 'unit' => 11, 'slots' => 12, 'psNumber' => 13, 'firstHeard' => 14, 'paymentTerms' => 15, 'paymentType' => 16, 'dateAdded' => 17, 'dateApproved' => 18, 'dateEnrolled' => 19, 'dateExpiry' => 20, 'dateRenewal' => 21, 'status' => 22, 'prevStatus' => 23, 'clientIp' => 24, 'clientId' => 25, 'campaign' => 26, 'medium' => 27, 'source' => 28, 'gacountry' => 29, 'processing' => 30, 'processedBy' => 31, ),
        BasePeer::TYPE_COLNAME => array (LeasingParkingLeadsPeer::ID => 0, LeasingParkingLeadsPeer::APPLICATION_NUMBER => 1, LeasingParkingLeadsPeer::SALUTATION => 2, LeasingParkingLeadsPeer::FNAME => 3, LeasingParkingLeadsPeer::LNAME => 4, LeasingParkingLeadsPeer::GENDER => 5, LeasingParkingLeadsPeer::AGE => 6, LeasingParkingLeadsPeer::BIRTHDAY => 7, LeasingParkingLeadsPeer::EMAIL => 8, LeasingParkingLeadsPeer::MOBILE => 9, LeasingParkingLeadsPeer::PROPERTY => 10, LeasingParkingLeadsPeer::UNIT => 11, LeasingParkingLeadsPeer::SLOTS => 12, LeasingParkingLeadsPeer::PS_NUMBER => 13, LeasingParkingLeadsPeer::FIRST_HEARD => 14, LeasingParkingLeadsPeer::PAYMENT_TERMS => 15, LeasingParkingLeadsPeer::PAYMENT_TYPE => 16, LeasingParkingLeadsPeer::DATE_ADDED => 17, LeasingParkingLeadsPeer::DATE_APPROVED => 18, LeasingParkingLeadsPeer::DATE_ENROLLED => 19, LeasingParkingLeadsPeer::DATE_EXPIRY => 20, LeasingParkingLeadsPeer::DATE_RENEWAL => 21, LeasingParkingLeadsPeer::STATUS => 22, LeasingParkingLeadsPeer::PREV_STATUS => 23, LeasingParkingLeadsPeer::CLIENT_IP => 24, LeasingParkingLeadsPeer::CLIENT_ID => 25, LeasingParkingLeadsPeer::CAMPAIGN => 26, LeasingParkingLeadsPeer::MEDIUM => 27, LeasingParkingLeadsPeer::SOURCE => 28, LeasingParkingLeadsPeer::GACOUNTRY => 29, LeasingParkingLeadsPeer::PROCESSING => 30, LeasingParkingLeadsPeer::PROCESSED_BY => 31, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'APPLICATION_NUMBER' => 1, 'SALUTATION' => 2, 'FNAME' => 3, 'LNAME' => 4, 'GENDER' => 5, 'AGE' => 6, 'BIRTHDAY' => 7, 'EMAIL' => 8, 'MOBILE' => 9, 'PROPERTY' => 10, 'UNIT' => 11, 'SLOTS' => 12, 'PS_NUMBER' => 13, 'FIRST_HEARD' => 14, 'PAYMENT_TERMS' => 15, 'PAYMENT_TYPE' => 16, 'DATE_ADDED' => 17, 'DATE_APPROVED' => 18, 'DATE_ENROLLED' => 19, 'DATE_EXPIRY' => 20, 'DATE_RENEWAL' => 21, 'STATUS' => 22, 'PREV_STATUS' => 23, 'CLIENT_IP' => 24, 'CLIENT_ID' => 25, 'CAMPAIGN' => 26, 'MEDIUM' => 27, 'SOURCE' => 28, 'GACOUNTRY' => 29, 'PROCESSING' => 30, 'PROCESSED_BY' => 31, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_number' => 1, 'salutation' => 2, 'fname' => 3, 'lname' => 4, 'gender' => 5, 'age' => 6, 'birthday' => 7, 'email' => 8, 'mobile' => 9, 'property' => 10, 'unit' => 11, 'slots' => 12, 'ps_number' => 13, 'first_heard' => 14, 'payment_terms' => 15, 'payment_type' => 16, 'date_added' => 17, 'date_approved' => 18, 'date_enrolled' => 19, 'date_expiry' => 20, 'date_renewal' => 21, 'status' => 22, 'prev_status' => 23, 'client_ip' => 24, 'client_id' => 25, 'campaign' => 26, 'medium' => 27, 'source' => 28, 'gacountry' => 29, 'processing' => 30, 'processed_by' => 31, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
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
        $toNames = LeasingParkingLeadsPeer::getFieldNames($toType);
        $key = isset(LeasingParkingLeadsPeer::$fieldKeys[$fromType][$name]) ? LeasingParkingLeadsPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(LeasingParkingLeadsPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, LeasingParkingLeadsPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return LeasingParkingLeadsPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. LeasingParkingLeadsPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(LeasingParkingLeadsPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::ID);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::APPLICATION_NUMBER);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::SALUTATION);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::FNAME);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::LNAME);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::GENDER);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::AGE);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::BIRTHDAY);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::EMAIL);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::MOBILE);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PROPERTY);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::UNIT);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::SLOTS);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PS_NUMBER);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::FIRST_HEARD);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PAYMENT_TERMS);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PAYMENT_TYPE);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::DATE_ADDED);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::DATE_APPROVED);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::DATE_ENROLLED);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::DATE_EXPIRY);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::DATE_RENEWAL);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::STATUS);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PREV_STATUS);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::CLIENT_IP);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::CLIENT_ID);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::CAMPAIGN);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::MEDIUM);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::SOURCE);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::GACOUNTRY);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PROCESSING);
            $criteria->addSelectColumn(LeasingParkingLeadsPeer::PROCESSED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.application_number');
            $criteria->addSelectColumn($alias . '.salutation');
            $criteria->addSelectColumn($alias . '.fname');
            $criteria->addSelectColumn($alias . '.lname');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.age');
            $criteria->addSelectColumn($alias . '.birthday');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.property');
            $criteria->addSelectColumn($alias . '.unit');
            $criteria->addSelectColumn($alias . '.slots');
            $criteria->addSelectColumn($alias . '.ps_number');
            $criteria->addSelectColumn($alias . '.first_heard');
            $criteria->addSelectColumn($alias . '.payment_terms');
            $criteria->addSelectColumn($alias . '.payment_type');
            $criteria->addSelectColumn($alias . '.date_added');
            $criteria->addSelectColumn($alias . '.date_approved');
            $criteria->addSelectColumn($alias . '.date_enrolled');
            $criteria->addSelectColumn($alias . '.date_expiry');
            $criteria->addSelectColumn($alias . '.date_renewal');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.prev_status');
            $criteria->addSelectColumn($alias . '.client_ip');
            $criteria->addSelectColumn($alias . '.client_id');
            $criteria->addSelectColumn($alias . '.campaign');
            $criteria->addSelectColumn($alias . '.medium');
            $criteria->addSelectColumn($alias . '.source');
            $criteria->addSelectColumn($alias . '.gacountry');
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
        $criteria->setPrimaryTableName(LeasingParkingLeadsPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            LeasingParkingLeadsPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(LeasingParkingLeadsPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return LeasingParkingLeads
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = LeasingParkingLeadsPeer::doSelect($critcopy, $con);
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
        return LeasingParkingLeadsPeer::populateObjects(LeasingParkingLeadsPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            LeasingParkingLeadsPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingParkingLeadsPeer::DATABASE_NAME);

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
     * @param LeasingParkingLeads $obj A LeasingParkingLeads object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            LeasingParkingLeadsPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A LeasingParkingLeads object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof LeasingParkingLeads) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LeasingParkingLeads object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(LeasingParkingLeadsPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return LeasingParkingLeads Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(LeasingParkingLeadsPeer::$instances[$key])) {
                return LeasingParkingLeadsPeer::$instances[$key];
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
        foreach (LeasingParkingLeadsPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        LeasingParkingLeadsPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to parking_leads
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
        $cls = LeasingParkingLeadsPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = LeasingParkingLeadsPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = LeasingParkingLeadsPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeasingParkingLeadsPeer::addInstanceToPool($obj, $key);
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
     * @return array (LeasingParkingLeads object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = LeasingParkingLeadsPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = LeasingParkingLeadsPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + LeasingParkingLeadsPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeasingParkingLeadsPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            LeasingParkingLeadsPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        return Propel::getDatabaseMap(LeasingParkingLeadsPeer::DATABASE_NAME)->getTable(LeasingParkingLeadsPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseLeasingParkingLeadsPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseLeasingParkingLeadsPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Leasing\CoreBundle\Model\map\LeasingParkingLeadsTableMap());
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
        return LeasingParkingLeadsPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a LeasingParkingLeads or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingParkingLeads object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from LeasingParkingLeads object
        }

        if ($criteria->containsKey(LeasingParkingLeadsPeer::ID) && $criteria->keyContainsValue(LeasingParkingLeadsPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeasingParkingLeadsPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(LeasingParkingLeadsPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a LeasingParkingLeads or Criteria object.
     *
     * @param      mixed $values Criteria or LeasingParkingLeads object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(LeasingParkingLeadsPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(LeasingParkingLeadsPeer::ID);
            $value = $criteria->remove(LeasingParkingLeadsPeer::ID);
            if ($value) {
                $selectCriteria->add(LeasingParkingLeadsPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(LeasingParkingLeadsPeer::TABLE_NAME);
            }

        } else { // $values is LeasingParkingLeads object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(LeasingParkingLeadsPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the parking_leads table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(LeasingParkingLeadsPeer::TABLE_NAME, $con, LeasingParkingLeadsPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeasingParkingLeadsPeer::clearInstancePool();
            LeasingParkingLeadsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a LeasingParkingLeads or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or LeasingParkingLeads object or primary key or array of primary keys
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
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            LeasingParkingLeadsPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof LeasingParkingLeads) { // it's a model object
            // invalidate the cache for this single object
            LeasingParkingLeadsPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeasingParkingLeadsPeer::DATABASE_NAME);
            $criteria->add(LeasingParkingLeadsPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                LeasingParkingLeadsPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(LeasingParkingLeadsPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            LeasingParkingLeadsPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given LeasingParkingLeads object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param LeasingParkingLeads $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(LeasingParkingLeadsPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(LeasingParkingLeadsPeer::TABLE_NAME);

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

        return BasePeer::doValidate(LeasingParkingLeadsPeer::DATABASE_NAME, LeasingParkingLeadsPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return LeasingParkingLeads
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = LeasingParkingLeadsPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(LeasingParkingLeadsPeer::DATABASE_NAME);
        $criteria->add(LeasingParkingLeadsPeer::ID, $pk);

        $v = LeasingParkingLeadsPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return LeasingParkingLeads[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(LeasingParkingLeadsPeer::DATABASE_NAME);
            $criteria->add(LeasingParkingLeadsPeer::ID, $pks, Criteria::IN);
            $objs = LeasingParkingLeadsPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseLeasingParkingLeadsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseLeasingParkingLeadsPeer::buildTableMap();

