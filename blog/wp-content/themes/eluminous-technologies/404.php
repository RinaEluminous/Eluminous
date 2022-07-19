<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eluminous-technologies
 */

get_header();
?>
<section>
<div class="container">
	<div class="row blog_row">
		<div id="primary" class="content-area col-sm-8 col-md-8">
			<main id="main" class="site-main" role="main">	
			<div class="error-404 not-found">
				<div>
					<h3 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'eluminous-technologies' ); ?></h3>
					
				</div>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'eluminous-technologies' ); ?></p>
					<div class="widget widget_search" id="search-2">
					<?php get_search_form(); ?>
					</div>
					<?php
					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'eluminous-technologies' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div>

					<?php
					/* translators: %1$s: smiley */
					$eluminous_technologies_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'eluminous-technologies' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$eluminous_technologies_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div>
			</div>

		</main>
	</div>
	
	<div class="col-sm-4 col-md-4 drop-shaddow-section">
		<div class="side_bar_shaddow">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
</div>
</section>
<?php
get_footer();
?>
