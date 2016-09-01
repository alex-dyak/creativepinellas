<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>

<section class="siteBody">

	<div class="row">
		<section class="column siteContent">
			<section class="row column">
				<article class="postPage">

					<?php if (have_posts()) : ?>
						<!--    Post title  -->
						<h1 class="postPage-title"><?php esc_html_e( 'Search Results', 'w4ptheme' ); ?></h1>
						<!--    Post Info   -->
						<div class="postPage-info">YOU SEARCHED FOR:
							[<?php echo $s; ?>]
						</div>
						<!--    Post Content    -->
						<div class="postPage-content">
							<div class="searchList">
								<?php while ( have_posts() ) : the_post(); ?>
									<div class="searchList-item">
										<h3 class="searchList-item-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>

										<p><?php the_excerpt(); ?></p>
									</div>
								<?php endwhile; ?>
							</div>
							<?php if ( function_exists( 'wp_pagenavi' ) ) {
								wp_pagenavi( array(
									'before'        => '<nav class="navigation pagination" role="navigation">',
									'after'         => '</nav>',
									'wrapper_tag'   => 'div',
									'wrapper_class' => 'nav-links',
									'options'       => array(),
									'echo'          => TRUE
								) );
							}
							?>
						</div>
					<?php else : ?>
					<h2><?php esc_html_e( 'Nothing Found', 'w4ptheme' ); ?></h2>
					<?php endif; ?>
				</article>
			</section>

		</section>
	</div>

</section>

<?php get_footer(); ?>
