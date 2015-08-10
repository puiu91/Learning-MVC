<?php

/**
 * Class that structures all subsequent views using statically accessible methods
 * 
 */
class View {
	/**
	 * Display feedback template to client and delete errors from the session
	 * 
	 * @return void
	 */
	public static function displayFeedbackMessages() 
	{
		// display error messages to client
		if (isset($_SESSION['feedback_errors'])) {
			foreach ($_SESSION['feedback_errors'] as $index => $errorMessage) {
				require(APP_PATH . '/views/templates/feedback.php');
			}
		}

		// TODO ::: display success messages to client

		// clear and reset the errors from session
		Session::set('feedback_errors', null);
	}
}

?>