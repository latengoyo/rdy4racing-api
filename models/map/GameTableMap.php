<?php

namespace \Rdy4Racing-API\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'game' table.
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
class GameTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.GameTableMap';

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
        $this->setName('game');
        $this->setPhpName('Game');
        $this->setClassname('\\Rdy4Racing-API\\Models\\Game');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('game_id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('game_code', 'Code', 'VARCHAR', true, 8, null);
        $this->addColumn('game_name', 'Name', 'VARCHAR', true, 32, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('GameMod', '\\Rdy4Racing-API\\Models\\GameMod', RelationMap::ONE_TO_MANY, array('game_id' => 'gmod_game_id', ), null, null, 'GameMods');
        $this->addRelation('UserGame', '\\Rdy4Racing-API\\Models\\UserGame', RelationMap::ONE_TO_MANY, array('game_id' => 'usgm_game_id', ), null, null, 'UserGames');
    } // buildRelations()

} // GameTableMap
