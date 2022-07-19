<?php
/*Template name: Ebook template*/
get_header();
?>


<section class="p-0">
	<div class="container p-0">
		<div class="row blog_row m-0">
			<div id="primary" class="content-area col-sm-8 col-md-8 pt-lg-5 pb-5">
				<main id="main" class="site-main pt-lg-4" role="main">
				<?php
					$args =  array(
						'post_type' => 'e-book',
						'posts_per_page' =>-1,
						'orderby' => 'publish_date',
						'order' => 'DESC',
						'post_status' => 'publish');
					$query = new WP_Query($args );
					
					if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="row m-0">
							<div class="col-md-6 pl-0 pr-0 ">
								<?php
									$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
									$img_src = wp_get_attachment_url( $post_thumbnail ,'medium');
								if ( $img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
								<img src= "<?php echo $img_src; ?>" alt="<?php the_title(); ?>" class="img-fluid">
								<?php endif; ?>
							</div>
							<div class="col-md-6 pl-lg-5 pr-0">								
								<h5 class="blog-title "><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h5>
								<div class="blog-content">
									<?php the_excerpt(); ?>
								</div>
								<div class="read-more">
									<a class="reading-button" href="<?php the_permalink();?>">Continue Reading</a>
								</div>
							</div>
						</div>
					</article>
					<!--<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-header page-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>							
						</div>
					<div class="entry-content">
						<div class="col-sm-12" align="center">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php 
						$airkit_post_thumbnail = get_post_thumbnail_id( get_the_ID() );
						$airkit_img_src = wp_get_attachment_url( $airkit_post_thumbnail ,'medium');
						$uploaded_file = get_post_meta(get_the_ID(), 'wpcf-upload-file', true); ?>
						</a>
						<?php 
						if ( $airkit_img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
						<a href="<?php the_permalink();?>" class="media_image"><img src= "<?php echo $airkit_img_src ; ?>" alt="<?php the_title(); ?>" ></a>
						<?php endif; ?>
						</div>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<p><a class="btn btn-default read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'eluminous' ); ?> <i class="fa fa-chevron-right"></i></a></p>
						</div>
					</div>
					</article>-->
				<?php  endwhile; endif;?>
				
				</main>
				<div class="blogpage_pagination" id="blogpage_bottom_pagination">
					<?php wp_paginate(); ?>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 drop-shaddow-section pt-lg-5 pb-5">
				<div class="side_bar_shaddow pt-3">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
get_footer();
?>