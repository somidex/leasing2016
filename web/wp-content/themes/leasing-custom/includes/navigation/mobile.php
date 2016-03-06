<?php
	$logoId = get_option('website_general_settings_logo');
	$logo = wp_get_attachment_image_src($logoId[0], 'brand-logo');
?>

<div class="container mobileMenu" itemscope itemtype="http://schema.org/WebPageElement/SiteNavigationElement">
	<div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
		<?php
			wp_nav_menu( array( 
				'theme_location'    => 'primary',
				'container'         => '',
				'menu_class'        => 'nav navmenu-nav',
				'walker'            => new wp_bootstrap_navwalker())
			);
		?>
	</div>

	<div class="navbar navbar-default">
		<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<a class="navbar-brand" href="<?php echo get_site_url(); ?>" itemprop="thumbnailUrl">
			<img src="<?php echo $logo[0]; ?>" class="logo" alt="DMCI Homes Leasing Services" itemprop="image">
		</a>
	</div>
</div>