<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'appointment_assignment' table.
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
class LeasingAppointmentAssignmentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingAppointmentAssignmentTableMap';

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
        $this->setName('appointment_assignment');
        $this->setPhpName('LeasingAppointmentAssignment');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingAppointmentAssignment');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('leasing_specialist_id', 'LeasingSpecialistId', 'INTEGER', 'leasing_specialist', 'id', false, 11, null);
        $this->addForeignKey('appointments_id', 'AppointmentsId', 'INTEGER', 'appointments', 'id', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingSpecialist', 'Leasing\\CoreBundle\\Model\\LeasingSpecialist', RelationMap::MANY_TO_ONE, array('leasing_specialist_id' => 'id', ), null, null);
        $this->addRelation('LeasingAppointments', 'Leasing\\CoreBundle\\Model\\LeasingAppointments', RelationMap::MANY_TO_ONE, array('appointments_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingAppointmentAssignmentTableMap
