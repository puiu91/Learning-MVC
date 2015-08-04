<?php

/**
 * Sets and gets connection details for database access
 * 
 */
class ConfigDatabase
{
	static $config;

	/**
	 * @param string $name Reads value from config array
	 * @return void
	 */
	public static function read($name) 
	{
		return self::$config[$name];
	}

	/**
	 * @param string $name Writes name to config array
	 * @param string $value Writes value to config array
	 * @return void
	 */
	public static function write($name, $value) 
	{
		self::$config[$name] = $value;
	}
}

/**
 * Assign values to object (localhost)
 *
 */
Config::write('db.user',     'root');
Config::write('db.password', 'password');
Config::write('db.engine',   'mysql');
Config::write('db.host',     'localhost');
Config::write('db.basename', 'mcmaster_projects');

/**
 * Assign values to object (live server)
 * 
 */

?>