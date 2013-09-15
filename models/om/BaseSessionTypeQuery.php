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
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionType;
use Rdy4Racing\Models\SessionTypePeer;
use Rdy4Racing\Models\SessionTypeQuery;

/**
 * Base class that represents a query for the 'session_type' table.
 *
 *
 *
 * @method SessionTypeQuery orderById($order = Criteria::ASC) Order by the stype_id column
 * @method SessionTypeQuery orderByConstant($order = Criteria::ASC) Order by the stype_constant column
 * @method SessionTypeQuery orderByName($order = Criteria::ASC) Order by the stype_name column
 * @method SessionTypeQuery orderByDescription($order = Criteria::ASC) Order by the stype_description column
 *
 * @method SessionTypeQuery groupById() Group by the stype_id column
 * @method SessionTypeQuery groupByConstant() Group by the stype_constant column
 * @method SessionTypeQuery groupByName() Group by the stype_name column
 * @method SessionTypeQuery groupByDescription() Group by the stype_description column
 *
 * @method SessionTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SessionTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SessionTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SessionTypeQuery leftJoinSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the Session relation
 * @method SessionTypeQuery rightJoinSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Session relation
 * @method SessionTypeQuery innerJoinSession($relationAlias = null) Adds a INNER JOIN clause to the query using the Session relation
 *
 * @method SessionType findOne(PropelPDO $con = null) Return the first SessionType matching the query
 * @method SessionType findOneOrCreate(PropelPDO $con = null) Return the first SessionType matching the query, or a new SessionType object populated from the query conditions when no match is found
 *
 * @method SessionType findOneByConstant(string $stype_constant) Return the first SessionType filtered by the stype_constant column
 * @method SessionType findOneByName(string $stype_name) Return the first SessionType filtered by the stype_name column
 * @method SessionType findOneByDescription(string $stype_description) Return the first SessionType filtered by the stype_description column
 *
 * @method array findById(int $stype_id) Return SessionType objects filtered by the stype_id column
 * @method array findByConstant(string $stype_constant) Return SessionType objects filtered by the stype_constant column
 * @method array findByName(string $stype_name) Return SessionType objects filtered by the stype_name column
 * @method array findByDescription(string $stype_description) Return SessionType objects filtered by the stype_description column
 *
 * @package    propel.generator..om
 */
abstract class BaseSessionTypeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSessionTypeQuery object.
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
            $modelName = 'Rdy4Racing\\Models\\SessionType';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SessionTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SessionTypeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SessionTypeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SessionTypeQuery) {
            return $criteria;
        }
        $query = new SessionTypeQuery(null, null, $modelAlias);

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
     * @return   SessionType|SessionType[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SessionTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SessionTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 SessionType A model object, or null if the key is not found
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
     * @return                 SessionType A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `stype_id`, `stype_constant`, `stype_name`, `stype_description` FROM `session_type` WHERE `stype_id` = :p0';
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
            $obj = new SessionType();
            $obj->hydrate($row);
            SessionTypePeer::addInstanceToPool($obj, (string) $key);
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
     * @return SessionType|SessionType[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|SessionType[]|mixed the list of results, formatted by the current formatter
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
     * @return SessionTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionTypePeer::STYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SessionTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionTypePeer::STYPE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the stype_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE stype_id = 1234
     * $query->filterById(array(12, 34)); // WHERE stype_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE stype_id >= 12
     * $query->filterById(array('max' => 12)); // WHERE stype_id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SessionTypePeer::STYPE_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SessionTypePeer::STYPE_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTypePeer::STYPE_ID, $id, $comparison);
    }

    /**
     * Filter the query on the stype_constant column
     *
     * Example usage:
     * <code>
     * $query->filterByConstant('fooValue');   // WHERE stype_constant = 'fooValue'
     * $query->filterByConstant('%fooValue%'); // WHERE stype_constant LIKE '%fooValue%'
     * </code>
     *
     * @param     string $constant The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionTypeQuery The current query, for fluid interface
     */
    public function filterByConstant($constant = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($constant)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $constant)) {
                $constant = str_replace('*', '%', $constant);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SessionTypePeer::STYPE_CONSTANT, $constant, $comparison);
    }

    /**
     * Filter the query on the stype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE stype_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE stype_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SessionTypePeer::STYPE_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the stype_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE stype_description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE stype_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SessionTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SessionTypePeer::STYPE_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related Session object
     *
     * @param   Session|PropelObjectCollection $session  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SessionTypeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySession($session, $comparison = null)
    {
        if ($session instanceof Session) {
            return $this
                ->addUsingAlias(SessionTypePeer::STYPE_ID, $session->getTypeId(), $comparison);
        } elseif ($session instanceof PropelObjectCollection) {
            return $this
                ->useSessionQuery()
                ->filterByPrimaryKeys($session->getPrimaryKeys())
                ->endUse();
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
     * @return SessionTypeQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   SessionType $sessionType Object to remove from the list of results
     *
     * @return SessionTypeQuery The current query, for fluid interface
     */
    public function prune($sessionType = null)
    {
        if ($sessionType) {
            $this->addUsingAlias(SessionTypePeer::STYPE_ID, $sessionType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
