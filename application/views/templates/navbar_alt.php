<?php

$sidebar_links = array(
     'menumanager.php' => array('page_name' => 'Menu Manager'),
     'recipes.php'   => array('page_name' => 'Recipes'),
     'dashboard.php' => array('page_name' => 'Menu Boards'),
);

$current_page  = basename($_SERVER['PHP_SELF']);

?>

<body>

<!-- Container ::: Start -->
<div class="container">

     <!-- Navigation ::: Navbar ::: Start -->
     <div class="navbar navbar-default">
          <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="<?php echo URL_WITH_INDEX_FILE ?>">SMG Online</a>
          </div>
          <div class="navbar-collapse collapse">
               <ul class="nav navbar-nav">

                    <?php

                    # Output the formatted html
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
                    <div class="form-group">
                         <a class="btn btn-default" href="logout.php" role="button">Logout</a>
                    </div>
               </div>

          </div>
     </div>
     <!-- Navigation ::: Navbar ::: End -->

     <!--
     <div class="navigation">
          <ul>
               <li><a href="<?php echo URL_WITH_INDEX_FILE; ?>"><?php echo URL_WITH_INDEX_FILE; ?>home</a></li>
               <li><a href="<?php echo URL_WITH_INDEX_FILE; ?>home/exampleone"><?php echo URL_WITH_INDEX_FILE; ?>home/exampleone</a></li>
               <li><a href="<?php echo URL_WITH_INDEX_FILE; ?>home/exampletwo"><?php echo URL_WITH_INDEX_FILE; ?>home/exampletwo</a></li>
               <li><a href="<?php echo URL_WITH_INDEX_FILE; ?>songs/"><?php echo URL_WITH_INDEX_FILE; ?>songs/index</a></li>
               <li><a href="<?php echo URL_WITH_INDEX_FILE; ?>login/"><?php echo URL_WITH_INDEX_FILE; ?>login/index</a></li>
          </ul>
     </div>
     -->