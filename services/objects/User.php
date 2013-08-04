<?php

namespace Rdy4Racing\Services\Objects;

use Rdy4Racing\Services\Objects\ObjectMapper;

class User extends ObjectMapper {
	
	/**
	 * @var int
	 */
	public $id;
	
	/**
	 * 
	 * @var string
	 */
	public $email;
	
	/**
	 * 
	 * @var string
	 */
	public $password;
	
	/**
	 * @var string
	 */
	public $firstName;
	
	/**
	 * @var string
	 */
	public $lastName;
	
	/**
	 * @var string
	 */
	public $dateOfBirth;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $rank;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $MMR;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $rating;
	
	/**
	 * @var string
	 */
	public $about;
	
	/**
	 * @var string
	 */
	public $avatar;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $created;
	
	/**
	 * @readonly
	 * @var boolean
	 */
	public $active;
	
	/**
	 * @readonly
	 * @var int
	 */
	public $godfatherId;
	
	/**
	 * @readonly
	 * @var string
	 */
	public $confirmationString;
	
}

