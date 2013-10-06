<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';
require_once '../services/modules/game/GameService.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Type\Race;
use Rdy4Racing\Modules\Session\Type;
use Rdy4Racing\Modules\Session\State;

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

	public function testSessionType () {
		$session=new Race();
		$this->assertEquals(Type::RACE,$session->getType());
	}
	
	public function testSetStateToScheduled () {
		$session=new Race();
		$session->setState(State::SCHEDULED);
		$this->assertEquals(State::SCHEDULED, $session->getState());
	}
	
	public function testSetStateToCompleted () {
		$session=new Race();
		$session->setState(State::COMPLETED);
		$this->assertEquals(State::COMPLETED, $session->getState());
	}
	
	public function testSetStateFromScheduledToClosed () {
		$session=new Race();
		$session->setState(State::SCHEDULED);
		$session->setState(State::CLOSED);
		$this->assertEquals(State::CLOSED, $session->getState());
	}
	
	public function testSetStateFailsWithStateClosed () {
		try {
			$session=new Race();
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
			$session=new Race();
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
			$session=new Race();
			$session->setState(State::SCHEDULED);
			$session->setState(State::COMPLETED);
		} catch (\Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			$this->assertEquals(State::SCHEDULED, $session->getState());
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
}
