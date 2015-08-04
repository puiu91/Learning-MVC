<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

	<?php

	// constant [ROOT] stores the project folder path of the form C:\wamp\www\Testing\Learning-MVC\
	define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
	echo "ROOT: <br>";
	var_dump(ROOT);

	// constant [APP] stores the application folder of the project of the form C:\wamp\www\Testing\Learning-MVC\application\
	define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
	echo "APP: <br>";
	var_dump(APP);

	// require functions
	require(APP . '/functions/functions.php');

	// require configuration file
	require(APP . '/config/application.php');

	// load application layer
	require(APP . '/core/ApplicationInterfaceLayer.php');

	// load form controller (to be refactored)
	include(APP . '/controllers/FormController.php');

	// start application by instantiating object
	$application = new ApplicationInterfaceLayer;


	// invoke controller 
	new FormController;


	var_dump($_POST);

	?>

	<form action="index.php" method="post">
		<input type="text" name="name">
		<input type="submit">
	</form>

</body>
</html>