<?php
/**
 * Custom Sidebar Categories
 *
 * @package santa_cole
 */



/* ------------- Custom Excerpt for the CPT */
function woo_category_sidebar() {

	$tax_terms = get_terms(
								array(
									'taxonomy' => 'product_cat',
									'hide_empty' => false
								)
							);
	$tax_parents = get_terms(
								array(
									'taxonomy' 		=> 'product_cat',
									'hide_empty' 	=> false,
									'parent' 			=> 0,
								)
							);
							?>
	<div class="custom-sidebar d-none d-lg-block widget-shop">
		<span class="widgettitle d-block text-uppercase mb-3"><?php _e('Categorías', 'santa-cole') ?></span>
		<?php
		$current_id = get_queried_object_id();
		foreach ($tax_parents as $term_parent) {

			$term_url = get_term_link($term_parent->term_id,'product_cat');
			$current_parent = $term_parent->term_id;
			if ($term_parent->slug != 'uncategorized') {
				?>
				<ul>
					<li class="my-3">
						<a href="<?php echo $term_url?>"
							class="color-yellow cat-parent
							text-uppercase">
							<span class="fw-700"><?php echo $term_parent->name?></span>
						</a>
					</li>
					<?php
					foreach ($tax_terms as $term) {
						$term_child_url = get_term_link($term->term_id,'product_cat');
						if ($term->parent == $current_parent) {
							?>
							<li class="mb-1">
								<a href="<?php echo $term_child_url?>"
									class="cat-child <?php
									if ($term->term_id == $current_id) {
										?>active<?php
									}
									?>">
									<span><?php echo $term->name?></span>
								</a>
							</li>
							<?php
						}
					}
				?>
				</ul>

				<?php
			}
		}
		?>
	</div>
	<div id="category-accordion" class="custom-sidebar my-4 d-lg-none">
		<span class="text-uppercase widgettitle mb-3">
			<a href="#" class="collapsed d-block category-collapse" data-toggle="collapse" data-target="#category-links" aria-expanded="false" aria-controls="category-links">
			<?php _e('Categorías', 'santa-cole') ?>
			</a>
		</span>
		<div id="category-links" class="collapse" data-parent="#category-accordion">
			<div class="pt-3">
			<?php
			$current_id = get_queried_object_id();
			foreach ($tax_parents as $term_parent) {

				$term_url = get_term_link($term_parent->term_id,'product_cat');
				$current_parent = $term_parent->term_id;
				if ($term_parent->slug != 'uncategorized') {
					?>
					<ul>
						<li class="mb-3">
							<a href="<?php echo $term_url?>"
								class="color-red cat-parent
								text-uppercase">
								<span class="fw-500"><?php echo $term_parent->name?></span>
							</a>
						</li>
						<?php
						foreach ($tax_terms as $term) {
							$term_child_url = get_term_link($term->term_id,'product_cat');
							if ($term->parent == $current_parent) {
								?>
								<li class="mb-2">
									<a href="<?php echo $term_child_url?>"
										class="cat-child <?php
										if ($term->term_id == $current_id) {
											?>active<?php
										}
										?>">
										<span><?php echo $term->name?></span>
									</a>
								</li>
								<?php
							}
						}
					?>
					</ul>

					<?php
				}
			}
			?>
			</div>
		</div>
	</div>
	<?php
}



