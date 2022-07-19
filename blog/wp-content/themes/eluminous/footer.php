<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package eluminous

 */

?>

                </div><!-- close .row -->

            </div><!-- close .container -->

        </div><!-- close .site-content -->



	<div id="footer-area">

		<div class="container footer-inner">

			<?php get_sidebar( 'footer' ); ?>

		</div>



		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="site-info container">

				<?php if( of_get_option('footer_social') ) eluminous_social_icons(); ?>

				<nav role="navigation" class="col-md-6">

					<?php eluminous_footer_links(); ?>

				</nav>

				<div class="copyright col-md-6">

					<!--<?php //echo //of_get_option( 'custom_footer_text', 'eluminous' ); ?>-->

					COPYRIGHT © 2002 - <?php echo date('Y');?> ELUMINOUS TECHNOLOGIES PVT. LTD.

					<?php //eluminous_footer_info(); ?>

				</div>

			</div><!-- .site-info -->

			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->

		</footer><!-- #colophon -->

	</div>

</div><!-- #page -->



<?php wp_footer(); ?>



</body>

</html>