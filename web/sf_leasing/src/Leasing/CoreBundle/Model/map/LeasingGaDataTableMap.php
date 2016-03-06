<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ga_data' table.
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
class LeasingGaDataTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingGaDataTableMap';

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
        $this->setName('ga_data');
        $this->setPhpName('LeasingGaData');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingGaData');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('lead_type_id', 'LeadTypeId', 'INTEGER', 'lead_type', 'id', false, 11, null);
        $this->addColumn('lead_id', 'LeadId', 'INTEGER', false, 11, null);
        $this->addColumn('source', 'Source', 'VARCHAR', false, 45, null);
        $this->addColumn('medium', 'Medium', 'VARCHAR', false, 45, null);
        $this->addColumn('campaign', 'Campaign', 'VARCHAR', false, 45, null);
        $this->addColumn('country', 'Country', 'VARCHAR', false, 45, null);
        $this->addColumn('device', 'Device', 'VARCHAR', false, 45, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingLeadType', 'Leasing\\CoreBundle\\Model\\LeasingLeadType', RelationMap::MANY_TO_ONE, array('lead_type_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingGaDataTableMap
