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
use Leasing\CoreBundle\Model\LeasingBookingAssignment;
use Leasing\CoreBundle\Model\LeasingBookingAssignmentQuery;
use Leasing\CoreBundle\Model\LeasingBookingLeads;
use Leasing\CoreBundle\Model\LeasingBookingLeadsQuery;
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingBookingsPeer;
use Leasing\CoreBundle\Model\LeasingBookingsQuery;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitQuery;

abstract class BaseLeasingBookings extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingBookingsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingBookingsPeer
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
     * The value for the booking_leads_id field.
     * @var        int
     */
    protected $booking_leads_id;

    /**
     * The value for the unit_id field.
     * @var        int
     */
    protected $unit_id;

    /**
     * The value for the check_in field.
     * @var        string
     */
    protected $check_in;

    /**
     * The value for the check_out field.
     * @var        string
     */
    protected $check_out;

    /**
     * The value for the confirmation_code field.
     * @var        string
     */
    protected $confirmation_code;

    /**
     * The value for the start_date field.
     * @var        string
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     * @var        string
     */
    protected $end_date;

    /**
     * The value for the notes field.
     * @var        string
     */
    protected $notes;

    /**
     * The value for the date_added field.
     * @var        string
     */
    protected $date_added;

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
     * @var        LeasingBookingLeads
     */
    protected $aLeasingBookingLeads;

    /**
     * @var        LeasingUnit
     */
    protected $aLeasingUnit;

    /**
     * @var        PropelObjectCollection|LeasingBookingAssignment[] Collection to store aggregation of LeasingBookingAssignment objects.
     */
    protected $collLeasingBookingAssignments;
    protected $collLeasingBookingAssignmentsPartial;

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
    protected $leasingBookingAssignmentsScheduledForDeletion = null;

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
     * Get the [booking_leads_id] column value.
     *
     * @return int
     */
    public function getBookingLeadsId()
    {

        return $this->booking_leads_id;
    }

    /**
     * Get the [unit_id] column value.
     *
     * @return int
     */
    public function getUnitId()
    {

        return $this->unit_id;
    }

    /**
     * Get the [check_in] column value.
     *
     * @return string
     */
    public function getCheckIn()
    {

        return $this->check_in;
    }

    /**
     * Get the [check_out] column value.
     *
     * @return string
     */
    public function getCheckOut()
    {

        return $this->check_out;
    }

    /**
     * Get the [confirmation_code] column value.
     *
     * @return string
     */
    public function getConfirmationCode()
    {

        return $this->confirmation_code;
    }

    /**
     * Get the [start_date] column value.
     *
     * @return string
     */
    public function getStartDate()
    {

        return $this->start_date;
    }

    /**
     * Get the [end_date] column value.
     *
     * @return string
     */
    public function getEndDate()
    {

        return $this->end_date;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string
     */
    public function getNotes()
    {

        return $this->notes;
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
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [booking_leads_id] column.
     *
     * @param  int $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setBookingLeadsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->booking_leads_id !== $v) {
            $this->booking_leads_id = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::BOOKING_LEADS_ID;
        }

        if ($this->aLeasingBookingLeads !== null && $this->aLeasingBookingLeads->getId() !== $v) {
            $this->aLeasingBookingLeads = null;
        }


        return $this;
    } // setBookingLeadsId()

    /**
     * Set the value of [unit_id] column.
     *
     * @param  int $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setUnitId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->unit_id !== $v) {
            $this->unit_id = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::UNIT_ID;
        }

        if ($this->aLeasingUnit !== null && $this->aLeasingUnit->getId() !== $v) {
            $this->aLeasingUnit = null;
        }


        return $this;
    } // setUnitId()

    /**
     * Set the value of [check_in] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setCheckIn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->check_in !== $v) {
            $this->check_in = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::CHECK_IN;
        }


        return $this;
    } // setCheckIn()

    /**
     * Set the value of [check_out] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setCheckOut($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->check_out !== $v) {
            $this->check_out = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::CHECK_OUT;
        }


        return $this;
    } // setCheckOut()

    /**
     * Set the value of [confirmation_code] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setConfirmationCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->confirmation_code !== $v) {
            $this->confirmation_code = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::CONFIRMATION_CODE;
        }


        return $this;
    } // setConfirmationCode()

    /**
     * Set the value of [start_date] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_date !== $v) {
            $this->start_date = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::START_DATE;
        }


        return $this;
    } // setStartDate()

    /**
     * Set the value of [end_date] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_date !== $v) {
            $this->end_date = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::END_DATE;
        }


        return $this;
    } // setEndDate()

    /**
     * Set the value of [notes] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::NOTES;
        }


        return $this;
    } // setNotes()

    /**
     * Set the value of [date_added] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_added !== $v) {
            $this->date_added = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::DATE_ADDED;
        }


        return $this;
    } // setDateAdded()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [prev_status] column.
     *
     * @param  int $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setPrevStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->prev_status !== $v) {
            $this->prev_status = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::PREV_STATUS;
        }


        return $this;
    } // setPrevStatus()

    /**
     * Set the value of [processing] column.
     *
     * @param  int $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setProcessing($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->processing !== $v) {
            $this->processing = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::PROCESSING;
        }


        return $this;
    } // setProcessing()

    /**
     * Set the value of [processed_by] column.
     *
     * @param  string $v new value
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setProcessedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->processed_by !== $v) {
            $this->processed_by = $v;
            $this->modifiedColumns[] = LeasingBookingsPeer::PROCESSED_BY;
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
            $this->booking_leads_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->unit_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->check_in = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->check_out = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->confirmation_code = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->start_date = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->end_date = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->notes = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->date_added = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
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

            return $startcol + 14; // 14 = LeasingBookingsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingBookings object", $e);
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

        if ($this->aLeasingBookingLeads !== null && $this->booking_leads_id !== $this->aLeasingBookingLeads->getId()) {
            $this->aLeasingBookingLeads = null;
        }
        if ($this->aLeasingUnit !== null && $this->unit_id !== $this->aLeasingUnit->getId()) {
            $this->aLeasingUnit = null;
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
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingBookingsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingBookingLeads = null;
            $this->aLeasingUnit = null;
            $this->collLeasingBookingAssignments = null;

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
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingBookingsQuery::create()
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
            $con = Propel::getConnection(LeasingBookingsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingBookingsPeer::addInstanceToPool($this);
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

            if ($this->aLeasingBookingLeads !== null) {
                if ($this->aLeasingBookingLeads->isModified() || $this->aLeasingBookingLeads->isNew()) {
                    $affectedRows += $this->aLeasingBookingLeads->save($con);
                }
                $this->setLeasingBookingLeads($this->aLeasingBookingLeads);
            }

            if ($this->aLeasingUnit !== null) {
                if ($this->aLeasingUnit->isModified() || $this->aLeasingUnit->isNew()) {
                    $affectedRows += $this->aLeasingUnit->save($con);
                }
                $this->setLeasingUnit($this->aLeasingUnit);
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

            if ($this->leasingBookingAssignmentsScheduledForDeletion !== null) {
                if (!$this->leasingBookingAssignmentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingBookingAssignmentsScheduledForDeletion as $leasingBookingAssignment) {
                        // need to save related object because we set the relation to null
                        $leasingBookingAssignment->save($con);
                    }
                    $this->leasingBookingAssignmentsScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingBookingAssignments !== null) {
                foreach ($this->collLeasingBookingAssignments as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingBookingsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingBookingsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingBookingsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::BOOKING_LEADS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`booking_leads_id`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`unit_id`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::CHECK_IN)) {
            $modifiedColumns[':p' . $index++]  = '`check_in`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::CHECK_OUT)) {
            $modifiedColumns[':p' . $index++]  = '`check_out`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::CONFIRMATION_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`confirmation_code`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::START_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`start_date`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::END_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`end_date`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::NOTES)) {
            $modifiedColumns[':p' . $index++]  = '`notes`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::PREV_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`prev_status`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::PROCESSING)) {
            $modifiedColumns[':p' . $index++]  = '`processing`';
        }
        if ($this->isColumnModified(LeasingBookingsPeer::PROCESSED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`processed_by`';
        }

        $sql = sprintf(
            'INSERT INTO `bookings` (%s) VALUES (%s)',
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
                    case '`booking_leads_id`':
                        $stmt->bindValue($identifier, $this->booking_leads_id, PDO::PARAM_INT);
                        break;
                    case '`unit_id`':
                        $stmt->bindValue($identifier, $this->unit_id, PDO::PARAM_INT);
                        break;
                    case '`check_in`':
                        $stmt->bindValue($identifier, $this->check_in, PDO::PARAM_STR);
                        break;
                    case '`check_out`':
                        $stmt->bindValue($identifier, $this->check_out, PDO::PARAM_STR);
                        break;
                    case '`confirmation_code`':
                        $stmt->bindValue($identifier, $this->confirmation_code, PDO::PARAM_STR);
                        break;
                    case '`start_date`':
                        $stmt->bindValue($identifier, $this->start_date, PDO::PARAM_STR);
                        break;
                    case '`end_date`':
                        $stmt->bindValue($identifier, $this->end_date, PDO::PARAM_STR);
                        break;
                    case '`notes`':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);
                        break;
                    case '`date_added`':
                        $stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
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

            if ($this->aLeasingBookingLeads !== null) {
                if (!$this->aLeasingBookingLeads->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingBookingLeads->getValidationFailures());
                }
            }

            if ($this->aLeasingUnit !== null) {
                if (!$this->aLeasingUnit->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnit->getValidationFailures());
                }
            }


            if (($retval = LeasingBookingsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingBookingAssignments !== null) {
                    foreach ($this->collLeasingBookingAssignments as $referrerFK) {
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
        $pos = LeasingBookingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getBookingLeadsId();
                break;
            case 2:
                return $this->getUnitId();
                break;
            case 3:
                return $this->getCheckIn();
                break;
            case 4:
                return $this->getCheckOut();
                break;
            case 5:
                return $this->getConfirmationCode();
                break;
            case 6:
                return $this->getStartDate();
                break;
            case 7:
                return $this->getEndDate();
                break;
            case 8:
                return $this->getNotes();
                break;
            case 9:
                return $this->getDateAdded();
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
        if (isset($alreadyDumpedObjects['LeasingBookings'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingBookings'][$this->getPrimaryKey()] = true;
        $keys = LeasingBookingsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBookingLeadsId(),
            $keys[2] => $this->getUnitId(),
            $keys[3] => $this->getCheckIn(),
            $keys[4] => $this->getCheckOut(),
            $keys[5] => $this->getConfirmationCode(),
            $keys[6] => $this->getStartDate(),
            $keys[7] => $this->getEndDate(),
            $keys[8] => $this->getNotes(),
            $keys[9] => $this->getDateAdded(),
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
            if (null !== $this->aLeasingBookingLeads) {
                $result['LeasingBookingLeads'] = $this->aLeasingBookingLeads->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingUnit) {
                $result['LeasingUnit'] = $this->aLeasingUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLeasingBookingAssignments) {
                $result['LeasingBookingAssignments'] = $this->collLeasingBookingAssignments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingBookingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setBookingLeadsId($value);
                break;
            case 2:
                $this->setUnitId($value);
                break;
            case 3:
                $this->setCheckIn($value);
                break;
            case 4:
                $this->setCheckOut($value);
                break;
            case 5:
                $this->setConfirmationCode($value);
                break;
            case 6:
                $this->setStartDate($value);
                break;
            case 7:
                $this->setEndDate($value);
                break;
            case 8:
                $this->setNotes($value);
                break;
            case 9:
                $this->setDateAdded($value);
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
        $keys = LeasingBookingsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setBookingLeadsId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUnitId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCheckIn($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCheckOut($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setConfirmationCode($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setStartDate($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setEndDate($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setNotes($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setDateAdded($arr[$keys[9]]);
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
        $criteria = new Criteria(LeasingBookingsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingBookingsPeer::ID)) $criteria->add(LeasingBookingsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingBookingsPeer::BOOKING_LEADS_ID)) $criteria->add(LeasingBookingsPeer::BOOKING_LEADS_ID, $this->booking_leads_id);
        if ($this->isColumnModified(LeasingBookingsPeer::UNIT_ID)) $criteria->add(LeasingBookingsPeer::UNIT_ID, $this->unit_id);
        if ($this->isColumnModified(LeasingBookingsPeer::CHECK_IN)) $criteria->add(LeasingBookingsPeer::CHECK_IN, $this->check_in);
        if ($this->isColumnModified(LeasingBookingsPeer::CHECK_OUT)) $criteria->add(LeasingBookingsPeer::CHECK_OUT, $this->check_out);
        if ($this->isColumnModified(LeasingBookingsPeer::CONFIRMATION_CODE)) $criteria->add(LeasingBookingsPeer::CONFIRMATION_CODE, $this->confirmation_code);
        if ($this->isColumnModified(LeasingBookingsPeer::START_DATE)) $criteria->add(LeasingBookingsPeer::START_DATE, $this->start_date);
        if ($this->isColumnModified(LeasingBookingsPeer::END_DATE)) $criteria->add(LeasingBookingsPeer::END_DATE, $this->end_date);
        if ($this->isColumnModified(LeasingBookingsPeer::NOTES)) $criteria->add(LeasingBookingsPeer::NOTES, $this->notes);
        if ($this->isColumnModified(LeasingBookingsPeer::DATE_ADDED)) $criteria->add(LeasingBookingsPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(LeasingBookingsPeer::STATUS)) $criteria->add(LeasingBookingsPeer::STATUS, $this->status);
        if ($this->isColumnModified(LeasingBookingsPeer::PREV_STATUS)) $criteria->add(LeasingBookingsPeer::PREV_STATUS, $this->prev_status);
        if ($this->isColumnModified(LeasingBookingsPeer::PROCESSING)) $criteria->add(LeasingBookingsPeer::PROCESSING, $this->processing);
        if ($this->isColumnModified(LeasingBookingsPeer::PROCESSED_BY)) $criteria->add(LeasingBookingsPeer::PROCESSED_BY, $this->processed_by);

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
        $criteria = new Criteria(LeasingBookingsPeer::DATABASE_NAME);
        $criteria->add(LeasingBookingsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingBookings (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBookingLeadsId($this->getBookingLeadsId());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setCheckIn($this->getCheckIn());
        $copyObj->setCheckOut($this->getCheckOut());
        $copyObj->setConfirmationCode($this->getConfirmationCode());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setDateAdded($this->getDateAdded());
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

            foreach ($this->getLeasingBookingAssignments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingBookingAssignment($relObj->copy($deepCopy));
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
     * @return LeasingBookings Clone of current object.
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
     * @return LeasingBookingsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingBookingsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingBookingLeads object.
     *
     * @param                  LeasingBookingLeads $v
     * @return LeasingBookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingBookingLeads(LeasingBookingLeads $v = null)
    {
        if ($v === null) {
            $this->setBookingLeadsId(NULL);
        } else {
            $this->setBookingLeadsId($v->getId());
        }

        $this->aLeasingBookingLeads = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingBookingLeads object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingBookings($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingBookingLeads object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingBookingLeads The associated LeasingBookingLeads object.
     * @throws PropelException
     */
    public function getLeasingBookingLeads(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingBookingLeads === null && ($this->booking_leads_id !== null) && $doQuery) {
            $this->aLeasingBookingLeads = LeasingBookingLeadsQuery::create()->findPk($this->booking_leads_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingBookingLeads->addLeasingBookingss($this);
             */
        }

        return $this->aLeasingBookingLeads;
    }

    /**
     * Declares an association between this object and a LeasingUnit object.
     *
     * @param                  LeasingUnit $v
     * @return LeasingBookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingUnit(LeasingUnit $v = null)
    {
        if ($v === null) {
            $this->setUnitId(NULL);
        } else {
            $this->setUnitId($v->getId());
        }

        $this->aLeasingUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingBookings($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingUnit object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingUnit The associated LeasingUnit object.
     * @throws PropelException
     */
    public function getLeasingUnit(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingUnit === null && ($this->unit_id !== null) && $doQuery) {
            $this->aLeasingUnit = LeasingUnitQuery::create()->findPk($this->unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingUnit->addLeasingBookingss($this);
             */
        }

        return $this->aLeasingUnit;
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
        if ('LeasingBookingAssignment' == $relationName) {
            $this->initLeasingBookingAssignments();
        }
        if ('LeasingPaymentTransactions' == $relationName) {
            $this->initLeasingPaymentTransactionss();
        }
    }

    /**
     * Clears out the collLeasingBookingAssignments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingBookings The current object (for fluent API support)
     * @see        addLeasingBookingAssignments()
     */
    public function clearLeasingBookingAssignments()
    {
        $this->collLeasingBookingAssignments = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingBookingAssignmentsPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingBookingAssignments collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingBookingAssignments($v = true)
    {
        $this->collLeasingBookingAssignmentsPartial = $v;
    }

    /**
     * Initializes the collLeasingBookingAssignments collection.
     *
     * By default this just sets the collLeasingBookingAssignments collection to an empty array (like clearcollLeasingBookingAssignments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingBookingAssignments($overrideExisting = true)
    {
        if (null !== $this->collLeasingBookingAssignments && !$overrideExisting) {
            return;
        }
        $this->collLeasingBookingAssignments = new PropelObjectCollection();
        $this->collLeasingBookingAssignments->setModel('LeasingBookingAssignment');
    }

    /**
     * Gets an array of LeasingBookingAssignment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingBookings is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingBookingAssignment[] List of LeasingBookingAssignment objects
     * @throws PropelException
     */
    public function getLeasingBookingAssignments($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingBookingAssignmentsPartial && !$this->isNew();
        if (null === $this->collLeasingBookingAssignments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingBookingAssignments) {
                // return empty collection
                $this->initLeasingBookingAssignments();
            } else {
                $collLeasingBookingAssignments = LeasingBookingAssignmentQuery::create(null, $criteria)
                    ->filterByLeasingBookings($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingBookingAssignmentsPartial && count($collLeasingBookingAssignments)) {
                      $this->initLeasingBookingAssignments(false);

                      foreach ($collLeasingBookingAssignments as $obj) {
                        if (false == $this->collLeasingBookingAssignments->contains($obj)) {
                          $this->collLeasingBookingAssignments->append($obj);
                        }
                      }

                      $this->collLeasingBookingAssignmentsPartial = true;
                    }

                    $collLeasingBookingAssignments->getInternalIterator()->rewind();

                    return $collLeasingBookingAssignments;
                }

                if ($partial && $this->collLeasingBookingAssignments) {
                    foreach ($this->collLeasingBookingAssignments as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingBookingAssignments[] = $obj;
                        }
                    }
                }

                $this->collLeasingBookingAssignments = $collLeasingBookingAssignments;
                $this->collLeasingBookingAssignmentsPartial = false;
            }
        }

        return $this->collLeasingBookingAssignments;
    }

    /**
     * Sets a collection of LeasingBookingAssignment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingBookingAssignments A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setLeasingBookingAssignments(PropelCollection $leasingBookingAssignments, PropelPDO $con = null)
    {
        $leasingBookingAssignmentsToDelete = $this->getLeasingBookingAssignments(new Criteria(), $con)->diff($leasingBookingAssignments);


        $this->leasingBookingAssignmentsScheduledForDeletion = $leasingBookingAssignmentsToDelete;

        foreach ($leasingBookingAssignmentsToDelete as $leasingBookingAssignmentRemoved) {
            $leasingBookingAssignmentRemoved->setLeasingBookings(null);
        }

        $this->collLeasingBookingAssignments = null;
        foreach ($leasingBookingAssignments as $leasingBookingAssignment) {
            $this->addLeasingBookingAssignment($leasingBookingAssignment);
        }

        $this->collLeasingBookingAssignments = $leasingBookingAssignments;
        $this->collLeasingBookingAssignmentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingBookingAssignment objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingBookingAssignment objects.
     * @throws PropelException
     */
    public function countLeasingBookingAssignments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingBookingAssignmentsPartial && !$this->isNew();
        if (null === $this->collLeasingBookingAssignments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingBookingAssignments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingBookingAssignments());
            }
            $query = LeasingBookingAssignmentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingBookings($this)
                ->count($con);
        }

        return count($this->collLeasingBookingAssignments);
    }

    /**
     * Method called to associate a LeasingBookingAssignment object to this object
     * through the LeasingBookingAssignment foreign key attribute.
     *
     * @param    LeasingBookingAssignment $l LeasingBookingAssignment
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function addLeasingBookingAssignment(LeasingBookingAssignment $l)
    {
        if ($this->collLeasingBookingAssignments === null) {
            $this->initLeasingBookingAssignments();
            $this->collLeasingBookingAssignmentsPartial = true;
        }

        if (!in_array($l, $this->collLeasingBookingAssignments->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingBookingAssignment($l);

            if ($this->leasingBookingAssignmentsScheduledForDeletion and $this->leasingBookingAssignmentsScheduledForDeletion->contains($l)) {
                $this->leasingBookingAssignmentsScheduledForDeletion->remove($this->leasingBookingAssignmentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingBookingAssignment $leasingBookingAssignment The leasingBookingAssignment object to add.
     */
    protected function doAddLeasingBookingAssignment($leasingBookingAssignment)
    {
        $this->collLeasingBookingAssignments[]= $leasingBookingAssignment;
        $leasingBookingAssignment->setLeasingBookings($this);
    }

    /**
     * @param	LeasingBookingAssignment $leasingBookingAssignment The leasingBookingAssignment object to remove.
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function removeLeasingBookingAssignment($leasingBookingAssignment)
    {
        if ($this->getLeasingBookingAssignments()->contains($leasingBookingAssignment)) {
            $this->collLeasingBookingAssignments->remove($this->collLeasingBookingAssignments->search($leasingBookingAssignment));
            if (null === $this->leasingBookingAssignmentsScheduledForDeletion) {
                $this->leasingBookingAssignmentsScheduledForDeletion = clone $this->collLeasingBookingAssignments;
                $this->leasingBookingAssignmentsScheduledForDeletion->clear();
            }
            $this->leasingBookingAssignmentsScheduledForDeletion[]= $leasingBookingAssignment;
            $leasingBookingAssignment->setLeasingBookings(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingBookings is new, it will return
     * an empty collection; or if this LeasingBookings has previously
     * been saved, it will retrieve related LeasingBookingAssignments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingBookings.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingBookingAssignment[] List of LeasingBookingAssignment objects
     */
    public function getLeasingBookingAssignmentsJoinLeasingSpecialist($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingBookingAssignmentQuery::create(null, $criteria);
        $query->joinWith('LeasingSpecialist', $join_behavior);

        return $this->getLeasingBookingAssignments($query, $con);
    }

    /**
     * Clears out the collLeasingPaymentTransactionss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingBookings The current object (for fluent API support)
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
     * If this LeasingBookings is new, it will return
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
                    ->filterByLeasingBookings($this)
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
     * @return LeasingBookings The current object (for fluent API support)
     */
    public function setLeasingPaymentTransactionss(PropelCollection $leasingPaymentTransactionss, PropelPDO $con = null)
    {
        $leasingPaymentTransactionssToDelete = $this->getLeasingPaymentTransactionss(new Criteria(), $con)->diff($leasingPaymentTransactionss);


        $this->leasingPaymentTransactionssScheduledForDeletion = $leasingPaymentTransactionssToDelete;

        foreach ($leasingPaymentTransactionssToDelete as $leasingPaymentTransactionsRemoved) {
            $leasingPaymentTransactionsRemoved->setLeasingBookings(null);
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
                ->filterByLeasingBookings($this)
                ->count($con);
        }

        return count($this->collLeasingPaymentTransactionss);
    }

    /**
     * Method called to associate a LeasingPaymentTransactions object to this object
     * through the LeasingPaymentTransactions foreign key attribute.
     *
     * @param    LeasingPaymentTransactions $l LeasingPaymentTransactions
     * @return LeasingBookings The current object (for fluent API support)
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
        $leasingPaymentTransactions->setLeasingBookings($this);
    }

    /**
     * @param	LeasingPaymentTransactions $leasingPaymentTransactions The leasingPaymentTransactions object to remove.
     * @return LeasingBookings The current object (for fluent API support)
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
            $leasingPaymentTransactions->setLeasingBookings(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingBookings is new, it will return
     * an empty collection; or if this LeasingBookings has previously
     * been saved, it will retrieve related LeasingPaymentTransactionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingBookings.
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
     * Otherwise if this LeasingBookings is new, it will return
     * an empty collection; or if this LeasingBookings has previously
     * been saved, it will retrieve related LeasingPaymentTransactionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingBookings.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     */
    public function getLeasingPaymentTransactionssJoinLeasingEventBookings($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
        $query->joinWith('LeasingEventBookings', $join_behavior);

        return $this->getLeasingPaymentTransactionss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->booking_leads_id = null;
        $this->unit_id = null;
        $this->check_in = null;
        $this->check_out = null;
        $this->confirmation_code = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->notes = null;
        $this->date_added = null;
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
            if ($this->collLeasingBookingAssignments) {
                foreach ($this->collLeasingBookingAssignments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingPaymentTransactionss) {
                foreach ($this->collLeasingPaymentTransactionss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aLeasingBookingLeads instanceof Persistent) {
              $this->aLeasingBookingLeads->clearAllReferences($deep);
            }
            if ($this->aLeasingUnit instanceof Persistent) {
              $this->aLeasingUnit->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingBookingAssignments instanceof PropelCollection) {
            $this->collLeasingBookingAssignments->clearIterator();
        }
        $this->collLeasingBookingAssignments = null;
        if ($this->collLeasingPaymentTransactionss instanceof PropelCollection) {
            $this->collLeasingPaymentTransactionss->clearIterator();
        }
        $this->collLeasingPaymentTransactionss = null;
        $this->aLeasingBookingLeads = null;
        $this->aLeasingUnit = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingBookingsPeer::DEFAULT_STRING_FORMAT);
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
