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
use Rdy4Racing\Models\Game;
use Rdy4Racing\Models\GameMod;
use Rdy4Racing\Models\GameModPeer;
use Rdy4Racing\Models\GameModQuery;

/**
 * Base class that represents a query for the 'gamemod' table.
 *
 *
 *
 * @method GameModQuery orderById($order = Criteria::ASC) Order by the gmod_id column
 * @method GameModQuery orderByGameId($order = Criteria::ASC) Order by the gmod_game_id column
 * @method GameModQuery orderByCode($order = Criteria::ASC) Order by the gmod_code column
 * @method GameModQuery orderByName($order = Criteria::ASC) Order by the gmod_name column
 * @method GameModQuery orderByDescription($order = Criteria::ASC) Order by the gmod_description column
 * @method GameModQuery orderByImageLowRes($order = Criteria::ASC) Order by the gmod_image_low column
 * @method GameModQuery orderByImageHiRes($order = Criteria::ASC) Order by the gmod_image_high column
 * @method GameModQuery orderByImageGameLauncher($order = Criteria::ASC) Order by the gmod_image_gl column
 *
 * @method GameModQuery groupById() Group by the gmod_id column
 * @method GameModQuery groupByGameId() Group by the gmod_game_id column
 * @method GameModQuery groupByCode() Group by the gmod_code column
 * @method GameModQuery groupByName() Group by the gmod_name column
 * @method GameModQuery groupByDescription() Group by the gmod_description column
 * @method GameModQuery groupByImageLowRes() Group by the gmod_image_low column
 * @method GameModQuery groupByImageHiRes() Group by the gmod_image_high column
 * @method GameModQuery groupByImageGameLauncher() Group by the gmod_image_gl column
 *
 * @method GameModQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GameModQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GameModQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GameModQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method GameModQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method GameModQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method GameMod findOne(PropelPDO $con = null) Return the first GameMod matching the query
 * @method GameMod findOneOrCreate(PropelPDO $con = null) Return the first GameMod matching the query, or a new GameMod object populated from the query conditions when no match is found
 *
 * @method GameMod findOneByGameId(int $gmod_game_id) Return the first GameMod filtered by the gmod_game_id column
 * @method GameMod findOneByCode(string $gmod_code) Return the first GameMod filtered by the gmod_code column
 * @method GameMod findOneByName(string $gmod_name) Return the first GameMod filtered by the gmod_name column
 * @method GameMod findOneByDescription(string $gmod_description) Return the first GameMod filtered by the gmod_description column
 * @method GameMod findOneByImageLowRes(string $gmod_image_low) Return the first GameMod filtered by the gmod_image_low column
 * @method GameMod findOneByImageHiRes(string $gmod_image_high) Return the first GameMod filtered by the gmod_image_high column
 * @method GameMod findOneByImageGameLauncher(string $gmod_image_gl) Return the first GameMod filtered by the gmod_image_gl column
 *
 * @method array findById(int $gmod_id) Return GameMod objects filtered by the gmod_id column
 * @method array findByGameId(int $gmod_game_id) Return GameMod objects filtered by the gmod_game_id column
 * @method array findByCode(string $gmod_code) Return GameMod objects filtered by the gmod_code column
 * @method array findByName(string $gmod_name) Return GameMod objects filtered by the gmod_name column
 * @method array findByDescription(string $gmod_description) Return GameMod objects filtered by the gmod_description column
 * @method array findByImageLowRes(string $gmod_image_low) Return GameMod objects filtered by the gmod_image_low column
 * @method array findByImageHiRes(string $gmod_image_high) Return GameMod objects filtered by the gmod_image_high column
 * @method array findByImageGameLauncher(string $gmod_image_gl) Return GameMod objects filtered by the gmod_image_gl column
 *
 * @package    propel.generator..om
 */
