<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eluminous_technologies
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
 <div class="single-page-detail-content-right">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside><!-- #secondary -->
</div>