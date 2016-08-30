<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
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
				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post(); ?>
						<article class="postPage" id="post-<?php the_ID(); ?>">
							<!--    Page title  -->
							<h1 class="postPage-title"><?php the_title(); ?></h1>
							<!--    Page Content    -->
							<div class="postPage-content">
								<?php the_content(); ?>
							</div>
							<!--   / Page Content    -->
						</article>
					<?php endwhile;
				endif; ?>
			</section>
		</section>
		<?php get_sidebar(); ?>
	</div>
</section>

<?php get_footer(); ?>
