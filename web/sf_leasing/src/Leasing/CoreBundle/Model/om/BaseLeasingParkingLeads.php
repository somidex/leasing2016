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
use Leasing\CoreBundle\Model\LeasingParkingLeads;
use Leasing\CoreBundle\Model\LeasingParkingLeadsPeer;
use Leasing\CoreBundle\Model\LeasingParkingLeadsQuery;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetails;
use Leasing\CoreBundle\Model\LeasingParkingPaymentDetailsQuery;
use Leasing\CoreBundle\Model\LeasingPaymentTransactions;
use Leasing\CoreBundle\Model\LeasingPaymentTransactionsQuery;

abstract class BaseLeasingParkingLeads extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Leasing\\CoreBundle\\Model\\LeasingParkingLeadsPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeasingParkingLeadsPeer
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
     * The value for the application_number field.
     * @var        string
     */
    protected $application_number;

    /**
     * The value for the salutation field.
     * @var        string
     */
    protected $salutation;

    /**
     * The value for the fname field.
     * @var        string
     */
    protected $fname;

    /**
     * The value for the lname field.
     * @var        string
     */
    protected $lname;

    /**
     * The value for the gender field.
     * @var        string
     */
    protected $gender;

    /**
     * The value for the age field.
     * @var        string
     */
    protected $age;

    /**
     * The value for the birthday field.
     * @var        string
     */
    protected $birthday;

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
     * The value for the property field.
     * @var        string
     */
    protected $property;

    /**
     * The value for the unit field.
     * @var        string
     */
    protected $unit;

    /**
     * The value for the slots field.
     * @var        int
     */
    protected $slots;

    /**
     * The value for the ps_number field.
     * @var        string
     */
    protected $ps_number;

    /**
     * The value for the first_heard field.
     * @var        string
     */
    protected $first_heard;

    /**
     * The value for the payment_terms field.
     * @var        string
     */
    protected $payment_terms;

    /**
     * The value for the payment_type field.
     * @var        int
     */
    protected $payment_type;

    /**
     * The value for the date_added field.
     * @var        string
     */
    protected $date_added;

    /**
     * The value for the date_approved field.
     * @var        string
     */
    protected $date_approved;

    /**
     * The value for the date_enrolled field.
     * @var        string
     */
    protected $date_enrolled;

    /**
     * The value for the date_expiry field.
     * @var        string
     */
    protected $date_expiry;

    /**
     * The value for the date_renewal field.
     * @var        string
     */
    protected $date_renewal;

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
     * The value for the client_ip field.
     * @var        string
     */
    protected $client_ip;

    /**
     * The value for the client_id field.
     * @var        string
     */
    protected $client_id;

    /**
     * The value for the campaign field.
     * @var        string
     */
    protected $campaign;

    /**
     * The value for the medium field.
     * @var        string
     */
    protected $medium;

    /**
     * The value for the source field.
     * @var        string
     */
    protected $source;

    /**
     * The value for the gacountry field.
     * @var        string
     */
    protected $gacountry;

    /**
     * The value for the processing field.
     * @var        int
     */
    protected $processing;

    /**
     * The value for the processed_by field.
     * @var        string
     */
    protected $processed_by;

    /**
     * @var        PropelObjectCollection|LeasingParkingPaymentDetails[] Collection to store aggregation of LeasingParkingPaymentDetails objects.
     */
    protected $collLeasingParkingPaymentDetailss;
    protected $collLeasingParkingPaymentDetailssPartial;

    /**
     * @var        PropelObjectCollection|LeasingPaymentTransactions[] Collection to store aggregation of LeasingPaymentTransactions objects.
     */
    protected $collLeasingPaymentTransactionss;
    protected $collLeasingPaymentTransactionssPartial;

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
    protected $leasingParkingPaymentDetailssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leasingPaymentTransactionssScheduledForDeletion = null;

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
     * Get the [application_number] column value.
     *
     * @return string
     */
    public function getApplicationNumber()
    {

        return $this->application_number;
    }

    /**
     * Get the [salutation] column value.
     *
     * @return string
     */
    public function getSalutation()
    {

        return $this->salutation;
    }

    /**
     * Get the [fname] column value.
     *
     * @return string
     */
    public function getFname()
    {

        return $this->fname;
    }

    /**
     * Get the [lname] column value.
     *
     * @return string
     */
    public function getLname()
    {

        return $this->lname;
    }

    /**
     * Get the [gender] column value.
     *
     * @return string
     */
    public function getGender()
    {

        return $this->gender;
    }

    /**
     * Get the [age] column value.
     *
     * @return string
     */
    public function getAge()
    {

        return $this->age;
    }

    /**
     * Get the [birthday] column value.
     *
     * @return string
     */
    public function getBirthday()
    {

        return $this->birthday;
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
     * Get the [property] column value.
     *
     * @return string
     */
    public function getProperty()
    {

        return $this->property;
    }

    /**
     * Get the [unit] column value.
     *
     * @return string
     */
    public function getUnit()
    {

        return $this->unit;
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
     * Get the [ps_number] column value.
     *
     * @return string
     */
    public function getPsNumber()
    {

        return $this->ps_number;
    }

    /**
     * Get the [first_heard] column value.
     *
     * @return string
     */
    public function getFirstHeard()
    {

        return $this->first_heard;
    }

    /**
     * Get the [payment_terms] column value.
     *
     * @return string
     */
    public function getPaymentTerms()
    {

        return $this->payment_terms;
    }

    /**
     * Get the [payment_type] column value.
     *
     * @return int
     */
    public function getPaymentType()
    {

        return $this->payment_type;
    }

    /**
     * Get the [date_added] column value.
     *
     * @return string
     */
    public function getDateAdded()
    {

        return $this->date_added;
    }

    /**
     * Get the [date_approved] column value.
     *
     * @return string
     */
    public function getDateApproved()
    {

        return $this->date_approved;
    }

    /**
     * Get the [date_enrolled] column value.
     *
     * @return string
     */
    public function getDateEnrolled()
    {

        return $this->date_enrolled;
    }

    /**
     * Get the [date_expiry] column value.
     *
     * @return string
     */
    public function getDateExpiry()
    {

        return $this->date_expiry;
    }

    /**
     * Get the [date_renewal] column value.
     *
     * @return string
     */
    public function getDateRenewal()
    {

        return $this->date_renewal;
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
     * Get the [client_ip] column value.
     *
     * @return string
     */
    public function getClientIp()
    {

        return $this->client_ip;
    }

    /**
     * Get the [client_id] column value.
     *
     * @return string
     */
    public function getClientId()
    {

        return $this->client_id;
    }

    /**
     * Get the [campaign] column value.
     *
     * @return string
     */
    public function getCampaign()
    {

        return $this->campaign;
    }

    /**
     * Get the [medium] column value.
     *
     * @return string
     */
    public function getMedium()
    {

        return $this->medium;
    }

    /**
     * Get the [source] column value.
     *
     * @return string
     */
    public function getSource()
    {

        return $this->source;
    }

    /**
     * Get the [gacountry] column value.
     *
     * @return string
     */
    public function getGacountry()
    {

        return $this->gacountry;
    }

    /**
     * Get the [processing] column value.
     *
     * @return int
     */
    public function getProcessing()
    {

        return $this->processing;
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
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [application_number] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setApplicationNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->application_number !== $v) {
            $this->application_number = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::APPLICATION_NUMBER;
        }


        return $this;
    } // setApplicationNumber()

    /**
     * Set the value of [salutation] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setSalutation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salutation !== $v) {
            $this->salutation = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::SALUTATION;
        }


        return $this;
    } // setSalutation()

    /**
     * Set the value of [fname] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setFname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fname !== $v) {
            $this->fname = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::FNAME;
        }


        return $this;
    } // setFname()

    /**
     * Set the value of [lname] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setLname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lname !== $v) {
            $this->lname = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::LNAME;
        }


        return $this;
    } // setLname()

    /**
     * Set the value of [gender] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::GENDER;
        }


        return $this;
    } // setGender()

    /**
     * Set the value of [age] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setAge($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->age !== $v) {
            $this->age = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::AGE;
        }


        return $this;
    } // setAge()

    /**
     * Set the value of [birthday] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setBirthday($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->birthday !== $v) {
            $this->birthday = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::BIRTHDAY;
        }


        return $this;
    } // setBirthday()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [mobile] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::MOBILE;
        }


        return $this;
    } // setMobile()

    /**
     * Set the value of [property] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setProperty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->property !== $v) {
            $this->property = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PROPERTY;
        }


        return $this;
    } // setProperty()

    /**
     * Set the value of [unit] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unit !== $v) {
            $this->unit = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::UNIT;
        }


        return $this;
    } // setUnit()

    /**
     * Set the value of [slots] column.
     *
     * @param  int $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setSlots($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->slots !== $v) {
            $this->slots = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::SLOTS;
        }


        return $this;
    } // setSlots()

    /**
     * Set the value of [ps_number] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setPsNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ps_number !== $v) {
            $this->ps_number = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PS_NUMBER;
        }


        return $this;
    } // setPsNumber()

    /**
     * Set the value of [first_heard] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setFirstHeard($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_heard !== $v) {
            $this->first_heard = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::FIRST_HEARD;
        }


        return $this;
    } // setFirstHeard()

    /**
     * Set the value of [payment_terms] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setPaymentTerms($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payment_terms !== $v) {
            $this->payment_terms = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PAYMENT_TERMS;
        }


        return $this;
    } // setPaymentTerms()

    /**
     * Set the value of [payment_type] column.
     *
     * @param  int $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setPaymentType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->payment_type !== $v) {
            $this->payment_type = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PAYMENT_TYPE;
        }


        return $this;
    } // setPaymentType()

    /**
     * Set the value of [date_added] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_added !== $v) {
            $this->date_added = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::DATE_ADDED;
        }


        return $this;
    } // setDateAdded()

    /**
     * Set the value of [date_approved] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setDateApproved($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_approved !== $v) {
            $this->date_approved = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::DATE_APPROVED;
        }


        return $this;
    } // setDateApproved()

    /**
     * Set the value of [date_enrolled] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setDateEnrolled($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_enrolled !== $v) {
            $this->date_enrolled = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::DATE_ENROLLED;
        }


        return $this;
    } // setDateEnrolled()

    /**
     * Set the value of [date_expiry] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setDateExpiry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_expiry !== $v) {
            $this->date_expiry = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::DATE_EXPIRY;
        }


        return $this;
    } // setDateExpiry()

    /**
     * Set the value of [date_renewal] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setDateRenewal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_renewal !== $v) {
            $this->date_renewal = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::DATE_RENEWAL;
        }


        return $this;
    } // setDateRenewal()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [prev_status] column.
     *
     * @param  int $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setPrevStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->prev_status !== $v) {
            $this->prev_status = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PREV_STATUS;
        }


        return $this;
    } // setPrevStatus()

    /**
     * Set the value of [client_ip] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setClientIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_ip !== $v) {
            $this->client_ip = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::CLIENT_IP;
        }


        return $this;
    } // setClientIp()

    /**
     * Set the value of [client_id] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setClientId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_id !== $v) {
            $this->client_id = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::CLIENT_ID;
        }


        return $this;
    } // setClientId()

    /**
     * Set the value of [campaign] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setCampaign($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campaign !== $v) {
            $this->campaign = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::CAMPAIGN;
        }


        return $this;
    } // setCampaign()

    /**
     * Set the value of [medium] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setMedium($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->medium !== $v) {
            $this->medium = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::MEDIUM;
        }


        return $this;
    } // setMedium()

    /**
     * Set the value of [source] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setSource($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->source !== $v) {
            $this->source = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::SOURCE;
        }


        return $this;
    } // setSource()

    /**
     * Set the value of [gacountry] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setGacountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gacountry !== $v) {
            $this->gacountry = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::GACOUNTRY;
        }


        return $this;
    } // setGacountry()

    /**
     * Set the value of [processing] column.
     *
     * @param  int $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setProcessing($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->processing !== $v) {
            $this->processing = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PROCESSING;
        }


        return $this;
    } // setProcessing()

    /**
     * Set the value of [processed_by] column.
     *
     * @param  string $v new value
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setProcessedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->processed_by !== $v) {
            $this->processed_by = $v;
            $this->modifiedColumns[] = LeasingParkingLeadsPeer::PROCESSED_BY;
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
            $this->application_number = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->salutation = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->fname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->lname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->gender = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->age = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->birthday = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->mobile = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->property = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->unit = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->slots = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->ps_number = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->first_heard = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->payment_terms = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->payment_type = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
            $this->date_added = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->date_approved = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->date_enrolled = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->date_expiry = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->date_renewal = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->status = ($row[$startcol + 22] !== null) ? (int) $row[$startcol + 22] : null;
            $this->prev_status = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
            $this->client_ip = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
            $this->client_id = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
            $this->campaign = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->medium = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
            $this->source = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
            $this->gacountry = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
            $this->processing = ($row[$startcol + 30] !== null) ? (int) $row[$startcol + 30] : null;
            $this->processed_by = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 32; // 32 = LeasingParkingLeadsPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating LeasingParkingLeads object", $e);
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
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeasingParkingLeadsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLeasingParkingPaymentDetailss = null;

            $this->collLeasingPaymentTransactionss = null;

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
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeasingParkingLeadsQuery::create()
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
            $con = Propel::getConnection(LeasingParkingLeadsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeasingParkingLeadsPeer::addInstanceToPool($this);
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

            if ($this->leasingParkingPaymentDetailssScheduledForDeletion !== null) {
                if (!$this->leasingParkingPaymentDetailssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingParkingPaymentDetailssScheduledForDeletion as $leasingParkingPaymentDetails) {
                        // need to save related object because we set the relation to null
                        $leasingParkingPaymentDetails->save($con);
                    }
                    $this->leasingParkingPaymentDetailssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingParkingPaymentDetailss !== null) {
                foreach ($this->collLeasingParkingPaymentDetailss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leasingPaymentTransactionssScheduledForDeletion !== null) {
                if (!$this->leasingPaymentTransactionssScheduledForDeletion->isEmpty()) {
                    foreach ($this->leasingPaymentTransactionssScheduledForDeletion as $leasingPaymentTransactions) {
                        // need to save related object because we set the relation to null
                        $leasingPaymentTransactions->save($con);
                    }
                    $this->leasingPaymentTransactionssScheduledForDeletion = null;
                }
            }

            if ($this->collLeasingPaymentTransactionss !== null) {
                foreach ($this->collLeasingPaymentTransactionss as $referrerFK) {
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

        $this->modifiedColumns[] = LeasingParkingLeadsPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeasingParkingLeadsPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeasingParkingLeadsPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::APPLICATION_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`application_number`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = '`salutation`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::FNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fname`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::LNAME)) {
            $modifiedColumns[':p' . $index++]  = '`lname`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::GENDER)) {
            $modifiedColumns[':p' . $index++]  = '`gender`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::AGE)) {
            $modifiedColumns[':p' . $index++]  = '`age`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::BIRTHDAY)) {
            $modifiedColumns[':p' . $index++]  = '`birthday`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::MOBILE)) {
            $modifiedColumns[':p' . $index++]  = '`mobile`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PROPERTY)) {
            $modifiedColumns[':p' . $index++]  = '`property`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`unit`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::SLOTS)) {
            $modifiedColumns[':p' . $index++]  = '`slots`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PS_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`ps_number`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::FIRST_HEARD)) {
            $modifiedColumns[':p' . $index++]  = '`first_heard`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PAYMENT_TERMS)) {
            $modifiedColumns[':p' . $index++]  = '`payment_terms`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PAYMENT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`payment_type`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_APPROVED)) {
            $modifiedColumns[':p' . $index++]  = '`date_approved`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_ENROLLED)) {
            $modifiedColumns[':p' . $index++]  = '`date_enrolled`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_EXPIRY)) {
            $modifiedColumns[':p' . $index++]  = '`date_expiry`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_RENEWAL)) {
            $modifiedColumns[':p' . $index++]  = '`date_renewal`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PREV_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`prev_status`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::CLIENT_IP)) {
            $modifiedColumns[':p' . $index++]  = '`client_ip`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::CLIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`client_id`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::CAMPAIGN)) {
            $modifiedColumns[':p' . $index++]  = '`campaign`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::MEDIUM)) {
            $modifiedColumns[':p' . $index++]  = '`medium`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::SOURCE)) {
            $modifiedColumns[':p' . $index++]  = '`source`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::GACOUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`gacountry`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PROCESSING)) {
            $modifiedColumns[':p' . $index++]  = '`processing`';
        }
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PROCESSED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`processed_by`';
        }

        $sql = sprintf(
            'INSERT INTO `parking_leads` (%s) VALUES (%s)',
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
                    case '`application_number`':
                        $stmt->bindValue($identifier, $this->application_number, PDO::PARAM_STR);
                        break;
                    case '`salutation`':
                        $stmt->bindValue($identifier, $this->salutation, PDO::PARAM_STR);
                        break;
                    case '`fname`':
                        $stmt->bindValue($identifier, $this->fname, PDO::PARAM_STR);
                        break;
                    case '`lname`':
                        $stmt->bindValue($identifier, $this->lname, PDO::PARAM_STR);
                        break;
                    case '`gender`':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);
                        break;
                    case '`age`':
                        $stmt->bindValue($identifier, $this->age, PDO::PARAM_STR);
                        break;
                    case '`birthday`':
                        $stmt->bindValue($identifier, $this->birthday, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`mobile`':
                        $stmt->bindValue($identifier, $this->mobile, PDO::PARAM_STR);
                        break;
                    case '`property`':
                        $stmt->bindValue($identifier, $this->property, PDO::PARAM_STR);
                        break;
                    case '`unit`':
                        $stmt->bindValue($identifier, $this->unit, PDO::PARAM_STR);
                        break;
                    case '`slots`':
                        $stmt->bindValue($identifier, $this->slots, PDO::PARAM_INT);
                        break;
                    case '`ps_number`':
                        $stmt->bindValue($identifier, $this->ps_number, PDO::PARAM_STR);
                        break;
                    case '`first_heard`':
                        $stmt->bindValue($identifier, $this->first_heard, PDO::PARAM_STR);
                        break;
                    case '`payment_terms`':
                        $stmt->bindValue($identifier, $this->payment_terms, PDO::PARAM_STR);
                        break;
                    case '`payment_type`':
                        $stmt->bindValue($identifier, $this->payment_type, PDO::PARAM_INT);
                        break;
                    case '`date_added`':
                        $stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
                        break;
                    case '`date_approved`':
                        $stmt->bindValue($identifier, $this->date_approved, PDO::PARAM_STR);
                        break;
                    case '`date_enrolled`':
                        $stmt->bindValue($identifier, $this->date_enrolled, PDO::PARAM_STR);
                        break;
                    case '`date_expiry`':
                        $stmt->bindValue($identifier, $this->date_expiry, PDO::PARAM_STR);
                        break;
                    case '`date_renewal`':
                        $stmt->bindValue($identifier, $this->date_renewal, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`prev_status`':
                        $stmt->bindValue($identifier, $this->prev_status, PDO::PARAM_INT);
                        break;
                    case '`client_ip`':
                        $stmt->bindValue($identifier, $this->client_ip, PDO::PARAM_STR);
                        break;
                    case '`client_id`':
                        $stmt->bindValue($identifier, $this->client_id, PDO::PARAM_STR);
                        break;
                    case '`campaign`':
                        $stmt->bindValue($identifier, $this->campaign, PDO::PARAM_STR);
                        break;
                    case '`medium`':
                        $stmt->bindValue($identifier, $this->medium, PDO::PARAM_STR);
                        break;
                    case '`source`':
                        $stmt->bindValue($identifier, $this->source, PDO::PARAM_STR);
                        break;
                    case '`gacountry`':
                        $stmt->bindValue($identifier, $this->gacountry, PDO::PARAM_STR);
                        break;
                    case '`processing`':
                        $stmt->bindValue($identifier, $this->processing, PDO::PARAM_INT);
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


            if (($retval = LeasingParkingLeadsPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLeasingParkingPaymentDetailss !== null) {
                    foreach ($this->collLeasingParkingPaymentDetailss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeasingPaymentTransactionss !== null) {
                    foreach ($this->collLeasingPaymentTransactionss as $referrerFK) {
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
        $pos = LeasingParkingLeadsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getApplicationNumber();
                break;
            case 2:
                return $this->getSalutation();
                break;
            case 3:
                return $this->getFname();
                break;
            case 4:
                return $this->getLname();
                break;
            case 5:
                return $this->getGender();
                break;
            case 6:
                return $this->getAge();
                break;
            case 7:
                return $this->getBirthday();
                break;
            case 8:
                return $this->getEmail();
                break;
            case 9:
                return $this->getMobile();
                break;
            case 10:
                return $this->getProperty();
                break;
            case 11:
                return $this->getUnit();
                break;
            case 12:
                return $this->getSlots();
                break;
            case 13:
                return $this->getPsNumber();
                break;
            case 14:
                return $this->getFirstHeard();
                break;
            case 15:
                return $this->getPaymentTerms();
                break;
            case 16:
                return $this->getPaymentType();
                break;
            case 17:
                return $this->getDateAdded();
                break;
            case 18:
                return $this->getDateApproved();
                break;
            case 19:
                return $this->getDateEnrolled();
                break;
            case 20:
                return $this->getDateExpiry();
                break;
            case 21:
                return $this->getDateRenewal();
                break;
            case 22:
                return $this->getStatus();
                break;
            case 23:
                return $this->getPrevStatus();
                break;
            case 24:
                return $this->getClientIp();
                break;
            case 25:
                return $this->getClientId();
                break;
            case 26:
                return $this->getCampaign();
                break;
            case 27:
                return $this->getMedium();
                break;
            case 28:
                return $this->getSource();
                break;
            case 29:
                return $this->getGacountry();
                break;
            case 30:
                return $this->getProcessing();
                break;
            case 31:
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
        if (isset($alreadyDumpedObjects['LeasingParkingLeads'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['LeasingParkingLeads'][$this->getPrimaryKey()] = true;
        $keys = LeasingParkingLeadsPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getApplicationNumber(),
            $keys[2] => $this->getSalutation(),
            $keys[3] => $this->getFname(),
            $keys[4] => $this->getLname(),
            $keys[5] => $this->getGender(),
            $keys[6] => $this->getAge(),
            $keys[7] => $this->getBirthday(),
            $keys[8] => $this->getEmail(),
            $keys[9] => $this->getMobile(),
            $keys[10] => $this->getProperty(),
            $keys[11] => $this->getUnit(),
            $keys[12] => $this->getSlots(),
            $keys[13] => $this->getPsNumber(),
            $keys[14] => $this->getFirstHeard(),
            $keys[15] => $this->getPaymentTerms(),
            $keys[16] => $this->getPaymentType(),
            $keys[17] => $this->getDateAdded(),
            $keys[18] => $this->getDateApproved(),
            $keys[19] => $this->getDateEnrolled(),
            $keys[20] => $this->getDateExpiry(),
            $keys[21] => $this->getDateRenewal(),
            $keys[22] => $this->getStatus(),
            $keys[23] => $this->getPrevStatus(),
            $keys[24] => $this->getClientIp(),
            $keys[25] => $this->getClientId(),
            $keys[26] => $this->getCampaign(),
            $keys[27] => $this->getMedium(),
            $keys[28] => $this->getSource(),
            $keys[29] => $this->getGacountry(),
            $keys[30] => $this->getProcessing(),
            $keys[31] => $this->getProcessedBy(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLeasingParkingPaymentDetailss) {
                $result['LeasingParkingPaymentDetailss'] = $this->collLeasingParkingPaymentDetailss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeasingPaymentTransactionss) {
                $result['LeasingPaymentTransactionss'] = $this->collLeasingPaymentTransactionss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeasingParkingLeadsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setApplicationNumber($value);
                break;
            case 2:
                $this->setSalutation($value);
                break;
            case 3:
                $this->setFname($value);
                break;
            case 4:
                $this->setLname($value);
                break;
            case 5:
                $this->setGender($value);
                break;
            case 6:
                $this->setAge($value);
                break;
            case 7:
                $this->setBirthday($value);
                break;
            case 8:
                $this->setEmail($value);
                break;
            case 9:
                $this->setMobile($value);
                break;
            case 10:
                $this->setProperty($value);
                break;
            case 11:
                $this->setUnit($value);
                break;
            case 12:
                $this->setSlots($value);
                break;
            case 13:
                $this->setPsNumber($value);
                break;
            case 14:
                $this->setFirstHeard($value);
                break;
            case 15:
                $this->setPaymentTerms($value);
                break;
            case 16:
                $this->setPaymentType($value);
                break;
            case 17:
                $this->setDateAdded($value);
                break;
            case 18:
                $this->setDateApproved($value);
                break;
            case 19:
                $this->setDateEnrolled($value);
                break;
            case 20:
                $this->setDateExpiry($value);
                break;
            case 21:
                $this->setDateRenewal($value);
                break;
            case 22:
                $this->setStatus($value);
                break;
            case 23:
                $this->setPrevStatus($value);
                break;
            case 24:
                $this->setClientIp($value);
                break;
            case 25:
                $this->setClientId($value);
                break;
            case 26:
                $this->setCampaign($value);
                break;
            case 27:
                $this->setMedium($value);
                break;
            case 28:
                $this->setSource($value);
                break;
            case 29:
                $this->setGacountry($value);
                break;
            case 30:
                $this->setProcessing($value);
                break;
            case 31:
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
        $keys = LeasingParkingLeadsPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setApplicationNumber($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSalutation($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setFname($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLname($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setGender($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAge($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setBirthday($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setEmail($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMobile($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setProperty($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUnit($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setSlots($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setPsNumber($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setFirstHeard($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setPaymentTerms($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setPaymentType($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setDateAdded($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setDateApproved($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setDateEnrolled($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setDateExpiry($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setDateRenewal($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setStatus($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setPrevStatus($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setClientIp($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setClientId($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setCampaign($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setMedium($arr[$keys[27]]);
        if (array_key_exists($keys[28], $arr)) $this->setSource($arr[$keys[28]]);
        if (array_key_exists($keys[29], $arr)) $this->setGacountry($arr[$keys[29]]);
        if (array_key_exists($keys[30], $arr)) $this->setProcessing($arr[$keys[30]]);
        if (array_key_exists($keys[31], $arr)) $this->setProcessedBy($arr[$keys[31]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeasingParkingLeadsPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeasingParkingLeadsPeer::ID)) $criteria->add(LeasingParkingLeadsPeer::ID, $this->id);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::APPLICATION_NUMBER)) $criteria->add(LeasingParkingLeadsPeer::APPLICATION_NUMBER, $this->application_number);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::SALUTATION)) $criteria->add(LeasingParkingLeadsPeer::SALUTATION, $this->salutation);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::FNAME)) $criteria->add(LeasingParkingLeadsPeer::FNAME, $this->fname);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::LNAME)) $criteria->add(LeasingParkingLeadsPeer::LNAME, $this->lname);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::GENDER)) $criteria->add(LeasingParkingLeadsPeer::GENDER, $this->gender);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::AGE)) $criteria->add(LeasingParkingLeadsPeer::AGE, $this->age);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::BIRTHDAY)) $criteria->add(LeasingParkingLeadsPeer::BIRTHDAY, $this->birthday);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::EMAIL)) $criteria->add(LeasingParkingLeadsPeer::EMAIL, $this->email);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::MOBILE)) $criteria->add(LeasingParkingLeadsPeer::MOBILE, $this->mobile);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PROPERTY)) $criteria->add(LeasingParkingLeadsPeer::PROPERTY, $this->property);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::UNIT)) $criteria->add(LeasingParkingLeadsPeer::UNIT, $this->unit);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::SLOTS)) $criteria->add(LeasingParkingLeadsPeer::SLOTS, $this->slots);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PS_NUMBER)) $criteria->add(LeasingParkingLeadsPeer::PS_NUMBER, $this->ps_number);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::FIRST_HEARD)) $criteria->add(LeasingParkingLeadsPeer::FIRST_HEARD, $this->first_heard);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PAYMENT_TERMS)) $criteria->add(LeasingParkingLeadsPeer::PAYMENT_TERMS, $this->payment_terms);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PAYMENT_TYPE)) $criteria->add(LeasingParkingLeadsPeer::PAYMENT_TYPE, $this->payment_type);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_ADDED)) $criteria->add(LeasingParkingLeadsPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_APPROVED)) $criteria->add(LeasingParkingLeadsPeer::DATE_APPROVED, $this->date_approved);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_ENROLLED)) $criteria->add(LeasingParkingLeadsPeer::DATE_ENROLLED, $this->date_enrolled);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_EXPIRY)) $criteria->add(LeasingParkingLeadsPeer::DATE_EXPIRY, $this->date_expiry);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::DATE_RENEWAL)) $criteria->add(LeasingParkingLeadsPeer::DATE_RENEWAL, $this->date_renewal);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::STATUS)) $criteria->add(LeasingParkingLeadsPeer::STATUS, $this->status);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PREV_STATUS)) $criteria->add(LeasingParkingLeadsPeer::PREV_STATUS, $this->prev_status);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::CLIENT_IP)) $criteria->add(LeasingParkingLeadsPeer::CLIENT_IP, $this->client_ip);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::CLIENT_ID)) $criteria->add(LeasingParkingLeadsPeer::CLIENT_ID, $this->client_id);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::CAMPAIGN)) $criteria->add(LeasingParkingLeadsPeer::CAMPAIGN, $this->campaign);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::MEDIUM)) $criteria->add(LeasingParkingLeadsPeer::MEDIUM, $this->medium);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::SOURCE)) $criteria->add(LeasingParkingLeadsPeer::SOURCE, $this->source);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::GACOUNTRY)) $criteria->add(LeasingParkingLeadsPeer::GACOUNTRY, $this->gacountry);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PROCESSING)) $criteria->add(LeasingParkingLeadsPeer::PROCESSING, $this->processing);
        if ($this->isColumnModified(LeasingParkingLeadsPeer::PROCESSED_BY)) $criteria->add(LeasingParkingLeadsPeer::PROCESSED_BY, $this->processed_by);

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
        $criteria = new Criteria(LeasingParkingLeadsPeer::DATABASE_NAME);
        $criteria->add(LeasingParkingLeadsPeer::ID, $this->id);

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
     * @param object $copyObj An object of LeasingParkingLeads (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setApplicationNumber($this->getApplicationNumber());
        $copyObj->setSalutation($this->getSalutation());
        $copyObj->setFname($this->getFname());
        $copyObj->setLname($this->getLname());
        $copyObj->setGender($this->getGender());
        $copyObj->setAge($this->getAge());
        $copyObj->setBirthday($this->getBirthday());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setProperty($this->getProperty());
        $copyObj->setUnit($this->getUnit());
        $copyObj->setSlots($this->getSlots());
        $copyObj->setPsNumber($this->getPsNumber());
        $copyObj->setFirstHeard($this->getFirstHeard());
        $copyObj->setPaymentTerms($this->getPaymentTerms());
        $copyObj->setPaymentType($this->getPaymentType());
        $copyObj->setDateAdded($this->getDateAdded());
        $copyObj->setDateApproved($this->getDateApproved());
        $copyObj->setDateEnrolled($this->getDateEnrolled());
        $copyObj->setDateExpiry($this->getDateExpiry());
        $copyObj->setDateRenewal($this->getDateRenewal());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setPrevStatus($this->getPrevStatus());
        $copyObj->setClientIp($this->getClientIp());
        $copyObj->setClientId($this->getClientId());
        $copyObj->setCampaign($this->getCampaign());
        $copyObj->setMedium($this->getMedium());
        $copyObj->setSource($this->getSource());
        $copyObj->setGacountry($this->getGacountry());
        $copyObj->setProcessing($this->getProcessing());
        $copyObj->setProcessedBy($this->getProcessedBy());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLeasingParkingPaymentDetailss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingParkingPaymentDetails($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeasingPaymentTransactionss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeasingPaymentTransactions($relObj->copy($deepCopy));
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
     * @return LeasingParkingLeads Clone of current object.
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
     * @return LeasingParkingLeadsPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeasingParkingLeadsPeer();
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
        if ('LeasingParkingPaymentDetails' == $relationName) {
            $this->initLeasingParkingPaymentDetailss();
        }
        if ('LeasingPaymentTransactions' == $relationName) {
            $this->initLeasingPaymentTransactionss();
        }
    }

    /**
     * Clears out the collLeasingParkingPaymentDetailss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingParkingLeads The current object (for fluent API support)
     * @see        addLeasingParkingPaymentDetailss()
     */
    public function clearLeasingParkingPaymentDetailss()
    {
        $this->collLeasingParkingPaymentDetailss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingParkingPaymentDetailssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingParkingPaymentDetailss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingParkingPaymentDetailss($v = true)
    {
        $this->collLeasingParkingPaymentDetailssPartial = $v;
    }

    /**
     * Initializes the collLeasingParkingPaymentDetailss collection.
     *
     * By default this just sets the collLeasingParkingPaymentDetailss collection to an empty array (like clearcollLeasingParkingPaymentDetailss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingParkingPaymentDetailss($overrideExisting = true)
    {
        if (null !== $this->collLeasingParkingPaymentDetailss && !$overrideExisting) {
            return;
        }
        $this->collLeasingParkingPaymentDetailss = new PropelObjectCollection();
        $this->collLeasingParkingPaymentDetailss->setModel('LeasingParkingPaymentDetails');
    }

    /**
     * Gets an array of LeasingParkingPaymentDetails objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingParkingLeads is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingParkingPaymentDetails[] List of LeasingParkingPaymentDetails objects
     * @throws PropelException
     */
    public function getLeasingParkingPaymentDetailss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingParkingPaymentDetailssPartial && !$this->isNew();
        if (null === $this->collLeasingParkingPaymentDetailss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingParkingPaymentDetailss) {
                // return empty collection
                $this->initLeasingParkingPaymentDetailss();
            } else {
                $collLeasingParkingPaymentDetailss = LeasingParkingPaymentDetailsQuery::create(null, $criteria)
                    ->filterByLeasingParkingLeads($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingParkingPaymentDetailssPartial && count($collLeasingParkingPaymentDetailss)) {
                      $this->initLeasingParkingPaymentDetailss(false);

                      foreach ($collLeasingParkingPaymentDetailss as $obj) {
                        if (false == $this->collLeasingParkingPaymentDetailss->contains($obj)) {
                          $this->collLeasingParkingPaymentDetailss->append($obj);
                        }
                      }

                      $this->collLeasingParkingPaymentDetailssPartial = true;
                    }

                    $collLeasingParkingPaymentDetailss->getInternalIterator()->rewind();

                    return $collLeasingParkingPaymentDetailss;
                }

                if ($partial && $this->collLeasingParkingPaymentDetailss) {
                    foreach ($this->collLeasingParkingPaymentDetailss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingParkingPaymentDetailss[] = $obj;
                        }
                    }
                }

                $this->collLeasingParkingPaymentDetailss = $collLeasingParkingPaymentDetailss;
                $this->collLeasingParkingPaymentDetailssPartial = false;
            }
        }

        return $this->collLeasingParkingPaymentDetailss;
    }

    /**
     * Sets a collection of LeasingParkingPaymentDetails objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingParkingPaymentDetailss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setLeasingParkingPaymentDetailss(PropelCollection $leasingParkingPaymentDetailss, PropelPDO $con = null)
    {
        $leasingParkingPaymentDetailssToDelete = $this->getLeasingParkingPaymentDetailss(new Criteria(), $con)->diff($leasingParkingPaymentDetailss);


        $this->leasingParkingPaymentDetailssScheduledForDeletion = $leasingParkingPaymentDetailssToDelete;

        foreach ($leasingParkingPaymentDetailssToDelete as $leasingParkingPaymentDetailsRemoved) {
            $leasingParkingPaymentDetailsRemoved->setLeasingParkingLeads(null);
        }

        $this->collLeasingParkingPaymentDetailss = null;
        foreach ($leasingParkingPaymentDetailss as $leasingParkingPaymentDetails) {
            $this->addLeasingParkingPaymentDetails($leasingParkingPaymentDetails);
        }

        $this->collLeasingParkingPaymentDetailss = $leasingParkingPaymentDetailss;
        $this->collLeasingParkingPaymentDetailssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingParkingPaymentDetails objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingParkingPaymentDetails objects.
     * @throws PropelException
     */
    public function countLeasingParkingPaymentDetailss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingParkingPaymentDetailssPartial && !$this->isNew();
        if (null === $this->collLeasingParkingPaymentDetailss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingParkingPaymentDetailss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingParkingPaymentDetailss());
            }
            $query = LeasingParkingPaymentDetailsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingParkingLeads($this)
                ->count($con);
        }

        return count($this->collLeasingParkingPaymentDetailss);
    }

    /**
     * Method called to associate a LeasingParkingPaymentDetails object to this object
     * through the LeasingParkingPaymentDetails foreign key attribute.
     *
     * @param    LeasingParkingPaymentDetails $l LeasingParkingPaymentDetails
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function addLeasingParkingPaymentDetails(LeasingParkingPaymentDetails $l)
    {
        if ($this->collLeasingParkingPaymentDetailss === null) {
            $this->initLeasingParkingPaymentDetailss();
            $this->collLeasingParkingPaymentDetailssPartial = true;
        }

        if (!in_array($l, $this->collLeasingParkingPaymentDetailss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingParkingPaymentDetails($l);

            if ($this->leasingParkingPaymentDetailssScheduledForDeletion and $this->leasingParkingPaymentDetailssScheduledForDeletion->contains($l)) {
                $this->leasingParkingPaymentDetailssScheduledForDeletion->remove($this->leasingParkingPaymentDetailssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingParkingPaymentDetails $leasingParkingPaymentDetails The leasingParkingPaymentDetails object to add.
     */
    protected function doAddLeasingParkingPaymentDetails($leasingParkingPaymentDetails)
    {
        $this->collLeasingParkingPaymentDetailss[]= $leasingParkingPaymentDetails;
        $leasingParkingPaymentDetails->setLeasingParkingLeads($this);
    }

    /**
     * @param	LeasingParkingPaymentDetails $leasingParkingPaymentDetails The leasingParkingPaymentDetails object to remove.
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function removeLeasingParkingPaymentDetails($leasingParkingPaymentDetails)
    {
        if ($this->getLeasingParkingPaymentDetailss()->contains($leasingParkingPaymentDetails)) {
            $this->collLeasingParkingPaymentDetailss->remove($this->collLeasingParkingPaymentDetailss->search($leasingParkingPaymentDetails));
            if (null === $this->leasingParkingPaymentDetailssScheduledForDeletion) {
                $this->leasingParkingPaymentDetailssScheduledForDeletion = clone $this->collLeasingParkingPaymentDetailss;
                $this->leasingParkingPaymentDetailssScheduledForDeletion->clear();
            }
            $this->leasingParkingPaymentDetailssScheduledForDeletion[]= $leasingParkingPaymentDetails;
            $leasingParkingPaymentDetails->setLeasingParkingLeads(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeasingPaymentTransactionss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return LeasingParkingLeads The current object (for fluent API support)
     * @see        addLeasingPaymentTransactionss()
     */
    public function clearLeasingPaymentTransactionss()
    {
        $this->collLeasingPaymentTransactionss = null; // important to set this to null since that means it is uninitialized
        $this->collLeasingPaymentTransactionssPartial = null;

        return $this;
    }

    /**
     * reset is the collLeasingPaymentTransactionss collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeasingPaymentTransactionss($v = true)
    {
        $this->collLeasingPaymentTransactionssPartial = $v;
    }

    /**
     * Initializes the collLeasingPaymentTransactionss collection.
     *
     * By default this just sets the collLeasingPaymentTransactionss collection to an empty array (like clearcollLeasingPaymentTransactionss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeasingPaymentTransactionss($overrideExisting = true)
    {
        if (null !== $this->collLeasingPaymentTransactionss && !$overrideExisting) {
            return;
        }
        $this->collLeasingPaymentTransactionss = new PropelObjectCollection();
        $this->collLeasingPaymentTransactionss->setModel('LeasingPaymentTransactions');
    }

    /**
     * Gets an array of LeasingPaymentTransactions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this LeasingParkingLeads is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     * @throws PropelException
     */
    public function getLeasingPaymentTransactionss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPaymentTransactionssPartial && !$this->isNew();
        if (null === $this->collLeasingPaymentTransactionss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeasingPaymentTransactionss) {
                // return empty collection
                $this->initLeasingPaymentTransactionss();
            } else {
                $collLeasingPaymentTransactionss = LeasingPaymentTransactionsQuery::create(null, $criteria)
                    ->filterByLeasingParkingLeads($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeasingPaymentTransactionssPartial && count($collLeasingPaymentTransactionss)) {
                      $this->initLeasingPaymentTransactionss(false);

                      foreach ($collLeasingPaymentTransactionss as $obj) {
                        if (false == $this->collLeasingPaymentTransactionss->contains($obj)) {
                          $this->collLeasingPaymentTransactionss->append($obj);
                        }
                      }

                      $this->collLeasingPaymentTransactionssPartial = true;
                    }

                    $collLeasingPaymentTransactionss->getInternalIterator()->rewind();

                    return $collLeasingPaymentTransactionss;
                }

                if ($partial && $this->collLeasingPaymentTransactionss) {
                    foreach ($this->collLeasingPaymentTransactionss as $obj) {
                        if ($obj->isNew()) {
                            $collLeasingPaymentTransactionss[] = $obj;
                        }
                    }
                }

                $this->collLeasingPaymentTransactionss = $collLeasingPaymentTransactionss;
                $this->collLeasingPaymentTransactionssPartial = false;
            }
        }

        return $this->collLeasingPaymentTransactionss;
    }

    /**
     * Sets a collection of LeasingPaymentTransactions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leasingPaymentTransactionss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function setLeasingPaymentTransactionss(PropelCollection $leasingPaymentTransactionss, PropelPDO $con = null)
    {
        $leasingPaymentTransactionssToDelete = $this->getLeasingPaymentTransactionss(new Criteria(), $con)->diff($leasingPaymentTransactionss);


        $this->leasingPaymentTransactionssScheduledForDeletion = $leasingPaymentTransactionssToDelete;

        foreach ($leasingPaymentTransactionssToDelete as $leasingPaymentTransactionsRemoved) {
            $leasingPaymentTransactionsRemoved->setLeasingParkingLeads(null);
        }

        $this->collLeasingPaymentTransactionss = null;
        foreach ($leasingPaymentTransactionss as $leasingPaymentTransactions) {
            $this->addLeasingPaymentTransactions($leasingPaymentTransactions);
        }

        $this->collLeasingPaymentTransactionss = $leasingPaymentTransactionss;
        $this->collLeasingPaymentTransactionssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeasingPaymentTransactions objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LeasingPaymentTransactions objects.
     * @throws PropelException
     */
    public function countLeasingPaymentTransactionss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeasingPaymentTransactionssPartial && !$this->isNew();
        if (null === $this->collLeasingPaymentTransactionss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeasingPaymentTransactionss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeasingPaymentTransactionss());
            }
            $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeasingParkingLeads($this)
                ->count($con);
        }

        return count($this->collLeasingPaymentTransactionss);
    }

    /**
     * Method called to associate a LeasingPaymentTransactions object to this object
     * through the LeasingPaymentTransactions foreign key attribute.
     *
     * @param    LeasingPaymentTransactions $l LeasingPaymentTransactions
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function addLeasingPaymentTransactions(LeasingPaymentTransactions $l)
    {
        if ($this->collLeasingPaymentTransactionss === null) {
            $this->initLeasingPaymentTransactionss();
            $this->collLeasingPaymentTransactionssPartial = true;
        }

        if (!in_array($l, $this->collLeasingPaymentTransactionss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeasingPaymentTransactions($l);

            if ($this->leasingPaymentTransactionssScheduledForDeletion and $this->leasingPaymentTransactionssScheduledForDeletion->contains($l)) {
                $this->leasingPaymentTransactionssScheduledForDeletion->remove($this->leasingPaymentTransactionssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	LeasingPaymentTransactions $leasingPaymentTransactions The leasingPaymentTransactions object to add.
     */
    protected function doAddLeasingPaymentTransactions($leasingPaymentTransactions)
    {
        $this->collLeasingPaymentTransactionss[]= $leasingPaymentTransactions;
        $leasingPaymentTransactions->setLeasingParkingLeads($this);
    }

    /**
     * @param	LeasingPaymentTransactions $leasingPaymentTransactions The leasingPaymentTransactions object to remove.
     * @return LeasingParkingLeads The current object (for fluent API support)
     */
    public function removeLeasingPaymentTransactions($leasingPaymentTransactions)
    {
        if ($this->getLeasingPaymentTransactionss()->contains($leasingPaymentTransactions)) {
            $this->collLeasingPaymentTransactionss->remove($this->collLeasingPaymentTransactionss->search($leasingPaymentTransactions));
            if (null === $this->leasingPaymentTransactionssScheduledForDeletion) {
                $this->leasingPaymentTransactionssScheduledForDeletion = clone $this->collLeasingPaymentTransactionss;
                $this->leasingPaymentTransactionssScheduledForDeletion->clear();
            }
            $this->leasingPaymentTransactionssScheduledForDeletion[]= $leasingPaymentTransactions;
            $leasingPaymentTransactions->setLeasingParkingLeads(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingParkingLeads is new, it will return
     * an empty collection; or if this LeasingParkingLeads has previously
     * been saved, it will retrieve related LeasingPaymentTransactionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingParkingLeads.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     */
    public function getLeasingPaymentTransactionssJoinLeasingEventBookings($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
        $query->joinWith('LeasingEventBookings', $join_behavior);

        return $this->getLeasingPaymentTransactionss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this LeasingParkingLeads is new, it will return
     * an empty collection; or if this LeasingParkingLeads has previously
     * been saved, it will retrieve related LeasingPaymentTransactionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in LeasingParkingLeads.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LeasingPaymentTransactions[] List of LeasingPaymentTransactions objects
     */
    public function getLeasingPaymentTransactionssJoinLeasingBookings($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LeasingPaymentTransactionsQuery::create(null, $criteria);
        $query->joinWith('LeasingBookings', $join_behavior);

        return $this->getLeasingPaymentTransactionss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->application_number = null;
        $this->salutation = null;
        $this->fname = null;
        $this->lname = null;
        $this->gender = null;
        $this->age = null;
        $this->birthday = null;
        $this->email = null;
        $this->mobile = null;
        $this->property = null;
        $this->unit = null;
        $this->slots = null;
        $this->ps_number = null;
        $this->first_heard = null;
        $this->payment_terms = null;
        $this->payment_type = null;
        $this->date_added = null;
        $this->date_approved = null;
        $this->date_enrolled = null;
        $this->date_expiry = null;
        $this->date_renewal = null;
        $this->status = null;
        $this->prev_status = null;
        $this->client_ip = null;
        $this->client_id = null;
        $this->campaign = null;
        $this->medium = null;
        $this->source = null;
        $this->gacountry = null;
        $this->processing = null;
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
            if ($this->collLeasingParkingPaymentDetailss) {
                foreach ($this->collLeasingParkingPaymentDetailss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeasingPaymentTransactionss) {
                foreach ($this->collLeasingPaymentTransactionss as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collLeasingParkingPaymentDetailss instanceof PropelCollection) {
            $this->collLeasingParkingPaymentDetailss->clearIterator();
        }
        $this->collLeasingParkingPaymentDetailss = null;
        if ($this->collLeasingPaymentTransactionss instanceof PropelCollection) {
            $this->collLeasingPaymentTransactionss->clearIterator();
        }
        $this->collLeasingPaymentTransactionss = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LeasingParkingLeadsPeer::DEFAULT_STRING_FORMAT);
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
