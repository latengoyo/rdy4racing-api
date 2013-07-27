<?php

class TestService {

	/**
	 * Adds two integers
	 * 
	 * @param int $a
	 * @param int $b
	 * @return int
	 */
	public function add ($a, $b) {
		error_log(print_r($a,1));
		error_log(print_r($b,1));
		return $a+$b;
	}
}