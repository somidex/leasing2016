<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'parking_leads' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Leasing.CoreBundle.Model.map
 */
class LeasingParkingLeadsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingParkingLeadsTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('parking_leads');
        $this->setPhpName('LeasingParkingLeads');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingParkingLeads');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('application_number', 'ApplicationNumber', 'VARCHAR', false, 100, null);
        $this->addColumn('salutation', 'Salutation', 'VARCHAR', false, 45, null);
        $this->addColumn('fname', 'Fname', 'VARCHAR', false, 255, null);
        $this->addColumn('lname', 'Lname', 'VARCHAR', false, 255, null);
        $this->addColumn('gender', 'Gender', 'VARCHAR', false, 45, null);
        $this->addColumn('age', 'Age', 'VARCHAR', false, 45, null);
        $this->addColumn('birthday', 'Birthday', 'VARCHAR', false, 45, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, 45, null);
        $this->addColumn('property', 'Property', 'VARCHAR', false, 255, null);
        $this->addColumn('unit', 'Unit', 'VARCHAR', false, 100, null);
        $this->addColumn('slots', 'Slots', 'INTEGER', false, 11, null);
        $this->addColumn('ps_number', 'PsNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('first_heard', 'FirstHeard', 'VARCHAR', false, 255, null);
        $this->addColumn('payment_terms', 'PaymentTerms', 'VARCHAR', false, 45, null);
        $this->addColumn('payment_type', 'PaymentType', 'INTEGER', false, 11, null);
        $this->addColumn('date_added', 'DateAdded', 'VARCHAR', false, 45, null);
        $this->addColumn('date_approved', 'DateApproved', 'VARCHAR', false, 45, null);
        $this->addColumn('date_enrolled', 'DateEnrolled', 'VARCHAR', false, 45, null);
        $this->addColumn('date_expiry', 'DateExpiry', 'VARCHAR', false, 45, null);
        $this->addColumn('date_renewal', 'DateRenewal', 'VARCHAR', false, 45, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addColumn('prev_status', 'PrevStatus', 'INTEGER', false, 11, null);
        $this->addColumn('client_ip', 'ClientIp', 'VARCHAR', false, 255, null);
        $this->addColumn('client_id', 'ClientId', 'VARCHAR', false, 255, null);
        $this->addColumn('campaign', 'Campaign', 'VARCHAR', false, 255, null);
        $this->addColumn('medium', 'Medium', 'VARCHAR', false, 255, null);
        $this->addColumn('source', 'Source', 'VARCHAR', false, 255, null);
        $this->addColumn('gacountry', 'Gacountry', 'VARCHAR', false, 255, null);
        $this->addColumn('processing', 'Processing', 'INTEGER', false, 11, null);
        $this->addColumn('processed_by', 'ProcessedBy', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingParkingPaymentDetails', 'Leasing\\CoreBundle\\Model\\LeasingParkingPaymentDetails', RelationMap::ONE_TO_MANY, array('id' => 'parking_lead_id', ), null, null, 'LeasingParkingPaymentDetailss');
        $this->addRelation('LeasingPaymentTransactions', 'Leasing\\CoreBundle\\Model\\LeasingPaymentTransactions', RelationMap::ONE_TO_MANY, array('id' => 'parking_leads_id', ), null, null, 'LeasingPaymentTransactionss');
    } // buildRelations()

} // LeasingParkingLeadsTableMap
