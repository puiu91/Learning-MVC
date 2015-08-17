		<div class="col-sm-9">

			<div class="well-main">
				<h2>Add Menu</h2>
				<p class="lead">add premade menus</p>
				<hr>

				<?php View::displayFeedbackMessages(); ?>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Menu ID</th>
							<th>Menu Name</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($menus as $k => $v): ?>

						<tr>
							<th><p><? echo $v['id'] ?></p></th>
							<td><p><? echo $v['menu_name'] ?></p></td>
							<td><a href="<?php echo URL_WITH_INDEX_FILE . 'menumanager/loadmenuaction/' . $v['id']; ?>"><button type="button" class="btn btn-success btn-xs">Add Menu</button></a></td>
						</tr>

						<?php endforeach; ?>

					</tbody>
				</table>

			</div>

		</div>