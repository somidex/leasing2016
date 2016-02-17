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
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventBookingsPeer;
use Leasing\CoreBundle\Model\LeasingEventBookingsQuery;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventLeadsQuery;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetails;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetailsQuery;
use Leasing\CoreBundle\Model\LeasingEventPlace;
use Leasing\CoreBundle\Model\LeasingEventPlaceQuery;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery;

abstract class BaseLeasingEventBookings extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingEventBookingsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingEventBookingsPeer
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
     * The value for the application_number field.
     * @var        string
     */
    protected $application_number;

    /**
     * The value for the event_place_id field.
     * @var        int
     */
    protected $event_place_id;

    /**
     * The value for the event_place_specific field.
     * @var        string
     */
    protected $event_place_specific;

    /**
     * The value for the event_leads_id field.
     * @var        int
     */
    protected $event_leads_id;

    /**
     * The value for the event_date field.
     * @var        string
     */
    protected $event_date;

    /**
     * The value for the event_start_time field.
     * @var        string
     */
    protected $event_start_time;

    /**
     * The value for the event_end_time field.
     * @var        string
     */
    protected $event_end_time;

    /**
     * The value for the date_added field.
     * @var        string
     */
    protected $date_added;

    /**
     * The value for the first_heard field.
     * @var        string
     */
    protected $first_heard;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the prev_status field.
     * @var        int
     */
    protected $prev_status;

    /**
     * The value for the processing field.
     * @var        int
     */
    protected $processing;

    /**
     * The value for the processed_by field.
     * @var        string
     */
    protected $processed_by;

    /**
     * @var        LeasingEventPlace
     */
    protected $aLeasingEventPlace;

    /**
     * @var        LeasingEventLeads
     */
    protected $aLeasingEventLeads;

    /**
     * @var        PropelObjectCollection|LeasingEventPaymentDetails[] Collection to store aggregation of LeasingEventPaymentDetails objects.
     */
    protected $collLeasingEventPaymentDetailss;
    protected $collLeasingEventPaymentDetailssPartial;

    /**
     * @var        PropelObjectCollection|LeasingPaymentTransactions[] Collection to store aggregation of LeasingPaymentTransactions objects.
     */
    protected $collLeasingPaymentTransactionss;
    protected $collLeasingPaymentTransactionssPartial;

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
    protected $leasingEventPaymentDetailssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingPaymentTransactionssScheduledForDeletion = null;

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
     * Get the [application_number] column value.
     *
     * @return string
     */
    public function getApplicationNumber()
    {

        return $this->application_number;
    }

    /**
     * Get the [event_place_id] column value.
     *
     * @return int
     */
    public function getEventPlaceId()
    {

        return $this->event_place_id;
    }

    /**
     * Get the [event_place_specific] column value.
     *
     * @return string
     */
    public function getEventPlaceSpecific()
    {

        return $this->event_place_specific;
    }

    /**
     * Get the [event_leads_id] column value.
     *
     * @return int
     */
    public function getEventLeadsId()
    {

        return $this->event_leads_id;
    }

    /**
     * Get the [event_date] column value.
     *
     * @return string
     */
    public function getEventDate()
    {

        return $this->event_date;
    }

    /**
     * Get the [event_start_time] column value.
     *
     * @return string
     */
    public function getEventStartTime()
    {

        return $this->event_start_time;
    }

    /**
     * Get the [event_end_time] column value.
     *
     * @return string
     */
    public function getEventEndTime()
    {

        return $this->event_end_time;
    }

    /**
     * Get the [date_added] column value.
     *
     * @return string
     */
    public function getDateAdded()
    {

        return $this->date_added;
    }

    /**
     * Get the [first_heard] column value.
     *
     * @return string
     */
    public function getFirstHeard()
    {

        return $this->first_heard;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {

        return $this->status;
    }

    /**
     * Get the [prev_status] column value.
     *
     * @return int
     */
    public function getPrevStatus()
    {

        return $this->prev_status;
    }

    /**
     * Get the [processing] column value.
     *
     * @return int
     */
    public function getProcessing()
    {

        return $this->processing;
    }

    /**
     * Get the [processed_by] column value.
     *
     * @return string
     */
    public function getProcessedBy()
    {

        return $this->processed_by;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [application_number] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setApplicationNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->application_number !== $v) {
            $this->application_number = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::APPLICATION_NUMBER;
        }


        return $this;
    } // setApplicationNumber()

    /**
     * Set the value of [event_place_id] column.
     *
     * @param  int $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setEventPlaceId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->event_place_id !== $v) {
            $this->event_place_id = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::EVENT_PLACE_ID;
        }

        if ($this->aLeasingEventPlace !== null && $this->aLeasingEventPlace->getId() !== $v) {
            $this->aLeasingEventPlace = null;
        }


        return $this;
    } // setEventPlaceId()

    /**
     * Set the value of [event_place_specific] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setEventPlaceSpecific($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->event_place_specific !== $v) {
            $this->event_place_specific = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC;
        }


        return $this;
    } // setEventPlaceSpecific()

    /**
     * Set the value of [event_leads_id] column.
     *
     * @param  int $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setEventLeadsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->event_leads_id !== $v) {
            $this->event_leads_id = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::EVENT_LEADS_ID;
        }

        if ($this->aLeasingEventLeads !== null && $this->aLeasingEventLeads->getId() !== $v) {
            $this->aLeasingEventLeads = null;
        }


        return $this;
    } // setEventLeadsId()

    /**
     * Set the value of [event_date] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setEventDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->event_date !== $v) {
            $this->event_date = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::EVENT_DATE;
        }


        return $this;
    } // setEventDate()

    /**
     * Set the value of [event_start_time] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setEventStartTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->event_start_time !== $v) {
            $this->event_start_time = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::EVENT_START_TIME;
        }


        return $this;
    } // setEventStartTime()

    /**
     * Set the value of [event_end_time] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setEventEndTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->event_end_time !== $v) {
            $this->event_end_time = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::EVENT_END_TIME;
        }


        return $this;
    } // setEventEndTime()

    /**
     * Set the value of [date_added] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_added !== $v) {
            $this->date_added = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::DATE_ADDED;
        }


        return $this;
    } // setDateAdded()

    /**
     * Set the value of [first_heard] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setFirstHeard($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_heard !== $v) {
            $this->first_heard = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::FIRST_HEARD;
        }


        return $this;
    } // setFirstHeard()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [prev_status] column.
     *
     * @param  int $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setPrevStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->prev_status !== $v) {
            $this->prev_status = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::PREV_STATUS;
        }


        return $this;
    } // setPrevStatus()

    /**
     * Set the value of [processing] column.
     *
     * @param  int $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setProcessing($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->processing !== $v) {
            $this->processing = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::PROCESSING;
        }


        return $this;
    } // setProcessing()

    /**
     * Set the value of [processed_by] column.
     *
     * @param  string $v new value
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setProcessedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->processed_by !== $v) {
            $this->processed_by = $v;
            $this->modifiedColumns[] = LeasingEventBookingsPeer::PROCESSED_BY;
        }


        return $this;
    } // setProcessedBy()

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
            $this->application_number = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->event_place_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->event_place_specific = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->event_leads_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->event_date = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->event_start_time = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->event_end_time = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->date_added = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->first_heard = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->status = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->prev_status = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->processing = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->processed_by = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 14; // 14 = LeasingEventBookingsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingEventBookings object", $e);
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

        if ($this->aLeasingEventPlace !== null && $this->event_place_id !== $this->aLeasingEventPlace->getId()) {
            $this->aLeasingEventPlace = null;
        }
        if ($this->aLeasingEventLeads !== null && $this->event_leads_id !== $this->aLeasingEventLeads->getId()) {
            $this->aLeasingEventLeads = null;
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
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingEventBookingsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingEventPlace = null;
            $this->aLeasingEventLeads = null;
            $this->collLeasingEventPaymentDetailss = null;

            $this->collLeasingPaymentTransactionss = null;

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
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingEventBookingsQuery::create()
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
            $con = Propel::getConnection(LeasingEventBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingEventBookingsPeer::addInstanceToPool($this);
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

            if ($this->aLeasingEventPlace !== null) {
                if ($this->aLeasingEventPlace->isModified() || $this->aLeasingEventPlace->isNew()) {
                    $affectedRows += $this->aLeasingEventPlace->save($con);
                }
                $this->setLeasingEventPlace($this->aLeasingEventPlace);
            }

            if ($this->aLeasingEventLeads !== null) {
                if ($this->aLeasingEventLeads->isModified() || $this->aLeasingEventLeads->isNew()) {
                    $affectedRows += $this->aLeasingEventLeads->save($con);
                }
                $this->setLeasingEventLeads($this->aLeasingEventLeads);
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

            if ($this->leasingEventPaymentDetailssScheduledForDeletion !== null) {
                if (!$this->leasingEventPaymentDetailssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingEventPaymentDetailssScheduledForDeletion as $leasingEventPaymentDetails) {
                        // need to save related object because we set the relation to null
                        $leasingEventPaymentDetails->save($con);
                    }
                    $this->leasingEventPaymentDetailssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingEventPaymentDetailss !== null) {
                foreach ($this->collLeasingEventPaymentDetailss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingPaymentTransactionssScheduledForDeletion !== null) {
                if (!$this->leasingPaymentTransactionssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingPaymentTransactionssScheduledForDeletion as $leasingPaymentTransactions) {
                        // need to save related object because we set the relation to null
                        $leasingPaymentTransactions->save($con);
                    }
                    $this->leasingPaymentTransactionssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingPaymentTransactionss !== null) {
                foreach ($this->collLeasingPaymentTransactionss as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingEventBookingsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingEventBookingsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingEventBookingsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::APPLICATION_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`application_number`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_PLACE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`event_place_id`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC)) {
            $modifiedColumns[':p' . $index++]  = '`event_place_specific`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_LEADS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`event_leads_id`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`event_date`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_START_TIME)) {
            $modifiedColumns[':p' . $index++]  = '`event_start_time`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_END_TIME)) {
            $modifiedColumns[':p' . $index++]  = '`event_end_time`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::FIRST_HEARD)) {
            $modifiedColumns[':p' . $index++]  = '`first_heard`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::PREV_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`prev_status`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::PROCESSING)) {
            $modifiedColumns[':p' . $index++]  = '`processing`';
        }
        if ($this->isColumnModified(LeasingEventBookingsPeer::PROCESSED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`processed_by`';
        }

        $sql = sprintf(
            'INSERT INTO `event_bookings` (%s) VALUES (%s)',
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
                    case '`application_number`':
                        $stmt->bindValue($identifier, $this->application_number, PDO::PARAM_STR);
                        break;
                    case '`event_place_id`':
                        $stmt->bindValue($identifier, $this->event_place_id, PDO::PARAM_INT);
                        break;
                    case '`event_place_specific`':
                        $stmt->bindValue($identifier, $this->event_place_specific, PDO::PARAM_STR);
                        break;
                    case '`event_leads_id`':
                        $stmt->bindValue($identifier, $this->event_leads_id, PDO::PARAM_INT);
                        break;
                    case '`event_date`':
                        $stmt->bindValue($identifier, $this->event_date, PDO::PARAM_STR);
                        break;
                    case '`event_start_time`':
                        $stmt->bindValue($identifier, $this->event_start_time, PDO::PARAM_STR);
                        break;
                    case '`event_end_time`':
                        $stmt->bindValue($identifier, $this->event_end_time, PDO::PARAM_STR);
                        break;
                    case '`date_added`':
                        $stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
                        break;
                    case '`first_heard`':
                        $stmt->bindValue($identifier, $this->first_heard, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`prev_status`':
                        $stmt->bindValue($identifier, $this->prev_status, PDO::PARAM_INT);
                        break;
                    case '`processing`':
                        $stmt->bindValue($identifier, $this->processing, PDO::PARAM_INT);
                        break;
                    case '`processed_by`':
                        $stmt->bindValue($identifier, $this->processed_by, PDO::PARAM_STR);
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

            if ($this->aLeasingEventPlace !== null) {
                if (!$this->aLeasingEventPlace->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingEventPlace->getValidationFailures());
                }
            }

            if ($this->aLeasingEventLeads !== null) {
                if (!$this->aLeasingEventLeads->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingEventLeads->getValidationFailures());
                }
            }


            if (($retval = LeasingEventBookingsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingEventPaymentDetailss !== null) {
                    foreach ($this->collLeasingEventPaymentDetailss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingPaymentTransactionss !== null) {
                    foreach ($this->collLeasingPaymentTransactionss as $referrerFK) {
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
        $pos = LeasingEventBookingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getApplicationNumber();
                break;
            case 2:
                return $this->getEventPlaceId();
                break;
            case 3:
                return $this->getEventPlaceSpecific();
                break;
            case 4:
                return $this->getEventLeadsId();
                break;
            case 5:
                return $this->getEventDate();
                break;
            case 6:
                return $this->getEventStartTime();
                break;
            case 7:
                return $this->getEventEndTime();
                break;
            case 8:
                return $this->getDateAdded();
                break;
            case 9:
                return $this->getFirstHeard();
                break;
            case 10:
                return $this->getStatus();
                break;
            case 11:
                return $this->getPrevStatus();
                break;
            case 12:
                return $this->getProcessing();
                break;
            case 13:
                return $this->getProcessedBy();
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
        if (isset($alreadyDumpedObjects['LeasingEventBookings'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingEventBookings'][$this->getPrimaryKey()] = true;
        $keys = LeasingEventBookingsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getApplicationNumber(),
            $keys[2] => $this->getEventPlaceId(),
            $keys[3] => $this->getEventPlaceSpecific(),
            $keys[4] => $this->getEventLeadsId(),
            $keys[5] => $this->getEventDate(),
            $keys[6] => $this->getEventStartTime(),
            $keys[7] => $this->getEventEndTime(),
            $keys[8] => $this->getDateAdded(),
            $keys[9] => $this->getFirstHeard(),
            $keys[10] => $this->getStatus(),
            $keys[11] => $this->getPrevStatus(),
            $keys[12] => $this->getProcessing(),
            $keys[13] => $this->getProcessedBy(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingEventPlace) {
                $result['LeasingEventPlace'] = $this->aLeasingEventPlace->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingEventLeads) {
                $result['LeasingEventLeads'] = $this->aLeasingEventLeads->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLeasingEventPaymentDetailss) {
                $result['LeasingEventPaymentDetailss'] = $this->collLeasingEventPaymentDetailss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingPaymentTransactionss) {
                $result['LeasingPaymentTransactionss'] = $this->collLeasingPaymentTransactionss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingEventBookingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setApplicationNumber($value);
                break;
            case 2:
                $this->setEventPlaceId($value);
                break;
            case 3:
                $this->setEventPlaceSpecific($value);
                break;
            case 4:
                $this->setEventLeadsId($value);
                break;
            case 5:
                $this->setEventDate($value);
                break;
            case 6:
                $this->setEventStartTime($value);
                break;
            case 7:
                $this->setEventEndTime($value);
                break;
            case 8:
                $this->setDateAdded($value);
                break;
            case 9:
                $this->setFirstHeard($value);
                break;
            case 10:
                $this->setStatus($value);
                break;
            case 11:
                $this->setPrevStatus($value);
                break;
            case 12:
                $this->setProcessing($value);
                break;
            case 13:
                $this->setProcessedBy($value);
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
        $keys = LeasingEventBookingsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setApplicationNumber($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEventPlaceId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEventPlaceSpecific($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEventLeadsId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setEventDate($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEventStartTime($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setEventEndTime($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setDateAdded($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setFirstHeard($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setStatus($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setPrevStatus($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setProcessing($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setProcessedBy($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingEventBookingsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingEventBookingsPeer::ID)) $criteria->add(LeasingEventBookingsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingEventBookingsPeer::APPLICATION_NUMBER)) $criteria->add(LeasingEventBookingsPeer::APPLICATION_NUMBER, $this->application_number);
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_PLACE_ID)) $criteria->add(LeasingEventBookingsPeer::EVENT_PLACE_ID, $this->event_place_id);
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC)) $criteria->add(LeasingEventBookingsPeer::EVENT_PLACE_SPECIFIC, $this->event_place_specific);
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_LEADS_ID)) $criteria->add(LeasingEventBookingsPeer::EVENT_LEADS_ID, $this->event_leads_id);
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_DATE)) $criteria->add(LeasingEventBookingsPeer::EVENT_DATE, $this->event_date);
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_START_TIME)) $criteria->add(LeasingEventBookingsPeer::EVENT_START_TIME, $this->event_start_time);
        if ($this->isColumnModified(LeasingEventBookingsPeer::EVENT_END_TIME)) $criteria->add(LeasingEventBookingsPeer::EVENT_END_TIME, $this->event_end_time);
        if ($this->isColumnModified(LeasingEventBookingsPeer::DATE_ADDED)) $criteria->add(LeasingEventBookingsPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(LeasingEventBookingsPeer::FIRST_HEARD)) $criteria->add(LeasingEventBookingsPeer::FIRST_HEARD, $this->first_heard);
        if ($this->isColumnModified(LeasingEventBookingsPeer::STATUS)) $criteria->add(LeasingEventBookingsPeer::STATUS, $this->status);
        if ($this->isColumnModified(LeasingEventBookingsPeer::PREV_STATUS)) $criteria->add(LeasingEventBookingsPeer::PREV_STATUS, $this->prev_status);
        if ($this->isColumnModified(LeasingEventBookingsPeer::PROCESSING)) $criteria->add(LeasingEventBookingsPeer::PROCESSING, $this->processing);
        if ($this->isColumnModified(LeasingEventBookingsPeer::PROCESSED_BY)) $criteria->add(LeasingEventBookingsPeer::PROCESSED_BY, $this->processed_by);

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
        $criteria = new Criteria(LeasingEventBookingsPeer::DATABASE_NAME);
        $criteria->add(LeasingEventBookingsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingEventBookings (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setApplicationNumber($this->getApplicationNumber());
        $copyObj->setEventPlaceId($this->getEventPlaceId());
        $copyObj->setEventPlaceSpecific($this->getEventPlaceSpecific());
        $copyObj->setEventLeadsId($this->getEventLeadsId());
        $copyObj->setEventDate($this->getEventDate());
        $copyObj->setEventStartTime($this->getEventStartTime());
        $copyObj->setEventEndTime($this->getEventEndTime());
        $copyObj->setDateAdded($this->getDateAdded());
        $copyObj->setFirstHeard($this->getFirstHeard());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setPrevStatus($this->getPrevStatus());
        $copyObj->setProcessing($this->getProcessing());
        $copyObj->setProcessedBy($this->getProcessedBy());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingEventPaymentDetailss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingEventPaymentDetails($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingPaymentTransactionss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingPaymentTransactions($relObj->copy($deepCopy));
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
     * @return LeasingEventBookings Clone of current object.
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
     * @return LeasingEventBookingsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingEventBookingsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingEventPlace object.
     *
     * @param                  LeasingEventPlace $v
     * @return LeasingEventBookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingEventPlace(LeasingEventPlace $v = null)
    {
        if ($v === null) {
            $this->setEventPlaceId(NULL);
        } else {
            $this->setEventPlaceId($v->getId());
        }

        $this->aLeasingEventPlace = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingEventPlace object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingEventBookings($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingEventPlace object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingEventPlace The associated LeasingEventPlace object.
     * @throws PropelException
     */
    public function getLeasingEventPlace(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingEventPlace === null && ($this->event_place_id !== null) && $doQuery) {
            $this->aLeasingEventPlace = LeasingEventPlaceQuery::create()->findPk($this->event_place_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingEventPlace->addLeasingEventBookingss($this);
             */
        }

        return $this->aLeasingEventPlace;
    }

    /**
     * Declares an association between this object and a LeasingEventLeads object.
     *
     * @param                  LeasingEventLeads $v
     * @return LeasingEventBookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingEventLeads(LeasingEventLeads $v = null)
    {
        if ($v === null) {
            $this->setEventLeadsId(NULL);
        } else {
            $this->setEventLeadsId($v->getId());
        }

        $this->aLeasingEventLeads = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingEventLeads object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingEventBookings($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingEventLeads object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingEventLeads The associated LeasingEventLeads object.
     * @throws PropelException
     */
    public function getLeasingEventLeads(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingEventLeads === null && ($this->event_leads_id !== null) && $doQuery) {
            $this->aLeasingEventLeads = LeasingEventLeadsQuery::create()->findPk($this->event_leads_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingEventLeads->addLeasingEventBookingss($this);
             */
        }

        return $this->aLeasingEventLeads;
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
        if ('LeasingEventPaymentDetails' == $relationName) {
            $this->initLeasingEventPaymentDetailss();
        }
        if ('LeasingPaymentTransactions' == $relationName) {
            $this->initLeasingPaymentTransactionss();
        }
    }

    /**
     * Clears out the collLeasingEventPaymentDetailss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingEventBookings The current object (for fluent API support)
     * @see        addLeasingEventPaymentDetailss()
     */
    public function clearLeasingEventPaymentDetailss()
    {
        $this->collLeasingEventPaymentDetailss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingEventPaymentDetailssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingEventPaymentDetailss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingEventPaymentDetailss($v = true)
    {
        $this->collLeasingEventPaymentDetailssPartial = $v;
    }

    /**
     * Initializes the collLeasingEventPaymentDetailss collection.
     *
     * By default this just sets the collLeasingEventPaymentDetailss collection to an empty array (like clearcollLeasingEventPaymentDetailss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingEventPaymentDetailss($overrideExisting = true)
    {
        if (null !== $this->collLeasingEventPaymentDetailss && !$overrideExisting) {
            return;
        }
        $this->collLeasingEventPaymentDetailss = new PropelObjectCollection();
        $this->collLeasingEventPaymentDetailss->setModel('LeasingEventPaymentDetails');
    }

    /**
     * Gets an array of LeasingEventPaymentDetails objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingEventBookings is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingEventPaymentDetails[] List of LeasingEventPaymentDetails objects
     * @throws PropelException
     */
    public function getLeasingEventPaymentDetailss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventPaymentDetailssPartial && !$this->isNew();
        if (null === $this->collLeasingEventPaymentDetailss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventPaymentDetailss) {
                // return empty collection
                $this->initLeasingEventPaymentDetailss();
            } else {
                $collLeasingEventPaymentDetailss = LeasingEventPaymentDetailsQuery::create(null, $criteria)
                    ->filterByLeasingEventBookings($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingEventPaymentDetailssPartial && count($collLeasingEventPaymentDetailss)) {
                      $this->initLeasingEventPaymentDetailss(false);

                      foreach ($collLeasingEventPaymentDetailss as $obj) {
                        if (false == $this->collLeasingEventPaymentDetailss->contains($obj)) {
                          $this->collLeasingEventPaymentDetailss->append($obj);
                        }
                      }

                      $this->collLeasingEventPaymentDetailssPartial = true;
                    }

                    $collLeasingEventPaymentDetailss->getInternalIterator()->rewind();

                    return $collLeasingEventPaymentDetailss;
                }

                if ($partial && $this->collLeasingEventPaymentDetailss) {
                    foreach ($this->collLeasingEventPaymentDetailss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingEventPaymentDetailss[] = $obj;
                        }
                    }
                }

                $this->collLeasingEventPaymentDetailss = $collLeasingEventPaymentDetailss;
                $this->collLeasingEventPaymentDetailssPartial = false;
            }
        }

        return $this->collLeasingEventPaymentDetailss;
    }

    /**
     * Sets a collection of LeasingEventPaymentDetails objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingEventPaymentDetailss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setLeasingEventPaymentDetailss(PropelCollection $leasingEventPaymentDetailss, PropelPDO $con = null)
    {
        $leasingEventPaymentDetailssToDelete = $this->getLeasingEventPaymentDetailss(new Criteria(), $con)->diff($leasingEventPaymentDetailss);


        $this->leasingEventPaymentDetailssScheduledForDeletion = $leasingEventPaymentDetailssToDelete;

        foreach ($leasingEventPaymentDetailssToDelete as $leasingEventPaymentDetailsRemoved) {
            $leasingEventPaymentDetailsRemoved->setLeasingEventBookings(null);
        }

        $this->collLeasingEventPaymentDetailss = null;
        foreach ($leasingEventPaymentDetailss as $leasingEventPaymentDetails) {
            $this->addLeasingEventPaymentDetails($leasingEventPaymentDetails);
        }

        $this->collLeasingEventPaymentDetailss = $leasingEventPaymentDetailss;
        $this->collLeasingEventPaymentDetailssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingEventPaymentDetails objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingEventPaymentDetails objects.
     * @throws PropelException
     */
    public function countLeasingEventPaymentDetailss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventPaymentDetailssPartial && !$this->isNew();
        if (null === $this->collLeasingEventPaymentDetailss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventPaymentDetailss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingEventPaymentDetailss());
            }
            $query = LeasingEventPaymentDetailsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingEventBookings($this)
                ->count($con);
        }

        return count($this->collLeasingEventPaymentDetailss);
    }

    /**
     * Method called to associate a LeasingEventPaymentDetails object to this object
     * through the LeasingEventPaymentDetails foreign key attribute.
     *
     * @param    LeasingEventPaymentDetails $l LeasingEventPaymentDetails
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function addLeasingEventPaymentDetails(LeasingEventPaymentDetails $l)
    {
        if ($this->collLeasingEventPaymentDetailss === null) {
            $this->initLeasingEventPaymentDetailss();
            $this->collLeasingEventPaymentDetailssPartial = true;
        }

        if (!in_array($l, $this->collLeasingEventPaymentDetailss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingEventPaymentDetails($l);

            if ($this->leasingEventPaymentDetailssScheduledForDeletion and $this->leasingEventPaymentDetailssScheduledForDeletion->contains($l)) {
                $this->leasingEventPaymentDetailssScheduledForDeletion->remove($this->leasingEventPaymentDetailssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingEventPaymentDetails $leasingEventPaymentDetails The leasingEventPaymentDetails object to add.
     */
    protected function doAddLeasingEventPaymentDetails($leasingEventPaymentDetails)
    {
        $this->collLeasingEventPaymentDetailss[]= $leasingEventPaymentDetails;
        $leasingEventPaymentDetails->setLeasingEventBookings($this);
    }

    /**
     * @param	LeasingEventPaymentDetails $leasingEventPaymentDetails The leasingEventPaymentDetails object to remove.
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function removeLeasingEventPaymentDetails($leasingEventPaymentDetails)
    {
        if ($this->getLeasingEventPaymentDetailss()->contains($leasingEventPaymentDetails)) {
            $this->collLeasingEventPaymentDetailss->remove($this->collLeasingEventPaymentDetailss->search($leasingEventPaymentDetails));
            if (null === $this->leasingEventPaymentDetailssScheduledForDeletion) {
                $this->leasingEventPaymentDetailssScheduledForDeletion = clone $this->collLeasingEventPaymentDetailss;
                $this->leasingEventPaymentDetailssScheduledForDeletion->clear();
            }
            $this->leasingEventPaymentDetailssScheduledForDeletion[]= $leasingEventPaymentDetails;
            $leasingEventPaymentDetails->setLeasingEventBookings(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeasingPaymentTransactionss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingEventBookings The current object (for fluent API support)
     * @see        addLeasingPaymentTransactionss()
     */
    public function clearLeasingPaymentTransactionss()
    {
        $this->collLeasingPaymentTransactionss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingPaymentTransactionssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingPaymentTransactionss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingPaymentTransactionss($v = true)
    {
        $this->collLeasingPaymentTransactionssPartial = $v;
    }

    /**
     * Initializes the collLeasingPaymentTransactionss collection.
     *
     * By default this just sets the collLeasingPaymentTransactionss collection to an empty array (like clearcollLeasingPaymentTransactionss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingPaymentTransactionss($overrideExisting = true)
    {
        if (null !== $this->collLeasingPaymentTransactionss && !$overrideExisting) {
            return;
        }
        $this->collLeasingPaymentTransactionss = new PropelObjectCollection();
        $this->collLeasingPaymentTransactionss->setModel('LeasingPaymentTransactions');
    }

    /**
     * Gets an array of LeasingPaymentTransactions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingEventBookings is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     * @throws PropelException
     */
    public function getLeasingPaymentTransactionss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPaymentTransactionssPartial && !$this->isNew();
        if (null === $this->collLeasingPaymentTransactionss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingPaymentTransactionss) {
                // return empty collection
                $this->initLeasingPaymentTransactionss();
            } else {
                $collLeasingPaymentTransactionss = LeasingPaymentTransactionsQuery::create(null, $criteria)
                    ->filterByLeasingEventBookings($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingPaymentTransactionssPartial && count($collLeasingPaymentTransactionss)) {
                      $this->initLeasingPaymentTransactionss(false);

                      foreach ($collLeasingPaymentTransactionss as $obj) {
                        if (false == $this->collLeasingPaymentTransactionss->contains($obj)) {
                          $this->collLeasingPaymentTransactionss->append($obj);
                        }
                      }

                      $this->collLeasingPaymentTransactionssPartial = true;
                    }

                    $collLeasingPaymentTransactionss->getInternalIterator()->rewind();

                    return $collLeasingPaymentTransactionss;
                }

                if ($partial && $this->collLeasingPaymentTransactionss) {
                    foreach ($this->collLeasingPaymentTransactionss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingPaymentTransactionss[] = $obj;
                        }
                    }
                }

                $this->collLeasingPaymentTransactionss = $collLeasingPaymentTransactionss;
                $this->collLeasingPaymentTransactionssPartial = false;
            }
        }

        return $this->collLeasingPaymentTransactionss;
    }

    /**
     * Sets a collection of LeasingPaymentTransactions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingPaymentTransactionss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function setLeasingPaymentTransactionss(PropelCollection $leasingPaymentTransactionss, PropelPDO $con = null)
    {
        $leasingPaymentTransactionssToDelete = $this->getLeasingPaymentTransactionss(new Criteria(), $con)->diff($leasingPaymentTransactionss);


        $this->leasingPaymentTransactionssScheduledForDeletion = $leasingPaymentTransactionssToDelete;

        foreach ($leasingPaymentTransactionssToDelete as $leasingPaymentTransactionsRemoved) {
            $leasingPaymentTransactionsRemoved->setLeasingEventBookings(null);
        }

        $this->collLeasingPaymentTransactionss = null;
        foreach ($leasingPaymentTransactionss as $leasingPaymentTransactions) {
            $this->addLeasingPaymentTransactions($leasingPaymentTransactions);
        }

        $this->collLeasingPaymentTransactionss = $leasingPaymentTransactionss;
        $this->collLeasingPaymentTransactionssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingPaymentTransactions objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingPaymentTransactions objects.
     * @throws PropelException
     */
    public function countLeasingPaymentTransactionss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPaymentTransactionssPartial && !$this->isNew();
        if (null === $this->collLeasingPaymentTransactionss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingPaymentTransactionss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingPaymentTransactionss());
            }
            $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingEventBookings($this)
                ->count($con);
        }

        return count($this->collLeasingPaymentTransactionss);
    }

    /**
     * Method called to associate a LeasingPaymentTransactions object to this object
     * through the LeasingPaymentTransactions foreign key attribute.
     *
     * @param    LeasingPaymentTransactions $l LeasingPaymentTransactions
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function addLeasingPaymentTransactions(LeasingPaymentTransactions $l)
    {
        if ($this->collLeasingPaymentTransactionss === null) {
            $this->initLeasingPaymentTransactionss();
            $this->collLeasingPaymentTransactionssPartial = true;
        }

        if (!in_array($l, $this->collLeasingPaymentTransactionss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingPaymentTransactions($l);

            if ($this->leasingPaymentTransactionssScheduledForDeletion and $this->leasingPaymentTransactionssScheduledForDeletion->contains($l)) {
                $this->leasingPaymentTransactionssScheduledForDeletion->remove($this->leasingPaymentTransactionssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingPaymentTransactions $leasingPaymentTransactions The leasingPaymentTransactions object to add.
     */
    protected function doAddLeasingPaymentTransactions($leasingPaymentTransactions)
    {
        $this->collLeasingPaymentTransactionss[]= $leasingPaymentTransactions;
        $leasingPaymentTransactions->setLeasingEventBookings($this);
    }

    /**
     * @param	LeasingPaymentTransactions $leasingPaymentTransactions The leasingPaymentTransactions object to remove.
     * @return LeasingEventBookings The current object (for fluent API support)
     */
    public function removeLeasingPaymentTransactions($leasingPaymentTransactions)
    {
        if ($this->getLeasingPaymentTransactionss()->contains($leasingPaymentTransactions)) {
            $this->collLeasingPaymentTransactionss->remove($this->collLeasingPaymentTransactionss->search($leasingPaymentTransactions));
            if (null === $this->leasingPaymentTransactionssScheduledForDeletion) {
                $this->leasingPaymentTransactionssScheduledForDeletion = clone $this->collLeasingPaymentTransactionss;
                $this->leasingPaymentTransactionssScheduledForDeletion->clear();
            }
            $this->leasingPaymentTransactionssScheduledForDeletion[]= $leasingPaymentTransactions;
            $leasingPaymentTransactions->setLeasingEventBookings(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingEventBookings is new, it will return
     * an empty collection; or if this LeasingEventBookings has previously
     * been saved, it will retrieve related LeasingPaymentTransactionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingEventBookings.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     */
    public function getLeasingPaymentTransactionssJoinLeasingParkingLeads($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
        $query->joinWith('LeasingParkingLeads', $join_behavior);

        return $this->getLeasingPaymentTransactionss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingEventBookings is new, it will return
     * an empty collection; or if this LeasingEventBookings has previously
     * been saved, it will retrieve related LeasingPaymentTransactionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingEventBookings.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     */
    public function getLeasingPaymentTransactionssJoinLeasingBookings($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
        $query->joinWith('LeasingBookings', $join_behavior);

        return $this->getLeasingPaymentTransactionss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->application_number = null;
        $this->event_place_id = null;
        $this->event_place_specific = null;
        $this->event_leads_id = null;
        $this->event_date = null;
        $this->event_start_time = null;
        $this->event_end_time = null;
        $this->date_added = null;
        $this->first_heard = null;
        $this->status = null;
        $this->prev_status = null;
        $this->processing = null;
        $this->processed_by = null;
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
            if ($this->collLeasingEventPaymentDetailss) {
                foreach ($this->collLeasingEventPaymentDetailss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingPaymentTransactionss) {
                foreach ($this->collLeasingPaymentTransactionss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aLeasingEventPlace instanceof Persistent) {
              $this->aLeasingEventPlace->clearAllReferences($deep);
            }
            if ($this->aLeasingEventLeads instanceof Persistent) {
              $this->aLeasingEventLeads->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingEventPaymentDetailss instanceof PropelCollection) {
            $this->collLeasingEventPaymentDetailss->clearIterator();
        }
        $this->collLeasingEventPaymentDetailss = null;
        if ($this->collLeasingPaymentTransactionss instanceof PropelCollection) {
            $this->collLeasingPaymentTransactionss->clearIterator();
        }
        $this->collLeasingPaymentTransactionss = null;
        $this->aLeasingEventPlace = null;
        $this->aLeasingEventLeads = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingEventBookingsPeer::DEFAULT_STRING_FORMAT);
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
