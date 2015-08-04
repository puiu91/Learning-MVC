<?php 

// load functions
require_once('application/functions/functions.php');

// load abstract controller
require_once('application/core/controller.php');

// load model
require_once('application/models/formValidator.php');

/**
 * 
 */
class FormController extends Controller
{
	public function __construct() 
	{
		$this->redirectPostRequest();
	}

	/**
	 * Controls direction of inbound POST data by intercepting it and sending it
	 * to the correct model and then loads the correct views
	 *
	 * Note - need a way to determine the amount of input fields and their types, 
	 * 		which will help in determing what error checking needs to be done.
	 * 		This should be a model that parses out the POST array
	 * 
	 * @return [type] [description]
	 */
	public function redirectPostRequest()
	{
		// send form data to the model
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// invoke form validator model
			$FormValidator = new FormValidator();
			$FormValidator->validateFormData($_POST);
			// get errors array
			$errorsArray = $FormValidator->getErrorsArray();

			// determine if an error was flagged due to illegal user input
			if (filter_by_value($errorsArray, 'error', '1')) {

				// debug
               	// print_var($errorsArray);
				// echo "Error exists";

				// render errors to client 
				require ('application/views/view.render_form_errors.php');

				echo "HERE IS THE VIEW" . "<br>";
               } else {

				// require APP . 'controller/' . $this->url_controller . '.php';
				// $this->url_controller = new $this->url_controller();

				// redirect user to a success page
                    // header('Location: success_page.php');

               }
			
		}	
	}
}

?>