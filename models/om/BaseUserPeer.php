<?php

namespace Rdy4Racing\Models\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserPeer;
use Rdy4Racing\Models\map\UserTableMap;

/**
 * Base static class for performing query and update operations on the 'user' table.
 *
 *
 *
 * @package propel.generator..om
 */
abstract class BaseUserPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'rdy4racing';

    /** the table name for this class */
    const TABLE_NAME = 'user';

    /** the related Propel class for this table */
    const OM_CLASS = 'Rdy4Racing\\Models\\User';

    /** the related TableMap class for this table */
    const TM_CLASS = 'UserTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 15;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 15;

    /** the column name for the user_id field */
    const USER_ID = 'user.user_id';

    /** the column name for the user_email field */
    const USER_EMAIL = 'user.user_email';

    /** the column name for the user_password field */
    const USER_PASSWORD = 'user.user_password';

    /** the column name for the user_firstname field */
    const USER_FIRSTNAME = 'user.user_firstname';

    /** the column name for the user_lastname field */
    const USER_LASTNAME = 'user.user_lastname';

    /** the column name for the user_dateofbirth field */
    const USER_DATEOFBIRTH = 'user.user_dateofbirth';

    /** the column name for the user_rank field */
    const USER_RANK = 'user.user_rank';

    /** the column name for the user_mmr field */
    const USER_MMR = 'user.user_mmr';

    /** the column name for the user_rating field */
    const USER_RATING = 'user.user_rating';

    /** the column name for the user_about field */
    const USER_ABOUT = 'user.user_about';

    /** the column name for the user_avatar field */
    const USER_AVATAR = 'user.user_avatar';

    /** the column name for the user_created field */
    const USER_CREATED = 'user.user_created';

    /** the column name for the user_active field */
    const USER_ACTIVE = 'user.user_active';

    /** the column name for the user_godfather field */
    const USER_GODFATHER = 'user.user_godfather';

    /** the column name for the user_confirmation_string field */
    const USER_CONFIRMATION_STRING = 'user.user_confirmation_string';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of User objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array User[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. UserPeer::$fieldNames[UserPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Email', 'Password', 'FirstName', 'LastName', 'DateOfBirth', 'Rank', 'MMR', 'Rating', 'About', 'Avatar', 'Created', 'Active', 'GodfatherId', 'ConfirmationString', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'email', 'password', 'firstName', 'lastName', 'dateOfBirth', 'rank', 'mMR', 'rating', 'about', 'avatar', 'created', 'active', 'godfatherId', 'confirmationString', ),
        BasePeer::TYPE_COLNAME => array (UserPeer::USER_ID, UserPeer::USER_EMAIL, UserPeer::USER_PASSWORD, UserPeer::USER_FIRSTNAME, UserPeer::USER_LASTNAME, UserPeer::USER_DATEOFBIRTH, UserPeer::USER_RANK, UserPeer::USER_MMR, UserPeer::USER_RATING, UserPeer::USER_ABOUT, UserPeer::USER_AVATAR, UserPeer::USER_CREATED, UserPeer::USER_ACTIVE, UserPeer::USER_GODFATHER, UserPeer::USER_CONFIRMATION_STRING, ),
        BasePeer::TYPE_RAW_COLNAME => array ('USER_ID', 'USER_EMAIL', 'USER_PASSWORD', 'USER_FIRSTNAME', 'USER_LASTNAME', 'USER_DATEOFBIRTH', 'USER_RANK', 'USER_MMR', 'USER_RATING', 'USER_ABOUT', 'USER_AVATAR', 'USER_CREATED', 'USER_ACTIVE', 'USER_GODFATHER', 'USER_CONFIRMATION_STRING', ),
        BasePeer::TYPE_FIELDNAME => array ('user_id', 'user_email', 'user_password', 'user_firstname', 'user_lastname', 'user_dateofbirth', 'user_rank', 'user_mmr', 'user_rating', 'user_about', 'user_avatar', 'user_created', 'user_active', 'user_godfather', 'user_confirmation_string', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. UserPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Email' => 1, 'Password' => 2, 'FirstName' => 3, 'LastName' => 4, 'DateOfBirth' => 5, 'Rank' => 6, 'MMR' => 7, 'Rating' => 8, 'About' => 9, 'Avatar' => 10, 'Created' => 11, 'Active' => 12, 'GodfatherId' => 13, 'ConfirmationString' => 14, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'email' => 1, 'password' => 2, 'firstName' => 3, 'lastName' => 4, 'dateOfBirth' => 5, 'rank' => 6, 'mMR' => 7, 'rating' => 8, 'about' => 9, 'avatar' => 10, 'created' => 11, 'active' => 12, 'godfatherId' => 13, 'confirmationString' => 14, ),
        BasePeer::TYPE_COLNAME => array (UserPeer::USER_ID => 0, UserPeer::USER_EMAIL => 1, UserPeer::USER_PASSWORD => 2, UserPeer::USER_FIRSTNAME => 3, UserPeer::USER_LASTNAME => 4, UserPeer::USER_DATEOFBIRTH => 5, UserPeer::USER_RANK => 6, UserPeer::USER_MMR => 7, UserPeer::USER_RATING => 8, UserPeer::USER_ABOUT => 9, UserPeer::USER_AVATAR => 10, UserPeer::USER_CREATED => 11, UserPeer::USER_ACTIVE => 12, UserPeer::USER_GODFATHER => 13, UserPeer::USER_CONFIRMATION_STRING => 14, ),
        BasePeer::TYPE_RAW_COLNAME => array ('USER_ID' => 0, 'USER_EMAIL' => 1, 'USER_PASSWORD' => 2, 'USER_FIRSTNAME' => 3, 'USER_LASTNAME' => 4, 'USER_DATEOFBIRTH' => 5, 'USER_RANK' => 6, 'USER_MMR' => 7, 'USER_RATING' => 8, 'USER_ABOUT' => 9, 'USER_AVATAR' => 10, 'USER_CREATED' => 11, 'USER_ACTIVE' => 12, 'USER_GODFATHER' => 13, 'USER_CONFIRMATION_STRING' => 14, ),
        BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'user_email' => 1, 'user_password' => 2, 'user_firstname' => 3, 'user_lastname' => 4, 'user_dateofbirth' => 5, 'user_rank' => 6, 'user_mmr' => 7, 'user_rating' => 8, 'user_about' => 9, 'user_avatar' => 10, 'user_created' => 11, 'user_active' => 12, 'user_godfather' => 13, 'user_confirmation_string' => 14, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = UserPeer::getFieldNames($toType);
        $key = isset(UserPeer::$fieldKeys[$fromType][$name]) ? UserPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(UserPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, UserPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return UserPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. UserPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(UserPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserPeer::USER_ID);
            $criteria->addSelectColumn(UserPeer::USER_EMAIL);
            $criteria->addSelectColumn(UserPeer::USER_PASSWORD);
            $criteria->addSelectColumn(UserPeer::USER_FIRSTNAME);
            $criteria->addSelectColumn(UserPeer::USER_LASTNAME);
            $criteria->addSelectColumn(UserPeer::USER_DATEOFBIRTH);
            $criteria->addSelectColumn(UserPeer::USER_RANK);
            $criteria->addSelectColumn(UserPeer::USER_MMR);
            $criteria->addSelectColumn(UserPeer::USER_RATING);
            $criteria->addSelectColumn(UserPeer::USER_ABOUT);
            $criteria->addSelectColumn(UserPeer::USER_AVATAR);
            $criteria->addSelectColumn(UserPeer::USER_CREATED);
            $criteria->addSelectColumn(UserPeer::USER_ACTIVE);
            $criteria->addSelectColumn(UserPeer::USER_GODFATHER);
            $criteria->addSelectColumn(UserPeer::USER_CONFIRMATION_STRING);
        } else {
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.user_email');
            $criteria->addSelectColumn($alias . '.user_password');
            $criteria->addSelectColumn($alias . '.user_firstname');
            $criteria->addSelectColumn($alias . '.user_lastname');
            $criteria->addSelectColumn($alias . '.user_dateofbirth');
            $criteria->addSelectColumn($alias . '.user_rank');
            $criteria->addSelectColumn($alias . '.user_mmr');
            $criteria->addSelectColumn($alias . '.user_rating');
            $criteria->addSelectColumn($alias . '.user_about');
            $criteria->addSelectColumn($alias . '.user_avatar');
            $criteria->addSelectColumn($alias . '.user_created');
            $criteria->addSelectColumn($alias . '.user_active');
            $criteria->addSelectColumn($alias . '.user_godfather');
            $criteria->addSelectColumn($alias . '.user_confirmation_string');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UserPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(UserPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return User
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = UserPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return UserPeer::populateObjects(UserPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            UserPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param User $obj A User object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            UserPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A User object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof User) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or User object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(UserPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return User Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(UserPeer::$instances[$key])) {
                return UserPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (UserPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        UserPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to user
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = UserPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = UserPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (User object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + UserPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            UserPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UserPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of User objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of User objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(UserPeer::DATABASE_NAME);
        }

        UserPeer::addSelectColumns($criteria);
        $startcol2 = UserPeer::NUM_HYDRATE_COLUMNS;

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = UserPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = UserPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = UserPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                UserPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(UserPeer::DATABASE_NAME)->getTable(UserPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseUserPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseUserPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new UserTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return UserPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param      mixed $values Criteria or User object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserPeer::USER_ID) && $criteria->keyContainsValue(UserPeer::USER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPeer::USER_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a User or Criteria object.
     *
     * @param      mixed $values Criteria or User object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(UserPeer::USER_ID);
            $value = $criteria->remove(UserPeer::USER_ID);
            if ($value) {
                $selectCriteria->add(UserPeer::USER_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(UserPeer::TABLE_NAME);
            }

        } else { // $values is User object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(UserPeer::TABLE_NAME, $con, UserPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserPeer::clearInstancePool();
            UserPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or User object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            UserPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof User) { // it's a model object
            // invalidate the cache for this single object
            UserPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserPeer::DATABASE_NAME);
            $criteria->add(UserPeer::USER_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                UserPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            UserPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given User object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param User $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(UserPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        if ($obj->isNew() || $obj->isColumnModified(UserPeer::USER_EMAIL))
            $columns[UserPeer::USER_EMAIL] = $obj->getEmail();

        }

        return BasePeer::doValidate(UserPeer::DATABASE_NAME, UserPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return User
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = UserPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::USER_ID, $pk);

        $v = UserPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return User[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(UserPeer::DATABASE_NAME);
            $criteria->add(UserPeer::USER_ID, $pks, Criteria::IN);
            $objs = UserPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseUserPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUserPeer::buildTableMap();

