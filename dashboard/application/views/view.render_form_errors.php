<!-- Errors ::: -->
<?php if (isset($errorsArray)): ?>
	<?php foreach ($errorsArray as $error_index => $sub_array): ?>
		<?php if ($sub_array['error'] == 1): ?>

			<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Warning!</strong> <?php echo $sub_array['message'] ?>
			</div>

		<?php endif; ?>
	<?php endforeach; ?>
<?php endif ?>
<!-- Errors ::: -->