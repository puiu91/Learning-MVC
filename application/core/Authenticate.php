<?php

/**
 * Authenticates if the client is logged in before rendering views
 * 
 */
class Authenticate 
{
	public static function checkAuthentication()
	{
		if (!Session::isLoggedIn()) {
			// destroy session
			Session::destroy();
			// redirect to login screen
			header('Location: ' . URL_WITH_INDEX_FILE . 'login');
			exit();
		}
	}
}

?>