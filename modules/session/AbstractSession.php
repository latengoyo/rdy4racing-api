<?php 

namespace Rdy4Racing\Modules\Session;

use Rdy4Racing\Modules\Session\ISession;
use Rdy4Racing\Modules\Session\Exception;

abstract class AbstractSession implements ISession {
	
	/**
	 * @var int
	 */
	protected $type;

	/**
	 * @var int
	 */
	protected $state;
	
	/**
	 * @var array
	 */
	protected $requiredMods;
	
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::getType()
	 */
	public function getType () {
		return $this->type;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::getState()
	 */
	public function getState () {
		return $this->state;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::setState()
	 */
	public function setState ($state) {
		if (!$this->isValidState($state)) {
			throw new Exception('Invalid session state '.$state);
		}
		if ($state < $this->getState()) {
			throw new Exception('Cannot change session state from '.$this->getState().' to '.$state);
		}
		if ($this->getState()!=null) {
		$stateKeys=array_flip($this->getValidStates());
			if ($stateKeys[$state] - $stateKeys[$this->getState()] != 1) {
				throw new Exception('Cannot change session state from '.$this->getState().' to '.$state);
			}
		}
		$this->state=$state;
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::isValidState()
	 */
	public function isValidState ($state) {
		if (!in_array($state, $this->getValidStates())) {
			return false;
		}
		return true;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::getRequiredMods()
	 */
	public function getRequiredMods () {
		// TODO Auto-generated method stub
	}

	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::launchInstances()
	 */
	public function launchInstances () {
		// TODO Auto-generated method stub
	}
	
}