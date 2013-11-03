<?php 

namespace Rdy4Racing\Modules\Session;

use Rdy4Racing\Models\Driver;
use Rdy4Racing\Models\User;

/**
 * Interface for sessions
 * 
 * @author alex
 */
interface ISession {

	/**
	 * @return int
	 */
	public function getType ();
	
	/**
	 * @return int
	 */
	public function getState ();
	
	/**
	 * Returns an array of valid states for the session
	 * 
	 * @return array
	 */
	public function getValidStates ();
	
	/**
	 * Checks if a type is valid for the session
	 *
	 * @param int $type
	 * @return boolean
	 */
	public function isValidType ($type);
	
	/**
	 * Checks if a state is valid for the session
	 *
	 * @param int $state
	 * @return boolean
	 */
	public function isValidState ($state);

	/**
	 * Sets the state for the session
	 * 
	 * @param int $state
	 * @throws Exception
	 */
	public function setState ($state);
	
	
	/**
	 * Joins a user to a new session
	 * 
	 * @param User $user
	 * @return Driver
	 * @throws Exception
	 */
	public function join (User $user);
	
	/**
	 * Returns the list of required mods for a session
	 * 
	 * @return \PropelCollection
	 */
	public function getRequiredMods ();
	
	/**
	 * Launch intances
	 * 
	 * @return \PropelCollection
	 */
	public function launchInstances ();
}