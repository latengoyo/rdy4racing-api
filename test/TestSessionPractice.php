<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';
require_once '../services/modules/game/GameService.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Type\Practice;
use Rdy4Racing\Modules\Session\Type;
use Rdy4Racing\Modules\Session\State;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\Session;
use Rdy4Racing\Models\SessionQuery;

/**
 * test case.
 */
class TestSessionPractice extends PHPUnit_Framework_TestCase {
	
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
		$sessionModel->setTypeId(Type::RACE)->save();
		try {
			$session=new Practice($sessionModel);
		} catch (Exception $e) {
			$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Exception', $e);
			return ;
		}
		$this->fail('An expected exception has not been raised');
	}
	
	public function testSessionConstructFailsWhenStateIsNotValid () {
		$sessionModel=$this->createSessionModel();
		$sessionModel->setStateId(State::RACING)->save();
		try {
			$session=new Practice($sessionModel);
		} catch (Exception $e) {
			$this->assertInstanceOf('\\Rdy4Racing\\Modules\\Session\\Exception', $e);
			return ;
		}
		$this->fail('An expected exception has not been raised');
	}
	
	public function testSessionType () {
		$session=new Practice($this->createSessionModel());
		$this->assertEquals(Type::PRACTICE,$session->getType());
	}
	
	public function testSetStateToScheduled () {
		$session=new Practice($this->createSessionModel());
		$this->assertEquals(State::SCHEDULED, $session->getState());
	}
	
	public function testSetStateFromScheduledToOpen () {
		$session=new Practice($this->createSessionModel());
		$session->setState(State::OPEN);
		$this->assertEquals(State::OPEN, $session->getState());
	}
	
	public function testSetStateToCompleted () {
		$session=new Practice($this->createSessionModel());
		$session->setState(State::OPEN);
		$session->setState(State::FINISHED);
		$session->setState(State::COMPLETED);
		$this->assertEquals(State::COMPLETED, $session->getState());
	}
	
	public function testSetStateFailsWithStateClosed () {
		try {
			$session=new Practice($this->createSessionModel());
			$session->setState(State::CLOSED);
		} catch (\Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			$this->assertNotEquals(State::CLOSED, $session->getState());
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testSetStateFailsWhenLoweringState () {
		try {
			$sessionModel=$this->createSessionModel();
			$sessionModel->setStateId(State::COMPLETED)->save();
			$session=new Practice($sessionModel);
			$session->setState(State::COMPLETED);
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
			$session=new Practice($this->createSessionModel());
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
			->setTypeId(Type::PRACTICE)
			->setStateId(State::SCHEDULED)
			->save();
		return $sessionModel;
	}
	
	protected function removeData () {
		$sessions=SessionQuery::create()->findByDescription(__CLASS__);
		$sessions->delete();
	}
}
