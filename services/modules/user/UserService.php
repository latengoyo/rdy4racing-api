<?php 

use Rdy4Racing\Models\User;
use Rdy4Racing\Modules\ConfigurationManager;

class UserService {
	
	/**
	 * @var ConfigurationManager
	 */
	protected $config;
	
	public function __construct(ConfigurationManager $config) {
		$this->config=$config;
	}
	
	/**
	 * Logs in the user and returns the User ID
	 * 
	 * @param string $email
	 * @param string $password
	 * @return Rdy4Racing\Models\User
	 */
	public function login ($email,$password) {
		return true;
	}
	
	/**
	 * Creates a new user
	 * 
	 * @param Rdy4Racing\Models\User $user
	 * @return Rdy4Racing\Models\User
	 */
	public function addUser (User $user) {
		return $user;
	}
}