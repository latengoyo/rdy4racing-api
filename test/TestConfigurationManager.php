<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Models\GameQuery;


/**
 * test case.
 */
class TestConfigurationManager extends PHPUnit_Framework_TestCase {
	
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
	
	public function testGetConfigurationValue () {
		$config=new Configuration();
		$configValue=$config->get('app.path');
		$this->assertNotEmpty($configValue);
	}
	
	/**
	 * @expectedException Rdy4Racing\Modules\ConfigurationException
	 */
	public function testAutoloadFailsWithoutExistentClass () {
		$config=new Configuration();
		$c=new Rdy4Racing\Modules\Invalid();
	}
	
	public function testDBConnection () {
		$games=GameQuery::create()->count();
		$this->assertGreaterThan(0, $games);
	}
}

