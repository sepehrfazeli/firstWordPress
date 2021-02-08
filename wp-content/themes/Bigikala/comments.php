<?php

if ( post_password_required() ) {
	return;
}
?>
<div class="comments-template">
							
	<div id="comments">
	<?php if ( have_comments() ) : ?>
        <strong class="heading">
		<?php
			$comments_number = get_comments_number();
			echo number_format_i18n( $comments_number ) . __( 'Comment','bigikala' );
		?>
		</strong>

		<div id="commentlist-container">

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'avatar_size' => 60,
						'style'       => 'ol',
						'short_ping'  => true,
						'reply_text'  => __( 'Reply', 'bigikala' ),
					) );
				?>
			</ol>
			
			<?php the_comments_pagination(); ?>
		</div>
		
		<?php

		endif; 
	
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments"><?php _e( 'Comments are closed.', 'bigikala' ); ?></p>
		
		<?php
		
		endif;

		comment_form();
		?>
	
	</div>
	
</div>


