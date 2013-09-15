<?php 

namespace Rdy4Racing\Modules\Session;

use Rdy4Racing\Models\User;
use Rdy4Racing\Modules\Sesssion\Exception;


/**
 * Interface for sessions
 * 
 * @author alex
 */
interface ISession {

	/**
	 * Joins a user to a new session
	 * 
	 * @param User $user
	 * @return boolean
	 * @throws Exception
	 */
	public function join (User $user);
	
	
}