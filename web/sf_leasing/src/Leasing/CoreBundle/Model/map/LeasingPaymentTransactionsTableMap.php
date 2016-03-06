<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'payment_transactions' table.
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
class LeasingPaymentTransactionsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingPaymentTransactionsTableMap';

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
        $this->setName('payment_transactions');
        $this->setPhpName('LeasingPaymentTransactions');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingPaymentTransactions');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('transaction_type', 'TransactionType', 'INTEGER', false, 11, null);
        $this->addColumn('transaction_date', 'TransactionDate', 'VARCHAR', false, 45, null);
        $this->addColumn('transaction_code', 'TransactionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('transaction_cost', 'TransactionCost', 'FLOAT', false, 11, null);
        $this->addColumn('tax', 'Tax', 'FLOAT', false, 11, null);
        $this->addColumn('fee', 'Fee', 'FLOAT', false, 11, null);
        $this->addColumn('amount_paid', 'AmountPaid', 'FLOAT', false, 11, null);
        $this->addForeignKey('parking_leads_id', 'ParkingLeadsId', 'INTEGER', 'parking_leads', 'id', false, 11, null);
        $this->addForeignKey('event_bookings_id', 'EventBookingsId', 'INTEGER', 'event_bookings', 'id', false, 11, null);
        $this->addForeignKey('bookings_id', 'BookingsId', 'INTEGER', 'bookings', 'id', false, 11, null);
        $this->addColumn('processed_by', 'ProcessedBy', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingParkingLeads', 'Leasing\\CoreBundle\\Model\\LeasingParkingLeads', RelationMap::MANY_TO_ONE, array('parking_leads_id' => 'id', ), null, null);
        $this->addRelation('LeasingEventBookings', 'Leasing\\CoreBundle\\Model\\LeasingEventBookings', RelationMap::MANY_TO_ONE, array('event_bookings_id' => 'id', ), null, null);
        $this->addRelation('LeasingBookings', 'Leasing\\CoreBundle\\Model\\LeasingBookings', RelationMap::MANY_TO_ONE, array('bookings_id' => 'id', ), null, null);
        $this->addRelation('LeasingPaymentValidity', 'Leasing\\CoreBundle\\Model\\LeasingPaymentValidity', RelationMap::ONE_TO_MANY, array('id' => 'transaction_id', ), null, null, 'LeasingPaymentValidities');
    } // buildRelations()

} // LeasingPaymentTransactionsTableMap
