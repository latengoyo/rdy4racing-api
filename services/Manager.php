<?php
/**
 * Service class
 * 
 * @author alex
 */

namespace Rdy4Racing\Services;

use Rdy4Racing\Modules\Configuration;
use Rdy4Racing\Services\Server\SoapServer;

class Manager {

	protected $config;
	protected $module;
	protected $server;
	protected $object;

	/**
	 * Construct all params needed for run the webservice
	 * 
	 * @param Configuration $config
	 * @param array $data
	 */
	public function __construct (Configuration $config, $module) {
		$this->config = $config;
		$this->module = strtolower($module);
	}

	public function init () {
		$this->createObject();
		$this->server = new SoapServer($this);
		$this->server->initServer();
	}

	/**
	 * Sets WebService loading Module requested
	 * 
	 * @throws Exception
	 */
	public function handle () {
		$this->server->handle();
	}

	/**
	 * Check if exists module for this service and creates the object
	 * 
	 * @throws \Exception
	 */
	public function createObject () {
		// check base class (non-country specific)
		$baseDir = $this->config->get('app.path') . '/services/modules/' . $this->module;
		$baseFile = $baseDir . '/' . ucfirst($this->module) . 'Service.php';
		$class = ucfirst($this->module) . 'Service';
		if (!file_exists($baseFile)) {
			throw new \Exception('Module '.$baseFile.' does not exist!');
		}
		require_once $baseFile;
		
		// load class
		$this->object = new $class($this->config);
	}

	/**
	 * Return ConfigurationManager instance
	 * 
	 * @return Configuration
	 */
	public function getConfig () {
		return $this->config;
	}

	/**
	 * Return the module name
	 *
	 * @return string
	 */
	public function getModule () {
		return $this->module;
	}
	
	/**
	 * Return the service object
	 * 
	 * @return mixed
	 */
	public function getObject () {
		return $this->object;
	}
}
