<?php

namespace Leasing\CoreBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventBookingsQuery;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetails;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetailsPeer;
use Leasing\CoreBundle\Model\LeasingEventPaymentDetailsQuery;

abstract class BaseLeasingEventPaymentDetails extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingEventPaymentDetailsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingEventPaymentDetailsPeer
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
     * The value for the event_bookings_id field.
     * @var        int
     */
    protected $event_bookings_id;

    /**
     * The value for the rental_cost field.
     * @var        double
     */
    protected $rental_cost;

    /**
     * The value for the reservation_fee field.
     * @var        double
     */
    protected $reservation_fee;

    /**
     * The value for the security_deposit field.
     * @var        double
     */
    protected $security_deposit;

    /**
     * The value for the payable field.
     * @var        double
     */
    protected $payable;

    /**
     * The value for the balance field.
     * @var        double
     */
    protected $balance;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        LeasingEventBookings
     */
    protected $aLeasingEventBookings;

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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
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
     * Get the [rental_cost] column value.
     *
     * @return double
     */
    public function getRentalCost()
    {

        return $this->rental_cost;
    }

    /**
     * Get the [reservation_fee] column value.
     *
     * @return double
     */
    public function getReservationFee()
    {

        return $this->reservation_fee;
    }

    /**
     * Get the [security_deposit] column value.
     *
     * @return double
     */
    public function getSecurityDeposit()
    {

        return $this->security_deposit;
    }

    /**
     * Get the [payable] column value.
     *
     * @return double
     */
    public function getPayable()
    {

        return $this->payable;
    }

    /**
     * Get the [balance] column value.
     *
     * @return double
     */
    public function getBalance()
    {

        return $this->balance;
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
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [event_bookings_id] column.
     *
     * @param  int $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setEventBookingsId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->event_bookings_id !== $v) {
            $this->event_bookings_id = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID;
        }

        if ($this->aLeasingEventBookings !== null && $this->aLeasingEventBookings->getId() !== $v) {
            $this->aLeasingEventBookings = null;
        }


        return $this;
    } // setEventBookingsId()

    /**
     * Set the value of [rental_cost] column.
     *
     * @param  double $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setRentalCost($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->rental_cost !== $v) {
            $this->rental_cost = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::RENTAL_COST;
        }


        return $this;
    } // setRentalCost()

    /**
     * Set the value of [reservation_fee] column.
     *
     * @param  double $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setReservationFee($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->reservation_fee !== $v) {
            $this->reservation_fee = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::RESERVATION_FEE;
        }


        return $this;
    } // setReservationFee()

    /**
     * Set the value of [security_deposit] column.
     *
     * @param  double $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setSecurityDeposit($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->security_deposit !== $v) {
            $this->security_deposit = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT;
        }


        return $this;
    } // setSecurityDeposit()

    /**
     * Set the value of [payable] column.
     *
     * @param  double $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setPayable($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->payable !== $v) {
            $this->payable = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::PAYABLE;
        }


        return $this;
    } // setPayable()

    /**
     * Set the value of [balance] column.
     *
     * @param  double $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setBalance($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->balance !== $v) {
            $this->balance = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::BALANCE;
        }


        return $this;
    } // setBalance()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::STATUS;
        }


        return $this;
    } // setStatus()

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
            $this->event_bookings_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->rental_cost = ($row[$startcol + 2] !== null) ? (double) $row[$startcol + 2] : null;
            $this->reservation_fee = ($row[$startcol + 3] !== null) ? (double) $row[$startcol + 3] : null;
            $this->security_deposit = ($row[$startcol + 4] !== null) ? (double) $row[$startcol + 4] : null;
            $this->payable = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
            $this->balance = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
            $this->status = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 8; // 8 = LeasingEventPaymentDetailsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingEventPaymentDetails object", $e);
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

        if ($this->aLeasingEventBookings !== null && $this->event_bookings_id !== $this->aLeasingEventBookings->getId()) {
            $this->aLeasingEventBookings = null;
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
            $con = Propel::getConnection(LeasingEventPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingEventPaymentDetailsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingEventBookings = null;
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
            $con = Propel::getConnection(LeasingEventPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingEventPaymentDetailsQuery::create()
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
            $con = Propel::getConnection(LeasingEventPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingEventPaymentDetailsPeer::addInstanceToPool($this);
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

            if ($this->aLeasingEventBookings !== null) {
                if ($this->aLeasingEventBookings->isModified() || $this->aLeasingEventBookings->isNew()) {
                    $affectedRows += $this->aLeasingEventBookings->save($con);
                }
                $this->setLeasingEventBookings($this->aLeasingEventBookings);
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

        $this->modifiedColumns[] = LeasingEventPaymentDetailsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingEventPaymentDetailsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`event_bookings_id`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::RENTAL_COST)) {
            $modifiedColumns[':p' . $index++]  = '`rental_cost`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::RESERVATION_FEE)) {
            $modifiedColumns[':p' . $index++]  = '`reservation_fee`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT)) {
            $modifiedColumns[':p' . $index++]  = '`security_deposit`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::PAYABLE)) {
            $modifiedColumns[':p' . $index++]  = '`payable`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::BALANCE)) {
            $modifiedColumns[':p' . $index++]  = '`balance`';
        }
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `event_payment_details` (%s) VALUES (%s)',
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
                    case '`event_bookings_id`':
                        $stmt->bindValue($identifier, $this->event_bookings_id, PDO::PARAM_INT);
                        break;
                    case '`rental_cost`':
                        $stmt->bindValue($identifier, $this->rental_cost, PDO::PARAM_STR);
                        break;
                    case '`reservation_fee`':
                        $stmt->bindValue($identifier, $this->reservation_fee, PDO::PARAM_STR);
                        break;
                    case '`security_deposit`':
                        $stmt->bindValue($identifier, $this->security_deposit, PDO::PARAM_STR);
                        break;
                    case '`payable`':
                        $stmt->bindValue($identifier, $this->payable, PDO::PARAM_STR);
                        break;
                    case '`balance`':
                        $stmt->bindValue($identifier, $this->balance, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
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

            if ($this->aLeasingEventBookings !== null) {
                if (!$this->aLeasingEventBookings->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingEventBookings->getValidationFailures());
                }
            }


            if (($retval = LeasingEventPaymentDetailsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = LeasingEventPaymentDetailsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getEventBookingsId();
                break;
            case 2:
                return $this->getRentalCost();
                break;
            case 3:
                return $this->getReservationFee();
                break;
            case 4:
                return $this->getSecurityDeposit();
                break;
            case 5:
                return $this->getPayable();
                break;
            case 6:
                return $this->getBalance();
                break;
            case 7:
                return $this->getStatus();
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
        if (isset($alreadyDumpedObjects['LeasingEventPaymentDetails'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingEventPaymentDetails'][$this->getPrimaryKey()] = true;
        $keys = LeasingEventPaymentDetailsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEventBookingsId(),
            $keys[2] => $this->getRentalCost(),
            $keys[3] => $this->getReservationFee(),
            $keys[4] => $this->getSecurityDeposit(),
            $keys[5] => $this->getPayable(),
            $keys[6] => $this->getBalance(),
            $keys[7] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingEventBookings) {
                $result['LeasingEventBookings'] = $this->aLeasingEventBookings->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = LeasingEventPaymentDetailsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setEventBookingsId($value);
                break;
            case 2:
                $this->setRentalCost($value);
                break;
            case 3:
                $this->setReservationFee($value);
                break;
            case 4:
                $this->setSecurityDeposit($value);
                break;
            case 5:
                $this->setPayable($value);
                break;
            case 6:
                $this->setBalance($value);
                break;
            case 7:
                $this->setStatus($value);
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
        $keys = LeasingEventPaymentDetailsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setEventBookingsId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setRentalCost($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setReservationFee($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSecurityDeposit($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPayable($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setBalance($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setStatus($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingEventPaymentDetailsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::ID)) $criteria->add(LeasingEventPaymentDetailsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID)) $criteria->add(LeasingEventPaymentDetailsPeer::EVENT_BOOKINGS_ID, $this->event_bookings_id);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::RENTAL_COST)) $criteria->add(LeasingEventPaymentDetailsPeer::RENTAL_COST, $this->rental_cost);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::RESERVATION_FEE)) $criteria->add(LeasingEventPaymentDetailsPeer::RESERVATION_FEE, $this->reservation_fee);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT)) $criteria->add(LeasingEventPaymentDetailsPeer::SECURITY_DEPOSIT, $this->security_deposit);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::PAYABLE)) $criteria->add(LeasingEventPaymentDetailsPeer::PAYABLE, $this->payable);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::BALANCE)) $criteria->add(LeasingEventPaymentDetailsPeer::BALANCE, $this->balance);
        if ($this->isColumnModified(LeasingEventPaymentDetailsPeer::STATUS)) $criteria->add(LeasingEventPaymentDetailsPeer::STATUS, $this->status);

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
        $criteria = new Criteria(LeasingEventPaymentDetailsPeer::DATABASE_NAME);
        $criteria->add(LeasingEventPaymentDetailsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingEventPaymentDetails (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEventBookingsId($this->getEventBookingsId());
        $copyObj->setRentalCost($this->getRentalCost());
        $copyObj->setReservationFee($this->getReservationFee());
        $copyObj->setSecurityDeposit($this->getSecurityDeposit());
        $copyObj->setPayable($this->getPayable());
        $copyObj->setBalance($this->getBalance());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return LeasingEventPaymentDetails Clone of current object.
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
     * @return LeasingEventPaymentDetailsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingEventPaymentDetailsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingEventBookings object.
     *
     * @param                  LeasingEventBookings $v
     * @return LeasingEventPaymentDetails The current object (for fluent API support)
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
            $v->addLeasingEventPaymentDetails($this);
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
                $this->aLeasingEventBookings->addLeasingEventPaymentDetailss($this);
             */
        }

        return $this->aLeasingEventBookings;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->event_bookings_id = null;
        $this->rental_cost = null;
        $this->reservation_fee = null;
        $this->security_deposit = null;
        $this->payable = null;
        $this->balance = null;
        $this->status = null;
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
            if ($this->aLeasingEventBookings instanceof Persistent) {
              $this->aLeasingEventBookings->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aLeasingEventBookings = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingEventPaymentDetailsPeer::DEFAULT_STRING_FORMAT);
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
