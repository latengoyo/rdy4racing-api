<?php 

namespace Rdy4Racing\Modules\Session;

use Rdy4Racing\Models\SessionQuery;
use Rdy4Racing\Modules\Session\Type\Practice;
use Rdy4Racing\Models\Session;

/**
 * Manages sessions
 * 
 * @author alex
 */
class Manager {

	/**
	 * Create a new session
	 * 
	 * @param int $game
	 * @param int $type
	 * @param string $description
	 * @return Rdy4Racing\Modules\Session\ISession
	 */
	public function createSession ($game,$type,$description='') {
		try {
			$model=new Session();
			$model->setStateId(State::SCHEDULED)
				->setGameId($game)
				->setTypeId($type)
				->setDescription($description)
				->save();
			return $this->getInstance($model);
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Gets a session object
	 * 
	 * @param int $id
	 * @return Rdy4Racing\Modules\Session\ISession
	 */
	public function getSession ($id) {
		try {
			$model=SessionQuery::create()->findOneById($id);
			if (!$model) {
				throw new Exception('Invalid session ID '.$id);
			}
			
			return $this->getInstance($model);
		} catch (\Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Return the session based on the model type
	 * 
	 * @param Session $model
	 * @return Rdy4Racing\Modules\Session\ISession
	 */
	protected function getInstance (Session $model) {
		if ($model->getTypeId()==Type::PRACTICE) {
			$session=new Practice($model);
		}
		return $session;
	}
}