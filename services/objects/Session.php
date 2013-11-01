<?php

namespace Rdy4Racing\Services\Objects;

use Rdy4Racing\Services\Objects\ObjectMapper;

class Session extends ObjectMapper {
	
	/**
	 * @var int
	 */
	public $id;
	
	/**
	 * 
	 * @var int
	 */
	public $gameId;
	
	/**
	 *
	 * @var int
	 */
	public $typeId;
	
	/**
	 * 
	 * @var int
	 */
	public $stateId;
	
	/**
	 *
	 * @var string
	 */
	public $description;
}

