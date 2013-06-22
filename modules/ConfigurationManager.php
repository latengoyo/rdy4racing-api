<?php

namespace Rdy4Racing\Modules;

use Rdy4Racing\Modules\ConfigurationManagerException;

/**
 * Configuration Manager
 * 
 * Loads the configuration variables and initializes DB + Autoload
 * 
 * @author alex
 */
class ConfigurationManager {
	
	/**
	 * @var array
	 */
	protected $config;
	
	
	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->initConfigurationVars();
		$this->initAutoload();
		$this->initDB();
	}
	
	/**
	 * Loads configuration file into the variables
	 */
	protected function initConfigurationVars () {
		$configPath=__DIR__.'../../config/config.ini';
		$this->config=parse_ini_file($configPath);
	}
	
	/**
	 * Initialize the autoloading method
	 */
	protected function initAutoload () {
		spl_autoload_register(array($this,'autoload'));
	}
	
	/**
	 * Initialize the database connection
	 */
	protected function initDB () {
		require_once $this->get('app.path').'/library/propel/runtime/lib/Propel.php';
		\Propel::init($this->get('app.path').'/config/rdy4racing-api-conf.php');
	}
	
	/**
	 * Returns the value of a configuration parameter
	 * 
	 * @param string $name
	 * @return string
	 */
	public function get ($name) {
		return $this->config[$name];
	}
	
	/**
	 * Project autoloader
	 * 
	 * @param string $className
	 * @throws ConfigurationManagerException
	 */
	protected function autoload ($className) {
		$names=explode('\\',$className);
		$path=$this->get('app.path');
		foreach ($names as $i=>$name) {
			// remove Rdy4Racing namespace
			if ($i==0) {
				continue;
			}
			if ($i==count($names)-1) {
				$path.='/'.$name.'.php';
			} else {
				$path.='/'.strtolower($name);
			}
		}
		if (!file_exists($path)) {
			throw new ConfigurationManagerException('Class '.$className.' not found in '.$path);
		}
		require_once $path;
	}
	
}