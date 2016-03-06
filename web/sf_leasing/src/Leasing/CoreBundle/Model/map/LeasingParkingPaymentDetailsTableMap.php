<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'parking_payment_details' table.
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
class LeasingParkingPaymentDetailsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingParkingPaymentDetailsTableMap';

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
        $this->setName('parking_payment_details');
        $this->setPhpName('LeasingParkingPaymentDetails');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingParkingPaymentDetails');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('parking_lead_id', 'ParkingLeadId', 'INTEGER', 'parking_leads', 'id', false, 100, null);
        $this->addColumn('slots', 'Slots', 'INTEGER', false, 100, null);
        $this->addColumn('monthly_cost', 'MonthlyCost', 'FLOAT', false, 100, null);
        $this->addColumn('period', 'Period', 'INTEGER', false, 100, null);
        $this->addColumn('total_cost', 'TotalCost', 'FLOAT', false, 100, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingParkingLeads', 'Leasing\\CoreBundle\\Model\\LeasingParkingLeads', RelationMap::MANY_TO_ONE, array('parking_lead_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingParkingPaymentDetailsTableMap
