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
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingBookingsQuery;
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventBookingsQuery;
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingParkingLeadsQuery;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsPeer;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery;
use Leasing\CoreBundle\Model\LeasingPaymentValidity;
use Leasing\CoreBundle\Model\LeasingPaymentValidityQuery;

abstract class BaseLeasingPaymentTransactions extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingPaymentTransactionsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingPaymentTransactionsPeer
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
     * The value for the transaction_type field.
     * @var        int
     */
    protected $transaction_type;

    /**
     * The value for the transaction_date field.
     * @var        string
     */
    protected $transaction_date;

    /**
     * The value for the transaction_code field.
     * @var        string
     */
    protected $transaction_code;

    /**
     * The value for the transaction_cost field.
     * @var        double
     */
    protected $transaction_cost;

    /**
     * The value for the tax field.
     * @var        double
     */
    protected $tax;

    /**
     * The value for the fee field.
     * @var        double
     */
    protected $fee;

    /**
     * The value for the amount_paid field.
     * @var        double
     */
    protected $amount_paid;

    /**
     * The value for the parking_leads_id field.
     * @var        int
     */
    protected $parking_leads_id;

    /**
     * The value for the event_bookings_id field.
     * @var        int
     */
    protected $event_bookings_id;

    /**
     * The value for the bookings_id field.
     * @var        int
     */
    protected $bookings_id;

    /**
     * The value for the processed_by field.
     * @var        string
     */
    protected $processed_by;

    /**
     * @var        LeasingParkingLeads
     */
    protected $aLeasingParkingLeads;

    /**
     * @var        LeasingEventBookings
     */
    protected $aLeasingEventBookings;

    /**
     * @var        LeasingBookings
     */
    protected $aLeasingBookings;

    /**
     * @var        PropelObjectCollection|LeasingPaymentValidity[] Collection to store aggregation of LeasingPaymentValidity objects.
     */
    protected $collLeasingPaymentValidities;
    protected $collLeasingPaymentValiditiesPartial;

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
    protected $leasingPaymentValiditiesScheduledForDeletion = null;

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
     * Get the [transaction_type] column value.
     *
     * @return int
     */
    public function getTransactionType()
    {

        return $this->transaction_type;
    }

    /**
     * Get the [transaction_date] column value.
     *
     * @return string
     */
    public function getTransactionDate()
    {

        return $this->transaction_date;
    }

    /**
     * Get the [transaction_code] column value.
     *
     * @return string
     */
    public function getTransactionCode()
    {

        return $this->transaction_code;
    }

    /**
     * Get the [transaction_cost] column value.
     *
     * @return double
     */
    public function getTransactionCost()
    {

        return $this->transaction_cost;
    }

    /**
     * Get the [tax] column value.
     *
     * @return double
     */
    public function getTax()
    {

        return $this->tax;
    }

    /**
     * Get the [fee] column value.
     *
     * @return double
     */
    public function getFee()
    {

        return $this->fee;
    }

    /**
     * Get the [amount_paid] column value.
     *
     * @return double
     */
    public function getAmountPaid()
    {

        return $this->amount_paid;
    }

    /**
     * Get the [parking_leads_id] column value.
     *
     * @return int
     */
    public function getParkingLeadsId()
    {

        return $this->parking_leads_id;
    }

    /**
     * Get the [event_bookings_id] column value.
     *
     * @return int
     */
    public function getEventBookingsId()
    {

        return $this->event_bookings_id;
    }

    /**
     * Get the [bookings_id] column value.
     *
     * @return int
     */
    public function getBookingsId()
    {

        return $this->bookings_id;
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
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [transaction_type] column.
     *
     * @param  int $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setTransactionType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->transaction_type !== $v) {
            $this->transaction_type = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::TRANSACTION_TYPE;
        }


        return $this;
    } // setTransactionType()

    /**
     * Set the value of [transaction_date] column.
     *
     * @param  string $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setTransactionDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transaction_date !== $v) {
            $this->transaction_date = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::TRANSACTION_DATE;
        }


        return $this;
    } // setTransactionDate()

    /**
     * Set the value of [transaction_code] column.
     *
     * @param  string $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setTransactionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transaction_code !== $v) {
            $this->transaction_code = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::TRANSACTION_CODE;
        }


        return $this;
    } // setTransactionCode()

    /**
     * Set the value of [transaction_cost] column.
     *
     * @param  double $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setTransactionCost($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->transaction_cost !== $v) {
            $this->transaction_cost = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::TRANSACTION_COST;
        }


        return $this;
    } // setTransactionCost()

    /**
     * Set the value of [tax] column.
     *
     * @param  double $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setTax($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->tax !== $v) {
            $this->tax = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::TAX;
        }


        return $this;
    } // setTax()

    /**
     * Set the value of [fee] column.
     *
     * @param  double $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setFee($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->fee !== $v) {
            $this->fee = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::FEE;
        }


        return $this;
    } // setFee()

    /**
     * Set the value of [amount_paid] column.
     *
     * @param  double $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setAmountPaid($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->amount_paid !== $v) {
            $this->amount_paid = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::AMOUNT_PAID;
        }


        return $this;
    } // setAmountPaid()

    /**
     * Set the value of [parking_leads_id] column.
     *
     * @param  int $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setParkingLeadsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->parking_leads_id !== $v) {
            $this->parking_leads_id = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::PARKING_LEADS_ID;
        }

        if ($this->aLeasingParkingLeads !== null && $this->aLeasingParkingLeads->getId() !== $v) {
            $this->aLeasingParkingLeads = null;
        }


        return $this;
    } // setParkingLeadsId()

    /**
     * Set the value of [event_bookings_id] column.
     *
     * @param  int $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setEventBookingsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->event_bookings_id !== $v) {
            $this->event_bookings_id = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID;
        }

        if ($this->aLeasingEventBookings !== null && $this->aLeasingEventBookings->getId() !== $v) {
            $this->aLeasingEventBookings = null;
        }


        return $this;
    } // setEventBookingsId()

    /**
     * Set the value of [bookings_id] column.
     *
     * @param  int $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setBookingsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->bookings_id !== $v) {
            $this->bookings_id = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::BOOKINGS_ID;
        }

        if ($this->aLeasingBookings !== null && $this->aLeasingBookings->getId() !== $v) {
            $this->aLeasingBookings = null;
        }


        return $this;
    } // setBookingsId()

    /**
     * Set the value of [processed_by] column.
     *
     * @param  string $v new value
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setProcessedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->processed_by !== $v) {
            $this->processed_by = $v;
            $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::PROCESSED_BY;
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
            $this->transaction_type = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->transaction_date = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->transaction_code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->transaction_cost = ($row[$startcol + 4] !== null) ? (double) $row[$startcol + 4] : null;
            $this->tax = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
            $this->fee = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
            $this->amount_paid = ($row[$startcol + 7] !== null) ? (double) $row[$startcol + 7] : null;
            $this->parking_leads_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->event_bookings_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->bookings_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->processed_by = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 12; // 12 = LeasingPaymentTransactionsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingPaymentTransactions object", $e);
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

        if ($this->aLeasingParkingLeads !== null && $this->parking_leads_id !== $this->aLeasingParkingLeads->getId()) {
            $this->aLeasingParkingLeads = null;
        }
        if ($this->aLeasingEventBookings !== null && $this->event_bookings_id !== $this->aLeasingEventBookings->getId()) {
            $this->aLeasingEventBookings = null;
        }
        if ($this->aLeasingBookings !== null && $this->bookings_id !== $this->aLeasingBookings->getId()) {
            $this->aLeasingBookings = null;
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
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingPaymentTransactionsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingParkingLeads = null;
            $this->aLeasingEventBookings = null;
            $this->aLeasingBookings = null;
            $this->collLeasingPaymentValidities = null;

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
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingPaymentTransactionsQuery::create()
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
            $con = Propel::getConnection(LeasingPaymentTransactionsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingPaymentTransactionsPeer::addInstanceToPool($this);
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

            if ($this->aLeasingParkingLeads !== null) {
                if ($this->aLeasingParkingLeads->isModified() || $this->aLeasingParkingLeads->isNew()) {
                    $affectedRows += $this->aLeasingParkingLeads->save($con);
                }
                $this->setLeasingParkingLeads($this->aLeasingParkingLeads);
            }

            if ($this->aLeasingEventBookings !== null) {
                if ($this->aLeasingEventBookings->isModified() || $this->aLeasingEventBookings->isNew()) {
                    $affectedRows += $this->aLeasingEventBookings->save($con);
                }
                $this->setLeasingEventBookings($this->aLeasingEventBookings);
            }

            if ($this->aLeasingBookings !== null) {
                if ($this->aLeasingBookings->isModified() || $this->aLeasingBookings->isNew()) {
                    $affectedRows += $this->aLeasingBookings->save($con);
                }
                $this->setLeasingBookings($this->aLeasingBookings);
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

            if ($this->leasingPaymentValiditiesScheduledForDeletion !== null) {
                if (!$this->leasingPaymentValiditiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingPaymentValiditiesScheduledForDeletion as $leasingPaymentValidity) {
                        // need to save related object because we set the relation to null
                        $leasingPaymentValidity->save($con);
                    }
                    $this->leasingPaymentValiditiesScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingPaymentValidities !== null) {
                foreach ($this->collLeasingPaymentValidities as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingPaymentTransactionsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingPaymentTransactionsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`transaction_type`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`transaction_date`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`transaction_code`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_COST)) {
            $modifiedColumns[':p' . $index++]  = '`transaction_cost`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TAX)) {
            $modifiedColumns[':p' . $index++]  = '`tax`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::FEE)) {
            $modifiedColumns[':p' . $index++]  = '`fee`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::AMOUNT_PAID)) {
            $modifiedColumns[':p' . $index++]  = '`amount_paid`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`parking_leads_id`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`event_bookings_id`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::BOOKINGS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bookings_id`';
        }
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::PROCESSED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`processed_by`';
        }

        $sql = sprintf(
            'INSERT INTO `payment_transactions` (%s) VALUES (%s)',
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
                    case '`transaction_type`':
                        $stmt->bindValue($identifier, $this->transaction_type, PDO::PARAM_INT);
                        break;
                    case '`transaction_date`':
                        $stmt->bindValue($identifier, $this->transaction_date, PDO::PARAM_STR);
                        break;
                    case '`transaction_code`':
                        $stmt->bindValue($identifier, $this->transaction_code, PDO::PARAM_STR);
                        break;
                    case '`transaction_cost`':
                        $stmt->bindValue($identifier, $this->transaction_cost, PDO::PARAM_STR);
                        break;
                    case '`tax`':
                        $stmt->bindValue($identifier, $this->tax, PDO::PARAM_STR);
                        break;
                    case '`fee`':
                        $stmt->bindValue($identifier, $this->fee, PDO::PARAM_STR);
                        break;
                    case '`amount_paid`':
                        $stmt->bindValue($identifier, $this->amount_paid, PDO::PARAM_STR);
                        break;
                    case '`parking_leads_id`':
                        $stmt->bindValue($identifier, $this->parking_leads_id, PDO::PARAM_INT);
                        break;
                    case '`event_bookings_id`':
                        $stmt->bindValue($identifier, $this->event_bookings_id, PDO::PARAM_INT);
                        break;
                    case '`bookings_id`':
                        $stmt->bindValue($identifier, $this->bookings_id, PDO::PARAM_INT);
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

            if ($this->aLeasingParkingLeads !== null) {
                if (!$this->aLeasingParkingLeads->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingParkingLeads->getValidationFailures());
                }
            }

            if ($this->aLeasingEventBookings !== null) {
                if (!$this->aLeasingEventBookings->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingEventBookings->getValidationFailures());
                }
            }

            if ($this->aLeasingBookings !== null) {
                if (!$this->aLeasingBookings->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingBookings->getValidationFailures());
                }
            }


            if (($retval = LeasingPaymentTransactionsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingPaymentValidities !== null) {
                    foreach ($this->collLeasingPaymentValidities as $referrerFK) {
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
        $pos = LeasingPaymentTransactionsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getTransactionType();
                break;
            case 2:
                return $this->getTransactionDate();
                break;
            case 3:
                return $this->getTransactionCode();
                break;
            case 4:
                return $this->getTransactionCost();
                break;
            case 5:
                return $this->getTax();
                break;
            case 6:
                return $this->getFee();
                break;
            case 7:
                return $this->getAmountPaid();
                break;
            case 8:
                return $this->getParkingLeadsId();
                break;
            case 9:
                return $this->getEventBookingsId();
                break;
            case 10:
                return $this->getBookingsId();
                break;
            case 11:
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
        if (isset($alreadyDumpedObjects['LeasingPaymentTransactions'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingPaymentTransactions'][$this->getPrimaryKey()] = true;
        $keys = LeasingPaymentTransactionsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTransactionType(),
            $keys[2] => $this->getTransactionDate(),
            $keys[3] => $this->getTransactionCode(),
            $keys[4] => $this->getTransactionCost(),
            $keys[5] => $this->getTax(),
            $keys[6] => $this->getFee(),
            $keys[7] => $this->getAmountPaid(),
            $keys[8] => $this->getParkingLeadsId(),
            $keys[9] => $this->getEventBookingsId(),
            $keys[10] => $this->getBookingsId(),
            $keys[11] => $this->getProcessedBy(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingParkingLeads) {
                $result['LeasingParkingLeads'] = $this->aLeasingParkingLeads->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingEventBookings) {
                $result['LeasingEventBookings'] = $this->aLeasingEventBookings->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingBookings) {
                $result['LeasingBookings'] = $this->aLeasingBookings->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLeasingPaymentValidities) {
                $result['LeasingPaymentValidities'] = $this->collLeasingPaymentValidities->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingPaymentTransactionsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setTransactionType($value);
                break;
            case 2:
                $this->setTransactionDate($value);
                break;
            case 3:
                $this->setTransactionCode($value);
                break;
            case 4:
                $this->setTransactionCost($value);
                break;
            case 5:
                $this->setTax($value);
                break;
            case 6:
                $this->setFee($value);
                break;
            case 7:
                $this->setAmountPaid($value);
                break;
            case 8:
                $this->setParkingLeadsId($value);
                break;
            case 9:
                $this->setEventBookingsId($value);
                break;
            case 10:
                $this->setBookingsId($value);
                break;
            case 11:
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
        $keys = LeasingPaymentTransactionsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTransactionType($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTransactionDate($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTransactionCode($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTransactionCost($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTax($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setFee($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAmountPaid($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setParkingLeadsId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setEventBookingsId($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setBookingsId($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setProcessedBy($arr[$keys[11]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingPaymentTransactionsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::ID)) $criteria->add(LeasingPaymentTransactionsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE)) $criteria->add(LeasingPaymentTransactionsPeer::TRANSACTION_TYPE, $this->transaction_type);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_DATE)) $criteria->add(LeasingPaymentTransactionsPeer::TRANSACTION_DATE, $this->transaction_date);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_CODE)) $criteria->add(LeasingPaymentTransactionsPeer::TRANSACTION_CODE, $this->transaction_code);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TRANSACTION_COST)) $criteria->add(LeasingPaymentTransactionsPeer::TRANSACTION_COST, $this->transaction_cost);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::TAX)) $criteria->add(LeasingPaymentTransactionsPeer::TAX, $this->tax);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::FEE)) $criteria->add(LeasingPaymentTransactionsPeer::FEE, $this->fee);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::AMOUNT_PAID)) $criteria->add(LeasingPaymentTransactionsPeer::AMOUNT_PAID, $this->amount_paid);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID)) $criteria->add(LeasingPaymentTransactionsPeer::PARKING_LEADS_ID, $this->parking_leads_id);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID)) $criteria->add(LeasingPaymentTransactionsPeer::EVENT_BOOKINGS_ID, $this->event_bookings_id);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::BOOKINGS_ID)) $criteria->add(LeasingPaymentTransactionsPeer::BOOKINGS_ID, $this->bookings_id);
        if ($this->isColumnModified(LeasingPaymentTransactionsPeer::PROCESSED_BY)) $criteria->add(LeasingPaymentTransactionsPeer::PROCESSED_BY, $this->processed_by);

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
        $criteria = new Criteria(LeasingPaymentTransactionsPeer::DATABASE_NAME);
        $criteria->add(LeasingPaymentTransactionsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingPaymentTransactions (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTransactionType($this->getTransactionType());
        $copyObj->setTransactionDate($this->getTransactionDate());
        $copyObj->setTransactionCode($this->getTransactionCode());
        $copyObj->setTransactionCost($this->getTransactionCost());
        $copyObj->setTax($this->getTax());
        $copyObj->setFee($this->getFee());
        $copyObj->setAmountPaid($this->getAmountPaid());
        $copyObj->setParkingLeadsId($this->getParkingLeadsId());
        $copyObj->setEventBookingsId($this->getEventBookingsId());
        $copyObj->setBookingsId($this->getBookingsId());
        $copyObj->setProcessedBy($this->getProcessedBy());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingPaymentValidities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingPaymentValidity($relObj->copy($deepCopy));
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
     * @return LeasingPaymentTransactions Clone of current object.
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
     * @return LeasingPaymentTransactionsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingPaymentTransactionsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingParkingLeads object.
     *
     * @param                  LeasingParkingLeads $v
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingParkingLeads(LeasingParkingLeads $v = null)
    {
        if ($v === null) {
            $this->setParkingLeadsId(NULL);
        } else {
            $this->setParkingLeadsId($v->getId());
        }

        $this->aLeasingParkingLeads = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingParkingLeads object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingPaymentTransactions($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingParkingLeads object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingParkingLeads The associated LeasingParkingLeads object.
     * @throws PropelException
     */
    public function getLeasingParkingLeads(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingParkingLeads === null && ($this->parking_leads_id !== null) && $doQuery) {
            $this->aLeasingParkingLeads = LeasingParkingLeadsQuery::create()->findPk($this->parking_leads_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingParkingLeads->addLeasingPaymentTransactionss($this);
             */
        }

        return $this->aLeasingParkingLeads;
    }

    /**
     * Declares an association between this object and a LeasingEventBookings object.
     *
     * @param                  LeasingEventBookings $v
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingEventBookings(LeasingEventBookings $v = null)
    {
        if ($v === null) {
            $this->setEventBookingsId(NULL);
        } else {
            $this->setEventBookingsId($v->getId());
        }

        $this->aLeasingEventBookings = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingEventBookings object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingPaymentTransactions($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingEventBookings object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingEventBookings The associated LeasingEventBookings object.
     * @throws PropelException
     */
    public function getLeasingEventBookings(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingEventBookings === null && ($this->event_bookings_id !== null) && $doQuery) {
            $this->aLeasingEventBookings = LeasingEventBookingsQuery::create()->findPk($this->event_bookings_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingEventBookings->addLeasingPaymentTransactionss($this);
             */
        }

        return $this->aLeasingEventBookings;
    }

    /**
     * Declares an association between this object and a LeasingBookings object.
     *
     * @param                  LeasingBookings $v
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingBookings(LeasingBookings $v = null)
    {
        if ($v === null) {
            $this->setBookingsId(NULL);
        } else {
            $this->setBookingsId($v->getId());
        }

        $this->aLeasingBookings = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingBookings object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingPaymentTransactions($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingBookings object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingBookings The associated LeasingBookings object.
     * @throws PropelException
     */
    public function getLeasingBookings(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingBookings === null && ($this->bookings_id !== null) && $doQuery) {
            $this->aLeasingBookings = LeasingBookingsQuery::create()->findPk($this->bookings_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingBookings->addLeasingPaymentTransactionss($this);
             */
        }

        return $this->aLeasingBookings;
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
        if ('LeasingPaymentValidity' == $relationName) {
            $this->initLeasingPaymentValidities();
        }
    }

    /**
     * Clears out the collLeasingPaymentValidities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     * @see        addLeasingPaymentValidities()
     */
    public function clearLeasingPaymentValidities()
    {
        $this->collLeasingPaymentValidities = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingPaymentValiditiesPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingPaymentValidities collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingPaymentValidities($v = true)
    {
        $this->collLeasingPaymentValiditiesPartial = $v;
    }

    /**
     * Initializes the collLeasingPaymentValidities collection.
     *
     * By default this just sets the collLeasingPaymentValidities collection to an empty array (like clearcollLeasingPaymentValidities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingPaymentValidities($overrideExisting = true)
    {
        if (null !== $this->collLeasingPaymentValidities && !$overrideExisting) {
            return;
        }
        $this->collLeasingPaymentValidities = new PropelObjectCollection();
        $this->collLeasingPaymentValidities->setModel('LeasingPaymentValidity');
    }

    /**
     * Gets an array of LeasingPaymentValidity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingPaymentTransactions is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingPaymentValidity[] List of LeasingPaymentValidity objects
     * @throws PropelException
     */
    public function getLeasingPaymentValidities($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPaymentValiditiesPartial && !$this->isNew();
        if (null === $this->collLeasingPaymentValidities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingPaymentValidities) {
                // return empty collection
                $this->initLeasingPaymentValidities();
            } else {
                $collLeasingPaymentValidities = LeasingPaymentValidityQuery::create(null, $criteria)
                    ->filterByLeasingPaymentTransactions($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingPaymentValiditiesPartial && count($collLeasingPaymentValidities)) {
                      $this->initLeasingPaymentValidities(false);

                      foreach ($collLeasingPaymentValidities as $obj) {
                        if (false == $this->collLeasingPaymentValidities->contains($obj)) {
                          $this->collLeasingPaymentValidities->append($obj);
                        }
                      }

                      $this->collLeasingPaymentValiditiesPartial = true;
                    }

                    $collLeasingPaymentValidities->getInternalIterator()->rewind();

                    return $collLeasingPaymentValidities;
                }

                if ($partial && $this->collLeasingPaymentValidities) {
                    foreach ($this->collLeasingPaymentValidities as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingPaymentValidities[] = $obj;
                        }
                    }
                }

                $this->collLeasingPaymentValidities = $collLeasingPaymentValidities;
                $this->collLeasingPaymentValiditiesPartial = false;
            }
        }

        return $this->collLeasingPaymentValidities;
    }

    /**
     * Sets a collection of LeasingPaymentValidity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingPaymentValidities A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function setLeasingPaymentValidities(PropelCollection $leasingPaymentValidities, PropelPDO $con = null)
    {
        $leasingPaymentValiditiesToDelete = $this->getLeasingPaymentValidities(new Criteria(), $con)->diff($leasingPaymentValidities);


        $this->leasingPaymentValiditiesScheduledForDeletion = $leasingPaymentValiditiesToDelete;

        foreach ($leasingPaymentValiditiesToDelete as $leasingPaymentValidityRemoved) {
            $leasingPaymentValidityRemoved->setLeasingPaymentTransactions(null);
        }

        $this->collLeasingPaymentValidities = null;
        foreach ($leasingPaymentValidities as $leasingPaymentValidity) {
            $this->addLeasingPaymentValidity($leasingPaymentValidity);
        }

        $this->collLeasingPaymentValidities = $leasingPaymentValidities;
        $this->collLeasingPaymentValiditiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingPaymentValidity objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingPaymentValidity objects.
     * @throws PropelException
     */
    public function countLeasingPaymentValidities(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPaymentValiditiesPartial && !$this->isNew();
        if (null === $this->collLeasingPaymentValidities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingPaymentValidities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingPaymentValidities());
            }
            $query = LeasingPaymentValidityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingPaymentTransactions($this)
                ->count($con);
        }

        return count($this->collLeasingPaymentValidities);
    }

    /**
     * Method called to associate a LeasingPaymentValidity object to this object
     * through the LeasingPaymentValidity foreign key attribute.
     *
     * @param    LeasingPaymentValidity $l LeasingPaymentValidity
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function addLeasingPaymentValidity(LeasingPaymentValidity $l)
    {
        if ($this->collLeasingPaymentValidities === null) {
            $this->initLeasingPaymentValidities();
            $this->collLeasingPaymentValiditiesPartial = true;
        }

        if (!in_array($l, $this->collLeasingPaymentValidities->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingPaymentValidity($l);

            if ($this->leasingPaymentValiditiesScheduledForDeletion and $this->leasingPaymentValiditiesScheduledForDeletion->contains($l)) {
                $this->leasingPaymentValiditiesScheduledForDeletion->remove($this->leasingPaymentValiditiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingPaymentValidity $leasingPaymentValidity The leasingPaymentValidity object to add.
     */
    protected function doAddLeasingPaymentValidity($leasingPaymentValidity)
    {
        $this->collLeasingPaymentValidities[]= $leasingPaymentValidity;
        $leasingPaymentValidity->setLeasingPaymentTransactions($this);
    }

    /**
     * @param	LeasingPaymentValidity $leasingPaymentValidity The leasingPaymentValidity object to remove.
     * @return LeasingPaymentTransactions The current object (for fluent API support)
     */
    public function removeLeasingPaymentValidity($leasingPaymentValidity)
    {
        if ($this->getLeasingPaymentValidities()->contains($leasingPaymentValidity)) {
            $this->collLeasingPaymentValidities->remove($this->collLeasingPaymentValidities->search($leasingPaymentValidity));
            if (null === $this->leasingPaymentValiditiesScheduledForDeletion) {
                $this->leasingPaymentValiditiesScheduledForDeletion = clone $this->collLeasingPaymentValidities;
                $this->leasingPaymentValiditiesScheduledForDeletion->clear();
            }
            $this->leasingPaymentValiditiesScheduledForDeletion[]= $leasingPaymentValidity;
            $leasingPaymentValidity->setLeasingPaymentTransactions(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->transaction_type = null;
        $this->transaction_date = null;
        $this->transaction_code = null;
        $this->transaction_cost = null;
        $this->tax = null;
        $this->fee = null;
        $this->amount_paid = null;
        $this->parking_leads_id = null;
        $this->event_bookings_id = null;
        $this->bookings_id = null;
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
            if ($this->collLeasingPaymentValidities) {
                foreach ($this->collLeasingPaymentValidities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aLeasingParkingLeads instanceof Persistent) {
              $this->aLeasingParkingLeads->clearAllReferences($deep);
            }
            if ($this->aLeasingEventBookings instanceof Persistent) {
              $this->aLeasingEventBookings->clearAllReferences($deep);
            }
            if ($this->aLeasingBookings instanceof Persistent) {
              $this->aLeasingBookings->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingPaymentValidities instanceof PropelCollection) {
            $this->collLeasingPaymentValidities->clearIterator();
        }
        $this->collLeasingPaymentValidities = null;
        $this->aLeasingParkingLeads = null;
        $this->aLeasingEventBookings = null;
        $this->aLeasingBookings = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingPaymentTransactionsPeer::DEFAULT_STRING_FORMAT);
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
