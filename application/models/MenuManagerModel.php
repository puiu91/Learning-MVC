<?php

/**
 * Class that handles the menu manager section
 * 
 */
class MenuManagerModel
{
	/**
	 * Attempts to retrieve the username and password by selecting the row matching 
	 * the username provided by the client
	 * 
	 * @param  string $username 
	 * @return array
	 */
	public function retrievePremadeMenus() {
		$statementHandler = Database::getInstance()->prepare(
			"SELECT id, menu_name
             	 FROM   menus"
		);

		$statementHandler->execute();

		return $statementHandler->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Adds a menu to the client workspace
	 */
	public function addMenu() 
	{
				
	}
	
	/**
	 * Determines if a menu has already been added by a user to their workspace
	 * @return [type] [description]
	 */
	public function menuAlreadyAdded($account_id)
	{
		$statementHandler = Database::getInstance()->prepare(
			"SELECT id, menu_id, account_id
             	 FROM   menus_added
             	 WHERE  account_id = :account_id"
		);

		$statementHandler->execute(array(
			':account_id' => Session::get('Account_ID')
		));

		return $statementHandler->fetch(PDO::FETCH_ASSOC);
	}



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




	public function sample() {
		$statementHandler = Database::getInstance()->prepare(
			"SELECT id, menu_name
             	 FROM   menus
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