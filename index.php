<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

	<?php

	// constant [ROOT] stores the projects folder path
	// i.e, C:\wamp\www\Testing\Learning-MVC\
	define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
	echo "ROOT: <br>";
	var_dump(ROOT);

	// constant [APP] stores the application folder of the project
	// i.e., C:\wamp\www\Testing\Learning-MVC\application\
	define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
	echo "APP: <br>";
	var_dump(APP);

	// load configuration file
	require(APP . '/config/config.php');

	// invoke application layer
	require(APP . '/core/ApplicationInterfaceLayer.php');

	// invoke form controller (to be refactored)
	include(APP . '/controllers/FormController.php');

	// launch the application
	$application = new ApplicationInterfaceLayer();


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