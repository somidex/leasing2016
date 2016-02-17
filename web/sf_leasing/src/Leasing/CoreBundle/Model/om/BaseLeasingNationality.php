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
use Leasing\CoreBundle\Model\LeasingAppointmentLeadsQuery;
use Leasing\CoreBundle\Model\LeasingBookingLeads;
use Leasing\CoreBundle\Model\LeasingBookingLeadsQuery;
use Leasing\CoreBundle\Model\LeasingEventLeads;
use Leasing\CoreBundle\Model\LeasingEventLeadsQuery;
use Leasing\CoreBundle\Model\LeasingNationality;
use Leasing\CoreBundle\Model\LeasingNationalityPeer;
use Leasing\CoreBundle\Model\LeasingNationalityQuery;

abstract class BaseLeasingNationality extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingNationalityPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingNationalityPeer
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
     * The value for the nationality_name field.
     * @var        string
     */
    protected $nationality_name;

    /**
     * @var        PropelObjectCollection|LeasingAppointmentLeads[] Collection to store aggregation of LeasingAppointmentLeads objects.
     */
    protected $collLeasingAppointmentLeadss;
    protected $collLeasingAppointmentLeadssPartial;

    /**
     * @var        PropelObjectCollection|LeasingBookingLeads[] Collection to store aggregation of LeasingBookingLeads objects.
     */
    protected $collLeasingBookingLeadss;
    protected $collLeasingBookingLeadssPartial;

    /**
     * @var        PropelObjectCollection|LeasingEventLeads[] Collection to store aggregation of LeasingEventLeads objects.
     */
    protected $collLeasingEventLeadss;
    protected $collLeasingEventLeadssPartial;

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
    protected $leasingAppointmentLeadssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingBookingLeadssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingEventLeadssScheduledForDeletion = null;

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
     * Get the [nationality_name] column value.
     *
     * @return string
     */
    public function getNationalityName()
    {

        return $this->nationality_name;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingNationalityPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [nationality_name] column.
     *
     * @param  string $v new value
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function setNationalityName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nationality_name !== $v) {
            $this->nationality_name = $v;
            $this->modifiedColumns[] = LeasingNationalityPeer::NATIONALITY_NAME;
        }


        return $this;
    } // setNationalityName()

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
            $this->nationality_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 2; // 2 = LeasingNationalityPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingNationality object", $e);
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
            $con = Propel::getConnection(LeasingNationalityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingNationalityPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLeasingAppointmentLeadss = null;

            $this->collLeasingBookingLeadss = null;

            $this->collLeasingEventLeadss = null;

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
            $con = Propel::getConnection(LeasingNationalityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingNationalityQuery::create()
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
            $con = Propel::getConnection(LeasingNationalityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingNationalityPeer::addInstanceToPool($this);
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

            if ($this->leasingAppointmentLeadssScheduledForDeletion !== null) {
                if (!$this->leasingAppointmentLeadssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingAppointmentLeadssScheduledForDeletion as $leasingAppointmentLeads) {
                        // need to save related object because we set the relation to null
                        $leasingAppointmentLeads->save($con);
                    }
                    $this->leasingAppointmentLeadssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingAppointmentLeadss !== null) {
                foreach ($this->collLeasingAppointmentLeadss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingBookingLeadssScheduledForDeletion !== null) {
                if (!$this->leasingBookingLeadssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingBookingLeadssScheduledForDeletion as $leasingBookingLeads) {
                        // need to save related object because we set the relation to null
                        $leasingBookingLeads->save($con);
                    }
                    $this->leasingBookingLeadssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingBookingLeadss !== null) {
                foreach ($this->collLeasingBookingLeadss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingEventLeadssScheduledForDeletion !== null) {
                if (!$this->leasingEventLeadssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingEventLeadssScheduledForDeletion as $leasingEventLeads) {
                        // need to save related object because we set the relation to null
                        $leasingEventLeads->save($con);
                    }
                    $this->leasingEventLeadssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingEventLeadss !== null) {
                foreach ($this->collLeasingEventLeadss as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingNationalityPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingNationalityPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingNationalityPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingNationalityPeer::NATIONALITY_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`nationality_name`';
        }

        $sql = sprintf(
            'INSERT INTO `nationality` (%s) VALUES (%s)',
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
                    case '`nationality_name`':
                        $stmt->bindValue($identifier, $this->nationality_name, PDO::PARAM_STR);
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


            if (($retval = LeasingNationalityPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingAppointmentLeadss !== null) {
                    foreach ($this->collLeasingAppointmentLeadss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingBookingLeadss !== null) {
                    foreach ($this->collLeasingBookingLeadss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingEventLeadss !== null) {
                    foreach ($this->collLeasingEventLeadss as $referrerFK) {
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
        $pos = LeasingNationalityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getNationalityName();
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
        if (isset($alreadyDumpedObjects['LeasingNationality'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingNationality'][$this->getPrimaryKey()] = true;
        $keys = LeasingNationalityPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNationalityName(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLeasingAppointmentLeadss) {
                $result['LeasingAppointmentLeadss'] = $this->collLeasingAppointmentLeadss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingBookingLeadss) {
                $result['LeasingBookingLeadss'] = $this->collLeasingBookingLeadss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingEventLeadss) {
                $result['LeasingEventLeadss'] = $this->collLeasingEventLeadss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingNationalityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setNationalityName($value);
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
        $keys = LeasingNationalityPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNationalityName($arr[$keys[1]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingNationalityPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingNationalityPeer::ID)) $criteria->add(LeasingNationalityPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingNationalityPeer::NATIONALITY_NAME)) $criteria->add(LeasingNationalityPeer::NATIONALITY_NAME, $this->nationality_name);

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
        $criteria = new Criteria(LeasingNationalityPeer::DATABASE_NAME);
        $criteria->add(LeasingNationalityPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingNationality (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNationalityName($this->getNationalityName());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingAppointmentLeadss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingAppointmentLeads($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingBookingLeadss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingBookingLeads($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingEventLeadss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingEventLeads($relObj->copy($deepCopy));
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
     * @return LeasingNationality Clone of current object.
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
     * @return LeasingNationalityPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingNationalityPeer();
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
        if ('LeasingAppointmentLeads' == $relationName) {
            $this->initLeasingAppointmentLeadss();
        }
        if ('LeasingBookingLeads' == $relationName) {
            $this->initLeasingBookingLeadss();
        }
        if ('LeasingEventLeads' == $relationName) {
            $this->initLeasingEventLeadss();
        }
    }

    /**
     * Clears out the collLeasingAppointmentLeadss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingNationality The current object (for fluent API support)
     * @see        addLeasingAppointmentLeadss()
     */
    public function clearLeasingAppointmentLeadss()
    {
        $this->collLeasingAppointmentLeadss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingAppointmentLeadssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingAppointmentLeadss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingAppointmentLeadss($v = true)
    {
        $this->collLeasingAppointmentLeadssPartial = $v;
    }

    /**
     * Initializes the collLeasingAppointmentLeadss collection.
     *
     * By default this just sets the collLeasingAppointmentLeadss collection to an empty array (like clearcollLeasingAppointmentLeadss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingAppointmentLeadss($overrideExisting = true)
    {
        if (null !== $this->collLeasingAppointmentLeadss && !$overrideExisting) {
            return;
        }
        $this->collLeasingAppointmentLeadss = new PropelObjectCollection();
        $this->collLeasingAppointmentLeadss->setModel('LeasingAppointmentLeads');
    }

    /**
     * Gets an array of LeasingAppointmentLeads objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingNationality is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingAppointmentLeads[] List of LeasingAppointmentLeads objects
     * @throws PropelException
     */
    public function getLeasingAppointmentLeadss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentLeadssPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentLeadss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentLeadss) {
                // return empty collection
                $this->initLeasingAppointmentLeadss();
            } else {
                $collLeasingAppointmentLeadss = LeasingAppointmentLeadsQuery::create(null, $criteria)
                    ->filterByLeasingNationality($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingAppointmentLeadssPartial && count($collLeasingAppointmentLeadss)) {
                      $this->initLeasingAppointmentLeadss(false);

                      foreach ($collLeasingAppointmentLeadss as $obj) {
                        if (false == $this->collLeasingAppointmentLeadss->contains($obj)) {
                          $this->collLeasingAppointmentLeadss->append($obj);
                        }
                      }

                      $this->collLeasingAppointmentLeadssPartial = true;
                    }

                    $collLeasingAppointmentLeadss->getInternalIterator()->rewind();

                    return $collLeasingAppointmentLeadss;
                }

                if ($partial && $this->collLeasingAppointmentLeadss) {
                    foreach ($this->collLeasingAppointmentLeadss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingAppointmentLeadss[] = $obj;
                        }
                    }
                }

                $this->collLeasingAppointmentLeadss = $collLeasingAppointmentLeadss;
                $this->collLeasingAppointmentLeadssPartial = false;
            }
        }

        return $this->collLeasingAppointmentLeadss;
    }

    /**
     * Sets a collection of LeasingAppointmentLeads objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingAppointmentLeadss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function setLeasingAppointmentLeadss(PropelCollection $leasingAppointmentLeadss, PropelPDO $con = null)
    {
        $leasingAppointmentLeadssToDelete = $this->getLeasingAppointmentLeadss(new Criteria(), $con)->diff($leasingAppointmentLeadss);


        $this->leasingAppointmentLeadssScheduledForDeletion = $leasingAppointmentLeadssToDelete;

        foreach ($leasingAppointmentLeadssToDelete as $leasingAppointmentLeadsRemoved) {
            $leasingAppointmentLeadsRemoved->setLeasingNationality(null);
        }

        $this->collLeasingAppointmentLeadss = null;
        foreach ($leasingAppointmentLeadss as $leasingAppointmentLeads) {
            $this->addLeasingAppointmentLeads($leasingAppointmentLeads);
        }

        $this->collLeasingAppointmentLeadss = $leasingAppointmentLeadss;
        $this->collLeasingAppointmentLeadssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingAppointmentLeads objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingAppointmentLeads objects.
     * @throws PropelException
     */
    public function countLeasingAppointmentLeadss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentLeadssPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentLeadss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentLeadss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingAppointmentLeadss());
            }
            $query = LeasingAppointmentLeadsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingNationality($this)
                ->count($con);
        }

        return count($this->collLeasingAppointmentLeadss);
    }

    /**
     * Method called to associate a LeasingAppointmentLeads object to this object
     * through the LeasingAppointmentLeads foreign key attribute.
     *
     * @param    LeasingAppointmentLeads $l LeasingAppointmentLeads
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function addLeasingAppointmentLeads(LeasingAppointmentLeads $l)
    {
        if ($this->collLeasingAppointmentLeadss === null) {
            $this->initLeasingAppointmentLeadss();
            $this->collLeasingAppointmentLeadssPartial = true;
        }

        if (!in_array($l, $this->collLeasingAppointmentLeadss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingAppointmentLeads($l);

            if ($this->leasingAppointmentLeadssScheduledForDeletion and $this->leasingAppointmentLeadssScheduledForDeletion->contains($l)) {
                $this->leasingAppointmentLeadssScheduledForDeletion->remove($this->leasingAppointmentLeadssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingAppointmentLeads $leasingAppointmentLeads The leasingAppointmentLeads object to add.
     */
    protected function doAddLeasingAppointmentLeads($leasingAppointmentLeads)
    {
        $this->collLeasingAppointmentLeadss[]= $leasingAppointmentLeads;
        $leasingAppointmentLeads->setLeasingNationality($this);
    }

    /**
     * @param	LeasingAppointmentLeads $leasingAppointmentLeads The leasingAppointmentLeads object to remove.
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function removeLeasingAppointmentLeads($leasingAppointmentLeads)
    {
        if ($this->getLeasingAppointmentLeadss()->contains($leasingAppointmentLeads)) {
            $this->collLeasingAppointmentLeadss->remove($this->collLeasingAppointmentLeadss->search($leasingAppointmentLeads));
            if (null === $this->leasingAppointmentLeadssScheduledForDeletion) {
                $this->leasingAppointmentLeadssScheduledForDeletion = clone $this->collLeasingAppointmentLeadss;
                $this->leasingAppointmentLeadssScheduledForDeletion->clear();
            }
            $this->leasingAppointmentLeadssScheduledForDeletion[]= $leasingAppointmentLeads;
            $leasingAppointmentLeads->setLeasingNationality(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingNationality is new, it will return
     * an empty collection; or if this LeasingNationality has previously
     * been saved, it will retrieve related LeasingAppointmentLeadss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingNationality.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingAppointmentLeads[] List of LeasingAppointmentLeads objects
     */
    public function getLeasingAppointmentLeadssJoinLeasingCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingAppointmentLeadsQuery::create(null, $criteria);
        $query->joinWith('LeasingCountry', $join_behavior);

        return $this->getLeasingAppointmentLeadss($query, $con);
    }

    /**
     * Clears out the collLeasingBookingLeadss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingNationality The current object (for fluent API support)
     * @see        addLeasingBookingLeadss()
     */
    public function clearLeasingBookingLeadss()
    {
        $this->collLeasingBookingLeadss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingBookingLeadssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingBookingLeadss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingBookingLeadss($v = true)
    {
        $this->collLeasingBookingLeadssPartial = $v;
    }

    /**
     * Initializes the collLeasingBookingLeadss collection.
     *
     * By default this just sets the collLeasingBookingLeadss collection to an empty array (like clearcollLeasingBookingLeadss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingBookingLeadss($overrideExisting = true)
    {
        if (null !== $this->collLeasingBookingLeadss && !$overrideExisting) {
            return;
        }
        $this->collLeasingBookingLeadss = new PropelObjectCollection();
        $this->collLeasingBookingLeadss->setModel('LeasingBookingLeads');
    }

    /**
     * Gets an array of LeasingBookingLeads objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingNationality is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingBookingLeads[] List of LeasingBookingLeads objects
     * @throws PropelException
     */
    public function getLeasingBookingLeadss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingBookingLeadssPartial && !$this->isNew();
        if (null === $this->collLeasingBookingLeadss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingBookingLeadss) {
                // return empty collection
                $this->initLeasingBookingLeadss();
            } else {
                $collLeasingBookingLeadss = LeasingBookingLeadsQuery::create(null, $criteria)
                    ->filterByLeasingNationality($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingBookingLeadssPartial && count($collLeasingBookingLeadss)) {
                      $this->initLeasingBookingLeadss(false);

                      foreach ($collLeasingBookingLeadss as $obj) {
                        if (false == $this->collLeasingBookingLeadss->contains($obj)) {
                          $this->collLeasingBookingLeadss->append($obj);
                        }
                      }

                      $this->collLeasingBookingLeadssPartial = true;
                    }

                    $collLeasingBookingLeadss->getInternalIterator()->rewind();

                    return $collLeasingBookingLeadss;
                }

                if ($partial && $this->collLeasingBookingLeadss) {
                    foreach ($this->collLeasingBookingLeadss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingBookingLeadss[] = $obj;
                        }
                    }
                }

                $this->collLeasingBookingLeadss = $collLeasingBookingLeadss;
                $this->collLeasingBookingLeadssPartial = false;
            }
        }

        return $this->collLeasingBookingLeadss;
    }

    /**
     * Sets a collection of LeasingBookingLeads objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingBookingLeadss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function setLeasingBookingLeadss(PropelCollection $leasingBookingLeadss, PropelPDO $con = null)
    {
        $leasingBookingLeadssToDelete = $this->getLeasingBookingLeadss(new Criteria(), $con)->diff($leasingBookingLeadss);


        $this->leasingBookingLeadssScheduledForDeletion = $leasingBookingLeadssToDelete;

        foreach ($leasingBookingLeadssToDelete as $leasingBookingLeadsRemoved) {
            $leasingBookingLeadsRemoved->setLeasingNationality(null);
        }

        $this->collLeasingBookingLeadss = null;
        foreach ($leasingBookingLeadss as $leasingBookingLeads) {
            $this->addLeasingBookingLeads($leasingBookingLeads);
        }

        $this->collLeasingBookingLeadss = $leasingBookingLeadss;
        $this->collLeasingBookingLeadssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingBookingLeads objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingBookingLeads objects.
     * @throws PropelException
     */
    public function countLeasingBookingLeadss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingBookingLeadssPartial && !$this->isNew();
        if (null === $this->collLeasingBookingLeadss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingBookingLeadss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingBookingLeadss());
            }
            $query = LeasingBookingLeadsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingNationality($this)
                ->count($con);
        }

        return count($this->collLeasingBookingLeadss);
    }

    /**
     * Method called to associate a LeasingBookingLeads object to this object
     * through the LeasingBookingLeads foreign key attribute.
     *
     * @param    LeasingBookingLeads $l LeasingBookingLeads
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function addLeasingBookingLeads(LeasingBookingLeads $l)
    {
        if ($this->collLeasingBookingLeadss === null) {
            $this->initLeasingBookingLeadss();
            $this->collLeasingBookingLeadssPartial = true;
        }

        if (!in_array($l, $this->collLeasingBookingLeadss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingBookingLeads($l);

            if ($this->leasingBookingLeadssScheduledForDeletion and $this->leasingBookingLeadssScheduledForDeletion->contains($l)) {
                $this->leasingBookingLeadssScheduledForDeletion->remove($this->leasingBookingLeadssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingBookingLeads $leasingBookingLeads The leasingBookingLeads object to add.
     */
    protected function doAddLeasingBookingLeads($leasingBookingLeads)
    {
        $this->collLeasingBookingLeadss[]= $leasingBookingLeads;
        $leasingBookingLeads->setLeasingNationality($this);
    }

    /**
     * @param	LeasingBookingLeads $leasingBookingLeads The leasingBookingLeads object to remove.
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function removeLeasingBookingLeads($leasingBookingLeads)
    {
        if ($this->getLeasingBookingLeadss()->contains($leasingBookingLeads)) {
            $this->collLeasingBookingLeadss->remove($this->collLeasingBookingLeadss->search($leasingBookingLeads));
            if (null === $this->leasingBookingLeadssScheduledForDeletion) {
                $this->leasingBookingLeadssScheduledForDeletion = clone $this->collLeasingBookingLeadss;
                $this->leasingBookingLeadssScheduledForDeletion->clear();
            }
            $this->leasingBookingLeadssScheduledForDeletion[]= $leasingBookingLeads;
            $leasingBookingLeads->setLeasingNationality(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingNationality is new, it will return
     * an empty collection; or if this LeasingNationality has previously
     * been saved, it will retrieve related LeasingBookingLeadss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingNationality.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingBookingLeads[] List of LeasingBookingLeads objects
     */
    public function getLeasingBookingLeadssJoinLeasingCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingBookingLeadsQuery::create(null, $criteria);
        $query->joinWith('LeasingCountry', $join_behavior);

        return $this->getLeasingBookingLeadss($query, $con);
    }

    /**
     * Clears out the collLeasingEventLeadss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingNationality The current object (for fluent API support)
     * @see        addLeasingEventLeadss()
     */
    public function clearLeasingEventLeadss()
    {
        $this->collLeasingEventLeadss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingEventLeadssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingEventLeadss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingEventLeadss($v = true)
    {
        $this->collLeasingEventLeadssPartial = $v;
    }

    /**
     * Initializes the collLeasingEventLeadss collection.
     *
     * By default this just sets the collLeasingEventLeadss collection to an empty array (like clearcollLeasingEventLeadss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingEventLeadss($overrideExisting = true)
    {
        if (null !== $this->collLeasingEventLeadss && !$overrideExisting) {
            return;
        }
        $this->collLeasingEventLeadss = new PropelObjectCollection();
        $this->collLeasingEventLeadss->setModel('LeasingEventLeads');
    }

    /**
     * Gets an array of LeasingEventLeads objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingNationality is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingEventLeads[] List of LeasingEventLeads objects
     * @throws PropelException
     */
    public function getLeasingEventLeadss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventLeadssPartial && !$this->isNew();
        if (null === $this->collLeasingEventLeadss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventLeadss) {
                // return empty collection
                $this->initLeasingEventLeadss();
            } else {
                $collLeasingEventLeadss = LeasingEventLeadsQuery::create(null, $criteria)
                    ->filterByLeasingNationality($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingEventLeadssPartial && count($collLeasingEventLeadss)) {
                      $this->initLeasingEventLeadss(false);

                      foreach ($collLeasingEventLeadss as $obj) {
                        if (false == $this->collLeasingEventLeadss->contains($obj)) {
                          $this->collLeasingEventLeadss->append($obj);
                        }
                      }

                      $this->collLeasingEventLeadssPartial = true;
                    }

                    $collLeasingEventLeadss->getInternalIterator()->rewind();

                    return $collLeasingEventLeadss;
                }

                if ($partial && $this->collLeasingEventLeadss) {
                    foreach ($this->collLeasingEventLeadss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingEventLeadss[] = $obj;
                        }
                    }
                }

                $this->collLeasingEventLeadss = $collLeasingEventLeadss;
                $this->collLeasingEventLeadssPartial = false;
            }
        }

        return $this->collLeasingEventLeadss;
    }

    /**
     * Sets a collection of LeasingEventLeads objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingEventLeadss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function setLeasingEventLeadss(PropelCollection $leasingEventLeadss, PropelPDO $con = null)
    {
        $leasingEventLeadssToDelete = $this->getLeasingEventLeadss(new Criteria(), $con)->diff($leasingEventLeadss);


        $this->leasingEventLeadssScheduledForDeletion = $leasingEventLeadssToDelete;

        foreach ($leasingEventLeadssToDelete as $leasingEventLeadsRemoved) {
            $leasingEventLeadsRemoved->setLeasingNationality(null);
        }

        $this->collLeasingEventLeadss = null;
        foreach ($leasingEventLeadss as $leasingEventLeads) {
            $this->addLeasingEventLeads($leasingEventLeads);
        }

        $this->collLeasingEventLeadss = $leasingEventLeadss;
        $this->collLeasingEventLeadssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingEventLeads objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingEventLeads objects.
     * @throws PropelException
     */
    public function countLeasingEventLeadss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventLeadssPartial && !$this->isNew();
        if (null === $this->collLeasingEventLeadss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventLeadss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingEventLeadss());
            }
            $query = LeasingEventLeadsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingNationality($this)
                ->count($con);
        }

        return count($this->collLeasingEventLeadss);
    }

    /**
     * Method called to associate a LeasingEventLeads object to this object
     * through the LeasingEventLeads foreign key attribute.
     *
     * @param    LeasingEventLeads $l LeasingEventLeads
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function addLeasingEventLeads(LeasingEventLeads $l)
    {
        if ($this->collLeasingEventLeadss === null) {
            $this->initLeasingEventLeadss();
            $this->collLeasingEventLeadssPartial = true;
        }

        if (!in_array($l, $this->collLeasingEventLeadss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingEventLeads($l);

            if ($this->leasingEventLeadssScheduledForDeletion and $this->leasingEventLeadssScheduledForDeletion->contains($l)) {
                $this->leasingEventLeadssScheduledForDeletion->remove($this->leasingEventLeadssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingEventLeads $leasingEventLeads The leasingEventLeads object to add.
     */
    protected function doAddLeasingEventLeads($leasingEventLeads)
    {
        $this->collLeasingEventLeadss[]= $leasingEventLeads;
        $leasingEventLeads->setLeasingNationality($this);
    }

    /**
     * @param	LeasingEventLeads $leasingEventLeads The leasingEventLeads object to remove.
     * @return LeasingNationality The current object (for fluent API support)
     */
    public function removeLeasingEventLeads($leasingEventLeads)
    {
        if ($this->getLeasingEventLeadss()->contains($leasingEventLeads)) {
            $this->collLeasingEventLeadss->remove($this->collLeasingEventLeadss->search($leasingEventLeads));
            if (null === $this->leasingEventLeadssScheduledForDeletion) {
                $this->leasingEventLeadssScheduledForDeletion = clone $this->collLeasingEventLeadss;
                $this->leasingEventLeadssScheduledForDeletion->clear();
            }
            $this->leasingEventLeadssScheduledForDeletion[]= $leasingEventLeads;
            $leasingEventLeads->setLeasingNationality(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingNationality is new, it will return
     * an empty collection; or if this LeasingNationality has previously
     * been saved, it will retrieve related LeasingEventLeadss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingNationality.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingEventLeads[] List of LeasingEventLeads objects
     */
    public function getLeasingEventLeadssJoinLeasingCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingEventLeadsQuery::create(null, $criteria);
        $query->joinWith('LeasingCountry', $join_behavior);

        return $this->getLeasingEventLeadss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->nationality_name = null;
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
            if ($this->collLeasingAppointmentLeadss) {
                foreach ($this->collLeasingAppointmentLeadss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingBookingLeadss) {
                foreach ($this->collLeasingBookingLeadss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingEventLeadss) {
                foreach ($this->collLeasingEventLeadss as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingAppointmentLeadss instanceof PropelCollection) {
            $this->collLeasingAppointmentLeadss->clearIterator();
        }
        $this->collLeasingAppointmentLeadss = null;
        if ($this->collLeasingBookingLeadss instanceof PropelCollection) {
            $this->collLeasingBookingLeadss->clearIterator();
        }
        $this->collLeasingBookingLeadss = null;
        if ($this->collLeasingEventLeadss instanceof PropelCollection) {
            $this->collLeasingEventLeadss->clearIterator();
        }
        $this->collLeasingEventLeadss = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingNationalityPeer::DEFAULT_STRING_FORMAT);
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
