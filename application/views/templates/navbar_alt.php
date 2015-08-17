<?php

$sidebar_links = array(
	'index.php'       => array('page_name' => 'SMG Online'),
	'menumanager.php' => array('page_name' => 'Menu Manager'),
	'recipes.php'     => array('page_name' => 'Recipes'),
	'signagegenerator.php'     => array('page_name' => 'Signage Generator'),
);

$current_page  = basename($_SERVER['PHP_SELF']);
$mainController  = ($_SERVER['PHP_SELF']);


print_var($current_page);
// print_var($mainController);

?>

<body>

<!-- Container ::: Start -->
<div class="container">

     <!-- Navigation ::: Navbar ::: Start -->
     <div class="navbar navbar-inverse">

     	<div class="navbar-header">
     		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
     			<span class="icon-bar"></span>
     			<span class="icon-bar"></span>
     			<span class="icon-bar"></span>
     		</button>
     		<!-- <a class="navbar-brand" href="<?php echo URL_WITH_INDEX_FILE ?>">SMG Online</a> -->

     	</div>

     	<div class="navbar-collapse collapse">
     		<ul class="nav navbar-nav">

     			<?php

              	// Output the formatted html
     			foreach ($sidebar_links as $php_filename => $subarray):
                         foreach ($subarray as $page_title):

                              $php_filename = substr($php_filename, 0, strlen($php_filename)-4);

                              # Set class of active for the current page that the user is currently on otherwise output a LI without active as class
                              if ($php_filename == $current_page):
                                   echo "<li class=\"active\"><a href=" . $php_filename . ">" . $page_title . "</a></li>";
                                   // echo '<li class="active"><a href="'.$php_filename.'">'.$page_title.'</a></li>';
                              else:
                                   // echo "<li><a href=" . $php_filename . ">" . $page_title . "</a></li>";
                                   echo "<li><a href=" . URL_WITH_INDEX_FILE . $php_filename . ">" . $page_title . "</a></li>"; 
                              endif;

                         endforeach;
                    endforeach;

                    ?>

               </ul>

               <div class="navbar-form navbar-right">
               	<?php if (isset($_SESSION['active_menu'])): ?>
               		<a class="btn btn-primary" href="<?php echo URL_WITH_INDEX_FILE . 'menumanager/managemenus' ?>" role="button">Active Menu - <?php echo Session::getNested('active_menu', 'menu_name'); ?></a>
               	<?php else: ?>
               		<button class="btn btn-danger" type="submit">No Active Menu Selected</button>
               	<?php endif; ?>

               	<div class="form-group">
               		<a class="btn btn-danger" href="http://localhost/Learning-MVC/logout.php" role="button">Logout</a>
               	</div>
               </div>

           </div>
           <!-- Navigation ::: Navbar Collapse ::: End -->
     </div>
     <!-- Navigation ::: Navbar ::: End -->