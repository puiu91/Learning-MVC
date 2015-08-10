<?php 

/**
 * Abstract class controller
 * 
 */
// require(APP_PATH . '/core/Controller.php');

/**
 * Login model
 * 
 */
require(APP_PATH . '/models/LoginModel.php');

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
	}

	/**
	 * Load default views
	 * 
	 * @return void
	 */
	public function index() {
		require(APP_PATH . 'views/templates/login/header.php');
		require(APP_PATH . 'views/login/login.php');
	}

	/**
	 * Login <form action="login/attemptLogin"></form> which passes method login by localhost/login/attemptLogin
	 * Note - the first login is the controller and the second login is the method being requested in the controller
	 * @return [type] [description]
	 */
	public function attemptLogin()
	{
		$LoginModel = new LoginModel;

		// stores boolean representing if client credentials matched database record
		$login_successful = $LoginModel->validateLoginForm($_POST);

		echobr("Login is:");
		var_dump($login_successful);

		if ($login_successful) {
			// redirect to dashboard
			header('Location: ' . URL_WITH_INDEX_FILE);
		} else {
			// redirect to login
			header('Location: ' . URL_WITH_INDEX_FILE . 'login/index');
		}
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
			$LoginModel = new LoginModel;
			$LoginModel->validateFormData($_POST);

			var_dump($LoginModel->validateFormData($_POST));

			// get errors array
			$errorsArray = $LoginModel->getErrorsArray();

			if (filter_by_value($errorsArray, 'error', '1')) {
				
				// render errors to client
				require(APP_PATH . 'views/login/login.php');
			} else {

			}

			echo "<br><br>ERRORS START: <br>";
			print_var($errorsArray);

			// render errors to client
			// require(APP_PATH . 'views/login/login.php');
			echo "HELLLLLO";

			echo URL_WITH_INDEX_FILE;

			
		}

	}
}


?>