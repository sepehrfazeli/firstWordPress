<?php

get_header(); ?>

<div class="container-bigikala main-warp">
	<div class="row">
		<section class="col-sm-9">

			<?php if ( have_posts() ) : ?>
			<div class="archive-header">
			    <div class="archives">
            <nav class="breadcrumbs">
    <ul class="breadcrumbs__nav"><li class="item"><?php bigikala_breadcrumbs(); ?></li></ul>

            <a class="breadcrumbs__icons">
            <i class="icon-rss"></i>
        </a>
    </nav>            <div class="archive-header__sep"></div>

            <div class="media-header">
                        <i class="icon-folder"></i>
                <div class="media-header__content">
                    <h1 class="title"><?php the_archive_title();?></h1>
                        <div class="description">
           <?php the_archive_description();?>        </div>
            </div>
    </div>
    </div>        </div>
				<?php while ( have_posts() ) : the_post(); ?>

					<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" <?php post_class('masonry-gallery'); ?>>
					    	<div class="main-wp-post-image">
					    	    <?php
						 $allCat = get_the_category();
						 $lastCat = array_reverse($allCat);
						 echo '<span title="" class="cat_of_post">'.$lastCat[0]->name.'</span>';
						?>
									
										   
										<img src="<?php echo the_post_thumbnail_url('medium');?>" class="attachment-blog_medium size-blog_medium wp-post-image" alt="<?php the_title(); ?>">
									
					</div>
						<h2 class="media-heading">
							<?php the_title(); ?>
						</h2>
						<div class="title__sep"></div>
						<div class="masonry-gallery__item__description">
							<div class="row">
							
<?php echo mb_strimwidth( get_the_excerpt(), 0, 140, ' ...' ); ?>
	
							<div class="post-meta">
							<span class="post-author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?><?php the_author() ?></span>
							<i class="icon-clock-icon"></i><div class="human_time_diff"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') )  . __ ( ' Past','bigikala' ); ?></div>
						</div>
							</div>
						</div>
					</a>

				<?php endwhile; // End of the loop.	?>
				
				<div class="row postnav">
					<div class="col-md-10">
						<?php	the_posts_pagination( array(
							'prev_text' => '<span class="btn post-navs">'. __ ( 'Perv Page','bigikala' ).'</span>',
							'next_text' => '<span class="btn post-navs">'. __ ( 'Next Page','bigikala' ).'</span>',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'bigikala' ) . ' </span>',
						) );?>
					</div>
				</div>
				
			<?php else : ?>
				<div class="row">
					<section class="col-sm-12">
						<div class="post media">
							<p><?php _e ( 'There is no posts.','bigikala' ); ?></p>
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
