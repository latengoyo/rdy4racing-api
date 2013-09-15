<?php

defined('ENVIRONMENT') || define('ENVIRONMENT',(getenv('ENVIRONMENT') ? getenv('ENVIRONMENT') : 'devel'));

require_once '../modules/Configuration.php';
require_once '../library/Zend/Loader/StandardAutoloader.php';

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Services\Manager;

if (ENVIRONMENT!='prod') {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set("soap.wsdl_cache_enabled", 0);
}

try {
	// Starts Webservice and configuration Manager
	$bootstrap = new Bootstrap();
	$bootstrap->handle();
} catch (\Exception $e) {
	echo $e->getMessage();
}


class Bootstrap {
	
	protected $config;
	protected $module;
	
	/**
	 * Initialize services
	 * 
	 * @throws Exception
	 */
	public function __construct () {
		try {
			$this->config = new Configuration();
			$this->processUrl();
			$this->initIncludePath();
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Initializes the include path for libraries
	 */
	protected function initIncludePath () {
		set_include_path(get_include_path() . PATH_SEPARATOR . $this->config->get('app.path').'/library/');
	}
	
	/**
	 * Process URL paramenters
	 * 
	 * @throws \Exception
	 */
	protected function processUrl () {
		$url = $this->getParams();
		if (count($url) > 1) {
			$this->module = $url[1];
		} else {
			throw new \Exception('Invalid number of parameters');
		}
	}
	
	/**
	 * Get the URL parameters
	 * 
	 * @return array
	 */
	protected function getParams () {
		return explode('/',substr($_SERVER['SCRIPT_URL'],1));
	}
	
	/**
	 * Handles the service request
	 * 
	 * @throws Exception
	 */
	public function handle () {
		try {
			$serviceManager = new Manager($this->config,$this->module);
			$serviceManager->init();
			$serviceManager->handle();
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
}