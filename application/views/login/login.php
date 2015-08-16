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