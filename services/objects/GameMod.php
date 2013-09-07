<?php

namespace Rdy4Racing\Services\Objects;

use Rdy4Racing\Services\Objects\ObjectMapper;

class GameMod extends ObjectMapper {
	
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
	 * @var string
	 */
	public $code;
	
	/**
	 *
	 * @var string
	 */
	public $name;
	
	/**
	 *
	 * @var string
	 */
	public $description;
	
	/**
	 *
	 * @var string
	 */
	public $imageLow;
	
	/**
	 *
	 * @var string
	 */
	public $imageHigh;
	
	/**
	 *
	 * @var string
	 */
	public $imageGameLauncher;
}

