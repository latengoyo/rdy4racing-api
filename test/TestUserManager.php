<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Modules\User\Manager;
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserQuery;
use Rdy4Racing\Models\Game;
use Rdy4Racing\Models\GameQuery;
use Rdy4Racing\Models\UserGame;
use Rdy4Racing\Models\UserGameQuery;

/**
 * test case.
 */
class TestUserManager extends PHPUnit_Framework_TestCase {
	
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
	
	public function testUserAdd () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$this->assertNotEmpty($user->getId());
	}
	
	public function testCheckEmailDoesNotExist () {
		$user=$this->getUser();
		$userManager=new Manager();
		$this->assertFalse($userManager->emailExists($user->getEmail()));
	}
	
	public function testCheckEmailExists () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$this->assertTrue($userManager->emailExists($user->getEmail()));
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\UserException
	 */
	public function testUserAddUserTwice () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userManager->addUser($user);
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\UserException
	 */
	public function testUserWithoutEmail () {
		$user=$this->getUser();
		$user->setEmail('');
		$userManager=new Manager();
		$userManager->addUser($user);
	}
	
	public function testUserAddEncryptsPassword () {
		$user=$this->getUser();
		$userPasswordBefore=$user->getPassword();
		$userManager=new Manager();
		$userManager->addUser($user);
		$this->assertNotEquals($userPasswordBefore, $user->getPassword(), 'Checking password is different');
		$this->assertEquals($user->getPassword(),crypt($userPasswordBefore,$user->getPassword()),'Checking password encryption');
	}
	
	public function testUserAddConfirmationStringIsCreated () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$this->assertNotEmpty($user->getConfirmationString());
	}
	
	public function testUserLoginRetunsUserInstance () {
		$user=$this->getUser();
		$user->setActive(1);
		$userPasswordBefore=$user->getPassword();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userLogin=$userManager->login($user->getEmail(),$userPasswordBefore);
		$this->assertInstanceOf('Rdy4Racing\\Models\\User', $userLogin);
		$this->assertEquals($user->getId(), $userLogin->getId());
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\LoginException
	 */
	public function testUserLoginWithInvalidEmail () {
		$userManager=new Manager();
		$userManager->login('invalid','invalid');
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\LoginException
	 */
	public function testUserLoginWithInvalidPassword () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userManager->login($user->getEmail(),'invalid');
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\LoginException
	 */
	public function testUserLoginWithoutActiveFlag () {
		$user=$this->getUser();
		$userPasswordBefore=$user->getPassword();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userLogin=$userManager->login($user->getEmail(),$userPasswordBefore);
	}
	
	
	public function testUserEmailConfirmationReturnsUserInstance () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userConfirmed=$userManager->confirmEmail($user->getEmail(), $user->getConfirmationString());
		$this->assertInstanceOf('Rdy4Racing\\Models\\User', $userConfirmed);
	}
	
	public function testUserEmailConfirmationActivatesTheUser () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userConfirmed=$userManager->confirmEmail($user->getEmail(), $user->getConfirmationString());
		$this->assertEquals(1, $userConfirmed->getActive());
	}
	
	
	public function testUserEmailConfirmationWithInvalidString () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$userConfirmed=$userManager->confirmEmail($user->getEmail(),'invalid');
		$this->assertEquals(0, $userConfirmed->getActive());
	}
	
	public function testRegisterGame () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$game=$this->getGame();
		$game->save();
		$userManager->registerGame($user->getId(), $game->getId(),__CLASS__);
		
		$userGames=UserGameQuery::create()->filterByUser($user)->filterByGame($game);
		$this->assertEquals(1, $userGames->count());
		
		$userGame=$userGames->findOne();
		$this->assertEquals(__CLASS__, $userGame->getDriverName());
	}
	
	public function testRegisterGameWithExistingDriver () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$game=$this->getGame();
		$game->save();
		$userManager->registerGame($user->getId(), $game->getId(),__CLASS__);
		
		$user2=$this->getUser();
		$user2->setEmail('test2@test.com');
		$user2->save();
		try {
			$userManager->registerGame($user2->getId(), $game->getId(),__CLASS__);
		} catch (\Exception $e) {
			$this->assertInstanceOf('\\Rdy4Racing\\Modules\\User\\UserException', $e);
			return ;
		}
		$this->fail('An expected exception has not been raised');
	}
	
	public function testRegisterGameCannotBeDoneTwice () {
		$user=$this->getUser();
		$userManager=new Manager();
		$userManager->addUser($user);
		$game=$this->getGame();
		$game->save();
		$userManager->registerGame($user->getId(), $game->getId(),__CLASS__);
		$userManager->registerGame($user->getId(), $game->getId(),__CLASS__.'_NEW');
	
		$userGames=UserGameQuery::create()->filterByUser($user)->filterByGame($game)->count();
		$this->assertEquals(1, $userGames);
	}
	
	// testUserDriverExists
	
	protected function getUser() {
		$user=new User();
		$user->setEmail('test@test.com');
		$user->setPassword('test');
		$user->setFirstName('User');
		$user->setLastName('Test');
		return $user;
	}
	
	protected function getGame() {
		$game=new Game();
		$game->setName(__CLASS__);
		$game->setCode('TEST');
		return $game;
	}
	
	protected function removeData () {
		$users=UserQuery::create()->findByEmail('%@test.com');
		$games=GameQuery::create()->findByCode('TEST');
		$userGameQuery=UserGameQuery::create()->filterByUser($users)->filterByGame($games)->delete();
		$games->delete();
		$users->delete();
	}
	
}

