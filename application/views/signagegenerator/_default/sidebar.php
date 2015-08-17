<?php

$sidebar_receipts = array(
	URL_WITH_INDEX_FILE . 'signagegenerator/premade' => array('page_name' => 'Premade Template'),
	URL_WITH_INDEX_FILE . 'signagegenerator/custom'  => array('page_name' => 'Create Custom')
);

/**
 *
 * Request basename of the current open webpage
 *
 */

$current_page = Helper::baseName();

?>

	<!-- Row ::: Start -->
	<div class="row">

		<!-- Section ::: Sidebar ::: Start -->
		<div class="col-sm-3">
		
			<div class="list-group">

				<?php foreach ($sidebar_receipts as $php_filename => $subarray): ?>

						<?php 

						// explode url string
						$explodeUrl = explode('/', $php_filename);
						// store name of controller being requested
						$controller = $explodeUrl[6];
	
						?>

						<?php if ($controller == $current_page): ?>

							<a href="<?php echo $php_filename ?>" class="list-group-item active"><?php echo $subarray['page_name'] ?></a>

						<?php else: ?>

							<a href="<?php echo $php_filename ?>" class="list-group-item"><?php echo $subarray['page_name'] ?></a>

						<?php endif;?>

				<?php endforeach; ?>

			</div>
		</div>
		<!-- Section ::: Sidebar ::: End -->