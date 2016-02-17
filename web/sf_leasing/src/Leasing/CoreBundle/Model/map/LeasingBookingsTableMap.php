<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bookings' table.
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
class LeasingBookingsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingBookingsTableMap';

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
        $this->setName('bookings');
        $this->setPhpName('LeasingBookings');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingBookings');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('booking_leads_id', 'BookingLeadsId', 'INTEGER', 'booking_leads', 'id', false, 11, null);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'unit', 'id', false, 11, null);
        $this->addColumn('check_in', 'CheckIn', 'VARCHAR', false, 100, null);
        $this->addColumn('check_out', 'CheckOut', 'VARCHAR', false, 100, null);
        $this->addColumn('confirmation_code', 'ConfirmationCode', 'VARCHAR', false, 45, null);
        $this->addColumn('start_date', 'StartDate', 'VARCHAR', false, 45, null);
        $this->addColumn('end_date', 'EndDate', 'VARCHAR', false, 45, null);
        $this->addColumn('notes', 'Notes', 'VARCHAR', false, 255, null);
        $this->addColumn('date_added', 'DateAdded', 'VARCHAR', false, 45, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addColumn('prev_status', 'PrevStatus', 'INTEGER', false, 11, null);
        $this->addColumn('processing', 'Processing', 'INTEGER', false, 11, null);
        $this->addColumn('processed_by', 'ProcessedBy', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingBookingLeads', 'Leasing\\CoreBundle\\Model\\LeasingBookingLeads', RelationMap::MANY_TO_ONE, array('booking_leads_id' => 'id', ), null, null);
        $this->addRelation('LeasingUnit', 'Leasing\\CoreBundle\\Model\\LeasingUnit', RelationMap::MANY_TO_ONE, array('unit_id' => 'id', ), null, null);
        $this->addRelation('LeasingBookingAssignment', 'Leasing\\CoreBundle\\Model\\LeasingBookingAssignment', RelationMap::ONE_TO_MANY, array('id' => 'bookings_id', ), null, null, 'LeasingBookingAssignments');
        $this->addRelation('LeasingPaymentTransactions', 'Leasing\\CoreBundle\\Model\\LeasingPaymentTransactions', RelationMap::ONE_TO_MANY, array('id' => 'bookings_id', ), null, null, 'LeasingPaymentTransactionss');
    } // buildRelations()

} // LeasingBookingsTableMap
