<?php

namespace Rdy4Racing\Services\Objects;

use Rdy4Racing\Services\Objects\ObjectMapper;

class Driver extends ObjectMapper {
	
	/**
	 * @readonly
	 * @var int
	 */
	public $sessionId;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $userGameId;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $rank;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $MMRStart;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $ratingStart;
	
	/**
	 * @var int
	 */
	public $MMREnd;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $ratingEnd;

}

