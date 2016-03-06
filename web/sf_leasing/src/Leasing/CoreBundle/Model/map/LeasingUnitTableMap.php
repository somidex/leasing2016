<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'unit' table.
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
class LeasingUnitTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingUnitTableMap';

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
        $this->setName('unit');
        $this->setPhpName('LeasingUnit');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingUnit');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('post_id', 'PostId', 'INTEGER', false, 11, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('content', 'Content', 'VARCHAR', false, 255, null);
        $this->addColumn('availability', 'Availability', 'INTEGER', false, 11, null);
        $this->addColumn('price_range', 'PriceRange', 'VARCHAR', false, 45, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addForeignKey('unit_type_id', 'UnitTypeId', 'INTEGER', 'unit_type', 'id', false, 11, null);
        $this->addForeignKey('location_id', 'LocationId', 'INTEGER', 'location', 'id', false, 11, null);
        $this->addForeignKey('lease_type_id', 'LeaseTypeId', 'INTEGER', 'lease_type', 'id', false, 11, null);
        $this->addForeignKey('project_id', 'ProjectId', 'INTEGER', 'projects', 'id', false, 11, null);
        $this->addForeignKey('br_id', 'BrId', 'INTEGER', 'unit_no_br', 'id', false, 11, null);
        $this->addForeignKey('dress_up_id', 'DressUpId', 'INTEGER', 'unit_dress_up', 'id', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingUnitType', 'Leasing\\CoreBundle\\Model\\LeasingUnitType', RelationMap::MANY_TO_ONE, array('unit_type_id' => 'id', ), null, null);
        $this->addRelation('LeasingLocation', 'Leasing\\CoreBundle\\Model\\LeasingLocation', RelationMap::MANY_TO_ONE, array('location_id' => 'id', ), null, null);
        $this->addRelation('LeasingLeaseType', 'Leasing\\CoreBundle\\Model\\LeasingLeaseType', RelationMap::MANY_TO_ONE, array('lease_type_id' => 'id', ), null, null);
        $this->addRelation('LeasingProjects', 'Leasing\\CoreBundle\\Model\\LeasingProjects', RelationMap::MANY_TO_ONE, array('project_id' => 'id', ), null, null);
        $this->addRelation('LeasingUnitDressUp', 'Leasing\\CoreBundle\\Model\\LeasingUnitDressUp', RelationMap::MANY_TO_ONE, array('dress_up_id' => 'id', ), null, null);
        $this->addRelation('LeasingUnitNumberBedrooms', 'Leasing\\CoreBundle\\Model\\LeasingUnitNumberBedrooms', RelationMap::MANY_TO_ONE, array('br_id' => 'id', ), null, null);
        $this->addRelation('LeasingAppointments', 'Leasing\\CoreBundle\\Model\\LeasingAppointments', RelationMap::ONE_TO_MANY, array('id' => 'unit_id', ), null, null, 'LeasingAppointmentss');
        $this->addRelation('LeasingBookings', 'Leasing\\CoreBundle\\Model\\LeasingBookings', RelationMap::ONE_TO_MANY, array('id' => 'unit_id', ), null, null, 'LeasingBookingss');
        $this->addRelation('LeasingPriceRange', 'Leasing\\CoreBundle\\Model\\LeasingPriceRange', RelationMap::ONE_TO_MANY, array('id' => 'unit_id', ), null, null, 'LeasingPriceRanges');
        $this->addRelation('LeasingTenants', 'Leasing\\CoreBundle\\Model\\LeasingTenants', RelationMap::ONE_TO_MANY, array('id' => 'unit_id', ), null, null, 'LeasingTenantss');
        $this->addRelation('LeasingUnitCalendar', 'Leasing\\CoreBundle\\Model\\LeasingUnitCalendar', RelationMap::ONE_TO_MANY, array('id' => 'unit_id', ), null, null, 'LeasingUnitCalendars');
        $this->addRelation('LeasingUnitFeatures', 'Leasing\\CoreBundle\\Model\\LeasingUnitFeatures', RelationMap::ONE_TO_MANY, array('id' => 'unit_id', ), null, null, 'LeasingUnitFeaturess');
    } // buildRelations()

} // LeasingUnitTableMap
