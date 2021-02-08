<?php

get_header();
global $bigikala_options;
if ( isset( $bigikala_options['site_header_logo'] ) && strlen( $bigikala_options['site_header_logo']['url'] ) > 0 ) {
	$logo_href = $bigikala_options['site_header_logo']['url'];
} else {
	$logo_href = get_template_directory_uri().'/assets/images/logo.png';
}
?>
<div class="container-bigikala main-warp">
	<div class="row">
		<section class="col-sm-9">
			<?php bigikala_breadcrumbs(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
				    <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>
					<div class="post-title"><h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1></div>
					<div class="post-meta">
						<span class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person"><i class="icon-user"></i><span itemprop="name"><?php the_author() ?></span></span>
						<i class="icon-clock-icon"></i>
						<span class="post-date">
						    <meta itemprop="datePublished" content="<?php echo date("Y-m-d",get_post_time()); ?>">
                            <meta itemprop="dateModified" content="<?php echo date("Y-m-d",get_post_modified_time()); ?>"/>
                            <?php the_time('d F Y') ?><span class="time-divider">|</span><?php the_time('h:i') ?>
                        </span>
	                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hidden publisher">
		                    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
		                        <meta itemprop="url" content="<?php echo $logo_href; ?>">
		                    </div>
		                <meta itemprop="name" content="<?php bloginfo('name'); ?>">
	                    </div>
						<span class="post-edit"></span>
					</div>
					
					<div class="post-content single">
						<div class="post-body">
							<figure class="post-attachment">
								<?php the_post_thumbnail(); ?>
								<meta itemprop="image" content="<?php the_post_thumbnail_url(); ?>" >
								<figcaption class="hidden-seo"><?php the_title(); ?></figcaption>
							</figure>
							<div itemprop="articleBody">
							    <?php the_content() ;?>
							</div>
						</div>

						<div class="post-tags">
							<span class="tag"><?php _e ( 'Tags: ','bigikala' ); ?></span>
							<?php
							$posttags = get_the_tags();
								if ( $posttags ) {
								  foreach( $posttags as $tag ) {
									echo '<a href="'.get_tag_link($tag->term_id).'" rel="tag">'.$tag->name.'</a>'; 
								  }
								}
							?>
						</div>
					</div>
			</article>
			<?php 

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
			?>
		</section>
		
		<aside class="col-sm-3 blog-sidebar">
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { dynamic_sidebar( 'blog-sidebar' ); } ?>
		</aside>
	</div>
</div>

<?php get_footer();
