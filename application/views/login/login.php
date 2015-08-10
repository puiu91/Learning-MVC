<body>

     <div class="container">

          <form class="form-signin" method="post" role="form" action="<?php echo URL_WITH_INDEX_FILE; ?>login/attemptLogin">

               <div class="page-header">
                    <h1>Sign In </h1>
               </div>

               <?php View::displayFeedbackMessages(); ?>

               <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Username"
                           value="<?php if (!empty($_POST['username'])) echo $_POST['username']; ?>">
               </div>

               <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password">
               </div>

               <button type="submit" class="btn btn-lg btn-success">Sign In</button>
               <a class="btn btn-lg btn-primary" href="register.php">Register</a>
               <a class="btn btn-lg btn-default" href="forgot_password.php">Forgot password?</a>

          </form>

     </div>

</body>
</html>









































<?php

/*
$sth = $database_handle->prepare(
     "SELECT * FROM projects WHERE project_id = :project_id"
     );

$sth->execute(array(
     ':project_id' => $project_id
     ));

$db_project_info = $sth->fetch(PDO::FETCH_ASSOC);
*/

/*

# +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# CREATE DUE DATE
# +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if (isset($db_project_info) && !empty($db_project_info)) {

     # Get today's date and convert it to datetime object
     $today = date("Y-m-d");
     $today = new DateTime($today);

     # Get due date and convert it to datetime object
     $due_date = $db_project_info['due_date'];
     $due_date = new DateTime($due_date);

     # Set days remaining until due date is reached
     if ($due_date > $today) {
          # Due date has not been reached
          $days_remaining = $due_date->diff($today)->format("%a");
     } else {
          # Due date has been reached
          $days_remaining = 0;
     }

}


# +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# RETRIEVE PROJECT MEMBERS
# +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

# SQL Query ::: Retrieve project members
$statement_handle = $database_handle->prepare(
     "SELECT USERS.username, USERS.name, USERS.account_id
      FROM users USERS
      INNER JOIN projects_joined PJ ON USERS.account_id = PJ.account_id
      WHERE PJ.project_id = :project_id"
     );

$statement_handle->execute(array(
     ':project_id' => $project_id,
     ));

# Fetch query
$db_project_members = $statement_handle->fetchAll(PDO::FETCH_ASSOC);



 */

?>