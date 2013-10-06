<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';
require_once '../services/modules/game/GameService.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\Session\Type\Practice;
use Rdy4Racing\Modules\Session\Type;
use Rdy4Racing\Modules\Session\State;

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
		$session=new Practice();
		$this->assertEquals(Type::PRACTICE,$session->getType());
	}
	
	public function testSetStateToScheduled () {
		$session=new Practice();
		$session->setState(State::SCHEDULED);
		$this->assertEquals(State::SCHEDULED, $session->getState());
	}
	
	public function testSetStateToCompleted () {
		$session=new Practice();
		$session->setState(State::COMPLETED);
		$this->assertEquals(State::COMPLETED, $session->getState());
	}
	
	public function testSetStateFromScheduledToOpen () {
		$session=new Practice();
		$session->setState(State::SCHEDULED);
		$session->setState(State::OPEN);
		$this->assertEquals(State::OPEN, $session->getState());
	}
	
	public function testSetStateFailsWithStateClosed () {
		try {
			$session=new Practice();
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
			$session=new Practice();
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
			$session=new Practice();
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
