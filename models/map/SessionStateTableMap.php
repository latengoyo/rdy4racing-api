<?php

namespace Rdy4Racing\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'session_state' table.
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
class SessionStateTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.SessionStateTableMap';

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
        $this->setName('session_state');
        $this->setPhpName('SessionState');
        $this->setClassname('Rdy4Racing\\Models\\SessionState');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('sstate_id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('sstate_constant', 'Constant', 'VARCHAR', true, 24, null);
        $this->addColumn('sstate_name', 'Name', 'VARCHAR', true, 24, null);
        $this->addColumn('sstate_description', 'Description', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Session', 'Rdy4Racing\\Models\\Session', RelationMap::ONE_TO_MANY, array('sstate_id' => 'session_sstate_id', ), null, null, 'Sessions');
    } // buildRelations()

} // SessionStateTableMap
