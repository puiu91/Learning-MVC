<?php

/**
 * Class that handles the signage creation section
 * 
 */
class SignageGeneratorModel
{
	/**
	 * Retrieves available pre-made menus from the database
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
	 * Determines if a menu has already been added by a user to their workspace
	 * 
	 * @return array
	 */
	public function menuAlreadyAdded($menu_id)
	{
		$statementHandler = Database::getInstance()->prepare(
			"SELECT id, menu_id, account_id
			 FROM   menus_added
			 WHERE  menu_id = :menu_id AND account_id = :account_id"
		);

		$statementHandler->execute(array(
			':menu_id'    => $menu_id,
			':account_id' => Session::get('account_id')
		));

		return $statementHandler->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Adds a menu to the client workspace
	 * 
	 * @param int $menu_id
	 * @return void
	 */
	public function addMenu($menu_id) 
	{
		$statementHandler = Database::getInstance()->prepare(
			"INSERT INTO menus_added (menu_id, account_id)
			VALUES (:menu_id, :account_id)"
		);

		$statementHandler->execute(array(
			':menu_id'    => $menu_id,
			':account_id' => Session::get('account_id')
		));
	}

	/**
	 * Retrieves menus that the user has added from the database
	 * 
	 * @return array
	 */
	public function retrieveAddedMenus()
	{
		$statementHandler = Database::getInstance()->prepare(
			"SELECT 
				a.menu_id, b.menu_name
             	 FROM 
             	 	menus_added as a
             	 INNER JOIN 
             	 	menus as b
             	 ON 
             	 	a.menu_id = b.id
             	 WHERE 
             	 	a.account_id = :account_id"
		);

		$statementHandler->execute(array(
			':account_id' => Session::get('account_id')
		));

		return $statementHandler->fetchAll(PDO::FETCH_ASSOC);	
	}

	/**
	 * Retrieves the menu name using the id given
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function retrieveMenuName($menuid) 
	{
		$statementHandler = Database::getInstance()->prepare(
			"SELECT 
				a.menu_id, b.menu_name
			 FROM 
			 	menus_added as a
			 INNER JOIN 
			 	menus as b
			 ON 
			 	a.menu_id = b.id
			 WHERE 
			 	a.menu_id = :menu_id"
		);

		$statementHandler->execute(array(
			':menu_id' => $menuid
		));

		return $statementHandler->fetchAll(PDO::FETCH_ASSOC);	
	}


	/**
	 * [delteMenuPerform description]
	 * @param  [type] $menu_id [description]
	 * @return [type]          [description]
	 */
	public function delteMenuPerform($menuid)
	{
		$statementHandler = Database::getInstance()->prepare(
			"DELETE FROM menus_added
			 WHERE menu_id = :menu_id AND account_id = :account_id"
		);

		$statementHandler->execute(array(
			':menu_id' => $menuid,
			':account_id' => Session::get('account_id')
		));
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
}

?>