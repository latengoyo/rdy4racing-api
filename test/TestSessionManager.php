<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';
require_once '../services/modules/game/GameService.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Manager;
use Rdy4Racing\Modules\Session\Type;
use Rdy4Racing\Models\SessionQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Modules\Session\State;
use Rdy4Racing\Models\GameQuery;


/**
 * test case.
 */
class TestSessionManager extends PHPUnit_Framework_TestCase {

	protected $config;
	protected $data=array();

	/**
	 * Prepares the environment before running a test.
	*/
	protected function setUp() {
		parent::setUp ();
		$this->removeData();
	}

	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->removeData();
		parent::tearDown ();
	}

	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		$this->config=new Configuration();
	}
	
	
	public function testGetSessionWithInvalidId () {
		$sessionModel=$this->createSessionModel();
		$id=$sessionModel->getId()+1000;
		try {
			$manager=new Manager();
			$session=$manager->getSession($id);
		} catch (Exception $e) {
			$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Exception', $e);
			return ;
		}
		$this->fail('An expected exception has not been raised');
	}
	
	public function testGetSessionPractice() {
		$sessionModel=$this->createSessionModel();
		$manager=new Manager();
		$session=$manager->getSession($sessionModel->getId());
		
		$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Type\\Practice', $session);
		$this->assertEquals(Type::PRACTICE, $session->getType());
		$this->assertEquals(State::OPEN, $session->getState());
	}
	
	
	public function testCreateSessionPractice () {
		$game=GameQuery::create()->findOneByCode('RFACTOR2');
		$manager=new Manager();
		$session=$manager->createSession($game->getId(),Type::PRACTICE,__CLASS__);
		
		$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Type\\Practice', $session);
		$this->assertEquals(Type::PRACTICE, $session->getType());
		$this->assertEquals(State::SCHEDULED, $session->getState());
	}
	
	/*
	 * DATA CREATION AND REMOVAL 
	 */
	
	protected function createSessionModel () {
		$game=GameQuery::create()->findOneByCode('RFACTOR2');
		$sessionModel=new Session();
		$sessionModel->setDescription(__CLASS__)
			->setGameId($game->getId())
			->setTypeId(Type::PRACTICE)
			->setStateId(State::OPEN)
			->save();
		return $sessionModel;
	}
	
	protected function removeData () {
		$sessions=SessionQuery::create()->findByDescription(__CLASS__);
		$sessions->delete();
	}
	
}