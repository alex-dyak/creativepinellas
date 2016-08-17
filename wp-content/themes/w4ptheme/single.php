<?php
/**
 * The template for displaying all single posts and attachments
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

				<?php if (have_posts()) :
				while (have_posts()) :
				the_post(); ?>

				<article class="postPage" id="post-<?php the_ID(); ?>">
					<!--    Post title  -->
					<h1 class="postPage-title"><?php the_title(); ?></h1>
					<!--    Post Info   -->
					<div class="postPage-info">
						<?php the_date( 'F d, Y' ); ?>
						<?php echo __( 'by ', 'w4ptheme' ) . strtoupper( get_the_author() ) . ' | '; ?>
						<?php $getcat = get_the_category();
						$cat_id = $getcat[0]->cat_ID; ?>
						<a href="<?php echo get_category_link( $cat_id ); ?>"><?php _e( 'CATEGORY', 'w4ptheme' ); ?></a>
					</div>

					<!--    Post Content    -->
					<div class="postPage-content">
						<figure class="wp-caption alignnone">
							<?php the_post_thumbnail( 'post_page_img' ); ?>
							<figcaption class="wp-caption-text">
								<?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?>
							</figcaption>
						</figure>
						<?php the_content(); ?>
						<?php wp_link_pages( array(
							'before'         => __( 'Pages: ', 'w4ptheme' ),
							'next_or_number' => 'number'
						) ); ?>
					</div>
				</article>
			</section>
			<?php post_navigation(); ?>
			<?php endwhile;
			endif; ?>
			<!--    Related Posts   -->
				<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				<?php endif; ?>
		</section>

		<aside id="sidebar" class="medium-4 large-3 column siteSidebar">
			<div class="siteSidebar-inner">
		<?php if ( is_active_sidebar( 'sidebar-primary-post' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-primary-post' ); ?>
		<?php endif; ?>
			</div>
		</aside>

	</div>

</section>

<?php get_footer(); ?>
