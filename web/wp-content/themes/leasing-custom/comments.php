<?php

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area col-md-9 col-md-offset-1 commentBox">
	<?php if (have_comments()) : ?>
		<h3>COMMENTS</h3>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</div>
	<?php endif; ?>
</div>