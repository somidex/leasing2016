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
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingTenantsQuery;
use Leasing\CoreBundle\Model\LeasingUnitOwner;
use Leasing\CoreBundle\Model\LeasingUnitOwnerPeer;
use Leasing\CoreBundle\Model\LeasingUnitOwnerQuery;

abstract class BaseLeasingUnitOwner extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingUnitOwnerPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingUnitOwnerPeer
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
     * The value for the contact field.
     * @var        string
     */
    protected $contact;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the representative field.
     * @var        string
     */
    protected $representative;

    /**
     * The value for the rep_contact field.
     * @var        string
     */
    protected $rep_contact;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        PropelObjectCollection|LeasingTenants[] Collection to store aggregation of LeasingTenants objects.
     */
    protected $collLeasingTenantss;
    protected $collLeasingTenantssPartial;

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
    protected $leasingTenantssScheduledForDeletion = null;

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
     * Get the [contact] column value.
     *
     * @return string
     */
    public function getContact()
    {

        return $this->contact;
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
     * Get the [representative] column value.
     *
     * @return string
     */
    public function getRepresentative()
    {

        return $this->representative;
    }

    /**
     * Get the [rep_contact] column value.
     *
     * @return string
     */
    public function getRepContact()
    {

        return $this->rep_contact;
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
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [contact] column.
     *
     * @param  string $v new value
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::CONTACT;
        }


        return $this;
    } // setContact()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [representative] column.
     *
     * @param  string $v new value
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setRepresentative($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->representative !== $v) {
            $this->representative = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::REPRESENTATIVE;
        }


        return $this;
    } // setRepresentative()

    /**
     * Set the value of [rep_contact] column.
     *
     * @param  string $v new value
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setRepContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rep_contact !== $v) {
            $this->rep_contact = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::REP_CONTACT;
        }


        return $this;
    } // setRepContact()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingUnitOwnerPeer::STATUS;
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
            $this->contact = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->email = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->representative = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->rep_contact = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->status = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = LeasingUnitOwnerPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingUnitOwner object", $e);
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
            $con = Propel::getConnection(LeasingUnitOwnerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingUnitOwnerPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLeasingTenantss = null;

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
            $con = Propel::getConnection(LeasingUnitOwnerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingUnitOwnerQuery::create()
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
            $con = Propel::getConnection(LeasingUnitOwnerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingUnitOwnerPeer::addInstanceToPool($this);
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

            if ($this->leasingTenantssScheduledForDeletion !== null) {
                if (!$this->leasingTenantssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingTenantssScheduledForDeletion as $leasingTenants) {
                        // need to save related object because we set the relation to null
                        $leasingTenants->save($con);
                    }
                    $this->leasingTenantssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingTenantss !== null) {
                foreach ($this->collLeasingTenantss as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingUnitOwnerPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingUnitOwnerPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingUnitOwnerPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingUnitOwnerPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(LeasingUnitOwnerPeer::CONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`contact`';
        }
        if ($this->isColumnModified(LeasingUnitOwnerPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingUnitOwnerPeer::REPRESENTATIVE)) {
            $modifiedColumns[':p' . $index++]  = '`representative`';
        }
        if ($this->isColumnModified(LeasingUnitOwnerPeer::REP_CONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`rep_contact`';
        }
        if ($this->isColumnModified(LeasingUnitOwnerPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `unit_owner` (%s) VALUES (%s)',
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
                    case '`contact`':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`representative`':
                        $stmt->bindValue($identifier, $this->representative, PDO::PARAM_STR);
                        break;
                    case '`rep_contact`':
                        $stmt->bindValue($identifier, $this->rep_contact, PDO::PARAM_STR);
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


            if (($retval = LeasingUnitOwnerPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingTenantss !== null) {
                    foreach ($this->collLeasingTenantss as $referrerFK) {
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
        $pos = LeasingUnitOwnerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getContact();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getRepresentative();
                break;
            case 5:
                return $this->getRepContact();
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
        if (isset($alreadyDumpedObjects['LeasingUnitOwner'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingUnitOwner'][$this->getPrimaryKey()] = true;
        $keys = LeasingUnitOwnerPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getContact(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getRepresentative(),
            $keys[5] => $this->getRepContact(),
            $keys[6] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLeasingTenantss) {
                $result['LeasingTenantss'] = $this->collLeasingTenantss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingUnitOwnerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setContact($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setRepresentative($value);
                break;
            case 5:
                $this->setRepContact($value);
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
        $keys = LeasingUnitOwnerPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setContact($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEmail($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRepresentative($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRepContact($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingUnitOwnerPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingUnitOwnerPeer::ID)) $criteria->add(LeasingUnitOwnerPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingUnitOwnerPeer::NAME)) $criteria->add(LeasingUnitOwnerPeer::NAME, $this->name);
        if ($this->isColumnModified(LeasingUnitOwnerPeer::CONTACT)) $criteria->add(LeasingUnitOwnerPeer::CONTACT, $this->contact);
        if ($this->isColumnModified(LeasingUnitOwnerPeer::EMAIL)) $criteria->add(LeasingUnitOwnerPeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingUnitOwnerPeer::REPRESENTATIVE)) $criteria->add(LeasingUnitOwnerPeer::REPRESENTATIVE, $this->representative);
        if ($this->isColumnModified(LeasingUnitOwnerPeer::REP_CONTACT)) $criteria->add(LeasingUnitOwnerPeer::REP_CONTACT, $this->rep_contact);
        if ($this->isColumnModified(LeasingUnitOwnerPeer::STATUS)) $criteria->add(LeasingUnitOwnerPeer::STATUS, $this->status);

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
        $criteria = new Criteria(LeasingUnitOwnerPeer::DATABASE_NAME);
        $criteria->add(LeasingUnitOwnerPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingUnitOwner (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setContact($this->getContact());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setRepresentative($this->getRepresentative());
        $copyObj->setRepContact($this->getRepContact());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingTenantss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingTenants($relObj->copy($deepCopy));
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
     * @return LeasingUnitOwner Clone of current object.
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
     * @return LeasingUnitOwnerPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingUnitOwnerPeer();
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
        if ('LeasingTenants' == $relationName) {
            $this->initLeasingTenantss();
        }
    }

    /**
     * Clears out the collLeasingTenantss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnitOwner The current object (for fluent API support)
     * @see        addLeasingTenantss()
     */
    public function clearLeasingTenantss()
    {
        $this->collLeasingTenantss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingTenantssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingTenantss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingTenantss($v = true)
    {
        $this->collLeasingTenantssPartial = $v;
    }

    /**
     * Initializes the collLeasingTenantss collection.
     *
     * By default this just sets the collLeasingTenantss collection to an empty array (like clearcollLeasingTenantss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingTenantss($overrideExisting = true)
    {
        if (null !== $this->collLeasingTenantss && !$overrideExisting) {
            return;
        }
        $this->collLeasingTenantss = new PropelObjectCollection();
        $this->collLeasingTenantss->setModel('LeasingTenants');
    }

    /**
     * Gets an array of LeasingTenants objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingUnitOwner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingTenants[] List of LeasingTenants objects
     * @throws PropelException
     */
    public function getLeasingTenantss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingTenantssPartial && !$this->isNew();
        if (null === $this->collLeasingTenantss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingTenantss) {
                // return empty collection
                $this->initLeasingTenantss();
            } else {
                $collLeasingTenantss = LeasingTenantsQuery::create(null, $criteria)
                    ->filterByLeasingUnitOwner($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingTenantssPartial && count($collLeasingTenantss)) {
                      $this->initLeasingTenantss(false);

                      foreach ($collLeasingTenantss as $obj) {
                        if (false == $this->collLeasingTenantss->contains($obj)) {
                          $this->collLeasingTenantss->append($obj);
                        }
                      }

                      $this->collLeasingTenantssPartial = true;
                    }

                    $collLeasingTenantss->getInternalIterator()->rewind();

                    return $collLeasingTenantss;
                }

                if ($partial && $this->collLeasingTenantss) {
                    foreach ($this->collLeasingTenantss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingTenantss[] = $obj;
                        }
                    }
                }

                $this->collLeasingTenantss = $collLeasingTenantss;
                $this->collLeasingTenantssPartial = false;
            }
        }

        return $this->collLeasingTenantss;
    }

    /**
     * Sets a collection of LeasingTenants objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingTenantss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function setLeasingTenantss(PropelCollection $leasingTenantss, PropelPDO $con = null)
    {
        $leasingTenantssToDelete = $this->getLeasingTenantss(new Criteria(), $con)->diff($leasingTenantss);


        $this->leasingTenantssScheduledForDeletion = $leasingTenantssToDelete;

        foreach ($leasingTenantssToDelete as $leasingTenantsRemoved) {
            $leasingTenantsRemoved->setLeasingUnitOwner(null);
        }

        $this->collLeasingTenantss = null;
        foreach ($leasingTenantss as $leasingTenants) {
            $this->addLeasingTenants($leasingTenants);
        }

        $this->collLeasingTenantss = $leasingTenantss;
        $this->collLeasingTenantssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingTenants objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingTenants objects.
     * @throws PropelException
     */
    public function countLeasingTenantss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingTenantssPartial && !$this->isNew();
        if (null === $this->collLeasingTenantss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingTenantss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingTenantss());
            }
            $query = LeasingTenantsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingUnitOwner($this)
                ->count($con);
        }

        return count($this->collLeasingTenantss);
    }

    /**
     * Method called to associate a LeasingTenants object to this object
     * through the LeasingTenants foreign key attribute.
     *
     * @param    LeasingTenants $l LeasingTenants
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function addLeasingTenants(LeasingTenants $l)
    {
        if ($this->collLeasingTenantss === null) {
            $this->initLeasingTenantss();
            $this->collLeasingTenantssPartial = true;
        }

        if (!in_array($l, $this->collLeasingTenantss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingTenants($l);

            if ($this->leasingTenantssScheduledForDeletion and $this->leasingTenantssScheduledForDeletion->contains($l)) {
                $this->leasingTenantssScheduledForDeletion->remove($this->leasingTenantssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingTenants $leasingTenants The leasingTenants object to add.
     */
    protected function doAddLeasingTenants($leasingTenants)
    {
        $this->collLeasingTenantss[]= $leasingTenants;
        $leasingTenants->setLeasingUnitOwner($this);
    }

    /**
     * @param	LeasingTenants $leasingTenants The leasingTenants object to remove.
     * @return LeasingUnitOwner The current object (for fluent API support)
     */
    public function removeLeasingTenants($leasingTenants)
    {
        if ($this->getLeasingTenantss()->contains($leasingTenants)) {
            $this->collLeasingTenantss->remove($this->collLeasingTenantss->search($leasingTenants));
            if (null === $this->leasingTenantssScheduledForDeletion) {
                $this->leasingTenantssScheduledForDeletion = clone $this->collLeasingTenantss;
                $this->leasingTenantssScheduledForDeletion->clear();
            }
            $this->leasingTenantssScheduledForDeletion[]= $leasingTenants;
            $leasingTenants->setLeasingUnitOwner(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnitOwner is new, it will return
     * an empty collection; or if this LeasingUnitOwner has previously
     * been saved, it will retrieve related LeasingTenantss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnitOwner.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingTenants[] List of LeasingTenants objects
     */
    public function getLeasingTenantssJoinLeasingAccountType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingTenantsQuery::create(null, $criteria);
        $query->joinWith('LeasingAccountType', $join_behavior);

        return $this->getLeasingTenantss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnitOwner is new, it will return
     * an empty collection; or if this LeasingUnitOwner has previously
     * been saved, it will retrieve related LeasingTenantss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnitOwner.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingTenants[] List of LeasingTenants objects
     */
    public function getLeasingTenantssJoinLeasingUnit($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingTenantsQuery::create(null, $criteria);
        $query->joinWith('LeasingUnit', $join_behavior);

        return $this->getLeasingTenantss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->contact = null;
        $this->email = null;
        $this->representative = null;
        $this->rep_contact = null;
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
            if ($this->collLeasingTenantss) {
                foreach ($this->collLeasingTenantss as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingTenantss instanceof PropelCollection) {
            $this->collLeasingTenantss->clearIterator();
        }
        $this->collLeasingTenantss = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingUnitOwnerPeer::DEFAULT_STRING_FORMAT);
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
