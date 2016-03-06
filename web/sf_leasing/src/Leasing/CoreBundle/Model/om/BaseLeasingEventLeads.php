<?php

namespace Leasing\CoreBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingCountry;
use Leasing\CoreBundle\Model\LeasingCountryQuery;
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventBookingsQuery;
use Leasing\CoreBundle\Model\LeasingEventInquiries;
use Leasing\CoreBundle\Model\LeasingEventInquiriesQuery;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventLeadsPeer;
use Leasing\CoreBundle\Model\LeasingEventLeadsQuery;
use Leasing\CoreBundle\Model\LeasingNationality;
use Leasing\CoreBundle\Model\LeasingNationalityQuery;

abstract class BaseLeasingEventLeads extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingEventLeadsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingEventLeadsPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the fname field.
     * @var        string
     */
    protected $fname;

    /**
     * The value for the lname field.
     * @var        string
     */
    protected $lname;

    /**
     * The value for the birthdate field.
     * @var        string
     */
    protected $birthdate;

    /**
     * The value for the age field.
     * @var        int
     */
    protected $age;

    /**
     * The value for the gender field.
     * @var        string
     */
    protected $gender;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the mobile field.
     * @var        string
     */
    protected $mobile;

    /**
     * The value for the country_id field.
     * @var        int
     */
    protected $country_id;

    /**
     * The value for the nationality_id field.
     * @var        int
     */
    protected $nationality_id;

    /**
     * The value for the event_lead_type field.
     * @var        int
     */
    protected $event_lead_type;

    /**
     * The value for the client_ip field.
     * @var        string
     */
    protected $client_ip;

    /**
     * The value for the client_id field.
     * @var        string
     */
    protected $client_id;

    /**
     * The value for the campaign field.
     * @var        string
     */
    protected $campaign;

    /**
     * The value for the medium field.
     * @var        string
     */
    protected $medium;

    /**
     * The value for the source field.
     * @var        string
     */
    protected $source;

    /**
     * The value for the gacountry field.
     * @var        string
     */
    protected $gacountry;

    /**
     * @var        LeasingCountry
     */
    protected $aLeasingCountry;

    /**
     * @var        LeasingNationality
     */
    protected $aLeasingNationality;

    /**
     * @var        PropelObjectCollection|LeasingEventBookings[] Collection to store aggregation of LeasingEventBookings objects.
     */
    protected $collLeasingEventBookingss;
    protected $collLeasingEventBookingssPartial;

    /**
     * @var        PropelObjectCollection|LeasingEventInquiries[] Collection to store aggregation of LeasingEventInquiries objects.
     */
    protected $collLeasingEventInquiriess;
    protected $collLeasingEventInquiriessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingEventBookingssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingEventInquiriessScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [fname] column value.
     *
     * @return string
     */
    public function getFname()
    {

        return $this->fname;
    }

    /**
     * Get the [lname] column value.
     *
     * @return string
     */
    public function getLname()
    {

        return $this->lname;
    }

    /**
     * Get the [birthdate] column value.
     *
     * @return string
     */
    public function getBirthdate()
    {

        return $this->birthdate;
    }

    /**
     * Get the [age] column value.
     *
     * @return int
     */
    public function getAge()
    {

        return $this->age;
    }

    /**
     * Get the [gender] column value.
     *
     * @return string
     */
    public function getGender()
    {

        return $this->gender;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {

        return $this->email;
    }

    /**
     * Get the [mobile] column value.
     *
     * @return string
     */
    public function getMobile()
    {

        return $this->mobile;
    }

    /**
     * Get the [country_id] column value.
     *
     * @return int
     */
    public function getCountryId()
    {

        return $this->country_id;
    }

    /**
     * Get the [nationality_id] column value.
     *
     * @return int
     */
    public function getNationalityId()
    {

        return $this->nationality_id;
    }

    /**
     * Get the [event_lead_type] column value.
     *
     * @return int
     */
    public function getEventLeadType()
    {

        return $this->event_lead_type;
    }

    /**
     * Get the [client_ip] column value.
     *
     * @return string
     */
    public function getClientIp()
    {

        return $this->client_ip;
    }

    /**
     * Get the [client_id] column value.
     *
     * @return string
     */
    public function getClientId()
    {

        return $this->client_id;
    }

    /**
     * Get the [campaign] column value.
     *
     * @return string
     */
    public function getCampaign()
    {

        return $this->campaign;
    }

    /**
     * Get the [medium] column value.
     *
     * @return string
     */
    public function getMedium()
    {

        return $this->medium;
    }

    /**
     * Get the [source] column value.
     *
     * @return string
     */
    public function getSource()
    {

        return $this->source;
    }

    /**
     * Get the [gacountry] column value.
     *
     * @return string
     */
    public function getGacountry()
    {

        return $this->gacountry;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fname] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setFname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fname !== $v) {
            $this->fname = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::FNAME;
        }


        return $this;
    } // setFname()

    /**
     * Set the value of [lname] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setLname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lname !== $v) {
            $this->lname = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::LNAME;
        }


        return $this;
    } // setLname()

    /**
     * Set the value of [birthdate] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setBirthdate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->birthdate !== $v) {
            $this->birthdate = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::BIRTHDATE;
        }


        return $this;
    } // setBirthdate()

    /**
     * Set the value of [age] column.
     *
     * @param  int $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setAge($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->age !== $v) {
            $this->age = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::AGE;
        }


        return $this;
    } // setAge()

    /**
     * Set the value of [gender] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::GENDER;
        }


        return $this;
    } // setGender()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [mobile] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::MOBILE;
        }


        return $this;
    } // setMobile()

    /**
     * Set the value of [country_id] column.
     *
     * @param  int $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setCountryId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->country_id !== $v) {
            $this->country_id = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::COUNTRY_ID;
        }

        if ($this->aLeasingCountry !== null && $this->aLeasingCountry->getId() !== $v) {
            $this->aLeasingCountry = null;
        }


        return $this;
    } // setCountryId()

    /**
     * Set the value of [nationality_id] column.
     *
     * @param  int $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setNationalityId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->nationality_id !== $v) {
            $this->nationality_id = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::NATIONALITY_ID;
        }

        if ($this->aLeasingNationality !== null && $this->aLeasingNationality->getId() !== $v) {
            $this->aLeasingNationality = null;
        }


        return $this;
    } // setNationalityId()

    /**
     * Set the value of [event_lead_type] column.
     *
     * @param  int $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setEventLeadType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->event_lead_type !== $v) {
            $this->event_lead_type = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::EVENT_LEAD_TYPE;
        }


        return $this;
    } // setEventLeadType()

    /**
     * Set the value of [client_ip] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setClientIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_ip !== $v) {
            $this->client_ip = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::CLIENT_IP;
        }


        return $this;
    } // setClientIp()

    /**
     * Set the value of [client_id] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setClientId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_id !== $v) {
            $this->client_id = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::CLIENT_ID;
        }


        return $this;
    } // setClientId()

    /**
     * Set the value of [campaign] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setCampaign($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campaign !== $v) {
            $this->campaign = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::CAMPAIGN;
        }


        return $this;
    } // setCampaign()

    /**
     * Set the value of [medium] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setMedium($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->medium !== $v) {
            $this->medium = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::MEDIUM;
        }


        return $this;
    } // setMedium()

    /**
     * Set the value of [source] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setSource($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->source !== $v) {
            $this->source = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::SOURCE;
        }


        return $this;
    } // setSource()

    /**
     * Set the value of [gacountry] column.
     *
     * @param  string $v new value
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setGacountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gacountry !== $v) {
            $this->gacountry = $v;
            $this->modifiedColumns[] = LeasingEventLeadsPeer::GACOUNTRY;
        }


        return $this;
    } // setGacountry()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fname = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->lname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->birthdate = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->age = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->gender = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->email = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->mobile = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->country_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->nationality_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->event_lead_type = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->client_ip = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->client_id = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->campaign = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->medium = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->source = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->gacountry = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 17; // 17 = LeasingEventLeadsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingEventLeads object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aLeasingCountry !== null && $this->country_id !== $this->aLeasingCountry->getId()) {
            $this->aLeasingCountry = null;
        }
        if ($this->aLeasingNationality !== null && $this->nationality_id !== $this->aLeasingNationality->getId()) {
            $this->aLeasingNationality = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingEventLeadsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingCountry = null;
            $this->aLeasingNationality = null;
            $this->collLeasingEventBookingss = null;

            $this->collLeasingEventInquiriess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingEventLeadsQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LeasingEventLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                LeasingEventLeadsPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLeasingCountry !== null) {
                if ($this->aLeasingCountry->isModified() || $this->aLeasingCountry->isNew()) {
                    $affectedRows += $this->aLeasingCountry->save($con);
                }
                $this->setLeasingCountry($this->aLeasingCountry);
            }

            if ($this->aLeasingNationality !== null) {
                if ($this->aLeasingNationality->isModified() || $this->aLeasingNationality->isNew()) {
                    $affectedRows += $this->aLeasingNationality->save($con);
                }
                $this->setLeasingNationality($this->aLeasingNationality);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->leasingEventBookingssScheduledForDeletion !== null) {
                if (!$this->leasingEventBookingssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingEventBookingssScheduledForDeletion as $leasingEventBookings) {
                        // need to save related object because we set the relation to null
                        $leasingEventBookings->save($con);
                    }
                    $this->leasingEventBookingssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingEventBookingss !== null) {
                foreach ($this->collLeasingEventBookingss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingEventInquiriessScheduledForDeletion !== null) {
                if (!$this->leasingEventInquiriessScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingEventInquiriessScheduledForDeletion as $leasingEventInquiries) {
                        // need to save related object because we set the relation to null
                        $leasingEventInquiries->save($con);
                    }
                    $this->leasingEventInquiriessScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingEventInquiriess !== null) {
                foreach ($this->collLeasingEventInquiriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = LeasingEventLeadsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingEventLeadsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingEventLeadsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::FNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fname`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::LNAME)) {
            $modifiedColumns[':p' . $index++]  = '`lname`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::BIRTHDATE)) {
            $modifiedColumns[':p' . $index++]  = '`birthdate`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::AGE)) {
            $modifiedColumns[':p' . $index++]  = '`age`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::GENDER)) {
            $modifiedColumns[':p' . $index++]  = '`gender`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::MOBILE)) {
            $modifiedColumns[':p' . $index++]  = '`mobile`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::COUNTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`country_id`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::NATIONALITY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`nationality_id`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::EVENT_LEAD_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`event_lead_type`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::CLIENT_IP)) {
            $modifiedColumns[':p' . $index++]  = '`client_ip`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::CLIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`client_id`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::CAMPAIGN)) {
            $modifiedColumns[':p' . $index++]  = '`campaign`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::MEDIUM)) {
            $modifiedColumns[':p' . $index++]  = '`medium`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::SOURCE)) {
            $modifiedColumns[':p' . $index++]  = '`source`';
        }
        if ($this->isColumnModified(LeasingEventLeadsPeer::GACOUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`gacountry`';
        }

        $sql = sprintf(
            'INSERT INTO `event_leads` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`fname`':
                        $stmt->bindValue($identifier, $this->fname, PDO::PARAM_STR);
                        break;
                    case '`lname`':
                        $stmt->bindValue($identifier, $this->lname, PDO::PARAM_STR);
                        break;
                    case '`birthdate`':
                        $stmt->bindValue($identifier, $this->birthdate, PDO::PARAM_STR);
                        break;
                    case '`age`':
                        $stmt->bindValue($identifier, $this->age, PDO::PARAM_INT);
                        break;
                    case '`gender`':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`mobile`':
                        $stmt->bindValue($identifier, $this->mobile, PDO::PARAM_STR);
                        break;
                    case '`country_id`':
                        $stmt->bindValue($identifier, $this->country_id, PDO::PARAM_INT);
                        break;
                    case '`nationality_id`':
                        $stmt->bindValue($identifier, $this->nationality_id, PDO::PARAM_INT);
                        break;
                    case '`event_lead_type`':
                        $stmt->bindValue($identifier, $this->event_lead_type, PDO::PARAM_INT);
                        break;
                    case '`client_ip`':
                        $stmt->bindValue($identifier, $this->client_ip, PDO::PARAM_STR);
                        break;
                    case '`client_id`':
                        $stmt->bindValue($identifier, $this->client_id, PDO::PARAM_STR);
                        break;
                    case '`campaign`':
                        $stmt->bindValue($identifier, $this->campaign, PDO::PARAM_STR);
                        break;
                    case '`medium`':
                        $stmt->bindValue($identifier, $this->medium, PDO::PARAM_STR);
                        break;
                    case '`source`':
                        $stmt->bindValue($identifier, $this->source, PDO::PARAM_STR);
                        break;
                    case '`gacountry`':
                        $stmt->bindValue($identifier, $this->gacountry, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLeasingCountry !== null) {
                if (!$this->aLeasingCountry->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingCountry->getValidationFailures());
                }
            }

            if ($this->aLeasingNationality !== null) {
                if (!$this->aLeasingNationality->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingNationality->getValidationFailures());
                }
            }


            if (($retval = LeasingEventLeadsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingEventBookingss !== null) {
                    foreach ($this->collLeasingEventBookingss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingEventInquiriess !== null) {
                    foreach ($this->collLeasingEventInquiriess as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LeasingEventLeadsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getFname();
                break;
            case 2:
                return $this->getLname();
                break;
            case 3:
                return $this->getBirthdate();
                break;
            case 4:
                return $this->getAge();
                break;
            case 5:
                return $this->getGender();
                break;
            case 6:
                return $this->getEmail();
                break;
            case 7:
                return $this->getMobile();
                break;
            case 8:
                return $this->getCountryId();
                break;
            case 9:
                return $this->getNationalityId();
                break;
            case 10:
                return $this->getEventLeadType();
                break;
            case 11:
                return $this->getClientIp();
                break;
            case 12:
                return $this->getClientId();
                break;
            case 13:
                return $this->getCampaign();
                break;
            case 14:
                return $this->getMedium();
                break;
            case 15:
                return $this->getSource();
                break;
            case 16:
                return $this->getGacountry();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['LeasingEventLeads'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingEventLeads'][$this->getPrimaryKey()] = true;
        $keys = LeasingEventLeadsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFname(),
            $keys[2] => $this->getLname(),
            $keys[3] => $this->getBirthdate(),
            $keys[4] => $this->getAge(),
            $keys[5] => $this->getGender(),
            $keys[6] => $this->getEmail(),
            $keys[7] => $this->getMobile(),
            $keys[8] => $this->getCountryId(),
            $keys[9] => $this->getNationalityId(),
            $keys[10] => $this->getEventLeadType(),
            $keys[11] => $this->getClientIp(),
            $keys[12] => $this->getClientId(),
            $keys[13] => $this->getCampaign(),
            $keys[14] => $this->getMedium(),
            $keys[15] => $this->getSource(),
            $keys[16] => $this->getGacountry(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingCountry) {
                $result['LeasingCountry'] = $this->aLeasingCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingNationality) {
                $result['LeasingNationality'] = $this->aLeasingNationality->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLeasingEventBookingss) {
                $result['LeasingEventBookingss'] = $this->collLeasingEventBookingss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingEventInquiriess) {
                $result['LeasingEventInquiriess'] = $this->collLeasingEventInquiriess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LeasingEventLeadsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setFname($value);
                break;
            case 2:
                $this->setLname($value);
                break;
            case 3:
                $this->setBirthdate($value);
                break;
            case 4:
                $this->setAge($value);
                break;
            case 5:
                $this->setGender($value);
                break;
            case 6:
                $this->setEmail($value);
                break;
            case 7:
                $this->setMobile($value);
                break;
            case 8:
                $this->setCountryId($value);
                break;
            case 9:
                $this->setNationalityId($value);
                break;
            case 10:
                $this->setEventLeadType($value);
                break;
            case 11:
                $this->setClientIp($value);
                break;
            case 12:
                $this->setClientId($value);
                break;
            case 13:
                $this->setCampaign($value);
                break;
            case 14:
                $this->setMedium($value);
                break;
            case 15:
                $this->setSource($value);
                break;
            case 16:
                $this->setGacountry($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = LeasingEventLeadsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFname($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBirthdate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAge($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setGender($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEmail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setMobile($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCountryId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setNationalityId($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setEventLeadType($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setClientIp($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setClientId($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setCampaign($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setMedium($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setSource($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setGacountry($arr[$keys[16]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingEventLeadsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingEventLeadsPeer::ID)) $criteria->add(LeasingEventLeadsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingEventLeadsPeer::FNAME)) $criteria->add(LeasingEventLeadsPeer::FNAME, $this->fname);
        if ($this->isColumnModified(LeasingEventLeadsPeer::LNAME)) $criteria->add(LeasingEventLeadsPeer::LNAME, $this->lname);
        if ($this->isColumnModified(LeasingEventLeadsPeer::BIRTHDATE)) $criteria->add(LeasingEventLeadsPeer::BIRTHDATE, $this->birthdate);
        if ($this->isColumnModified(LeasingEventLeadsPeer::AGE)) $criteria->add(LeasingEventLeadsPeer::AGE, $this->age);
        if ($this->isColumnModified(LeasingEventLeadsPeer::GENDER)) $criteria->add(LeasingEventLeadsPeer::GENDER, $this->gender);
        if ($this->isColumnModified(LeasingEventLeadsPeer::EMAIL)) $criteria->add(LeasingEventLeadsPeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingEventLeadsPeer::MOBILE)) $criteria->add(LeasingEventLeadsPeer::MOBILE, $this->mobile);
        if ($this->isColumnModified(LeasingEventLeadsPeer::COUNTRY_ID)) $criteria->add(LeasingEventLeadsPeer::COUNTRY_ID, $this->country_id);
        if ($this->isColumnModified(LeasingEventLeadsPeer::NATIONALITY_ID)) $criteria->add(LeasingEventLeadsPeer::NATIONALITY_ID, $this->nationality_id);
        if ($this->isColumnModified(LeasingEventLeadsPeer::EVENT_LEAD_TYPE)) $criteria->add(LeasingEventLeadsPeer::EVENT_LEAD_TYPE, $this->event_lead_type);
        if ($this->isColumnModified(LeasingEventLeadsPeer::CLIENT_IP)) $criteria->add(LeasingEventLeadsPeer::CLIENT_IP, $this->client_ip);
        if ($this->isColumnModified(LeasingEventLeadsPeer::CLIENT_ID)) $criteria->add(LeasingEventLeadsPeer::CLIENT_ID, $this->client_id);
        if ($this->isColumnModified(LeasingEventLeadsPeer::CAMPAIGN)) $criteria->add(LeasingEventLeadsPeer::CAMPAIGN, $this->campaign);
        if ($this->isColumnModified(LeasingEventLeadsPeer::MEDIUM)) $criteria->add(LeasingEventLeadsPeer::MEDIUM, $this->medium);
        if ($this->isColumnModified(LeasingEventLeadsPeer::SOURCE)) $criteria->add(LeasingEventLeadsPeer::SOURCE, $this->source);
        if ($this->isColumnModified(LeasingEventLeadsPeer::GACOUNTRY)) $criteria->add(LeasingEventLeadsPeer::GACOUNTRY, $this->gacountry);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(LeasingEventLeadsPeer::DATABASE_NAME);
        $criteria->add(LeasingEventLeadsPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of LeasingEventLeads (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFname($this->getFname());
        $copyObj->setLname($this->getLname());
        $copyObj->setBirthdate($this->getBirthdate());
        $copyObj->setAge($this->getAge());
        $copyObj->setGender($this->getGender());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setCountryId($this->getCountryId());
        $copyObj->setNationalityId($this->getNationalityId());
        $copyObj->setEventLeadType($this->getEventLeadType());
        $copyObj->setClientIp($this->getClientIp());
        $copyObj->setClientId($this->getClientId());
        $copyObj->setCampaign($this->getCampaign());
        $copyObj->setMedium($this->getMedium());
        $copyObj->setSource($this->getSource());
        $copyObj->setGacountry($this->getGacountry());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingEventBookingss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingEventBookings($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingEventInquiriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingEventInquiries($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return LeasingEventLeads Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return LeasingEventLeadsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingEventLeadsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingCountry object.
     *
     * @param                  LeasingCountry $v
     * @return LeasingEventLeads The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingCountry(LeasingCountry $v = null)
    {
        if ($v === null) {
            $this->setCountryId(NULL);
        } else {
            $this->setCountryId($v->getId());
        }

        $this->aLeasingCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingEventLeads($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingCountry object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingCountry The associated LeasingCountry object.
     * @throws PropelException
     */
    public function getLeasingCountry(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingCountry === null && ($this->country_id !== null) && $doQuery) {
            $this->aLeasingCountry = LeasingCountryQuery::create()->findPk($this->country_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingCountry->addLeasingEventLeadss($this);
             */
        }

        return $this->aLeasingCountry;
    }

    /**
     * Declares an association between this object and a LeasingNationality object.
     *
     * @param                  LeasingNationality $v
     * @return LeasingEventLeads The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingNationality(LeasingNationality $v = null)
    {
        if ($v === null) {
            $this->setNationalityId(NULL);
        } else {
            $this->setNationalityId($v->getId());
        }

        $this->aLeasingNationality = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingNationality object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingEventLeads($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingNationality object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingNationality The associated LeasingNationality object.
     * @throws PropelException
     */
    public function getLeasingNationality(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingNationality === null && ($this->nationality_id !== null) && $doQuery) {
            $this->aLeasingNationality = LeasingNationalityQuery::create()->findPk($this->nationality_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingNationality->addLeasingEventLeadss($this);
             */
        }

        return $this->aLeasingNationality;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('LeasingEventBookings' == $relationName) {
            $this->initLeasingEventBookingss();
        }
        if ('LeasingEventInquiries' == $relationName) {
            $this->initLeasingEventInquiriess();
        }
    }

    /**
     * Clears out the collLeasingEventBookingss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingEventLeads The current object (for fluent API support)
     * @see        addLeasingEventBookingss()
     */
    public function clearLeasingEventBookingss()
    {
        $this->collLeasingEventBookingss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingEventBookingssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingEventBookingss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingEventBookingss($v = true)
    {
        $this->collLeasingEventBookingssPartial = $v;
    }

    /**
     * Initializes the collLeasingEventBookingss collection.
     *
     * By default this just sets the collLeasingEventBookingss collection to an empty array (like clearcollLeasingEventBookingss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingEventBookingss($overrideExisting = true)
    {
        if (null !== $this->collLeasingEventBookingss && !$overrideExisting) {
            return;
        }
        $this->collLeasingEventBookingss = new PropelObjectCollection();
        $this->collLeasingEventBookingss->setModel('LeasingEventBookings');
    }

    /**
     * Gets an array of LeasingEventBookings objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingEventLeads is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingEventBookings[] List of LeasingEventBookings objects
     * @throws PropelException
     */
    public function getLeasingEventBookingss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventBookingssPartial && !$this->isNew();
        if (null === $this->collLeasingEventBookingss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventBookingss) {
                // return empty collection
                $this->initLeasingEventBookingss();
            } else {
                $collLeasingEventBookingss = LeasingEventBookingsQuery::create(null, $criteria)
                    ->filterByLeasingEventLeads($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingEventBookingssPartial && count($collLeasingEventBookingss)) {
                      $this->initLeasingEventBookingss(false);

                      foreach ($collLeasingEventBookingss as $obj) {
                        if (false == $this->collLeasingEventBookingss->contains($obj)) {
                          $this->collLeasingEventBookingss->append($obj);
                        }
                      }

                      $this->collLeasingEventBookingssPartial = true;
                    }

                    $collLeasingEventBookingss->getInternalIterator()->rewind();

                    return $collLeasingEventBookingss;
                }

                if ($partial && $this->collLeasingEventBookingss) {
                    foreach ($this->collLeasingEventBookingss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingEventBookingss[] = $obj;
                        }
                    }
                }

                $this->collLeasingEventBookingss = $collLeasingEventBookingss;
                $this->collLeasingEventBookingssPartial = false;
            }
        }

        return $this->collLeasingEventBookingss;
    }

    /**
     * Sets a collection of LeasingEventBookings objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingEventBookingss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setLeasingEventBookingss(PropelCollection $leasingEventBookingss, PropelPDO $con = null)
    {
        $leasingEventBookingssToDelete = $this->getLeasingEventBookingss(new Criteria(), $con)->diff($leasingEventBookingss);


        $this->leasingEventBookingssScheduledForDeletion = $leasingEventBookingssToDelete;

        foreach ($leasingEventBookingssToDelete as $leasingEventBookingsRemoved) {
            $leasingEventBookingsRemoved->setLeasingEventLeads(null);
        }

        $this->collLeasingEventBookingss = null;
        foreach ($leasingEventBookingss as $leasingEventBookings) {
            $this->addLeasingEventBookings($leasingEventBookings);
        }

        $this->collLeasingEventBookingss = $leasingEventBookingss;
        $this->collLeasingEventBookingssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingEventBookings objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingEventBookings objects.
     * @throws PropelException
     */
    public function countLeasingEventBookingss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventBookingssPartial && !$this->isNew();
        if (null === $this->collLeasingEventBookingss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventBookingss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingEventBookingss());
            }
            $query = LeasingEventBookingsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingEventLeads($this)
                ->count($con);
        }

        return count($this->collLeasingEventBookingss);
    }

    /**
     * Method called to associate a LeasingEventBookings object to this object
     * through the LeasingEventBookings foreign key attribute.
     *
     * @param    LeasingEventBookings $l LeasingEventBookings
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function addLeasingEventBookings(LeasingEventBookings $l)
    {
        if ($this->collLeasingEventBookingss === null) {
            $this->initLeasingEventBookingss();
            $this->collLeasingEventBookingssPartial = true;
        }

        if (!in_array($l, $this->collLeasingEventBookingss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingEventBookings($l);

            if ($this->leasingEventBookingssScheduledForDeletion and $this->leasingEventBookingssScheduledForDeletion->contains($l)) {
                $this->leasingEventBookingssScheduledForDeletion->remove($this->leasingEventBookingssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingEventBookings $leasingEventBookings The leasingEventBookings object to add.
     */
    protected function doAddLeasingEventBookings($leasingEventBookings)
    {
        $this->collLeasingEventBookingss[]= $leasingEventBookings;
        $leasingEventBookings->setLeasingEventLeads($this);
    }

    /**
     * @param	LeasingEventBookings $leasingEventBookings The leasingEventBookings object to remove.
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function removeLeasingEventBookings($leasingEventBookings)
    {
        if ($this->getLeasingEventBookingss()->contains($leasingEventBookings)) {
            $this->collLeasingEventBookingss->remove($this->collLeasingEventBookingss->search($leasingEventBookings));
            if (null === $this->leasingEventBookingssScheduledForDeletion) {
                $this->leasingEventBookingssScheduledForDeletion = clone $this->collLeasingEventBookingss;
                $this->leasingEventBookingssScheduledForDeletion->clear();
            }
            $this->leasingEventBookingssScheduledForDeletion[]= $leasingEventBookings;
            $leasingEventBookings->setLeasingEventLeads(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingEventLeads is new, it will return
     * an empty collection; or if this LeasingEventLeads has previously
     * been saved, it will retrieve related LeasingEventBookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingEventLeads.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingEventBookings[] List of LeasingEventBookings objects
     */
    public function getLeasingEventBookingssJoinLeasingEventPlace($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingEventBookingsQuery::create(null, $criteria);
        $query->joinWith('LeasingEventPlace', $join_behavior);

        return $this->getLeasingEventBookingss($query, $con);
    }

    /**
     * Clears out the collLeasingEventInquiriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingEventLeads The current object (for fluent API support)
     * @see        addLeasingEventInquiriess()
     */
    public function clearLeasingEventInquiriess()
    {
        $this->collLeasingEventInquiriess = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingEventInquiriessPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingEventInquiriess collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingEventInquiriess($v = true)
    {
        $this->collLeasingEventInquiriessPartial = $v;
    }

    /**
     * Initializes the collLeasingEventInquiriess collection.
     *
     * By default this just sets the collLeasingEventInquiriess collection to an empty array (like clearcollLeasingEventInquiriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingEventInquiriess($overrideExisting = true)
    {
        if (null !== $this->collLeasingEventInquiriess && !$overrideExisting) {
            return;
        }
        $this->collLeasingEventInquiriess = new PropelObjectCollection();
        $this->collLeasingEventInquiriess->setModel('LeasingEventInquiries');
    }

    /**
     * Gets an array of LeasingEventInquiries objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingEventLeads is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingEventInquiries[] List of LeasingEventInquiries objects
     * @throws PropelException
     */
    public function getLeasingEventInquiriess($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventInquiriessPartial && !$this->isNew();
        if (null === $this->collLeasingEventInquiriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventInquiriess) {
                // return empty collection
                $this->initLeasingEventInquiriess();
            } else {
                $collLeasingEventInquiriess = LeasingEventInquiriesQuery::create(null, $criteria)
                    ->filterByLeasingEventLeads($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingEventInquiriessPartial && count($collLeasingEventInquiriess)) {
                      $this->initLeasingEventInquiriess(false);

                      foreach ($collLeasingEventInquiriess as $obj) {
                        if (false == $this->collLeasingEventInquiriess->contains($obj)) {
                          $this->collLeasingEventInquiriess->append($obj);
                        }
                      }

                      $this->collLeasingEventInquiriessPartial = true;
                    }

                    $collLeasingEventInquiriess->getInternalIterator()->rewind();

                    return $collLeasingEventInquiriess;
                }

                if ($partial && $this->collLeasingEventInquiriess) {
                    foreach ($this->collLeasingEventInquiriess as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingEventInquiriess[] = $obj;
                        }
                    }
                }

                $this->collLeasingEventInquiriess = $collLeasingEventInquiriess;
                $this->collLeasingEventInquiriessPartial = false;
            }
        }

        return $this->collLeasingEventInquiriess;
    }

    /**
     * Sets a collection of LeasingEventInquiries objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingEventInquiriess A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function setLeasingEventInquiriess(PropelCollection $leasingEventInquiriess, PropelPDO $con = null)
    {
        $leasingEventInquiriessToDelete = $this->getLeasingEventInquiriess(new Criteria(), $con)->diff($leasingEventInquiriess);


        $this->leasingEventInquiriessScheduledForDeletion = $leasingEventInquiriessToDelete;

        foreach ($leasingEventInquiriessToDelete as $leasingEventInquiriesRemoved) {
            $leasingEventInquiriesRemoved->setLeasingEventLeads(null);
        }

        $this->collLeasingEventInquiriess = null;
        foreach ($leasingEventInquiriess as $leasingEventInquiries) {
            $this->addLeasingEventInquiries($leasingEventInquiries);
        }

        $this->collLeasingEventInquiriess = $leasingEventInquiriess;
        $this->collLeasingEventInquiriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingEventInquiries objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingEventInquiries objects.
     * @throws PropelException
     */
    public function countLeasingEventInquiriess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventInquiriessPartial && !$this->isNew();
        if (null === $this->collLeasingEventInquiriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventInquiriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingEventInquiriess());
            }
            $query = LeasingEventInquiriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingEventLeads($this)
                ->count($con);
        }

        return count($this->collLeasingEventInquiriess);
    }

    /**
     * Method called to associate a LeasingEventInquiries object to this object
     * through the LeasingEventInquiries foreign key attribute.
     *
     * @param    LeasingEventInquiries $l LeasingEventInquiries
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function addLeasingEventInquiries(LeasingEventInquiries $l)
    {
        if ($this->collLeasingEventInquiriess === null) {
            $this->initLeasingEventInquiriess();
            $this->collLeasingEventInquiriessPartial = true;
        }

        if (!in_array($l, $this->collLeasingEventInquiriess->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingEventInquiries($l);

            if ($this->leasingEventInquiriessScheduledForDeletion and $this->leasingEventInquiriessScheduledForDeletion->contains($l)) {
                $this->leasingEventInquiriessScheduledForDeletion->remove($this->leasingEventInquiriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingEventInquiries $leasingEventInquiries The leasingEventInquiries object to add.
     */
    protected function doAddLeasingEventInquiries($leasingEventInquiries)
    {
        $this->collLeasingEventInquiriess[]= $leasingEventInquiries;
        $leasingEventInquiries->setLeasingEventLeads($this);
    }

    /**
     * @param	LeasingEventInquiries $leasingEventInquiries The leasingEventInquiries object to remove.
     * @return LeasingEventLeads The current object (for fluent API support)
     */
    public function removeLeasingEventInquiries($leasingEventInquiries)
    {
        if ($this->getLeasingEventInquiriess()->contains($leasingEventInquiries)) {
            $this->collLeasingEventInquiriess->remove($this->collLeasingEventInquiriess->search($leasingEventInquiries));
            if (null === $this->leasingEventInquiriessScheduledForDeletion) {
                $this->leasingEventInquiriessScheduledForDeletion = clone $this->collLeasingEventInquiriess;
                $this->leasingEventInquiriessScheduledForDeletion->clear();
            }
            $this->leasingEventInquiriessScheduledForDeletion[]= $leasingEventInquiries;
            $leasingEventInquiries->setLeasingEventLeads(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingEventLeads is new, it will return
     * an empty collection; or if this LeasingEventLeads has previously
     * been saved, it will retrieve related LeasingEventInquiriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingEventLeads.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingEventInquiries[] List of LeasingEventInquiries objects
     */
    public function getLeasingEventInquiriessJoinLeasingEventPlace($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingEventInquiriesQuery::create(null, $criteria);
        $query->joinWith('LeasingEventPlace', $join_behavior);

        return $this->getLeasingEventInquiriess($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->fname = null;
        $this->lname = null;
        $this->birthdate = null;
        $this->age = null;
        $this->gender = null;
        $this->email = null;
        $this->mobile = null;
        $this->country_id = null;
        $this->nationality_id = null;
        $this->event_lead_type = null;
        $this->client_ip = null;
        $this->client_id = null;
        $this->campaign = null;
        $this->medium = null;
        $this->source = null;
        $this->gacountry = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collLeasingEventBookingss) {
                foreach ($this->collLeasingEventBookingss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingEventInquiriess) {
                foreach ($this->collLeasingEventInquiriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aLeasingCountry instanceof Persistent) {
              $this->aLeasingCountry->clearAllReferences($deep);
            }
            if ($this->aLeasingNationality instanceof Persistent) {
              $this->aLeasingNationality->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingEventBookingss instanceof PropelCollection) {
            $this->collLeasingEventBookingss->clearIterator();
        }
        $this->collLeasingEventBookingss = null;
        if ($this->collLeasingEventInquiriess instanceof PropelCollection) {
            $this->collLeasingEventInquiriess->clearIterator();
        }
        $this->collLeasingEventInquiriess = null;
        $this->aLeasingCountry = null;
        $this->aLeasingNationality = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingEventLeadsPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
