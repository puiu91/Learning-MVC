<?php 

/**
 * Session class handles creation or destruction of sessions 
 * as well as setting and getting session values
 * 
 */
class Session
{
	/**
	 * Starts the session
	 * 
	 * @return void
	 */
	public static function initialize()
	{
		if (session_id() == null) {
			session_start();
		}
	}

	/**
	 * Sets value for a session key
	 * 
	 * @param string $key
	 * @param multiple $value
	 */
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	/**
	 * Returns the value of a session key
	 * 
	 * @param  string $key
	 * @return multiple      
	 */
	public static function get($key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
	}

	public static function getNested($key, $value)
	{
		if (isset($_SESSION[$key][$value])) {
			return $_SESSION[$key][$value];
		}
	}

	/**
	 * Adds new array element to an existing key (used for storing error messages)
	 * 
	 * @param multiple $k Key
	 * @param multiple $v Value
	 */
	public static function add($k, $v)
	{
		$_SESSION[$k][] = $v;
	}

	/**
	 * Destroys the session
	 * 
	 * @return void
	 */
	public static function destroy()
	{
		session_destroy();
	}

	/**
	 * Checks if user is logged in
	 * 
	 * @return boolean
	 */
	public static function isLoggedIn() 
	{
		return (self::get('logged_in') ? true : false);
	}
}

?>