<?php
  $amenities = get_post_meta(get_the_ID(), 'property_amenities_text', true);
  $galleryIds = get_post_meta(get_the_ID(), '_pods_property_gallery', true);
  $features = get_post_meta(get_the_ID(), 'property_features', true);
  $facilities = get_post_meta(get_the_ID(), 'property_facilities', true);
  $detect = new Mobile_Detect();
?>

<div class="amenityHead">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>AMENITIES</h3>
			</div>
		</div>
	</div>
</div>

<div class="container propertyFeatures">
	<div class="row">
		<div class="col-md-12 amenities">
			<?php echo $amenities; ?>
		</div>

		<div class="col-md-12 gallery">
			<h3>GALLERY</h3>

      <?php if (!$detect->isMobile()) : ?>
  			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  				<!-- Wrapper for slides -->
  				<div class="carousel-inner" role="listbox">

            <div class="item active">
            <?php
              $i = 1;
              foreach ($galleryIds as $galleryId) {
                $galleryImg = wp_get_attachment_image_src($galleryId, 'full');
            ?>
                <div class="col-md-4 col-sm-4">
                  <div style="background: url(<?php echo $galleryImg[0]; ?>) no-repeat top left / cover;" class="imageContainer" data-toggle="modal" data-target="#myModal" id="clickToExpand"></div>
                </div>

        <?php if ($i % 3 == 0 || $i == count($galleryIds)) : ?>
            </div>
          <?php if ($i % 3 == 0 && $i != count($galleryIds)) : ?>
            <div class="item">
          <?php endif; ?>
        <?php endif; ?>
            <?php
                $i++;
              }
            ?>
            </div>
  				</div>

  				<!-- Indicators -->
  				<ol class="carousel-indicators">
            <?php
              $li = $i / 3;
              for ($j = 0; $j < round($li, 0); $j++) { 
            ?>
    					 <li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" class="<?php if ($j == 0): echo 'active'; endif; ?>"></li>
            <?php
              }
            ?>
  				</ol>

  			</div>
  		</div>
    <?php else : ?>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php
            $i = 0;
            foreach ($galleryIds as $galleryId) {
              $galleryImg = wp_get_attachment_image_src($galleryId, 'full');
          ?>
                <div class="item <?php if ($i == 0) : echo 'active'; endif; ?>">
                  <div style="background: url(<?php echo $galleryImg[0]; ?>) no-repeat top left / cover;" class="imageContainer" data-toggle="modal" data-target="#myModal" id="clickToExpand"></div>
                </div>
          <?php
              $i++;
            }
          ?>
          <ol class="carousel-indicators">
            <?php
              $j = 0;
              foreach ($galleryIds as $galleryId) {
            ?>
              <li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" class="<?php if ($j == 0): echo 'active'; endif; ?>"></li>
            <?php
                $j++;
              }
            ?>
          </ol>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
          </div>
        </div>
      </div>
    </div>

		<div class="col-md-12">
			<h3>BUILDING FEATURES</h3>
			<?php echo $features; ?>
		</div>

    <?php if ($facilities) : ?>
      <div class="col-md-12">
        <h3>FACILITIES</h3>
        <?php echo $facilities; ?>
      </div>
    <?php endif; ?>
	</div>
</div>