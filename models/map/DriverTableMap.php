<?php

namespace Rdy4Racing\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'driver' table.
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
class DriverTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.DriverTableMap';

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
        $this->setName('driver');
        $this->setPhpName('Driver');
        $this->setClassname('Rdy4Racing\\Models\\Driver');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('driver_session_id', 'SessionId', 'INTEGER' , 'session', 'session_id', true, null, null);
        $this->addForeignPrimaryKey('driver_user_id', 'UserId', 'INTEGER' , 'user', 'user_id', true, null, null);
        $this->addColumn('driver_rank', 'Rank', 'VARCHAR', true, 1, null);
        $this->addColumn('driver_mmr_start', 'MMRStart', 'INTEGER', true, null, null);
        $this->addColumn('driver_rating_start', 'RatingStart', 'INTEGER', true, null, null);
        $this->addColumn('driver_mmr_end', 'MMREnd', 'INTEGER', false, null, null);
        $this->addColumn('driver_rating_end', 'RatingEnd', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Session', 'Rdy4Racing\\Models\\Session', RelationMap::MANY_TO_ONE, array('driver_session_id' => 'session_id', ), null, null);
        $this->addRelation('User', 'Rdy4Racing\\Models\\User', RelationMap::MANY_TO_ONE, array('driver_user_id' => 'user_id', ), null, null);
    } // buildRelations()

} // DriverTableMap
