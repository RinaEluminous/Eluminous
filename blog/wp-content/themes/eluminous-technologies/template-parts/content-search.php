<?php get_header(); ?>



<!--<div class="container">
	<div class="row blog_row">
		<div id="primary" class="content-area col-sm-8 col-md-8">
			
			 <h1 class="page-title"><?php printf( __( 'Search Results for : %s', 'twentyfifteen' ), get_search_query() ); ?></h1>
			 <main id="main" class="site-main" role="main">			
			<?php if(have_posts()) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-header page-header">				
					<h2 class="entry-title "><?php the_title(); ?></h2>
					<div class="entry-meta" align="left">
					<?php the_post_thumbnail( 'eluminous-featured', array( 'class' => 'thumbnail' )); ?>
					</div>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					
				</div>
			</article>
			<?php endwhile; ?>
			 <span class="nav-previous"><?php next_posts_link('&laquo; Previous Articles') ?></span><span class="nav-next"><?php previous_posts_link('Next Articles &raquo;') ?></span>
			<?php else: ?>				
			
			
    		<h2><?php _e('Sorry, no posts matched your criteria.'); ?></h2>
			<?php endif; ?></div>
			</main>
		</div>
		<div class="col-sm-4 col-md-4">
			<?php get_sidebar();?>
		</div>
	</div>
</div>-->

<?php get_footer(); ?>