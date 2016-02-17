<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'timeline_activity' table.
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
class LeasingTimelineActivityTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingTimelineActivityTableMap';

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
        $this->setName('timeline_activity');
        $this->setPhpName('LeasingTimelineActivity');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingTimelineActivity');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('lead_type_id', 'LeadTypeId', 'INTEGER', 'lead_type', 'id', false, 11, null);
        $this->addColumn('lead_id', 'LeadId', 'INTEGER', false, 11, null);
        $this->addColumn('user', 'User', 'VARCHAR', false, 45, null);
        $this->addColumn('activity', 'Activity', 'VARCHAR', false, 45, null);
        $this->addColumn('timestamp', 'Timestamp', 'VARCHAR', false, 45, null);
        $this->addColumn('notes', 'Notes', 'VARCHAR', false, 45, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 45, null);
        $this->addForeignKey('status_id', 'StatusId', 'INTEGER', 'status', 'id', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingLeadType', 'Leasing\\CoreBundle\\Model\\LeasingLeadType', RelationMap::MANY_TO_ONE, array('lead_type_id' => 'id', ), null, null);
        $this->addRelation('LeasingStatus', 'Leasing\\CoreBundle\\Model\\LeasingStatus', RelationMap::MANY_TO_ONE, array('status_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingTimelineActivityTableMap
