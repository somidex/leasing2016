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
use Leasing\CoreBundle\Model\LeasingAppointmentAssignment;
use Leasing\CoreBundle\Model\LeasingAppointmentAssignmentQuery;
use Leasing\CoreBundle\Model\LeasingAppointmentLeads;
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery;
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingAppointmentsPeer;
use Leasing\CoreBundle\Model\LeasingAppointmentsQuery;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitQuery;

abstract class BaseLeasingAppointments extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingAppointmentsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingAppointmentsPeer
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
     * The value for the appointment_leads_id field.
     * @var        int
     */
    protected $appointment_leads_id;

    /**
     * The value for the unit_id field.
     * @var        int
     */
    protected $unit_id;

    /**
     * The value for the preferred_date field.
     * @var        string
     */
    protected $preferred_date;

    /**
     * The value for the preferred_time field.
     * @var        string
     */
    protected $preferred_time;

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
     * The value for the first_heard field.
     * @var        string
     */
    protected $first_heard;

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
     * @var        LeasingAppointmentLeads
     */
    protected $aLeasingAppointmentLeads;

    /**
     * @var        LeasingUnit
     */
    protected $aLeasingUnit;

    /**
     * @var        PropelObjectCollection|LeasingAppointmentAssignment[] Collection to store aggregation of LeasingAppointmentAssignment objects.
     */
    protected $collLeasingAppointmentAssignments;
    protected $collLeasingAppointmentAssignmentsPartial;

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
    protected $leasingAppointmentAssignmentsScheduledForDeletion = null;

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
     * Get the [appointment_leads_id] column value.
     *
     * @return int
     */
    public function getAppointmentLeadsId()
    {

        return $this->appointment_leads_id;
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
     * Get the [preferred_date] column value.
     *
     * @return string
     */
    public function getPreferredDate()
    {

        return $this->preferred_date;
    }

    /**
     * Get the [preferred_time] column value.
     *
     * @return string
     */
    public function getPreferredTime()
    {

        return $this->preferred_time;
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
     * Get the [first_heard] column value.
     *
     * @return string
     */
    public function getFirstHeard()
    {

        return $this->first_heard;
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
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [appointment_leads_id] column.
     *
     * @param  int $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setAppointmentLeadsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->appointment_leads_id !== $v) {
            $this->appointment_leads_id = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID;
        }

        if ($this->aLeasingAppointmentLeads !== null && $this->aLeasingAppointmentLeads->getId() !== $v) {
            $this->aLeasingAppointmentLeads = null;
        }


        return $this;
    } // setAppointmentLeadsId()

    /**
     * Set the value of [unit_id] column.
     *
     * @param  int $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setUnitId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->unit_id !== $v) {
            $this->unit_id = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::UNIT_ID;
        }

        if ($this->aLeasingUnit !== null && $this->aLeasingUnit->getId() !== $v) {
            $this->aLeasingUnit = null;
        }


        return $this;
    } // setUnitId()

    /**
     * Set the value of [preferred_date] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setPreferredDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->preferred_date !== $v) {
            $this->preferred_date = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::PREFERRED_DATE;
        }


        return $this;
    } // setPreferredDate()

    /**
     * Set the value of [preferred_time] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setPreferredTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->preferred_time !== $v) {
            $this->preferred_time = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::PREFERRED_TIME;
        }


        return $this;
    } // setPreferredTime()

    /**
     * Set the value of [confirmation_code] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setConfirmationCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->confirmation_code !== $v) {
            $this->confirmation_code = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::CONFIRMATION_CODE;
        }


        return $this;
    } // setConfirmationCode()

    /**
     * Set the value of [start_date] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_date !== $v) {
            $this->start_date = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::START_DATE;
        }


        return $this;
    } // setStartDate()

    /**
     * Set the value of [end_date] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_date !== $v) {
            $this->end_date = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::END_DATE;
        }


        return $this;
    } // setEndDate()

    /**
     * Set the value of [first_heard] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setFirstHeard($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_heard !== $v) {
            $this->first_heard = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::FIRST_HEARD;
        }


        return $this;
    } // setFirstHeard()

    /**
     * Set the value of [notes] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::NOTES;
        }


        return $this;
    } // setNotes()

    /**
     * Set the value of [date_added] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_added !== $v) {
            $this->date_added = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::DATE_ADDED;
        }


        return $this;
    } // setDateAdded()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [prev_status] column.
     *
     * @param  int $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setPrevStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->prev_status !== $v) {
            $this->prev_status = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::PREV_STATUS;
        }


        return $this;
    } // setPrevStatus()

    /**
     * Set the value of [processing] column.
     *
     * @param  int $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setProcessing($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->processing !== $v) {
            $this->processing = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::PROCESSING;
        }


        return $this;
    } // setProcessing()

    /**
     * Set the value of [processed_by] column.
     *
     * @param  string $v new value
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setProcessedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->processed_by !== $v) {
            $this->processed_by = $v;
            $this->modifiedColumns[] = LeasingAppointmentsPeer::PROCESSED_BY;
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
            $this->appointment_leads_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->unit_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->preferred_date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->preferred_time = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->confirmation_code = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->start_date = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->end_date = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->first_heard = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->notes = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->date_added = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->status = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->prev_status = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->processing = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->processed_by = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 15; // 15 = LeasingAppointmentsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingAppointments object", $e);
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

        if ($this->aLeasingAppointmentLeads !== null && $this->appointment_leads_id !== $this->aLeasingAppointmentLeads->getId()) {
            $this->aLeasingAppointmentLeads = null;
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
            $con = Propel::getConnection(LeasingAppointmentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingAppointmentsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingAppointmentLeads = null;
            $this->aLeasingUnit = null;
            $this->collLeasingAppointmentAssignments = null;

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
            $con = Propel::getConnection(LeasingAppointmentsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingAppointmentsQuery::create()
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
            $con = Propel::getConnection(LeasingAppointmentsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingAppointmentsPeer::addInstanceToPool($this);
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

            if ($this->aLeasingAppointmentLeads !== null) {
                if ($this->aLeasingAppointmentLeads->isModified() || $this->aLeasingAppointmentLeads->isNew()) {
                    $affectedRows += $this->aLeasingAppointmentLeads->save($con);
                }
                $this->setLeasingAppointmentLeads($this->aLeasingAppointmentLeads);
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

            if ($this->leasingAppointmentAssignmentsScheduledForDeletion !== null) {
                if (!$this->leasingAppointmentAssignmentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingAppointmentAssignmentsScheduledForDeletion as $leasingAppointmentAssignment) {
                        // need to save related object because we set the relation to null
                        $leasingAppointmentAssignment->save($con);
                    }
                    $this->leasingAppointmentAssignmentsScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingAppointmentAssignments !== null) {
                foreach ($this->collLeasingAppointmentAssignments as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingAppointmentsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingAppointmentsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingAppointmentsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`appointment_leads_id`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`unit_id`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::PREFERRED_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`preferred_date`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::PREFERRED_TIME)) {
            $modifiedColumns[':p' . $index++]  = '`preferred_time`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::CONFIRMATION_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`confirmation_code`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::START_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`start_date`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::END_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`end_date`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::FIRST_HEARD)) {
            $modifiedColumns[':p' . $index++]  = '`first_heard`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::NOTES)) {
            $modifiedColumns[':p' . $index++]  = '`notes`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::PREV_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`prev_status`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::PROCESSING)) {
            $modifiedColumns[':p' . $index++]  = '`processing`';
        }
        if ($this->isColumnModified(LeasingAppointmentsPeer::PROCESSED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`processed_by`';
        }

        $sql = sprintf(
            'INSERT INTO `appointments` (%s) VALUES (%s)',
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
                    case '`appointment_leads_id`':
                        $stmt->bindValue($identifier, $this->appointment_leads_id, PDO::PARAM_INT);
                        break;
                    case '`unit_id`':
                        $stmt->bindValue($identifier, $this->unit_id, PDO::PARAM_INT);
                        break;
                    case '`preferred_date`':
                        $stmt->bindValue($identifier, $this->preferred_date, PDO::PARAM_STR);
                        break;
                    case '`preferred_time`':
                        $stmt->bindValue($identifier, $this->preferred_time, PDO::PARAM_STR);
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
                    case '`first_heard`':
                        $stmt->bindValue($identifier, $this->first_heard, PDO::PARAM_STR);
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

            if ($this->aLeasingAppointmentLeads !== null) {
                if (!$this->aLeasingAppointmentLeads->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingAppointmentLeads->getValidationFailures());
                }
            }

            if ($this->aLeasingUnit !== null) {
                if (!$this->aLeasingUnit->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnit->getValidationFailures());
                }
            }


            if (($retval = LeasingAppointmentsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingAppointmentAssignments !== null) {
                    foreach ($this->collLeasingAppointmentAssignments as $referrerFK) {
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
        $pos = LeasingAppointmentsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAppointmentLeadsId();
                break;
            case 2:
                return $this->getUnitId();
                break;
            case 3:
                return $this->getPreferredDate();
                break;
            case 4:
                return $this->getPreferredTime();
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
                return $this->getFirstHeard();
                break;
            case 9:
                return $this->getNotes();
                break;
            case 10:
                return $this->getDateAdded();
                break;
            case 11:
                return $this->getStatus();
                break;
            case 12:
                return $this->getPrevStatus();
                break;
            case 13:
                return $this->getProcessing();
                break;
            case 14:
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
        if (isset($alreadyDumpedObjects['LeasingAppointments'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingAppointments'][$this->getPrimaryKey()] = true;
        $keys = LeasingAppointmentsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAppointmentLeadsId(),
            $keys[2] => $this->getUnitId(),
            $keys[3] => $this->getPreferredDate(),
            $keys[4] => $this->getPreferredTime(),
            $keys[5] => $this->getConfirmationCode(),
            $keys[6] => $this->getStartDate(),
            $keys[7] => $this->getEndDate(),
            $keys[8] => $this->getFirstHeard(),
            $keys[9] => $this->getNotes(),
            $keys[10] => $this->getDateAdded(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getPrevStatus(),
            $keys[13] => $this->getProcessing(),
            $keys[14] => $this->getProcessedBy(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingAppointmentLeads) {
                $result['LeasingAppointmentLeads'] = $this->aLeasingAppointmentLeads->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingUnit) {
                $result['LeasingUnit'] = $this->aLeasingUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLeasingAppointmentAssignments) {
                $result['LeasingAppointmentAssignments'] = $this->collLeasingAppointmentAssignments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingAppointmentsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAppointmentLeadsId($value);
                break;
            case 2:
                $this->setUnitId($value);
                break;
            case 3:
                $this->setPreferredDate($value);
                break;
            case 4:
                $this->setPreferredTime($value);
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
                $this->setFirstHeard($value);
                break;
            case 9:
                $this->setNotes($value);
                break;
            case 10:
                $this->setDateAdded($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setPrevStatus($value);
                break;
            case 13:
                $this->setProcessing($value);
                break;
            case 14:
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
        $keys = LeasingAppointmentsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAppointmentLeadsId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUnitId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPreferredDate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPreferredTime($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setConfirmationCode($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setStartDate($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setEndDate($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setFirstHeard($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setNotes($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setDateAdded($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setStatus($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setPrevStatus($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setProcessing($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setProcessedBy($arr[$keys[14]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingAppointmentsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingAppointmentsPeer::ID)) $criteria->add(LeasingAppointmentsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID)) $criteria->add(LeasingAppointmentsPeer::APPOINTMENT_LEADS_ID, $this->appointment_leads_id);
        if ($this->isColumnModified(LeasingAppointmentsPeer::UNIT_ID)) $criteria->add(LeasingAppointmentsPeer::UNIT_ID, $this->unit_id);
        if ($this->isColumnModified(LeasingAppointmentsPeer::PREFERRED_DATE)) $criteria->add(LeasingAppointmentsPeer::PREFERRED_DATE, $this->preferred_date);
        if ($this->isColumnModified(LeasingAppointmentsPeer::PREFERRED_TIME)) $criteria->add(LeasingAppointmentsPeer::PREFERRED_TIME, $this->preferred_time);
        if ($this->isColumnModified(LeasingAppointmentsPeer::CONFIRMATION_CODE)) $criteria->add(LeasingAppointmentsPeer::CONFIRMATION_CODE, $this->confirmation_code);
        if ($this->isColumnModified(LeasingAppointmentsPeer::START_DATE)) $criteria->add(LeasingAppointmentsPeer::START_DATE, $this->start_date);
        if ($this->isColumnModified(LeasingAppointmentsPeer::END_DATE)) $criteria->add(LeasingAppointmentsPeer::END_DATE, $this->end_date);
        if ($this->isColumnModified(LeasingAppointmentsPeer::FIRST_HEARD)) $criteria->add(LeasingAppointmentsPeer::FIRST_HEARD, $this->first_heard);
        if ($this->isColumnModified(LeasingAppointmentsPeer::NOTES)) $criteria->add(LeasingAppointmentsPeer::NOTES, $this->notes);
        if ($this->isColumnModified(LeasingAppointmentsPeer::DATE_ADDED)) $criteria->add(LeasingAppointmentsPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(LeasingAppointmentsPeer::STATUS)) $criteria->add(LeasingAppointmentsPeer::STATUS, $this->status);
        if ($this->isColumnModified(LeasingAppointmentsPeer::PREV_STATUS)) $criteria->add(LeasingAppointmentsPeer::PREV_STATUS, $this->prev_status);
        if ($this->isColumnModified(LeasingAppointmentsPeer::PROCESSING)) $criteria->add(LeasingAppointmentsPeer::PROCESSING, $this->processing);
        if ($this->isColumnModified(LeasingAppointmentsPeer::PROCESSED_BY)) $criteria->add(LeasingAppointmentsPeer::PROCESSED_BY, $this->processed_by);

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
        $criteria = new Criteria(LeasingAppointmentsPeer::DATABASE_NAME);
        $criteria->add(LeasingAppointmentsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingAppointments (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAppointmentLeadsId($this->getAppointmentLeadsId());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setPreferredDate($this->getPreferredDate());
        $copyObj->setPreferredTime($this->getPreferredTime());
        $copyObj->setConfirmationCode($this->getConfirmationCode());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setFirstHeard($this->getFirstHeard());
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

            foreach ($this->getLeasingAppointmentAssignments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingAppointmentAssignment($relObj->copy($deepCopy));
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
     * @return LeasingAppointments Clone of current object.
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
     * @return LeasingAppointmentsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingAppointmentsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingAppointmentLeads object.
     *
     * @param                  LeasingAppointmentLeads $v
     * @return LeasingAppointments The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingAppointmentLeads(LeasingAppointmentLeads $v = null)
    {
        if ($v === null) {
            $this->setAppointmentLeadsId(NULL);
        } else {
            $this->setAppointmentLeadsId($v->getId());
        }

        $this->aLeasingAppointmentLeads = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingAppointmentLeads object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingAppointments($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingAppointmentLeads object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingAppointmentLeads The associated LeasingAppointmentLeads object.
     * @throws PropelException
     */
    public function getLeasingAppointmentLeads(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingAppointmentLeads === null && ($this->appointment_leads_id !== null) && $doQuery) {
            $this->aLeasingAppointmentLeads = LeasingAppointmentLeadsQuery::create()->findPk($this->appointment_leads_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingAppointmentLeads->addLeasingAppointmentss($this);
             */
        }

        return $this->aLeasingAppointmentLeads;
    }

    /**
     * Declares an association between this object and a LeasingUnit object.
     *
     * @param                  LeasingUnit $v
     * @return LeasingAppointments The current object (for fluent API support)
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
            $v->addLeasingAppointments($this);
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
                $this->aLeasingUnit->addLeasingAppointmentss($this);
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
        if ('LeasingAppointmentAssignment' == $relationName) {
            $this->initLeasingAppointmentAssignments();
        }
    }

    /**
     * Clears out the collLeasingAppointmentAssignments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingAppointments The current object (for fluent API support)
     * @see        addLeasingAppointmentAssignments()
     */
    public function clearLeasingAppointmentAssignments()
    {
        $this->collLeasingAppointmentAssignments = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingAppointmentAssignmentsPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingAppointmentAssignments collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingAppointmentAssignments($v = true)
    {
        $this->collLeasingAppointmentAssignmentsPartial = $v;
    }

    /**
     * Initializes the collLeasingAppointmentAssignments collection.
     *
     * By default this just sets the collLeasingAppointmentAssignments collection to an empty array (like clearcollLeasingAppointmentAssignments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingAppointmentAssignments($overrideExisting = true)
    {
        if (null !== $this->collLeasingAppointmentAssignments && !$overrideExisting) {
            return;
        }
        $this->collLeasingAppointmentAssignments = new PropelObjectCollection();
        $this->collLeasingAppointmentAssignments->setModel('LeasingAppointmentAssignment');
    }

    /**
     * Gets an array of LeasingAppointmentAssignment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingAppointments is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingAppointmentAssignment[] List of LeasingAppointmentAssignment objects
     * @throws PropelException
     */
    public function getLeasingAppointmentAssignments($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentAssignmentsPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentAssignments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentAssignments) {
                // return empty collection
                $this->initLeasingAppointmentAssignments();
            } else {
                $collLeasingAppointmentAssignments = LeasingAppointmentAssignmentQuery::create(null, $criteria)
                    ->filterByLeasingAppointments($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingAppointmentAssignmentsPartial && count($collLeasingAppointmentAssignments)) {
                      $this->initLeasingAppointmentAssignments(false);

                      foreach ($collLeasingAppointmentAssignments as $obj) {
                        if (false == $this->collLeasingAppointmentAssignments->contains($obj)) {
                          $this->collLeasingAppointmentAssignments->append($obj);
                        }
                      }

                      $this->collLeasingAppointmentAssignmentsPartial = true;
                    }

                    $collLeasingAppointmentAssignments->getInternalIterator()->rewind();

                    return $collLeasingAppointmentAssignments;
                }

                if ($partial && $this->collLeasingAppointmentAssignments) {
                    foreach ($this->collLeasingAppointmentAssignments as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingAppointmentAssignments[] = $obj;
                        }
                    }
                }

                $this->collLeasingAppointmentAssignments = $collLeasingAppointmentAssignments;
                $this->collLeasingAppointmentAssignmentsPartial = false;
            }
        }

        return $this->collLeasingAppointmentAssignments;
    }

    /**
     * Sets a collection of LeasingAppointmentAssignment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingAppointmentAssignments A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function setLeasingAppointmentAssignments(PropelCollection $leasingAppointmentAssignments, PropelPDO $con = null)
    {
        $leasingAppointmentAssignmentsToDelete = $this->getLeasingAppointmentAssignments(new Criteria(), $con)->diff($leasingAppointmentAssignments);


        $this->leasingAppointmentAssignmentsScheduledForDeletion = $leasingAppointmentAssignmentsToDelete;

        foreach ($leasingAppointmentAssignmentsToDelete as $leasingAppointmentAssignmentRemoved) {
            $leasingAppointmentAssignmentRemoved->setLeasingAppointments(null);
        }

        $this->collLeasingAppointmentAssignments = null;
        foreach ($leasingAppointmentAssignments as $leasingAppointmentAssignment) {
            $this->addLeasingAppointmentAssignment($leasingAppointmentAssignment);
        }

        $this->collLeasingAppointmentAssignments = $leasingAppointmentAssignments;
        $this->collLeasingAppointmentAssignmentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingAppointmentAssignment objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingAppointmentAssignment objects.
     * @throws PropelException
     */
    public function countLeasingAppointmentAssignments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentAssignmentsPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentAssignments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentAssignments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingAppointmentAssignments());
            }
            $query = LeasingAppointmentAssignmentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingAppointments($this)
                ->count($con);
        }

        return count($this->collLeasingAppointmentAssignments);
    }

    /**
     * Method called to associate a LeasingAppointmentAssignment object to this object
     * through the LeasingAppointmentAssignment foreign key attribute.
     *
     * @param    LeasingAppointmentAssignment $l LeasingAppointmentAssignment
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function addLeasingAppointmentAssignment(LeasingAppointmentAssignment $l)
    {
        if ($this->collLeasingAppointmentAssignments === null) {
            $this->initLeasingAppointmentAssignments();
            $this->collLeasingAppointmentAssignmentsPartial = true;
        }

        if (!in_array($l, $this->collLeasingAppointmentAssignments->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingAppointmentAssignment($l);

            if ($this->leasingAppointmentAssignmentsScheduledForDeletion and $this->leasingAppointmentAssignmentsScheduledForDeletion->contains($l)) {
                $this->leasingAppointmentAssignmentsScheduledForDeletion->remove($this->leasingAppointmentAssignmentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingAppointmentAssignment $leasingAppointmentAssignment The leasingAppointmentAssignment object to add.
     */
    protected function doAddLeasingAppointmentAssignment($leasingAppointmentAssignment)
    {
        $this->collLeasingAppointmentAssignments[]= $leasingAppointmentAssignment;
        $leasingAppointmentAssignment->setLeasingAppointments($this);
    }

    /**
     * @param	LeasingAppointmentAssignment $leasingAppointmentAssignment The leasingAppointmentAssignment object to remove.
     * @return LeasingAppointments The current object (for fluent API support)
     */
    public function removeLeasingAppointmentAssignment($leasingAppointmentAssignment)
    {
        if ($this->getLeasingAppointmentAssignments()->contains($leasingAppointmentAssignment)) {
            $this->collLeasingAppointmentAssignments->remove($this->collLeasingAppointmentAssignments->search($leasingAppointmentAssignment));
            if (null === $this->leasingAppointmentAssignmentsScheduledForDeletion) {
                $this->leasingAppointmentAssignmentsScheduledForDeletion = clone $this->collLeasingAppointmentAssignments;
                $this->leasingAppointmentAssignmentsScheduledForDeletion->clear();
            }
            $this->leasingAppointmentAssignmentsScheduledForDeletion[]= $leasingAppointmentAssignment;
            $leasingAppointmentAssignment->setLeasingAppointments(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingAppointments is new, it will return
     * an empty collection; or if this LeasingAppointments has previously
     * been saved, it will retrieve related LeasingAppointmentAssignments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingAppointments.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingAppointmentAssignment[] List of LeasingAppointmentAssignment objects
     */
    public function getLeasingAppointmentAssignmentsJoinLeasingSpecialist($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingAppointmentAssignmentQuery::create(null, $criteria);
        $query->joinWith('LeasingSpecialist', $join_behavior);

        return $this->getLeasingAppointmentAssignments($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->appointment_leads_id = null;
        $this->unit_id = null;
        $this->preferred_date = null;
        $this->preferred_time = null;
        $this->confirmation_code = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->first_heard = null;
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
            if ($this->collLeasingAppointmentAssignments) {
                foreach ($this->collLeasingAppointmentAssignments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aLeasingAppointmentLeads instanceof Persistent) {
              $this->aLeasingAppointmentLeads->clearAllReferences($deep);
            }
            if ($this->aLeasingUnit instanceof Persistent) {
              $this->aLeasingUnit->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingAppointmentAssignments instanceof PropelCollection) {
            $this->collLeasingAppointmentAssignments->clearIterator();
        }
        $this->collLeasingAppointmentAssignments = null;
        $this->aLeasingAppointmentLeads = null;
        $this->aLeasingUnit = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingAppointmentsPeer::DEFAULT_STRING_FORMAT);
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
