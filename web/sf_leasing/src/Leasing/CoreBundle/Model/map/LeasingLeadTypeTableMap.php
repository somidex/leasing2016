<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'lead_type' table.
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
class LeasingLeadTypeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingLeadTypeTableMap';

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
        $this->setName('lead_type');
        $this->setPhpName('LeasingLeadType');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingLeadType');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingGaData', 'Leasing\\CoreBundle\\Model\\LeasingGaData', RelationMap::ONE_TO_MANY, array('id' => 'lead_type_id', ), null, null, 'LeasingGaDatas');
        $this->addRelation('LeasingLeadDocument', 'Leasing\\CoreBundle\\Model\\LeasingLeadDocument', RelationMap::ONE_TO_MANY, array('id' => 'lead_type_id', ), null, null, 'LeasingLeadDocuments');
        $this->addRelation('LeasingTimelineActivity', 'Leasing\\CoreBundle\\Model\\LeasingTimelineActivity', RelationMap::ONE_TO_MANY, array('id' => 'lead_type_id', ), null, null, 'LeasingTimelineActivities');
    } // buildRelations()

} // LeasingLeadTypeTableMap
