<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'event_inquiries' table.
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
class LeasingEventInquiriesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingEventInquiriesTableMap';

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
        $this->setName('event_inquiries');
        $this->setPhpName('LeasingEventInquiries');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingEventInquiries');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('event_place_id', 'EventPlaceId', 'INTEGER', 'event_place', 'id', false, 11, null);
        $this->addForeignKey('event_leads_id', 'EventLeadsId', 'INTEGER', 'event_leads', 'id', false, 11, null);
        $this->addColumn('message', 'Message', 'VARCHAR', false, 100, null);
        $this->addColumn('date_added', 'DateAdded', 'VARCHAR', false, 100, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addColumn('prev_status', 'PrevStatus', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingEventPlace', 'Leasing\\CoreBundle\\Model\\LeasingEventPlace', RelationMap::MANY_TO_ONE, array('event_place_id' => 'id', ), null, null);
        $this->addRelation('LeasingEventLeads', 'Leasing\\CoreBundle\\Model\\LeasingEventLeads', RelationMap::MANY_TO_ONE, array('event_leads_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingEventInquiriesTableMap
