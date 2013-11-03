<?php

namespace Rdy4Racing\Services\Objects;

use Rdy4Racing\Services\Objects\ObjectMapper;

class Game extends ObjectMapper {
	
	/**
	 * @readonly
	 * @var int
	 */
	public $id;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $code;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $name;
	
}

