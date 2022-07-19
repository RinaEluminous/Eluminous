<?php
/*Template name: Ebook template*/
get_header();
?>
<section class="banner ">
	<div class="container">
<?php
global $post;
	$args =  array(
		'post_type' => 'e-book',
		'posts_per_page' =>-1,
		'orderby' => 'publish_date',
		'order' => 'DESC',
		'post_status' => 'publish'
		);
		$query = new WP_Query($args );
		//print_r($query);
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
	?>
		<div class="ebook">
			<?php  $airkit_post_thumbnail = get_post_thumbnail_id( get_the_ID() );
			$airkit_img_src = wp_get_attachment_url( $airkit_post_thumbnail ,'medium');
			$uploaded_file = get_post_meta(get_the_ID(), 'wpcf-upload-file', true);
			//echo $uploaded_file;
			if ( $airkit_img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
				<a href="<?php the_permalink();?>" class="media_image"><img src= "<?php echo $airkit_img_src ; ?>" alt="<?php the_title(); ?>" ></a>
				
			<?php endif; ?>
			<div class="ebook-body">
				<h5 class="ebook-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
				<p class="ebook-text"><?php the_excerpt();?><a href="<?php the_permalink(); //echo $uploaded_file; ?>">Read More</a></p>
				
			</div>
			
		</div>
	
	<?php  endwhile; endif;?>
	</div>
</section>
<?php
get_footer();
?>