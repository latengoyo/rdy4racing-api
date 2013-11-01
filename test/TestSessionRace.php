<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';
require_once '../services/modules/game/GameService.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Type\Race;
use Rdy4Racing\Modules\Session\Type;
use Rdy4Racing\Modules\Session\State;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionQuery;

/**
 * test case.
 */
class TestSessionRace extends PHPUnit_Framework_TestCase {
	
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

	
	public function testSessionConstructFailsWhenTypeIsNotValid () {
		$sessionModel=$this->createSessionModel();
		$sessionModel->setTypeId(Type::PRACTICE)->save();
		try {
			$session=new Race($sessionModel);
		} catch (Exception $e) {
			$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Exception', $e);
			return ;
		}
		$this->fail('An expected exception has not been raised');
	}
	
	public function testSessionConstructFailsWhenStateIsNotValid () {
		$sessionModel=$this->createSessionModel();
		$sessionModel->setStateId(State::OPEN)->save();
		try {
			$session=new Race($sessionModel);
		} catch (Exception $e) {
			$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Exception', $e);
			return ;
		}
		$this->fail('An expected exception has not been raised');
	}
	
	public function testSessionType () {
		$session=new Race($this->createSessionModel());
		$this->assertEquals(Type::RACE,$session->getType());
	}
	
	public function testSetStateToScheduled () {
		$session=new Race($this->createSessionModel());
		$this->assertEquals(State::SCHEDULED, $session->getState());
	}
	public function testSetStateFromScheduledToClosed () {
		$session=new Race($this->createSessionModel());
		$session->setState(State::CLOSED);
		$this->assertEquals(State::CLOSED, $session->getState());
	}
	
	public function testSetStateToCompleted () {
		$session=new Race($this->createSessionModel());
		$session->setState(State::CLOSED);
		$session->setState(State::RACING);
		$session->setState(State::FINISHED);
		$session->setState(State::COMPLETED);
		$this->assertEquals(State::COMPLETED, $session->getState());
	}
	
	public function testSetStateFailsWithStateClosed () {
		try {
			$session=new Race($this->createSessionModel());
			$session->setState(State::OPEN);
		} catch (\Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			$this->assertNotEquals(State::OPEN, $session->getState());
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testSetStateFailsWhenLoweringState () {
		try {
			$sessionModel=$this->createSessionModel();
			$sessionModel->setStateId(State::COMPLETED)->save();
			$session=new Race($sessionModel);
			$session->setState(State::SCHEDULED);
		} catch (\Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			$this->assertEquals(State::COMPLETED, $session->getState());
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testSetStateFailsWhenSkippingState () {
		try {
			$session=new Race($this->createSessionModel());
			$session->setState(State::SCHEDULED);
			$session->setState(State::COMPLETED);
		} catch (\Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			$this->assertEquals(State::SCHEDULED, $session->getState());
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	
	/*
	 * DATA CREATION AND REMOVAL
	*/
	
	protected function createSessionModel () {
		$game=GameQuery::create()->findOneByCode('RFACTOR2');
		$sessionModel=new Session();
		$sessionModel->setDescription(__CLASS__)
		->setGameId($game->getId())
		->setTypeId(Type::RACE)
		->setStateId(State::SCHEDULED)
		->save();
		return $sessionModel;
	}
	
	protected function removeData () {
		$sessions=SessionQuery::create()->findByDescription(__CLASS__);
		$sessions->delete();
	}
}
