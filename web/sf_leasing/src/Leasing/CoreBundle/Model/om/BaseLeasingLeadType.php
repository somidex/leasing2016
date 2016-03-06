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
use Leasing\CoreBundle\Model\LeasingGaData;
use Leasing\CoreBundle\Model\LeasingGaDataQuery;
use Leasing\CoreBundle\Model\LeasingLeadDocument;
use Leasing\CoreBundle\Model\LeasingLeadDocumentQuery;
use Leasing\CoreBundle\Model\LeasingLeadType;
use Leasing\CoreBundle\Model\LeasingLeadTypePeer;
use Leasing\CoreBundle\Model\LeasingLeadTypeQuery;
use Leasing\CoreBundle\Model\LeasingTimelineActivity;
use Leasing\CoreBundle\Model\LeasingTimelineActivityQuery;

abstract class BaseLeasingLeadType extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingLeadTypePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingLeadTypePeer
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
     * @var        PropelObjectCollection|LeasingGaData[] Collection to store aggregation of LeasingGaData objects.
     */
    protected $collLeasingGaDatas;
    protected $collLeasingGaDatasPartial;

    /**
     * @var        PropelObjectCollection|LeasingLeadDocument[] Collection to store aggregation of LeasingLeadDocument objects.
     */
    protected $collLeasingLeadDocuments;
    protected $collLeasingLeadDocumentsPartial;

    /**
     * @var        PropelObjectCollection|LeasingTimelineActivity[] Collection to store aggregation of LeasingTimelineActivity objects.
     */
    protected $collLeasingTimelineActivities;
    protected $collLeasingTimelineActivitiesPartial;

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
    protected $leasingGaDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingLeadDocumentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingTimelineActivitiesScheduledForDeletion = null;

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
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingLeadTypePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = LeasingLeadTypePeer::NAME;
        }


        return $this;
    } // setName()

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
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 2; // 2 = LeasingLeadTypePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingLeadType object", $e);
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
            $con = Propel::getConnection(LeasingLeadTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingLeadTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLeasingGaDatas = null;

            $this->collLeasingLeadDocuments = null;

            $this->collLeasingTimelineActivities = null;

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
            $con = Propel::getConnection(LeasingLeadTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingLeadTypeQuery::create()
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
            $con = Propel::getConnection(LeasingLeadTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingLeadTypePeer::addInstanceToPool($this);
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

            if ($this->leasingGaDatasScheduledForDeletion !== null) {
                if (!$this->leasingGaDatasScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingGaDatasScheduledForDeletion as $leasingGaData) {
                        // need to save related object because we set the relation to null
                        $leasingGaData->save($con);
                    }
                    $this->leasingGaDatasScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingGaDatas !== null) {
                foreach ($this->collLeasingGaDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingLeadDocumentsScheduledForDeletion !== null) {
                if (!$this->leasingLeadDocumentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingLeadDocumentsScheduledForDeletion as $leasingLeadDocument) {
                        // need to save related object because we set the relation to null
                        $leasingLeadDocument->save($con);
                    }
                    $this->leasingLeadDocumentsScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingLeadDocuments !== null) {
                foreach ($this->collLeasingLeadDocuments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingTimelineActivitiesScheduledForDeletion !== null) {
                if (!$this->leasingTimelineActivitiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingTimelineActivitiesScheduledForDeletion as $leasingTimelineActivity) {
                        // need to save related object because we set the relation to null
                        $leasingTimelineActivity->save($con);
                    }
                    $this->leasingTimelineActivitiesScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingTimelineActivities !== null) {
                foreach ($this->collLeasingTimelineActivities as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingLeadTypePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingLeadTypePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingLeadTypePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingLeadTypePeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }

        $sql = sprintf(
            'INSERT INTO `lead_type` (%s) VALUES (%s)',
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


            if (($retval = LeasingLeadTypePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingGaDatas !== null) {
                    foreach ($this->collLeasingGaDatas as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingLeadDocuments !== null) {
                    foreach ($this->collLeasingLeadDocuments as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingTimelineActivities !== null) {
                    foreach ($this->collLeasingTimelineActivities as $referrerFK) {
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
        $pos = LeasingLeadTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['LeasingLeadType'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingLeadType'][$this->getPrimaryKey()] = true;
        $keys = LeasingLeadTypePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLeasingGaDatas) {
                $result['LeasingGaDatas'] = $this->collLeasingGaDatas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingLeadDocuments) {
                $result['LeasingLeadDocuments'] = $this->collLeasingLeadDocuments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingTimelineActivities) {
                $result['LeasingTimelineActivities'] = $this->collLeasingTimelineActivities->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingLeadTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = LeasingLeadTypePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingLeadTypePeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingLeadTypePeer::ID)) $criteria->add(LeasingLeadTypePeer::ID, $this->id);
        if ($this->isColumnModified(LeasingLeadTypePeer::NAME)) $criteria->add(LeasingLeadTypePeer::NAME, $this->name);

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
        $criteria = new Criteria(LeasingLeadTypePeer::DATABASE_NAME);
        $criteria->add(LeasingLeadTypePeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingLeadType (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingGaDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingGaData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingLeadDocuments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingLeadDocument($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingTimelineActivities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingTimelineActivity($relObj->copy($deepCopy));
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
     * @return LeasingLeadType Clone of current object.
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
     * @return LeasingLeadTypePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingLeadTypePeer();
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
        if ('LeasingGaData' == $relationName) {
            $this->initLeasingGaDatas();
        }
        if ('LeasingLeadDocument' == $relationName) {
            $this->initLeasingLeadDocuments();
        }
        if ('LeasingTimelineActivity' == $relationName) {
            $this->initLeasingTimelineActivities();
        }
    }

    /**
     * Clears out the collLeasingGaDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingLeadType The current object (for fluent API support)
     * @see        addLeasingGaDatas()
     */
    public function clearLeasingGaDatas()
    {
        $this->collLeasingGaDatas = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingGaDatasPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingGaDatas collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingGaDatas($v = true)
    {
        $this->collLeasingGaDatasPartial = $v;
    }

    /**
     * Initializes the collLeasingGaDatas collection.
     *
     * By default this just sets the collLeasingGaDatas collection to an empty array (like clearcollLeasingGaDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingGaDatas($overrideExisting = true)
    {
        if (null !== $this->collLeasingGaDatas && !$overrideExisting) {
            return;
        }
        $this->collLeasingGaDatas = new PropelObjectCollection();
        $this->collLeasingGaDatas->setModel('LeasingGaData');
    }

    /**
     * Gets an array of LeasingGaData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingLeadType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingGaData[] List of LeasingGaData objects
     * @throws PropelException
     */
    public function getLeasingGaDatas($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingGaDatasPartial && !$this->isNew();
        if (null === $this->collLeasingGaDatas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingGaDatas) {
                // return empty collection
                $this->initLeasingGaDatas();
            } else {
                $collLeasingGaDatas = LeasingGaDataQuery::create(null, $criteria)
                    ->filterByLeasingLeadType($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingGaDatasPartial && count($collLeasingGaDatas)) {
                      $this->initLeasingGaDatas(false);

                      foreach ($collLeasingGaDatas as $obj) {
                        if (false == $this->collLeasingGaDatas->contains($obj)) {
                          $this->collLeasingGaDatas->append($obj);
                        }
                      }

                      $this->collLeasingGaDatasPartial = true;
                    }

                    $collLeasingGaDatas->getInternalIterator()->rewind();

                    return $collLeasingGaDatas;
                }

                if ($partial && $this->collLeasingGaDatas) {
                    foreach ($this->collLeasingGaDatas as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingGaDatas[] = $obj;
                        }
                    }
                }

                $this->collLeasingGaDatas = $collLeasingGaDatas;
                $this->collLeasingGaDatasPartial = false;
            }
        }

        return $this->collLeasingGaDatas;
    }

    /**
     * Sets a collection of LeasingGaData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingGaDatas A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function setLeasingGaDatas(PropelCollection $leasingGaDatas, PropelPDO $con = null)
    {
        $leasingGaDatasToDelete = $this->getLeasingGaDatas(new Criteria(), $con)->diff($leasingGaDatas);


        $this->leasingGaDatasScheduledForDeletion = $leasingGaDatasToDelete;

        foreach ($leasingGaDatasToDelete as $leasingGaDataRemoved) {
            $leasingGaDataRemoved->setLeasingLeadType(null);
        }

        $this->collLeasingGaDatas = null;
        foreach ($leasingGaDatas as $leasingGaData) {
            $this->addLeasingGaData($leasingGaData);
        }

        $this->collLeasingGaDatas = $leasingGaDatas;
        $this->collLeasingGaDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingGaData objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingGaData objects.
     * @throws PropelException
     */
    public function countLeasingGaDatas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingGaDatasPartial && !$this->isNew();
        if (null === $this->collLeasingGaDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingGaDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingGaDatas());
            }
            $query = LeasingGaDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingLeadType($this)
                ->count($con);
        }

        return count($this->collLeasingGaDatas);
    }

    /**
     * Method called to associate a LeasingGaData object to this object
     * through the LeasingGaData foreign key attribute.
     *
     * @param    LeasingGaData $l LeasingGaData
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function addLeasingGaData(LeasingGaData $l)
    {
        if ($this->collLeasingGaDatas === null) {
            $this->initLeasingGaDatas();
            $this->collLeasingGaDatasPartial = true;
        }

        if (!in_array($l, $this->collLeasingGaDatas->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingGaData($l);

            if ($this->leasingGaDatasScheduledForDeletion and $this->leasingGaDatasScheduledForDeletion->contains($l)) {
                $this->leasingGaDatasScheduledForDeletion->remove($this->leasingGaDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingGaData $leasingGaData The leasingGaData object to add.
     */
    protected function doAddLeasingGaData($leasingGaData)
    {
        $this->collLeasingGaDatas[]= $leasingGaData;
        $leasingGaData->setLeasingLeadType($this);
    }

    /**
     * @param	LeasingGaData $leasingGaData The leasingGaData object to remove.
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function removeLeasingGaData($leasingGaData)
    {
        if ($this->getLeasingGaDatas()->contains($leasingGaData)) {
            $this->collLeasingGaDatas->remove($this->collLeasingGaDatas->search($leasingGaData));
            if (null === $this->leasingGaDatasScheduledForDeletion) {
                $this->leasingGaDatasScheduledForDeletion = clone $this->collLeasingGaDatas;
                $this->leasingGaDatasScheduledForDeletion->clear();
            }
            $this->leasingGaDatasScheduledForDeletion[]= $leasingGaData;
            $leasingGaData->setLeasingLeadType(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeasingLeadDocuments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingLeadType The current object (for fluent API support)
     * @see        addLeasingLeadDocuments()
     */
    public function clearLeasingLeadDocuments()
    {
        $this->collLeasingLeadDocuments = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingLeadDocumentsPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingLeadDocuments collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingLeadDocuments($v = true)
    {
        $this->collLeasingLeadDocumentsPartial = $v;
    }

    /**
     * Initializes the collLeasingLeadDocuments collection.
     *
     * By default this just sets the collLeasingLeadDocuments collection to an empty array (like clearcollLeasingLeadDocuments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingLeadDocuments($overrideExisting = true)
    {
        if (null !== $this->collLeasingLeadDocuments && !$overrideExisting) {
            return;
        }
        $this->collLeasingLeadDocuments = new PropelObjectCollection();
        $this->collLeasingLeadDocuments->setModel('LeasingLeadDocument');
    }

    /**
     * Gets an array of LeasingLeadDocument objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingLeadType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingLeadDocument[] List of LeasingLeadDocument objects
     * @throws PropelException
     */
    public function getLeasingLeadDocuments($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingLeadDocumentsPartial && !$this->isNew();
        if (null === $this->collLeasingLeadDocuments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingLeadDocuments) {
                // return empty collection
                $this->initLeasingLeadDocuments();
            } else {
                $collLeasingLeadDocuments = LeasingLeadDocumentQuery::create(null, $criteria)
                    ->filterByLeasingLeadType($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingLeadDocumentsPartial && count($collLeasingLeadDocuments)) {
                      $this->initLeasingLeadDocuments(false);

                      foreach ($collLeasingLeadDocuments as $obj) {
                        if (false == $this->collLeasingLeadDocuments->contains($obj)) {
                          $this->collLeasingLeadDocuments->append($obj);
                        }
                      }

                      $this->collLeasingLeadDocumentsPartial = true;
                    }

                    $collLeasingLeadDocuments->getInternalIterator()->rewind();

                    return $collLeasingLeadDocuments;
                }

                if ($partial && $this->collLeasingLeadDocuments) {
                    foreach ($this->collLeasingLeadDocuments as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingLeadDocuments[] = $obj;
                        }
                    }
                }

                $this->collLeasingLeadDocuments = $collLeasingLeadDocuments;
                $this->collLeasingLeadDocumentsPartial = false;
            }
        }

        return $this->collLeasingLeadDocuments;
    }

    /**
     * Sets a collection of LeasingLeadDocument objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingLeadDocuments A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function setLeasingLeadDocuments(PropelCollection $leasingLeadDocuments, PropelPDO $con = null)
    {
        $leasingLeadDocumentsToDelete = $this->getLeasingLeadDocuments(new Criteria(), $con)->diff($leasingLeadDocuments);


        $this->leasingLeadDocumentsScheduledForDeletion = $leasingLeadDocumentsToDelete;

        foreach ($leasingLeadDocumentsToDelete as $leasingLeadDocumentRemoved) {
            $leasingLeadDocumentRemoved->setLeasingLeadType(null);
        }

        $this->collLeasingLeadDocuments = null;
        foreach ($leasingLeadDocuments as $leasingLeadDocument) {
            $this->addLeasingLeadDocument($leasingLeadDocument);
        }

        $this->collLeasingLeadDocuments = $leasingLeadDocuments;
        $this->collLeasingLeadDocumentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingLeadDocument objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingLeadDocument objects.
     * @throws PropelException
     */
    public function countLeasingLeadDocuments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingLeadDocumentsPartial && !$this->isNew();
        if (null === $this->collLeasingLeadDocuments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingLeadDocuments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingLeadDocuments());
            }
            $query = LeasingLeadDocumentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingLeadType($this)
                ->count($con);
        }

        return count($this->collLeasingLeadDocuments);
    }

    /**
     * Method called to associate a LeasingLeadDocument object to this object
     * through the LeasingLeadDocument foreign key attribute.
     *
     * @param    LeasingLeadDocument $l LeasingLeadDocument
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function addLeasingLeadDocument(LeasingLeadDocument $l)
    {
        if ($this->collLeasingLeadDocuments === null) {
            $this->initLeasingLeadDocuments();
            $this->collLeasingLeadDocumentsPartial = true;
        }

        if (!in_array($l, $this->collLeasingLeadDocuments->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingLeadDocument($l);

            if ($this->leasingLeadDocumentsScheduledForDeletion and $this->leasingLeadDocumentsScheduledForDeletion->contains($l)) {
                $this->leasingLeadDocumentsScheduledForDeletion->remove($this->leasingLeadDocumentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingLeadDocument $leasingLeadDocument The leasingLeadDocument object to add.
     */
    protected function doAddLeasingLeadDocument($leasingLeadDocument)
    {
        $this->collLeasingLeadDocuments[]= $leasingLeadDocument;
        $leasingLeadDocument->setLeasingLeadType($this);
    }

    /**
     * @param	LeasingLeadDocument $leasingLeadDocument The leasingLeadDocument object to remove.
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function removeLeasingLeadDocument($leasingLeadDocument)
    {
        if ($this->getLeasingLeadDocuments()->contains($leasingLeadDocument)) {
            $this->collLeasingLeadDocuments->remove($this->collLeasingLeadDocuments->search($leasingLeadDocument));
            if (null === $this->leasingLeadDocumentsScheduledForDeletion) {
                $this->leasingLeadDocumentsScheduledForDeletion = clone $this->collLeasingLeadDocuments;
                $this->leasingLeadDocumentsScheduledForDeletion->clear();
            }
            $this->leasingLeadDocumentsScheduledForDeletion[]= $leasingLeadDocument;
            $leasingLeadDocument->setLeasingLeadType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingLeadType is new, it will return
     * an empty collection; or if this LeasingLeadType has previously
     * been saved, it will retrieve related LeasingLeadDocuments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingLeadType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingLeadDocument[] List of LeasingLeadDocument objects
     */
    public function getLeasingLeadDocumentsJoinLeasingDocument($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingLeadDocumentQuery::create(null, $criteria);
        $query->joinWith('LeasingDocument', $join_behavior);

        return $this->getLeasingLeadDocuments($query, $con);
    }

    /**
     * Clears out the collLeasingTimelineActivities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingLeadType The current object (for fluent API support)
     * @see        addLeasingTimelineActivities()
     */
    public function clearLeasingTimelineActivities()
    {
        $this->collLeasingTimelineActivities = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingTimelineActivitiesPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingTimelineActivities collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingTimelineActivities($v = true)
    {
        $this->collLeasingTimelineActivitiesPartial = $v;
    }

    /**
     * Initializes the collLeasingTimelineActivities collection.
     *
     * By default this just sets the collLeasingTimelineActivities collection to an empty array (like clearcollLeasingTimelineActivities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingTimelineActivities($overrideExisting = true)
    {
        if (null !== $this->collLeasingTimelineActivities && !$overrideExisting) {
            return;
        }
        $this->collLeasingTimelineActivities = new PropelObjectCollection();
        $this->collLeasingTimelineActivities->setModel('LeasingTimelineActivity');
    }

    /**
     * Gets an array of LeasingTimelineActivity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingLeadType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingTimelineActivity[] List of LeasingTimelineActivity objects
     * @throws PropelException
     */
    public function getLeasingTimelineActivities($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingTimelineActivitiesPartial && !$this->isNew();
        if (null === $this->collLeasingTimelineActivities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingTimelineActivities) {
                // return empty collection
                $this->initLeasingTimelineActivities();
            } else {
                $collLeasingTimelineActivities = LeasingTimelineActivityQuery::create(null, $criteria)
                    ->filterByLeasingLeadType($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingTimelineActivitiesPartial && count($collLeasingTimelineActivities)) {
                      $this->initLeasingTimelineActivities(false);

                      foreach ($collLeasingTimelineActivities as $obj) {
                        if (false == $this->collLeasingTimelineActivities->contains($obj)) {
                          $this->collLeasingTimelineActivities->append($obj);
                        }
                      }

                      $this->collLeasingTimelineActivitiesPartial = true;
                    }

                    $collLeasingTimelineActivities->getInternalIterator()->rewind();

                    return $collLeasingTimelineActivities;
                }

                if ($partial && $this->collLeasingTimelineActivities) {
                    foreach ($this->collLeasingTimelineActivities as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingTimelineActivities[] = $obj;
                        }
                    }
                }

                $this->collLeasingTimelineActivities = $collLeasingTimelineActivities;
                $this->collLeasingTimelineActivitiesPartial = false;
            }
        }

        return $this->collLeasingTimelineActivities;
    }

    /**
     * Sets a collection of LeasingTimelineActivity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingTimelineActivities A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function setLeasingTimelineActivities(PropelCollection $leasingTimelineActivities, PropelPDO $con = null)
    {
        $leasingTimelineActivitiesToDelete = $this->getLeasingTimelineActivities(new Criteria(), $con)->diff($leasingTimelineActivities);


        $this->leasingTimelineActivitiesScheduledForDeletion = $leasingTimelineActivitiesToDelete;

        foreach ($leasingTimelineActivitiesToDelete as $leasingTimelineActivityRemoved) {
            $leasingTimelineActivityRemoved->setLeasingLeadType(null);
        }

        $this->collLeasingTimelineActivities = null;
        foreach ($leasingTimelineActivities as $leasingTimelineActivity) {
            $this->addLeasingTimelineActivity($leasingTimelineActivity);
        }

        $this->collLeasingTimelineActivities = $leasingTimelineActivities;
        $this->collLeasingTimelineActivitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingTimelineActivity objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingTimelineActivity objects.
     * @throws PropelException
     */
    public function countLeasingTimelineActivities(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingTimelineActivitiesPartial && !$this->isNew();
        if (null === $this->collLeasingTimelineActivities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingTimelineActivities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingTimelineActivities());
            }
            $query = LeasingTimelineActivityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingLeadType($this)
                ->count($con);
        }

        return count($this->collLeasingTimelineActivities);
    }

    /**
     * Method called to associate a LeasingTimelineActivity object to this object
     * through the LeasingTimelineActivity foreign key attribute.
     *
     * @param    LeasingTimelineActivity $l LeasingTimelineActivity
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function addLeasingTimelineActivity(LeasingTimelineActivity $l)
    {
        if ($this->collLeasingTimelineActivities === null) {
            $this->initLeasingTimelineActivities();
            $this->collLeasingTimelineActivitiesPartial = true;
        }

        if (!in_array($l, $this->collLeasingTimelineActivities->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingTimelineActivity($l);

            if ($this->leasingTimelineActivitiesScheduledForDeletion and $this->leasingTimelineActivitiesScheduledForDeletion->contains($l)) {
                $this->leasingTimelineActivitiesScheduledForDeletion->remove($this->leasingTimelineActivitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingTimelineActivity $leasingTimelineActivity The leasingTimelineActivity object to add.
     */
    protected function doAddLeasingTimelineActivity($leasingTimelineActivity)
    {
        $this->collLeasingTimelineActivities[]= $leasingTimelineActivity;
        $leasingTimelineActivity->setLeasingLeadType($this);
    }

    /**
     * @param	LeasingTimelineActivity $leasingTimelineActivity The leasingTimelineActivity object to remove.
     * @return LeasingLeadType The current object (for fluent API support)
     */
    public function removeLeasingTimelineActivity($leasingTimelineActivity)
    {
        if ($this->getLeasingTimelineActivities()->contains($leasingTimelineActivity)) {
            $this->collLeasingTimelineActivities->remove($this->collLeasingTimelineActivities->search($leasingTimelineActivity));
            if (null === $this->leasingTimelineActivitiesScheduledForDeletion) {
                $this->leasingTimelineActivitiesScheduledForDeletion = clone $this->collLeasingTimelineActivities;
                $this->leasingTimelineActivitiesScheduledForDeletion->clear();
            }
            $this->leasingTimelineActivitiesScheduledForDeletion[]= $leasingTimelineActivity;
            $leasingTimelineActivity->setLeasingLeadType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingLeadType is new, it will return
     * an empty collection; or if this LeasingLeadType has previously
     * been saved, it will retrieve related LeasingTimelineActivities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingLeadType.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingTimelineActivity[] List of LeasingTimelineActivity objects
     */
    public function getLeasingTimelineActivitiesJoinLeasingStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingTimelineActivityQuery::create(null, $criteria);
        $query->joinWith('LeasingStatus', $join_behavior);

        return $this->getLeasingTimelineActivities($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
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
            if ($this->collLeasingGaDatas) {
                foreach ($this->collLeasingGaDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingLeadDocuments) {
                foreach ($this->collLeasingLeadDocuments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingTimelineActivities) {
                foreach ($this->collLeasingTimelineActivities as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingGaDatas instanceof PropelCollection) {
            $this->collLeasingGaDatas->clearIterator();
        }
        $this->collLeasingGaDatas = null;
        if ($this->collLeasingLeadDocuments instanceof PropelCollection) {
            $this->collLeasingLeadDocuments->clearIterator();
        }
        $this->collLeasingLeadDocuments = null;
        if ($this->collLeasingTimelineActivities instanceof PropelCollection) {
            $this->collLeasingTimelineActivities->clearIterator();
        }
        $this->collLeasingTimelineActivities = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingLeadTypePeer::DEFAULT_STRING_FORMAT);
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
