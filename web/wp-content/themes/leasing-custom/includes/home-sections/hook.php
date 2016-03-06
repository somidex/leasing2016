<?php
	$hookBgImgId = get_option('website_general_settings_hook_background_image');
	$hookBgImg = wp_get_attachment_image_src($hookBgImgId[0], 'hook-bg');
	$hookTitle = get_option('website_general_settings_hook_title');
	$hookSubtitle = get_option('website_general_settings_hook_subtitle');
?>

<div class="hookWrap" style="background: url('<?php echo $hookBgImg[0]; ?>') no-repeat fixed center center / cover transparent;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php echo $hookTitle; ?></h2>
				<span><?php echo $hookSubtitle; ?></span>
			</div>
		</div>
	</div>
</div>