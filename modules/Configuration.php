<?php

namespace Rdy4Racing\Modules;

use Rdy4Racing\Modules\ConfigurationException;

/**
 * Configuration Manager
 * 
 * Loads the configuration variables and initializes DB + Autoload
 * 
 * @author alex
 */
class Configuration {
	
	/**
	 * @var array
	 */
	protected $config;
	
	
	/**
	 * Class constructor
	 */
	public function __construct() {
		try {
			$this->initConfigurationVars();
			$this->initDB();
			$this->initAutoload();
		} catch (\Exception $e) {
			throw $e;
		}
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

		require_once $this->get('app.path').'/library/Zend/Loader/StandardAutoloader.php';
		
		// Initialize Zend autoloader
		$loader = new \Zend\Loader\StandardAutoloader(array(
				'autoregister_zf' => true,
				'fallback_autoloader' => true,
		));
		// Register with spl_autoload:
		$loader->register();
		
		spl_autoload_register(array($this,'autoload'));
	}
	
	/**
	 * Initialize the database connection
	 */
	protected function initDB () {
		try {
			require_once $this->get('app.path').'/library/propel/runtime/lib/Propel.php';
			if (!\Propel::isInit()) {
				\Propel::init($this->get('app.path').'/config/rdy4racing-api-conf.php');
				$propelConfig = \Propel::getConfiguration(\PropelConfiguration::TYPE_OBJECT);
				$propelConfig->setParameter('datasources.default', 'devel');
				
				set_include_path($this->get('app.path').'/models' . PATH_SEPARATOR . get_include_path());
			}
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Returns the value of a configuration parameter
	 * 
	 * @param string $name
	 * @return string
	 */
	public function get ($name) {
		if (!array_key_exists($name, $this->config)) {
			return false;
		}
		return $this->config[$name];
	}
	
	/**
	 * Gets the config
	 * 
	 * @return array
	 */
	public function getConfig () {
		return $this->config;
	}
	
	/**
	 * Project autoloader
	 * 
	 * @param string $className
	 * @throws ConfigurationException
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
				// remove array notation for soap complex types
				$name=str_replace('[]', '', $name);
				$path.='/'.$name.'.php';
			} else {
				$path.='/'.strtolower($name);
			}
		}
		if (!file_exists($path)) {
			throw new ConfigurationException('Class '.$className.' not found in '.$path);
		}
		require_once $path;
	}
	
}