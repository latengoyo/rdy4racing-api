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
use Rdy4Racing\Models\UserQuery;
use Rdy4Racing\Models\DriverQuery;
use Rdy4Racing\Models\UserGameQuery;
use Rdy4Racing\Models\Game;
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserGame;

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
	
	public function testJoinWithStateCompleted () {
		$user=$this->getMock('\Rdy4Racing\Models\User');
		$sessionModel=$this->getMock('\Rdy4Racing\Models\Session');
		$sessionModel->expects($this->any())
			->method('getTypeId')
			->will($this->returnValue(Type::RACE));
		$sessionModel->expects($this->any())
			->method('getStateId')
			->will($this->returnValue(State::COMPLETED));
		try {
			$session=new Race($sessionModel);
			$session->join($user);
		} catch (Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testJoinWithStateFinished () {
		$user=$this->getMock('\Rdy4Racing\Models\User');
		$sessionModel=$this->getMock('\Rdy4Racing\Models\Session');
		$sessionModel->expects($this->any())
			->method('getTypeId')
			->will($this->returnValue(Type::RACE));
		$sessionModel->expects($this->any())
			->method('getStateId')
			->will($this->returnValue(State::FINISHED));
		try {
			$session=new Race($sessionModel);
			$session->join($user);
		} catch (Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testJoinWithStateRacing () {
		$user=$this->getMock('\Rdy4Racing\Models\User');
		$sessionModel=$this->getMock('\Rdy4Racing\Models\Session');
		$sessionModel->expects($this->any())
			->method('getTypeId')
			->will($this->returnValue(Type::RACE));
		$sessionModel->expects($this->any())
			->method('getStateId')
			->will($this->returnValue(State::RACING));
		try {
			$session=new Race($sessionModel);
			$session->join($user);
		} catch (Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testJoinWithStateClosed () {
		$user=$this->getMock('\Rdy4Racing\Models\User');
		$sessionModel=$this->getMock('\Rdy4Racing\Models\Session');
		$sessionModel->expects($this->any())
			->method('getTypeId')
			->will($this->returnValue(Type::RACE));
		$sessionModel->expects($this->any())
			->method('getStateId')
			->will($this->returnValue(State::CLOSED));
		try {
			$session=new Race($sessionModel);
			$session->join($user);
		} catch (Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testJoinFailsWithoutRegisteredGameDriver () {
		$game=$this->getGame();
		$game->save();
		$user=$this->getUser();
		$user->save();
		$userGame=$this->getUserGame($user, $game);
		$userGame->save();
	
		$gameRF2=GameQuery::create()->findOneByCode('RFACTOR2');
		$sessionModel=$this->createSessionModel();
		$sessionModel->setGameId($gameRF2->getId())
			->setStateId(State::SCHEDULED)
			->save();
		try {
			$session=new Race($sessionModel);
			$session->join($user);
		} catch (Exception $e) {
			$this->assertInstanceOf('\Rdy4Racing\Modules\Session\Exception', $e);
			// get drivers
			$drivers=DriverQuery::create()->filterBySessionId($session->getModel()->getId());
			$this->assertEquals(0,$drivers->count());
			return;
		}
		$this->fail('An expected exception has not been thrown');
	}
	
	public function testJoinWithStateScheduled () {
		$game=$this->getGame();
		$game->save();
		$user=$this->getUser();
		$user->save();
		$userGame=$this->getUserGame($user, $game);
		$userGame->save();
	
		$sessionModel=$this->createSessionModel();
		$sessionModel->setGameId($game->getId())
			->setStateId(State::SCHEDULED)
			->save();
		$session=new Race($sessionModel);
		$session->join($user);
	
		// get drivers
		$drivers=DriverQuery::create()->filterBySessionId($session->getModel()->getId());
	
		$this->assertEquals(1,$drivers->count());
	
		$driver=$drivers->findOne();
		$this->assertEquals($userGame->getId(), $driver->getUserGameId());
		$this->assertEquals($session->getModel()->getId(), $driver->getSessionId());
		$this->assertEquals($user->getRank(), $driver->getRank());
		$this->assertEquals($user->getRating(), $driver->getRatingStart());
		$this->assertEquals($user->getMMR(), $driver->getMMRStart());
		$this->assertEmpty($driver->getRatingEnd());
		$this->assertEmpty($driver->getMMREnd());
	}
	
	
	/*
	 * DATA CREATION AND REMOVAL
	*/
	
	protected function getUser() {
		$user=new User();
		$user->setEmail('test@test.com')
			->setPassword('test')
			->setFirstName('User')
			->setLastName('Test')
			->setRank('R')
			->setRating('1000')
			->setMMR('1500');
		return $user;
	}
	
	protected function getGame() {
		$game=new Game();
		$game->setName(__CLASS__);
		$game->setCode('TEST');
		return $game;
	}
	
	protected function getUserGame(Rdy4Racing\Models\User $user,Rdy4Racing\Models\Game $game) {
		$userGame=new UserGame();
		$userGame->setUserId($user->getId())
			->setGameId($game->getId())
			->setDriverName(__METHOD__);
		return $userGame;
	}
	
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
		$users=UserQuery::create()->findByEmail('%@test.com');
		$games=GameQuery::create()->findByCode('TEST');
		$sessions=SessionQuery::create()->findByDescription(__CLASS__);
		$drivers=DriverQuery::create()->filterBySession($sessions)->delete();
		$userGameQuery=UserGameQuery::create()->filterByUser($users)->filterByGame($games)->delete();
		$sessions->delete();
		$games->delete();
		$users->delete();
	}
}
