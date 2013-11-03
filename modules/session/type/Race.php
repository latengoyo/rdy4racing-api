<?php 

namespace Rdy4Racing\Modules\Session\Type;

use Rdy4Racing\Modules\Session\Type;
use Rdy4Racing\Modules\Session\AbstractSession;
use Rdy4Racing\Modules\Session\ISession;
use Rdy4Racing\Modules\Session\State;
use Rdy4Racing\Modules\Session\Exception;


class Race extends AbstractSession implements ISession {
	
	/**
	 * @var int
	 */
	protected $type=Type::RACE;

	/**
	 * @var int
	 */
	protected $state;

	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::isValidType()
	 */
	public function isValidType($type) {
		return ($type==Type::RACE);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::getValidStates()
	 */
	public function getValidStates () {
		return array (
			State::SCHEDULED,
			State::CLOSED,
			State::RACING,
			State::FINISHED,
			State::COMPLETED
		);
		
	}

	/**
	 * (non-PHPdoc)
	 * @see \Rdy4Racing\Modules\Session\ISession::join()
	 */
	public function join (\Rdy4Racing\Models\User $user) {
		try {
			if ($this->getState()!=State::SCHEDULED) {
				throw new Exception('Users cannot join the session at this point');
			}
			return $this->addUser($user);
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
}