<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'unit_no_br' table.
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
class LeasingUnitNumberBedroomsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingUnitNumberBedroomsTableMap';

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
        $this->setName('unit_no_br');
        $this->setPhpName('LeasingUnitNumberBedrooms');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingUnitNumberBedrooms');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('bedrooms', 'Bedrooms', 'VARCHAR', false, 255, null);
        $this->addColumn('br_code', 'BrCode', 'VARCHAR', false, 20, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingUnit', 'Leasing\\CoreBundle\\Model\\LeasingUnit', RelationMap::ONE_TO_MANY, array('id' => 'br_id', ), null, null, 'LeasingUnits');
    } // buildRelations()

} // LeasingUnitNumberBedroomsTableMap
