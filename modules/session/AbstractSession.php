<?php 

namespace Rdy4Racing\Modules\Session;

use Rdy4Racing\Modules\Session\ISession;
use Rdy4Racing\Modules\Session\Exception;
use Rdy4Racing\Models\Session;

abstract class AbstractSession implements ISession {
	
	/**
	 * @var Session
	 */
	protected $model;
	
	/**
	 * @var array
	 */
	protected $requiredMods;
	

	/**
	 * Class constructor
	 * 
	 * @param Session $model
	 */
	public function __construct (Session $model) {
		if (!$this->isValidType($model->getTypeId())) {
			throw new Exception('Type is not valid for this session class');
		}
		if (!$this->isValidState($model->getStateId())) {
			throw new Exception('State is not valid for this session class');
		}
		$this->model=$model;
	}
	
	/**
	 * @return the $model
	 */
	public function getModel () {
		return $this->model;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::getType()
	 */
	public function getType () {
		return $this->model->getTypeId();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::getState()
	 */
	public function getState () {
		return $this->model->getStateId();
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
		$this->model->setStateId($state)->save();
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