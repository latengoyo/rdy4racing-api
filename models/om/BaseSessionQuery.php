<?php

namespace Rdy4Racing\Models\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Rdy4Racing\Models\Driver;
use Rdy4Racing\Models\Game;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionPeer;
use Rdy4Racing\Models\SessionQuery;
use Rdy4Racing\Models\SessionState;
use Rdy4Racing\Models\SessionType;

/**
 * Base class that represents a query for the 'session' table.
 *
 *
 *
 * @method SessionQuery orderById($order = Criteria::ASC) Order by the session_id column
 * @method SessionQuery orderByGameId($order = Criteria::ASC) Order by the session_game_id column
 * @method SessionQuery orderByTypeId($order = Criteria::ASC) Order by the session_stype_id column
 * @method SessionQuery orderByStateId($order = Criteria::ASC) Order by the session_sstate_id column
 * @method SessionQuery orderByDescription($order = Criteria::ASC) Order by the session_description column
 *
 * @method SessionQuery groupById() Group by the session_id column
 * @method SessionQuery groupByGameId() Group by the session_game_id column
 * @method SessionQuery groupByTypeId() Group by the session_stype_id column
 * @method SessionQuery groupByStateId() Group by the session_sstate_id column
 * @method SessionQuery groupByDescription() Group by the session_description column
 *
 * @method SessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SessionQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method SessionQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method SessionQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method SessionQuery leftJoinSessionState($relationAlias = null) Adds a LEFT JOIN clause to the query using the SessionState relation
 * @method SessionQuery rightJoinSessionState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SessionState relation
 * @method SessionQuery innerJoinSessionState($relationAlias = null) Adds a INNER JOIN clause to the query using the SessionState relation
 *
 * @method SessionQuery leftJoinSessionType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SessionType relation
 * @method SessionQuery rightJoinSessionType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SessionType relation
 * @method SessionQuery innerJoinSessionType($relationAlias = null) Adds a INNER JOIN clause to the query using the SessionType relation
 *
 * @method SessionQuery leftJoinDriver($relationAlias = null) Adds a LEFT JOIN clause to the query using the Driver relation
 * @method SessionQuery rightJoinDriver($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Driver relation
 * @method SessionQuery innerJoinDriver($relationAlias = null) Adds a INNER JOIN clause to the query using the Driver relation
 *
 * @method Session findOne(PropelPDO $con = null) Return the first Session matching the query
 * @method Session findOneOrCreate(PropelPDO $con = null) Return the first Session matching the query, or a new Session object populated from the query conditions when no match is found
 *
 * @method Session findOneByGameId(int $session_game_id) Return the first Session filtered by the session_game_id column
 * @method Session findOneByTypeId(int $session_stype_id) Return the first Session filtered by the session_stype_id column
 * @method Session findOneByStateId(int $session_sstate_id) Return the first Session filtered by the session_sstate_id column
 * @method Session findOneByDescription(string $session_description) Return the first Session filtered by the session_description column
 *
 * @method array findById(int $session_id) Return Session objects filtered by the session_id column
 * @method array findByGameId(int $session_game_id) Return Session objects filtered by the session_game_id column
 * @method array findByTypeId(int $session_stype_id) Return Session objects filtered by the session_stype_id column
 * @method array findByStateId(int $session_sstate_id) Return Session objects filtered by the session_sstate_id column
 * @method array findByDescription(string $session_description) Return Session objects filtered by the session_description column
 *
 * @package    propel.generator..om
 */
