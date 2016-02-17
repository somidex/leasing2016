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
use Leasing\CoreBundle\Model\LeasingAccountType;
use Leasing\CoreBundle\Model\LeasingAccountTypeQuery;
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingTenantsPeer;
use Leasing\CoreBundle\Model\LeasingTenantsQuery;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitOwner;
use Leasing\CoreBundle\Model\LeasingUnitOwnerQuery;
use Leasing\CoreBundle\Model\LeasingUnitQuery;

abstract class BaseLeasingTenants extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingTenantsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingTenantsPeer
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
     * The value for the account_type field.
     * @var        int
     */
    protected $account_type;

    /**
     * The value for the building field.
     * @var        string
     */
    protected $building;

    /**
     * The value for the unit_id field.
     * @var        int
     */
    protected $unit_id;

    /**
     * The value for the ps_number field.
     * @var        string
     */
    protected $ps_number;

    /**
     * The value for the unit_owner_id field.
     * @var        int
     */
    protected $unit_owner_id;

    /**
     * The value for the tenant_name field.
     * @var        string
     */
    protected $tenant_name;

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
     * The value for the lease_start_date field.
     * @var        string
     */
    protected $lease_start_date;

    /**
     * The value for the lease_end_date field.
     * @var        string
     */
    protected $lease_end_date;

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
     * @var        LeasingAccountType
     */
    protected $aLeasingAccountType;

    /**
     * @var        LeasingUnit
     */
    protected $aLeasingUnit;

    /**
     * @var        LeasingUnitOwner
     */
    protected $aLeasingUnitOwner;

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
     * Get the [account_type] column value.
     *
     * @return int
     */
    public function getAccountType()
    {

        return $this->account_type;
    }

    /**
     * Get the [building] column value.
     *
     * @return string
     */
    public function getBuilding()
    {

        return $this->building;
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
     * Get the [ps_number] column value.
     *
     * @return string
     */
    public function getPsNumber()
    {

        return $this->ps_number;
    }

    /**
     * Get the [unit_owner_id] column value.
     *
     * @return int
     */
    public function getUnitOwnerId()
    {

        return $this->unit_owner_id;
    }

    /**
     * Get the [tenant_name] column value.
     *
     * @return string
     */
    public function getTenantName()
    {

        return $this->tenant_name;
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
     * Get the [lease_start_date] column value.
     *
     * @return string
     */
    public function getLeaseStartDate()
    {

        return $this->lease_start_date;
    }

    /**
     * Get the [lease_end_date] column value.
     *
     * @return string
     */
    public function getLeaseEndDate()
    {

        return $this->lease_end_date;
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
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [account_type] column.
     *
     * @param  int $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setAccountType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->account_type !== $v) {
            $this->account_type = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::ACCOUNT_TYPE;
        }

        if ($this->aLeasingAccountType !== null && $this->aLeasingAccountType->getId() !== $v) {
            $this->aLeasingAccountType = null;
        }


        return $this;
    } // setAccountType()

    /**
     * Set the value of [building] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setBuilding($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->building !== $v) {
            $this->building = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::BUILDING;
        }


        return $this;
    } // setBuilding()

    /**
     * Set the value of [unit_id] column.
     *
     * @param  int $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setUnitId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->unit_id !== $v) {
            $this->unit_id = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::UNIT_ID;
        }

        if ($this->aLeasingUnit !== null && $this->aLeasingUnit->getId() !== $v) {
            $this->aLeasingUnit = null;
        }


        return $this;
    } // setUnitId()

    /**
     * Set the value of [ps_number] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setPsNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ps_number !== $v) {
            $this->ps_number = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::PS_NUMBER;
        }


        return $this;
    } // setPsNumber()

    /**
     * Set the value of [unit_owner_id] column.
     *
     * @param  int $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setUnitOwnerId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->unit_owner_id !== $v) {
            $this->unit_owner_id = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::UNIT_OWNER_ID;
        }

        if ($this->aLeasingUnitOwner !== null && $this->aLeasingUnitOwner->getId() !== $v) {
            $this->aLeasingUnitOwner = null;
        }


        return $this;
    } // setUnitOwnerId()

    /**
     * Set the value of [tenant_name] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setTenantName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tenant_name !== $v) {
            $this->tenant_name = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::TENANT_NAME;
        }


        return $this;
    } // setTenantName()

    /**
     * Set the value of [contact] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::CONTACT;
        }


        return $this;
    } // setContact()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [lease_start_date] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setLeaseStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lease_start_date !== $v) {
            $this->lease_start_date = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::LEASE_START_DATE;
        }


        return $this;
    } // setLeaseStartDate()

    /**
     * Set the value of [lease_end_date] column.
     *
     * @param  string $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setLeaseEndDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lease_end_date !== $v) {
            $this->lease_end_date = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::LEASE_END_DATE;
        }


        return $this;
    } // setLeaseEndDate()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [prev_status] column.
     *
     * @param  int $v new value
     * @return LeasingTenants The current object (for fluent API support)
     */
    public function setPrevStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->prev_status !== $v) {
            $this->prev_status = $v;
            $this->modifiedColumns[] = LeasingTenantsPeer::PREV_STATUS;
        }


        return $this;
    } // setPrevStatus()

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
            $this->account_type = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->building = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->unit_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->ps_number = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->unit_owner_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->tenant_name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->contact = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->lease_start_date = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->lease_end_date = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->status = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->prev_status = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 13; // 13 = LeasingTenantsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingTenants object", $e);
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

        if ($this->aLeasingAccountType !== null && $this->account_type !== $this->aLeasingAccountType->getId()) {
            $this->aLeasingAccountType = null;
        }
        if ($this->aLeasingUnit !== null && $this->unit_id !== $this->aLeasingUnit->getId()) {
            $this->aLeasingUnit = null;
        }
        if ($this->aLeasingUnitOwner !== null && $this->unit_owner_id !== $this->aLeasingUnitOwner->getId()) {
            $this->aLeasingUnitOwner = null;
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
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingTenantsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingAccountType = null;
            $this->aLeasingUnit = null;
            $this->aLeasingUnitOwner = null;
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
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingTenantsQuery::create()
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
            $con = Propel::getConnection(LeasingTenantsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingTenantsPeer::addInstanceToPool($this);
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

            if ($this->aLeasingAccountType !== null) {
                if ($this->aLeasingAccountType->isModified() || $this->aLeasingAccountType->isNew()) {
                    $affectedRows += $this->aLeasingAccountType->save($con);
                }
                $this->setLeasingAccountType($this->aLeasingAccountType);
            }

            if ($this->aLeasingUnit !== null) {
                if ($this->aLeasingUnit->isModified() || $this->aLeasingUnit->isNew()) {
                    $affectedRows += $this->aLeasingUnit->save($con);
                }
                $this->setLeasingUnit($this->aLeasingUnit);
            }

            if ($this->aLeasingUnitOwner !== null) {
                if ($this->aLeasingUnitOwner->isModified() || $this->aLeasingUnitOwner->isNew()) {
                    $affectedRows += $this->aLeasingUnitOwner->save($con);
                }
                $this->setLeasingUnitOwner($this->aLeasingUnitOwner);
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

        $this->modifiedColumns[] = LeasingTenantsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingTenantsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingTenantsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::ACCOUNT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`account_type`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::BUILDING)) {
            $modifiedColumns[':p' . $index++]  = '`building`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`unit_id`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::PS_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`ps_number`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::UNIT_OWNER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`unit_owner_id`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::TENANT_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`tenant_name`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::CONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`contact`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::LEASE_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`lease_start_date`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::LEASE_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`lease_end_date`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(LeasingTenantsPeer::PREV_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`prev_status`';
        }

        $sql = sprintf(
            'INSERT INTO `tenants` (%s) VALUES (%s)',
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
                    case '`account_type`':
                        $stmt->bindValue($identifier, $this->account_type, PDO::PARAM_INT);
                        break;
                    case '`building`':
                        $stmt->bindValue($identifier, $this->building, PDO::PARAM_STR);
                        break;
                    case '`unit_id`':
                        $stmt->bindValue($identifier, $this->unit_id, PDO::PARAM_INT);
                        break;
                    case '`ps_number`':
                        $stmt->bindValue($identifier, $this->ps_number, PDO::PARAM_STR);
                        break;
                    case '`unit_owner_id`':
                        $stmt->bindValue($identifier, $this->unit_owner_id, PDO::PARAM_INT);
                        break;
                    case '`tenant_name`':
                        $stmt->bindValue($identifier, $this->tenant_name, PDO::PARAM_STR);
                        break;
                    case '`contact`':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`lease_start_date`':
                        $stmt->bindValue($identifier, $this->lease_start_date, PDO::PARAM_STR);
                        break;
                    case '`lease_end_date`':
                        $stmt->bindValue($identifier, $this->lease_end_date, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`prev_status`':
                        $stmt->bindValue($identifier, $this->prev_status, PDO::PARAM_INT);
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

            if ($this->aLeasingAccountType !== null) {
                if (!$this->aLeasingAccountType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingAccountType->getValidationFailures());
                }
            }

            if ($this->aLeasingUnit !== null) {
                if (!$this->aLeasingUnit->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnit->getValidationFailures());
                }
            }

            if ($this->aLeasingUnitOwner !== null) {
                if (!$this->aLeasingUnitOwner->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnitOwner->getValidationFailures());
                }
            }


            if (($retval = LeasingTenantsPeer::doValidate($this, $columns)) !== true) {
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
        $pos = LeasingTenantsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAccountType();
                break;
            case 2:
                return $this->getBuilding();
                break;
            case 3:
                return $this->getUnitId();
                break;
            case 4:
                return $this->getPsNumber();
                break;
            case 5:
                return $this->getUnitOwnerId();
                break;
            case 6:
                return $this->getTenantName();
                break;
            case 7:
                return $this->getContact();
                break;
            case 8:
                return $this->getEmail();
                break;
            case 9:
                return $this->getLeaseStartDate();
                break;
            case 10:
                return $this->getLeaseEndDate();
                break;
            case 11:
                return $this->getStatus();
                break;
            case 12:
                return $this->getPrevStatus();
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
        if (isset($alreadyDumpedObjects['LeasingTenants'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingTenants'][$this->getPrimaryKey()] = true;
        $keys = LeasingTenantsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAccountType(),
            $keys[2] => $this->getBuilding(),
            $keys[3] => $this->getUnitId(),
            $keys[4] => $this->getPsNumber(),
            $keys[5] => $this->getUnitOwnerId(),
            $keys[6] => $this->getTenantName(),
            $keys[7] => $this->getContact(),
            $keys[8] => $this->getEmail(),
            $keys[9] => $this->getLeaseStartDate(),
            $keys[10] => $this->getLeaseEndDate(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getPrevStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingAccountType) {
                $result['LeasingAccountType'] = $this->aLeasingAccountType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingUnit) {
                $result['LeasingUnit'] = $this->aLeasingUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingUnitOwner) {
                $result['LeasingUnitOwner'] = $this->aLeasingUnitOwner->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = LeasingTenantsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAccountType($value);
                break;
            case 2:
                $this->setBuilding($value);
                break;
            case 3:
                $this->setUnitId($value);
                break;
            case 4:
                $this->setPsNumber($value);
                break;
            case 5:
                $this->setUnitOwnerId($value);
                break;
            case 6:
                $this->setTenantName($value);
                break;
            case 7:
                $this->setContact($value);
                break;
            case 8:
                $this->setEmail($value);
                break;
            case 9:
                $this->setLeaseStartDate($value);
                break;
            case 10:
                $this->setLeaseEndDate($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setPrevStatus($value);
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
        $keys = LeasingTenantsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAccountType($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setBuilding($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUnitId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPsNumber($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUnitOwnerId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setTenantName($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setContact($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setEmail($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setLeaseStartDate($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setLeaseEndDate($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setStatus($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setPrevStatus($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingTenantsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingTenantsPeer::ID)) $criteria->add(LeasingTenantsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingTenantsPeer::ACCOUNT_TYPE)) $criteria->add(LeasingTenantsPeer::ACCOUNT_TYPE, $this->account_type);
        if ($this->isColumnModified(LeasingTenantsPeer::BUILDING)) $criteria->add(LeasingTenantsPeer::BUILDING, $this->building);
        if ($this->isColumnModified(LeasingTenantsPeer::UNIT_ID)) $criteria->add(LeasingTenantsPeer::UNIT_ID, $this->unit_id);
        if ($this->isColumnModified(LeasingTenantsPeer::PS_NUMBER)) $criteria->add(LeasingTenantsPeer::PS_NUMBER, $this->ps_number);
        if ($this->isColumnModified(LeasingTenantsPeer::UNIT_OWNER_ID)) $criteria->add(LeasingTenantsPeer::UNIT_OWNER_ID, $this->unit_owner_id);
        if ($this->isColumnModified(LeasingTenantsPeer::TENANT_NAME)) $criteria->add(LeasingTenantsPeer::TENANT_NAME, $this->tenant_name);
        if ($this->isColumnModified(LeasingTenantsPeer::CONTACT)) $criteria->add(LeasingTenantsPeer::CONTACT, $this->contact);
        if ($this->isColumnModified(LeasingTenantsPeer::EMAIL)) $criteria->add(LeasingTenantsPeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingTenantsPeer::LEASE_START_DATE)) $criteria->add(LeasingTenantsPeer::LEASE_START_DATE, $this->lease_start_date);
        if ($this->isColumnModified(LeasingTenantsPeer::LEASE_END_DATE)) $criteria->add(LeasingTenantsPeer::LEASE_END_DATE, $this->lease_end_date);
        if ($this->isColumnModified(LeasingTenantsPeer::STATUS)) $criteria->add(LeasingTenantsPeer::STATUS, $this->status);
        if ($this->isColumnModified(LeasingTenantsPeer::PREV_STATUS)) $criteria->add(LeasingTenantsPeer::PREV_STATUS, $this->prev_status);

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
        $criteria = new Criteria(LeasingTenantsPeer::DATABASE_NAME);
        $criteria->add(LeasingTenantsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingTenants (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAccountType($this->getAccountType());
        $copyObj->setBuilding($this->getBuilding());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setPsNumber($this->getPsNumber());
        $copyObj->setUnitOwnerId($this->getUnitOwnerId());
        $copyObj->setTenantName($this->getTenantName());
        $copyObj->setContact($this->getContact());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setLeaseStartDate($this->getLeaseStartDate());
        $copyObj->setLeaseEndDate($this->getLeaseEndDate());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setPrevStatus($this->getPrevStatus());

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
     * @return LeasingTenants Clone of current object.
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
     * @return LeasingTenantsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingTenantsPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingAccountType object.
     *
     * @param                  LeasingAccountType $v
     * @return LeasingTenants The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingAccountType(LeasingAccountType $v = null)
    {
        if ($v === null) {
            $this->setAccountType(NULL);
        } else {
            $this->setAccountType($v->getId());
        }

        $this->aLeasingAccountType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingAccountType object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingTenants($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingAccountType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingAccountType The associated LeasingAccountType object.
     * @throws PropelException
     */
    public function getLeasingAccountType(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingAccountType === null && ($this->account_type !== null) && $doQuery) {
            $this->aLeasingAccountType = LeasingAccountTypeQuery::create()->findPk($this->account_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingAccountType->addLeasingTenantss($this);
             */
        }

        return $this->aLeasingAccountType;
    }

    /**
     * Declares an association between this object and a LeasingUnit object.
     *
     * @param                  LeasingUnit $v
     * @return LeasingTenants The current object (for fluent API support)
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
            $v->addLeasingTenants($this);
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
                $this->aLeasingUnit->addLeasingTenantss($this);
             */
        }

        return $this->aLeasingUnit;
    }

    /**
     * Declares an association between this object and a LeasingUnitOwner object.
     *
     * @param                  LeasingUnitOwner $v
     * @return LeasingTenants The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingUnitOwner(LeasingUnitOwner $v = null)
    {
        if ($v === null) {
            $this->setUnitOwnerId(NULL);
        } else {
            $this->setUnitOwnerId($v->getId());
        }

        $this->aLeasingUnitOwner = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingUnitOwner object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingTenants($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingUnitOwner object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingUnitOwner The associated LeasingUnitOwner object.
     * @throws PropelException
     */
    public function getLeasingUnitOwner(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingUnitOwner === null && ($this->unit_owner_id !== null) && $doQuery) {
            $this->aLeasingUnitOwner = LeasingUnitOwnerQuery::create()->findPk($this->unit_owner_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingUnitOwner->addLeasingTenantss($this);
             */
        }

        return $this->aLeasingUnitOwner;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->account_type = null;
        $this->building = null;
        $this->unit_id = null;
        $this->ps_number = null;
        $this->unit_owner_id = null;
        $this->tenant_name = null;
        $this->contact = null;
        $this->email = null;
        $this->lease_start_date = null;
        $this->lease_end_date = null;
        $this->status = null;
        $this->prev_status = null;
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
            if ($this->aLeasingAccountType instanceof Persistent) {
              $this->aLeasingAccountType->clearAllReferences($deep);
            }
            if ($this->aLeasingUnit instanceof Persistent) {
              $this->aLeasingUnit->clearAllReferences($deep);
            }
            if ($this->aLeasingUnitOwner instanceof Persistent) {
              $this->aLeasingUnitOwner->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aLeasingAccountType = null;
        $this->aLeasingUnit = null;
        $this->aLeasingUnitOwner = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingTenantsPeer::DEFAULT_STRING_FORMAT);
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
