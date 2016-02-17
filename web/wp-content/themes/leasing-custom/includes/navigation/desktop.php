<?php
	$logoId = get_option('website_general_settings_logo');
	$logo = wp_get_attachment_image_src($logoId[0], 'brand-logo');
?>

<div class="navWrap desktopMenu" itemscope itemtype="http://schema.org/WebPageElement">
	<div class="container">
		<nav class="navbar" role="navigation" itemscope itemtype="http://schema.org/WebPageElement/SiteNavigationElement">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			    	</button>

				    <a class="navbar-brand" href="<?php echo get_site_url(); ?>" itemprop="thumbnailUrl">
				    	<img src="http://leasing.dmcihomes.com.local/wp-content/uploads/DMCI-Homes-lsd.png" class="logo" alt="DMCI Homes Leasing Services" itemprop="image">
				    </a>

				</div>
				
				<?php
					wp_nav_menu( array( 
						'theme_location'    => 'primary',
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'		=> 'bs-example-navbar-collapse-1',
						'menu_class'        => 'nav navbar-nav navbar-right',
						'walker'            => new wp_bootstrap_navwalker())
					);
				?>
		  	</div><!-- /.container-fluid -->
		</nav>
	</div>
</div>