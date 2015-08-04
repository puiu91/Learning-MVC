<?php 


	// constant [ROOT] stores the projects folder path
	// i.e, C:\wamp\www\Testing\Learning-MVC\
	define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
	// var_dump(ROOT);

	// constant [APP] stores the application folder of the project
	// i.e., C:\wamp\www\Testing\Learning-MVC\application\
	define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
	// var_dump(APP);

	// load configuration file
	require('../config/config.php');

	// invoke form controller (to be refactored)
	include('../core/ApplicationInterfaceLayer.php');

	// launch the application
	$application = new ApplicationInterfaceLayer();

 ?>