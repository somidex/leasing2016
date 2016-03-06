<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'unit_features' table.
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
class LeasingUnitFeaturesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingUnitFeaturesTableMap';

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
        $this->setName('unit_features');
        $this->setPhpName('LeasingUnitFeatures');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingUnitFeatures');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'unit', 'id', false, 11, null);
        $this->addForeignKey('features_id', 'FeaturesId', 'INTEGER', 'features', 'id', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingUnit', 'Leasing\\CoreBundle\\Model\\LeasingUnit', RelationMap::MANY_TO_ONE, array('unit_id' => 'id', ), null, null);
        $this->addRelation('LeasingFeatures', 'Leasing\\CoreBundle\\Model\\LeasingFeatures', RelationMap::MANY_TO_ONE, array('features_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingUnitFeaturesTableMap
