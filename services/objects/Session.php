<?php

namespace Rdy4Racing\Services\Objects;

use Rdy4Racing\Services\Objects\ObjectMapper;

class Session extends ObjectMapper {
	
	/**
	 * @readonly
	 * @var int
	 */
	public $id;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $gameId;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $typeId;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $stateId;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $description;
}

