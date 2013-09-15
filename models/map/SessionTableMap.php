<?php

namespace Rdy4Racing\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'session' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class SessionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.SessionTableMap';

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
        $this->setName('session');
        $this->setPhpName('Session');
        $this->setClassname('Rdy4Racing\\Models\\Session');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('session_id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('session_game_id', 'GameId', 'INTEGER', 'game', 'game_id', true, null, null);
        $this->addForeignKey('session_stype_id', 'TypeId', 'INTEGER', 'session_type', 'stype_id', true, null, null);
        $this->addForeignKey('session_sstate_id', 'StateId', 'INTEGER', 'session_state', 'sstate_id', true, null, null);
        $this->addColumn('session_description', 'Description', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Game', 'Rdy4Racing\\Models\\Game', RelationMap::MANY_TO_ONE, array('session_game_id' => 'game_id', ), null, null);
        $this->addRelation('SessionState', 'Rdy4Racing\\Models\\SessionState', RelationMap::MANY_TO_ONE, array('session_sstate_id' => 'sstate_id', ), null, null);
        $this->addRelation('SessionType', 'Rdy4Racing\\Models\\SessionType', RelationMap::MANY_TO_ONE, array('session_stype_id' => 'stype_id', ), null, null);
        $this->addRelation('Driver', 'Rdy4Racing\\Models\\Driver', RelationMap::ONE_TO_MANY, array('session_id' => 'driver_session_id', ), null, null, 'Drivers');
    } // buildRelations()

} // SessionTableMap
