<?php

/**
 * Enforces DRY principles while also improving code readability
 * 
 */
class Helper 
{	
	public static function baseName() 
	{
		return basename($_SERVER['PHP_SELF']);
	}

	public static function url($location) 
	{
		echo(URL . $location);
	}

	public static function redirect($location)
	{
		header('Location: ' . URL_WITH_INDEX_FILE . $location);			
	}

	public static function isset_then_echo($var) {
		if (isset($var) && !empty($var) && $var != "") {
			echo $var;
		} else {
			echo "";
		}
	}

}

?>