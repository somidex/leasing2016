<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'leasing_specialist' table.
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
class LeasingSpecialistTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingSpecialistTableMap';

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
        $this->setName('leasing_specialist');
        $this->setPhpName('LeasingSpecialist');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingSpecialist');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, 45, null);
        $this->addColumn('leasing_unit', 'LeasingUnit', 'INTEGER', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingAppointmentAssignment', 'Leasing\\CoreBundle\\Model\\LeasingAppointmentAssignment', RelationMap::ONE_TO_MANY, array('id' => 'leasing_specialist_id', ), null, null, 'LeasingAppointmentAssignments');
        $this->addRelation('LeasingBookingAssignment', 'Leasing\\CoreBundle\\Model\\LeasingBookingAssignment', RelationMap::ONE_TO_MANY, array('id' => 'leasing_specialist_id', ), null, null, 'LeasingBookingAssignments');
        $this->addRelation('LeasingSpecialistSchedule', 'Leasing\\CoreBundle\\Model\\LeasingSpecialistSchedule', RelationMap::ONE_TO_MANY, array('id' => 'leasing_specialist_id', ), null, null, 'LeasingSpecialistSchedules');
    } // buildRelations()

} // LeasingSpecialistTableMap
