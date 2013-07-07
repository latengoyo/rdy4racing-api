<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/ConfigurationManager.php';

use Rdy4Racing\Modules\ConfigurationManager;
use Rdy4Racing\Modules\User\UserManager;
use Rdy4Racing\Models\User;

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
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// delete all data
		foreach ($this->data as $data) {
			$data->delete();
		}
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		$this->config=new ConfigurationManager();
	}
	
	public function testUserAdd () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$this->assertNotEmpty($user->getId());
	}
	
	public function testCheckEmailDoesNotExist () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$this->assertFalse($userManager->emailExists($user->getEmail()));
	}
	
	public function testCheckEmailExists () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$this->assertTrue($userManager->emailExists($user->getEmail()));
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\UserManagerException
	 */
	public function testUserAddUserTwice () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$userManager->addUser($user);
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\UserManagerException
	 */
	public function testUserWithoutEmail () {
		$user=$this->getUser();
		$user->setEmail('');
		$userManager=new UserManager();
		$userManager->addUser($user);
	}
	
	public function testUserAddEncryptsPassword () {
		$user=$this->getUser();
		$userPasswordBefore=$user->getPassword();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$this->assertNotEquals($userPasswordBefore, $user->getPassword(), 'Checking password is different');
		$this->assertEquals($user->getPassword(),crypt($userPasswordBefore,$user->getPassword()),'Checking password encryption');
	}
	
	public function testUserAddConfirmationStringIsCreated () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$this->assertNotEmpty($user->getConfirmationString());
	}
	
	public function testUserLoginRetunsUserInstance () {
		$user=$this->getUser();
		$userPasswordBefore=$user->getPassword();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$userLogin=$userManager->login($user->getEmail(),$userPasswordBefore);
		$this->assertInstanceOf('Rdy4Racing\\Models\\User', $userLogin);
		$this->assertEquals($user->getId(), $userLogin->getId());
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\UserLoginException
	 */
	public function testUserLoginWithInvalidEmail () {
		$userManager=new UserManager();
		$userManager->login('invalid','invalid');
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\User\UserLoginException
	 */
	public function testUserLoginWithInvalidPassword () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$userManager->login($user->getEmail(),'invalid');
	}
	
	public function testUserEmailConfirmationReturnsUserInstance () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$userConfirmed=$userManager->confirmEmail($user->getEmail(), $user->getConfirmationString());
		$this->assertInstanceOf('Rdy4Racing\\Models\\User', $userConfirmed);
	}
	
	public function testUserEmailConfirmationActivatesTheUser () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$userConfirmed=$userManager->confirmEmail($user->getEmail(), $user->getConfirmationString());
		$this->assertEquals(1, $userConfirmed->getActive());
	}
	
	
	public function testUserEmailConfirmationWithInvalidString () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		$userConfirmed=$userManager->confirmEmail($user->getEmail(),'invalid');
		$this->assertEquals(0, $userConfirmed->getActive());
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
	
}

