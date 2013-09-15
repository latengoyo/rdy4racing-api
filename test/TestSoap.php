<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once '../modules/Configuration.php';

use Rdy4Racing\Modules\Configuration;


/**
 * test case.
 */
class TestSoap extends PHPUnit_Framework_TestCase {
	
	protected $config;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		ini_set("soap.wsdl_cache_enabled", 0);
		$this->config=new Configuration();
		parent::setUp ();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->config=null;
		parent::tearDown ();
	}
	
	public function testSoapWsdl () {
		$url=$this->config->get('services.url').'/test/?wsdl';
		$wsdl=simplexml_load_file($url);
		$this->assertInstanceOf('SimpleXMLElement', $wsdl);
	}

	public function testSoapFunction () {
		$url=$this->config->get('services.url').'/test/?wsdl';
		$client=new \Zend\Soap\Client();
		$client->setWSDL($url);
		$result=$client->add(3,5);
		$this->assertEquals(8, $result);
	}
	
}

