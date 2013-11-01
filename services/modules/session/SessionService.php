<?php 

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Manager;
use Rdy4Racing\Services\Objects\Session;


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
	public function get ($id) {
		try {
			$manager=new Manager();
			$session=$manager->getSession($id);
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
	public function changeState ($id,$state) {
		try {
			$manager=new Manager();
			$session=$manager->getSession($id);
			$session->setState($state);
			$sessionObj=new Session();
			$sessionObj->import($session->getModel());
			return $sessionObj;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
}