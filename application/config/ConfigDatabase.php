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
ConfigDatabase::write('db.user',     'root');
ConfigDatabase::write('db.password', 'password');
ConfigDatabase::write('db.engine',   'mysql');
ConfigDatabase::write('db.host',     'localhost');
ConfigDatabase::write('db.basename', 'smg');

/**
 * Assign values to object (live server)
 * 
 */

?>