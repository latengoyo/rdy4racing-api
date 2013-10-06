<?php
require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'TestConfigurationManager.php';
require_once 'TestUserManager.php';
require_once 'TestSoap.php';
require_once 'TestServiceObjects.php';
require_once 'TestGame.php';
require_once 'TestSessionPractice.php';
require_once 'TestSessionRace.php';

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
		$this->addTestSuite ( 'TestSoap' );
		$this->addTestSuite ( 'TestServiceObjects' );
		$this->addTestSuite ( 'TestGame' );
		$this->addTestSuite ( 'TestSessionPractice' );
		$this->addTestSuite ( 'TestSessionRace' );
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}

