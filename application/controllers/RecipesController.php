<?php

/**
 * Recipes Model
 * 
 */
require(APP_PATH . '/models/RecipesModel.php');

/**
 * Recipes controller for the recipes section
 * 
 */
class RecipesController
{
	public function __construct()
	{
		Authenticate::checkAuthentication();
	}

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // header
        require APP_PATH . 'views/templates/header_alt.php';

        // navbar
            // <body>
            // <container>
            // <navbar></navbar>
        require APP_PATH . 'views/templates/navbar_alt.php';

        // sidebar
            // <row>
            // <col-sm-3></end-col>
        require APP_PATH . 'views/recipes/default/sidebar.php';

        // content
            // <col-sm-9></end-col>
        require APP_PATH . 'views/recipes/default/content.php';

        // footer 
            // <footer></footer>
            // </container>
            // </body>
            // </html>
        require APP_PATH . 'views/templates/footer.php';
    }




    public function searchRecipes()
    {
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// get data
		$RecipesModel = new RecipesModel;

		// store recipes from search query
		$recipeSearchResults = $RecipesModel->searchRecipes($_POST);

		// print_var($_POST);
		// print_var($recipeSearchResults);

		// content
		require APP_PATH . 'views/recipes/default/sidebar.php';
		require APP_PATH . 'views/recipes/searchrecipes/content.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';
    }

    /**
     * Public function used to add a recipe to the active menu
     * 
     * @param  [type] $parameter [description]
     * @return [type]            [description]
     */
    public function addrecipe($parameter)
    {
		// get data
    	$RecipesModel = new RecipesModel;

    	// invoke method
    	$RecipesModel->addRecipeToMenu($parameter);

    	// redirect
		Session::add('feedback_errors', ErrorMessage::get('RECIPE_ADDED_TO_MENU'));
		Helper::redirect('recipes/searchrecipes');
    }




    /**
     * [manageRecipes description]
     * @return [type] [description]
     */
    public function manageRecipes()
    {
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// get data
    	$RecipesModel = new RecipesModel;

    	// invoke method
    	$recipes = $RecipesModel->retrieveRecipes();	
    	
		// content
		require APP_PATH . 'views/recipes/default/sidebar.php';
		require APP_PATH . 'views/recipes/managerecipes/content.php';		

		// footer
		require APP_PATH . 'views/templates/footer.php';
    }

    public function removeRecipeAction($parameter) 
    {
    	// instantiate model
    	$RecipesModel = new RecipesModel;

    	// invoke method
    	$RecipesModel->removeRecipe($parameter);	

    	// redirect
    	Session::add('feedback_errors', ErrorMessage::get('RECIPE_REMOVED_FROM_MENU'));
		Helper::redirect('recipes/manageRecipes'); 
    }






















    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function exampleOne($parameter)
    {
    		echo "<h1>" . $parameter . "</h1>";
       	
       	    // load views
    		require APP_PATH . 'views/templates/header.php';
    		require APP_PATH . 'views/home/example_one.php';
    		require APP_PATH . 'views/templates/footer.php';
    }

    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function exampleTwo()
    {
        // load views
        require APP_PATH . 'views/templates/header.php';
        require APP_PATH . 'views/home/example_two.php';
        require APP_PATH . 'views/templates/footer.php';
    }
}