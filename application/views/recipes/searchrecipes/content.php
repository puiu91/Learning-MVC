		<div class="col-sm-9">

			<?php View::displayFeedbackMessages(); ?>

			<!-- Well Main ::: Start -->
			<div class="well-main">

				<div class="row">

					<div class="col-lg-4">
						<h2>Search Recipes</h2>
					</div>

					<div class="col-lg-8">
						<form style="margin-bottom: 0px" method="post" action="searchrecipes" >
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="Search by keywords...">
								<span class="input-group-btn">
									<button class="btn btn-primary btn-search" type="submit"><strong>Search</strong></button>
								</span>
							</div>
						</form>
					</div>
					<!-- Column ::: End -->
				</div>
				<!-- Row ::: End -->
			</div>
			<!-- Well Main ::: End -->



			<!-- Well Main ::: Start -->
			<div class="well-main">

				<h2 class="margin-top-clear">Search results for... <?php if (isset($_POST['search'])) { Helper::isset_then_echo($_POST['search']); } ?></h2>

				<hr>
				<br>

                <?php if (isset($recipeSearchResults) && !empty($recipeSearchResults)): ?>

                     <!-- <div class="alert alert-info" role="alert"><strong>Hint:</strong> Click on the columns to sort</div> -->

                     <table id="sort" class="table table-striped table-hover table-bordered" style="font-size: 12px;">
                          <thead>
                               <tr>
                                    <th>FMS Code</th>
                                    <th>Recipe Name</th>
                                    <th>Station</th>
                                    <th>Serving Size (g)</th>
                                    <th>Options</th>
                               </tr>
                          </thead>

                          <tbody>

                               <?php foreach ($recipeSearchResults as $k => $value): ?>

                                    <tr>
                                         <td><?php echo $recipeSearchResults[$k]['fms_code'] ?></td>
                                         <td><?php echo $recipeSearchResults[$k]['recipe_name']  ?></td>
                                         <td><?php echo $recipeSearchResults[$k]['serving_station']  ?></td>
                                         <td><?php echo $recipeSearchResults[$k]['serving_size']  ?></td>
                                         <td><a href="<?php echo URL_WITH_INDEX_FILE . 'recipes/addrecipe/' . $recipeSearchResults[$k]['id']; ?>"><button type="button" class="btn btn-success btn-xs">Add to menu</button></a></td>
                                         <!-- <td><a href="#"><button type="button" class="btn btn-success btn-xs">Add to menu</button></a></td> -->
                                         <!-- <a href="<?php echo URL_WITH_INDEX_FILE . 'menumanager/activatemenu/' . $v['menu_id']; ?>"><button type="button" class="btn btn-primary btn-xs">Open Menu</button></a> -->
                                    </tr>

                               <?php endforeach; ?>
                                    
                          </tbody>
                     </table>

                <?php else: ?>

                <div class="bs-callout bs-callout-info">
                     <h4><strong>No search results found</strong></h4>
                     <p>Your search query did not return any results. Try using fewer keywords.</p>
                </div>

                <?php endif;?>    

			</div>
			<!-- Well Main ::: End -->

		</div>
		<!-- Column ::: End -->