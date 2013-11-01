<?php 

use Rdy4Racing\Modules\Configuration;


class SessionService {
	
	/**
	 * @var ConfigurationManager
	 */
	protected $config;
	
	public function __construct(Configuration $config) {
		$this->config=$config;
	}
	
}