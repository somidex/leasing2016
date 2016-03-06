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
use Leasing\CoreBundle\Model\LeasingAppointmentLeads;
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsPeer;
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery;
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingAppointmentsQuery;
use Leasing\CoreBundle\Model\LeasingCountry;
use Leasing\CoreBundle\Model\LeasingCountryQuery;
use Leasing\CoreBundle\Model\LeasingNationality;
use Leasing\CoreBundle\Model\LeasingNationalityQuery;

abstract class BaseLeasingAppointmentLeads extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingAppointmentLeadsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingAppointmentLeadsPeer
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
     * @var        PropelObjectCollection|LeasingAppointments[] Collection to store aggregation of LeasingAppointments objects.
     */
    protected $collLeasingAppointmentss;
    protected $collLeasingAppointmentssPartial;

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
    protected $leasingAppointmentssScheduledForDeletion = null;

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
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fname] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setFname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fname !== $v) {
            $this->fname = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::FNAME;
        }


        return $this;
    } // setFname()

    /**
     * Set the value of [lname] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setLname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lname !== $v) {
            $this->lname = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::LNAME;
        }


        return $this;
    } // setLname()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [mobile] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::MOBILE;
        }


        return $this;
    } // setMobile()

    /**
     * Set the value of [country_id] column.
     *
     * @param  int $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setCountryId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->country_id !== $v) {
            $this->country_id = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::COUNTRY_ID;
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
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setNationalityId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->nationality_id !== $v) {
            $this->nationality_id = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::NATIONALITY_ID;
        }

        if ($this->aLeasingNationality !== null && $this->aLeasingNationality->getId() !== $v) {
            $this->aLeasingNationality = null;
        }


        return $this;
    } // setNationalityId()

    /**
     * Set the value of [client_ip] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setClientIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_ip !== $v) {
            $this->client_ip = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::CLIENT_IP;
        }


        return $this;
    } // setClientIp()

    /**
     * Set the value of [client_id] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setClientId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_id !== $v) {
            $this->client_id = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::CLIENT_ID;
        }


        return $this;
    } // setClientId()

    /**
     * Set the value of [campaign] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setCampaign($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campaign !== $v) {
            $this->campaign = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::CAMPAIGN;
        }


        return $this;
    } // setCampaign()

    /**
     * Set the value of [medium] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setMedium($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->medium !== $v) {
            $this->medium = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::MEDIUM;
        }


        return $this;
    } // setMedium()

    /**
     * Set the value of [source] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setSource($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->source !== $v) {
            $this->source = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::SOURCE;
        }


        return $this;
    } // setSource()

    /**
     * Set the value of [gacountry] column.
     *
     * @param  string $v new value
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setGacountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gacountry !== $v) {
            $this->gacountry = $v;
            $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::GACOUNTRY;
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
            $this->email = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->mobile = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->country_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->nationality_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->client_ip = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->client_id = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->campaign = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->medium = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->source = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->gacountry = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 13; // 13 = LeasingAppointmentLeadsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingAppointmentLeads object", $e);
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
            $con = Propel::getConnection(LeasingAppointmentLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingAppointmentLeadsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingCountry = null;
            $this->aLeasingNationality = null;
            $this->collLeasingAppointmentss = null;

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
            $con = Propel::getConnection(LeasingAppointmentLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingAppointmentLeadsQuery::create()
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
            $con = Propel::getConnection(LeasingAppointmentLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingAppointmentLeadsPeer::addInstanceToPool($this);
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

            if ($this->leasingAppointmentssScheduledForDeletion !== null) {
                if (!$this->leasingAppointmentssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingAppointmentssScheduledForDeletion as $leasingAppointments) {
                        // need to save related object because we set the relation to null
                        $leasingAppointments->save($con);
                    }
                    $this->leasingAppointmentssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingAppointmentss !== null) {
                foreach ($this->collLeasingAppointmentss as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingAppointmentLeadsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingAppointmentLeadsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::FNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fname`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::LNAME)) {
            $modifiedColumns[':p' . $index++]  = '`lname`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::MOBILE)) {
            $modifiedColumns[':p' . $index++]  = '`mobile`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::COUNTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`country_id`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::NATIONALITY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`nationality_id`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::CLIENT_IP)) {
            $modifiedColumns[':p' . $index++]  = '`client_ip`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::CLIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`client_id`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::CAMPAIGN)) {
            $modifiedColumns[':p' . $index++]  = '`campaign`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::MEDIUM)) {
            $modifiedColumns[':p' . $index++]  = '`medium`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::SOURCE)) {
            $modifiedColumns[':p' . $index++]  = '`source`';
        }
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::GACOUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`gacountry`';
        }

        $sql = sprintf(
            'INSERT INTO `appointment_leads` (%s) VALUES (%s)',
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


            if (($retval = LeasingAppointmentLeadsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingAppointmentss !== null) {
                    foreach ($this->collLeasingAppointmentss as $referrerFK) {
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
        $pos = LeasingAppointmentLeadsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getEmail();
                break;
            case 4:
                return $this->getMobile();
                break;
            case 5:
                return $this->getCountryId();
                break;
            case 6:
                return $this->getNationalityId();
                break;
            case 7:
                return $this->getClientIp();
                break;
            case 8:
                return $this->getClientId();
                break;
            case 9:
                return $this->getCampaign();
                break;
            case 10:
                return $this->getMedium();
                break;
            case 11:
                return $this->getSource();
                break;
            case 12:
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
        if (isset($alreadyDumpedObjects['LeasingAppointmentLeads'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingAppointmentLeads'][$this->getPrimaryKey()] = true;
        $keys = LeasingAppointmentLeadsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFname(),
            $keys[2] => $this->getLname(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getMobile(),
            $keys[5] => $this->getCountryId(),
            $keys[6] => $this->getNationalityId(),
            $keys[7] => $this->getClientIp(),
            $keys[8] => $this->getClientId(),
            $keys[9] => $this->getCampaign(),
            $keys[10] => $this->getMedium(),
            $keys[11] => $this->getSource(),
            $keys[12] => $this->getGacountry(),
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
            if (null !== $this->collLeasingAppointmentss) {
                $result['LeasingAppointmentss'] = $this->collLeasingAppointmentss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingAppointmentLeadsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setEmail($value);
                break;
            case 4:
                $this->setMobile($value);
                break;
            case 5:
                $this->setCountryId($value);
                break;
            case 6:
                $this->setNationalityId($value);
                break;
            case 7:
                $this->setClientIp($value);
                break;
            case 8:
                $this->setClientId($value);
                break;
            case 9:
                $this->setCampaign($value);
                break;
            case 10:
                $this->setMedium($value);
                break;
            case 11:
                $this->setSource($value);
                break;
            case 12:
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
        $keys = LeasingAppointmentLeadsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFname($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEmail($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setMobile($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCountryId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setNationalityId($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setClientIp($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setClientId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCampaign($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setMedium($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setSource($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setGacountry($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingAppointmentLeadsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::ID)) $criteria->add(LeasingAppointmentLeadsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::FNAME)) $criteria->add(LeasingAppointmentLeadsPeer::FNAME, $this->fname);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::LNAME)) $criteria->add(LeasingAppointmentLeadsPeer::LNAME, $this->lname);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::EMAIL)) $criteria->add(LeasingAppointmentLeadsPeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::MOBILE)) $criteria->add(LeasingAppointmentLeadsPeer::MOBILE, $this->mobile);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::COUNTRY_ID)) $criteria->add(LeasingAppointmentLeadsPeer::COUNTRY_ID, $this->country_id);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::NATIONALITY_ID)) $criteria->add(LeasingAppointmentLeadsPeer::NATIONALITY_ID, $this->nationality_id);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::CLIENT_IP)) $criteria->add(LeasingAppointmentLeadsPeer::CLIENT_IP, $this->client_ip);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::CLIENT_ID)) $criteria->add(LeasingAppointmentLeadsPeer::CLIENT_ID, $this->client_id);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::CAMPAIGN)) $criteria->add(LeasingAppointmentLeadsPeer::CAMPAIGN, $this->campaign);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::MEDIUM)) $criteria->add(LeasingAppointmentLeadsPeer::MEDIUM, $this->medium);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::SOURCE)) $criteria->add(LeasingAppointmentLeadsPeer::SOURCE, $this->source);
        if ($this->isColumnModified(LeasingAppointmentLeadsPeer::GACOUNTRY)) $criteria->add(LeasingAppointmentLeadsPeer::GACOUNTRY, $this->gacountry);

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
        $criteria = new Criteria(LeasingAppointmentLeadsPeer::DATABASE_NAME);
        $criteria->add(LeasingAppointmentLeadsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingAppointmentLeads (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFname($this->getFname());
        $copyObj->setLname($this->getLname());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setCountryId($this->getCountryId());
        $copyObj->setNationalityId($this->getNationalityId());
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

            foreach ($this->getLeasingAppointmentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingAppointments($relObj->copy($deepCopy));
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
     * @return LeasingAppointmentLeads Clone of current object.
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
     * @return LeasingAppointmentLeadsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingAppointmentLeadsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingCountry object.
     *
     * @param                  LeasingCountry $v
     * @return LeasingAppointmentLeads The current object (for fluent API support)
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
            $v->addLeasingAppointmentLeads($this);
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
                $this->aLeasingCountry->addLeasingAppointmentLeadss($this);
             */
        }

        return $this->aLeasingCountry;
    }

    /**
     * Declares an association between this object and a LeasingNationality object.
     *
     * @param                  LeasingNationality $v
     * @return LeasingAppointmentLeads The current object (for fluent API support)
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
            $v->addLeasingAppointmentLeads($this);
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
                $this->aLeasingNationality->addLeasingAppointmentLeadss($this);
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
        if ('LeasingAppointments' == $relationName) {
            $this->initLeasingAppointmentss();
        }
    }

    /**
     * Clears out the collLeasingAppointmentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     * @see        addLeasingAppointmentss()
     */
    public function clearLeasingAppointmentss()
    {
        $this->collLeasingAppointmentss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingAppointmentssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingAppointmentss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingAppointmentss($v = true)
    {
        $this->collLeasingAppointmentssPartial = $v;
    }

    /**
     * Initializes the collLeasingAppointmentss collection.
     *
     * By default this just sets the collLeasingAppointmentss collection to an empty array (like clearcollLeasingAppointmentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingAppointmentss($overrideExisting = true)
    {
        if (null !== $this->collLeasingAppointmentss && !$overrideExisting) {
            return;
        }
        $this->collLeasingAppointmentss = new PropelObjectCollection();
        $this->collLeasingAppointmentss->setModel('LeasingAppointments');
    }

    /**
     * Gets an array of LeasingAppointments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingAppointmentLeads is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingAppointments[] List of LeasingAppointments objects
     * @throws PropelException
     */
    public function getLeasingAppointmentss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentssPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentss) {
                // return empty collection
                $this->initLeasingAppointmentss();
            } else {
                $collLeasingAppointmentss = LeasingAppointmentsQuery::create(null, $criteria)
                    ->filterByLeasingAppointmentLeads($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingAppointmentssPartial && count($collLeasingAppointmentss)) {
                      $this->initLeasingAppointmentss(false);

                      foreach ($collLeasingAppointmentss as $obj) {
                        if (false == $this->collLeasingAppointmentss->contains($obj)) {
                          $this->collLeasingAppointmentss->append($obj);
                        }
                      }

                      $this->collLeasingAppointmentssPartial = true;
                    }

                    $collLeasingAppointmentss->getInternalIterator()->rewind();

                    return $collLeasingAppointmentss;
                }

                if ($partial && $this->collLeasingAppointmentss) {
                    foreach ($this->collLeasingAppointmentss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingAppointmentss[] = $obj;
                        }
                    }
                }

                $this->collLeasingAppointmentss = $collLeasingAppointmentss;
                $this->collLeasingAppointmentssPartial = false;
            }
        }

        return $this->collLeasingAppointmentss;
    }

    /**
     * Sets a collection of LeasingAppointments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingAppointmentss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function setLeasingAppointmentss(PropelCollection $leasingAppointmentss, PropelPDO $con = null)
    {
        $leasingAppointmentssToDelete = $this->getLeasingAppointmentss(new Criteria(), $con)->diff($leasingAppointmentss);


        $this->leasingAppointmentssScheduledForDeletion = $leasingAppointmentssToDelete;

        foreach ($leasingAppointmentssToDelete as $leasingAppointmentsRemoved) {
            $leasingAppointmentsRemoved->setLeasingAppointmentLeads(null);
        }

        $this->collLeasingAppointmentss = null;
        foreach ($leasingAppointmentss as $leasingAppointments) {
            $this->addLeasingAppointments($leasingAppointments);
        }

        $this->collLeasingAppointmentss = $leasingAppointmentss;
        $this->collLeasingAppointmentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingAppointments objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingAppointments objects.
     * @throws PropelException
     */
    public function countLeasingAppointmentss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentssPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingAppointmentss());
            }
            $query = LeasingAppointmentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingAppointmentLeads($this)
                ->count($con);
        }

        return count($this->collLeasingAppointmentss);
    }

    /**
     * Method called to associate a LeasingAppointments object to this object
     * through the LeasingAppointments foreign key attribute.
     *
     * @param    LeasingAppointments $l LeasingAppointments
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function addLeasingAppointments(LeasingAppointments $l)
    {
        if ($this->collLeasingAppointmentss === null) {
            $this->initLeasingAppointmentss();
            $this->collLeasingAppointmentssPartial = true;
        }

        if (!in_array($l, $this->collLeasingAppointmentss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingAppointments($l);

            if ($this->leasingAppointmentssScheduledForDeletion and $this->leasingAppointmentssScheduledForDeletion->contains($l)) {
                $this->leasingAppointmentssScheduledForDeletion->remove($this->leasingAppointmentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingAppointments $leasingAppointments The leasingAppointments object to add.
     */
    protected function doAddLeasingAppointments($leasingAppointments)
    {
        $this->collLeasingAppointmentss[]= $leasingAppointments;
        $leasingAppointments->setLeasingAppointmentLeads($this);
    }

    /**
     * @param	LeasingAppointments $leasingAppointments The leasingAppointments object to remove.
     * @return LeasingAppointmentLeads The current object (for fluent API support)
     */
    public function removeLeasingAppointments($leasingAppointments)
    {
        if ($this->getLeasingAppointmentss()->contains($leasingAppointments)) {
            $this->collLeasingAppointmentss->remove($this->collLeasingAppointmentss->search($leasingAppointments));
            if (null === $this->leasingAppointmentssScheduledForDeletion) {
                $this->leasingAppointmentssScheduledForDeletion = clone $this->collLeasingAppointmentss;
                $this->leasingAppointmentssScheduledForDeletion->clear();
            }
            $this->leasingAppointmentssScheduledForDeletion[]= $leasingAppointments;
            $leasingAppointments->setLeasingAppointmentLeads(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingAppointmentLeads is new, it will return
     * an empty collection; or if this LeasingAppointmentLeads has previously
     * been saved, it will retrieve related LeasingAppointmentss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingAppointmentLeads.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingAppointments[] List of LeasingAppointments objects
     */
    public function getLeasingAppointmentssJoinLeasingUnit($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingAppointmentsQuery::create(null, $criteria);
        $query->joinWith('LeasingUnit', $join_behavior);

        return $this->getLeasingAppointmentss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->fname = null;
        $this->lname = null;
        $this->email = null;
        $this->mobile = null;
        $this->country_id = null;
        $this->nationality_id = null;
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
            if ($this->collLeasingAppointmentss) {
                foreach ($this->collLeasingAppointmentss as $o) {
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

        if ($this->collLeasingAppointmentss instanceof PropelCollection) {
            $this->collLeasingAppointmentss->clearIterator();
        }
        $this->collLeasingAppointmentss = null;
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
        return (string) $this->exportTo(LeasingAppointmentLeadsPeer::DEFAULT_STRING_FORMAT);
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
