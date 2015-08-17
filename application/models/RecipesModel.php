<?php

/**
 * Class that handles the recipes section
 * 
 */
class RecipesModel
{
	/**
	 * Searches the recipes database and returns the results
	 * @return array
	 */
	public function searchRecipes($postData)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

			array_htmlspecialchars($_POST);

            // store search tokens
			$search_string = $_POST['search'];

            // explode search tokens to array
			$tokens = explode(" ", $search_string);

            // remove empty fields from tokens and re-index
			$tokens = array_values(array_filter($tokens));

			// print_var($tokens);

			// if actual search intput was provided
			if (!empty($tokens)) {
				$select = 'SELECT * FROM recipes WHERE ';

				$construct = "";

				# append search fields
				foreach ($tokens as $key => $value) {
				   $construct .= 'recipe_name LIKE "%' . $value . '%" OR ';
				}

                // remove the last two characters as they contain an extra OR
				$construct = substr($construct, 0, strlen($construct)-3);

                // create final SQL query
				$select .= $construct;

                // prepare query
				$statementHandler = Database::getInstance()->query($select);

				// fetch results
				return $results = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
			}

		}
	}

	/**
	 * Inserts a recipe to the currently active menu
	 * @param int
	 */
	public function addRecipeToMenu($recipeId) 
	{

		// need to check if recipe has already been added

		$statementHandler = Database::getInstance()->prepare(
			"INSERT INTO menus_recipes_added (menu_id, recipe_id, account_id)
			 VALUES (:menu_id, :recipe_id, :account_id)"
		);

		$statementHandler->execute(array(
			':menu_id'    => Session::getNested('active_menu', 'menu_id'),
			':recipe_id'  => $recipeId,
			':account_id' => Session::get('account_id')
		));
	}

	public function retrieveRecipes()
	{
		$statementHandler = Database::getInstance()->prepare(
			"SELECT
				a.menu_id, a.recipe_id, b.recipe_name
			 FROM 
			 	menus_recipes_added as a
			 INNER JOIN 
			 	recipes as b
			 WHERE 
			 	a.menu_id = :menu_id AND
			 	a.recipe_id = b.id AND
			 	a.account_id = :account_id"
		);

		$statementHandler->execute(array(
			':menu_id'    => Session::getNested('active_menu', 'menu_id'),
			':account_id' => Session::get('account_id')
		));

		return $statementHandler->fetchAll(PDO::FETCH_ASSOC);		
	}

	public function removeRecipe($recipe_id) 
	{
		$statementHandler = Database::getInstance()->prepare(
			"DELETE FROM menus_recipes_added
			 WHERE recipe_id = :recipe_id AND account_id = :account_id"
		);

		$statementHandler->execute(array(
			':recipe_id' => $recipe_id,
			':account_id' => Session::get('account_id')
		));		
	}
}

?>