		<div class="col-sm-9">

			<div class="well-main">
				<h2>Manage Menus</h2>
				<p class="lead">customize premade menu templates</p>
				<hr>

				<?php View::displayFeedbackMessages(); ?>

				<?php if (isset($addedMenus) and !empty($addedMenus)): ?>

					<table class="table table-striped">
						<thead>
							<tr>
								<th>Menu ID</th>
								<th>Menu Name</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($addedMenus as $k => $v): ?>

							<tr>
								<th><p><? echo $v['menu_id'] ?></p></th>
								<td><p><? echo $v['menu_name'] ?></p></td>
								<td>
									<a href="<?php echo URL_WITH_INDEX_FILE . 'menumanager/activatemenu/' . $v['menu_id']; ?>"><button type="button" class="btn btn-primary btn-xs">Open Menu</button></a>
									<a href="<?php echo URL_WITH_INDEX_FILE . 'menumanager/deletemenu/' . $v['menu_id']; ?>"><button type="button" class="btn btn-danger btn-xs">Delete Menu</button></a>
								</td>
								<!-- <td><a href="<?php echo URL_WITH_INDEX_FILE . 'menumanager/loadmenuaction/' . $v['menu_id']; ?>"><button type="button" class="btn btn-primary btn-xs">Open Menu</button></a></td> -->
							</tr>

							<?php endforeach; ?>

						</tbody>
					</table>

				<?php else: ?>

					<br>

					<div class="alert alert-success fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Note!</strong> You need to add a menu prior to being able to manage it, <a href="loadmenu">click here to add a menu now</a>
					</div>

				<?php endif; ?>



			</div>

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