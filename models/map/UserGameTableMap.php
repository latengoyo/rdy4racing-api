<?php

namespace Rdy4Racing\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user_game' table.
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
class UserGameTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.UserGameTableMap';

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
        $this->setName('user_game');
        $this->setPhpName('UserGame');
        $this->setClassname('Rdy4Racing\\Models\\UserGame');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('usgm_id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('usgm_user_id', 'UserId', 'INTEGER', 'user', 'user_id', true, null, null);
        $this->addForeignKey('usgm_game_id', 'GameId', 'INTEGER', 'game', 'game_id', true, null, null);
        $this->addColumn('usgm_drivername', 'DriverName', 'VARCHAR', true, 32, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'Rdy4Racing\\Models\\User', RelationMap::MANY_TO_ONE, array('usgm_user_id' => 'user_id', ), null, null);
        $this->addRelation('Game', 'Rdy4Racing\\Models\\Game', RelationMap::MANY_TO_ONE, array('usgm_game_id' => 'game_id', ), null, null);
        $this->addRelation('Driver', 'Rdy4Racing\\Models\\Driver', RelationMap::ONE_TO_MANY, array('usgm_id' => 'driver_usergame_id', ), null, null, 'Drivers');
    } // buildRelations()

} // UserGameTableMap
