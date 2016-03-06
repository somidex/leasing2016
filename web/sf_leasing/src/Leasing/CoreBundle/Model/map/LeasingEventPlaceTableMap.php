<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'event_place' table.
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
class LeasingEventPlaceTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingEventPlaceTableMap';

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
        $this->setName('event_place');
        $this->setPhpName('LeasingEventPlace');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingEventPlace');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('post_id', 'PostId', 'INTEGER', false, 11, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('content', 'Content', 'VARCHAR', false, 255, null);
        $this->addColumn('short_address', 'ShortAddress', 'VARCHAR', false, 45, null);
        $this->addColumn('full_address', 'FullAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('contact', 'Contact', 'VARCHAR', false, 45, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 45, null);
        $this->addColumn('min', 'Min', 'INTEGER', false, 100, null);
        $this->addColumn('max', 'Max', 'INTEGER', false, 100, null);
        $this->addColumn('reservation_fee', 'ReservationFee', 'INTEGER', false, 100, null);
        $this->addColumn('security_deposit', 'SecurityDeposit', 'INTEGER', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingEventBookings', 'Leasing\\CoreBundle\\Model\\LeasingEventBookings', RelationMap::ONE_TO_MANY, array('id' => 'event_place_id', ), null, null, 'LeasingEventBookingss');
        $this->addRelation('LeasingEventInquiries', 'Leasing\\CoreBundle\\Model\\LeasingEventInquiries', RelationMap::ONE_TO_MANY, array('id' => 'event_place_id', ), null, null, 'LeasingEventInquiriess');
    } // buildRelations()

} // LeasingEventPlaceTableMap
