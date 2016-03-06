<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'unit_calendar' table.
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
class LeasingUnitCalendarTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingUnitCalendarTableMap';

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
        $this->setName('unit_calendar');
        $this->setPhpName('LeasingUnitCalendar');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingUnitCalendar');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('calendar_id', 'CalendarId', 'INTEGER', 'calendar', 'id', false, 11, null);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'unit', 'id', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingCalendar', 'Leasing\\CoreBundle\\Model\\LeasingCalendar', RelationMap::MANY_TO_ONE, array('calendar_id' => 'id', ), null, null);
        $this->addRelation('LeasingUnit', 'Leasing\\CoreBundle\\Model\\LeasingUnit', RelationMap::MANY_TO_ONE, array('unit_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingUnitCalendarTableMap
