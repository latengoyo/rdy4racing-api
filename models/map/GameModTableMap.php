<?php

namespace Rdy4Racing\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'gamemod' table.
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
class GameModTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.GameModTableMap';

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
        $this->setName('gamemod');
        $this->setPhpName('GameMod');
        $this->setClassname('Rdy4Racing\\Models\\GameMod');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('gmod_id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('gmod_game_id', 'GameId', 'INTEGER', 'game', 'game_id', true, null, null);
        $this->addColumn('gmod_code', 'Code', 'VARCHAR', true, 16, null);
        $this->addColumn('gmod_name', 'Name', 'VARCHAR', true, 32, null);
        $this->addColumn('gmod_description', 'Description', 'VARCHAR', true, 2048, null);
        $this->addColumn('gmod_image_low', 'ImageLowRes', 'VARCHAR', true, 255, null);
        $this->addColumn('gmod_image_high', 'ImageHiRes', 'VARCHAR', true, 255, null);
        $this->addColumn('gmod_image_gl', 'ImageGameLauncher', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Game', 'Rdy4Racing\\Models\\Game', RelationMap::MANY_TO_ONE, array('gmod_game_id' => 'game_id', ), null, null);
    } // buildRelations()

} // GameModTableMap
