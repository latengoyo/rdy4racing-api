<?php

namespace Rdy4Racing\Models\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserGame;
use Rdy4Racing\Models\UserGameQuery;
use Rdy4Racing\Models\UserPeer;
use Rdy4Racing\Models\UserQuery;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Rdy4Racing\\Models\\UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the user_email field.
     * @var        string
     */
    protected $user_email;

    /**
     * The value for the user_password field.
     * @var        string
     */
    protected $user_password;

    /**
     * The value for the user_firstname field.
     * @var        string
     */
    protected $user_firstname;

    /**
     * The value for the user_lastname field.
     * @var        string
     */
    protected $user_lastname;

    /**
     * The value for the user_dateofbirth field.
     * @var        string
     */
    protected $user_dateofbirth;

    /**
     * The value for the user_rank field.
     * Note: this column has a database default value of: 'R'
     * @var        string
     */
    protected $user_rank;

    /**
     * The value for the user_mmr field.
     * Note: this column has a database default value of: 1000
     * @var        int
     */
    protected $user_mmr;

    /**
     * The value for the user_rating field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $user_rating;

    /**
     * The value for the user_about field.
     * @var        string
     */
    protected $user_about;

    /**
     * The value for the user_avatar field.
     * @var        string
     */
    protected $user_avatar;

    /**
     * The value for the user_created field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $user_created;

    /**
     * The value for the user_active field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $user_active;

    /**
     * The value for the user_godfather field.
     * @var        int
     */
    protected $user_godfather;

    /**
     * The value for the user_confirmation_string field.
     * @var        string
     */
    protected $user_confirmation_string;

    /**
     * @var        User
     */
    protected $aUserRelatedByGodfatherId;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsersRelatedById;
    protected $collUsersRelatedByIdPartial;

    /**
     * @var        PropelObjectCollection|UserGame[] Collection to store aggregation of UserGame objects.
     */
    protected $collUserGames;
    protected $collUserGamesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersRelatedByIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $userGamesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->user_rank = 'R';
        $this->user_mmr = 1000;
        $this->user_rating = 0;
        $this->user_active = 0;
    }

    /**
     * Initializes internal state of BaseUser object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->user_id;
    }

    /**
     * Get the [user_email] column value.
     *
     * @return string
     */
    public function getEmail()
    {

        return $this->user_email;
    }

    /**
     * Get the [user_password] column value.
     *
     * @return string
     */
    public function getPassword()
    {

        return $this->user_password;
    }

    /**
     * Get the [user_firstname] column value.
     *
     * @return string
     */
    public function getFirstName()
    {

        return $this->user_firstname;
    }

    /**
     * Get the [user_lastname] column value.
     *
     * @return string
     */
    public function getLastName()
    {

        return $this->user_lastname;
    }

    /**
     * Get the [optionally formatted] temporal [user_dateofbirth] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateOfBirth($format = '%x')
    {
        if ($this->user_dateofbirth === null) {
            return null;
        }

        if ($this->user_dateofbirth === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->user_dateofbirth);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->user_dateofbirth, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [user_rank] column value.
     *
     * @return string
     */
    public function getRank()
    {

        return $this->user_rank;
    }

    /**
     * Get the [user_mmr] column value.
     *
     * @return int
     */
    public function getMMR()
    {

        return $this->user_mmr;
    }

    /**
     * Get the [user_rating] column value.
     *
     * @return int
     */
    public function getRating()
    {

        return $this->user_rating;
    }

    /**
     * Get the [user_about] column value.
     *
     * @return string
     */
    public function getAbout()
    {

        return $this->user_about;
    }

    /**
     * Get the [user_avatar] column value.
     *
     * @return string
     */
    public function getAvatar()
    {

        return $this->user_avatar;
    }

    /**
     * Get the [optionally formatted] temporal [user_created] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = 'Y-m-d H:i:s')
    {
        if ($this->user_created === null) {
            return null;
        }

        if ($this->user_created === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->user_created);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->user_created, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [user_active] column value.
     *
     * @return int
     */
    public function getActive()
    {

        return $this->user_active;
    }

    /**
     * Get the [user_godfather] column value.
     *
     * @return int
     */
    public function getGodfatherId()
    {

        return $this->user_godfather;
    }

    /**
     * Get the [user_confirmation_string] column value.
     *
     * @return string
     */
    public function getConfirmationString()
    {

        return $this->user_confirmation_string;
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[] = UserPeer::USER_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [user_email] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_email !== $v) {
            $this->user_email = $v;
            $this->modifiedColumns[] = UserPeer::USER_EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [user_password] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_password !== $v) {
            $this->user_password = $v;
            $this->modifiedColumns[] = UserPeer::USER_PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Set the value of [user_firstname] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_firstname !== $v) {
            $this->user_firstname = $v;
            $this->modifiedColumns[] = UserPeer::USER_FIRSTNAME;
        }


        return $this;
    } // setFirstName()

    /**
     * Set the value of [user_lastname] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_lastname !== $v) {
            $this->user_lastname = $v;
            $this->modifiedColumns[] = UserPeer::USER_LASTNAME;
        }


        return $this;
    } // setLastName()

    /**
     * Sets the value of [user_dateofbirth] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setDateOfBirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->user_dateofbirth !== null || $dt !== null) {
            $currentDateAsString = ($this->user_dateofbirth !== null && $tmpDt = new DateTime($this->user_dateofbirth)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->user_dateofbirth = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::USER_DATEOFBIRTH;
            }
        } // if either are not null


        return $this;
    } // setDateOfBirth()

    /**
     * Set the value of [user_rank] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setRank($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_rank !== $v) {
            $this->user_rank = $v;
            $this->modifiedColumns[] = UserPeer::USER_RANK;
        }


        return $this;
    } // setRank()

    /**
     * Set the value of [user_mmr] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setMMR($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->user_mmr !== $v) {
            $this->user_mmr = $v;
            $this->modifiedColumns[] = UserPeer::USER_MMR;
        }


        return $this;
    } // setMMR()

    /**
     * Set the value of [user_rating] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setRating($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->user_rating !== $v) {
            $this->user_rating = $v;
            $this->modifiedColumns[] = UserPeer::USER_RATING;
        }


        return $this;
    } // setRating()

    /**
     * Set the value of [user_about] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setAbout($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_about !== $v) {
            $this->user_about = $v;
            $this->modifiedColumns[] = UserPeer::USER_ABOUT;
        }


        return $this;
    } // setAbout()

    /**
     * Set the value of [user_avatar] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_avatar !== $v) {
            $this->user_avatar = $v;
            $this->modifiedColumns[] = UserPeer::USER_AVATAR;
        }


        return $this;
    } // setAvatar()

    /**
     * Sets the value of [user_created] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->user_created !== null || $dt !== null) {
            $currentDateAsString = ($this->user_created !== null && $tmpDt = new DateTime($this->user_created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->user_created = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::USER_CREATED;
            }
        } // if either are not null


        return $this;
    } // setCreated()

    /**
     * Set the value of [user_active] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->user_active !== $v) {
            $this->user_active = $v;
            $this->modifiedColumns[] = UserPeer::USER_ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Set the value of [user_godfather] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setGodfatherId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->user_godfather !== $v) {
            $this->user_godfather = $v;
            $this->modifiedColumns[] = UserPeer::USER_GODFATHER;
        }

        if ($this->aUserRelatedByGodfatherId !== null && $this->aUserRelatedByGodfatherId->getId() !== $v) {
            $this->aUserRelatedByGodfatherId = null;
        }


        return $this;
    } // setGodfatherId()

    /**
     * Set the value of [user_confirmation_string] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setConfirmationString($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_confirmation_string !== $v) {
            $this->user_confirmation_string = $v;
            $this->modifiedColumns[] = UserPeer::USER_CONFIRMATION_STRING;
        }


        return $this;
    } // setConfirmationString()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->user_rank !== 'R') {
                return false;
            }

            if ($this->user_mmr !== 1000) {
                return false;
            }

            if ($this->user_rating !== 0) {
                return false;
            }

            if ($this->user_active !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->user_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->user_email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->user_password = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->user_firstname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->user_lastname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->user_dateofbirth = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->user_rank = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->user_mmr = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->user_rating = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->user_about = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->user_avatar = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->user_created = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->user_active = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->user_godfather = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->user_confirmation_string = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 15; // 15 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aUserRelatedByGodfatherId !== null && $this->user_godfather !== $this->aUserRelatedByGodfatherId->getId()) {
            $this->aUserRelatedByGodfatherId = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByGodfatherId = null;
            $this->collUsersRelatedById = null;

            $this->collUserGames = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByGodfatherId !== null) {
                if ($this->aUserRelatedByGodfatherId->isModified() || $this->aUserRelatedByGodfatherId->isNew()) {
                    $affectedRows += $this->aUserRelatedByGodfatherId->save($con);
                }
                $this->setUserRelatedByGodfatherId($this->aUserRelatedByGodfatherId);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->usersRelatedByIdScheduledForDeletion !== null) {
                if (!$this->usersRelatedByIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersRelatedByIdScheduledForDeletion as $userRelatedById) {
                        // need to save related object because we set the relation to null
                        $userRelatedById->save($con);
                    }
                    $this->usersRelatedByIdScheduledForDeletion = null;
                }
            }

            if ($this->collUsersRelatedById !== null) {
                foreach ($this->collUsersRelatedById as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userGamesScheduledForDeletion !== null) {
                if (!$this->userGamesScheduledForDeletion->isEmpty()) {
                    UserGameQuery::create()
                        ->filterByPrimaryKeys($this->userGamesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userGamesScheduledForDeletion = null;
                }
            }

            if ($this->collUserGames !== null) {
                foreach ($this->collUserGames as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = UserPeer::USER_ID;
        if (null !== $this->user_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::USER_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`user_id`';
        }
        if ($this->isColumnModified(UserPeer::USER_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`user_email`';
        }
        if ($this->isColumnModified(UserPeer::USER_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`user_password`';
        }
        if ($this->isColumnModified(UserPeer::USER_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`user_firstname`';
        }
        if ($this->isColumnModified(UserPeer::USER_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`user_lastname`';
        }
        if ($this->isColumnModified(UserPeer::USER_DATEOFBIRTH)) {
            $modifiedColumns[':p' . $index++]  = '`user_dateofbirth`';
        }
        if ($this->isColumnModified(UserPeer::USER_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`user_rank`';
        }
        if ($this->isColumnModified(UserPeer::USER_MMR)) {
            $modifiedColumns[':p' . $index++]  = '`user_mmr`';
        }
        if ($this->isColumnModified(UserPeer::USER_RATING)) {
            $modifiedColumns[':p' . $index++]  = '`user_rating`';
        }
        if ($this->isColumnModified(UserPeer::USER_ABOUT)) {
            $modifiedColumns[':p' . $index++]  = '`user_about`';
        }
        if ($this->isColumnModified(UserPeer::USER_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = '`user_avatar`';
        }
        if ($this->isColumnModified(UserPeer::USER_CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`user_created`';
        }
        if ($this->isColumnModified(UserPeer::USER_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`user_active`';
        }
        if ($this->isColumnModified(UserPeer::USER_GODFATHER)) {
            $modifiedColumns[':p' . $index++]  = '`user_godfather`';
        }
        if ($this->isColumnModified(UserPeer::USER_CONFIRMATION_STRING)) {
            $modifiedColumns[':p' . $index++]  = '`user_confirmation_string`';
        }

        $sql = sprintf(
            'INSERT INTO `user` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`user_id`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case '`user_email`':
                        $stmt->bindValue($identifier, $this->user_email, PDO::PARAM_STR);
                        break;
                    case '`user_password`':
                        $stmt->bindValue($identifier, $this->user_password, PDO::PARAM_STR);
                        break;
                    case '`user_firstname`':
                        $stmt->bindValue($identifier, $this->user_firstname, PDO::PARAM_STR);
                        break;
                    case '`user_lastname`':
                        $stmt->bindValue($identifier, $this->user_lastname, PDO::PARAM_STR);
                        break;
                    case '`user_dateofbirth`':
                        $stmt->bindValue($identifier, $this->user_dateofbirth, PDO::PARAM_STR);
                        break;
                    case '`user_rank`':
                        $stmt->bindValue($identifier, $this->user_rank, PDO::PARAM_STR);
                        break;
                    case '`user_mmr`':
                        $stmt->bindValue($identifier, $this->user_mmr, PDO::PARAM_INT);
                        break;
                    case '`user_rating`':
                        $stmt->bindValue($identifier, $this->user_rating, PDO::PARAM_INT);
                        break;
                    case '`user_about`':
                        $stmt->bindValue($identifier, $this->user_about, PDO::PARAM_STR);
                        break;
                    case '`user_avatar`':
                        $stmt->bindValue($identifier, $this->user_avatar, PDO::PARAM_STR);
                        break;
                    case '`user_created`':
                        $stmt->bindValue($identifier, $this->user_created, PDO::PARAM_STR);
                        break;
                    case '`user_active`':
                        $stmt->bindValue($identifier, $this->user_active, PDO::PARAM_INT);
                        break;
                    case '`user_godfather`':
                        $stmt->bindValue($identifier, $this->user_godfather, PDO::PARAM_INT);
                        break;
                    case '`user_confirmation_string`':
                        $stmt->bindValue($identifier, $this->user_confirmation_string, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByGodfatherId !== null) {
                if (!$this->aUserRelatedByGodfatherId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByGodfatherId->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collUsersRelatedById !== null) {
                    foreach ($this->collUsersRelatedById as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUserGames !== null) {
                    foreach ($this->collUserGames as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getEmail();
                break;
            case 2:
                return $this->getPassword();
                break;
            case 3:
                return $this->getFirstName();
                break;
            case 4:
                return $this->getLastName();
                break;
            case 5:
                return $this->getDateOfBirth();
                break;
            case 6:
                return $this->getRank();
                break;
            case 7:
                return $this->getMMR();
                break;
            case 8:
                return $this->getRating();
                break;
            case 9:
                return $this->getAbout();
                break;
            case 10:
                return $this->getAvatar();
                break;
            case 11:
                return $this->getCreated();
                break;
            case 12:
                return $this->getActive();
                break;
            case 13:
                return $this->getGodfatherId();
                break;
            case 14:
                return $this->getConfirmationString();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getFirstName(),
            $keys[4] => $this->getLastName(),
            $keys[5] => $this->getDateOfBirth(),
            $keys[6] => $this->getRank(),
            $keys[7] => $this->getMMR(),
            $keys[8] => $this->getRating(),
            $keys[9] => $this->getAbout(),
            $keys[10] => $this->getAvatar(),
            $keys[11] => $this->getCreated(),
            $keys[12] => $this->getActive(),
            $keys[13] => $this->getGodfatherId(),
            $keys[14] => $this->getConfirmationString(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach($virtualColumns as $key => $virtualColumn)
        {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByGodfatherId) {
                $result['UserRelatedByGodfatherId'] = $this->aUserRelatedByGodfatherId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collUsersRelatedById) {
                $result['UsersRelatedById'] = $this->collUsersRelatedById->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserGames) {
                $result['UserGames'] = $this->collUserGames->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setEmail($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setFirstName($value);
                break;
            case 4:
                $this->setLastName($value);
                break;
            case 5:
                $this->setDateOfBirth($value);
                break;
            case 6:
                $this->setRank($value);
                break;
            case 7:
                $this->setMMR($value);
                break;
            case 8:
                $this->setRating($value);
                break;
            case 9:
                $this->setAbout($value);
                break;
            case 10:
                $this->setAvatar($value);
                break;
            case 11:
                $this->setCreated($value);
                break;
            case 12:
                $this->setActive($value);
                break;
            case 13:
                $this->setGodfatherId($value);
                break;
            case 14:
                $this->setConfirmationString($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setEmail($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPassword($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setFirstName($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLastName($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDateOfBirth($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setRank($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setMMR($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setRating($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setAbout($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setAvatar($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setCreated($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setActive($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setGodfatherId($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setConfirmationString($arr[$keys[14]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::USER_ID)) $criteria->add(UserPeer::USER_ID, $this->user_id);
        if ($this->isColumnModified(UserPeer::USER_EMAIL)) $criteria->add(UserPeer::USER_EMAIL, $this->user_email);
        if ($this->isColumnModified(UserPeer::USER_PASSWORD)) $criteria->add(UserPeer::USER_PASSWORD, $this->user_password);
        if ($this->isColumnModified(UserPeer::USER_FIRSTNAME)) $criteria->add(UserPeer::USER_FIRSTNAME, $this->user_firstname);
        if ($this->isColumnModified(UserPeer::USER_LASTNAME)) $criteria->add(UserPeer::USER_LASTNAME, $this->user_lastname);
        if ($this->isColumnModified(UserPeer::USER_DATEOFBIRTH)) $criteria->add(UserPeer::USER_DATEOFBIRTH, $this->user_dateofbirth);
        if ($this->isColumnModified(UserPeer::USER_RANK)) $criteria->add(UserPeer::USER_RANK, $this->user_rank);
        if ($this->isColumnModified(UserPeer::USER_MMR)) $criteria->add(UserPeer::USER_MMR, $this->user_mmr);
        if ($this->isColumnModified(UserPeer::USER_RATING)) $criteria->add(UserPeer::USER_RATING, $this->user_rating);
        if ($this->isColumnModified(UserPeer::USER_ABOUT)) $criteria->add(UserPeer::USER_ABOUT, $this->user_about);
        if ($this->isColumnModified(UserPeer::USER_AVATAR)) $criteria->add(UserPeer::USER_AVATAR, $this->user_avatar);
        if ($this->isColumnModified(UserPeer::USER_CREATED)) $criteria->add(UserPeer::USER_CREATED, $this->user_created);
        if ($this->isColumnModified(UserPeer::USER_ACTIVE)) $criteria->add(UserPeer::USER_ACTIVE, $this->user_active);
        if ($this->isColumnModified(UserPeer::USER_GODFATHER)) $criteria->add(UserPeer::USER_GODFATHER, $this->user_godfather);
        if ($this->isColumnModified(UserPeer::USER_CONFIRMATION_STRING)) $criteria->add(UserPeer::USER_CONFIRMATION_STRING, $this->user_confirmation_string);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::USER_ID, $this->user_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (user_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setDateOfBirth($this->getDateOfBirth());
        $copyObj->setRank($this->getRank());
        $copyObj->setMMR($this->getMMR());
        $copyObj->setRating($this->getRating());
        $copyObj->setAbout($this->getAbout());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setCreated($this->getCreated());
        $copyObj->setActive($this->getActive());
        $copyObj->setGodfatherId($this->getGodfatherId());
        $copyObj->setConfirmationString($this->getConfirmationString());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getUsersRelatedById() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserRelatedById($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserGames() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserGame($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return User Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param                  User $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByGodfatherId(User $v = null)
    {
        if ($v === null) {
            $this->setGodfatherId(NULL);
        } else {
            $this->setGodfatherId($v->getId());
        }

        $this->aUserRelatedByGodfatherId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addUserRelatedById($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByGodfatherId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByGodfatherId === null && ($this->user_godfather !== null) && $doQuery) {
            $this->aUserRelatedByGodfatherId = UserQuery::create()->findPk($this->user_godfather, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByGodfatherId->addUsersRelatedById($this);
             */
        }

        return $this->aUserRelatedByGodfatherId;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('UserRelatedById' == $relationName) {
            $this->initUsersRelatedById();
        }
        if ('UserGame' == $relationName) {
            $this->initUserGames();
        }
    }

    /**
     * Clears out the collUsersRelatedById collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsersRelatedById()
     */
    public function clearUsersRelatedById()
    {
        $this->collUsersRelatedById = null; // important to set this to null since that means it is uninitialized
        $this->collUsersRelatedByIdPartial = null;

        return $this;
    }

    /**
     * reset is the collUsersRelatedById collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsersRelatedById($v = true)
    {
        $this->collUsersRelatedByIdPartial = $v;
    }

    /**
     * Initializes the collUsersRelatedById collection.
     *
     * By default this just sets the collUsersRelatedById collection to an empty array (like clearcollUsersRelatedById());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsersRelatedById($overrideExisting = true)
    {
        if (null !== $this->collUsersRelatedById && !$overrideExisting) {
            return;
        }
        $this->collUsersRelatedById = new PropelObjectCollection();
        $this->collUsersRelatedById->setModel('User');
    }

    /**
     * Gets an array of User objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|User[] List of User objects
     * @throws PropelException
     */
    public function getUsersRelatedById($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedByIdPartial && !$this->isNew();
        if (null === $this->collUsersRelatedById || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById) {
                // return empty collection
                $this->initUsersRelatedById();
            } else {
                $collUsersRelatedById = UserQuery::create(null, $criteria)
                    ->filterByUserRelatedByGodfatherId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsersRelatedByIdPartial && count($collUsersRelatedById)) {
                      $this->initUsersRelatedById(false);

                      foreach ($collUsersRelatedById as $obj) {
                        if (false == $this->collUsersRelatedById->contains($obj)) {
                          $this->collUsersRelatedById->append($obj);
                        }
                      }

                      $this->collUsersRelatedByIdPartial = true;
                    }

                    $collUsersRelatedById->getInternalIterator()->rewind();

                    return $collUsersRelatedById;
                }

                if ($partial && $this->collUsersRelatedById) {
                    foreach ($this->collUsersRelatedById as $obj) {
                        if ($obj->isNew()) {
                            $collUsersRelatedById[] = $obj;
                        }
                    }
                }

                $this->collUsersRelatedById = $collUsersRelatedById;
                $this->collUsersRelatedByIdPartial = false;
            }
        }

        return $this->collUsersRelatedById;
    }

    /**
     * Sets a collection of UserRelatedById objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usersRelatedById A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsersRelatedById(PropelCollection $usersRelatedById, PropelPDO $con = null)
    {
        $usersRelatedByIdToDelete = $this->getUsersRelatedById(new Criteria(), $con)->diff($usersRelatedById);


        $this->usersRelatedByIdScheduledForDeletion = $usersRelatedByIdToDelete;

        foreach ($usersRelatedByIdToDelete as $userRelatedByIdRemoved) {
            $userRelatedByIdRemoved->setUserRelatedByGodfatherId(null);
        }

        $this->collUsersRelatedById = null;
        foreach ($usersRelatedById as $userRelatedById) {
            $this->addUserRelatedById($userRelatedById);
        }

        $this->collUsersRelatedById = $usersRelatedById;
        $this->collUsersRelatedByIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsersRelatedById(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedByIdPartial && !$this->isNew();
        if (null === $this->collUsersRelatedById || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsersRelatedById());
            }
            $query = UserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByGodfatherId($this)
                ->count($con);
        }

        return count($this->collUsersRelatedById);
    }

    /**
     * Method called to associate a User object to this object
     * through the User foreign key attribute.
     *
     * @param    User $l User
     * @return User The current object (for fluent API support)
     */
    public function addUserRelatedById(User $l)
    {
        if ($this->collUsersRelatedById === null) {
            $this->initUsersRelatedById();
            $this->collUsersRelatedByIdPartial = true;
        }
        if (!in_array($l, $this->collUsersRelatedById->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserRelatedById($l);
        }

        return $this;
    }

    /**
     * @param	UserRelatedById $userRelatedById The userRelatedById object to add.
     */
    protected function doAddUserRelatedById($userRelatedById)
    {
        $this->collUsersRelatedById[]= $userRelatedById;
        $userRelatedById->setUserRelatedByGodfatherId($this);
    }

    /**
     * @param	UserRelatedById $userRelatedById The userRelatedById object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserRelatedById($userRelatedById)
    {
        if ($this->getUsersRelatedById()->contains($userRelatedById)) {
            $this->collUsersRelatedById->remove($this->collUsersRelatedById->search($userRelatedById));
            if (null === $this->usersRelatedByIdScheduledForDeletion) {
                $this->usersRelatedByIdScheduledForDeletion = clone $this->collUsersRelatedById;
                $this->usersRelatedByIdScheduledForDeletion->clear();
            }
            $this->usersRelatedByIdScheduledForDeletion[]= $userRelatedById;
            $userRelatedById->setUserRelatedByGodfatherId(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserGames collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUserGames()
     */
    public function clearUserGames()
    {
        $this->collUserGames = null; // important to set this to null since that means it is uninitialized
        $this->collUserGamesPartial = null;

        return $this;
    }

    /**
     * reset is the collUserGames collection loaded partially
     *
     * @return void
     */
    public function resetPartialUserGames($v = true)
    {
        $this->collUserGamesPartial = $v;
    }

    /**
     * Initializes the collUserGames collection.
     *
     * By default this just sets the collUserGames collection to an empty array (like clearcollUserGames());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserGames($overrideExisting = true)
    {
        if (null !== $this->collUserGames && !$overrideExisting) {
            return;
        }
        $this->collUserGames = new PropelObjectCollection();
        $this->collUserGames->setModel('UserGame');
    }

    /**
     * Gets an array of UserGame objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UserGame[] List of UserGame objects
     * @throws PropelException
     */
    public function getUserGames($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUserGamesPartial && !$this->isNew();
        if (null === $this->collUserGames || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserGames) {
                // return empty collection
                $this->initUserGames();
            } else {
                $collUserGames = UserGameQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUserGamesPartial && count($collUserGames)) {
                      $this->initUserGames(false);

                      foreach ($collUserGames as $obj) {
                        if (false == $this->collUserGames->contains($obj)) {
                          $this->collUserGames->append($obj);
                        }
                      }

                      $this->collUserGamesPartial = true;
                    }

                    $collUserGames->getInternalIterator()->rewind();

                    return $collUserGames;
                }

                if ($partial && $this->collUserGames) {
                    foreach ($this->collUserGames as $obj) {
                        if ($obj->isNew()) {
                            $collUserGames[] = $obj;
                        }
                    }
                }

                $this->collUserGames = $collUserGames;
                $this->collUserGamesPartial = false;
            }
        }

        return $this->collUserGames;
    }

    /**
     * Sets a collection of UserGame objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $userGames A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUserGames(PropelCollection $userGames, PropelPDO $con = null)
    {
        $userGamesToDelete = $this->getUserGames(new Criteria(), $con)->diff($userGames);


        $this->userGamesScheduledForDeletion = $userGamesToDelete;

        foreach ($userGamesToDelete as $userGameRemoved) {
            $userGameRemoved->setUser(null);
        }

        $this->collUserGames = null;
        foreach ($userGames as $userGame) {
            $this->addUserGame($userGame);
        }

        $this->collUserGames = $userGames;
        $this->collUserGamesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserGame objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UserGame objects.
     * @throws PropelException
     */
    public function countUserGames(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUserGamesPartial && !$this->isNew();
        if (null === $this->collUserGames || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserGames) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserGames());
            }
            $query = UserGameQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserGames);
    }

    /**
     * Method called to associate a UserGame object to this object
     * through the UserGame foreign key attribute.
     *
     * @param    UserGame $l UserGame
     * @return User The current object (for fluent API support)
     */
    public function addUserGame(UserGame $l)
    {
        if ($this->collUserGames === null) {
            $this->initUserGames();
            $this->collUserGamesPartial = true;
        }
        if (!in_array($l, $this->collUserGames->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserGame($l);
        }

        return $this;
    }

    /**
     * @param	UserGame $userGame The userGame object to add.
     */
    protected function doAddUserGame($userGame)
    {
        $this->collUserGames[]= $userGame;
        $userGame->setUser($this);
    }

    /**
     * @param	UserGame $userGame The userGame object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserGame($userGame)
    {
        if ($this->getUserGames()->contains($userGame)) {
            $this->collUserGames->remove($this->collUserGames->search($userGame));
            if (null === $this->userGamesScheduledForDeletion) {
                $this->userGamesScheduledForDeletion = clone $this->collUserGames;
                $this->userGamesScheduledForDeletion->clear();
            }
            $this->userGamesScheduledForDeletion[]= clone $userGame;
            $userGame->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserGames from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UserGame[] List of UserGame objects
     */
    public function getUserGamesJoinGame($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UserGameQuery::create(null, $criteria);
        $query->joinWith('Game', $join_behavior);

        return $this->getUserGames($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->user_id = null;
        $this->user_email = null;
        $this->user_password = null;
        $this->user_firstname = null;
        $this->user_lastname = null;
        $this->user_dateofbirth = null;
        $this->user_rank = null;
        $this->user_mmr = null;
        $this->user_rating = null;
        $this->user_about = null;
        $this->user_avatar = null;
        $this->user_created = null;
        $this->user_active = null;
        $this->user_godfather = null;
        $this->user_confirmation_string = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collUsersRelatedById) {
                foreach ($this->collUsersRelatedById as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserGames) {
                foreach ($this->collUserGames as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aUserRelatedByGodfatherId instanceof Persistent) {
              $this->aUserRelatedByGodfatherId->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collUsersRelatedById instanceof PropelCollection) {
            $this->collUsersRelatedById->clearIterator();
        }
        $this->collUsersRelatedById = null;
        if ($this->collUserGames instanceof PropelCollection) {
            $this->collUserGames->clearIterator();
        }
        $this->collUserGames = null;
        $this->aUserRelatedByGodfatherId = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
