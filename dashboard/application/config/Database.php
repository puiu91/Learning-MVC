<?php

/**
 * Call dependencies
 * 
 */
require(APP . '/config/ConfigDatabase.php');

/**
 * Create Singleton interface
 * 
 */
interface Singleton
{
	public static function getInstance();
}

/**
 * Creates a PDO database access layer using singleton pattern in order to 
 * prevent multiple instances of a database connection. Uses the constants 
 * declared in Config class.
 *
 * Use the class to access the database throughout application by calling
 * $statementHandle = Database::getInstance()->prepare(
 *
 * @return  a PDO connection
 * 
 */
class Database implements Singleton
{
	/**
	 * @var singleton Reference to singleton instance of the class
	 */
	private static $_instance = null;
	private $databaseHandler;

	private function __construct() 
	{
		// build database handler using static read method of Config class to access database credentials
		$this->databaseHandler = new PDO(
			ConfigDatabase::read('db.engine') . ':host=' . ConfigDatabase::read('db.host') . ';dbname=' . ConfigDatabase::read('db.basename'), 
			ConfigDatabase::read('db.user'), 
			ConfigDatabase::read('db.password')
		);
	}

	/**
	 * Creates singleton instance if it does not exist otherwise returns
	 * an existing instance without having to instantiate a new object
	 * 
	 * @return Singleton Returns a singleton instance
	 * 
	 */
	public static function getInstance() 
	{
		if (static::$_instance === null) {
			static::$_instance = new Database();
		}

		return static::$_instance->databaseHandler;
	}
}

?>