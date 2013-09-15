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
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserGame;
use Rdy4Racing\Models\UserPeer;
use Rdy4Racing\Models\UserQuery;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method UserQuery orderById($order = Criteria::ASC) Order by the user_id column
 * @method UserQuery orderByEmail($order = Criteria::ASC) Order by the user_email column
 * @method UserQuery orderByPassword($order = Criteria::ASC) Order by the user_password column
 * @method UserQuery orderByFirstName($order = Criteria::ASC) Order by the user_firstname column
 * @method UserQuery orderByLastName($order = Criteria::ASC) Order by the user_lastname column
 * @method UserQuery orderByDateOfBirth($order = Criteria::ASC) Order by the user_dateofbirth column
 * @method UserQuery orderByRank($order = Criteria::ASC) Order by the user_rank column
 * @method UserQuery orderByMMR($order = Criteria::ASC) Order by the user_mmr column
 * @method UserQuery orderByRating($order = Criteria::ASC) Order by the user_rating column
 * @method UserQuery orderByAbout($order = Criteria::ASC) Order by the user_about column
 * @method UserQuery orderByAvatar($order = Criteria::ASC) Order by the user_avatar column
 * @method UserQuery orderByCreated($order = Criteria::ASC) Order by the user_created column
 * @method UserQuery orderByActive($order = Criteria::ASC) Order by the user_active column
 * @method UserQuery orderByGodfatherId($order = Criteria::ASC) Order by the user_godfather column
 * @method UserQuery orderByConfirmationString($order = Criteria::ASC) Order by the user_confirmation_string column
 *
 * @method UserQuery groupById() Group by the user_id column
 * @method UserQuery groupByEmail() Group by the user_email column
 * @method UserQuery groupByPassword() Group by the user_password column
 * @method UserQuery groupByFirstName() Group by the user_firstname column
 * @method UserQuery groupByLastName() Group by the user_lastname column
 * @method UserQuery groupByDateOfBirth() Group by the user_dateofbirth column
 * @method UserQuery groupByRank() Group by the user_rank column
 * @method UserQuery groupByMMR() Group by the user_mmr column
 * @method UserQuery groupByRating() Group by the user_rating column
 * @method UserQuery groupByAbout() Group by the user_about column
 * @method UserQuery groupByAvatar() Group by the user_avatar column
 * @method UserQuery groupByCreated() Group by the user_created column
 * @method UserQuery groupByActive() Group by the user_active column
 * @method UserQuery groupByGodfatherId() Group by the user_godfather column
 * @method UserQuery groupByConfirmationString() Group by the user_confirmation_string column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserQuery leftJoinUserRelatedByGodfatherId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByGodfatherId relation
 * @method UserQuery rightJoinUserRelatedByGodfatherId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByGodfatherId relation
 * @method UserQuery innerJoinUserRelatedByGodfatherId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByGodfatherId relation
 *
 * @method UserQuery leftJoinDriver($relationAlias = null) Adds a LEFT JOIN clause to the query using the Driver relation
 * @method UserQuery rightJoinDriver($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Driver relation
 * @method UserQuery innerJoinDriver($relationAlias = null) Adds a INNER JOIN clause to the query using the Driver relation
 *
 * @method UserQuery leftJoinUserRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedById relation
 * @method UserQuery rightJoinUserRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedById relation
 * @method UserQuery innerJoinUserRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedById relation
 *
 * @method UserQuery leftJoinUserGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserGame relation
 * @method UserQuery rightJoinUserGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserGame relation
 * @method UserQuery innerJoinUserGame($relationAlias = null) Adds a INNER JOIN clause to the query using the UserGame relation
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneByEmail(string $user_email) Return the first User filtered by the user_email column
 * @method User findOneByPassword(string $user_password) Return the first User filtered by the user_password column
 * @method User findOneByFirstName(string $user_firstname) Return the first User filtered by the user_firstname column
 * @method User findOneByLastName(string $user_lastname) Return the first User filtered by the user_lastname column
 * @method User findOneByDateOfBirth(string $user_dateofbirth) Return the first User filtered by the user_dateofbirth column
 * @method User findOneByRank(string $user_rank) Return the first User filtered by the user_rank column
 * @method User findOneByMMR(int $user_mmr) Return the first User filtered by the user_mmr column
 * @method User findOneByRating(int $user_rating) Return the first User filtered by the user_rating column
 * @method User findOneByAbout(string $user_about) Return the first User filtered by the user_about column
 * @method User findOneByAvatar(string $user_avatar) Return the first User filtered by the user_avatar column
 * @method User findOneByCreated(string $user_created) Return the first User filtered by the user_created column
 * @method User findOneByActive(int $user_active) Return the first User filtered by the user_active column
 * @method User findOneByGodfatherId(int $user_godfather) Return the first User filtered by the user_godfather column
 * @method User findOneByConfirmationString(string $user_confirmation_string) Return the first User filtered by the user_confirmation_string column
 *
 * @method array findById(int $user_id) Return User objects filtered by the user_id column
 * @method array findByEmail(string $user_email) Return User objects filtered by the user_email column
 * @method array findByPassword(string $user_password) Return User objects filtered by the user_password column
 * @method array findByFirstName(string $user_firstname) Return User objects filtered by the user_firstname column
 * @method array findByLastName(string $user_lastname) Return User objects filtered by the user_lastname column
 * @method array findByDateOfBirth(string $user_dateofbirth) Return User objects filtered by the user_dateofbirth column
 * @method array findByRank(string $user_rank) Return User objects filtered by the user_rank column
 * @method array findByMMR(int $user_mmr) Return User objects filtered by the user_mmr column
 * @method array findByRating(int $user_rating) Return User objects filtered by the user_rating column
 * @method array findByAbout(string $user_about) Return User objects filtered by the user_about column
 * @method array findByAvatar(string $user_avatar) Return User objects filtered by the user_avatar column
 * @method array findByCreated(string $user_created) Return User objects filtered by the user_created column
 * @method array findByActive(int $user_active) Return User objects filtered by the user_active column
 * @method array findByGodfatherId(int $user_godfather) Return User objects filtered by the user_godfather column
 * @method array findByConfirmationString(string $user_confirmation_string) Return User objects filtered by the user_confirmation_string column
 *
 * @package    propel.generator..om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserQuery object.
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
            $modelName = 'Rdy4Racing\\Models\\User';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery(null, null, $modelAlias);

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
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 User A model object, or null if the key is not found
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
     * @return                 User A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `user_id`, `user_email`, `user_password`, `user_firstname`, `user_lastname`, `user_dateofbirth`, `user_rank`, `user_mmr`, `user_rating`, `user_about`, `user_avatar`, `user_created`, `user_active`, `user_godfather`, `user_confirmation_string` FROM `user` WHERE `user_id` = :p0';
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
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return User|User[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::USER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE user_id = 1234
     * $query->filterById(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE user_id >= 12
     * $query->filterById(array('max' => 12)); // WHERE user_id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserPeer::USER_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserPeer::USER_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE user_email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE user_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the user_password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE user_password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE user_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the user_firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE user_firstname = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE user_firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_FIRSTNAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the user_lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE user_lastname = 'fooValue'
     * $query->filterByLastName('%fooValue%'); // WHERE user_lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_LASTNAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the user_dateofbirth column
     *
     * Example usage:
     * <code>
     * $query->filterByDateOfBirth('2011-03-14'); // WHERE user_dateofbirth = '2011-03-14'
     * $query->filterByDateOfBirth('now'); // WHERE user_dateofbirth = '2011-03-14'
     * $query->filterByDateOfBirth(array('max' => 'yesterday')); // WHERE user_dateofbirth > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateOfBirth The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByDateOfBirth($dateOfBirth = null, $comparison = null)
    {
        if (is_array($dateOfBirth)) {
            $useMinMax = false;
            if (isset($dateOfBirth['min'])) {
                $this->addUsingAlias(UserPeer::USER_DATEOFBIRTH, $dateOfBirth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateOfBirth['max'])) {
                $this->addUsingAlias(UserPeer::USER_DATEOFBIRTH, $dateOfBirth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_DATEOFBIRTH, $dateOfBirth, $comparison);
    }

    /**
     * Filter the query on the user_rank column
     *
     * Example usage:
     * <code>
     * $query->filterByRank('fooValue');   // WHERE user_rank = 'fooValue'
     * $query->filterByRank('%fooValue%'); // WHERE user_rank LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rank The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserPeer::USER_RANK, $rank, $comparison);
    }

    /**
     * Filter the query on the user_mmr column
     *
     * Example usage:
     * <code>
     * $query->filterByMMR(1234); // WHERE user_mmr = 1234
     * $query->filterByMMR(array(12, 34)); // WHERE user_mmr IN (12, 34)
     * $query->filterByMMR(array('min' => 12)); // WHERE user_mmr >= 12
     * $query->filterByMMR(array('max' => 12)); // WHERE user_mmr <= 12
     * </code>
     *
     * @param     mixed $mMR The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByMMR($mMR = null, $comparison = null)
    {
        if (is_array($mMR)) {
            $useMinMax = false;
            if (isset($mMR['min'])) {
                $this->addUsingAlias(UserPeer::USER_MMR, $mMR['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mMR['max'])) {
                $this->addUsingAlias(UserPeer::USER_MMR, $mMR['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_MMR, $mMR, $comparison);
    }

    /**
     * Filter the query on the user_rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE user_rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE user_rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE user_rating >= 12
     * $query->filterByRating(array('max' => 12)); // WHERE user_rating <= 12
     * </code>
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(UserPeer::USER_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(UserPeer::USER_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the user_about column
     *
     * Example usage:
     * <code>
     * $query->filterByAbout('fooValue');   // WHERE user_about = 'fooValue'
     * $query->filterByAbout('%fooValue%'); // WHERE user_about LIKE '%fooValue%'
     * </code>
     *
     * @param     string $about The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAbout($about = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($about)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $about)) {
                $about = str_replace('*', '%', $about);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_ABOUT, $about, $comparison);
    }

    /**
     * Filter the query on the user_avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE user_avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%'); // WHERE user_avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avatar)) {
                $avatar = str_replace('*', '%', $avatar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the user_created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE user_created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE user_created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE user_created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(UserPeer::USER_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(UserPeer::USER_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the user_active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(1234); // WHERE user_active = 1234
     * $query->filterByActive(array(12, 34)); // WHERE user_active IN (12, 34)
     * $query->filterByActive(array('min' => 12)); // WHERE user_active >= 12
     * $query->filterByActive(array('max' => 12)); // WHERE user_active <= 12
     * </code>
     *
     * @param     mixed $active The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(UserPeer::USER_ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(UserPeer::USER_ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the user_godfather column
     *
     * Example usage:
     * <code>
     * $query->filterByGodfatherId(1234); // WHERE user_godfather = 1234
     * $query->filterByGodfatherId(array(12, 34)); // WHERE user_godfather IN (12, 34)
     * $query->filterByGodfatherId(array('min' => 12)); // WHERE user_godfather >= 12
     * $query->filterByGodfatherId(array('max' => 12)); // WHERE user_godfather <= 12
     * </code>
     *
     * @see       filterByUserRelatedByGodfatherId()
     *
     * @param     mixed $godfatherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByGodfatherId($godfatherId = null, $comparison = null)
    {
        if (is_array($godfatherId)) {
            $useMinMax = false;
            if (isset($godfatherId['min'])) {
                $this->addUsingAlias(UserPeer::USER_GODFATHER, $godfatherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($godfatherId['max'])) {
                $this->addUsingAlias(UserPeer::USER_GODFATHER, $godfatherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_GODFATHER, $godfatherId, $comparison);
    }

    /**
     * Filter the query on the user_confirmation_string column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmationString('fooValue');   // WHERE user_confirmation_string = 'fooValue'
     * $query->filterByConfirmationString('%fooValue%'); // WHERE user_confirmation_string LIKE '%fooValue%'
     * </code>
     *
     * @param     string $confirmationString The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByConfirmationString($confirmationString = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($confirmationString)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $confirmationString)) {
                $confirmationString = str_replace('*', '%', $confirmationString);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USER_CONFIRMATION_STRING, $confirmationString, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByGodfatherId($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserPeer::USER_GODFATHER, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::USER_GODFATHER, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByGodfatherId() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByGodfatherId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUserRelatedByGodfatherId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByGodfatherId');

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
            $this->addJoinObject($join, 'UserRelatedByGodfatherId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByGodfatherId relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByGodfatherIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByGodfatherId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByGodfatherId', '\Rdy4Racing\Models\UserQuery');
    }

    /**
     * Filter the query by a related Driver object
     *
     * @param   Driver|PropelObjectCollection $driver  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDriver($driver, $comparison = null)
    {
        if ($driver instanceof Driver) {
            return $this
                ->addUsingAlias(UserPeer::USER_ID, $driver->getUserId(), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedById($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserPeer::USER_ID, $user->getGodfatherId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            return $this
                ->useUserRelatedByIdQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserRelatedById() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUserRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedById');

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
            $this->addJoinObject($join, 'UserRelatedById');
        }

        return $this;
    }

    /**
     * Use the UserRelatedById relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Rdy4Racing\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedById', '\Rdy4Racing\Models\UserQuery');
    }

    /**
     * Filter the query by a related UserGame object
     *
     * @param   UserGame|PropelObjectCollection $userGame  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserGame($userGame, $comparison = null)
    {
        if ($userGame instanceof UserGame) {
            return $this
                ->addUsingAlias(UserPeer::USER_ID, $userGame->getUserId(), $comparison);
        } elseif ($userGame instanceof PropelObjectCollection) {
            return $this
                ->useUserGameQuery()
                ->filterByPrimaryKeys($userGame->getPrimaryKeys())
                ->endUse();
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
     * @return UserQuery The current query, for fluid interface
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
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::USER_ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
