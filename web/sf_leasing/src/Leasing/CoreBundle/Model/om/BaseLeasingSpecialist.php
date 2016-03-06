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
use Leasing\CoreBundle\Model\LeasingBookingAssignment;
use Leasing\CoreBundle\Model\LeasingBookingAssignmentQuery;
use Leasing\CoreBundle\Model\LeasingSpecialist;
use Leasing\CoreBundle\Model\LeasingSpecialistPeer;
use Leasing\CoreBundle\Model\LeasingSpecialistQuery;
use Leasing\CoreBundle\Model\LeasingSpecialistSchedule;
use Leasing\CoreBundle\Model\LeasingSpecialistScheduleQuery;

abstract class BaseLeasingSpecialist extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingSpecialistPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingSpecialistPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

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
     * The value for the leasing_unit field.
     * @var        int
     */
    protected $leasing_unit;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        PropelObjectCollection|LeasingAppointmentAssignment[] Collection to store aggregation of LeasingAppointmentAssignment objects.
     */
    protected $collLeasingAppointmentAssignments;
    protected $collLeasingAppointmentAssignmentsPartial;

    /**
     * @var        PropelObjectCollection|LeasingBookingAssignment[] Collection to store aggregation of LeasingBookingAssignment objects.
     */
    protected $collLeasingBookingAssignments;
    protected $collLeasingBookingAssignmentsPartial;

    /**
     * @var        PropelObjectCollection|LeasingSpecialistSchedule[] Collection to store aggregation of LeasingSpecialistSchedule objects.
     */
    protected $collLeasingSpecialistSchedules;
    protected $collLeasingSpecialistSchedulesPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingBookingAssignmentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingSpecialistSchedulesScheduledForDeletion = null;

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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
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
     * Get the [leasing_unit] column value.
     *
     * @return int
     */
    public function getLeasingUnit()
    {

        return $this->leasing_unit;
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
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingSpecialistPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = LeasingSpecialistPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingSpecialistPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [mobile] column.
     *
     * @param  string $v new value
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[] = LeasingSpecialistPeer::MOBILE;
        }


        return $this;
    } // setMobile()

    /**
     * Set the value of [leasing_unit] column.
     *
     * @param  int $v new value
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setLeasingUnit($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->leasing_unit !== $v) {
            $this->leasing_unit = $v;
            $this->modifiedColumns[] = LeasingSpecialistPeer::LEASING_UNIT;
        }


        return $this;
    } // setLeasingUnit()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingSpecialistPeer::STATUS;
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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->email = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->mobile = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->leasing_unit = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->status = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = LeasingSpecialistPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingSpecialist object", $e);
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
            $con = Propel::getConnection(LeasingSpecialistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingSpecialistPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLeasingAppointmentAssignments = null;

            $this->collLeasingBookingAssignments = null;

            $this->collLeasingSpecialistSchedules = null;

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
            $con = Propel::getConnection(LeasingSpecialistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingSpecialistQuery::create()
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
            $con = Propel::getConnection(LeasingSpecialistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingSpecialistPeer::addInstanceToPool($this);
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

            if ($this->leasingSpecialistSchedulesScheduledForDeletion !== null) {
                if (!$this->leasingSpecialistSchedulesScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingSpecialistSchedulesScheduledForDeletion as $leasingSpecialistSchedule) {
                        // need to save related object because we set the relation to null
                        $leasingSpecialistSchedule->save($con);
                    }
                    $this->leasingSpecialistSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingSpecialistSchedules !== null) {
                foreach ($this->collLeasingSpecialistSchedules as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingSpecialistPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingSpecialistPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingSpecialistPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingSpecialistPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(LeasingSpecialistPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingSpecialistPeer::MOBILE)) {
            $modifiedColumns[':p' . $index++]  = '`mobile`';
        }
        if ($this->isColumnModified(LeasingSpecialistPeer::LEASING_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`leasing_unit`';
        }
        if ($this->isColumnModified(LeasingSpecialistPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `leasing_specialist` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`mobile`':
                        $stmt->bindValue($identifier, $this->mobile, PDO::PARAM_STR);
                        break;
                    case '`leasing_unit`':
                        $stmt->bindValue($identifier, $this->leasing_unit, PDO::PARAM_INT);
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


            if (($retval = LeasingSpecialistPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingAppointmentAssignments !== null) {
                    foreach ($this->collLeasingAppointmentAssignments as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingBookingAssignments !== null) {
                    foreach ($this->collLeasingBookingAssignments as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingSpecialistSchedules !== null) {
                    foreach ($this->collLeasingSpecialistSchedules as $referrerFK) {
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
        $pos = LeasingSpecialistPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getMobile();
                break;
            case 4:
                return $this->getLeasingUnit();
                break;
            case 5:
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
        if (isset($alreadyDumpedObjects['LeasingSpecialist'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingSpecialist'][$this->getPrimaryKey()] = true;
        $keys = LeasingSpecialistPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getMobile(),
            $keys[4] => $this->getLeasingUnit(),
            $keys[5] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLeasingAppointmentAssignments) {
                $result['LeasingAppointmentAssignments'] = $this->collLeasingAppointmentAssignments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingBookingAssignments) {
                $result['LeasingBookingAssignments'] = $this->collLeasingBookingAssignments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingSpecialistSchedules) {
                $result['LeasingSpecialistSchedules'] = $this->collLeasingSpecialistSchedules->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingSpecialistPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setMobile($value);
                break;
            case 4:
                $this->setLeasingUnit($value);
                break;
            case 5:
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
        $keys = LeasingSpecialistPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setMobile($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLeasingUnit($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStatus($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingSpecialistPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingSpecialistPeer::ID)) $criteria->add(LeasingSpecialistPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingSpecialistPeer::NAME)) $criteria->add(LeasingSpecialistPeer::NAME, $this->name);
        if ($this->isColumnModified(LeasingSpecialistPeer::EMAIL)) $criteria->add(LeasingSpecialistPeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingSpecialistPeer::MOBILE)) $criteria->add(LeasingSpecialistPeer::MOBILE, $this->mobile);
        if ($this->isColumnModified(LeasingSpecialistPeer::LEASING_UNIT)) $criteria->add(LeasingSpecialistPeer::LEASING_UNIT, $this->leasing_unit);
        if ($this->isColumnModified(LeasingSpecialistPeer::STATUS)) $criteria->add(LeasingSpecialistPeer::STATUS, $this->status);

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
        $criteria = new Criteria(LeasingSpecialistPeer::DATABASE_NAME);
        $criteria->add(LeasingSpecialistPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingSpecialist (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setLeasingUnit($this->getLeasingUnit());
        $copyObj->setStatus($this->getStatus());

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

            foreach ($this->getLeasingBookingAssignments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingBookingAssignment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingSpecialistSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingSpecialistSchedule($relObj->copy($deepCopy));
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
     * @return LeasingSpecialist Clone of current object.
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
     * @return LeasingSpecialistPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingSpecialistPeer();
        }

        return self::$peer;
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
        if ('LeasingBookingAssignment' == $relationName) {
            $this->initLeasingBookingAssignments();
        }
        if ('LeasingSpecialistSchedule' == $relationName) {
            $this->initLeasingSpecialistSchedules();
        }
    }

    /**
     * Clears out the collLeasingAppointmentAssignments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingSpecialist The current object (for fluent API support)
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
     * If this LeasingSpecialist is new, it will return
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
                    ->filterByLeasingSpecialist($this)
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
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setLeasingAppointmentAssignments(PropelCollection $leasingAppointmentAssignments, PropelPDO $con = null)
    {
        $leasingAppointmentAssignmentsToDelete = $this->getLeasingAppointmentAssignments(new Criteria(), $con)->diff($leasingAppointmentAssignments);


        $this->leasingAppointmentAssignmentsScheduledForDeletion = $leasingAppointmentAssignmentsToDelete;

        foreach ($leasingAppointmentAssignmentsToDelete as $leasingAppointmentAssignmentRemoved) {
            $leasingAppointmentAssignmentRemoved->setLeasingSpecialist(null);
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
                ->filterByLeasingSpecialist($this)
                ->count($con);
        }

        return count($this->collLeasingAppointmentAssignments);
    }

    /**
     * Method called to associate a LeasingAppointmentAssignment object to this object
     * through the LeasingAppointmentAssignment foreign key attribute.
     *
     * @param    LeasingAppointmentAssignment $l LeasingAppointmentAssignment
     * @return LeasingSpecialist The current object (for fluent API support)
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
        $leasingAppointmentAssignment->setLeasingSpecialist($this);
    }

    /**
     * @param	LeasingAppointmentAssignment $leasingAppointmentAssignment The leasingAppointmentAssignment object to remove.
     * @return LeasingSpecialist The current object (for fluent API support)
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
            $leasingAppointmentAssignment->setLeasingSpecialist(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingSpecialist is new, it will return
     * an empty collection; or if this LeasingSpecialist has previously
     * been saved, it will retrieve related LeasingAppointmentAssignments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingSpecialist.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingAppointmentAssignment[] List of LeasingAppointmentAssignment objects
     */
    public function getLeasingAppointmentAssignmentsJoinLeasingAppointments($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingAppointmentAssignmentQuery::create(null, $criteria);
        $query->joinWith('LeasingAppointments', $join_behavior);

        return $this->getLeasingAppointmentAssignments($query, $con);
    }

    /**
     * Clears out the collLeasingBookingAssignments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingSpecialist The current object (for fluent API support)
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
     * If this LeasingSpecialist is new, it will return
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
                    ->filterByLeasingSpecialist($this)
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
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setLeasingBookingAssignments(PropelCollection $leasingBookingAssignments, PropelPDO $con = null)
    {
        $leasingBookingAssignmentsToDelete = $this->getLeasingBookingAssignments(new Criteria(), $con)->diff($leasingBookingAssignments);


        $this->leasingBookingAssignmentsScheduledForDeletion = $leasingBookingAssignmentsToDelete;

        foreach ($leasingBookingAssignmentsToDelete as $leasingBookingAssignmentRemoved) {
            $leasingBookingAssignmentRemoved->setLeasingSpecialist(null);
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
                ->filterByLeasingSpecialist($this)
                ->count($con);
        }

        return count($this->collLeasingBookingAssignments);
    }

    /**
     * Method called to associate a LeasingBookingAssignment object to this object
     * through the LeasingBookingAssignment foreign key attribute.
     *
     * @param    LeasingBookingAssignment $l LeasingBookingAssignment
     * @return LeasingSpecialist The current object (for fluent API support)
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
        $leasingBookingAssignment->setLeasingSpecialist($this);
    }

    /**
     * @param	LeasingBookingAssignment $leasingBookingAssignment The leasingBookingAssignment object to remove.
     * @return LeasingSpecialist The current object (for fluent API support)
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
            $leasingBookingAssignment->setLeasingSpecialist(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingSpecialist is new, it will return
     * an empty collection; or if this LeasingSpecialist has previously
     * been saved, it will retrieve related LeasingBookingAssignments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingSpecialist.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingBookingAssignment[] List of LeasingBookingAssignment objects
     */
    public function getLeasingBookingAssignmentsJoinLeasingBookings($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingBookingAssignmentQuery::create(null, $criteria);
        $query->joinWith('LeasingBookings', $join_behavior);

        return $this->getLeasingBookingAssignments($query, $con);
    }

    /**
     * Clears out the collLeasingSpecialistSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingSpecialist The current object (for fluent API support)
     * @see        addLeasingSpecialistSchedules()
     */
    public function clearLeasingSpecialistSchedules()
    {
        $this->collLeasingSpecialistSchedules = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingSpecialistSchedulesPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingSpecialistSchedules collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingSpecialistSchedules($v = true)
    {
        $this->collLeasingSpecialistSchedulesPartial = $v;
    }

    /**
     * Initializes the collLeasingSpecialistSchedules collection.
     *
     * By default this just sets the collLeasingSpecialistSchedules collection to an empty array (like clearcollLeasingSpecialistSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingSpecialistSchedules($overrideExisting = true)
    {
        if (null !== $this->collLeasingSpecialistSchedules && !$overrideExisting) {
            return;
        }
        $this->collLeasingSpecialistSchedules = new PropelObjectCollection();
        $this->collLeasingSpecialistSchedules->setModel('LeasingSpecialistSchedule');
    }

    /**
     * Gets an array of LeasingSpecialistSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingSpecialist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingSpecialistSchedule[] List of LeasingSpecialistSchedule objects
     * @throws PropelException
     */
    public function getLeasingSpecialistSchedules($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingSpecialistSchedulesPartial && !$this->isNew();
        if (null === $this->collLeasingSpecialistSchedules || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingSpecialistSchedules) {
                // return empty collection
                $this->initLeasingSpecialistSchedules();
            } else {
                $collLeasingSpecialistSchedules = LeasingSpecialistScheduleQuery::create(null, $criteria)
                    ->filterByLeasingSpecialist($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingSpecialistSchedulesPartial && count($collLeasingSpecialistSchedules)) {
                      $this->initLeasingSpecialistSchedules(false);

                      foreach ($collLeasingSpecialistSchedules as $obj) {
                        if (false == $this->collLeasingSpecialistSchedules->contains($obj)) {
                          $this->collLeasingSpecialistSchedules->append($obj);
                        }
                      }

                      $this->collLeasingSpecialistSchedulesPartial = true;
                    }

                    $collLeasingSpecialistSchedules->getInternalIterator()->rewind();

                    return $collLeasingSpecialistSchedules;
                }

                if ($partial && $this->collLeasingSpecialistSchedules) {
                    foreach ($this->collLeasingSpecialistSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingSpecialistSchedules[] = $obj;
                        }
                    }
                }

                $this->collLeasingSpecialistSchedules = $collLeasingSpecialistSchedules;
                $this->collLeasingSpecialistSchedulesPartial = false;
            }
        }

        return $this->collLeasingSpecialistSchedules;
    }

    /**
     * Sets a collection of LeasingSpecialistSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingSpecialistSchedules A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function setLeasingSpecialistSchedules(PropelCollection $leasingSpecialistSchedules, PropelPDO $con = null)
    {
        $leasingSpecialistSchedulesToDelete = $this->getLeasingSpecialistSchedules(new Criteria(), $con)->diff($leasingSpecialistSchedules);


        $this->leasingSpecialistSchedulesScheduledForDeletion = $leasingSpecialistSchedulesToDelete;

        foreach ($leasingSpecialistSchedulesToDelete as $leasingSpecialistScheduleRemoved) {
            $leasingSpecialistScheduleRemoved->setLeasingSpecialist(null);
        }

        $this->collLeasingSpecialistSchedules = null;
        foreach ($leasingSpecialistSchedules as $leasingSpecialistSchedule) {
            $this->addLeasingSpecialistSchedule($leasingSpecialistSchedule);
        }

        $this->collLeasingSpecialistSchedules = $leasingSpecialistSchedules;
        $this->collLeasingSpecialistSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingSpecialistSchedule objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingSpecialistSchedule objects.
     * @throws PropelException
     */
    public function countLeasingSpecialistSchedules(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingSpecialistSchedulesPartial && !$this->isNew();
        if (null === $this->collLeasingSpecialistSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingSpecialistSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingSpecialistSchedules());
            }
            $query = LeasingSpecialistScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingSpecialist($this)
                ->count($con);
        }

        return count($this->collLeasingSpecialistSchedules);
    }

    /**
     * Method called to associate a LeasingSpecialistSchedule object to this object
     * through the LeasingSpecialistSchedule foreign key attribute.
     *
     * @param    LeasingSpecialistSchedule $l LeasingSpecialistSchedule
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function addLeasingSpecialistSchedule(LeasingSpecialistSchedule $l)
    {
        if ($this->collLeasingSpecialistSchedules === null) {
            $this->initLeasingSpecialistSchedules();
            $this->collLeasingSpecialistSchedulesPartial = true;
        }

        if (!in_array($l, $this->collLeasingSpecialistSchedules->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingSpecialistSchedule($l);

            if ($this->leasingSpecialistSchedulesScheduledForDeletion and $this->leasingSpecialistSchedulesScheduledForDeletion->contains($l)) {
                $this->leasingSpecialistSchedulesScheduledForDeletion->remove($this->leasingSpecialistSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingSpecialistSchedule $leasingSpecialistSchedule The leasingSpecialistSchedule object to add.
     */
    protected function doAddLeasingSpecialistSchedule($leasingSpecialistSchedule)
    {
        $this->collLeasingSpecialistSchedules[]= $leasingSpecialistSchedule;
        $leasingSpecialistSchedule->setLeasingSpecialist($this);
    }

    /**
     * @param	LeasingSpecialistSchedule $leasingSpecialistSchedule The leasingSpecialistSchedule object to remove.
     * @return LeasingSpecialist The current object (for fluent API support)
     */
    public function removeLeasingSpecialistSchedule($leasingSpecialistSchedule)
    {
        if ($this->getLeasingSpecialistSchedules()->contains($leasingSpecialistSchedule)) {
            $this->collLeasingSpecialistSchedules->remove($this->collLeasingSpecialistSchedules->search($leasingSpecialistSchedule));
            if (null === $this->leasingSpecialistSchedulesScheduledForDeletion) {
                $this->leasingSpecialistSchedulesScheduledForDeletion = clone $this->collLeasingSpecialistSchedules;
                $this->leasingSpecialistSchedulesScheduledForDeletion->clear();
            }
            $this->leasingSpecialistSchedulesScheduledForDeletion[]= $leasingSpecialistSchedule;
            $leasingSpecialistSchedule->setLeasingSpecialist(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->email = null;
        $this->mobile = null;
        $this->leasing_unit = null;
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
            if ($this->collLeasingAppointmentAssignments) {
                foreach ($this->collLeasingAppointmentAssignments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingBookingAssignments) {
                foreach ($this->collLeasingBookingAssignments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingSpecialistSchedules) {
                foreach ($this->collLeasingSpecialistSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingAppointmentAssignments instanceof PropelCollection) {
            $this->collLeasingAppointmentAssignments->clearIterator();
        }
        $this->collLeasingAppointmentAssignments = null;
        if ($this->collLeasingBookingAssignments instanceof PropelCollection) {
            $this->collLeasingBookingAssignments->clearIterator();
        }
        $this->collLeasingBookingAssignments = null;
        if ($this->collLeasingSpecialistSchedules instanceof PropelCollection) {
            $this->collLeasingSpecialistSchedules->clearIterator();
        }
        $this->collLeasingSpecialistSchedules = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingSpecialistPeer::DEFAULT_STRING_FORMAT);
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
