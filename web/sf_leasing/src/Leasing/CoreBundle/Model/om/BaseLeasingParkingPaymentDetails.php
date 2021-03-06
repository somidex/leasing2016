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
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingParkingLeadsQuery;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetails;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsPeer;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsQuery;

abstract class BaseLeasingParkingPaymentDetails extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingParkingPaymentDetailsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingParkingPaymentDetailsPeer
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
     * The value for the parking_lead_id field.
     * @var        int
     */
    protected $parking_lead_id;

    /**
     * The value for the slots field.
     * @var        int
     */
    protected $slots;

    /**
     * The value for the monthly_cost field.
     * @var        double
     */
    protected $monthly_cost;

    /**
     * The value for the period field.
     * @var        int
     */
    protected $period;

    /**
     * The value for the total_cost field.
     * @var        double
     */
    protected $total_cost;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        LeasingParkingLeads
     */
    protected $aLeasingParkingLeads;

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
     * Get the [parking_lead_id] column value.
     *
     * @return int
     */
    public function getParkingLeadId()
    {

        return $this->parking_lead_id;
    }

    /**
     * Get the [slots] column value.
     *
     * @return int
     */
    public function getSlots()
    {

        return $this->slots;
    }

    /**
     * Get the [monthly_cost] column value.
     *
     * @return double
     */
    public function getMonthlyCost()
    {

        return $this->monthly_cost;
    }

    /**
     * Get the [period] column value.
     *
     * @return int
     */
    public function getPeriod()
    {

        return $this->period;
    }

    /**
     * Get the [total_cost] column value.
     *
     * @return double
     */
    public function getTotalCost()
    {

        return $this->total_cost;
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
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [parking_lead_id] column.
     *
     * @param  int $v new value
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setParkingLeadId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->parking_lead_id !== $v) {
            $this->parking_lead_id = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID;
        }

        if ($this->aLeasingParkingLeads !== null && $this->aLeasingParkingLeads->getId() !== $v) {
            $this->aLeasingParkingLeads = null;
        }


        return $this;
    } // setParkingLeadId()

    /**
     * Set the value of [slots] column.
     *
     * @param  int $v new value
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setSlots($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->slots !== $v) {
            $this->slots = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::SLOTS;
        }


        return $this;
    } // setSlots()

    /**
     * Set the value of [monthly_cost] column.
     *
     * @param  double $v new value
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setMonthlyCost($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->monthly_cost !== $v) {
            $this->monthly_cost = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::MONTHLY_COST;
        }


        return $this;
    } // setMonthlyCost()

    /**
     * Set the value of [period] column.
     *
     * @param  int $v new value
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setPeriod($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->period !== $v) {
            $this->period = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::PERIOD;
        }


        return $this;
    } // setPeriod()

    /**
     * Set the value of [total_cost] column.
     *
     * @param  double $v new value
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setTotalCost($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->total_cost !== $v) {
            $this->total_cost = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::TOTAL_COST;
        }


        return $this;
    } // setTotalCost()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::STATUS;
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
            $this->parking_lead_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->slots = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->monthly_cost = ($row[$startcol + 3] !== null) ? (double) $row[$startcol + 3] : null;
            $this->period = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->total_cost = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
            $this->status = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = LeasingParkingPaymentDetailsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingParkingPaymentDetails object", $e);
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

        if ($this->aLeasingParkingLeads !== null && $this->parking_lead_id !== $this->aLeasingParkingLeads->getId()) {
            $this->aLeasingParkingLeads = null;
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
            $con = Propel::getConnection(LeasingParkingPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingParkingPaymentDetailsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingParkingLeads = null;
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
            $con = Propel::getConnection(LeasingParkingPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingParkingPaymentDetailsQuery::create()
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
            $con = Propel::getConnection(LeasingParkingPaymentDetailsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingParkingPaymentDetailsPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = LeasingParkingPaymentDetailsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingParkingPaymentDetailsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID)) {
            $modifiedColumns[':p' . $index++]  = '`parking_lead_id`';
        }
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::SLOTS)) {
            $modifiedColumns[':p' . $index++]  = '`slots`';
        }
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::MONTHLY_COST)) {
            $modifiedColumns[':p' . $index++]  = '`monthly_cost`';
        }
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::PERIOD)) {
            $modifiedColumns[':p' . $index++]  = '`period`';
        }
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::TOTAL_COST)) {
            $modifiedColumns[':p' . $index++]  = '`total_cost`';
        }
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `parking_payment_details` (%s) VALUES (%s)',
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
                    case '`parking_lead_id`':
                        $stmt->bindValue($identifier, $this->parking_lead_id, PDO::PARAM_INT);
                        break;
                    case '`slots`':
                        $stmt->bindValue($identifier, $this->slots, PDO::PARAM_INT);
                        break;
                    case '`monthly_cost`':
                        $stmt->bindValue($identifier, $this->monthly_cost, PDO::PARAM_STR);
                        break;
                    case '`period`':
                        $stmt->bindValue($identifier, $this->period, PDO::PARAM_INT);
                        break;
                    case '`total_cost`':
                        $stmt->bindValue($identifier, $this->total_cost, PDO::PARAM_STR);
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

            if ($this->aLeasingParkingLeads !== null) {
                if (!$this->aLeasingParkingLeads->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingParkingLeads->getValidationFailures());
                }
            }


            if (($retval = LeasingParkingPaymentDetailsPeer::doValidate($this, $columns)) !== true) {
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
        $pos = LeasingParkingPaymentDetailsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getParkingLeadId();
                break;
            case 2:
                return $this->getSlots();
                break;
            case 3:
                return $this->getMonthlyCost();
                break;
            case 4:
                return $this->getPeriod();
                break;
            case 5:
                return $this->getTotalCost();
                break;
            case 6:
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
        if (isset($alreadyDumpedObjects['LeasingParkingPaymentDetails'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingParkingPaymentDetails'][$this->getPrimaryKey()] = true;
        $keys = LeasingParkingPaymentDetailsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getParkingLeadId(),
            $keys[2] => $this->getSlots(),
            $keys[3] => $this->getMonthlyCost(),
            $keys[4] => $this->getPeriod(),
            $keys[5] => $this->getTotalCost(),
            $keys[6] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingParkingLeads) {
                $result['LeasingParkingLeads'] = $this->aLeasingParkingLeads->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = LeasingParkingPaymentDetailsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setParkingLeadId($value);
                break;
            case 2:
                $this->setSlots($value);
                break;
            case 3:
                $this->setMonthlyCost($value);
                break;
            case 4:
                $this->setPeriod($value);
                break;
            case 5:
                $this->setTotalCost($value);
                break;
            case 6:
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
        $keys = LeasingParkingPaymentDetailsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setParkingLeadId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSlots($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setMonthlyCost($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPeriod($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTotalCost($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingParkingPaymentDetailsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::ID)) $criteria->add(LeasingParkingPaymentDetailsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID)) $criteria->add(LeasingParkingPaymentDetailsPeer::PARKING_LEAD_ID, $this->parking_lead_id);
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::SLOTS)) $criteria->add(LeasingParkingPaymentDetailsPeer::SLOTS, $this->slots);
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::MONTHLY_COST)) $criteria->add(LeasingParkingPaymentDetailsPeer::MONTHLY_COST, $this->monthly_cost);
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::PERIOD)) $criteria->add(LeasingParkingPaymentDetailsPeer::PERIOD, $this->period);
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::TOTAL_COST)) $criteria->add(LeasingParkingPaymentDetailsPeer::TOTAL_COST, $this->total_cost);
        if ($this->isColumnModified(LeasingParkingPaymentDetailsPeer::STATUS)) $criteria->add(LeasingParkingPaymentDetailsPeer::STATUS, $this->status);

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
        $criteria = new Criteria(LeasingParkingPaymentDetailsPeer::DATABASE_NAME);
        $criteria->add(LeasingParkingPaymentDetailsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingParkingPaymentDetails (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setParkingLeadId($this->getParkingLeadId());
        $copyObj->setSlots($this->getSlots());
        $copyObj->setMonthlyCost($this->getMonthlyCost());
        $copyObj->setPeriod($this->getPeriod());
        $copyObj->setTotalCost($this->getTotalCost());
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
     * @return LeasingParkingPaymentDetails Clone of current object.
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
     * @return LeasingParkingPaymentDetailsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingParkingPaymentDetailsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingParkingLeads object.
     *
     * @param                  LeasingParkingLeads $v
     * @return LeasingParkingPaymentDetails The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingParkingLeads(LeasingParkingLeads $v = null)
    {
        if ($v === null) {
            $this->setParkingLeadId(NULL);
        } else {
            $this->setParkingLeadId($v->getId());
        }

        $this->aLeasingParkingLeads = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingParkingLeads object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingParkingPaymentDetails($this);
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
        if ($this->aLeasingParkingLeads === null && ($this->parking_lead_id !== null) && $doQuery) {
            $this->aLeasingParkingLeads = LeasingParkingLeadsQuery::create()->findPk($this->parking_lead_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingParkingLeads->addLeasingParkingPaymentDetailss($this);
             */
        }

        return $this->aLeasingParkingLeads;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->parking_lead_id = null;
        $this->slots = null;
        $this->monthly_cost = null;
        $this->period = null;
        $this->total_cost = null;
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
            if ($this->aLeasingParkingLeads instanceof Persistent) {
              $this->aLeasingParkingLeads->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aLeasingParkingLeads = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingParkingPaymentDetailsPeer::DEFAULT_STRING_FORMAT);
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
