<?php

namespace Rdy4Racing\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.UserTableMap';

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
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('Rdy4Racing\\Models\\User');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('user_id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('user_email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('user_password', 'Password', 'VARCHAR', true, 124, null);
        $this->addColumn('user_firstname', 'FirstName', 'VARCHAR', false, 255, null);
        $this->addColumn('user_lastname', 'LastName', 'VARCHAR', false, 255, null);
        $this->addColumn('user_dateofbirth', 'DateOfBirth', 'DATE', false, null, null);
        $this->addColumn('user_rank', 'Rank', 'VARCHAR', true, 1, 'R');
        $this->addColumn('user_mmr', 'MMR', 'INTEGER', true, null, 1000);
        $this->addColumn('user_rating', 'Rating', 'INTEGER', true, null, 0);
        $this->addColumn('user_about', 'About', 'LONGVARCHAR', false, null, null);
        $this->addColumn('user_avatar', 'Avatar', 'VARCHAR', false, 255, null);
        $this->addColumn('user_created', 'Created', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('user_active', 'Active', 'SMALLINT', true, null, 0);
        $this->addForeignKey('user_godfather', 'GodfatherId', 'INTEGER', 'user', 'user_id', false, null, null);
        $this->addColumn('user_confirmation_string', 'ConfirmationString', 'VARCHAR', false, 255, null);
        // validators
        $this->addValidator('user_email', 'match', 'propel.validator.MatchValidator', '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/', 'Please enter a valid email address.');
        $this->addValidator('user_email', 'unique', 'propel.validator.UniqueValidator', '', 'Email already exists');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UserRelatedByGodfatherId', 'Rdy4Racing\\Models\\User', RelationMap::MANY_TO_ONE, array('user_godfather' => 'user_id', ), null, null);
        $this->addRelation('Driver', 'Rdy4Racing\\Models\\Driver', RelationMap::ONE_TO_MANY, array('user_id' => 'driver_user_id', ), null, null, 'Drivers');
        $this->addRelation('UserRelatedById', 'Rdy4Racing\\Models\\User', RelationMap::ONE_TO_MANY, array('user_id' => 'user_godfather', ), null, null, 'UsersRelatedById');
        $this->addRelation('UserGame', 'Rdy4Racing\\Models\\UserGame', RelationMap::ONE_TO_MANY, array('user_id' => 'usgm_user_id', ), null, null, 'UserGames');
    } // buildRelations()

} // UserTableMap
