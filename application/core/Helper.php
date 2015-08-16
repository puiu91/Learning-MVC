<?php

class Helper 
{
	static function baseName() 
	{
		return basename($_SERVER['PHP_SELF']);
	}

	static function url($location) 
	{
		echo(URL . $location);
	}
}

?>