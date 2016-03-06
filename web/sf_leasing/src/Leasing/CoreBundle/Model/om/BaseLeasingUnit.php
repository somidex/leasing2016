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
use Leasing\CoreBundle\Model\LeasingAppointments;
use Leasing\CoreBundle\Model\LeasingAppointmentsQuery;
use Leasing\CoreBundle\Model\LeasingBookings;
use Leasing\CoreBundle\Model\LeasingBookingsQuery;
use Leasing\CoreBundle\Model\LeasingLeaseType;
use Leasing\CoreBundle\Model\LeasingLeaseTypeQuery;
use Leasing\CoreBundle\Model\LeasingLocation;
use Leasing\CoreBundle\Model\LeasingLocationQuery;
use Leasing\CoreBundle\Model\LeasingPriceRange;
use Leasing\CoreBundle\Model\LeasingPriceRangeQuery;
use Leasing\CoreBundle\Model\LeasingProjects;
use Leasing\CoreBundle\Model\LeasingProjectsQuery;
use Leasing\CoreBundle\Model\LeasingTenants;
use Leasing\CoreBundle\Model\LeasingTenantsQuery;
use Leasing\CoreBundle\Model\LeasingUnit;
use Leasing\CoreBundle\Model\LeasingUnitCalendar;
use Leasing\CoreBundle\Model\LeasingUnitCalendarQuery;
use Leasing\CoreBundle\Model\LeasingUnitDressUp;
use Leasing\CoreBundle\Model\LeasingUnitDressUpQuery;
use Leasing\CoreBundle\Model\LeasingUnitFeatures;
use Leasing\CoreBundle\Model\LeasingUnitFeaturesQuery;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedrooms;
use Leasing\CoreBundle\Model\LeasingUnitNumberBedroomsQuery;
use Leasing\CoreBundle\Model\LeasingUnitPeer;
use Leasing\CoreBundle\Model\LeasingUnitQuery;
use Leasing\CoreBundle\Model\LeasingUnitType;
use Leasing\CoreBundle\Model\LeasingUnitTypeQuery;

