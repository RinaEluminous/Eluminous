<?php
get_header();
?>


<section class="p-0">
	<div class="container p-0">
		<div class="row blog_row m-0">
			<div id="primary" class="content-area col-sm-12 pt-sm-4 col-md-7 pt-lg-5 pb-5 col-lg-8 pt-lg-3 pt-md-2">
				<main id="main" class="site-main pt-lg-4" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content','single' ); ?>
				<?php endwhile; ?>
				</main>
			</div>
			<div class="col-sm-12 col-md-5 drop-shaddow-section pt-lg-5 pb-5 col-lg-4 pt-lg-3 pt-md-2 pr-md-3">
				<div class="side_bar_shaddow pt-3">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
?>