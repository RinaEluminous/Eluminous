<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eluminous-technologies
 */

get_header();
?>

<div class="container">
	<div class="row blog_row">
		<div id="primary" class="content-area col-sm-8 col-md-8">
			<main id="main" class="site-main" role="main">
			<?php //get_template_part( 'template-parts/content','single' ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row">
						<div class="col-md-6">
						<?php
							$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
							$img_src = wp_get_attachment_url( $post_thumbnail ,'medium');
							if ( $img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
								<img width="400px" height="200px" src= "<?php echo $img_src ; ?>" alt="<?php the_title(); ?>" >
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<div class="author-meta">
								<span class="author-image">
									<?php echo get_avatar( get_the_author_meta('user_email'), $size = '30'); ?>
								</span>
								<span class="author-name">
									<?php echo get_the_author();//get_the_author_meta('user_email'); ?>
								</span>
								<span class="post-date">
									<?php echo get_the_date( 'F j, Y' ); ?>
								</span>
							</div>
							<h5 class="blog-title "><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h5>
							<div class="blog-content">
								<?php the_excerpt(); ?>
							</div>
							<div class="read-more">
								<a class="btn btn-default" href="<?php the_permalink(); ?>">Continue Reading</a>
							</div>
						</div>						
					</div>					
					</article>
				<?php endwhile; ?>
			</main>
			<!--<div class="blogpage_pagination" id="blogpage_bottom_pagination">
				<?php wp_paginate(); ?>
			</div>-->
		</div>
		
		<div class="col-sm-4 col-md-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>


<!--<div class="container">
	<div class="row blog_row">
		<div id="primary" class="content-area col-sm-8 col-md-8">
			<main id="main" class="site-main" role="main">
			<?php //get_template_part( 'template-parts/content','single' ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-header page-header">
						<h2 class="entry-title "><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h2>
						<div class="featured_image"><?php the_post_thumbnail( 'eluminous-featured', array( 'class' => 'thumbnail' )); ?></div>
						<div class="entry-meta" align="left">	
						<span class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i>
							<?php echo get_the_date( 'F j, Y' ); ?>
						</span>
						
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<span class="comments-link"><i class="fa fa-comment-o"></i><?php comments_popup_link( __( 'Leave a comment', 'eluminous' ), __( '1 Comment', 'eluminous' ), __( '% Comments', 'eluminous' ) ); ?></span>
						<?php endif; ?>
						
						<?php if ( 'post' == get_post_type() ) : 
							$categories_list = get_the_category_list( __( ', ', 'eluminous' ) );
							if ( $categories_list ) :
						?>
						
						<span class="cat-links"><i class="fa fa-folder-open-o"></i>
							<?php printf( __( ' %1$s', 'eluminous' ), $categories_list ); ?>
						</span>
							<?php endif; // End if categories ?>
						<?php endif; // End if 'post' == get_post_type() ?>					
						
						<span class="author-name"><i class="fa fa-user"></i>
							<?php echo get_the_author();//get_the_author_meta('user_email'); ?>
						</span>
						
						</div>
						
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
						<div class="col-sm-8"><a class="btn btn-default read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'eluminous' ); ?> <i class="fa fa-chevron-right"></i></a></div>
					</div>
					</article>
				<?php endwhile; ?>
			</main>
			<div class="blogpage_pagination" id="blogpage_bottom_pagination">
				<?php wp_paginate(); ?>
			</div>
		</div>
		
		<div class="col-sm-4 col-md-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>-->


<?php
wp_reset_postdata();
get_footer();
?>