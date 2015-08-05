<?php

// access to PDO database singleton
require_once('config/class.Database.php');

/**
 * Class that creates a new project with built in validation of form input fields
 */
class CreateNewProject
{
     public $account_id;
	public $project_name;
	public $facilitator;
	public $project_due_date;
	public $project_description;
	public $file_name;
	public $file_temp_name;
	public $file_error;
	public $file_extension;
	public $file_directory;
	public $errors = array();

     public function __construct() 
     {
          $this->account_id = HelperClass::getAccountID();

          $this->errors = array(
               // errors for input fields
			'project_name'             => array('error' => 0, 'message' => 'Project name is not valid. Use letters and numbers only.'),
			'project_exists'           => array('error' => 0, 'message' => 'A project with this name already exists.'),
			'instructor'               => array('error' => 0, 'message' => 'Facilitator name is not valid. Use letters, numbers, dashes, and periods only.'),
			'project_description'      => array('error' => 0, 'message' => 'Project description must be at least 100 characters.'),
			'project_due_date_invalid' => array('error' => 0, 'message' => 'Please select a valid date.'),
			'empty'                    => array('error' => 0, 'message' => 'A required field was left empty.'),
               
               // errors for file uploading
               'file_size_rejected_by_server' => array('error' => 0, 'message' => 'The file size is too large. Please ensure your file is 2 megabytes or less in size'),
               'file_invalid_extension'       => array('error' => 0, 'message' => 'Invalid file extension.'),
               'file_disk_write_error'        => array('error' => 0, 'message' => 'The file could not be uploaded to the server. Please try again in a few minutes'),
          );
     }

