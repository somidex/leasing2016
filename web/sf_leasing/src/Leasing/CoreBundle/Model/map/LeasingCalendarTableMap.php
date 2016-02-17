<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'calendar' table.
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
class LeasingCalendarTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingCalendarTableMap';

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
        $this->setName('calendar');
        $this->setPhpName('LeasingCalendar');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingCalendar');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('calendar_post_id', 'CalendarPostId', 'INTEGER', false, 11, null);
        $this->addColumn('availability', 'Availability', 'VARCHAR', false, 45, null);
        $this->addColumn('start_date', 'StartDate', 'VARCHAR', false, 45, null);
        $this->addColumn('end_date', 'EndDate', 'VARCHAR', false, 45, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingUnitCalendar', 'Leasing\\CoreBundle\\Model\\LeasingUnitCalendar', RelationMap::ONE_TO_MANY, array('id' => 'calendar_id', ), null, null, 'LeasingUnitCalendars');
    } // buildRelations()

} // LeasingCalendarTableMap
