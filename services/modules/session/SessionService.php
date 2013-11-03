<?php 

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Manager;
use Rdy4Racing\Services\Objects\Session;
use Rdy4Racing\Models\UserQuery;
use Rdy4Racing\Services\Exception;
use Rdy4Racing\Services\Objects\Driver;


class SessionService {
	
	/**
	 * @var ConfigurationManager
	 */
	protected $config;
	
	public function __construct(Configuration $config) {
		$this->config=$config;
	}
	
	/**
	 * Gets a session by Id
	 * 
	 * @param int $id
	 * @return \Rdy4Racing\Services\Objects\Session
	 */
	public function get ($sessionId) {
		try {
			$manager=new Manager();
			$session=$manager->getSession($sessionId);
			$sessionObj=new Session();
			$sessionObj->import($session->getModel());
			return $sessionObj;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Creates a new session
	 *
	 * @param int $game
	 * @param int $type
	 * @param string $description
	 * @return \Rdy4Racing\Services\Objects\Session
	 */
	public function create ($game,$type,$descpription) {
		try {
			$manager=new Manager();
			$session=$manager->createSession($game, $type,$descpription);
			$sessionObj=new Session();
			$sessionObj->import($session->getModel());
			return $sessionObj;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Changes the state of a session
	 *
	 * @param int $session
	 * @param int $state
	 * @return \Rdy4Racing\Services\Objects\Session
	 */
	public function changeState ($sessionId,$state) {
		try {
			$manager=new Manager();
			$session=$manager->getSession($sessionId);
			$session->setState($state);
			$sessionObj=new Session();
			$sessionObj->import($session->getModel());
			return $sessionObj;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Joins a user to a session, creating a new driver
	 * 
	 * @param int $sessionId
	 * @param int $userId
	 * @throws Exception
	 * @return \Rdy4Racing\Services\Objects\Driver
	 */
	public function join ($sessionId,$userId) {
		try {
			$user=UserQuery::create()->get($userId);
			if (!$user) {
				throw new Exception('User not found');
			}
			$manager=new Manager();
			$session=$manager->getSession($sessionId);
			$driver=$session->join($user);
			$driverObj=new Driver();
			$driverObj->import($driver);
			return $driverObj;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
}