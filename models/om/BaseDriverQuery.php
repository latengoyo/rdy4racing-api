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
use Rdy4Racing\Models\DriverPeer;
use Rdy4Racing\Models\DriverQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\UserGame;

/**
 * Base class that represents a query for the 'driver' table.
 *
 *
 *
 * @method DriverQuery orderBySessionId($order = Criteria::ASC) Order by the driver_session_id column
 * @method DriverQuery orderByUserGameId($order = Criteria::ASC) Order by the driver_usergame_id column
 * @method DriverQuery orderByRank($order = Criteria::ASC) Order by the driver_rank column
 * @method DriverQuery orderByMMRStart($order = Criteria::ASC) Order by the driver_mmr_start column
 * @method DriverQuery orderByRatingStart($order = Criteria::ASC) Order by the driver_rating_start column
 * @method DriverQuery orderByMMREnd($order = Criteria::ASC) Order by the driver_mmr_end column
 * @method DriverQuery orderByRatingEnd($order = Criteria::ASC) Order by the driver_rating_end column
 *
 * @method DriverQuery groupBySessionId() Group by the driver_session_id column
 * @method DriverQuery groupByUserGameId() Group by the driver_usergame_id column
 * @method DriverQuery groupByRank() Group by the driver_rank column
 * @method DriverQuery groupByMMRStart() Group by the driver_mmr_start column
 * @method DriverQuery groupByRatingStart() Group by the driver_rating_start column
 * @method DriverQuery groupByMMREnd() Group by the driver_mmr_end column
 * @method DriverQuery groupByRatingEnd() Group by the driver_rating_end column
 *
 * @method DriverQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DriverQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DriverQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DriverQuery leftJoinSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the Session relation
 * @method DriverQuery rightJoinSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Session relation
 * @method DriverQuery innerJoinSession($relationAlias = null) Adds a INNER JOIN clause to the query using the Session relation
 *
 * @method DriverQuery leftJoinUserGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserGame relation
 * @method DriverQuery rightJoinUserGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserGame relation
 * @method DriverQuery innerJoinUserGame($relationAlias = null) Adds a INNER JOIN clause to the query using the UserGame relation
 *
 * @method Driver findOne(PropelPDO $con = null) Return the first Driver matching the query
 * @method Driver findOneOrCreate(PropelPDO $con = null) Return the first Driver matching the query, or a new Driver object populated from the query conditions when no match is found
 *
 * @method Driver findOneBySessionId(int $driver_session_id) Return the first Driver filtered by the driver_session_id column
 * @method Driver findOneByUserGameId(int $driver_usergame_id) Return the first Driver filtered by the driver_usergame_id column
 * @method Driver findOneByRank(string $driver_rank) Return the first Driver filtered by the driver_rank column
 * @method Driver findOneByMMRStart(int $driver_mmr_start) Return the first Driver filtered by the driver_mmr_start column
 * @method Driver findOneByRatingStart(int $driver_rating_start) Return the first Driver filtered by the driver_rating_start column
 * @method Driver findOneByMMREnd(int $driver_mmr_end) Return the first Driver filtered by the driver_mmr_end column
 * @method Driver findOneByRatingEnd(int $driver_rating_end) Return the first Driver filtered by the driver_rating_end column
 *
 * @method array findBySessionId(int $driver_session_id) Return Driver objects filtered by the driver_session_id column
 * @method array findByUserGameId(int $driver_usergame_id) Return Driver objects filtered by the driver_usergame_id column
 * @method array findByRank(string $driver_rank) Return Driver objects filtered by the driver_rank column
 * @method array findByMMRStart(int $driver_mmr_start) Return Driver objects filtered by the driver_mmr_start column
 * @method array findByRatingStart(int $driver_rating_start) Return Driver objects filtered by the driver_rating_start column
 * @method array findByMMREnd(int $driver_mmr_end) Return Driver objects filtered by the driver_mmr_end column
 * @method array findByRatingEnd(int $driver_rating_end) Return Driver objects filtered by the driver_rating_end column
 *
 * @package    propel.generator..om
 */
