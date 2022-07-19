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
* @package eluminous_technologies
*/
get_header();

?>

<!-- category listing -->
<section class="category gray_bg">
	<div class="container">
		 <h2 class="m-lg-0 text-center">Featured Blogs</h2> 
		<div class="row justify-content-center">
	<?php
	$arrayCategories = get_categories();
	foreach($arrayCategories as $category) {
		
		$intId = $category->term_id;
	    $strDescription = $category->description;
	    $image_url = z_taxonomy_image_url( $intId, NULL, TRUE );
	?> 
			<div class="compe_wrapper">
			<div class="servises_images">
				<img src="<?php echo $image_url; ?>"/>
			</div>
			<h5><span>
			<?php $strCatName = $category->name; 
					$strCategory = str_replace(' ',"<br/>",$strCatName); ?>
					<a href="<?php echo get_category_link($intId); ?>"><?php echo $strCategory; ?></a>
			</span></h5>
			</div> 
	<?php } ?>
	</div>
	</div>
</section>
<!-- category listing -->


<section>
<div class="container">
	<div class="row blog_row">
		<div id="primary" class="content-area col-sm-8 col-md-8">
			<main id="main" class="site-main" role="main">
				<?php //get_template_part( 'template-parts/content','single' ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="row">
						<div class="col-md-6 pl-0 pr-0 pb-5">
							<?php
								$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
								$img_src = wp_get_attachment_url( $post_thumbnail ,'medium');
							if ( $img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
							<img src= "<?php echo $img_src ; ?>" alt="<?php the_title(); ?>" class="img-fluid">
							<?php endif; ?>
						</div>
						<div class="col-md-6 pl-lg-5 pr-0 pb-sm-4">
							<div class="author-meta">
								<span class="author-image">
									<?php echo get_avatar( get_the_author_meta('user_email'), $size = '30'); ?>
								</span>
								<div class="author-name">
								<span class="author-name">
									<?php echo get_the_author();//get_the_author_meta('user_email'); ?>
								</span>
								<span class="post-date">
									<?php echo get_the_date( 'F j, Y' ); ?>
								</span>
								</div>
							</div>
							<h5 class="blog-title "><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h5>
							<div class="blog-content">
								<?php the_excerpt(); ?>
							</div>
							<div class="read-more">
								<a class="" href="<?php the_permalink(); ?>">Continue Reading</a>
							</div>
						</div>
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
</div>
</section>
 
<?php
wp_reset_postdata();
get_footer();
?>