     /**
      * Validates new projects being created by performing error checks on user input
      * @return boolean Returns false if user input fields threw an error
      */
     public function validateNewProject() 
     {

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

               array_htmlspecialchars($_POST);

               $this->project_name        = $_POST['projectName'];
               $this->facilitator         = $_POST['facilitator'];
               $this->project_due_date    = $_POST['projectDueDate'];
               $this->project_description = trim($_POST['projectDescription']);

               // validate project name
               if (!ctype_alnum(remove_whitespace($this->project_name))) {
                    $this->errors['project_name']['error'] = 1;
               } elseif ($this->projectAlreadyExists() == TRUE) {
                    $this->errors['project_exists']['error'] = 1;
               }

               // validate instructor name
               if (validate_instructor($this->facilitator) == FALSE) {
                    $this->errors['instructor']['error'] = 1;
               }

               // validate project description
               if (strlen($this->project_description) < 100) {
                    $this->errors['project_description']['error'] = 1;
               }

               // validating due date field by attempting to make a DateTime object 
               if (DateTime::createFromFormat("Y-m-d", $this->project_due_date) == false) {
                    $this->errors['project_due_date_invalid']['error'] = 1;
               }

               // check for empty fields
               if (empty($this->project_name) OR empty($this->facilitator)) {
                    $this->errors['empty']['error'] = 1;
               }

               // check if a file was uploaded and if so run validation
               $this->confidentiality_agreement_file_validation();

               // run through the errors array and check if any errors are set to 1
               $error_exists = 0;

               foreach ($this->errors as $key => $value) {
                    if ($this->errors[$key]['error'] == 1) {
                         $error_exists = 1;
                    }
               }

               // return true if file was validated
               if ($error_exists == 0) {

               	/**
               	 * insert project record to database depending on user type
               	 * 
               	 * note - professor accounts will update the claimed section automatically to 1
               	 * 		so that the project does not show up on the search results once claimed
               	 */
                    if ($_SESSION['Account_Type'] == 'Professor') {
                         $this->insertNewProjectProfessor();
                    } elseif ($_SESSION['Account_Type'] = 'Business') {
                         $this->insertNewProjectBusiness();
                    }

                    // save uploaded file to disk drive
                    if (!empty($_SESSION['Create_New_Project'])) {
                         $this->saveFileToDisk();
                    }

                    // unset session variable
                    unset($_SESSION['Create_New_Project']);

                    // redirect user
                    header('Location: create_project_success.php');

               } else {
                    return false;
               }
          }
     }

     /**
      * Handles uploading of the confidentiality document, checks filetype and throws exceptions if they exist
      * @return [type] [description]
      */
     public function confidentiality_agreement_file_validation() 
     {
          // define the upload directory
          define("UPLOAD_DIR", "uploads/agreements/" . $this->account_id . "/");

          $this->file_name      = $_FILES['confidentialityAgreement']['name'];
          $this->file_temp_name = $_FILES['confidentialityAgreement']['tmp_name'];
          $this->file_error     = $_FILES['confidentialityAgreement']['error'];
          $this->file_extension = pathinfo($this->file_name, PATHINFO_EXTENSION);
          $this->file_directory = UPLOAD_DIR;

          // determine if upload directory exists otherwise create it
          if (!is_dir($this->file_directory)) {
               mkdir($this->file_directory, 0700, TRUE);
          }

          // filetypes allowed
          $allowedFiletypes = array('pdf','doc','docx');

          /**
           * File upload validation logic
           *
           * (1) check if a file was uploaded
           * (2) check that file type is allowed (pdf, doc, docx)
           * (3) store the temporary file location and the file name in the SESSION. This is so that if the user made a mistake
           *     on the other form fields, he will not have to re-upload his file.
           */

          if (is_uploaded_file($this->file_temp_name) && $this->file_error !== UPLOAD_ERR_NO_FILE) {

               if ($this->file_error == UPLOAD_ERR_INI_SIZE) {

                    $this->errors['file_size_rejected_by_server']['error'] = 1;

               } elseif (!in_array($this->file_extension, $allowedFiletypes)) {

                    $this->errors['file_invalid_extension']['error'] = 1;

               } else {

                    // save file details to SESSION if it passed validation
                    $_SESSION['Create_New_Project']['file_name'] = $this->file_name;
                    $_SESSION['Create_New_Project']['tmp_name']  = $this->file_temp_name;
                    $_SESSION['Create_New_Project']['file_path'] = $this->file_directory . $this->file_name;

                    // move the file out of the temp directory or PHP will delete it when script ends
                    $temp_dir = $this->file_directory . "temp/";

                    if (!is_dir($temp_dir)) {
                         mkdir($temp_dir, 0700, TRUE);
                    }

                    move_uploaded_file(
                         $_SESSION['Create_New_Project']['tmp_name'],
                         $temp_dir . $this->file_name
                    );
               }
          }
     }

     /**
      * Determines if project with the same name already exists in database
      * @return booleon Returns true or false depending if project name exists
      */
     public function projectAlreadyExists() 
     {
          $statement_handle = Database::getInstance()->prepare(
               "SELECT project_name
                FROM   projects
                WHERE  project_name = :project_name"
          );

          $statement_handle->execute(array(
               ':project_name' => $this->project_name
          ));

          $result = $statement_handle->fetchAll(PDO::FETCH_ASSOC);

          if (empty($result)) {
               return FALSE;
          } else {
               return TRUE;
          }

     }

     /**
      * Inserts new project with characteristics for professor account
      * @return void
      */
     public function insertNewProjectProfessor() 
     {
          if (isset($_SESSION['Create_New_Project'])) {

               $statement_handle = Database::getInstance()->prepare(
                    "INSERT INTO projects
                     (
                          project_name,
                          instructor,
                          description,
                          account_id,
                          file_name,
                          file_path,
                          due_date,
                          claimed
                     )
                     VALUES
                     (
                          :project_name,
                          :instructor,
                          :description,
                          :account_id,
                          :file_name,
                          :file_path,
                          :due_date,
                          :claimed
                     )"
               );

               $statement_handle->execute(array(
                    ':project_name' => $this->project_name,
                    ':instructor'   => $this->facilitator,
                    ':description'  => $this->project_description,
                    ':account_id'   => $this->account_id,
                    ':file_name'    => $_SESSION['Create_New_Project']['file_name'],
                    ':file_path'    => $_SESSION['Create_New_Project']['file_path'],
                    ':due_date'     => $this->project_due_date,
                    ':claimed'      => 1
               ));

          } else {

               $statement_handle = Database::getInstance()->prepare(
                    "INSERT INTO projects
                     (
                          project_name,
                          instructor,
                          description,
                          account_id,
                          file_name,
                          file_path,
                          due_date,
                          claimed
                     )
                     VALUES
                     (
                          :project_name,
                          :instructor,
                          :description,
                          :account_id,
                          :file_name,
                          :file_path,
                          :due_date,
                          :claimed
                     )"
               );

               $statement_handle->execute(array(
                    ':project_name' => $this->project_name,
                    ':instructor'   => $this->facilitator,
                    ':description'  => $this->project_description,
                    ':account_id'   => $this->account_id,
                    ':file_name'    => 'confidentiality_agreement.docm',
                    ':file_path'    => 'uploads/agreements/default/confidentiality_agreement.docm',
                    ':due_date'     => $this->project_due_date,
                    ':claimed'      => 1
               ));

          }

     }

     /**
      * Inserts new project with characteristics for business account
      * @return void
      */
     public function insertNewProjectBusiness() 
     {
          if (isset($_SESSION['Create_New_Project'])) {

               $statement_handle = Database::getInstance()->prepare(
                    "INSERT INTO projects
                     (
                          project_name,
                          instructor,
                          description,
                          account_id,
                          file_name,
                          file_path,
                          due_date
                     )
                     VALUES
                     (
                          :project_name,
                          :instructor,
                          :description,
                          :account_id,
                          :file_name,
                          :file_path,
                          :due_date
                     )"
               );

               $statement_handle->execute(array(
                    ':project_name' => $this->project_name,
                    ':instructor'   => $this->facilitator,
                    ':description'  => $this->project_description,
                    ':account_id'   => $this->account_id,
                    ':file_name'    => $_SESSION['Create_New_Project']['file_name'],
                    ':file_path'    => $_SESSION['Create_New_Project']['file_path'],
                    ':due_date'     => $this->project_due_date
               ));

          } else {

               $statement_handle = Database::getInstance()->prepare(
                    "INSERT INTO projects
                     (
                          project_name,
                          instructor,
                          description,
                          account_id,
                          file_name,
                          file_path,
                          due_date
                     )
                     VALUES
                     (
                          :project_name,
                          :instructor,
                          :description,
                          :account_id,
                          :file_name,
                          :file_path,
                          :due_date
                     )"
               );

               $statement_handle->execute(array(
                    ':project_name' => $this->project_name,
                    ':instructor'   => $this->facilitator,
                    ':description'  => $this->project_description,
                    ':account_id'   => $this->account_id,
                    ':file_name'    => 'confidentiality_agreement.docm',
                    ':file_path'    => 'uploads/agreements/default/confidentiality_agreement.docm',
                    ':due_date'     => $this->project_due_date
               ));

          }

     }

     /**
      * Saves the confdentiality agreement file to disk
      * @return error Throws exception if file could not be saved to disk
      */
     public function saveFileToDisk()
     {
          // create new directory to save project confidentiality agreement
          $new_dir = $this->file_directory . "temp/" . $_SESSION['Create_New_Project']['file_name'];
          
          // move the temporary file we created earlier into the final directory
          try {
          	$save_to_disk = rename($new_dir, $_SESSION['Create_New_Project']['file_path']);	
          } catch (Exception $e) {
			throw($e);          	
          }

          // set permissions on the new file
          chmod($_SESSION['Create_New_Project']['file_path'], 0700);
     }

     /**
      * Sends errors array and its values to view for rendering to user
      * @return [type] [description]
      */
     public function getErrorsArray() 
     {
          return $this->errors;
     }

}

?>