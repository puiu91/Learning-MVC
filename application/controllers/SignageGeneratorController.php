<?php

/**
 * Login model
 * 
 */
require(APP_PATH . '/models/SignageGeneratorModel.php');

/**
 * Class MenuManager
 *
 * Used for creating the menus
 *
 */

class SignageGeneratorController
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
    	// check if user has an active menu
    	
    	Authenticate::menuIsActive();

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
        require APP_PATH . 'views/signagegenerator/_default/sidebar.php';

        // content
            // <col-sm-9></end-col>
        require APP_PATH . 'views/signagegenerator/_default/content.php';

        // footer 
            // <footer></footer>
            // </container>
            // </body>
            // </html>
        require APP_PATH . 'views/templates/footer.php';
    }

    public function premade()
    {
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// get data
		// $MenuManagerModel = new MenuManagerModel;
		// $addedMenus = $MenuManagerModel->retrieveAddedMenus();		

		// content
		require APP_PATH . 'views/signagegenerator/_default/sidebar.php';
		require APP_PATH . 'views/signagegenerator/premade/content.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';

    }

    public function custom()
    {
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// get data
		// $MenuManagerModel = new MenuManagerModel;
		// $addedMenus = $MenuManagerModel->retrieveAddedMenus();		

		// content
		require APP_PATH . 'views/signagegenerator/_default/sidebar.php';
		require APP_PATH . 'views/signagegenerator/custom/content.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';
    }


    public function signage($parameter) 
    {
    	print_var($parameter);

		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';    

		// load recipe information
		$SignageGeneratorModel = new SignageGeneratorModel;
		$recipe_information = $SignageGeneratorModel->retrieveRecipes();

		// print_var($recipe_information);
		// print_var(Session::get('recipe_generate_signage'));

    	// content
    	require APP_PATH . 'views/signagegenerator/signage/8.5_by_11.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';    	
    }









	public function loadMenu()
	{
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// get data
		$MenuManagerModel = new MenuManagerModel;
		$menus = $MenuManagerModel->retrievePremadeMenus();

		// content
		require APP_PATH . 'views/menumanager/sidebar.php';
		require APP_PATH . 'views/menumanager/loadmenu/content.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';
    }

    /**
     * Method calls a model that adds a menu into the client workspace with some basic checks
     * 
     * @return [type] [description]
     */
    public function loadMenuAction($parameter)
    {
		// instantiate model
		$MenuManagerModel = new MenuManagerModel;

		// check if requested menu has already been added, otherwise add the menu to user's workspace
		if ($MenuManagerModel->menuAlreadyAdded($parameter) == true) {

			Session::add('feedback_errors', ErrorMessage::get('MENU_ALREADY_ADDED'));
			Helper::redirect('menumanager/loadmenu');

		} else {

			$MenuManagerModel->addMenu($parameter);
			Session::add('feedback_errors', ErrorMessage::get('MENU_ADDED'));
			Helper::redirect('menumanager/managemenus');

		}
    }

    /**
     * Sub-controller for managing menus
     * @return void
     */
    public function manageMenus()
    {
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// get data
		$MenuManagerModel = new MenuManagerModel;
		$addedMenus = $MenuManagerModel->retrieveAddedMenus();		

		// content
		require APP_PATH . 'views/menumanager/sidebar.php';
		require APP_PATH . 'views/menumanager/managemenus/content.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';
    }

    public function deleteMenu($parameter)
    {
		// instantiate model
		$MenuManagerModel = new MenuManagerModel;

		// invoke method
		$MenuManagerModel->delteMenuPerform($parameter);
		Session::add('feedback_errors', ErrorMessage::get('MENU_DELETED'));
		Helper::redirect('menumanager/managemenus');
    }

    /**
     * Sets the menu as active by storing menu name in session
     * @return [type] [description]
     */
    public function activateMenu($parameter) 
    {
		// instantiate model
    	$MenuManagerModel = new MenuManagerModel;

    	// retrieve data
    	$menuName = $MenuManagerModel->retrieveMenuName($parameter);

    	// flatten array by one level
    	$menuName = call_user_func_array('array_merge', $menuName);

    	Session::set('active_menu', $menuName);
    	Session::add('feedback_errors', ErrorMessage::get('MENU_ACTIVATED'));
    	Helper::redirect('menumanager/managemenus');
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