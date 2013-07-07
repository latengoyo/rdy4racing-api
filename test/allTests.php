<?php
require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'TestConfigurationManager.php';
require_once 'TestUserManager.php';

/**
 * Static test suite.
 */
class allTests extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'allTests' );
		$this->addTestSuite ( 'TestConfigurationManager' );
		$this->addTestSuite ( 'TestUserManager' );
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}

