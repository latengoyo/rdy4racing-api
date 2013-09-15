<?php 

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\GameModQuery;
use Rdy4Racing\Services\Objects\GameMod;
use Rdy4Racing\Services\Objects\Game;
use Rdy4Racing\Modules\Game\Manager;

class GameService {
	
	/**
	 * @var ConfigurationManager
	 */
	protected $config;
	
	/**
	 * 
	 * @var Manager
	 */
	protected $manager;
	
	public function __construct(Configuration $config) {
		$this->config=$config;
	}
	
	/**
	 * Return the list of games
	 * 
	 * @return Rdy4Racing\Services\Objects\Game[]
	 */
	public function getGames () {
		try {
			$games=array();
			$gameModels=GameQuery::create()->find();
			foreach ($gameModels as $gameModel) {
				$game=new Game();
				$game->import($gameModel);
				$games[]=$game;
			}
			return $games;
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Return the list of mods for a game
	 *
	 * @param int $gameId
	 * @return Rdy4Racing\Services\Objects\GameMod[]
	 */
	public function getGameMods ($gameId) {
		try {
			$gameMods=array();
			$gameModModels=GameModQuery::create()->findByGameId($gameId);
			foreach ($gameModModels as $gameModModel) {
				$gameMod=new GameMod();
				$gameMod->import($gameModModel);
				$gameMods[]=$gameMod;
			}
			return $gameMods;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Checks if a driver name already exists for the game
	 * 
	 * @param int $gameId
	 * @param string $driver
	 * @throws Exception
	 * @return boolean
	 */
	public function driverExists ($gameId, $driver) {
		try {
			return $this->manager->driverExists($gameId, $driver);
		} catch (\Exception $e) {
			throw $e;
		}
	}

}