<?php

/**
 * Load bcrypt hashing functions
 * 
 */
require(APP_PATH . 'libraries/bcrypt_password_hashing.php');

/**
 * Class that validates login-form input fields
 * 
 */
class LoginModel
{
	/**
	 * Runs validation on login-form input fields
	 * 
	 * @param  array $postData
	 * @return boolean 
	 */
	public function validateLoginForm($postData)
	{
		if (empty($postData['username']) or empty($postData['password'])) {

			Session::add('feedback_errors', ErrorMessage::get('ERROR_FIELD_IS_EMPTY'));
			return false;

		} else {

			// attempt to retrieve username and password from database by selecting a row using client supplied username
			$dbResult = $this->retrieveCredentials($postData['username']);

			// a row containing client supplied username was found and the client supplied password matches the bcrypt hash of the password from the database
			if ($dbResult and password_verify($postData['password'], $dbResult['password'])) {
				return true;
			} else {
				Session::add('feedback_errors', ErrorMessage::get('ERROR_INVALID_CREDENTIALS'));
				return false;
			}
		}
	}

	/**
	 * Attempts to retrieve the username and password by selecting the row matching 
	 * the username provided by the client
	 * 
	 * @param  string $username 
	 * @return array
	 */
	public function retrieveCredentials($username) {
		$statementHandler = Database::getInstance()->prepare(
			"SELECT username, password
             FROM   users
             WHERE  username = :username"
		);

		$statementHandler->execute(array(
			':username' => $username
		));

		return $statementHandler->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Send the errors array to requestor
	 * 
	 * @return array
	 */
	public function getErrorsArray() 
	{
		return $this->formFieldErrors;
	}
}

?>