<?php

namespace Leasing\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'badges' table.
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
class LeasingBadgesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Leasing.CoreBundle.Model.map.LeasingBadgesTableMap';

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
        $this->setName('badges');
        $this->setPhpName('LeasingBadges');
        $this->setClassname('Leasing\\CoreBundle\\Model\\LeasingBadges');
        $this->setPackage('src.Leasing.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 255, null);
        $this->addColumn('status_id', 'StatusId', 'INTEGER', false, 11, null);
        $this->addColumn('badge_class', 'BadgeClass', 'VARCHAR', false, 255, null);
        $this->addColumn('badge_text', 'BadgeText', 'VARCHAR', false, 45, null);
        $this->addColumn('background_color', 'BackgroundColor', 'VARCHAR', false, 45, null);
        $this->addColumn('text_color', 'TextColor', 'VARCHAR', false, 45, null);
        $this->addColumn('badge_icon', 'BadgeIcon', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LeasingLeadBadges', 'Leasing\\CoreBundle\\Model\\LeasingLeadBadges', RelationMap::ONE_TO_MANY, array('id' => 'badge_id', ), null, null, 'LeasingLeadBadgess');
    } // buildRelations()

} // LeasingBadgesTableMap
