<?php 

/**
 * Retrieve error messages
 * 
 */
class ErrorMessage
{
	/**
	 * Stores errors array from Errors.php for accessibility when statically calling get()
	 * @var array
	 * 
	 */
	private static $text;

	/**
	 * Searches for error in the config errors array and returns the matching error description
	 * 
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public static function get($key) {

		if (!$key) {
			return null;
		}

		// require Errors.php file which returns an array containing all possible error messages
		if (!self::$text) {
			self::$text = require('application/config/Errors.php');
		}

		// check if array key exists
		if (!array_key_exists($key, self::$text)) {
			return null;
		}

		// return error message to requestor
		return self::$text[$key];
	}
}

?>