<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>

<section class="siteBody">
	<div class="row">
		<section class="medium-8 large-9 column siteContent siteContent--hasSidebar">
			<section class="row column">
				<div class="medium-8 large-10 column medium-centered">
					<h2><?php esc_html_e( 'Error 404 - Page Not Found', 'w4ptheme' ); ?></h2>
				</div>
			</section>
		</section>
	</div>
</section>

<?php get_footer(); ?>
