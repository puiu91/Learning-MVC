<?php 

/**
 * Abstract class controller
 * 
 */
// require(APP . '/core/Controller.php');

/**
 * Login form validator 
 * 
 */
require(APP . '/models/LoginFormValidator.php');

/**
* Controller for login form
* 
*/
class LoginController extends Controller
{
	public $username;
	public $password;
	public $errors = array();

	function __construct()
	{
		echo $_SERVER['REQUEST_URI'];
		$this->validateLoginCredentails();
	}

	public function index() {
		// load views
		// require(APP . 'views/templates/login/header.php');
		require_once(APP . 'views/login/login.php');
	}

	public function validateLoginCredentails() {

		// send form data to the model
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// clean user input
			array_htmlspecialchars($_POST);

			// store username and password in object
			$this->username = $_POST['username'];
			$this->password = $_POST['password'];

			// invoke login form validator
			$LoginFormValidator = new LoginFormValidator;
			$LoginFormValidator->validateFormData($_POST);

			// get errors array
			$errorsArray = $LoginFormValidator->getErrorsArray();

			if (filter_by_value($errorsArray, 'error', '1')) {
				
				// render errors to client
				require_once(APP . 'views/login/login.php');
			} else {

			}

			echo "<br><br>ERRORS START: <br>";
			print_var($errorsArray);


			// render errors to client
			// require(APP . 'views/login/login.php');
			echo "HELLLLLO";

			echo URL_WITH_INDEX_FILE;

			
		}

	}
}


?>