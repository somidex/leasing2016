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
use Leasing\CoreBundle\Model\LeasingEventBookings;
use Leasing\CoreBundle\Model\LeasingEventBookingsQuery;
use Leasing\CoreBundle\Model\LeasingEventInquiries;
use Leasing\CoreBundle\Model\LeasingEventInquiriesQuery;
use Leasing\CoreBundle\Model\LeasingEventPlace;
use Leasing\CoreBundle\Model\LeasingEventPlacePeer;
use Leasing\CoreBundle\Model\LeasingEventPlaceQuery;

abstract class BaseLeasingEventPlace extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingEventPlacePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingEventPlacePeer
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
     * The value for the post_id field.
     * @var        int
     */
    protected $post_id;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the content field.
     * @var        string
     */
    protected $content;

    /**
     * The value for the short_address field.
     * @var        string
     */
    protected $short_address;

    /**
     * The value for the full_address field.
     * @var        string
     */
    protected $full_address;

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
     * The value for the min field.
     * @var        int
     */
    protected $min;

    /**
     * The value for the max field.
     * @var        int
     */
    protected $max;

    /**
     * The value for the reservation_fee field.
     * @var        int
     */
    protected $reservation_fee;

    /**
     * The value for the security_deposit field.
     * @var        int
     */
    protected $security_deposit;

    /**
     * @var        PropelObjectCollection|LeasingEventBookings[] Collection to store aggregation of LeasingEventBookings objects.
     */
    protected $collLeasingEventBookingss;
    protected $collLeasingEventBookingssPartial;

    /**
     * @var        PropelObjectCollection|LeasingEventInquiries[] Collection to store aggregation of LeasingEventInquiries objects.
     */
    protected $collLeasingEventInquiriess;
    protected $collLeasingEventInquiriessPartial;

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
    protected $leasingEventBookingssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingEventInquiriessScheduledForDeletion = null;

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
     * Get the [post_id] column value.
     *
     * @return int
     */
    public function getPostId()
    {

        return $this->post_id;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {

        return $this->slug;
    }

    /**
     * Get the [content] column value.
     *
     * @return string
     */
    public function getContent()
    {

        return $this->content;
    }

    /**
     * Get the [short_address] column value.
     *
     * @return string
     */
    public function getShortAddress()
    {

        return $this->short_address;
    }

    /**
     * Get the [full_address] column value.
     *
     * @return string
     */
    public function getFullAddress()
    {

        return $this->full_address;
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
     * Get the [min] column value.
     *
     * @return int
     */
    public function getMin()
    {

        return $this->min;
    }

    /**
     * Get the [max] column value.
     *
     * @return int
     */
    public function getMax()
    {

        return $this->max;
    }

    /**
     * Get the [reservation_fee] column value.
     *
     * @return int
     */
    public function getReservationFee()
    {

        return $this->reservation_fee;
    }

    /**
     * Get the [security_deposit] column value.
     *
     * @return int
     */
    public function getSecurityDeposit()
    {

        return $this->security_deposit;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [post_id] column.
     *
     * @param  int $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setPostId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->post_id !== $v) {
            $this->post_id = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::POST_ID;
        }


        return $this;
    } // setPostId()

    /**
     * Set the value of [slug] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [content] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->content !== $v) {
            $this->content = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::CONTENT;
        }


        return $this;
    } // setContent()

    /**
     * Set the value of [short_address] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setShortAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->short_address !== $v) {
            $this->short_address = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::SHORT_ADDRESS;
        }


        return $this;
    } // setShortAddress()

    /**
     * Set the value of [full_address] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setFullAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->full_address !== $v) {
            $this->full_address = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::FULL_ADDRESS;
        }


        return $this;
    } // setFullAddress()

    /**
     * Set the value of [contact] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::CONTACT;
        }


        return $this;
    } // setContact()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [min] column.
     *
     * @param  int $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setMin($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->min !== $v) {
            $this->min = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::MIN;
        }


        return $this;
    } // setMin()

    /**
     * Set the value of [max] column.
     *
     * @param  int $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setMax($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->max !== $v) {
            $this->max = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::MAX;
        }


        return $this;
    } // setMax()

    /**
     * Set the value of [reservation_fee] column.
     *
     * @param  int $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setReservationFee($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->reservation_fee !== $v) {
            $this->reservation_fee = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::RESERVATION_FEE;
        }


        return $this;
    } // setReservationFee()

    /**
     * Set the value of [security_deposit] column.
     *
     * @param  int $v new value
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setSecurityDeposit($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->security_deposit !== $v) {
            $this->security_deposit = $v;
            $this->modifiedColumns[] = LeasingEventPlacePeer::SECURITY_DEPOSIT;
        }


        return $this;
    } // setSecurityDeposit()

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
            $this->post_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->slug = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->content = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->short_address = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->full_address = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->contact = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->min = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->max = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->reservation_fee = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->security_deposit = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 13; // 13 = LeasingEventPlacePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingEventPlace object", $e);
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
            $con = Propel::getConnection(LeasingEventPlacePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingEventPlacePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLeasingEventBookingss = null;

            $this->collLeasingEventInquiriess = null;

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
            $con = Propel::getConnection(LeasingEventPlacePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingEventPlaceQuery::create()
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
            $con = Propel::getConnection(LeasingEventPlacePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingEventPlacePeer::addInstanceToPool($this);
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

            if ($this->leasingEventBookingssScheduledForDeletion !== null) {
                if (!$this->leasingEventBookingssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingEventBookingssScheduledForDeletion as $leasingEventBookings) {
                        // need to save related object because we set the relation to null
                        $leasingEventBookings->save($con);
                    }
                    $this->leasingEventBookingssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingEventBookingss !== null) {
                foreach ($this->collLeasingEventBookingss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingEventInquiriessScheduledForDeletion !== null) {
                if (!$this->leasingEventInquiriessScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingEventInquiriessScheduledForDeletion as $leasingEventInquiries) {
                        // need to save related object because we set the relation to null
                        $leasingEventInquiries->save($con);
                    }
                    $this->leasingEventInquiriessScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingEventInquiriess !== null) {
                foreach ($this->collLeasingEventInquiriess as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingEventPlacePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingEventPlacePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingEventPlacePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::POST_ID)) {
            $modifiedColumns[':p' . $index++]  = '`post_id`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::CONTENT)) {
            $modifiedColumns[':p' . $index++]  = '`content`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::SHORT_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`short_address`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::FULL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`full_address`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::CONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`contact`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::MIN)) {
            $modifiedColumns[':p' . $index++]  = '`min`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::MAX)) {
            $modifiedColumns[':p' . $index++]  = '`max`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::RESERVATION_FEE)) {
            $modifiedColumns[':p' . $index++]  = '`reservation_fee`';
        }
        if ($this->isColumnModified(LeasingEventPlacePeer::SECURITY_DEPOSIT)) {
            $modifiedColumns[':p' . $index++]  = '`security_deposit`';
        }

        $sql = sprintf(
            'INSERT INTO `event_place` (%s) VALUES (%s)',
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
                    case '`post_id`':
                        $stmt->bindValue($identifier, $this->post_id, PDO::PARAM_INT);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`content`':
                        $stmt->bindValue($identifier, $this->content, PDO::PARAM_STR);
                        break;
                    case '`short_address`':
                        $stmt->bindValue($identifier, $this->short_address, PDO::PARAM_STR);
                        break;
                    case '`full_address`':
                        $stmt->bindValue($identifier, $this->full_address, PDO::PARAM_STR);
                        break;
                    case '`contact`':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`min`':
                        $stmt->bindValue($identifier, $this->min, PDO::PARAM_INT);
                        break;
                    case '`max`':
                        $stmt->bindValue($identifier, $this->max, PDO::PARAM_INT);
                        break;
                    case '`reservation_fee`':
                        $stmt->bindValue($identifier, $this->reservation_fee, PDO::PARAM_INT);
                        break;
                    case '`security_deposit`':
                        $stmt->bindValue($identifier, $this->security_deposit, PDO::PARAM_INT);
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


            if (($retval = LeasingEventPlacePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingEventBookingss !== null) {
                    foreach ($this->collLeasingEventBookingss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingEventInquiriess !== null) {
                    foreach ($this->collLeasingEventInquiriess as $referrerFK) {
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
        $pos = LeasingEventPlacePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getPostId();
                break;
            case 3:
                return $this->getSlug();
                break;
            case 4:
                return $this->getContent();
                break;
            case 5:
                return $this->getShortAddress();
                break;
            case 6:
                return $this->getFullAddress();
                break;
            case 7:
                return $this->getContact();
                break;
            case 8:
                return $this->getEmail();
                break;
            case 9:
                return $this->getMin();
                break;
            case 10:
                return $this->getMax();
                break;
            case 11:
                return $this->getReservationFee();
                break;
            case 12:
                return $this->getSecurityDeposit();
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
        if (isset($alreadyDumpedObjects['LeasingEventPlace'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingEventPlace'][$this->getPrimaryKey()] = true;
        $keys = LeasingEventPlacePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPostId(),
            $keys[3] => $this->getSlug(),
            $keys[4] => $this->getContent(),
            $keys[5] => $this->getShortAddress(),
            $keys[6] => $this->getFullAddress(),
            $keys[7] => $this->getContact(),
            $keys[8] => $this->getEmail(),
            $keys[9] => $this->getMin(),
            $keys[10] => $this->getMax(),
            $keys[11] => $this->getReservationFee(),
            $keys[12] => $this->getSecurityDeposit(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLeasingEventBookingss) {
                $result['LeasingEventBookingss'] = $this->collLeasingEventBookingss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingEventInquiriess) {
                $result['LeasingEventInquiriess'] = $this->collLeasingEventInquiriess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingEventPlacePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setPostId($value);
                break;
            case 3:
                $this->setSlug($value);
                break;
            case 4:
                $this->setContent($value);
                break;
            case 5:
                $this->setShortAddress($value);
                break;
            case 6:
                $this->setFullAddress($value);
                break;
            case 7:
                $this->setContact($value);
                break;
            case 8:
                $this->setEmail($value);
                break;
            case 9:
                $this->setMin($value);
                break;
            case 10:
                $this->setMax($value);
                break;
            case 11:
                $this->setReservationFee($value);
                break;
            case 12:
                $this->setSecurityDeposit($value);
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
        $keys = LeasingEventPlacePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPostId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSlug($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setShortAddress($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setFullAddress($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setContact($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setEmail($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMin($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setMax($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setReservationFee($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setSecurityDeposit($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingEventPlacePeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingEventPlacePeer::ID)) $criteria->add(LeasingEventPlacePeer::ID, $this->id);
        if ($this->isColumnModified(LeasingEventPlacePeer::NAME)) $criteria->add(LeasingEventPlacePeer::NAME, $this->name);
        if ($this->isColumnModified(LeasingEventPlacePeer::POST_ID)) $criteria->add(LeasingEventPlacePeer::POST_ID, $this->post_id);
        if ($this->isColumnModified(LeasingEventPlacePeer::SLUG)) $criteria->add(LeasingEventPlacePeer::SLUG, $this->slug);
        if ($this->isColumnModified(LeasingEventPlacePeer::CONTENT)) $criteria->add(LeasingEventPlacePeer::CONTENT, $this->content);
        if ($this->isColumnModified(LeasingEventPlacePeer::SHORT_ADDRESS)) $criteria->add(LeasingEventPlacePeer::SHORT_ADDRESS, $this->short_address);
        if ($this->isColumnModified(LeasingEventPlacePeer::FULL_ADDRESS)) $criteria->add(LeasingEventPlacePeer::FULL_ADDRESS, $this->full_address);
        if ($this->isColumnModified(LeasingEventPlacePeer::CONTACT)) $criteria->add(LeasingEventPlacePeer::CONTACT, $this->contact);
        if ($this->isColumnModified(LeasingEventPlacePeer::EMAIL)) $criteria->add(LeasingEventPlacePeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingEventPlacePeer::MIN)) $criteria->add(LeasingEventPlacePeer::MIN, $this->min);
        if ($this->isColumnModified(LeasingEventPlacePeer::MAX)) $criteria->add(LeasingEventPlacePeer::MAX, $this->max);
        if ($this->isColumnModified(LeasingEventPlacePeer::RESERVATION_FEE)) $criteria->add(LeasingEventPlacePeer::RESERVATION_FEE, $this->reservation_fee);
        if ($this->isColumnModified(LeasingEventPlacePeer::SECURITY_DEPOSIT)) $criteria->add(LeasingEventPlacePeer::SECURITY_DEPOSIT, $this->security_deposit);

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
        $criteria = new Criteria(LeasingEventPlacePeer::DATABASE_NAME);
        $criteria->add(LeasingEventPlacePeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingEventPlace (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setPostId($this->getPostId());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setContent($this->getContent());
        $copyObj->setShortAddress($this->getShortAddress());
        $copyObj->setFullAddress($this->getFullAddress());
        $copyObj->setContact($this->getContact());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMin($this->getMin());
        $copyObj->setMax($this->getMax());
        $copyObj->setReservationFee($this->getReservationFee());
        $copyObj->setSecurityDeposit($this->getSecurityDeposit());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingEventBookingss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingEventBookings($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingEventInquiriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingEventInquiries($relObj->copy($deepCopy));
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
     * @return LeasingEventPlace Clone of current object.
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
     * @return LeasingEventPlacePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingEventPlacePeer();
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
        if ('LeasingEventBookings' == $relationName) {
            $this->initLeasingEventBookingss();
        }
        if ('LeasingEventInquiries' == $relationName) {
            $this->initLeasingEventInquiriess();
        }
    }

    /**
     * Clears out the collLeasingEventBookingss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingEventPlace The current object (for fluent API support)
     * @see        addLeasingEventBookingss()
     */
    public function clearLeasingEventBookingss()
    {
        $this->collLeasingEventBookingss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingEventBookingssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingEventBookingss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingEventBookingss($v = true)
    {
        $this->collLeasingEventBookingssPartial = $v;
    }

    /**
     * Initializes the collLeasingEventBookingss collection.
     *
     * By default this just sets the collLeasingEventBookingss collection to an empty array (like clearcollLeasingEventBookingss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingEventBookingss($overrideExisting = true)
    {
        if (null !== $this->collLeasingEventBookingss && !$overrideExisting) {
            return;
        }
        $this->collLeasingEventBookingss = new PropelObjectCollection();
        $this->collLeasingEventBookingss->setModel('LeasingEventBookings');
    }

    /**
     * Gets an array of LeasingEventBookings objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingEventPlace is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingEventBookings[] List of LeasingEventBookings objects
     * @throws PropelException
     */
    public function getLeasingEventBookingss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventBookingssPartial && !$this->isNew();
        if (null === $this->collLeasingEventBookingss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventBookingss) {
                // return empty collection
                $this->initLeasingEventBookingss();
            } else {
                $collLeasingEventBookingss = LeasingEventBookingsQuery::create(null, $criteria)
                    ->filterByLeasingEventPlace($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingEventBookingssPartial && count($collLeasingEventBookingss)) {
                      $this->initLeasingEventBookingss(false);

                      foreach ($collLeasingEventBookingss as $obj) {
                        if (false == $this->collLeasingEventBookingss->contains($obj)) {
                          $this->collLeasingEventBookingss->append($obj);
                        }
                      }

                      $this->collLeasingEventBookingssPartial = true;
                    }

                    $collLeasingEventBookingss->getInternalIterator()->rewind();

                    return $collLeasingEventBookingss;
                }

                if ($partial && $this->collLeasingEventBookingss) {
                    foreach ($this->collLeasingEventBookingss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingEventBookingss[] = $obj;
                        }
                    }
                }

                $this->collLeasingEventBookingss = $collLeasingEventBookingss;
                $this->collLeasingEventBookingssPartial = false;
            }
        }

        return $this->collLeasingEventBookingss;
    }

    /**
     * Sets a collection of LeasingEventBookings objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingEventBookingss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setLeasingEventBookingss(PropelCollection $leasingEventBookingss, PropelPDO $con = null)
    {
        $leasingEventBookingssToDelete = $this->getLeasingEventBookingss(new Criteria(), $con)->diff($leasingEventBookingss);


        $this->leasingEventBookingssScheduledForDeletion = $leasingEventBookingssToDelete;

        foreach ($leasingEventBookingssToDelete as $leasingEventBookingsRemoved) {
            $leasingEventBookingsRemoved->setLeasingEventPlace(null);
        }

        $this->collLeasingEventBookingss = null;
        foreach ($leasingEventBookingss as $leasingEventBookings) {
            $this->addLeasingEventBookings($leasingEventBookings);
        }

        $this->collLeasingEventBookingss = $leasingEventBookingss;
        $this->collLeasingEventBookingssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingEventBookings objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingEventBookings objects.
     * @throws PropelException
     */
    public function countLeasingEventBookingss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventBookingssPartial && !$this->isNew();
        if (null === $this->collLeasingEventBookingss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventBookingss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingEventBookingss());
            }
            $query = LeasingEventBookingsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingEventPlace($this)
                ->count($con);
        }

        return count($this->collLeasingEventBookingss);
    }

    /**
     * Method called to associate a LeasingEventBookings object to this object
     * through the LeasingEventBookings foreign key attribute.
     *
     * @param    LeasingEventBookings $l LeasingEventBookings
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function addLeasingEventBookings(LeasingEventBookings $l)
    {
        if ($this->collLeasingEventBookingss === null) {
            $this->initLeasingEventBookingss();
            $this->collLeasingEventBookingssPartial = true;
        }

        if (!in_array($l, $this->collLeasingEventBookingss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingEventBookings($l);

            if ($this->leasingEventBookingssScheduledForDeletion and $this->leasingEventBookingssScheduledForDeletion->contains($l)) {
                $this->leasingEventBookingssScheduledForDeletion->remove($this->leasingEventBookingssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingEventBookings $leasingEventBookings The leasingEventBookings object to add.
     */
    protected function doAddLeasingEventBookings($leasingEventBookings)
    {
        $this->collLeasingEventBookingss[]= $leasingEventBookings;
        $leasingEventBookings->setLeasingEventPlace($this);
    }

    /**
     * @param	LeasingEventBookings $leasingEventBookings The leasingEventBookings object to remove.
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function removeLeasingEventBookings($leasingEventBookings)
    {
        if ($this->getLeasingEventBookingss()->contains($leasingEventBookings)) {
            $this->collLeasingEventBookingss->remove($this->collLeasingEventBookingss->search($leasingEventBookings));
            if (null === $this->leasingEventBookingssScheduledForDeletion) {
                $this->leasingEventBookingssScheduledForDeletion = clone $this->collLeasingEventBookingss;
                $this->leasingEventBookingssScheduledForDeletion->clear();
            }
            $this->leasingEventBookingssScheduledForDeletion[]= $leasingEventBookings;
            $leasingEventBookings->setLeasingEventPlace(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingEventPlace is new, it will return
     * an empty collection; or if this LeasingEventPlace has previously
     * been saved, it will retrieve related LeasingEventBookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingEventPlace.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingEventBookings[] List of LeasingEventBookings objects
     */
    public function getLeasingEventBookingssJoinLeasingEventLeads($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingEventBookingsQuery::create(null, $criteria);
        $query->joinWith('LeasingEventLeads', $join_behavior);

        return $this->getLeasingEventBookingss($query, $con);
    }

    /**
     * Clears out the collLeasingEventInquiriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingEventPlace The current object (for fluent API support)
     * @see        addLeasingEventInquiriess()
     */
    public function clearLeasingEventInquiriess()
    {
        $this->collLeasingEventInquiriess = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingEventInquiriessPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingEventInquiriess collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingEventInquiriess($v = true)
    {
        $this->collLeasingEventInquiriessPartial = $v;
    }

    /**
     * Initializes the collLeasingEventInquiriess collection.
     *
     * By default this just sets the collLeasingEventInquiriess collection to an empty array (like clearcollLeasingEventInquiriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingEventInquiriess($overrideExisting = true)
    {
        if (null !== $this->collLeasingEventInquiriess && !$overrideExisting) {
            return;
        }
        $this->collLeasingEventInquiriess = new PropelObjectCollection();
        $this->collLeasingEventInquiriess->setModel('LeasingEventInquiries');
    }

    /**
     * Gets an array of LeasingEventInquiries objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingEventPlace is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingEventInquiries[] List of LeasingEventInquiries objects
     * @throws PropelException
     */
    public function getLeasingEventInquiriess($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventInquiriessPartial && !$this->isNew();
        if (null === $this->collLeasingEventInquiriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventInquiriess) {
                // return empty collection
                $this->initLeasingEventInquiriess();
            } else {
                $collLeasingEventInquiriess = LeasingEventInquiriesQuery::create(null, $criteria)
                    ->filterByLeasingEventPlace($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingEventInquiriessPartial && count($collLeasingEventInquiriess)) {
                      $this->initLeasingEventInquiriess(false);

                      foreach ($collLeasingEventInquiriess as $obj) {
                        if (false == $this->collLeasingEventInquiriess->contains($obj)) {
                          $this->collLeasingEventInquiriess->append($obj);
                        }
                      }

                      $this->collLeasingEventInquiriessPartial = true;
                    }

                    $collLeasingEventInquiriess->getInternalIterator()->rewind();

                    return $collLeasingEventInquiriess;
                }

                if ($partial && $this->collLeasingEventInquiriess) {
                    foreach ($this->collLeasingEventInquiriess as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingEventInquiriess[] = $obj;
                        }
                    }
                }

                $this->collLeasingEventInquiriess = $collLeasingEventInquiriess;
                $this->collLeasingEventInquiriessPartial = false;
            }
        }

        return $this->collLeasingEventInquiriess;
    }

    /**
     * Sets a collection of LeasingEventInquiries objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingEventInquiriess A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function setLeasingEventInquiriess(PropelCollection $leasingEventInquiriess, PropelPDO $con = null)
    {
        $leasingEventInquiriessToDelete = $this->getLeasingEventInquiriess(new Criteria(), $con)->diff($leasingEventInquiriess);


        $this->leasingEventInquiriessScheduledForDeletion = $leasingEventInquiriessToDelete;

        foreach ($leasingEventInquiriessToDelete as $leasingEventInquiriesRemoved) {
            $leasingEventInquiriesRemoved->setLeasingEventPlace(null);
        }

        $this->collLeasingEventInquiriess = null;
        foreach ($leasingEventInquiriess as $leasingEventInquiries) {
            $this->addLeasingEventInquiries($leasingEventInquiries);
        }

        $this->collLeasingEventInquiriess = $leasingEventInquiriess;
        $this->collLeasingEventInquiriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingEventInquiries objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingEventInquiries objects.
     * @throws PropelException
     */
    public function countLeasingEventInquiriess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingEventInquiriessPartial && !$this->isNew();
        if (null === $this->collLeasingEventInquiriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingEventInquiriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingEventInquiriess());
            }
            $query = LeasingEventInquiriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingEventPlace($this)
                ->count($con);
        }

        return count($this->collLeasingEventInquiriess);
    }

    /**
     * Method called to associate a LeasingEventInquiries object to this object
     * through the LeasingEventInquiries foreign key attribute.
     *
     * @param    LeasingEventInquiries $l LeasingEventInquiries
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function addLeasingEventInquiries(LeasingEventInquiries $l)
    {
        if ($this->collLeasingEventInquiriess === null) {
            $this->initLeasingEventInquiriess();
            $this->collLeasingEventInquiriessPartial = true;
        }

        if (!in_array($l, $this->collLeasingEventInquiriess->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingEventInquiries($l);

            if ($this->leasingEventInquiriessScheduledForDeletion and $this->leasingEventInquiriessScheduledForDeletion->contains($l)) {
                $this->leasingEventInquiriessScheduledForDeletion->remove($this->leasingEventInquiriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingEventInquiries $leasingEventInquiries The leasingEventInquiries object to add.
     */
    protected function doAddLeasingEventInquiries($leasingEventInquiries)
    {
        $this->collLeasingEventInquiriess[]= $leasingEventInquiries;
        $leasingEventInquiries->setLeasingEventPlace($this);
    }

    /**
     * @param	LeasingEventInquiries $leasingEventInquiries The leasingEventInquiries object to remove.
     * @return LeasingEventPlace The current object (for fluent API support)
     */
    public function removeLeasingEventInquiries($leasingEventInquiries)
    {
        if ($this->getLeasingEventInquiriess()->contains($leasingEventInquiries)) {
            $this->collLeasingEventInquiriess->remove($this->collLeasingEventInquiriess->search($leasingEventInquiries));
            if (null === $this->leasingEventInquiriessScheduledForDeletion) {
                $this->leasingEventInquiriessScheduledForDeletion = clone $this->collLeasingEventInquiriess;
                $this->leasingEventInquiriessScheduledForDeletion->clear();
            }
            $this->leasingEventInquiriessScheduledForDeletion[]= $leasingEventInquiries;
            $leasingEventInquiries->setLeasingEventPlace(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingEventPlace is new, it will return
     * an empty collection; or if this LeasingEventPlace has previously
     * been saved, it will retrieve related LeasingEventInquiriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingEventPlace.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingEventInquiries[] List of LeasingEventInquiries objects
     */
    public function getLeasingEventInquiriessJoinLeasingEventLeads($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingEventInquiriesQuery::create(null, $criteria);
        $query->joinWith('LeasingEventLeads', $join_behavior);

        return $this->getLeasingEventInquiriess($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->post_id = null;
        $this->slug = null;
        $this->content = null;
        $this->short_address = null;
        $this->full_address = null;
        $this->contact = null;
        $this->email = null;
        $this->min = null;
        $this->max = null;
        $this->reservation_fee = null;
        $this->security_deposit = null;
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
            if ($this->collLeasingEventBookingss) {
                foreach ($this->collLeasingEventBookingss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingEventInquiriess) {
                foreach ($this->collLeasingEventInquiriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingEventBookingss instanceof PropelCollection) {
            $this->collLeasingEventBookingss->clearIterator();
        }
        $this->collLeasingEventBookingss = null;
        if ($this->collLeasingEventInquiriess instanceof PropelCollection) {
            $this->collLeasingEventInquiriess->clearIterator();
        }
        $this->collLeasingEventInquiriess = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingEventPlacePeer::DEFAULT_STRING_FORMAT);
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
