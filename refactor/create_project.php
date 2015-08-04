<?php

# Functions and Classes
include('php/includes/functions.php');
include('php/includes/classes.php');

# Include helper class
include('php/includes/class.HelperClass.php');

# Include classes relevant to page
include('php/includes/class.CreateNewProject.php');

/**
 *
 * Require dependency for access to PDO database singleton
 *
 */
require_once('php/includes/config/class.Database.php');


# Check if user is logged in
$class = new user_functionality;

$class->isLoggedIn();
$class->checkAccountTypeStudent();

/**
 *
 * Create new project object
 *
 */

$createNewProject = new CreateNewProject;
$createNewProject->validateNewProject();
$errors = $createNewProject->getErrorsArray();

// print_array($_POST);
// print_array($_FILES);
// print_array($_SESSION);

?>





<!-- Head ::: -->
<?php include("php/layout/head.php"); ?>
<!-- Head ::: -->



<!-- Date Picker ::: Requirements -->
<link rel="stylesheet" href="css/jQueryUI-theme/jquery-ui-1.10.3.custom.min.css" />
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script>
$(function() {
     $(":input[name=projectDueDate]").datepicker({ minDate: 0, dateFormat: "yy-mm-dd" });
});
</script>
<!-- Date Picker ::: Requirements -->



<body>

     <div class="container">

          <!-- Navbar ::: -->
          <?php include("php/layout/navbar.php"); ?>
          <!-- Navbar ::: -->

          <!-- Row ::: -->
          <div class="row">

               <!-- Column ::: Sidebar Navigation -->
               <div class="col-sm-3">
                    <?php include("php/layout/sidebar.php"); ?>
               </div>
               <!-- Column ::: Sidebar Navigation -->

               <!-- Column ::: Main Content -->
               <div class="col-sm-9">

                    <!-- Well ::: Create New Project Input Fields -->
                    <div class="well-info">

                         <h1>Create a New Project</h1>

                         <hr>



                         <!-- Errors ::: -->
                         <?php if (isset($errors)): ?>
                              <?php foreach ($errors as $error_index => $sub_array): ?>
                                   <?php if ($sub_array['error'] == 1): ?>

                                   <div class="alert alert-danger fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>Warning!</strong> <?php echo $sub_array['message'] ?>
                                   </div>

                                   <?php endif; ?>
                              <?php endforeach; ?>
                         <?php endif ?>
                         <!-- Errors ::: -->



                         <!-- Form ::: -->
                         <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">

                              <!-- Panel :: Project Information -->
                              <div class="panel panel-default">
                                   <div class="panel-heading"><h3 class="panel-title">Project Information</h3></div>

                                   <!-- Pannel :: Body -->
                                   <div class="panel-body">

                                        <!-- Input Field ::: Project Name -->
                                        <div class="form-group">
                                             <label for="projectName" class="col-lg-2 control-label">Project Name</label>
                                             <div class="col-lg-6">
                                                  <input type="text" class="form-control" name="projectName" placeholder="Project Name"
                                                         value="<?php if (!empty($_POST['projectName'])) echo $_POST['projectName']; ?>" />
                                             </div>
                                        </div>
                                        <!-- Input Field ::: Project Name -->

                                        <!-- Input Field ::: Facilitator -->
                                        <div class="form-group">
                                             <label for="facilitator" class="col-lg-2 control-label">Facilitator</label>
                                             <div class="col-lg-6">
                                                  <input type="text" class="form-control" name="facilitator" placeholder="Instructor"
                                                         value="<?php HelperClass::isset_echo($_POST, 'facilitator') ?>" />
                                                  <span class="help-block">A facilitator is a professor or business representative</span>
                                             </div>

                                        </div>
                                        <!-- Input Field ::: Facilitator -->

                                        <!-- Input Field ::: Calendar -->
                                        <div class="form-group">
                                             <label for="project_due_date" class="col-lg-2 control-label">Due Date</label>
                                             <div class="col-lg-3">
                                                  <input type="text" class="form-control" name="projectDueDate" value="<?php HelperClass::isset_echo($_POST, 'projectDueDate') ?>">
                                             </div>
                                        </div>
                                        <!-- Input Field ::: Calendar -->

                                   </div>
                                   <!-- Pannel :: Body -->

                              </div>
                              <!-- Panel :: Project Information -->



                              <!-- Panel :: Project Description -->
                              <div class="panel panel-default">
                                   <div class="panel-heading"><h3 class="panel-title">Project Description</h3></div>

                                   <!-- Pannel :: Body -->
                                   <div class="panel-body">

                                        <!-- Input Field ::: Description -->
                                        <div class="form-group">
                                             <label for="projectName" class="col-lg-2 control-label">Description</label>
                                             <div class="col-lg-8">

                                                  <textarea class="form-control" name="projectDescription" rows="10"
                                                            placeholder="Type your project description here"><?php if (isset($_POST['projectDescription'])) { echo $_POST['projectDescription']; } ?></textarea>


                                                  <p class="help-block"><strong>Tip:</strong> Use at least 100 characters to describe your project.</p>
                                             </div>
                                        </div>
                                        <!-- Input Field ::: Description -->

                                   </div>
                                   <!-- Pannel :: Body -->

                              </div>
                              <!-- Panel :: Project Description -->



                              <!-- Panel :: Confidentiality Agreement -->
                              <div class="panel panel-default">
                                   <div class="panel-heading"><h3 class="panel-title">Confidentiality Agreement</h3></div>

                                   <div class="panel-body">


                                        <?php if (isset($_SESSION['Create_New_Project'])): ?>

                                             <div class="bs-callout bs-callout-info">
                                                  <h4><strong>Previous File Upload</strong></h4>
                                                  <p>You have previously uploaded a file named: <strong><?php echo $_SESSION['Create_New_Project']['file_name'] ?></strong></p>
                                                  <p>If you wish to upload a different confidentiality agreement, then simply upload a new one below.</p>
                                             </div>

                                             <hr>

                                        <?php endif; ?>

                                        <div class="well">
                                             <p>Due to the nature of certain projects, McMaster requires that members who join projects agree to the McMaster confidentiality agreement. If you have your own agreement that you would like use in addition to that of McMaster's default one, then simply upload it below.</p>
                                        </div>

                                        <!-- Group Size -->
                                        <div class="form-group">
                                             <label for="confidentialityAgreement" class="col-lg-2 control-label">File input</label>
                                             <div class="col-lg-4">
                                                  <input type="file" name="confidentialityAgreement" id="confidentialityAgreement" />
                                                  <p class="help-block">Please use a PDF or Word file</p>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                              <!-- Panel :: Confidentiality Agreement -->



                              <!-- Submit Form -->
                              <a href="create_project.php">
                                   <button type="submit" name="submit" class="btn btn-primary btn-large">Submit Project</button>
                              </a>

                         </form>
                         <!-- Form ::: -->

                    </div>
                    <!-- Well ::: Create New Project Input Fields -->

               </div>
               <!-- Column ::: Main Content -->

          </div>
          <!-- Row ::: -->

     </div>
     <!-- Container -->

</body>
</html>




