<?php

/**
 * Soap server class
 * 
 * @author alex bazan
 *
 */
namespace Rdy4Racing\Services\Server;

use Rdy4Racing\Services\ServiceManager;

class SoapServer implements IServer {

	protected $config;
	protected $module;
	protected $type;
	protected $client;
	protected $url;
	protected $serviceManager;

	public function __construct (ServiceManager $serviceManager) {
		$this->serviceManager = $serviceManager;
		$this->config = $serviceManager->getConfig();
		$this->module = trim(strtolower($serviceManager->getModule()));
		$this->url = $this->module;
	}

	public function initServer () {
		$className = get_class($this->serviceManager->getObject());
		if (isset($_GET['wsdl'])) {
			$this->server = new \Zend\Soap\AutoDiscover();
			$this->server->setClass($className)
			             ->setUri($this->config->get('services.url').'/'.$this->module)
			             //->setBindingStyle(array('style' => 'document'))
			             //->setOperationBodyStyle(array('use' => 'literal', 'namespace'=>$this->config->get('services.url').'/'.$this->module))
			             ->setServiceName($this->module);
			$wsdl=$this->server->generate();
		} else {
			$wsdl = $this->config->get('services.url');
			$wsdl .= "/" . $this->module . "?wsdl";
			$this->server = new \Zend\Soap\Server($wsdl);
			$this->server->setObject($this->serviceManager->getObject());
		}
		return $this->server;
	}

	public function handle () {
		$this->server->handle();
	}
}