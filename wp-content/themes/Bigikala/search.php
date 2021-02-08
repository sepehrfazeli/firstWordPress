<?php

get_header(); ?>

<div class="container-bigikala main-warp">
	<div class="row">
		<section class="col-sm-9">
			<?php bigikala_breadcrumbs(); ?>
			<?php if ( have_posts() ) : ?>
			<div class="post">
				<h1 class="archive-heading"><span><?php printf( __( 'Search Results for: %s', 'bigikala' ), '<span>' . get_search_query() . '</span>' ); ?></span></h1>
			</div>
				<?php while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2 class="media-heading">
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h2>
						<div class="post-meta">
							<span class="post-author"><?php _e ( 'Author: ','bigikala' ); ?><?php the_author() ?></span>
							<span class="post-date"><?php the_time('d/F/Y') ?><span class="time-divider">-</span><?php the_time('h:i') ?></span>
							<span class="post-edit"></span>
						</div>
						<div class="post-content media-body">
							<div class="row">
								<div class="col-sm-3 no-padding">
									<a href="<?php the_permalink() ?>" class="post-thumbnail pull-right" title="<?php the_title(); ?>">
										<img src="<?php echo the_post_thumbnail_url();?>" class="attachment-blog_medium size-blog_medium wp-post-image" alt="<?php the_title(); ?>">
									</a>
								</div>
								<div class="col-sm-9">
									<p><?php echo mb_strimwidth( get_the_content(), 0, 260, ' ...' ); ?>
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="read-more"><?php _e ( 'Read More ','bigikala' ); ?><i class="fa fa-angle-double-left"></i></a>
									</p>
								</div>
							</div>
						</div>
					</div>

				<?php endwhile; // End of the loop.	?>
				
				<div class="row postnav">
					<div class="col-md-10">
						<?php	the_posts_pagination( array(
							'prev_text' => '<button class="btn post-navs">'. __ ( 'Perv Page','bigikala' ).'</button>',
							'next_text' => '<button class="btn post-navs">'. __ ( 'Next Page','bigikala' ).'</button>',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'bigikala' ) . ' </span>',
						) );?>
					</div>
				</div>
				
			<?php else : ?>
				<div class="row">
					<section class="col-sm-12">
						<div class="post media">
							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bigikala' ); ?></p>
							<?php get_search_form(); ?>
						</div>
					</section>
				</div>
			
			<?php endif; ?>
		</section>
			
		<aside class="col-sm-3 blog-sidebar">
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { dynamic_sidebar( 'blog-sidebar' ); } ?>
		</aside>
	</div>
</div><!-- .container main -->

<?php get_footer();
