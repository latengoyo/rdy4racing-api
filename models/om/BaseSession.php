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
use Rdy4Racing\Models\Driver;
use Rdy4Racing\Models\DriverQuery;
use Rdy4Racing\Models\Game;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionPeer;
use Rdy4Racing\Models\SessionQuery;
use Rdy4Racing\Models\SessionState;
use Rdy4Racing\Models\SessionStateQuery;
use Rdy4Racing\Models\SessionType;
use Rdy4Racing\Models\SessionTypeQuery;

/**
 * Base class that represents a row from the 'session' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseSession extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Rdy4Racing\\Models\\SessionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SessionPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the session_id field.
     * @var        int
     */
    protected $session_id;

    /**
     * The value for the session_game_id field.
     * @var        int
     */
    protected $session_game_id;

    /**
     * The value for the session_stype_id field.
     * @var        int
     */
    protected $session_stype_id;

    /**
     * The value for the session_sstate_id field.
     * @var        int
     */
    protected $session_sstate_id;

    /**
     * The value for the session_description field.
     * @var        string
     */
    protected $session_description;

    /**
     * @var        Game
     */
    protected $aGame;

    /**
     * @var        SessionState
     */
    protected $aSessionState;

    /**
     * @var        SessionType
     */
    protected $aSessionType;

    /**
     * @var        PropelObjectCollection|Driver[] Collection to store aggregation of Driver objects.
     */
    protected $collDrivers;
    protected $collDriversPartial;

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
    protected $driversScheduledForDeletion = null;

    /**
     * Get the [session_id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->session_id;
    }

    /**
     * Get the [session_game_id] column value.
     *
     * @return int
     */
    public function getGameId()
    {

        return $this->session_game_id;
    }

    /**
     * Get the [session_stype_id] column value.
     *
     * @return int
     */
    public function getTypeId()
    {

        return $this->session_stype_id;
    }

    /**
     * Get the [session_sstate_id] column value.
     *
     * @return int
     */
    public function getStateId()
    {

        return $this->session_sstate_id;
    }

    /**
     * Get the [session_description] column value.
     *
     * @return string
     */
    public function getDescription()
    {

        return $this->session_description;
    }

    /**
     * Set the value of [session_id] column.
     *
     * @param  int $v new value
     * @return Session The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->session_id !== $v) {
            $this->session_id = $v;
            $this->modifiedColumns[] = SessionPeer::SESSION_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [session_game_id] column.
     *
     * @param  int $v new value
     * @return Session The current object (for fluent API support)
     */
    public function setGameId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->session_game_id !== $v) {
            $this->session_game_id = $v;
            $this->modifiedColumns[] = SessionPeer::SESSION_GAME_ID;
        }

        if ($this->aGame !== null && $this->aGame->getId() !== $v) {
            $this->aGame = null;
        }


        return $this;
    } // setGameId()

    /**
     * Set the value of [session_stype_id] column.
     *
     * @param  int $v new value
     * @return Session The current object (for fluent API support)
     */
    public function setTypeId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->session_stype_id !== $v) {
            $this->session_stype_id = $v;
            $this->modifiedColumns[] = SessionPeer::SESSION_STYPE_ID;
        }

        if ($this->aSessionType !== null && $this->aSessionType->getId() !== $v) {
            $this->aSessionType = null;
        }


        return $this;
    } // setTypeId()

    /**
     * Set the value of [session_sstate_id] column.
     *
     * @param  int $v new value
     * @return Session The current object (for fluent API support)
     */
    public function setStateId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->session_sstate_id !== $v) {
            $this->session_sstate_id = $v;
            $this->modifiedColumns[] = SessionPeer::SESSION_SSTATE_ID;
        }

        if ($this->aSessionState !== null && $this->aSessionState->getId() !== $v) {
            $this->aSessionState = null;
        }


        return $this;
    } // setStateId()

    /**
     * Set the value of [session_description] column.
     *
     * @param  string $v new value
     * @return Session The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->session_description !== $v) {
            $this->session_description = $v;
            $this->modifiedColumns[] = SessionPeer::SESSION_DESCRIPTION;
        }


        return $this;
    } // setDescription()

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

            $this->session_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->session_game_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->session_stype_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->session_sstate_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->session_description = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 5; // 5 = SessionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Session object", $e);
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

        if ($this->aGame !== null && $this->session_game_id !== $this->aGame->getId()) {
            $this->aGame = null;
        }
        if ($this->aSessionType !== null && $this->session_stype_id !== $this->aSessionType->getId()) {
            $this->aSessionType = null;
        }
        if ($this->aSessionState !== null && $this->session_sstate_id !== $this->aSessionState->getId()) {
            $this->aSessionState = null;
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
            $con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SessionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGame = null;
            $this->aSessionState = null;
            $this->aSessionType = null;
            $this->collDrivers = null;

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
            $con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SessionQuery::create()
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
            $con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                SessionPeer::addInstanceToPool($this);
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

            if ($this->aGame !== null) {
                if ($this->aGame->isModified() || $this->aGame->isNew()) {
                    $affectedRows += $this->aGame->save($con);
                }
                $this->setGame($this->aGame);
            }

            if ($this->aSessionState !== null) {
                if ($this->aSessionState->isModified() || $this->aSessionState->isNew()) {
                    $affectedRows += $this->aSessionState->save($con);
                }
                $this->setSessionState($this->aSessionState);
            }

            if ($this->aSessionType !== null) {
                if ($this->aSessionType->isModified() || $this->aSessionType->isNew()) {
                    $affectedRows += $this->aSessionType->save($con);
                }
                $this->setSessionType($this->aSessionType);
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

            if ($this->driversScheduledForDeletion !== null) {
                if (!$this->driversScheduledForDeletion->isEmpty()) {
                    DriverQuery::create()
                        ->filterByPrimaryKeys($this->driversScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->driversScheduledForDeletion = null;
                }
            }

            if ($this->collDrivers !== null) {
                foreach ($this->collDrivers as $referrerFK) {
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

        $this->modifiedColumns[] = SessionPeer::SESSION_ID;
        if (null !== $this->session_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SessionPeer::SESSION_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SessionPeer::SESSION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`session_id`';
        }
        if ($this->isColumnModified(SessionPeer::SESSION_GAME_ID)) {
            $modifiedColumns[':p' . $index++]  = '`session_game_id`';
        }
        if ($this->isColumnModified(SessionPeer::SESSION_STYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`session_stype_id`';
        }
        if ($this->isColumnModified(SessionPeer::SESSION_SSTATE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`session_sstate_id`';
        }
        if ($this->isColumnModified(SessionPeer::SESSION_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`session_description`';
        }

        $sql = sprintf(
            'INSERT INTO `session` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`session_id`':
                        $stmt->bindValue($identifier, $this->session_id, PDO::PARAM_INT);
                        break;
                    case '`session_game_id`':
                        $stmt->bindValue($identifier, $this->session_game_id, PDO::PARAM_INT);
                        break;
                    case '`session_stype_id`':
                        $stmt->bindValue($identifier, $this->session_stype_id, PDO::PARAM_INT);
                        break;
                    case '`session_sstate_id`':
                        $stmt->bindValue($identifier, $this->session_sstate_id, PDO::PARAM_INT);
                        break;
                    case '`session_description`':
                        $stmt->bindValue($identifier, $this->session_description, PDO::PARAM_STR);
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

            if ($this->aGame !== null) {
                if (!$this->aGame->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aGame->getValidationFailures());
                }
            }

            if ($this->aSessionState !== null) {
                if (!$this->aSessionState->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSessionState->getValidationFailures());
                }
            }

            if ($this->aSessionType !== null) {
                if (!$this->aSessionType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSessionType->getValidationFailures());
                }
            }


            if (($retval = SessionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collDrivers !== null) {
                    foreach ($this->collDrivers as $referrerFK) {
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
        $pos = SessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getGameId();
                break;
            case 2:
                return $this->getTypeId();
                break;
            case 3:
                return $this->getStateId();
                break;
            case 4:
                return $this->getDescription();
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
        if (isset($alreadyDumpedObjects['Session'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Session'][$this->getPrimaryKey()] = true;
        $keys = SessionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getGameId(),
            $keys[2] => $this->getTypeId(),
            $keys[3] => $this->getStateId(),
            $keys[4] => $this->getDescription(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach($virtualColumns as $key => $virtualColumn)
        {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGame) {
                $result['Game'] = $this->aGame->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSessionState) {
                $result['SessionState'] = $this->aSessionState->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSessionType) {
                $result['SessionType'] = $this->aSessionType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDrivers) {
                $result['Drivers'] = $this->collDrivers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setGameId($value);
                break;
            case 2:
                $this->setTypeId($value);
                break;
            case 3:
                $this->setStateId($value);
                break;
            case 4:
                $this->setDescription($value);
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
        $keys = SessionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setGameId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTypeId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStateId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SessionPeer::DATABASE_NAME);

        if ($this->isColumnModified(SessionPeer::SESSION_ID)) $criteria->add(SessionPeer::SESSION_ID, $this->session_id);
        if ($this->isColumnModified(SessionPeer::SESSION_GAME_ID)) $criteria->add(SessionPeer::SESSION_GAME_ID, $this->session_game_id);
        if ($this->isColumnModified(SessionPeer::SESSION_STYPE_ID)) $criteria->add(SessionPeer::SESSION_STYPE_ID, $this->session_stype_id);
        if ($this->isColumnModified(SessionPeer::SESSION_SSTATE_ID)) $criteria->add(SessionPeer::SESSION_SSTATE_ID, $this->session_sstate_id);
        if ($this->isColumnModified(SessionPeer::SESSION_DESCRIPTION)) $criteria->add(SessionPeer::SESSION_DESCRIPTION, $this->session_description);

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
        $criteria = new Criteria(SessionPeer::DATABASE_NAME);
        $criteria->add(SessionPeer::SESSION_ID, $this->session_id);

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
     * Generic method to set the primary key (session_id column).
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
     * @param object $copyObj An object of Session (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setGameId($this->getGameId());
        $copyObj->setTypeId($this->getTypeId());
        $copyObj->setStateId($this->getStateId());
        $copyObj->setDescription($this->getDescription());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getDrivers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDriver($relObj->copy($deepCopy));
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
     * @return Session Clone of current object.
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
     * @return SessionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SessionPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Game object.
     *
     * @param                  Game $v
     * @return Session The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGame(Game $v = null)
    {
        if ($v === null) {
            $this->setGameId(NULL);
        } else {
            $this->setGameId($v->getId());
        }

        $this->aGame = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Game object, it will not be re-added.
        if ($v !== null) {
            $v->addSession($this);
        }


        return $this;
    }


    /**
     * Get the associated Game object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Game The associated Game object.
     * @throws PropelException
     */
    public function getGame(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aGame === null && ($this->session_game_id !== null) && $doQuery) {
            $this->aGame = GameQuery::create()->findPk($this->session_game_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGame->addSessions($this);
             */
        }

        return $this->aGame;
    }

    /**
     * Declares an association between this object and a SessionState object.
     *
     * @param                  SessionState $v
     * @return Session The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSessionState(SessionState $v = null)
    {
        if ($v === null) {
            $this->setStateId(NULL);
        } else {
            $this->setStateId($v->getId());
        }

        $this->aSessionState = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SessionState object, it will not be re-added.
        if ($v !== null) {
            $v->addSession($this);
        }


        return $this;
    }


    /**
     * Get the associated SessionState object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return SessionState The associated SessionState object.
     * @throws PropelException
     */
    public function getSessionState(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aSessionState === null && ($this->session_sstate_id !== null) && $doQuery) {
            $this->aSessionState = SessionStateQuery::create()->findPk($this->session_sstate_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSessionState->addSessions($this);
             */
        }

        return $this->aSessionState;
    }

    /**
     * Declares an association between this object and a SessionType object.
     *
     * @param                  SessionType $v
     * @return Session The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSessionType(SessionType $v = null)
    {
        if ($v === null) {
            $this->setTypeId(NULL);
        } else {
            $this->setTypeId($v->getId());
        }

        $this->aSessionType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SessionType object, it will not be re-added.
        if ($v !== null) {
            $v->addSession($this);
        }


        return $this;
    }


    /**
     * Get the associated SessionType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return SessionType The associated SessionType object.
     * @throws PropelException
     */
    public function getSessionType(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aSessionType === null && ($this->session_stype_id !== null) && $doQuery) {
            $this->aSessionType = SessionTypeQuery::create()->findPk($this->session_stype_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSessionType->addSessions($this);
             */
        }

        return $this->aSessionType;
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
        if ('Driver' == $relationName) {
            $this->initDrivers();
        }
    }

    /**
     * Clears out the collDrivers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Session The current object (for fluent API support)
     * @see        addDrivers()
     */
    public function clearDrivers()
    {
        $this->collDrivers = null; // important to set this to null since that means it is uninitialized
        $this->collDriversPartial = null;

        return $this;
    }

    /**
     * reset is the collDrivers collection loaded partially
     *
     * @return void
     */
    public function resetPartialDrivers($v = true)
    {
        $this->collDriversPartial = $v;
    }

    /**
     * Initializes the collDrivers collection.
     *
     * By default this just sets the collDrivers collection to an empty array (like clearcollDrivers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDrivers($overrideExisting = true)
    {
        if (null !== $this->collDrivers && !$overrideExisting) {
            return;
        }
        $this->collDrivers = new PropelObjectCollection();
        $this->collDrivers->setModel('Driver');
    }

    /**
     * Gets an array of Driver objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Session is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Driver[] List of Driver objects
     * @throws PropelException
     */
    public function getDrivers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDriversPartial && !$this->isNew();
        if (null === $this->collDrivers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDrivers) {
                // return empty collection
                $this->initDrivers();
            } else {
                $collDrivers = DriverQuery::create(null, $criteria)
                    ->filterBySession($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDriversPartial && count($collDrivers)) {
                      $this->initDrivers(false);

                      foreach ($collDrivers as $obj) {
                        if (false == $this->collDrivers->contains($obj)) {
                          $this->collDrivers->append($obj);
                        }
                      }

                      $this->collDriversPartial = true;
                    }

                    $collDrivers->getInternalIterator()->rewind();

                    return $collDrivers;
                }

                if ($partial && $this->collDrivers) {
                    foreach ($this->collDrivers as $obj) {
                        if ($obj->isNew()) {
                            $collDrivers[] = $obj;
                        }
                    }
                }

                $this->collDrivers = $collDrivers;
                $this->collDriversPartial = false;
            }
        }

        return $this->collDrivers;
    }

    /**
     * Sets a collection of Driver objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $drivers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Session The current object (for fluent API support)
     */
    public function setDrivers(PropelCollection $drivers, PropelPDO $con = null)
    {
        $driversToDelete = $this->getDrivers(new Criteria(), $con)->diff($drivers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->driversScheduledForDeletion = clone $driversToDelete;

        foreach ($driversToDelete as $driverRemoved) {
            $driverRemoved->setSession(null);
        }

        $this->collDrivers = null;
        foreach ($drivers as $driver) {
            $this->addDriver($driver);
        }

        $this->collDrivers = $drivers;
        $this->collDriversPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Driver objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Driver objects.
     * @throws PropelException
     */
    public function countDrivers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDriversPartial && !$this->isNew();
        if (null === $this->collDrivers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDrivers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDrivers());
            }
            $query = DriverQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySession($this)
                ->count($con);
        }

        return count($this->collDrivers);
    }

    /**
     * Method called to associate a Driver object to this object
     * through the Driver foreign key attribute.
     *
     * @param    Driver $l Driver
     * @return Session The current object (for fluent API support)
     */
    public function addDriver(Driver $l)
    {
        if ($this->collDrivers === null) {
            $this->initDrivers();
            $this->collDriversPartial = true;
        }
        if (!in_array($l, $this->collDrivers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDriver($l);
        }

        return $this;
    }

    /**
     * @param	Driver $driver The driver object to add.
     */
    protected function doAddDriver($driver)
    {
        $this->collDrivers[]= $driver;
        $driver->setSession($this);
    }

    /**
     * @param	Driver $driver The driver object to remove.
     * @return Session The current object (for fluent API support)
     */
    public function removeDriver($driver)
    {
        if ($this->getDrivers()->contains($driver)) {
            $this->collDrivers->remove($this->collDrivers->search($driver));
            if (null === $this->driversScheduledForDeletion) {
                $this->driversScheduledForDeletion = clone $this->collDrivers;
                $this->driversScheduledForDeletion->clear();
            }
            $this->driversScheduledForDeletion[]= clone $driver;
            $driver->setSession(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Session is new, it will return
     * an empty collection; or if this Session has previously
     * been saved, it will retrieve related Drivers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Session.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Driver[] List of Driver objects
     */
    public function getDriversJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DriverQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getDrivers($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->session_id = null;
        $this->session_game_id = null;
        $this->session_stype_id = null;
        $this->session_sstate_id = null;
        $this->session_description = null;
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
            if ($this->collDrivers) {
                foreach ($this->collDrivers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aGame instanceof Persistent) {
              $this->aGame->clearAllReferences($deep);
            }
            if ($this->aSessionState instanceof Persistent) {
              $this->aSessionState->clearAllReferences($deep);
            }
            if ($this->aSessionType instanceof Persistent) {
              $this->aSessionType->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collDrivers instanceof PropelCollection) {
            $this->collDrivers->clearIterator();
        }
        $this->collDrivers = null;
        $this->aGame = null;
        $this->aSessionState = null;
        $this->aSessionType = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SessionPeer::DEFAULT_STRING_FORMAT);
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
