<?php
	$featTitle = get_option('website_general_settings_featured_properties_title');
	$featText = get_option('website_general_settings_featured_property_text');
	$featProperties = get_option('website_general_settings_featured_properties');
	$detect = new Mobile_Detect();
?>

<div class="col-md-12 featProperties">

	<?php if (is_front_page()) : ?>

		<h2><?php echo $featTitle; ?></h2>
		<p><?php echo $featText; ?></p>

	<?php else : ?>

		<h3><?php echo $featTitle; ?></h3>

	<?php endif; ?>

	<?php if (!$detect->isMobile()) : ?>
		<div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
					$i = 1;
				?>
					<div class="item active">
				<?php
					foreach ($featProperties as $feat) {
						$propTitle = get_the_title($feat);
						$propText =  get_post_meta($feat, 'featured_exceprt', true);
						$propImgId = get_post_meta($feat, 'image_for_homepage', true);
						$propImg = wp_get_attachment_image_src($propImgId, 'full');
						$propUrl = get_the_permalink($feat);
				?>
						<div class="col-md-4 col-sm-4">
							<section>
								<img src="<?php echo $propImg[0]; ?>" alt="<?php echo $propTitle; ?>">
								<div class="imgDesc">
									<h3><?php echo $propTitle; ?></h3>
									<p><?php echo $propText; ?></p>
	  								<a href="<?php echo $propUrl; ?>" class="viewBtn">VIEW PROPERTY</a>
								</div>
							</section>
						</div>
				<?php
					$counter1 = 3;
					if ($i % $counter1 == 0 || $i == count($featProperties)) :
				?>
					</div>
				<?php
					$counter2 = 3;
					if ($i % $counter2 == 0 && $i != count($featProperties)) :
				?>
					<div class="item">
				<?php
							endif;
						endif;
						$i++;
					}
				?>
			</div>
		</div>
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
				$li = $i / 3;

				for ($j = 0; $j < ceil($li); $j++) { 
			?>
					<li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" <?php if ($j == 0): echo 'class="active"'; endif; ?>></li>
			<?php
				}
			?>
		</ol>
	<?php else : ?>

		<div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<?php
					$i = 0;
					foreach ($featProperties as $feat) {
						$propTitle = get_the_title($feat);
						$propText =  get_post_meta($feat, 'featured_exceprt', true);
						$propImgId = get_post_meta($feat, 'image_for_homepage', true);
						$propImg = wp_get_attachment_image_src($propImgId, 'full');
						$propUrl = get_the_permalink($feat);
				?>
						<div class="item <?php if ($i == 0) : echo 'active'; endif; ?>">
							<section>
								<img src="<?php echo $propImg[0]; ?>" alt="<?php echo $propTitle; ?>">
								<div class="mobDesc">
									<h3><?php echo $propTitle; ?></h3>
									<a href="<?php echo $propUrl; ?>" class="viewBtn">VIEW PROPERTY</a>
								</div>
							</section>
						</div>
				<?php
						$i++;
					}
				?>
			</div>
		</div>

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
				$j = 0;
				foreach ($featProperties as $feat) {
			?>
					<li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" <?php if ($j == 0): echo 'class="active"'; endif; ?>></li>
			<?php
					$j++;
				}
			?>
		</ol>

	<?php endif; ?>

	<!--<a href="#">VIEW ALL PROPERTIES</a>-->
</div>