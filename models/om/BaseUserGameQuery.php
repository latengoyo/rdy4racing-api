<?php

namespace \Rdy4Racing-API\Models\om;

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
use \Rdy4Racing-API\Models\Game;
use \Rdy4Racing-API\Models\User;
use \Rdy4Racing-API\Models\UserGame;
use \Rdy4Racing-API\Models\UserGamePeer;
use \Rdy4Racing-API\Models\UserGameQuery;

/**
 * Base class that represents a query for the 'user_game' table.
 *
 *
 *
 * @method UserGameQuery orderById($order = Criteria::ASC) Order by the usgm_id column
 * @method UserGameQuery orderByUserId($order = Criteria::ASC) Order by the usgm_user_id column
 * @method UserGameQuery orderByGameId($order = Criteria::ASC) Order by the usgm_game_id column
 * @method UserGameQuery orderByDriver($order = Criteria::ASC) Order by the usgm_driver column
 *
 * @method UserGameQuery groupById() Group by the usgm_id column
 * @method UserGameQuery groupByUserId() Group by the usgm_user_id column
 * @method UserGameQuery groupByGameId() Group by the usgm_game_id column
 * @method UserGameQuery groupByDriver() Group by the usgm_driver column
 *
 * @method UserGameQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserGameQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserGameQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserGameQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method UserGameQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method UserGameQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method UserGameQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method UserGameQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method UserGameQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method UserGame findOne(PropelPDO $con = null) Return the first UserGame matching the query
 * @method UserGame findOneOrCreate(PropelPDO $con = null) Return the first UserGame matching the query, or a new UserGame object populated from the query conditions when no match is found
 *
 * @method UserGame findOneByUserId(int $usgm_user_id) Return the first UserGame filtered by the usgm_user_id column
 * @method UserGame findOneByGameId(int $usgm_game_id) Return the first UserGame filtered by the usgm_game_id column
 * @method UserGame findOneByDriver(string $usgm_driver) Return the first UserGame filtered by the usgm_driver column
 *
 * @method array findById(int $usgm_id) Return UserGame objects filtered by the usgm_id column
 * @method array findByUserId(int $usgm_user_id) Return UserGame objects filtered by the usgm_user_id column
 * @method array findByGameId(int $usgm_game_id) Return UserGame objects filtered by the usgm_game_id column
 * @method array findByDriver(string $usgm_driver) Return UserGame objects filtered by the usgm_driver column
 *
 * @package    propel.generator..om
 */
abstract class BaseUserGameQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserGameQuery object.
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
            $modelName = '\\Rdy4Racing-API\\Models\\UserGame';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserGameQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UserGameQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserGameQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserGameQuery) {
            return $criteria;
        }
        $query = new UserGameQuery(null, null, $modelAlias);

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
     * @return   UserGame|UserGame[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserGamePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserGamePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 UserGame A model object, or null if the key is not found
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
     * @return                 UserGame A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `usgm_id`, `usgm_user_id`, `usgm_game_id`, `usgm_driver` FROM `user_game` WHERE `usgm_id` = :p0';
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
            $obj = new UserGame();
            $obj->hydrate($row);
            UserGamePeer::addInstanceToPool($obj, (string) $key);
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
     * @return UserGame|UserGame[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|UserGame[]|mixed the list of results, formatted by the current formatter
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
     * @return UserGameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserGamePeer::USGM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserGameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserGamePeer::USGM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the usgm_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE usgm_id = 1234
     * $query->filterById(array(12, 34)); // WHERE usgm_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE usgm_id >= 12
     * $query->filterById(array('max' => 12)); // WHERE usgm_id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserGameQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserGamePeer::USGM_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserGamePeer::USGM_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGamePeer::USGM_ID, $id, $comparison);
    }

    /**
     * Filter the query on the usgm_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE usgm_user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE usgm_user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE usgm_user_id >= 12
     * $query->filterByUserId(array('max' => 12)); // WHERE usgm_user_id <= 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserGameQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserGamePeer::USGM_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserGamePeer::USGM_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGamePeer::USGM_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the usgm_game_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGameId(1234); // WHERE usgm_game_id = 1234
     * $query->filterByGameId(array(12, 34)); // WHERE usgm_game_id IN (12, 34)
     * $query->filterByGameId(array('min' => 12)); // WHERE usgm_game_id >= 12
     * $query->filterByGameId(array('max' => 12)); // WHERE usgm_game_id <= 12
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
     * @return UserGameQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(UserGamePeer::USGM_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(UserGamePeer::USGM_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGamePeer::USGM_GAME_ID, $gameId, $comparison);
    }

    /**
     * Filter the query on the usgm_driver column
     *
     * Example usage:
     * <code>
     * $query->filterByDriver('fooValue');   // WHERE usgm_driver = 'fooValue'
     * $query->filterByDriver('%fooValue%'); // WHERE usgm_driver LIKE '%fooValue%'
     * </code>
     *
     * @param     string $driver The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserGameQuery The current query, for fluid interface
     */
    public function filterByDriver($driver = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($driver)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $driver)) {
                $driver = str_replace('*', '%', $driver);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserGamePeer::USGM_DRIVER, $driver, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserGameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserGamePeer::USGM_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserGamePeer::USGM_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserGameQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \\Rdy4Racing-API\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\\Rdy4Racing-API\Models\UserQuery');
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserGameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(UserGamePeer::USGM_GAME_ID, $game->getId(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserGamePeer::USGM_GAME_ID, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return UserGameQuery The current query, for fluid interface
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
     * @return   \\Rdy4Racing-API\Models\GameQuery A secondary query class using the current class as primary query
     */
    public function useGameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Game', '\\Rdy4Racing-API\Models\GameQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   UserGame $userGame Object to remove from the list of results
     *
     * @return UserGameQuery The current query, for fluid interface
     */
    public function prune($userGame = null)
    {
        if ($userGame) {
            $this->addUsingAlias(UserGamePeer::USGM_ID, $userGame->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
