<?php
	$featTestiLink = get_post_meta(get_the_ID(), 'featured_testimonial_link', true);
	$featTestiId = get_post_meta(get_the_ID(), 'featured_testimonial', true);
	$featTesti = get_the_content_by_id($featTestiId[0]);
	$featTestiRating = get_post_meta($featTestiId[0], 'ratings', true);
?>

<div class="reviewWrap" itemscope itemtype="http://schema.org/Review">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" >

				<section itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
					<span id="ratingValue" itemprop="ratingValue" style="display: none;"><?php echo $featTestiRating; ?></span>
					<?php
						for ($i = 0; $i < $featTestiRating; $i++) { 
					?>
							<i class="fa fa-star"></i>
					<?php
						}
					?>
				</section>

				<section>
					<p itemprop="reviewBody">"<?php echo $featTesti; ?>" <br>- <?php echo get_the_title($featTestiId[0]); ?></p>
					<!--<a href="<?php //echo $featTestiLink; ?>">VIEW MORE TESTIMONIALS</a>-->
				</section>
			</div>
		</div>
	</div>
</div>