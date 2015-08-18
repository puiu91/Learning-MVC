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

	public static function menuIsActive()
	{
		if (!Session::getNested('active_menu', 'menu_id')) {
			// destroy session
			// Session::destroy();
			// 
			// create error message
			Session::add('feedback_errors', ErrorMessage::get('MENU_NOT_ACTIVE'));
			// redirect to menu selection screen
			header('Location: ' . URL_WITH_INDEX_FILE . 'menumanager/managemenus');
			exit();
		}
	}

}

?>