<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'logs' table.
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
class LeasingLogsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingLogsTableMap';

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
        $this->setName('logs');
        $this->setPhpName('LeasingLogs');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingLogs');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('user', 'User', 'VARCHAR', false, 255, null);
        $this->addColumn('action', 'Action', 'VARCHAR', false, 255, null);
        $this->addColumn('module', 'Module', 'VARCHAR', false, 255, null);
        $this->addColumn('content', 'Content', 'VARCHAR', false, 255, null);
        $this->addColumn('ip', 'Ip', 'VARCHAR', false, 100, null);
        $this->addColumn('datetime', 'Datetime', 'VARCHAR', false, 100, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // LeasingLogsTableMap
