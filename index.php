<?php

// constant [ROOT] stores the project folder path of the form C:\wamp\www\Testing\Learning-MVC\
// define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('BASE_PATH', realpath(__DIR__) . DIRECTORY_SEPARATOR);
// echo "ROOT: <br>";
// var_dump(ROOT);

// constant [APP] stores the application folder of the project of the form C:\wamp\www\Testing\Learning-MVC\application\
// define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'application' . DIRECTORY_SEPARATOR);
// echo "APP: <br>";
// var_dump(APP);

// require functions
require(APP_PATH . '/functions/functions.php');

// DEBUGGING
// echobr('BASE_PATH');
// var_dump(BASE_PATH);
// echobr('APP_PATH');
// var_dump(APP_PATH);




// require errors
require(APP_PATH . '/core/ErrorMessage.php');

// require session
require(APP_PATH . '/core/Session.php');

// require view
require(APP_PATH . '/core/View.php');

// require configuration file
require(APP_PATH . '/config/application.php');

// load database
require(APP_PATH . 'config/Database.php');

// load application layer
require(APP_PATH . '/core/ApplicationInterfaceLayer.php');

// load form controller (to be refactored)
include(APP_PATH . '/controllers/FormController.php');

// load form controller (to be refactored)
include(APP_PATH . '/controllers/components/LoginCheckComponent.php');



// start the session
Session::initialize();

// $_SESSION['logged_in'] = false;
// $_SESSION['logged_in'] = true;
print_var($_SESSION);

// if (LoginCheckComponent::isLoggedIn()) {
	// echo "LOGGED IN <br>";

	// start application through instantiation of object
	$application = new ApplicationInterfaceLayer;

// } else {
	// render splash page
	// include('splash.html');
	// echo "NOT LOGGED IN";
// }

// invoke controller 
// new FormController;


// var_dump($_POST);

?>


<!-- <form action="" method="post"> -->
	<!-- <input type="text" name="name"> -->
	<!-- <input type="submit"> -->
<!-- </form> -->