<?php

$sidebar_receipts = array(
	'home/masterRecipes.php' => array('page_name' => 'Master Recipes'),
	'home/exampletwo'  => array('page_name' => 'Incomes'),
	// 'new_receipt.php'   => array('page_name' => 'New Receipt'),
	// 'new_income.php'    => array('page_name' => 'New Income'),
	// 'categories.php'    => array('page_name' => 'Categories'),
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
					<?php foreach ($subarray as $page_title): ?>

						<?php if ($php_filename == $current_page): ?>

							<a href="<?php echo $php_filename ?>" class="list-group-item active"><?php echo $page_title ?></a>

						<?php else: ?>

							<a href="<?php echo $php_filename ?>" class="list-group-item"><?php echo $page_title ?></a>

						<?php endif;?>

					<?php endforeach; ?>
				<?php endforeach; ?>

			</div>
		</div>
		<!-- Section ::: Sidebar ::: End -->