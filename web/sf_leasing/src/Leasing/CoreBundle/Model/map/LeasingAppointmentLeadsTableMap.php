<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'appointment_leads' table.
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
class LeasingAppointmentLeadsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingAppointmentLeadsTableMap';

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
        $this->setName('appointment_leads');
        $this->setPhpName('LeasingAppointmentLeads');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingAppointmentLeads');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('fname', 'Fname', 'VARCHAR', false, 255, null);
        $this->addColumn('lname', 'Lname', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, 45, null);
        $this->addForeignKey('country_id', 'CountryId', 'INTEGER', 'country', 'id', false, 11, null);
        $this->addForeignKey('nationality_id', 'NationalityId', 'INTEGER', 'nationality', 'id', false, 11, null);
        $this->addColumn('client_ip', 'ClientIp', 'VARCHAR', false, 100, null);
        $this->addColumn('client_id', 'ClientId', 'VARCHAR', false, 100, null);
        $this->addColumn('campaign', 'Campaign', 'VARCHAR', false, 100, null);
        $this->addColumn('medium', 'Medium', 'VARCHAR', false, 100, null);
        $this->addColumn('source', 'Source', 'VARCHAR', false, 100, null);
        $this->addColumn('gacountry', 'Gacountry', 'VARCHAR', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingCountry', 'Leasing\\CoreBundle\\Model\\LeasingCountry', RelationMap::MANY_TO_ONE, array('country_id' => 'id', ), null, null);
        $this->addRelation('LeasingNationality', 'Leasing\\CoreBundle\\Model\\LeasingNationality', RelationMap::MANY_TO_ONE, array('nationality_id' => 'id', ), null, null);
        $this->addRelation('LeasingAppointments', 'Leasing\\CoreBundle\\Model\\LeasingAppointments', RelationMap::ONE_TO_MANY, array('id' => 'appointment_leads_id', ), null, null, 'LeasingAppointmentss');
    } // buildRelations()

} // LeasingAppointmentLeadsTableMap