abstract class BaseLeasingUnit extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingUnitPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingUnitPeer
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
     * The value for the availability field.
     * @var        int
     */
    protected $availability;

    /**
     * The value for the price_range field.
     * @var        string
     */
    protected $price_range;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the unit_type_id field.
     * @var        int
     */
    protected $unit_type_id;

    /**
     * The value for the location_id field.
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the lease_type_id field.
     * @var        int
     */
    protected $lease_type_id;

    /**
     * The value for the project_id field.
     * @var        int
     */
    protected $project_id;

    /**
     * The value for the br_id field.
     * @var        int
     */
    protected $br_id;

    /**
     * The value for the dress_up_id field.
     * @var        int
     */
    protected $dress_up_id;

    /**
     * @var        LeasingUnitType
     */
    protected $aLeasingUnitType;

    /**
     * @var        LeasingLocation
     */
    protected $aLeasingLocation;

    /**
     * @var        LeasingLeaseType
     */
    protected $aLeasingLeaseType;

    /**
     * @var        LeasingProjects
     */
    protected $aLeasingProjects;

    /**
     * @var        LeasingUnitDressUp
     */
    protected $aLeasingUnitDressUp;

    /**
     * @var        LeasingUnitNumberBedrooms
     */
    protected $aLeasingUnitNumberBedrooms;

    /**
     * @var        PropelObjectCollection|LeasingAppointments[] Collection to store aggregation of LeasingAppointments objects.
     */
    protected $collLeasingAppointmentss;
    protected $collLeasingAppointmentssPartial;

    /**
     * @var        PropelObjectCollection|LeasingBookings[] Collection to store aggregation of LeasingBookings objects.
     */
    protected $collLeasingBookingss;
    protected $collLeasingBookingssPartial;

    /**
     * @var        PropelObjectCollection|LeasingPriceRange[] Collection to store aggregation of LeasingPriceRange objects.
     */
    protected $collLeasingPriceRanges;
    protected $collLeasingPriceRangesPartial;

    /**
     * @var        PropelObjectCollection|LeasingTenants[] Collection to store aggregation of LeasingTenants objects.
     */
    protected $collLeasingTenantss;
    protected $collLeasingTenantssPartial;

    /**
     * @var        PropelObjectCollection|LeasingUnitCalendar[] Collection to store aggregation of LeasingUnitCalendar objects.
     */
    protected $collLeasingUnitCalendars;
    protected $collLeasingUnitCalendarsPartial;

    /**
     * @var        PropelObjectCollection|LeasingUnitFeatures[] Collection to store aggregation of LeasingUnitFeatures objects.
     */
    protected $collLeasingUnitFeaturess;
    protected $collLeasingUnitFeaturessPartial;

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
    protected $leasingAppointmentssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingBookingssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingPriceRangesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingTenantssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingUnitCalendarsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingUnitFeaturessScheduledForDeletion = null;

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
     * Get the [availability] column value.
     *
     * @return int
     */
    public function getAvailability()
    {

        return $this->availability;
    }

    /**
     * Get the [price_range] column value.
     *
     * @return string
     */
    public function getPriceRange()
    {

        return $this->price_range;
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
     * Get the [unit_type_id] column value.
     *
     * @return int
     */
    public function getUnitTypeId()
    {

        return $this->unit_type_id;
    }

    /**
     * Get the [location_id] column value.
     *
     * @return int
     */
    public function getLocationId()
    {

        return $this->location_id;
    }

    /**
     * Get the [lease_type_id] column value.
     *
     * @return int
     */
    public function getLeaseTypeId()
    {

        return $this->lease_type_id;
    }

    /**
     * Get the [project_id] column value.
     *
     * @return int
     */
    public function getProjectId()
    {

        return $this->project_id;
    }

    /**
     * Get the [br_id] column value.
     *
     * @return int
     */
    public function getBrId()
    {

        return $this->br_id;
    }

    /**
     * Get the [dress_up_id] column value.
     *
     * @return int
     */
    public function getDressUpId()
    {

        return $this->dress_up_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [post_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setPostId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->post_id !== $v) {
            $this->post_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::POST_ID;
        }


        return $this;
    } // setPostId()

    /**
     * Set the value of [slug] column.
     *
     * @param  string $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [content] column.
     *
     * @param  string $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->content !== $v) {
            $this->content = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::CONTENT;
        }


        return $this;
    } // setContent()

    /**
     * Set the value of [availability] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setAvailability($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->availability !== $v) {
            $this->availability = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::AVAILABILITY;
        }


        return $this;
    } // setAvailability()

    /**
     * Set the value of [price_range] column.
     *
     * @param  string $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setPriceRange($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->price_range !== $v) {
            $this->price_range = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::PRICE_RANGE;
        }


        return $this;
    } // setPriceRange()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [unit_type_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setUnitTypeId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->unit_type_id !== $v) {
            $this->unit_type_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::UNIT_TYPE_ID;
        }

        if ($this->aLeasingUnitType !== null && $this->aLeasingUnitType->getId() !== $v) {
            $this->aLeasingUnitType = null;
        }


        return $this;
    } // setUnitTypeId()

    /**
     * Set the value of [location_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::LOCATION_ID;
        }

        if ($this->aLeasingLocation !== null && $this->aLeasingLocation->getId() !== $v) {
            $this->aLeasingLocation = null;
        }


        return $this;
    } // setLocationId()

    /**
     * Set the value of [lease_type_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeaseTypeId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->lease_type_id !== $v) {
            $this->lease_type_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::LEASE_TYPE_ID;
        }

        if ($this->aLeasingLeaseType !== null && $this->aLeasingLeaseType->getId() !== $v) {
            $this->aLeasingLeaseType = null;
        }


        return $this;
    } // setLeaseTypeId()

    /**
     * Set the value of [project_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setProjectId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->project_id !== $v) {
            $this->project_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::PROJECT_ID;
        }

        if ($this->aLeasingProjects !== null && $this->aLeasingProjects->getId() !== $v) {
            $this->aLeasingProjects = null;
        }


        return $this;
    } // setProjectId()

    /**
     * Set the value of [br_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setBrId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->br_id !== $v) {
            $this->br_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::BR_ID;
        }

        if ($this->aLeasingUnitNumberBedrooms !== null && $this->aLeasingUnitNumberBedrooms->getId() !== $v) {
            $this->aLeasingUnitNumberBedrooms = null;
        }


        return $this;
    } // setBrId()

    /**
     * Set the value of [dress_up_id] column.
     *
     * @param  int $v new value
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setDressUpId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dress_up_id !== $v) {
            $this->dress_up_id = $v;
            $this->modifiedColumns[] = LeasingUnitPeer::DRESS_UP_ID;
        }

        if ($this->aLeasingUnitDressUp !== null && $this->aLeasingUnitDressUp->getId() !== $v) {
            $this->aLeasingUnitDressUp = null;
        }


        return $this;
    } // setDressUpId()

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
            $this->availability = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->price_range = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->status = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->unit_type_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->location_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->lease_type_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->project_id = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->br_id = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->dress_up_id = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 14; // 14 = LeasingUnitPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingUnit object", $e);
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

        if ($this->aLeasingUnitType !== null && $this->unit_type_id !== $this->aLeasingUnitType->getId()) {
            $this->aLeasingUnitType = null;
        }
        if ($this->aLeasingLocation !== null && $this->location_id !== $this->aLeasingLocation->getId()) {
            $this->aLeasingLocation = null;
        }
        if ($this->aLeasingLeaseType !== null && $this->lease_type_id !== $this->aLeasingLeaseType->getId()) {
            $this->aLeasingLeaseType = null;
        }
        if ($this->aLeasingProjects !== null && $this->project_id !== $this->aLeasingProjects->getId()) {
            $this->aLeasingProjects = null;
        }
        if ($this->aLeasingUnitNumberBedrooms !== null && $this->br_id !== $this->aLeasingUnitNumberBedrooms->getId()) {
            $this->aLeasingUnitNumberBedrooms = null;
        }
        if ($this->aLeasingUnitDressUp !== null && $this->dress_up_id !== $this->aLeasingUnitDressUp->getId()) {
            $this->aLeasingUnitDressUp = null;
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
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingUnitPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLeasingUnitType = null;
            $this->aLeasingLocation = null;
            $this->aLeasingLeaseType = null;
            $this->aLeasingProjects = null;
            $this->aLeasingUnitDressUp = null;
            $this->aLeasingUnitNumberBedrooms = null;
            $this->collLeasingAppointmentss = null;

            $this->collLeasingBookingss = null;

            $this->collLeasingPriceRanges = null;

            $this->collLeasingTenantss = null;

            $this->collLeasingUnitCalendars = null;

            $this->collLeasingUnitFeaturess = null;

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
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingUnitQuery::create()
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
            $con = Propel::getConnection(LeasingUnitPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingUnitPeer::addInstanceToPool($this);
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

            if ($this->aLeasingUnitType !== null) {
                if ($this->aLeasingUnitType->isModified() || $this->aLeasingUnitType->isNew()) {
                    $affectedRows += $this->aLeasingUnitType->save($con);
                }
                $this->setLeasingUnitType($this->aLeasingUnitType);
            }

            if ($this->aLeasingLocation !== null) {
                if ($this->aLeasingLocation->isModified() || $this->aLeasingLocation->isNew()) {
                    $affectedRows += $this->aLeasingLocation->save($con);
                }
                $this->setLeasingLocation($this->aLeasingLocation);
            }

            if ($this->aLeasingLeaseType !== null) {
                if ($this->aLeasingLeaseType->isModified() || $this->aLeasingLeaseType->isNew()) {
                    $affectedRows += $this->aLeasingLeaseType->save($con);
                }
                $this->setLeasingLeaseType($this->aLeasingLeaseType);
            }

            if ($this->aLeasingProjects !== null) {
                if ($this->aLeasingProjects->isModified() || $this->aLeasingProjects->isNew()) {
                    $affectedRows += $this->aLeasingProjects->save($con);
                }
                $this->setLeasingProjects($this->aLeasingProjects);
            }

            if ($this->aLeasingUnitDressUp !== null) {
                if ($this->aLeasingUnitDressUp->isModified() || $this->aLeasingUnitDressUp->isNew()) {
                    $affectedRows += $this->aLeasingUnitDressUp->save($con);
                }
                $this->setLeasingUnitDressUp($this->aLeasingUnitDressUp);
            }

            if ($this->aLeasingUnitNumberBedrooms !== null) {
                if ($this->aLeasingUnitNumberBedrooms->isModified() || $this->aLeasingUnitNumberBedrooms->isNew()) {
                    $affectedRows += $this->aLeasingUnitNumberBedrooms->save($con);
                }
                $this->setLeasingUnitNumberBedrooms($this->aLeasingUnitNumberBedrooms);
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

            if ($this->leasingAppointmentssScheduledForDeletion !== null) {
                if (!$this->leasingAppointmentssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingAppointmentssScheduledForDeletion as $leasingAppointments) {
                        // need to save related object because we set the relation to null
                        $leasingAppointments->save($con);
                    }
                    $this->leasingAppointmentssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingAppointmentss !== null) {
                foreach ($this->collLeasingAppointmentss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingBookingssScheduledForDeletion !== null) {
                if (!$this->leasingBookingssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingBookingssScheduledForDeletion as $leasingBookings) {
                        // need to save related object because we set the relation to null
                        $leasingBookings->save($con);
                    }
                    $this->leasingBookingssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingBookingss !== null) {
                foreach ($this->collLeasingBookingss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingPriceRangesScheduledForDeletion !== null) {
                if (!$this->leasingPriceRangesScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingPriceRangesScheduledForDeletion as $leasingPriceRange) {
                        // need to save related object because we set the relation to null
                        $leasingPriceRange->save($con);
                    }
                    $this->leasingPriceRangesScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingPriceRanges !== null) {
                foreach ($this->collLeasingPriceRanges as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->leasingUnitCalendarsScheduledForDeletion !== null) {
                if (!$this->leasingUnitCalendarsScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingUnitCalendarsScheduledForDeletion as $leasingUnitCalendar) {
                        // need to save related object because we set the relation to null
                        $leasingUnitCalendar->save($con);
                    }
                    $this->leasingUnitCalendarsScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingUnitCalendars !== null) {
                foreach ($this->collLeasingUnitCalendars as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingUnitFeaturessScheduledForDeletion !== null) {
                if (!$this->leasingUnitFeaturessScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingUnitFeaturessScheduledForDeletion as $leasingUnitFeatures) {
                        // need to save related object because we set the relation to null
                        $leasingUnitFeatures->save($con);
                    }
                    $this->leasingUnitFeaturessScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingUnitFeaturess !== null) {
                foreach ($this->collLeasingUnitFeaturess as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingUnitPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingUnitPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingUnitPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::POST_ID)) {
            $modifiedColumns[':p' . $index++]  = '`post_id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::CONTENT)) {
            $modifiedColumns[':p' . $index++]  = '`content`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::AVAILABILITY)) {
            $modifiedColumns[':p' . $index++]  = '`availability`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::PRICE_RANGE)) {
            $modifiedColumns[':p' . $index++]  = '`price_range`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::UNIT_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`unit_type_id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`location_id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::LEASE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`lease_type_id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::PROJECT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`project_id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::BR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`br_id`';
        }
        if ($this->isColumnModified(LeasingUnitPeer::DRESS_UP_ID)) {
            $modifiedColumns[':p' . $index++]  = '`dress_up_id`';
        }

        $sql = sprintf(
            'INSERT INTO `unit` (%s) VALUES (%s)',
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
                    case '`availability`':
                        $stmt->bindValue($identifier, $this->availability, PDO::PARAM_INT);
                        break;
                    case '`price_range`':
                        $stmt->bindValue($identifier, $this->price_range, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`unit_type_id`':
                        $stmt->bindValue($identifier, $this->unit_type_id, PDO::PARAM_INT);
                        break;
                    case '`location_id`':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case '`lease_type_id`':
                        $stmt->bindValue($identifier, $this->lease_type_id, PDO::PARAM_INT);
                        break;
                    case '`project_id`':
                        $stmt->bindValue($identifier, $this->project_id, PDO::PARAM_INT);
                        break;
                    case '`br_id`':
                        $stmt->bindValue($identifier, $this->br_id, PDO::PARAM_INT);
                        break;
                    case '`dress_up_id`':
                        $stmt->bindValue($identifier, $this->dress_up_id, PDO::PARAM_INT);
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

            if ($this->aLeasingUnitType !== null) {
                if (!$this->aLeasingUnitType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnitType->getValidationFailures());
                }
            }

            if ($this->aLeasingLocation !== null) {
                if (!$this->aLeasingLocation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingLocation->getValidationFailures());
                }
            }

            if ($this->aLeasingLeaseType !== null) {
                if (!$this->aLeasingLeaseType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingLeaseType->getValidationFailures());
                }
            }

            if ($this->aLeasingProjects !== null) {
                if (!$this->aLeasingProjects->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingProjects->getValidationFailures());
                }
            }

            if ($this->aLeasingUnitDressUp !== null) {
                if (!$this->aLeasingUnitDressUp->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnitDressUp->getValidationFailures());
                }
            }

            if ($this->aLeasingUnitNumberBedrooms !== null) {
                if (!$this->aLeasingUnitNumberBedrooms->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeasingUnitNumberBedrooms->getValidationFailures());
                }
            }


            if (($retval = LeasingUnitPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingAppointmentss !== null) {
                    foreach ($this->collLeasingAppointmentss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingBookingss !== null) {
                    foreach ($this->collLeasingBookingss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingPriceRanges !== null) {
                    foreach ($this->collLeasingPriceRanges as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingTenantss !== null) {
                    foreach ($this->collLeasingTenantss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingUnitCalendars !== null) {
                    foreach ($this->collLeasingUnitCalendars as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingUnitFeaturess !== null) {
                    foreach ($this->collLeasingUnitFeaturess as $referrerFK) {
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
        $pos = LeasingUnitPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAvailability();
                break;
            case 6:
                return $this->getPriceRange();
                break;
            case 7:
                return $this->getStatus();
                break;
            case 8:
                return $this->getUnitTypeId();
                break;
            case 9:
                return $this->getLocationId();
                break;
            case 10:
                return $this->getLeaseTypeId();
                break;
            case 11:
                return $this->getProjectId();
                break;
            case 12:
                return $this->getBrId();
                break;
            case 13:
                return $this->getDressUpId();
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
        if (isset($alreadyDumpedObjects['LeasingUnit'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingUnit'][$this->getPrimaryKey()] = true;
        $keys = LeasingUnitPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPostId(),
            $keys[3] => $this->getSlug(),
            $keys[4] => $this->getContent(),
            $keys[5] => $this->getAvailability(),
            $keys[6] => $this->getPriceRange(),
            $keys[7] => $this->getStatus(),
            $keys[8] => $this->getUnitTypeId(),
            $keys[9] => $this->getLocationId(),
            $keys[10] => $this->getLeaseTypeId(),
            $keys[11] => $this->getProjectId(),
            $keys[12] => $this->getBrId(),
            $keys[13] => $this->getDressUpId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLeasingUnitType) {
                $result['LeasingUnitType'] = $this->aLeasingUnitType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingLocation) {
                $result['LeasingLocation'] = $this->aLeasingLocation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingLeaseType) {
                $result['LeasingLeaseType'] = $this->aLeasingLeaseType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingProjects) {
                $result['LeasingProjects'] = $this->aLeasingProjects->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingUnitDressUp) {
                $result['LeasingUnitDressUp'] = $this->aLeasingUnitDressUp->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeasingUnitNumberBedrooms) {
                $result['LeasingUnitNumberBedrooms'] = $this->aLeasingUnitNumberBedrooms->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLeasingAppointmentss) {
                $result['LeasingAppointmentss'] = $this->collLeasingAppointmentss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingBookingss) {
                $result['LeasingBookingss'] = $this->collLeasingBookingss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingPriceRanges) {
                $result['LeasingPriceRanges'] = $this->collLeasingPriceRanges->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingTenantss) {
                $result['LeasingTenantss'] = $this->collLeasingTenantss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingUnitCalendars) {
                $result['LeasingUnitCalendars'] = $this->collLeasingUnitCalendars->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingUnitFeaturess) {
                $result['LeasingUnitFeaturess'] = $this->collLeasingUnitFeaturess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingUnitPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAvailability($value);
                break;
            case 6:
                $this->setPriceRange($value);
                break;
            case 7:
                $this->setStatus($value);
                break;
            case 8:
                $this->setUnitTypeId($value);
                break;
            case 9:
                $this->setLocationId($value);
                break;
            case 10:
                $this->setLeaseTypeId($value);
                break;
            case 11:
                $this->setProjectId($value);
                break;
            case 12:
                $this->setBrId($value);
                break;
            case 13:
                $this->setDressUpId($value);
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
        $keys = LeasingUnitPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPostId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSlug($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAvailability($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPriceRange($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setStatus($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUnitTypeId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setLocationId($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setLeaseTypeId($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setProjectId($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setBrId($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setDressUpId($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingUnitPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingUnitPeer::ID)) $criteria->add(LeasingUnitPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingUnitPeer::NAME)) $criteria->add(LeasingUnitPeer::NAME, $this->name);
        if ($this->isColumnModified(LeasingUnitPeer::POST_ID)) $criteria->add(LeasingUnitPeer::POST_ID, $this->post_id);
        if ($this->isColumnModified(LeasingUnitPeer::SLUG)) $criteria->add(LeasingUnitPeer::SLUG, $this->slug);
        if ($this->isColumnModified(LeasingUnitPeer::CONTENT)) $criteria->add(LeasingUnitPeer::CONTENT, $this->content);
        if ($this->isColumnModified(LeasingUnitPeer::AVAILABILITY)) $criteria->add(LeasingUnitPeer::AVAILABILITY, $this->availability);
        if ($this->isColumnModified(LeasingUnitPeer::PRICE_RANGE)) $criteria->add(LeasingUnitPeer::PRICE_RANGE, $this->price_range);
        if ($this->isColumnModified(LeasingUnitPeer::STATUS)) $criteria->add(LeasingUnitPeer::STATUS, $this->status);
        if ($this->isColumnModified(LeasingUnitPeer::UNIT_TYPE_ID)) $criteria->add(LeasingUnitPeer::UNIT_TYPE_ID, $this->unit_type_id);
        if ($this->isColumnModified(LeasingUnitPeer::LOCATION_ID)) $criteria->add(LeasingUnitPeer::LOCATION_ID, $this->location_id);
        if ($this->isColumnModified(LeasingUnitPeer::LEASE_TYPE_ID)) $criteria->add(LeasingUnitPeer::LEASE_TYPE_ID, $this->lease_type_id);
        if ($this->isColumnModified(LeasingUnitPeer::PROJECT_ID)) $criteria->add(LeasingUnitPeer::PROJECT_ID, $this->project_id);
        if ($this->isColumnModified(LeasingUnitPeer::BR_ID)) $criteria->add(LeasingUnitPeer::BR_ID, $this->br_id);
        if ($this->isColumnModified(LeasingUnitPeer::DRESS_UP_ID)) $criteria->add(LeasingUnitPeer::DRESS_UP_ID, $this->dress_up_id);

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
        $criteria = new Criteria(LeasingUnitPeer::DATABASE_NAME);
        $criteria->add(LeasingUnitPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingUnit (or compatible) type.
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
        $copyObj->setAvailability($this->getAvailability());
        $copyObj->setPriceRange($this->getPriceRange());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setUnitTypeId($this->getUnitTypeId());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setLeaseTypeId($this->getLeaseTypeId());
        $copyObj->setProjectId($this->getProjectId());
        $copyObj->setBrId($this->getBrId());
        $copyObj->setDressUpId($this->getDressUpId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingAppointmentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingAppointments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingBookingss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingBookings($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingPriceRanges() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingPriceRange($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingTenantss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingTenants($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingUnitCalendars() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingUnitCalendar($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingUnitFeaturess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingUnitFeatures($relObj->copy($deepCopy));
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
     * @return LeasingUnit Clone of current object.
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
     * @return LeasingUnitPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingUnitPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LeasingUnitType object.
     *
     * @param                  LeasingUnitType $v
     * @return LeasingUnit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingUnitType(LeasingUnitType $v = null)
    {
        if ($v === null) {
            $this->setUnitTypeId(NULL);
        } else {
            $this->setUnitTypeId($v->getId());
        }

        $this->aLeasingUnitType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingUnitType object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingUnitType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingUnitType The associated LeasingUnitType object.
     * @throws PropelException
     */
    public function getLeasingUnitType(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingUnitType === null && ($this->unit_type_id !== null) && $doQuery) {
            $this->aLeasingUnitType = LeasingUnitTypeQuery::create()->findPk($this->unit_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingUnitType->addLeasingUnits($this);
             */
        }

        return $this->aLeasingUnitType;
    }

    /**
     * Declares an association between this object and a LeasingLocation object.
     *
     * @param                  LeasingLocation $v
     * @return LeasingUnit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingLocation(LeasingLocation $v = null)
    {
        if ($v === null) {
            $this->setLocationId(NULL);
        } else {
            $this->setLocationId($v->getId());
        }

        $this->aLeasingLocation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingLocation object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingLocation object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingLocation The associated LeasingLocation object.
     * @throws PropelException
     */
    public function getLeasingLocation(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingLocation === null && ($this->location_id !== null) && $doQuery) {
            $this->aLeasingLocation = LeasingLocationQuery::create()->findPk($this->location_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingLocation->addLeasingUnits($this);
             */
        }

        return $this->aLeasingLocation;
    }

    /**
     * Declares an association between this object and a LeasingLeaseType object.
     *
     * @param                  LeasingLeaseType $v
     * @return LeasingUnit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingLeaseType(LeasingLeaseType $v = null)
    {
        if ($v === null) {
            $this->setLeaseTypeId(NULL);
        } else {
            $this->setLeaseTypeId($v->getId());
        }

        $this->aLeasingLeaseType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingLeaseType object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingLeaseType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingLeaseType The associated LeasingLeaseType object.
     * @throws PropelException
     */
    public function getLeasingLeaseType(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingLeaseType === null && ($this->lease_type_id !== null) && $doQuery) {
            $this->aLeasingLeaseType = LeasingLeaseTypeQuery::create()->findPk($this->lease_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingLeaseType->addLeasingUnits($this);
             */
        }

        return $this->aLeasingLeaseType;
    }

    /**
     * Declares an association between this object and a LeasingProjects object.
     *
     * @param                  LeasingProjects $v
     * @return LeasingUnit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingProjects(LeasingProjects $v = null)
    {
        if ($v === null) {
            $this->setProjectId(NULL);
        } else {
            $this->setProjectId($v->getId());
        }

        $this->aLeasingProjects = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingProjects object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingProjects object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingProjects The associated LeasingProjects object.
     * @throws PropelException
     */
    public function getLeasingProjects(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingProjects === null && ($this->project_id !== null) && $doQuery) {
            $this->aLeasingProjects = LeasingProjectsQuery::create()->findPk($this->project_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingProjects->addLeasingUnits($this);
             */
        }

        return $this->aLeasingProjects;
    }

    /**
     * Declares an association between this object and a LeasingUnitDressUp object.
     *
     * @param                  LeasingUnitDressUp $v
     * @return LeasingUnit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingUnitDressUp(LeasingUnitDressUp $v = null)
    {
        if ($v === null) {
            $this->setDressUpId(NULL);
        } else {
            $this->setDressUpId($v->getId());
        }

        $this->aLeasingUnitDressUp = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingUnitDressUp object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingUnitDressUp object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingUnitDressUp The associated LeasingUnitDressUp object.
     * @throws PropelException
     */
    public function getLeasingUnitDressUp(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingUnitDressUp === null && ($this->dress_up_id !== null) && $doQuery) {
            $this->aLeasingUnitDressUp = LeasingUnitDressUpQuery::create()->findPk($this->dress_up_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingUnitDressUp->addLeasingUnits($this);
             */
        }

        return $this->aLeasingUnitDressUp;
    }

    /**
     * Declares an association between this object and a LeasingUnitNumberBedrooms object.
     *
     * @param                  LeasingUnitNumberBedrooms $v
     * @return LeasingUnit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeasingUnitNumberBedrooms(LeasingUnitNumberBedrooms $v = null)
    {
        if ($v === null) {
            $this->setBrId(NULL);
        } else {
            $this->setBrId($v->getId());
        }

        $this->aLeasingUnitNumberBedrooms = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LeasingUnitNumberBedrooms object, it will not be re-added.
        if ($v !== null) {
            $v->addLeasingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated LeasingUnitNumberBedrooms object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return LeasingUnitNumberBedrooms The associated LeasingUnitNumberBedrooms object.
     * @throws PropelException
     */
    public function getLeasingUnitNumberBedrooms(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeasingUnitNumberBedrooms === null && ($this->br_id !== null) && $doQuery) {
            $this->aLeasingUnitNumberBedrooms = LeasingUnitNumberBedroomsQuery::create()->findPk($this->br_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeasingUnitNumberBedrooms->addLeasingUnits($this);
             */
        }

        return $this->aLeasingUnitNumberBedrooms;
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
        if ('LeasingAppointments' == $relationName) {
            $this->initLeasingAppointmentss();
        }
        if ('LeasingBookings' == $relationName) {
            $this->initLeasingBookingss();
        }
        if ('LeasingPriceRange' == $relationName) {
            $this->initLeasingPriceRanges();
        }
        if ('LeasingTenants' == $relationName) {
            $this->initLeasingTenantss();
        }
        if ('LeasingUnitCalendar' == $relationName) {
            $this->initLeasingUnitCalendars();
        }
        if ('LeasingUnitFeatures' == $relationName) {
            $this->initLeasingUnitFeaturess();
        }
    }

    /**
     * Clears out the collLeasingAppointmentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnit The current object (for fluent API support)
     * @see        addLeasingAppointmentss()
     */
    public function clearLeasingAppointmentss()
    {
        $this->collLeasingAppointmentss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingAppointmentssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingAppointmentss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingAppointmentss($v = true)
    {
        $this->collLeasingAppointmentssPartial = $v;
    }

    /**
     * Initializes the collLeasingAppointmentss collection.
     *
     * By default this just sets the collLeasingAppointmentss collection to an empty array (like clearcollLeasingAppointmentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingAppointmentss($overrideExisting = true)
    {
        if (null !== $this->collLeasingAppointmentss && !$overrideExisting) {
            return;
        }
        $this->collLeasingAppointmentss = new PropelObjectCollection();
        $this->collLeasingAppointmentss->setModel('LeasingAppointments');
    }

    /**
     * Gets an array of LeasingAppointments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingAppointments[] List of LeasingAppointments objects
     * @throws PropelException
     */
    public function getLeasingAppointmentss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentssPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentss) {
                // return empty collection
                $this->initLeasingAppointmentss();
            } else {
                $collLeasingAppointmentss = LeasingAppointmentsQuery::create(null, $criteria)
                    ->filterByLeasingUnit($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingAppointmentssPartial && count($collLeasingAppointmentss)) {
                      $this->initLeasingAppointmentss(false);

                      foreach ($collLeasingAppointmentss as $obj) {
                        if (false == $this->collLeasingAppointmentss->contains($obj)) {
                          $this->collLeasingAppointmentss->append($obj);
                        }
                      }

                      $this->collLeasingAppointmentssPartial = true;
                    }

                    $collLeasingAppointmentss->getInternalIterator()->rewind();

                    return $collLeasingAppointmentss;
                }

                if ($partial && $this->collLeasingAppointmentss) {
                    foreach ($this->collLeasingAppointmentss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingAppointmentss[] = $obj;
                        }
                    }
                }

                $this->collLeasingAppointmentss = $collLeasingAppointmentss;
                $this->collLeasingAppointmentssPartial = false;
            }
        }

        return $this->collLeasingAppointmentss;
    }

    /**
     * Sets a collection of LeasingAppointments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingAppointmentss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeasingAppointmentss(PropelCollection $leasingAppointmentss, PropelPDO $con = null)
    {
        $leasingAppointmentssToDelete = $this->getLeasingAppointmentss(new Criteria(), $con)->diff($leasingAppointmentss);


        $this->leasingAppointmentssScheduledForDeletion = $leasingAppointmentssToDelete;

        foreach ($leasingAppointmentssToDelete as $leasingAppointmentsRemoved) {
            $leasingAppointmentsRemoved->setLeasingUnit(null);
        }

        $this->collLeasingAppointmentss = null;
        foreach ($leasingAppointmentss as $leasingAppointments) {
            $this->addLeasingAppointments($leasingAppointments);
        }

        $this->collLeasingAppointmentss = $leasingAppointmentss;
        $this->collLeasingAppointmentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingAppointments objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingAppointments objects.
     * @throws PropelException
     */
    public function countLeasingAppointmentss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingAppointmentssPartial && !$this->isNew();
        if (null === $this->collLeasingAppointmentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingAppointmentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingAppointmentss());
            }
            $query = LeasingAppointmentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingUnit($this)
                ->count($con);
        }

        return count($this->collLeasingAppointmentss);
    }

    /**
     * Method called to associate a LeasingAppointments object to this object
     * through the LeasingAppointments foreign key attribute.
     *
     * @param    LeasingAppointments $l LeasingAppointments
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function addLeasingAppointments(LeasingAppointments $l)
    {
        if ($this->collLeasingAppointmentss === null) {
            $this->initLeasingAppointmentss();
            $this->collLeasingAppointmentssPartial = true;
        }

        if (!in_array($l, $this->collLeasingAppointmentss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingAppointments($l);

            if ($this->leasingAppointmentssScheduledForDeletion and $this->leasingAppointmentssScheduledForDeletion->contains($l)) {
                $this->leasingAppointmentssScheduledForDeletion->remove($this->leasingAppointmentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingAppointments $leasingAppointments The leasingAppointments object to add.
     */
    protected function doAddLeasingAppointments($leasingAppointments)
    {
        $this->collLeasingAppointmentss[]= $leasingAppointments;
        $leasingAppointments->setLeasingUnit($this);
    }

    /**
     * @param	LeasingAppointments $leasingAppointments The leasingAppointments object to remove.
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function removeLeasingAppointments($leasingAppointments)
    {
        if ($this->getLeasingAppointmentss()->contains($leasingAppointments)) {
            $this->collLeasingAppointmentss->remove($this->collLeasingAppointmentss->search($leasingAppointments));
            if (null === $this->leasingAppointmentssScheduledForDeletion) {
                $this->leasingAppointmentssScheduledForDeletion = clone $this->collLeasingAppointmentss;
                $this->leasingAppointmentssScheduledForDeletion->clear();
            }
            $this->leasingAppointmentssScheduledForDeletion[]= $leasingAppointments;
            $leasingAppointments->setLeasingUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnit is new, it will return
     * an empty collection; or if this LeasingUnit has previously
     * been saved, it will retrieve related LeasingAppointmentss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingAppointments[] List of LeasingAppointments objects
     */
    public function getLeasingAppointmentssJoinLeasingAppointmentLeads($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingAppointmentsQuery::create(null, $criteria);
        $query->joinWith('LeasingAppointmentLeads', $join_behavior);

        return $this->getLeasingAppointmentss($query, $con);
    }

    /**
     * Clears out the collLeasingBookingss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnit The current object (for fluent API support)
     * @see        addLeasingBookingss()
     */
    public function clearLeasingBookingss()
    {
        $this->collLeasingBookingss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingBookingssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingBookingss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingBookingss($v = true)
    {
        $this->collLeasingBookingssPartial = $v;
    }

    /**
     * Initializes the collLeasingBookingss collection.
     *
     * By default this just sets the collLeasingBookingss collection to an empty array (like clearcollLeasingBookingss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingBookingss($overrideExisting = true)
    {
        if (null !== $this->collLeasingBookingss && !$overrideExisting) {
            return;
        }
        $this->collLeasingBookingss = new PropelObjectCollection();
        $this->collLeasingBookingss->setModel('LeasingBookings');
    }

    /**
     * Gets an array of LeasingBookings objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingBookings[] List of LeasingBookings objects
     * @throws PropelException
     */
    public function getLeasingBookingss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingBookingssPartial && !$this->isNew();
        if (null === $this->collLeasingBookingss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingBookingss) {
                // return empty collection
                $this->initLeasingBookingss();
            } else {
                $collLeasingBookingss = LeasingBookingsQuery::create(null, $criteria)
                    ->filterByLeasingUnit($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingBookingssPartial && count($collLeasingBookingss)) {
                      $this->initLeasingBookingss(false);

                      foreach ($collLeasingBookingss as $obj) {
                        if (false == $this->collLeasingBookingss->contains($obj)) {
                          $this->collLeasingBookingss->append($obj);
                        }
                      }

                      $this->collLeasingBookingssPartial = true;
                    }

                    $collLeasingBookingss->getInternalIterator()->rewind();

                    return $collLeasingBookingss;
                }

                if ($partial && $this->collLeasingBookingss) {
                    foreach ($this->collLeasingBookingss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingBookingss[] = $obj;
                        }
                    }
                }

                $this->collLeasingBookingss = $collLeasingBookingss;
                $this->collLeasingBookingssPartial = false;
            }
        }

        return $this->collLeasingBookingss;
    }

    /**
     * Sets a collection of LeasingBookings objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingBookingss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeasingBookingss(PropelCollection $leasingBookingss, PropelPDO $con = null)
    {
        $leasingBookingssToDelete = $this->getLeasingBookingss(new Criteria(), $con)->diff($leasingBookingss);


        $this->leasingBookingssScheduledForDeletion = $leasingBookingssToDelete;

        foreach ($leasingBookingssToDelete as $leasingBookingsRemoved) {
            $leasingBookingsRemoved->setLeasingUnit(null);
        }

        $this->collLeasingBookingss = null;
        foreach ($leasingBookingss as $leasingBookings) {
            $this->addLeasingBookings($leasingBookings);
        }

        $this->collLeasingBookingss = $leasingBookingss;
        $this->collLeasingBookingssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingBookings objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingBookings objects.
     * @throws PropelException
     */
    public function countLeasingBookingss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingBookingssPartial && !$this->isNew();
        if (null === $this->collLeasingBookingss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingBookingss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingBookingss());
            }
            $query = LeasingBookingsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingUnit($this)
                ->count($con);
        }

        return count($this->collLeasingBookingss);
    }

    /**
     * Method called to associate a LeasingBookings object to this object
     * through the LeasingBookings foreign key attribute.
     *
     * @param    LeasingBookings $l LeasingBookings
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function addLeasingBookings(LeasingBookings $l)
    {
        if ($this->collLeasingBookingss === null) {
            $this->initLeasingBookingss();
            $this->collLeasingBookingssPartial = true;
        }

        if (!in_array($l, $this->collLeasingBookingss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingBookings($l);

            if ($this->leasingBookingssScheduledForDeletion and $this->leasingBookingssScheduledForDeletion->contains($l)) {
                $this->leasingBookingssScheduledForDeletion->remove($this->leasingBookingssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingBookings $leasingBookings The leasingBookings object to add.
     */
    protected function doAddLeasingBookings($leasingBookings)
    {
        $this->collLeasingBookingss[]= $leasingBookings;
        $leasingBookings->setLeasingUnit($this);
    }

    /**
     * @param	LeasingBookings $leasingBookings The leasingBookings object to remove.
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function removeLeasingBookings($leasingBookings)
    {
        if ($this->getLeasingBookingss()->contains($leasingBookings)) {
            $this->collLeasingBookingss->remove($this->collLeasingBookingss->search($leasingBookings));
            if (null === $this->leasingBookingssScheduledForDeletion) {
                $this->leasingBookingssScheduledForDeletion = clone $this->collLeasingBookingss;
                $this->leasingBookingssScheduledForDeletion->clear();
            }
            $this->leasingBookingssScheduledForDeletion[]= $leasingBookings;
            $leasingBookings->setLeasingUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnit is new, it will return
     * an empty collection; or if this LeasingUnit has previously
     * been saved, it will retrieve related LeasingBookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingBookings[] List of LeasingBookings objects
     */
    public function getLeasingBookingssJoinLeasingBookingLeads($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingBookingsQuery::create(null, $criteria);
        $query->joinWith('LeasingBookingLeads', $join_behavior);

        return $this->getLeasingBookingss($query, $con);
    }

    /**
     * Clears out the collLeasingPriceRanges collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnit The current object (for fluent API support)
     * @see        addLeasingPriceRanges()
     */
    public function clearLeasingPriceRanges()
    {
        $this->collLeasingPriceRanges = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingPriceRangesPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingPriceRanges collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingPriceRanges($v = true)
    {
        $this->collLeasingPriceRangesPartial = $v;
    }

    /**
     * Initializes the collLeasingPriceRanges collection.
     *
     * By default this just sets the collLeasingPriceRanges collection to an empty array (like clearcollLeasingPriceRanges());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingPriceRanges($overrideExisting = true)
    {
        if (null !== $this->collLeasingPriceRanges && !$overrideExisting) {
            return;
        }
        $this->collLeasingPriceRanges = new PropelObjectCollection();
        $this->collLeasingPriceRanges->setModel('LeasingPriceRange');
    }

    /**
     * Gets an array of LeasingPriceRange objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingPriceRange[] List of LeasingPriceRange objects
     * @throws PropelException
     */
    public function getLeasingPriceRanges($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPriceRangesPartial && !$this->isNew();
        if (null === $this->collLeasingPriceRanges || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingPriceRanges) {
                // return empty collection
                $this->initLeasingPriceRanges();
            } else {
                $collLeasingPriceRanges = LeasingPriceRangeQuery::create(null, $criteria)
                    ->filterByLeasingUnit($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingPriceRangesPartial && count($collLeasingPriceRanges)) {
                      $this->initLeasingPriceRanges(false);

                      foreach ($collLeasingPriceRanges as $obj) {
                        if (false == $this->collLeasingPriceRanges->contains($obj)) {
                          $this->collLeasingPriceRanges->append($obj);
                        }
                      }

                      $this->collLeasingPriceRangesPartial = true;
                    }

                    $collLeasingPriceRanges->getInternalIterator()->rewind();

                    return $collLeasingPriceRanges;
                }

                if ($partial && $this->collLeasingPriceRanges) {
                    foreach ($this->collLeasingPriceRanges as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingPriceRanges[] = $obj;
                        }
                    }
                }

                $this->collLeasingPriceRanges = $collLeasingPriceRanges;
                $this->collLeasingPriceRangesPartial = false;
            }
        }

        return $this->collLeasingPriceRanges;
    }

    /**
     * Sets a collection of LeasingPriceRange objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingPriceRanges A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeasingPriceRanges(PropelCollection $leasingPriceRanges, PropelPDO $con = null)
    {
        $leasingPriceRangesToDelete = $this->getLeasingPriceRanges(new Criteria(), $con)->diff($leasingPriceRanges);


        $this->leasingPriceRangesScheduledForDeletion = $leasingPriceRangesToDelete;

        foreach ($leasingPriceRangesToDelete as $leasingPriceRangeRemoved) {
            $leasingPriceRangeRemoved->setLeasingUnit(null);
        }

        $this->collLeasingPriceRanges = null;
        foreach ($leasingPriceRanges as $leasingPriceRange) {
            $this->addLeasingPriceRange($leasingPriceRange);
        }

        $this->collLeasingPriceRanges = $leasingPriceRanges;
        $this->collLeasingPriceRangesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingPriceRange objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingPriceRange objects.
     * @throws PropelException
     */
    public function countLeasingPriceRanges(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPriceRangesPartial && !$this->isNew();
        if (null === $this->collLeasingPriceRanges || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingPriceRanges) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingPriceRanges());
            }
            $query = LeasingPriceRangeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingUnit($this)
                ->count($con);
        }

        return count($this->collLeasingPriceRanges);
    }

    /**
     * Method called to associate a LeasingPriceRange object to this object
     * through the LeasingPriceRange foreign key attribute.
     *
     * @param    LeasingPriceRange $l LeasingPriceRange
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function addLeasingPriceRange(LeasingPriceRange $l)
    {
        if ($this->collLeasingPriceRanges === null) {
            $this->initLeasingPriceRanges();
            $this->collLeasingPriceRangesPartial = true;
        }

        if (!in_array($l, $this->collLeasingPriceRanges->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingPriceRange($l);

            if ($this->leasingPriceRangesScheduledForDeletion and $this->leasingPriceRangesScheduledForDeletion->contains($l)) {
                $this->leasingPriceRangesScheduledForDeletion->remove($this->leasingPriceRangesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingPriceRange $leasingPriceRange The leasingPriceRange object to add.
     */
    protected function doAddLeasingPriceRange($leasingPriceRange)
    {
        $this->collLeasingPriceRanges[]= $leasingPriceRange;
        $leasingPriceRange->setLeasingUnit($this);
    }

    /**
     * @param	LeasingPriceRange $leasingPriceRange The leasingPriceRange object to remove.
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function removeLeasingPriceRange($leasingPriceRange)
    {
        if ($this->getLeasingPriceRanges()->contains($leasingPriceRange)) {
            $this->collLeasingPriceRanges->remove($this->collLeasingPriceRanges->search($leasingPriceRange));
            if (null === $this->leasingPriceRangesScheduledForDeletion) {
                $this->leasingPriceRangesScheduledForDeletion = clone $this->collLeasingPriceRanges;
                $this->leasingPriceRangesScheduledForDeletion->clear();
            }
            $this->leasingPriceRangesScheduledForDeletion[]= $leasingPriceRange;
            $leasingPriceRange->setLeasingUnit(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeasingTenantss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnit The current object (for fluent API support)
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
     * If this LeasingUnit is new, it will return
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
                    ->filterByLeasingUnit($this)
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
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeasingTenantss(PropelCollection $leasingTenantss, PropelPDO $con = null)
    {
        $leasingTenantssToDelete = $this->getLeasingTenantss(new Criteria(), $con)->diff($leasingTenantss);


        $this->leasingTenantssScheduledForDeletion = $leasingTenantssToDelete;

        foreach ($leasingTenantssToDelete as $leasingTenantsRemoved) {
            $leasingTenantsRemoved->setLeasingUnit(null);
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
                ->filterByLeasingUnit($this)
                ->count($con);
        }

        return count($this->collLeasingTenantss);
    }

    /**
     * Method called to associate a LeasingTenants object to this object
     * through the LeasingTenants foreign key attribute.
     *
     * @param    LeasingTenants $l LeasingTenants
     * @return LeasingUnit The current object (for fluent API support)
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
        $leasingTenants->setLeasingUnit($this);
    }

    /**
     * @param	LeasingTenants $leasingTenants The leasingTenants object to remove.
     * @return LeasingUnit The current object (for fluent API support)
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
            $leasingTenants->setLeasingUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnit is new, it will return
     * an empty collection; or if this LeasingUnit has previously
     * been saved, it will retrieve related LeasingTenantss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnit.
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
     * Otherwise if this LeasingUnit is new, it will return
     * an empty collection; or if this LeasingUnit has previously
     * been saved, it will retrieve related LeasingTenantss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingTenants[] List of LeasingTenants objects
     */
    public function getLeasingTenantssJoinLeasingUnitOwner($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingTenantsQuery::create(null, $criteria);
        $query->joinWith('LeasingUnitOwner', $join_behavior);

        return $this->getLeasingTenantss($query, $con);
    }

    /**
     * Clears out the collLeasingUnitCalendars collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnit The current object (for fluent API support)
     * @see        addLeasingUnitCalendars()
     */
    public function clearLeasingUnitCalendars()
    {
        $this->collLeasingUnitCalendars = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingUnitCalendarsPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingUnitCalendars collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingUnitCalendars($v = true)
    {
        $this->collLeasingUnitCalendarsPartial = $v;
    }

    /**
     * Initializes the collLeasingUnitCalendars collection.
     *
     * By default this just sets the collLeasingUnitCalendars collection to an empty array (like clearcollLeasingUnitCalendars());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingUnitCalendars($overrideExisting = true)
    {
        if (null !== $this->collLeasingUnitCalendars && !$overrideExisting) {
            return;
        }
        $this->collLeasingUnitCalendars = new PropelObjectCollection();
        $this->collLeasingUnitCalendars->setModel('LeasingUnitCalendar');
    }

    /**
     * Gets an array of LeasingUnitCalendar objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingUnitCalendar[] List of LeasingUnitCalendar objects
     * @throws PropelException
     */
    public function getLeasingUnitCalendars($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingUnitCalendarsPartial && !$this->isNew();
        if (null === $this->collLeasingUnitCalendars || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingUnitCalendars) {
                // return empty collection
                $this->initLeasingUnitCalendars();
            } else {
                $collLeasingUnitCalendars = LeasingUnitCalendarQuery::create(null, $criteria)
                    ->filterByLeasingUnit($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingUnitCalendarsPartial && count($collLeasingUnitCalendars)) {
                      $this->initLeasingUnitCalendars(false);

                      foreach ($collLeasingUnitCalendars as $obj) {
                        if (false == $this->collLeasingUnitCalendars->contains($obj)) {
                          $this->collLeasingUnitCalendars->append($obj);
                        }
                      }

                      $this->collLeasingUnitCalendarsPartial = true;
                    }

                    $collLeasingUnitCalendars->getInternalIterator()->rewind();

                    return $collLeasingUnitCalendars;
                }

                if ($partial && $this->collLeasingUnitCalendars) {
                    foreach ($this->collLeasingUnitCalendars as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingUnitCalendars[] = $obj;
                        }
                    }
                }

                $this->collLeasingUnitCalendars = $collLeasingUnitCalendars;
                $this->collLeasingUnitCalendarsPartial = false;
            }
        }

        return $this->collLeasingUnitCalendars;
    }

    /**
     * Sets a collection of LeasingUnitCalendar objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingUnitCalendars A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeasingUnitCalendars(PropelCollection $leasingUnitCalendars, PropelPDO $con = null)
    {
        $leasingUnitCalendarsToDelete = $this->getLeasingUnitCalendars(new Criteria(), $con)->diff($leasingUnitCalendars);


        $this->leasingUnitCalendarsScheduledForDeletion = $leasingUnitCalendarsToDelete;

        foreach ($leasingUnitCalendarsToDelete as $leasingUnitCalendarRemoved) {
            $leasingUnitCalendarRemoved->setLeasingUnit(null);
        }

        $this->collLeasingUnitCalendars = null;
        foreach ($leasingUnitCalendars as $leasingUnitCalendar) {
            $this->addLeasingUnitCalendar($leasingUnitCalendar);
        }

        $this->collLeasingUnitCalendars = $leasingUnitCalendars;
        $this->collLeasingUnitCalendarsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingUnitCalendar objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingUnitCalendar objects.
     * @throws PropelException
     */
    public function countLeasingUnitCalendars(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingUnitCalendarsPartial && !$this->isNew();
        if (null === $this->collLeasingUnitCalendars || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingUnitCalendars) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingUnitCalendars());
            }
            $query = LeasingUnitCalendarQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingUnit($this)
                ->count($con);
        }

        return count($this->collLeasingUnitCalendars);
    }

    /**
     * Method called to associate a LeasingUnitCalendar object to this object
     * through the LeasingUnitCalendar foreign key attribute.
     *
     * @param    LeasingUnitCalendar $l LeasingUnitCalendar
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function addLeasingUnitCalendar(LeasingUnitCalendar $l)
    {
        if ($this->collLeasingUnitCalendars === null) {
            $this->initLeasingUnitCalendars();
            $this->collLeasingUnitCalendarsPartial = true;
        }

        if (!in_array($l, $this->collLeasingUnitCalendars->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingUnitCalendar($l);

            if ($this->leasingUnitCalendarsScheduledForDeletion and $this->leasingUnitCalendarsScheduledForDeletion->contains($l)) {
                $this->leasingUnitCalendarsScheduledForDeletion->remove($this->leasingUnitCalendarsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingUnitCalendar $leasingUnitCalendar The leasingUnitCalendar object to add.
     */
    protected function doAddLeasingUnitCalendar($leasingUnitCalendar)
    {
        $this->collLeasingUnitCalendars[]= $leasingUnitCalendar;
        $leasingUnitCalendar->setLeasingUnit($this);
    }

    /**
     * @param	LeasingUnitCalendar $leasingUnitCalendar The leasingUnitCalendar object to remove.
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function removeLeasingUnitCalendar($leasingUnitCalendar)
    {
        if ($this->getLeasingUnitCalendars()->contains($leasingUnitCalendar)) {
            $this->collLeasingUnitCalendars->remove($this->collLeasingUnitCalendars->search($leasingUnitCalendar));
            if (null === $this->leasingUnitCalendarsScheduledForDeletion) {
                $this->leasingUnitCalendarsScheduledForDeletion = clone $this->collLeasingUnitCalendars;
                $this->leasingUnitCalendarsScheduledForDeletion->clear();
            }
            $this->leasingUnitCalendarsScheduledForDeletion[]= $leasingUnitCalendar;
            $leasingUnitCalendar->setLeasingUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnit is new, it will return
     * an empty collection; or if this LeasingUnit has previously
     * been saved, it will retrieve related LeasingUnitCalendars from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingUnitCalendar[] List of LeasingUnitCalendar objects
     */
    public function getLeasingUnitCalendarsJoinLeasingCalendar($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingUnitCalendarQuery::create(null, $criteria);
        $query->joinWith('LeasingCalendar', $join_behavior);

        return $this->getLeasingUnitCalendars($query, $con);
    }

    /**
     * Clears out the collLeasingUnitFeaturess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingUnit The current object (for fluent API support)
     * @see        addLeasingUnitFeaturess()
     */
    public function clearLeasingUnitFeaturess()
    {
        $this->collLeasingUnitFeaturess = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingUnitFeaturessPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingUnitFeaturess collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingUnitFeaturess($v = true)
    {
        $this->collLeasingUnitFeaturessPartial = $v;
    }

    /**
     * Initializes the collLeasingUnitFeaturess collection.
     *
     * By default this just sets the collLeasingUnitFeaturess collection to an empty array (like clearcollLeasingUnitFeaturess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingUnitFeaturess($overrideExisting = true)
    {
        if (null !== $this->collLeasingUnitFeaturess && !$overrideExisting) {
            return;
        }
        $this->collLeasingUnitFeaturess = new PropelObjectCollection();
        $this->collLeasingUnitFeaturess->setModel('LeasingUnitFeatures');
    }

    /**
     * Gets an array of LeasingUnitFeatures objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingUnitFeatures[] List of LeasingUnitFeatures objects
     * @throws PropelException
     */
    public function getLeasingUnitFeaturess($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingUnitFeaturessPartial && !$this->isNew();
        if (null === $this->collLeasingUnitFeaturess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingUnitFeaturess) {
                // return empty collection
                $this->initLeasingUnitFeaturess();
            } else {
                $collLeasingUnitFeaturess = LeasingUnitFeaturesQuery::create(null, $criteria)
                    ->filterByLeasingUnit($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingUnitFeaturessPartial && count($collLeasingUnitFeaturess)) {
                      $this->initLeasingUnitFeaturess(false);

                      foreach ($collLeasingUnitFeaturess as $obj) {
                        if (false == $this->collLeasingUnitFeaturess->contains($obj)) {
                          $this->collLeasingUnitFeaturess->append($obj);
                        }
                      }

                      $this->collLeasingUnitFeaturessPartial = true;
                    }

                    $collLeasingUnitFeaturess->getInternalIterator()->rewind();

                    return $collLeasingUnitFeaturess;
                }

                if ($partial && $this->collLeasingUnitFeaturess) {
                    foreach ($this->collLeasingUnitFeaturess as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingUnitFeaturess[] = $obj;
                        }
                    }
                }

                $this->collLeasingUnitFeaturess = $collLeasingUnitFeaturess;
                $this->collLeasingUnitFeaturessPartial = false;
            }
        }

        return $this->collLeasingUnitFeaturess;
    }

    /**
     * Sets a collection of LeasingUnitFeatures objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingUnitFeaturess A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function setLeasingUnitFeaturess(PropelCollection $leasingUnitFeaturess, PropelPDO $con = null)
    {
        $leasingUnitFeaturessToDelete = $this->getLeasingUnitFeaturess(new Criteria(), $con)->diff($leasingUnitFeaturess);


        $this->leasingUnitFeaturessScheduledForDeletion = $leasingUnitFeaturessToDelete;

        foreach ($leasingUnitFeaturessToDelete as $leasingUnitFeaturesRemoved) {
            $leasingUnitFeaturesRemoved->setLeasingUnit(null);
        }

        $this->collLeasingUnitFeaturess = null;
        foreach ($leasingUnitFeaturess as $leasingUnitFeatures) {
            $this->addLeasingUnitFeatures($leasingUnitFeatures);
        }

        $this->collLeasingUnitFeaturess = $leasingUnitFeaturess;
        $this->collLeasingUnitFeaturessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingUnitFeatures objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingUnitFeatures objects.
     * @throws PropelException
     */
    public function countLeasingUnitFeaturess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingUnitFeaturessPartial && !$this->isNew();
        if (null === $this->collLeasingUnitFeaturess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingUnitFeaturess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingUnitFeaturess());
            }
            $query = LeasingUnitFeaturesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingUnit($this)
                ->count($con);
        }

        return count($this->collLeasingUnitFeaturess);
    }

    /**
     * Method called to associate a LeasingUnitFeatures object to this object
     * through the LeasingUnitFeatures foreign key attribute.
     *
     * @param    LeasingUnitFeatures $l LeasingUnitFeatures
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function addLeasingUnitFeatures(LeasingUnitFeatures $l)
    {
        if ($this->collLeasingUnitFeaturess === null) {
            $this->initLeasingUnitFeaturess();
            $this->collLeasingUnitFeaturessPartial = true;
        }

        if (!in_array($l, $this->collLeasingUnitFeaturess->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingUnitFeatures($l);

            if ($this->leasingUnitFeaturessScheduledForDeletion and $this->leasingUnitFeaturessScheduledForDeletion->contains($l)) {
                $this->leasingUnitFeaturessScheduledForDeletion->remove($this->leasingUnitFeaturessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingUnitFeatures $leasingUnitFeatures The leasingUnitFeatures object to add.
     */
    protected function doAddLeasingUnitFeatures($leasingUnitFeatures)
    {
        $this->collLeasingUnitFeaturess[]= $leasingUnitFeatures;
        $leasingUnitFeatures->setLeasingUnit($this);
    }

    /**
     * @param	LeasingUnitFeatures $leasingUnitFeatures The leasingUnitFeatures object to remove.
     * @return LeasingUnit The current object (for fluent API support)
     */
    public function removeLeasingUnitFeatures($leasingUnitFeatures)
    {
        if ($this->getLeasingUnitFeaturess()->contains($leasingUnitFeatures)) {
            $this->collLeasingUnitFeaturess->remove($this->collLeasingUnitFeaturess->search($leasingUnitFeatures));
            if (null === $this->leasingUnitFeaturessScheduledForDeletion) {
                $this->leasingUnitFeaturessScheduledForDeletion = clone $this->collLeasingUnitFeaturess;
                $this->leasingUnitFeaturessScheduledForDeletion->clear();
            }
            $this->leasingUnitFeaturessScheduledForDeletion[]= $leasingUnitFeatures;
            $leasingUnitFeatures->setLeasingUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingUnit is new, it will return
     * an empty collection; or if this LeasingUnit has previously
     * been saved, it will retrieve related LeasingUnitFeaturess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingUnitFeatures[] List of LeasingUnitFeatures objects
     */
    public function getLeasingUnitFeaturessJoinLeasingFeatures($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingUnitFeaturesQuery::create(null, $criteria);
        $query->joinWith('LeasingFeatures', $join_behavior);

        return $this->getLeasingUnitFeaturess($query, $con);
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
        $this->availability = null;
        $this->price_range = null;
        $this->status = null;
        $this->unit_type_id = null;
        $this->location_id = null;
        $this->lease_type_id = null;
        $this->project_id = null;
        $this->br_id = null;
        $this->dress_up_id = null;
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
            if ($this->collLeasingAppointmentss) {
                foreach ($this->collLeasingAppointmentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingBookingss) {
                foreach ($this->collLeasingBookingss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingPriceRanges) {
                foreach ($this->collLeasingPriceRanges as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingTenantss) {
                foreach ($this->collLeasingTenantss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingUnitCalendars) {
                foreach ($this->collLeasingUnitCalendars as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingUnitFeaturess) {
                foreach ($this->collLeasingUnitFeaturess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aLeasingUnitType instanceof Persistent) {
              $this->aLeasingUnitType->clearAllReferences($deep);
            }
            if ($this->aLeasingLocation instanceof Persistent) {
              $this->aLeasingLocation->clearAllReferences($deep);
            }
            if ($this->aLeasingLeaseType instanceof Persistent) {
              $this->aLeasingLeaseType->clearAllReferences($deep);
            }
            if ($this->aLeasingProjects instanceof Persistent) {
              $this->aLeasingProjects->clearAllReferences($deep);
            }
            if ($this->aLeasingUnitDressUp instanceof Persistent) {
              $this->aLeasingUnitDressUp->clearAllReferences($deep);
            }
            if ($this->aLeasingUnitNumberBedrooms instanceof Persistent) {
              $this->aLeasingUnitNumberBedrooms->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingAppointmentss instanceof PropelCollection) {
            $this->collLeasingAppointmentss->clearIterator();
        }
        $this->collLeasingAppointmentss = null;
        if ($this->collLeasingBookingss instanceof PropelCollection) {
            $this->collLeasingBookingss->clearIterator();
        }
        $this->collLeasingBookingss = null;
        if ($this->collLeasingPriceRanges instanceof PropelCollection) {
            $this->collLeasingPriceRanges->clearIterator();
        }
        $this->collLeasingPriceRanges = null;
        if ($this->collLeasingTenantss instanceof PropelCollection) {
            $this->collLeasingTenantss->clearIterator();
        }
        $this->collLeasingTenantss = null;
        if ($this->collLeasingUnitCalendars instanceof PropelCollection) {
            $this->collLeasingUnitCalendars->clearIterator();
        }
        $this->collLeasingUnitCalendars = null;
        if ($this->collLeasingUnitFeaturess instanceof PropelCollection) {
            $this->collLeasingUnitFeaturess->clearIterator();
        }
        $this->collLeasingUnitFeaturess = null;
        $this->aLeasingUnitType = null;
        $this->aLeasingLocation = null;
        $this->aLeasingLeaseType = null;
        $this->aLeasingProjects = null;
        $this->aLeasingUnitDressUp = null;
        $this->aLeasingUnitNumberBedrooms = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingUnitPeer::DEFAULT_STRING_FORMAT);
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
