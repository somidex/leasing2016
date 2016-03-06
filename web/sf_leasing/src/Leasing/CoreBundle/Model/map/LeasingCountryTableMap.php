<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'country' table.
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
class LeasingCountryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingCountryTableMap';

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
        $this->setName('country');
        $this->setPhpName('LeasingCountry');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingCountry');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('country_name', 'CountryName', 'VARCHAR', false, 45, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingAppointmentLeads', 'Leasing\\CoreBundle\\Model\\LeasingAppointmentLeads', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), null, null, 'LeasingAppointmentLeadss');
        $this->addRelation('LeasingBookingLeads', 'Leasing\\CoreBundle\\Model\\LeasingBookingLeads', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), null, null, 'LeasingBookingLeadss');
        $this->addRelation('LeasingEventLeads', 'Leasing\\CoreBundle\\Model\\LeasingEventLeads', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), null, null, 'LeasingEventLeadss');
    } // buildRelations()

} // LeasingCountryTableMap
