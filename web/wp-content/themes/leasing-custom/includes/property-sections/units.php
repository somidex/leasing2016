<?php
	global $wpdb;

	$title = get_the_title();

	$wpdb->query("
		SELECT `id`, `post_title`
		FROM $wpdb->posts
		WHERE `post_title` LIKE '%$title%'
		AND `post_type` LIKE 'property'
	");

	$results = $wpdb->last_result;
?>

<?php if (!empty($results)) : ?>

	<div class="row">
		<div class="col-md-12 unitHeader">
			<h2>UNIT TYPES</h2>
		</div>
	</div>

	<div class="row">

		<?php
			global $wpdb;

			$wpdb->query("
				SELECT `id`, `post_title`
				FROM $wpdb->posts
				WHERE `post_title` LIKE '%Bare%'
				AND `post_type` LIKE 'property'
			");

			$bare = array();
			foreach($wpdb->last_result as $v){
				if (strpos($v->post_title, get_the_title()) !== false) {
					$bare[$v->id] = $v->post_title;
				}
			};
		?>

		<?php if (!empty($bare)) : ?>
			<div class="col-md-6 unitTypes">
				<section>
					<div class="unitTitle">
						<h4>BARE UNITS</h4>
					</div>
					<ul>
						<?php
							foreach ($bare as $key => $value) {
								$temp = explode(' - ', $value);
								$type = explode(', ', $temp[1]);
						?>
								<li><span><?php echo $type[0] ?></span><a href="<?php echo get_the_permalink($key); ?>" class="vacant">VIEW UNIT</a></li>
						<?php
							}
						?>
					</ul>
				</section>
			</div>
		<?php endif; ?>

		<?php
			$wpdb->query("
				SELECT `id`, `post_title`
				FROM $wpdb->posts
				WHERE `post_title` LIKE '%Semi-Furnished%'
				AND `post_type` LIKE 'property'
			");

			$sf = array();
			foreach($wpdb->last_result as $v){
				if (strpos($v->post_title, get_the_title()) !== false) {
					$sf[$v->id] = $v->post_title;
				}
			};
		?>

		<?php if (!empty($sf)) : ?>

			<div class="col-md-6 unitTypes">
				
				<section>
					<div class="unitTitle">
						<h4>SEMI FURNISHED</h4>
					</div>
					
					<ul>
						<?php
							foreach ($sf as $key => $value) {
								$temp = explode(' - ', $value);
								$type = explode(', ', $temp[1]);
						?>
								<li><span><?php echo $type[0] ?></span><a href="<?php echo get_the_permalink($key); ?>" class="vacant">VIEW UNIT</a></li>
						<?php
							}
						?>
					</ul>
				</section>
			</div>

		<?php endif; ?>

		<?php
			$wpdb->query("
				SELECT `id`, `post_title`
				FROM $wpdb->posts
				WHERE `post_title` LIKE '%Fully Furnished%'
				AND `post_type` LIKE 'property'
			");

			$ff = array();
			foreach($wpdb->last_result as $v){
				if (strpos($v->post_title, get_the_title()) !== false) {
					$ff[$v->id] = $v->post_title;
				}
			};
		?>

		<?php if (!empty($ff)) : ?>

			<div class="col-md-6 unitTypes">
				
				<section>
					<div class="unitTitle">
						<h4>FULLY FURNISHED</h4>
					</div>
					
					<ul>
						<?php
							foreach ($ff as $key => $value) {
								$temp = explode(' - ', $value);
								$type = explode(', ', $temp[1]);
						?>
								<li><span><?php echo $type[0] ?></span><a href="<?php echo get_the_permalink($key); ?>" class="vacant">VIEW UNIT</a></li>
						<?php
							}
						?>
					</ul>
				</section>
			</div>
		<?php endif; ?>
	</div>
	
<?php endif; ?>