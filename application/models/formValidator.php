<?php

/**
 * Class that validates form input fields
 * 
 */
class FormValidator
{
	public $postData;
	public $formFieldErrors = array(
		'field empty' 		   	   => array('error' => false, 'message' => 'Empty field'),
		'not alphanumeric' 		   => array('error' => false, 'message' => 'Does not contain letters or numbers'),
		'contains exclamation mark' => array('error' => false, 'message' => 'Contains an exclamation mark'),
	);

	/**
	 * Runs validation on form inputs
	 *
	 * note - need a master class that uses the input field name and an array of 
	 * 		the types of error checking required and returns the result set
	 * 
	 * @param  array $postData
	 * @return array Returns errors array to requestor
	 */
	public function validateFormData($postData)
	{
		// check for empty field
		if (empty($postData['name'])) {
			$this->formFieldErrors['field empty']['error'] = true;
		}

		// ensure only letters or numbers are used
		if (!ctype_alnum($postData['name'])) {
			$this->formFieldErrors['not alphanumeric']['error'] = true;
		}

		// check for exclamation mark
		if (contains('!', $postData['name'])) {
			$this->formFieldErrors['contains exclamation mark']['error'] = true;
		}
	}

	/**
	 * Send the errors array to requestor
	 * 
	 * @return array
	 */
	public function getErrorsArray() 
	{
		return $this->formFieldErrors;
	}
}

?>