abstract class BaseDriverQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDriverQuery object.
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
            $modelName = 'Rdy4Racing\\Models\\Driver';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DriverQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DriverQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DriverQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DriverQuery) {
            return $criteria;
        }
        $query = new DriverQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$driver_session_id, $driver_usergame_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Driver|Driver[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DriverPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DriverPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Driver A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `driver_session_id`, `driver_usergame_id`, `driver_rank`, `driver_mmr_start`, `driver_rating_start`, `driver_mmr_end`, `driver_rating_end` FROM `driver` WHERE `driver_session_id` = :p0 AND `driver_usergame_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Driver();
            $obj->hydrate($row);
            DriverPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Driver|Driver[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Driver[]|mixed the list of results, formatted by the current formatter
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
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DriverPeer::DRIVER_SESSION_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DriverPeer::DRIVER_USERGAME_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DriverPeer::DRIVER_SESSION_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DriverPeer::DRIVER_USERGAME_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the driver_session_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionId(1234); // WHERE driver_session_id = 1234
     * $query->filterBySessionId(array(12, 34)); // WHERE driver_session_id IN (12, 34)
     * $query->filterBySessionId(array('min' => 12)); // WHERE driver_session_id >= 12
     * $query->filterBySessionId(array('max' => 12)); // WHERE driver_session_id <= 12
     * </code>
     *
     * @see       filterBySession()
     *
     * @param     mixed $sessionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterBySessionId($sessionId = null, $comparison = null)
    {
        if (is_array($sessionId)) {
            $useMinMax = false;
            if (isset($sessionId['min'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_SESSION_ID, $sessionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionId['max'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_SESSION_ID, $sessionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_SESSION_ID, $sessionId, $comparison);
    }

    /**
     * Filter the query on the driver_usergame_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserGameId(1234); // WHERE driver_usergame_id = 1234
     * $query->filterByUserGameId(array(12, 34)); // WHERE driver_usergame_id IN (12, 34)
     * $query->filterByUserGameId(array('min' => 12)); // WHERE driver_usergame_id >= 12
     * $query->filterByUserGameId(array('max' => 12)); // WHERE driver_usergame_id <= 12
     * </code>
     *
     * @see       filterByUserGame()
     *
     * @param     mixed $userGameId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByUserGameId($userGameId = null, $comparison = null)
    {
        if (is_array($userGameId)) {
            $useMinMax = false;
            if (isset($userGameId['min'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_USERGAME_ID, $userGameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userGameId['max'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_USERGAME_ID, $userGameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_USERGAME_ID, $userGameId, $comparison);
    }

    /**
     * Filter the query on the driver_rank column
     *
     * Example usage:
     * <code>
     * $query->filterByRank('fooValue');   // WHERE driver_rank = 'fooValue'
     * $query->filterByRank('%fooValue%'); // WHERE driver_rank LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rank The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByRank($rank = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rank)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rank)) {
                $rank = str_replace('*', '%', $rank);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_RANK, $rank, $comparison);
    }

    /**
     * Filter the query on the driver_mmr_start column
     *
     * Example usage:
     * <code>
     * $query->filterByMMRStart(1234); // WHERE driver_mmr_start = 1234
     * $query->filterByMMRStart(array(12, 34)); // WHERE driver_mmr_start IN (12, 34)
     * $query->filterByMMRStart(array('min' => 12)); // WHERE driver_mmr_start >= 12
     * $query->filterByMMRStart(array('max' => 12)); // WHERE driver_mmr_start <= 12
     * </code>
     *
     * @param     mixed $mMRStart The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByMMRStart($mMRStart = null, $comparison = null)
    {
        if (is_array($mMRStart)) {
            $useMinMax = false;
            if (isset($mMRStart['min'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_MMR_START, $mMRStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mMRStart['max'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_MMR_START, $mMRStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_MMR_START, $mMRStart, $comparison);
    }

    /**
     * Filter the query on the driver_rating_start column
     *
     * Example usage:
     * <code>
     * $query->filterByRatingStart(1234); // WHERE driver_rating_start = 1234
     * $query->filterByRatingStart(array(12, 34)); // WHERE driver_rating_start IN (12, 34)
     * $query->filterByRatingStart(array('min' => 12)); // WHERE driver_rating_start >= 12
     * $query->filterByRatingStart(array('max' => 12)); // WHERE driver_rating_start <= 12
     * </code>
     *
     * @param     mixed $ratingStart The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByRatingStart($ratingStart = null, $comparison = null)
    {
        if (is_array($ratingStart)) {
            $useMinMax = false;
            if (isset($ratingStart['min'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_RATING_START, $ratingStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingStart['max'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_RATING_START, $ratingStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_RATING_START, $ratingStart, $comparison);
    }

    /**
     * Filter the query on the driver_mmr_end column
     *
     * Example usage:
     * <code>
     * $query->filterByMMREnd(1234); // WHERE driver_mmr_end = 1234
     * $query->filterByMMREnd(array(12, 34)); // WHERE driver_mmr_end IN (12, 34)
     * $query->filterByMMREnd(array('min' => 12)); // WHERE driver_mmr_end >= 12
     * $query->filterByMMREnd(array('max' => 12)); // WHERE driver_mmr_end <= 12
     * </code>
     *
     * @param     mixed $mMREnd The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByMMREnd($mMREnd = null, $comparison = null)
    {
        if (is_array($mMREnd)) {
            $useMinMax = false;
            if (isset($mMREnd['min'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_MMR_END, $mMREnd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mMREnd['max'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_MMR_END, $mMREnd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_MMR_END, $mMREnd, $comparison);
    }

    /**
     * Filter the query on the driver_rating_end column
     *
     * Example usage:
     * <code>
     * $query->filterByRatingEnd(1234); // WHERE driver_rating_end = 1234
     * $query->filterByRatingEnd(array(12, 34)); // WHERE driver_rating_end IN (12, 34)
     * $query->filterByRatingEnd(array('min' => 12)); // WHERE driver_rating_end >= 12
     * $query->filterByRatingEnd(array('max' => 12)); // WHERE driver_rating_end <= 12
     * </code>
     *
     * @param     mixed $ratingEnd The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function filterByRatingEnd($ratingEnd = null, $comparison = null)
    {
        if (is_array($ratingEnd)) {
            $useMinMax = false;
            if (isset($ratingEnd['min'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_RATING_END, $ratingEnd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingEnd['max'])) {
                $this->addUsingAlias(DriverPeer::DRIVER_RATING_END, $ratingEnd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DriverPeer::DRIVER_RATING_END, $ratingEnd, $comparison);
    }

    /**
     * Filter the query by a related Session object
     *
     * @param   Session|PropelObjectCollection $session The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DriverQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySession($session, $comparison = null)
    {
        if ($session instanceof Session) {
            return $this
                ->addUsingAlias(DriverPeer::DRIVER_SESSION_ID, $session->getId(), $comparison);
        } elseif ($session instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DriverPeer::DRIVER_SESSION_ID, $session->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySession() only accepts arguments of type Session or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Session relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function joinSession($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Session');

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
            $this->addJoinObject($join, 'Session');
        }

        return $this;
    }

    /**
     * Use the Session relation Session object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\SessionQuery A secondary query class using the current class as primary query
     */
    public function useSessionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSession($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Session', '\Rdy4Racing\Models\SessionQuery');
    }

    /**
     * Filter the query by a related UserGame object
     *
     * @param   UserGame|PropelObjectCollection $userGame The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DriverQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserGame($userGame, $comparison = null)
    {
        if ($userGame instanceof UserGame) {
            return $this
                ->addUsingAlias(DriverPeer::DRIVER_USERGAME_ID, $userGame->getId(), $comparison);
        } elseif ($userGame instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DriverPeer::DRIVER_USERGAME_ID, $userGame->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserGame() only accepts arguments of type UserGame or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserGame relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function joinUserGame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserGame');

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
            $this->addJoinObject($join, 'UserGame');
        }

        return $this;
    }

    /**
     * Use the UserGame relation UserGame object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\UserGameQuery A secondary query class using the current class as primary query
     */
    public function useUserGameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserGame', '\Rdy4Racing\Models\UserGameQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Driver $driver Object to remove from the list of results
     *
     * @return DriverQuery The current query, for fluid interface
     */
    public function prune($driver = null)
    {
        if ($driver) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DriverPeer::DRIVER_SESSION_ID), $driver->getSessionId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DriverPeer::DRIVER_USERGAME_ID), $driver->getUserGameId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
