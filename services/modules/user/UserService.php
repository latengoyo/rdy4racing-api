<?php 

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\User\Manager;
use Rdy4Racing\Services\Objects\User;

class UserService {
	
	/**
	 * @var ConfigurationManager
	 */
	protected $config;
	
	/**
	 * @var UserManager
	 */
	protected $manager;
	
	
	public function __construct(Configuration $config) {
		$this->config=$config;
		$this->manager=new Manager();
	}
	
	/**
	 * Checks if an email is already used
	 * 
	 * @param string $email
	 * @return boolean
	 */
	public function emailExists ($email) {
		try {
			return $this->manager->emailExists($email);
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	public function confirmEmail ($email, $confirmationString) {
		try {
			$userModel=$this->manager->confirmEmail($email, $confirmationString);
			$user=new User();
			$user->import($userModel);
			return $user;
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Logs in the user and returns the User ID
	 * 
	 * @param string $email
	 * @param string $password
	 * @return Rdy4Racing\Services\Objects\User
	 */
	public function login ($email,$password) {
		try {
			$userModel=$this->manager->login($email, $password);
			$user=new User();
			$user->import($userModel);
			return user;
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Creates a new user
	 * 
	 * @param Rdy4Racing\Services\Objects\User $user
	 * @return Rdy4Racing\Services\Objects\User
	 */
	public function addUser (User $user) {
		try {
			$userModel=$user->export();
			$this->manager->addUser($userModel);
			$user->import($userModel);
			return $user;
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Registers a game for a user
	 * 
	 * @param int $userId
	 * @param int $gameId
	 * @param string $driver
	 * @return boolean
	 * @throws Exception
	 */
	public function registerGame ($userId,$gameId,$driver) {
		try {
			$this->manager->registerGame($userId, $gameId, $driver);
			return true;
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
}