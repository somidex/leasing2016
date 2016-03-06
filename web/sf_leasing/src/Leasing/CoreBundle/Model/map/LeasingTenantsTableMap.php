<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tenants' table.
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
class LeasingTenantsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingTenantsTableMap';

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
        $this->setName('tenants');
        $this->setPhpName('LeasingTenants');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingTenants');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('account_type', 'AccountType', 'INTEGER', 'residential_account_type', 'id', false, 11, null);
        $this->addColumn('building', 'Building', 'VARCHAR', false, 255, null);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'unit', 'id', false, 11, null);
        $this->addColumn('ps_number', 'PsNumber', 'VARCHAR', false, 100, null);
        $this->addForeignKey('unit_owner_id', 'UnitOwnerId', 'INTEGER', 'unit_owner', 'id', false, 11, null);
        $this->addColumn('tenant_name', 'TenantName', 'VARCHAR', false, 255, null);
        $this->addColumn('contact', 'Contact', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('lease_start_date', 'LeaseStartDate', 'VARCHAR', false, 255, null);
        $this->addColumn('lease_end_date', 'LeaseEndDate', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addColumn('prev_status', 'PrevStatus', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingAccountType', 'Leasing\\CoreBundle\\Model\\LeasingAccountType', RelationMap::MANY_TO_ONE, array('account_type' => 'id', ), null, null);
        $this->addRelation('LeasingUnit', 'Leasing\\CoreBundle\\Model\\LeasingUnit', RelationMap::MANY_TO_ONE, array('unit_id' => 'id', ), null, null);
        $this->addRelation('LeasingUnitOwner', 'Leasing\\CoreBundle\\Model\\LeasingUnitOwner', RelationMap::MANY_TO_ONE, array('unit_owner_id' => 'id', ), null, null);
    } // buildRelations()

} // LeasingTenantsTableMap