abstract class BaseSessionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSessionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'rdy4racing';
        }
        if (null === $modelName) {
            $modelName = 'Rdy4Racing\\Models\\Session';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SessionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SessionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SessionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SessionQuery) {
            return $criteria;
        }
        $query = new SessionQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Session|Session[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SessionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Session A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Session A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `session_id`, `session_game_id`, `session_stype_id`, `session_sstate_id`, `session_description` FROM `session` WHERE `session_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Session();
            $obj->hydrate($row);
            SessionPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Session|Session[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Session[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionPeer::SESSION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionPeer::SESSION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the session_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE session_id = 1234
     * $query->filterById(array(12, 34)); // WHERE session_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE session_id >= 12
     * $query->filterById(array('max' => 12)); // WHERE session_id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SessionPeer::SESSION_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SessionPeer::SESSION_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionPeer::SESSION_ID, $id, $comparison);
    }

    /**
     * Filter the query on the session_game_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGameId(1234); // WHERE session_game_id = 1234
     * $query->filterByGameId(array(12, 34)); // WHERE session_game_id IN (12, 34)
     * $query->filterByGameId(array('min' => 12)); // WHERE session_game_id >= 12
     * $query->filterByGameId(array('max' => 12)); // WHERE session_game_id <= 12
     * </code>
     *
     * @see       filterByGame()
     *
     * @param     mixed $gameId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(SessionPeer::SESSION_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(SessionPeer::SESSION_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionPeer::SESSION_GAME_ID, $gameId, $comparison);
    }

    /**
     * Filter the query on the session_stype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE session_stype_id = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE session_stype_id IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE session_stype_id >= 12
     * $query->filterByTypeId(array('max' => 12)); // WHERE session_stype_id <= 12
     * </code>
     *
     * @see       filterBySessionType()
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(SessionPeer::SESSION_STYPE_ID, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(SessionPeer::SESSION_STYPE_ID, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionPeer::SESSION_STYPE_ID, $typeId, $comparison);
    }

    /**
     * Filter the query on the session_sstate_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStateId(1234); // WHERE session_sstate_id = 1234
     * $query->filterByStateId(array(12, 34)); // WHERE session_sstate_id IN (12, 34)
     * $query->filterByStateId(array('min' => 12)); // WHERE session_sstate_id >= 12
     * $query->filterByStateId(array('max' => 12)); // WHERE session_sstate_id <= 12
     * </code>
     *
     * @see       filterBySessionState()
     *
     * @param     mixed $stateId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterByStateId($stateId = null, $comparison = null)
    {
        if (is_array($stateId)) {
            $useMinMax = false;
            if (isset($stateId['min'])) {
                $this->addUsingAlias(SessionPeer::SESSION_SSTATE_ID, $stateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stateId['max'])) {
                $this->addUsingAlias(SessionPeer::SESSION_SSTATE_ID, $stateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionPeer::SESSION_SSTATE_ID, $stateId, $comparison);
    }

    /**
     * Filter the query on the session_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE session_description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE session_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SessionPeer::SESSION_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SessionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(SessionPeer::SESSION_GAME_ID, $game->getId(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SessionPeer::SESSION_GAME_ID, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGame() only accepts arguments of type Game or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Game relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function joinGame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Game');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Game');
        }

        return $this;
    }

    /**
     * Use the Game relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\GameQuery A secondary query class using the current class as primary query
     */
    public function useGameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Game', '\Rdy4Racing\Models\GameQuery');
    }

    /**
     * Filter the query by a related SessionState object
     *
     * @param   SessionState|PropelObjectCollection $sessionState The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SessionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySessionState($sessionState, $comparison = null)
    {
        if ($sessionState instanceof SessionState) {
            return $this
                ->addUsingAlias(SessionPeer::SESSION_SSTATE_ID, $sessionState->getId(), $comparison);
        } elseif ($sessionState instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SessionPeer::SESSION_SSTATE_ID, $sessionState->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySessionState() only accepts arguments of type SessionState or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SessionState relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function joinSessionState($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SessionState');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SessionState');
        }

        return $this;
    }

    /**
     * Use the SessionState relation SessionState object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\SessionStateQuery A secondary query class using the current class as primary query
     */
    public function useSessionStateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSessionState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SessionState', '\Rdy4Racing\Models\SessionStateQuery');
    }

    /**
     * Filter the query by a related SessionType object
     *
     * @param   SessionType|PropelObjectCollection $sessionType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SessionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySessionType($sessionType, $comparison = null)
    {
        if ($sessionType instanceof SessionType) {
            return $this
                ->addUsingAlias(SessionPeer::SESSION_STYPE_ID, $sessionType->getId(), $comparison);
        } elseif ($sessionType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SessionPeer::SESSION_STYPE_ID, $sessionType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySessionType() only accepts arguments of type SessionType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SessionType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function joinSessionType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SessionType');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SessionType');
        }

        return $this;
    }

    /**
     * Use the SessionType relation SessionType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\SessionTypeQuery A secondary query class using the current class as primary query
     */
    public function useSessionTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSessionType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SessionType', '\Rdy4Racing\Models\SessionTypeQuery');
    }

    /**
     * Filter the query by a related Driver object
     *
     * @param   Driver|PropelObjectCollection $driver  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SessionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDriver($driver, $comparison = null)
    {
        if ($driver instanceof Driver) {
            return $this
                ->addUsingAlias(SessionPeer::SESSION_ID, $driver->getSessionId(), $comparison);
        } elseif ($driver instanceof PropelObjectCollection) {
            return $this
                ->useDriverQuery()
                ->filterByPrimaryKeys($driver->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDriver() only accepts arguments of type Driver or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Driver relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function joinDriver($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Driver');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Driver');
        }

        return $this;
    }

    /**
     * Use the Driver relation Driver object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\DriverQuery A secondary query class using the current class as primary query
     */
    public function useDriverQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDriver($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Driver', '\Rdy4Racing\Models\DriverQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Session $session Object to remove from the list of results
     *
     * @return SessionQuery The current query, for fluid interface
     */
    public function prune($session = null)
    {
        if ($session) {
            $this->addUsingAlias(SessionPeer::SESSION_ID, $session->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
