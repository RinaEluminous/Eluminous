<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eluminous_technologies
 */

get_header();
?>


<section class="p-0">
	<div class="container p-0">
		<div class="row blog_row m-0">
		<div id="primary" class="content-area col-sm-12 pt-sm-4 col-md-7 pt-lg-5 pb-5 col-lg-8 pt-lg-3 pt-md-2">
			<main id="main" class="site-main pt-lg-4" role="main">
			<?php //get_template_part( 'template-parts/content','single' ); 
			//add_filter( 'the_title', 'elu_shorten_title', 10, 1 );
			 while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row m-0">
						<div class="col-lg-12">
							<div class="author-meta">
								<span class="author-image">
									<?php echo get_avatar( get_the_author_meta('user_email'), $size = '30'); ?>
								</span>
								<div class="author-details">
									<span class="author-name">
										<?php echo get_the_author();//get_the_author_meta('user_email'); ?>
									</span>
									<span class="post-date">
										<?php echo get_the_date( 'F j, Y' ); ?>
									</span>
								</div>
							</div>
							<h5 class="blog-title "><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h5>
							
						</div>
						<div class="col-lg-12 thumb-img-view">
							<?php
								$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
								$img_src = wp_get_attachment_url( $post_thumbnail ,'medium');
							if ( $img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
							<img src= "<?php echo $img_src ; ?>" alt="<?php the_title(); ?>" class="img-fluid">
							<?php endif; ?>
						</div>
						<div class="col-lg-12">
							<div class="blog-content">
								<?php the_excerpt(); ?>
							</div>
							<div class="read-more">
								<a class="reading-button" class="" href="<?php the_permalink(); ?>">Continue Reading</a>
								<div class="social-media">
									<a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" title="Share to Facebook" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-facebook"></i></span></a>
									<a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title() .' '. esc_url(get_permalink())); ?>" target="_blank" title="Share to Twitter" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-twitter"></i></span></a>
									<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-google-plus"></i></span></a>
									<a href="https://www.linkedin.com/cws/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-linkedin-square"></i></span></a>
								</div>
							</div>
						</div>
					</div>
				</article>				
				<?php endwhile;
				remove_filter( 'the_title', 'elu_shorten_title'); ?>
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
get_footer();
