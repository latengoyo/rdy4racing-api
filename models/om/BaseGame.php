<?php

namespace Rdy4Racing\Models\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Rdy4Racing\Models\Game;
use Rdy4Racing\Models\GameMod;
use Rdy4Racing\Models\GameModQuery;
use Rdy4Racing\Models\GamePeer;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionQuery;
use Rdy4Racing\Models\UserGame;
use Rdy4Racing\Models\UserGameQuery;

/**
 * Base class that represents a row from the 'game' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseGame extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Rdy4Racing\\Models\\GamePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        GamePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the game_id field.
     * @var        int
     */
    protected $game_id;

    /**
     * The value for the game_code field.
     * @var        string
     */
    protected $game_code;

    /**
     * The value for the game_name field.
     * @var        string
     */
    protected $game_name;

    /**
     * @var        PropelObjectCollection|GameMod[] Collection to store aggregation of GameMod objects.
     */
    protected $collGameMods;
    protected $collGameModsPartial;

    /**
     * @var        PropelObjectCollection|Session[] Collection to store aggregation of Session objects.
     */
    protected $collSessions;
    protected $collSessionsPartial;

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
    protected $gameModsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $sessionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $userGamesScheduledForDeletion = null;

    /**
     * Get the [game_id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->game_id;
    }

    /**
     * Get the [game_code] column value.
     *
     * @return string
     */
    public function getCode()
    {

        return $this->game_code;
    }

    /**
     * Get the [game_name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->game_name;
    }

    /**
     * Set the value of [game_id] column.
     *
     * @param  int $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->game_id !== $v) {
            $this->game_id = $v;
            $this->modifiedColumns[] = GamePeer::GAME_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [game_code] column.
     *
     * @param  string $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->game_code !== $v) {
            $this->game_code = $v;
            $this->modifiedColumns[] = GamePeer::GAME_CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [game_name] column.
     *
     * @param  string $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->game_name !== $v) {
            $this->game_name = $v;
            $this->modifiedColumns[] = GamePeer::GAME_NAME;
        }


        return $this;
    } // setName()

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

            $this->game_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->game_code = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->game_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 3; // 3 = GamePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Game object", $e);
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
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = GamePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGameMods = null;

            $this->collSessions = null;

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
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = GameQuery::create()
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
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                GamePeer::addInstanceToPool($this);
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

            if ($this->gameModsScheduledForDeletion !== null) {
                if (!$this->gameModsScheduledForDeletion->isEmpty()) {
                    GameModQuery::create()
                        ->filterByPrimaryKeys($this->gameModsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gameModsScheduledForDeletion = null;
                }
            }

            if ($this->collGameMods !== null) {
                foreach ($this->collGameMods as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sessionsScheduledForDeletion !== null) {
                if (!$this->sessionsScheduledForDeletion->isEmpty()) {
                    SessionQuery::create()
                        ->filterByPrimaryKeys($this->sessionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sessionsScheduledForDeletion = null;
                }
            }

            if ($this->collSessions !== null) {
                foreach ($this->collSessions as $referrerFK) {
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

        $this->modifiedColumns[] = GamePeer::GAME_ID;
        if (null !== $this->game_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GamePeer::GAME_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GamePeer::GAME_ID)) {
            $modifiedColumns[':p' . $index++]  = '`game_id`';
        }
        if ($this->isColumnModified(GamePeer::GAME_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`game_code`';
        }
        if ($this->isColumnModified(GamePeer::GAME_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`game_name`';
        }

        $sql = sprintf(
            'INSERT INTO `game` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`game_id`':
                        $stmt->bindValue($identifier, $this->game_id, PDO::PARAM_INT);
                        break;
                    case '`game_code`':
                        $stmt->bindValue($identifier, $this->game_code, PDO::PARAM_STR);
                        break;
                    case '`game_name`':
                        $stmt->bindValue($identifier, $this->game_name, PDO::PARAM_STR);
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


            if (($retval = GamePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGameMods !== null) {
                    foreach ($this->collGameMods as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSessions !== null) {
                    foreach ($this->collSessions as $referrerFK) {
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
        $pos = GamePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCode();
                break;
            case 2:
                return $this->getName();
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
        if (isset($alreadyDumpedObjects['Game'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Game'][$this->getPrimaryKey()] = true;
        $keys = GamePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getName(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach($virtualColumns as $key => $virtualColumn)
        {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collGameMods) {
                $result['GameMods'] = $this->collGameMods->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSessions) {
                $result['Sessions'] = $this->collSessions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = GamePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCode($value);
                break;
            case 2:
                $this->setName($value);
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
        $keys = GamePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GamePeer::DATABASE_NAME);

        if ($this->isColumnModified(GamePeer::GAME_ID)) $criteria->add(GamePeer::GAME_ID, $this->game_id);
        if ($this->isColumnModified(GamePeer::GAME_CODE)) $criteria->add(GamePeer::GAME_CODE, $this->game_code);
        if ($this->isColumnModified(GamePeer::GAME_NAME)) $criteria->add(GamePeer::GAME_NAME, $this->game_name);

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
        $criteria = new Criteria(GamePeer::DATABASE_NAME);
        $criteria->add(GamePeer::GAME_ID, $this->game_id);

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
     * Generic method to set the primary key (game_id column).
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
     * @param object $copyObj An object of Game (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setName($this->getName());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getGameMods() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGameMod($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSessions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSession($relObj->copy($deepCopy));
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
     * @return Game Clone of current object.
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
     * @return GamePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new GamePeer();
        }

        return self::$peer;
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
        if ('GameMod' == $relationName) {
            $this->initGameMods();
        }
        if ('Session' == $relationName) {
            $this->initSessions();
        }
        if ('UserGame' == $relationName) {
            $this->initUserGames();
        }
    }

    /**
     * Clears out the collGameMods collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Game The current object (for fluent API support)
     * @see        addGameMods()
     */
    public function clearGameMods()
    {
        $this->collGameMods = null; // important to set this to null since that means it is uninitialized
        $this->collGameModsPartial = null;

        return $this;
    }

    /**
     * reset is the collGameMods collection loaded partially
     *
     * @return void
     */
    public function resetPartialGameMods($v = true)
    {
        $this->collGameModsPartial = $v;
    }

    /**
     * Initializes the collGameMods collection.
     *
     * By default this just sets the collGameMods collection to an empty array (like clearcollGameMods());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGameMods($overrideExisting = true)
    {
        if (null !== $this->collGameMods && !$overrideExisting) {
            return;
        }
        $this->collGameMods = new PropelObjectCollection();
        $this->collGameMods->setModel('GameMod');
    }

    /**
     * Gets an array of GameMod objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Game is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|GameMod[] List of GameMod objects
     * @throws PropelException
     */
    public function getGameMods($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGameModsPartial && !$this->isNew();
        if (null === $this->collGameMods || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGameMods) {
                // return empty collection
                $this->initGameMods();
            } else {
                $collGameMods = GameModQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGameModsPartial && count($collGameMods)) {
                      $this->initGameMods(false);

                      foreach ($collGameMods as $obj) {
                        if (false == $this->collGameMods->contains($obj)) {
                          $this->collGameMods->append($obj);
                        }
                      }

                      $this->collGameModsPartial = true;
                    }

                    $collGameMods->getInternalIterator()->rewind();

                    return $collGameMods;
                }

                if ($partial && $this->collGameMods) {
                    foreach ($this->collGameMods as $obj) {
                        if ($obj->isNew()) {
                            $collGameMods[] = $obj;
                        }
                    }
                }

                $this->collGameMods = $collGameMods;
                $this->collGameModsPartial = false;
            }
        }

        return $this->collGameMods;
    }

    /**
     * Sets a collection of GameMod objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $gameMods A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Game The current object (for fluent API support)
     */
    public function setGameMods(PropelCollection $gameMods, PropelPDO $con = null)
    {
        $gameModsToDelete = $this->getGameMods(new Criteria(), $con)->diff($gameMods);


        $this->gameModsScheduledForDeletion = $gameModsToDelete;

        foreach ($gameModsToDelete as $gameModRemoved) {
            $gameModRemoved->setGame(null);
        }

        $this->collGameMods = null;
        foreach ($gameMods as $gameMod) {
            $this->addGameMod($gameMod);
        }

        $this->collGameMods = $gameMods;
        $this->collGameModsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GameMod objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related GameMod objects.
     * @throws PropelException
     */
    public function countGameMods(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGameModsPartial && !$this->isNew();
        if (null === $this->collGameMods || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGameMods) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGameMods());
            }
            $query = GameModQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collGameMods);
    }

    /**
     * Method called to associate a GameMod object to this object
     * through the GameMod foreign key attribute.
     *
     * @param    GameMod $l GameMod
     * @return Game The current object (for fluent API support)
     */
    public function addGameMod(GameMod $l)
    {
        if ($this->collGameMods === null) {
            $this->initGameMods();
            $this->collGameModsPartial = true;
        }
        if (!in_array($l, $this->collGameMods->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGameMod($l);
        }

        return $this;
    }

    /**
     * @param	GameMod $gameMod The gameMod object to add.
     */
    protected function doAddGameMod($gameMod)
    {
        $this->collGameMods[]= $gameMod;
        $gameMod->setGame($this);
    }

    /**
     * @param	GameMod $gameMod The gameMod object to remove.
     * @return Game The current object (for fluent API support)
     */
    public function removeGameMod($gameMod)
    {
        if ($this->getGameMods()->contains($gameMod)) {
            $this->collGameMods->remove($this->collGameMods->search($gameMod));
            if (null === $this->gameModsScheduledForDeletion) {
                $this->gameModsScheduledForDeletion = clone $this->collGameMods;
                $this->gameModsScheduledForDeletion->clear();
            }
            $this->gameModsScheduledForDeletion[]= clone $gameMod;
            $gameMod->setGame(null);
        }

        return $this;
    }

    /**
     * Clears out the collSessions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Game The current object (for fluent API support)
     * @see        addSessions()
     */
    public function clearSessions()
    {
        $this->collSessions = null; // important to set this to null since that means it is uninitialized
        $this->collSessionsPartial = null;

        return $this;
    }

    /**
     * reset is the collSessions collection loaded partially
     *
     * @return void
     */
    public function resetPartialSessions($v = true)
    {
        $this->collSessionsPartial = $v;
    }

    /**
     * Initializes the collSessions collection.
     *
     * By default this just sets the collSessions collection to an empty array (like clearcollSessions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSessions($overrideExisting = true)
    {
        if (null !== $this->collSessions && !$overrideExisting) {
            return;
        }
        $this->collSessions = new PropelObjectCollection();
        $this->collSessions->setModel('Session');
    }

    /**
     * Gets an array of Session objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Game is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Session[] List of Session objects
     * @throws PropelException
     */
    public function getSessions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSessionsPartial && !$this->isNew();
        if (null === $this->collSessions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSessions) {
                // return empty collection
                $this->initSessions();
            } else {
                $collSessions = SessionQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSessionsPartial && count($collSessions)) {
                      $this->initSessions(false);

                      foreach ($collSessions as $obj) {
                        if (false == $this->collSessions->contains($obj)) {
                          $this->collSessions->append($obj);
                        }
                      }

                      $this->collSessionsPartial = true;
                    }

                    $collSessions->getInternalIterator()->rewind();

                    return $collSessions;
                }

                if ($partial && $this->collSessions) {
                    foreach ($this->collSessions as $obj) {
                        if ($obj->isNew()) {
                            $collSessions[] = $obj;
                        }
                    }
                }

                $this->collSessions = $collSessions;
                $this->collSessionsPartial = false;
            }
        }

        return $this->collSessions;
    }

    /**
     * Sets a collection of Session objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $sessions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Game The current object (for fluent API support)
     */
    public function setSessions(PropelCollection $sessions, PropelPDO $con = null)
    {
        $sessionsToDelete = $this->getSessions(new Criteria(), $con)->diff($sessions);


        $this->sessionsScheduledForDeletion = $sessionsToDelete;

        foreach ($sessionsToDelete as $sessionRemoved) {
            $sessionRemoved->setGame(null);
        }

        $this->collSessions = null;
        foreach ($sessions as $session) {
            $this->addSession($session);
        }

        $this->collSessions = $sessions;
        $this->collSessionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Session objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Session objects.
     * @throws PropelException
     */
    public function countSessions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSessionsPartial && !$this->isNew();
        if (null === $this->collSessions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSessions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSessions());
            }
            $query = SessionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collSessions);
    }

    /**
     * Method called to associate a Session object to this object
     * through the Session foreign key attribute.
     *
     * @param    Session $l Session
     * @return Game The current object (for fluent API support)
     */
    public function addSession(Session $l)
    {
        if ($this->collSessions === null) {
            $this->initSessions();
            $this->collSessionsPartial = true;
        }
        if (!in_array($l, $this->collSessions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSession($l);
        }

        return $this;
    }

    /**
     * @param	Session $session The session object to add.
     */
    protected function doAddSession($session)
    {
        $this->collSessions[]= $session;
        $session->setGame($this);
    }

    /**
     * @param	Session $session The session object to remove.
     * @return Game The current object (for fluent API support)
     */
    public function removeSession($session)
    {
        if ($this->getSessions()->contains($session)) {
            $this->collSessions->remove($this->collSessions->search($session));
            if (null === $this->sessionsScheduledForDeletion) {
                $this->sessionsScheduledForDeletion = clone $this->collSessions;
                $this->sessionsScheduledForDeletion->clear();
            }
            $this->sessionsScheduledForDeletion[]= clone $session;
            $session->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related Sessions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Session[] List of Session objects
     */
    public function getSessionsJoinSessionState($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SessionQuery::create(null, $criteria);
        $query->joinWith('SessionState', $join_behavior);

        return $this->getSessions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related Sessions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Session[] List of Session objects
     */
    public function getSessionsJoinSessionType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SessionQuery::create(null, $criteria);
        $query->joinWith('SessionType', $join_behavior);

        return $this->getSessions($query, $con);
    }

    /**
     * Clears out the collUserGames collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Game The current object (for fluent API support)
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
     * If this Game is new, it will return
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
                    ->filterByGame($this)
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
     * @return Game The current object (for fluent API support)
     */
    public function setUserGames(PropelCollection $userGames, PropelPDO $con = null)
    {
        $userGamesToDelete = $this->getUserGames(new Criteria(), $con)->diff($userGames);


        $this->userGamesScheduledForDeletion = $userGamesToDelete;

        foreach ($userGamesToDelete as $userGameRemoved) {
            $userGameRemoved->setGame(null);
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
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collUserGames);
    }

    /**
     * Method called to associate a UserGame object to this object
     * through the UserGame foreign key attribute.
     *
     * @param    UserGame $l UserGame
     * @return Game The current object (for fluent API support)
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
        $userGame->setGame($this);
    }

    /**
     * @param	UserGame $userGame The userGame object to remove.
     * @return Game The current object (for fluent API support)
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
            $userGame->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related UserGames from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UserGame[] List of UserGame objects
     */
    public function getUserGamesJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UserGameQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getUserGames($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->game_id = null;
        $this->game_code = null;
        $this->game_name = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
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
            if ($this->collGameMods) {
                foreach ($this->collGameMods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSessions) {
                foreach ($this->collSessions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserGames) {
                foreach ($this->collUserGames as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collGameMods instanceof PropelCollection) {
            $this->collGameMods->clearIterator();
        }
        $this->collGameMods = null;
        if ($this->collSessions instanceof PropelCollection) {
            $this->collSessions->clearIterator();
        }
        $this->collSessions = null;
        if ($this->collUserGames instanceof PropelCollection) {
            $this->collUserGames->clearIterator();
        }
        $this->collUserGames = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GamePeer::DEFAULT_STRING_FORMAT);
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
