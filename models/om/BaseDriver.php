<?php

namespace Rdy4Racing\Models\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Rdy4Racing\Models\Driver;
use Rdy4Racing\Models\DriverPeer;
use Rdy4Racing\Models\DriverQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionQuery;
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserQuery;

/**
 * Base class that represents a row from the 'driver' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseDriver extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Rdy4Racing\\Models\\DriverPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DriverPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the driver_session_id field.
     * @var        int
     */
    protected $driver_session_id;

    /**
     * The value for the driver_user_id field.
     * @var        int
     */
    protected $driver_user_id;

    /**
     * The value for the driver_rank field.
     * @var        string
     */
    protected $driver_rank;

    /**
     * The value for the driver_mmr_start field.
     * @var        int
     */
    protected $driver_mmr_start;

    /**
     * The value for the driver_rating_start field.
     * @var        int
     */
    protected $driver_rating_start;

    /**
     * The value for the driver_mmr_end field.
     * @var        int
     */
    protected $driver_mmr_end;

    /**
     * The value for the driver_rating_end field.
     * @var        int
     */
    protected $driver_rating_end;

    /**
     * @var        Session
     */
    protected $aSession;

    /**
     * @var        User
     */
    protected $aUser;

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
     * Get the [driver_session_id] column value.
     *
     * @return int
     */
    public function getSessionId()
    {

        return $this->driver_session_id;
    }

    /**
     * Get the [driver_user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {

        return $this->driver_user_id;
    }

    /**
     * Get the [driver_rank] column value.
     *
     * @return string
     */
    public function getRank()
    {

        return $this->driver_rank;
    }

    /**
     * Get the [driver_mmr_start] column value.
     *
     * @return int
     */
    public function getMMRStart()
    {

        return $this->driver_mmr_start;
    }

    /**
     * Get the [driver_rating_start] column value.
     *
     * @return int
     */
    public function getRatingStart()
    {

        return $this->driver_rating_start;
    }

    /**
     * Get the [driver_mmr_end] column value.
     *
     * @return int
     */
    public function getMMREnd()
    {

        return $this->driver_mmr_end;
    }

    /**
     * Get the [driver_rating_end] column value.
     *
     * @return int
     */
    public function getRatingEnd()
    {

        return $this->driver_rating_end;
    }

    /**
     * Set the value of [driver_session_id] column.
     *
     * @param  int $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setSessionId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->driver_session_id !== $v) {
            $this->driver_session_id = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_SESSION_ID;
        }

        if ($this->aSession !== null && $this->aSession->getId() !== $v) {
            $this->aSession = null;
        }


        return $this;
    } // setSessionId()

    /**
     * Set the value of [driver_user_id] column.
     *
     * @param  int $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->driver_user_id !== $v) {
            $this->driver_user_id = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_USER_ID;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }


        return $this;
    } // setUserId()

    /**
     * Set the value of [driver_rank] column.
     *
     * @param  string $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setRank($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->driver_rank !== $v) {
            $this->driver_rank = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_RANK;
        }


        return $this;
    } // setRank()

    /**
     * Set the value of [driver_mmr_start] column.
     *
     * @param  int $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setMMRStart($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->driver_mmr_start !== $v) {
            $this->driver_mmr_start = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_MMR_START;
        }


        return $this;
    } // setMMRStart()

    /**
     * Set the value of [driver_rating_start] column.
     *
     * @param  int $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setRatingStart($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->driver_rating_start !== $v) {
            $this->driver_rating_start = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_RATING_START;
        }


        return $this;
    } // setRatingStart()

    /**
     * Set the value of [driver_mmr_end] column.
     *
     * @param  int $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setMMREnd($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->driver_mmr_end !== $v) {
            $this->driver_mmr_end = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_MMR_END;
        }


        return $this;
    } // setMMREnd()

    /**
     * Set the value of [driver_rating_end] column.
     *
     * @param  int $v new value
     * @return Driver The current object (for fluent API support)
     */
    public function setRatingEnd($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->driver_rating_end !== $v) {
            $this->driver_rating_end = $v;
            $this->modifiedColumns[] = DriverPeer::DRIVER_RATING_END;
        }


        return $this;
    } // setRatingEnd()

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

            $this->driver_session_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->driver_user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->driver_rank = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->driver_mmr_start = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->driver_rating_start = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->driver_mmr_end = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->driver_rating_end = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = DriverPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Driver object", $e);
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

        if ($this->aSession !== null && $this->driver_session_id !== $this->aSession->getId()) {
            $this->aSession = null;
        }
        if ($this->aUser !== null && $this->driver_user_id !== $this->aUser->getId()) {
            $this->aUser = null;
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
            $con = Propel::getConnection(DriverPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DriverPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSession = null;
            $this->aUser = null;
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
            $con = Propel::getConnection(DriverPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DriverQuery::create()
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
            $con = Propel::getConnection(DriverPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                DriverPeer::addInstanceToPool($this);
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

            if ($this->aSession !== null) {
                if ($this->aSession->isModified() || $this->aSession->isNew()) {
                    $affectedRows += $this->aSession->save($con);
                }
                $this->setSession($this->aSession);
            }

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DriverPeer::DRIVER_SESSION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`driver_session_id`';
        }
        if ($this->isColumnModified(DriverPeer::DRIVER_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`driver_user_id`';
        }
        if ($this->isColumnModified(DriverPeer::DRIVER_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`driver_rank`';
        }
        if ($this->isColumnModified(DriverPeer::DRIVER_MMR_START)) {
            $modifiedColumns[':p' . $index++]  = '`driver_mmr_start`';
        }
        if ($this->isColumnModified(DriverPeer::DRIVER_RATING_START)) {
            $modifiedColumns[':p' . $index++]  = '`driver_rating_start`';
        }
        if ($this->isColumnModified(DriverPeer::DRIVER_MMR_END)) {
            $modifiedColumns[':p' . $index++]  = '`driver_mmr_end`';
        }
        if ($this->isColumnModified(DriverPeer::DRIVER_RATING_END)) {
            $modifiedColumns[':p' . $index++]  = '`driver_rating_end`';
        }

        $sql = sprintf(
            'INSERT INTO `driver` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`driver_session_id`':
                        $stmt->bindValue($identifier, $this->driver_session_id, PDO::PARAM_INT);
                        break;
                    case '`driver_user_id`':
                        $stmt->bindValue($identifier, $this->driver_user_id, PDO::PARAM_INT);
                        break;
                    case '`driver_rank`':
                        $stmt->bindValue($identifier, $this->driver_rank, PDO::PARAM_STR);
                        break;
                    case '`driver_mmr_start`':
                        $stmt->bindValue($identifier, $this->driver_mmr_start, PDO::PARAM_INT);
                        break;
                    case '`driver_rating_start`':
                        $stmt->bindValue($identifier, $this->driver_rating_start, PDO::PARAM_INT);
                        break;
                    case '`driver_mmr_end`':
                        $stmt->bindValue($identifier, $this->driver_mmr_end, PDO::PARAM_INT);
                        break;
                    case '`driver_rating_end`':
                        $stmt->bindValue($identifier, $this->driver_rating_end, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

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

            if ($this->aSession !== null) {
                if (!$this->aSession->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSession->getValidationFailures());
                }
            }

            if ($this->aUser !== null) {
                if (!$this->aUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
                }
            }


            if (($retval = DriverPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = DriverPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getSessionId();
                break;
            case 1:
                return $this->getUserId();
                break;
            case 2:
                return $this->getRank();
                break;
            case 3:
                return $this->getMMRStart();
                break;
            case 4:
                return $this->getRatingStart();
                break;
            case 5:
                return $this->getMMREnd();
                break;
            case 6:
                return $this->getRatingEnd();
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
        if (isset($alreadyDumpedObjects['Driver'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Driver'][serialize($this->getPrimaryKey())] = true;
        $keys = DriverPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getSessionId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getRank(),
            $keys[3] => $this->getMMRStart(),
            $keys[4] => $this->getRatingStart(),
            $keys[5] => $this->getMMREnd(),
            $keys[6] => $this->getRatingEnd(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach($virtualColumns as $key => $virtualColumn)
        {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSession) {
                $result['Session'] = $this->aSession->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUser) {
                $result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = DriverPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setSessionId($value);
                break;
            case 1:
                $this->setUserId($value);
                break;
            case 2:
                $this->setRank($value);
                break;
            case 3:
                $this->setMMRStart($value);
                break;
            case 4:
                $this->setRatingStart($value);
                break;
            case 5:
                $this->setMMREnd($value);
                break;
            case 6:
                $this->setRatingEnd($value);
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
        $keys = DriverPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setSessionId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setMMRStart($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRatingStart($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setMMREnd($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setRatingEnd($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DriverPeer::DATABASE_NAME);

        if ($this->isColumnModified(DriverPeer::DRIVER_SESSION_ID)) $criteria->add(DriverPeer::DRIVER_SESSION_ID, $this->driver_session_id);
        if ($this->isColumnModified(DriverPeer::DRIVER_USER_ID)) $criteria->add(DriverPeer::DRIVER_USER_ID, $this->driver_user_id);
        if ($this->isColumnModified(DriverPeer::DRIVER_RANK)) $criteria->add(DriverPeer::DRIVER_RANK, $this->driver_rank);
        if ($this->isColumnModified(DriverPeer::DRIVER_MMR_START)) $criteria->add(DriverPeer::DRIVER_MMR_START, $this->driver_mmr_start);
        if ($this->isColumnModified(DriverPeer::DRIVER_RATING_START)) $criteria->add(DriverPeer::DRIVER_RATING_START, $this->driver_rating_start);
        if ($this->isColumnModified(DriverPeer::DRIVER_MMR_END)) $criteria->add(DriverPeer::DRIVER_MMR_END, $this->driver_mmr_end);
        if ($this->isColumnModified(DriverPeer::DRIVER_RATING_END)) $criteria->add(DriverPeer::DRIVER_RATING_END, $this->driver_rating_end);

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
        $criteria = new Criteria(DriverPeer::DATABASE_NAME);
        $criteria->add(DriverPeer::DRIVER_SESSION_ID, $this->driver_session_id);
        $criteria->add(DriverPeer::DRIVER_USER_ID, $this->driver_user_id);

        return $criteria;
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getSessionId();
        $pks[1] = $this->getUserId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setSessionId($keys[0]);
        $this->setUserId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getSessionId()) && (null === $this->getUserId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Driver (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSessionId($this->getSessionId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setRank($this->getRank());
        $copyObj->setMMRStart($this->getMMRStart());
        $copyObj->setRatingStart($this->getRatingStart());
        $copyObj->setMMREnd($this->getMMREnd());
        $copyObj->setRatingEnd($this->getRatingEnd());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return Driver Clone of current object.
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
     * @return DriverPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DriverPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Session object.
     *
     * @param                  Session $v
     * @return Driver The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSession(Session $v = null)
    {
        if ($v === null) {
            $this->setSessionId(NULL);
        } else {
            $this->setSessionId($v->getId());
        }

        $this->aSession = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Session object, it will not be re-added.
        if ($v !== null) {
            $v->addDriver($this);
        }


        return $this;
    }


    /**
     * Get the associated Session object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Session The associated Session object.
     * @throws PropelException
     */
    public function getSession(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aSession === null && ($this->driver_session_id !== null) && $doQuery) {
            $this->aSession = SessionQuery::create()->findPk($this->driver_session_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSession->addDrivers($this);
             */
        }

        return $this->aSession;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param                  User $v
     * @return Driver The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(User $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addDriver($this);
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
    public function getUser(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUser === null && ($this->driver_user_id !== null) && $doQuery) {
            $this->aUser = UserQuery::create()->findPk($this->driver_user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addDrivers($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->driver_session_id = null;
        $this->driver_user_id = null;
        $this->driver_rank = null;
        $this->driver_mmr_start = null;
        $this->driver_rating_start = null;
        $this->driver_mmr_end = null;
        $this->driver_rating_end = null;
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
            if ($this->aSession instanceof Persistent) {
              $this->aSession->clearAllReferences($deep);
            }
            if ($this->aUser instanceof Persistent) {
              $this->aUser->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aSession = null;
        $this->aUser = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DriverPeer::DEFAULT_STRING_FORMAT);
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
