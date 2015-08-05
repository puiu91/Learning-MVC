<?php

/**
 * Load bcrypt hashing functions
 * 
 */
require(APP . 'libraries/bcrypt_password_hashing.php');

/**
 * Class that validates login form input fields
 * 
 */
class LoginFormValidator
{
	public $postData;
	public $formFieldErrors = array(
		'field empty' => array('error' => false, 'message' => 'Empty field'),
		'credentials' => array('error' => false, 'message' => 'Wrong username or password supplied')
	);

	/**
	 * Runs validation on form inputs
	 *
	 * note - need a master class that uses the input field name and an array of 
	 * 		the types of error checking required and returns the result set
	 * 
	 * @param  array $postData
	 * @return array 
	 */
	public function validateFormData($postData)
	{
		// check for empty fields
		if (empty($postData['username']) or empty($postData['password'])) {

			$this->formFieldErrors['field empty']['error'] = true;

		} else {

			// attempt to retrieve username and password from database by selecting on the client supplied username
			$dbResult = $this->retrieveCredentials($postData['username']);

			// debug
			print_var($dbResult);

			/**
			 * A row containing client supplied username was found and the client 
			 * supplied password matches the bcrypt hash of the password from the database
			 * 
			 */
			if ($dbResult and password_verify($postData['password'], $dbResult['password'])) {
				// set session as logged in
				$_SESSION['logged_in'] = true;
			} else {
				$this->formFieldErrors['credentials']['error'] = 1;
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

		return $dbResult = $statementHandler->fetch(PDO::FETCH_ASSOC);
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