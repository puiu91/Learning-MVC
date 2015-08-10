<?php 

/**
 * Checks if the client is currently logged in
 * 
 */
class LoginCheckComponent 
{
	/**
	 * Checks session for logged in status
	 * @return boolean
	 */
	public static function isLoggedIn() 
	{
		if (isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == true) {
			return true;
		} else {
			return false;
		}
	}
}

?>