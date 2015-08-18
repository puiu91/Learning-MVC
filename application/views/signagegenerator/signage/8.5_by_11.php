		<div class="col-sm-12">

			<div class="well-main">
				<h2>Manage Menus</h2>
				<p class="lead">select a premade menu template to customise</p>
				<hr>

				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Tip !</strong> Once you are happy with your menu template, click on the printer sign (top left menu bar below) to send to printer.
				</div>

				<?php View::displayFeedbackMessages(); ?>

				<script src="<?php Helper::url('application/assets/js/ckeditor/ckeditor.js'); ?>"></script>

				<form>
					<textarea name="editor1" id="editor1" rows="10" cols="80">
						<!-- Premade menu template start -->
						<p style="text-align:center"><span style="font-size:36px"><?php echo $recipe_information[0]['recipe_name'] ?></span></p>

						<p style="text-align:center"><span style="font-size:36px"><img alt="" src="http://images.clipartpanda.com/burger-20clip-20art-burger-clip-art-4.png" style="height:288px; width:288px" /></span></p>

						<p style="text-align:center"><span style="font-size:36px">Enjoy an amazing burger fresh </span></p>

						<p style="text-align:center"><span style="font-size:36px">off the grill</span></p>

						<table align="center" border="1" cellpadding="5" cellspacing="0">
							<tbody>
								<tr>
									<td style="text-align:center"><strong>Calories</strong></td>
									<td style="text-align:center"><strong>Saturated Fat</strong></td>
									<td style="text-align:center"><strong>Fat</strong></td>
									<td style="text-align:center"><strong>Protein</strong></td>
									<td style="text-align:center"><strong>Sugar</strong></td>
									<td style="text-align:center"><strong>Cholesterol</strong></td>
								</tr>
								<tr>
									<td style="text-align:center"><?php echo $recipe_information[0]['calories'] ?></td>
									<td style="text-align:center"><?php echo $recipe_information[0]['saturated_fat'] ?></td>
									<td style="text-align:center"><?php echo $recipe_information[0]['total_fat'] ?></td>
									<td style="text-align:center"><?php echo $recipe_information[0]['protein'] ?></td>
									<td style="text-align:center"><?php echo $recipe_information[0]['sugars'] ?></td>
									<td style="text-align:center"><?php echo $recipe_information[0]['cholesterol'] ?></td>
								</tr>
							</tbody>
						</table>

						<p style="text-align:center">&nbsp;</p>

						<p style="text-align:center"><span style="font-size:36px">$6.99</span></p>

						<p style="text-align:center">&nbsp;</p>
						<!-- Premade menu template end -->
					</textarea>
					<script>
						// CKEDITOR.replace( 'editor1' );
						
						CKEDITOR.replace( 'editor1', {
							height: 700,
							/* Default CKEditor styles are included as well to avoid copying default styles. */
							// contentsCss: [ 'http://cdn.ckeditor.com/4.5.2/standard-all/contents.css', 'http://sdk.ckeditor.com/samples/assets/css/classic.css' ]
						} );						
						
					</script>
				</form>

			</div>
			<!-- Well Main ::: End -->

			<!--
			<div class="well-main">
				<h2>Custom Made Menus</h2>
				<hr>


				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Menu Name</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>							
							<td>Nothing to display, feature not implemented yet</td>
							<td></td>
						</tr>
					</tbody>
				</table>

			</div>
			-->

		</div>