<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/ConfigurationManager.php';

use Rdy4Racing\Modules\ConfigurationManager;
use Rdy4Racing\Modules\User\UserManager;
use Rdy4Racing\Models\User;
use Rdy4Racing\Models\UserQuery;


/**
 * test case.
 */
class TestServiceObjects extends PHPUnit_Framework_TestCase {
	
	protected $config;
	protected $data=array();
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		$this->config=new ConfigurationManager();
		UserQuery::create()->findByEmail('test@test.com')->delete();
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
		$this->config=null;
		parent::tearDown ();
	}
	
	public function testExportWithoutId () {
		$userServiceObject=new \Rdy4Racing\Services\Objects\User();
		$userServiceObject->email='test@test.com';
		$userServiceObject->password='test';
	
		$userObject=$userServiceObject->export();
		
		$this->assertEmpty($userObject->getId(),'Checking empty id');
		$this->assertEquals($userServiceObject->email,$userObject->getEmail(),'Checking email');
		$this->assertEquals($userServiceObject->password,$userObject->getPassword(), 'Checking password');
	}
	
	public function testExportWithId () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		
		$userServiceObject=new \Rdy4Racing\Services\Objects\User();
		$userServiceObject->id=$user->getId();
		$userObject=$userServiceObject->export();
		
		$this->assertEquals($user,$userObject);
		
	}
	
	public function testExportWithIdAndModifiedData () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
	
		$userServiceObject=new \Rdy4Racing\Services\Objects\User();
		$userServiceObject->id=$user->getId();
		$userServiceObject->email='testmodified@test.com';
		$userObject=$userServiceObject->export();
	
		$this->assertInstanceOf('\\Rdy4Racing\\Models\\User', $userObject, 'Testing class');
		$this->assertEquals($userServiceObject->email,$userObject->getEmail());
	}
	
	public function testExportWithIdAndReadonlyData () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
	
		$userServiceObject=new \Rdy4Racing\Services\Objects\User();
		$userServiceObject->id=$user->getId();
		$userServiceObject->rank='B';
		$userObject=$userServiceObject->export();
	
		$this->assertNotEquals($userObject->getRank(),$userServiceObject->rank);
	}
	
	public function testImport () {
		$user=$this->getUser();
		$userManager=new UserManager();
		$userManager->addUser($user);
		$this->data[]=$user;
		
		$userServiceObject=new \Rdy4Racing\Services\Objects\User();
		$userServiceObject->import($user);
		
		$this->assertInstanceOf('\\Rdy4Racing\\Services\\Objects\\User', $userServiceObject, 'Test class');
		$this->assertEquals($user->getId(), $userServiceObject->id, 'Test property ID');
		$this->assertEquals($user->getEmail(), $userServiceObject->email, 'Test property email');
		$this->assertEquals($user->getPassword(), $userServiceObject->password, 'Test property password');
	}
	
	protected function getUser() {
		$user=new User();
		$user->setEmail('test@test.com');
		$user->setPassword('test');
		$user->setFirstName('User');
		$user->setLastName('Test');
		$user->setRank('A');
		return $user;
	}
}