abstract class BaseGameModQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGameModQuery object.
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
            $modelName = 'Rdy4Racing\\Models\\GameMod';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GameModQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GameModQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GameModQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GameModQuery) {
            return $criteria;
        }
        $query = new GameModQuery(null, null, $modelAlias);

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
     * @return   GameMod|GameMod[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GameModPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GameModPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 GameMod A model object, or null if the key is not found
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
     * @return                 GameMod A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `gmod_id`, `gmod_game_id`, `gmod_code`, `gmod_name`, `gmod_description`, `gmod_image_low`, `gmod_image_high`, `gmod_image_gl` FROM `gamemod` WHERE `gmod_id` = :p0';
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
            $obj = new GameMod();
            $obj->hydrate($row);
            GameModPeer::addInstanceToPool($obj, (string) $key);
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
     * @return GameMod|GameMod[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|GameMod[]|mixed the list of results, formatted by the current formatter
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
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GameModPeer::GMOD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GameModPeer::GMOD_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the gmod_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE gmod_id = 1234
     * $query->filterById(array(12, 34)); // WHERE gmod_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE gmod_id >= 12
     * $query->filterById(array('max' => 12)); // WHERE gmod_id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GameModPeer::GMOD_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GameModPeer::GMOD_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_ID, $id, $comparison);
    }

    /**
     * Filter the query on the gmod_game_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGameId(1234); // WHERE gmod_game_id = 1234
     * $query->filterByGameId(array(12, 34)); // WHERE gmod_game_id IN (12, 34)
     * $query->filterByGameId(array('min' => 12)); // WHERE gmod_game_id >= 12
     * $query->filterByGameId(array('max' => 12)); // WHERE gmod_game_id <= 12
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
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(GameModPeer::GMOD_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(GameModPeer::GMOD_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_GAME_ID, $gameId, $comparison);
    }

    /**
     * Filter the query on the gmod_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE gmod_code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE gmod_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the gmod_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE gmod_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE gmod_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the gmod_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE gmod_description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE gmod_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GameModPeer::GMOD_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the gmod_image_low column
     *
     * Example usage:
     * <code>
     * $query->filterByImageLowRes('fooValue');   // WHERE gmod_image_low = 'fooValue'
     * $query->filterByImageLowRes('%fooValue%'); // WHERE gmod_image_low LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageLowRes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByImageLowRes($imageLowRes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageLowRes)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageLowRes)) {
                $imageLowRes = str_replace('*', '%', $imageLowRes);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_IMAGE_LOW, $imageLowRes, $comparison);
    }

    /**
     * Filter the query on the gmod_image_high column
     *
     * Example usage:
     * <code>
     * $query->filterByImageHiRes('fooValue');   // WHERE gmod_image_high = 'fooValue'
     * $query->filterByImageHiRes('%fooValue%'); // WHERE gmod_image_high LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageHiRes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByImageHiRes($imageHiRes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageHiRes)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageHiRes)) {
                $imageHiRes = str_replace('*', '%', $imageHiRes);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_IMAGE_HIGH, $imageHiRes, $comparison);
    }

    /**
     * Filter the query on the gmod_image_gl column
     *
     * Example usage:
     * <code>
     * $query->filterByImageGameLauncher('fooValue');   // WHERE gmod_image_gl = 'fooValue'
     * $query->filterByImageGameLauncher('%fooValue%'); // WHERE gmod_image_gl LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageGameLauncher The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function filterByImageGameLauncher($imageGameLauncher = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageGameLauncher)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageGameLauncher)) {
                $imageGameLauncher = str_replace('*', '%', $imageGameLauncher);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameModPeer::GMOD_IMAGE_GL, $imageGameLauncher, $comparison);
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameModQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(GameModPeer::GMOD_GAME_ID, $game->getId(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameModPeer::GMOD_GAME_ID, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return GameModQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   GameMod $gameMod Object to remove from the list of results
     *
     * @return GameModQuery The current query, for fluid interface
     */
    public function prune($gameMod = null)
    {
        if ($gameMod) {
            $this->addUsingAlias(GameModPeer::GMOD_ID, $gameMod->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
