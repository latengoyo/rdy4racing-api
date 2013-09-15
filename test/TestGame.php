<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';
require_once '../services/modules/game/GameService.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\GameModQuery;

/**
 * test case.
 */
class TestGame extends PHPUnit_Framework_TestCase {
	
	protected $config;
	protected $data=array();
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		$this->config=new Configuration();
	}

	public function testGetGames() {
		$gameModels=GameQuery::create()->find();
		$gameService=new GameService($this->config);
		$games=$gameService->getGames();
		
		$this->assertEquals($gameModels->count(), count($games));
		foreach ($gameModels as $i=>$gameModel) {
			$this->assertEquals($gameModel->getId(), $games[$i]->id);
			$this->assertEquals($gameModel->getName(), $games[$i]->name);
		}
	}
	
	public function testGetGameMods() {
		$gameModModels=GameModQuery::create()->findByGameId(1);
		$gameService=new GameService($this->config);
		$gameMods=$gameService->getGameMods(1);
		$this->assertEquals($gameModModels->count(), count($gameMods));
	}
}
