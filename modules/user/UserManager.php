<?php

namespace Rdy4Racing\Modules\User;

use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserQuery;
use Rdy4Racing\Helpers\UUIDHelper;
use Rdy4Racing\Models\UserGame;
use Rdy4Racing\Models\UserGameQuery;
use Rdy4Racing\Modules\Game\GameManager;

/**
 * User Manager
 * 
 * User functions
 * 
 * @author alex
 */
class UserManager {
	
	
	/**
	 * Adds a new user
	 * 
	 * Expects a plain password, it will get encrypted in this function
	 * 
	 * @param User $user
	 * @throws UserManagerException
	 */
	public function addUser (User $user) {
		try {
			// validate data
			if ($this->emailExists($user->getEmail())) {
				throw new UserManagerException('An user with the email '.$user->getEmail().' already exists');
			}
			if (!$user->validate()) {
				throw new UserManagerException('User validation failed');
			}

			// encrypt password
			$user->setPassword(crypt($user->getPassword()));
			
			// add a confirmation string
			$user->setConfirmationString(UUIDHelper::generate());
			
			$user->save();
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Check if an email already exists
	 * 
	 * @param string $email
	 * @return boolean
	 */
	public function emailExists ($email) {
		$userCount=UserQuery::create()->filterByEmail($email)->count();
		return ($userCount > 0);
	}
	
	/**
	 * Logs in a user
	 * 
	 * @param string $email
	 * @param string $password
	 * @return User
	 * @throws UserLoginException
	 */
	public function login ($email,$password) {
		$user=UserQuery::create()->filterByEmail($email)->findOne();
		if (!$user) {
			throw new UserLoginException('User with email '.$email.' does not exist');
		}
		if ($user->getActive()==0) {
			throw new UserLoginException('User with email '.$email.' is not active');
		}
		if (crypt($password,$user->getPassword())!=$user->getPassword()) {
			throw new UserLoginException('Password is invalid');
		}
		return $user;
	}
	
	/**
	 * Confirms an email setting the active flag to 1
	 * 
	 * @param string $email
	 * @param string $confirmationString
	 * @return User
	 */
	public function confirmEmail ($email,$confirmationString) {
		$user=UserQuery::create()->filterByEmail($email)->findOne();
		if ($confirmationString==$user->getConfirmationString()) {
			$user->setActive(1)->save();
		}
		return $user;
	}
	
	/**
	 * Registers a game for a user
	 * 
	 * @param int $userId
	 * @param int $gameId
	 * @param string $driver
	 */
	public function registerGame ($userId,$gameId,$driver) {
		$gameManager=new GameManager();
		if ($gameManager->driverExists($gameId, $driver)) {
			throw new UserManagerException('Driver '.$driver.' already exists');
		}
		
		if (!$this->userGameExists($userId, $gameId)) {
			$userGame=new UserGame();
			$userGame->setUserId($userId);
			$userGame->setGameId($gameId);
			$userGame->setDriver($driver);
			$userGame->save();
		}
	}
	
	/**
	 * Checks if a user has registered a game
	 * 
	 * @param int $userId
	 * @param int $gameId
	 * @return boolean
	 */
	public function userGameExists ($userId,$gameId) {
		return UserGameQuery::create()->filterByUserId($userId)->filterByGameId($gameId)->count();
	}
	
}