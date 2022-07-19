<?php
/*Template name: Ebook template*/
get_header();
?>


<section class="p-0 book-listing">
	<div class="container p-0">
		<div class="row blog_row m-0">
			<div id="primary" class="content-area col-sm-12 pt-sm-4 col-md-7 pt-lg-5 pb-5 col-lg-8 pt-lg-3 pt-md-2">
				<main id="main" class="site-main pt-lg-4" role="main">
					<div class="row">
						
				<?php
					$args =  array(
						'post_type' => 'e-book',
						'posts_per_page' =>-1,
						'orderby' => 'publish_date',
						'order' => 'DESC',
						'post_status' => 'publish');
					$query = new WP_Query($args );
					
					if ($query->have_posts()) : 
						//add_filter( 'the_title', 'elu_shorten_title', 10, 1 );
						while ($query->have_posts()) : $query->the_post(); ?>
					<div class="col-md-12">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						 
							<div class="img-book col-md-12 col-sm-4 col-lg-4">
								<?php
									$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
									$img_src = wp_get_attachment_url( $post_thumbnail ,'medium');
								if ( $img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
								<img src= "<?php echo $img_src; ?>" alt="<?php the_title(); ?>" class="img-fluid">
								<?php endif; ?>
							</div>
							<div class="book-title col-md-12 col-sm-8 col-lg-8">								
								<h5 class="blog-title "><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h5>
								<div class="blog-content">
									<?php the_excerpt(); ?>
								</div>
								<div class="read-more">
									<a class="reading-button" href="<?php the_permalink();?>">Continue Reading</a>
								</div>
							</div> 
					</article>
					</div>
					 
				<?php  endwhile; 
				remove_filter( 'the_title', 'elu_shorten_title');
				endif;?>
				
				</div>
				</main>
				<div class="blogpage_pagination" id="blogpage_bottom_pagination">
					<?php wp_paginate(); ?>
				</div>
			</div>
			<div class="col-sm-12 col-md-5 drop-shaddow-section pt-lg-5 pb-5 col-lg-4 pt-lg-3 pt-md-2">

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