<?php

/**
 * Login model
 * 
 */
require(APP_PATH . '/models/MenuManagerModel.php');

/**
 * Class MenuManager
 *
 * Used for creating the menus
 *
 */

class MenuManagerController
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
        require APP_PATH . 'views/menumanager/sidebar.php';

        // content
            // <col-sm-9></end-col>
        require APP_PATH . 'views/menumanager/content.php';

        // footer 
            // <footer></footer>
            // </container>
            // </body>
            // </html>
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

		// check if user has already added the menu
		$MenuManagerModel->menuAlreadyAdded($parameter);

		// check if the requested menu has already been added by the user otherwise add the menu to the user workspace
		if ($MenuManagerModel->menuAlreadyAdded($parameter) == false) {
			echobr("Menu added: FALSE");
			echobr('');
		} else {
			// store message to instruct user that they have already added this menu
			Session::add('feedback_errors', ErrorMessage::get('MENU_ALREADY_ADDED'));

			echobr("Menu added: TRUE");
			echobr('');
		}
		
		
		// $result = $MenuManagerModel->addMenu();
    		echo "THIS IS A TEST";
    }

    public function manageMenus() 
    {
		// header and navigation
		require APP_PATH . 'views/templates/header_alt.php';
		require APP_PATH . 'views/templates/navbar_alt.php';

		// content
		require APP_PATH . 'views/menumanager/sidebar.php';
		require APP_PATH . 'views/menumanager/managemenus/content.php';

		// footer
		require APP_PATH . 'views/templates/footer.php';
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