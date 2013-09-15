<?php

namespace Rdy4Racing\Modules\Game;

use Rdy4Racing\Models\UserGameQuery;

/**
 * Game Manager
 * 
 * Game functions
 * 
 * @author alex
 */
class Manager {
	
	/**
	 * Checks if a user has registered a game
	 * 
	 * @param int $gameId
	 * @param string $driver
	 * @return boolean
	 */
	public function driverExists ($gameId,$driver) {
		return UserGameQuery::create()->filterByGameId($gameId)->filterByDriver($driver)->count();
	}
	
}