<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

class RecipesController
{
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
        require APP_PATH . 'views/recipes/sidebar.php';

        // content
            // <col-sm-9></end-col>
        require APP_PATH . 'views/recipes/content.php';

        // footer 
            // <footer></footer>
            // </container>
            // </body>
            // </html>
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