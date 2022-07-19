<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eluminous-technologies
 */

get_header();


?>


<section class="p-0" id="blog_detail">
	<div class="container p-0">
	<div class="row blog_row m-0">
		<div id="primary" class="content-area col-sm-8 col-md-8 pt-lg-5 pb-5">
			<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row m-0">
					<h5 class="blog-title pb-4"> <?php the_title();  ?> </h5>
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
						<div class="blog-featured-image col-12 pl-0 pr-0 pt-4 pb-5">
							<?php
								$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
								$img_src = wp_get_attachment_url( $post_thumbnail ,'full');
							if ( $img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
							<img src= "<?php echo $img_src ; ?>" alt="<?php the_title(); ?>" class="img-fluid">
							<?php endif; ?>
						</div>
							
						<div class="blog-content">
							<?php the_content(); ?>
						</div>
						<div class="bottom-wrapper">
						<div class="social-media">
							<h5>Social Share:</h5>
							<a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" title="Share to Facebook" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-facebook"></i></span></a>
							<a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title() .' '. esc_url(get_permalink())); ?>" target="_blank" title="Share to Twitter" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-twitter"></i></span></a>
							<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-google-plus"></i></span></a>
							<a href="https://www.linkedin.com/cws/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="hb hb-sm inv"><i class="fa fa-linkedin-square"></i></span></a>
						</div>
						<div class="posted-in">
							<?php echo 'POSTED IN:  '.get_the_date( 'F j, Y' ).'  '.get_the_author();; ?>
						</div>
						<div class="comments-section d-none">
							<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
								<span class="comments-link"><i class="fa fa-comment-o"></i><?php comments_popup_link( __( 'Leave a comment', 'eluminous' ), __( '1 Comment', 'eluminous' ), __( '% Comments', 'eluminous' ) ); ?></span>
							<?php endif; ?>
						</div>
						</div>
					</div>
				</article>			
			<?php
			
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>
			</main>
		<div class="blogpage_pagination" id="blogpage_bottom_pagination">
			<?php wp_paginate(); ?>
		</div>
		</div>

		<div class="col-sm-4 col-md-4 drop-shaddow-section pt-lg-5 pb-5">
			<div class="side_bar_shaddow">
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
