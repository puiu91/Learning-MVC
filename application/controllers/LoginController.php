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
	 * The login form action field requests the method attemptLogin via domain/login/attemptLogin 
	 * Example: <form action="login/attemptLogin"></form>
	 * 
	 * @return void
	 */
	public function attemptLogin()
	{
		$LoginModel = new LoginModel;

		// store boolean representing if client credentials matched database record
		$login_successful = $LoginModel->validateLoginForm($_POST);

		echobr("Login is:");
		var_dump($login_successful);

		if ($login_successful) {
			// store in session
			$_SESSION['logged_in'] = true;
			// redirect to dashboard
			header('Location: ' . URL_WITH_INDEX_FILE);
		} else {
			// redirect to login screen
			header('Location: ' . URL_WITH_INDEX_FILE . 'login');
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