<?php
/**
 * @package eluminous
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">

		<h1 class="entry-title "><?php the_title(); ?></h1>
		<div class="entry-meta" align="left">
			<?php eluminous_posted_on(); 
			?>
            <?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'eluminous' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'eluminous' ) );

			if ( ! eluminous_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">'. __( 'permalink', 'eluminous' ) .'</a>.';
				} else {
					$meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">'. __( 'permalink', 'eluminous' ) .'</a>.';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">'. __( 'permalink', 'eluminous' ) .'</a>.';
				} else {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">'. __( 'permalink', 'eluminous' ) .'</a>.';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'eluminous' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
		<?php eluminous_setPostViews(get_the_ID()); ?>
		</div><!-- .entry-meta -->
        <br/>
        <div class="col-sm-12" align="left">
		<?php the_post_thumbnail( 'eluminous-featured', array( 'class' => 'thumbnail' )); ?></div>

		

		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'            => '<div class="page-links">'.__( 'Pages:', 'eluminous' ),
				'after'             => '</div>',
				'link_before'       => '<span>',
				'link_after'        => '</span>',
				'pagelink'          => '%',
				'echo'              => 1
       		) );
    	?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		
		<hr class="section-divider">
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
