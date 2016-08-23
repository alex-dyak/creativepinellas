<?php
/**
 * A Simple Category Template
 */

get_header(); ?>



	<section class="siteBody">

		<div class="row">
			<section class="medium-8 large-9 column siteContent siteContent--hasSidebar">

				<?php
				// Check if there are any posts to display
				if (have_posts()) : ?>
				<section class="row column">
					<article class="postPage">
						<!--    Post title  -->
						<h1 class="postPage-title"><?php single_cat_title(); ?></h1>

						<!--    Post Content    -->
						<div class="postPage-content">
							<?php echo category_description(); ?>
						</div>
						<!--    Post Content    -->
					</article>
				</section>

				<section class="row column">
					<?php while ( have_posts() ) : the_post(); ?>

						<!--    postsList-item  -->
						<div class="postsList-item">
							<?php $img = wp_rp_get_post_thumbnail_img( get_post() );
							if ( $img ) : ?>
								<?php
								$category        = get_the_category();
								$the_category_id = $category[0]->cat_ID;
								if ( function_exists( 'rl_color' ) ) {
									$rl_category_color = rl_color( $the_category_id );
								}
								?>
								<div
									class="postsList-item-image"><?php echo $img; ?>
									<span class="postsList-item-categoryDecor"
									      style="background-color: <?php echo $rl_category_color; ?>"></span>
								</div>
							<?php endif; ?>
							<div class="postsList-item-body">
								<h3><?php the_title(); ?></h3>
								<p><?php the_excerpt(); ?></p>
								<p><i>
										<?php echo __( 'BY ', 'w4ptheme' ) . strtoupper( get_the_author() ) . ' | '; ?>
										<?php $getcat = get_the_category(); ?>
										<?php if ( ! empty( $getcat ) ) :
											$count = count( $getcat );
											foreach ( $getcat as $key => $category ) : ?>
												<?php if ( $key == $count - 1 ) : ?>
													<a href="<?php echo get_category_link( $category->cat_ID ); ?>"><?php echo strtoupper( $category->cat_name ); ?></a>
												<?php else : ?>
													<a
													href="<?php echo get_category_link( $category->cat_ID ); ?>"><?php echo strtoupper( $category->cat_name ); ?></a><?php echo ', '; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
									</i></p>
							</div>
							<div>
								<a href="<?php the_permalink(); ?>" class="btn btn--fullWidth"><?php _e( 'Read Article', 'w4ptheme' ); ?></a>
							</div>
						</div>
						<!--   / postsList-item  -->

					<?php endwhile; ?>

					<?php if ( function_exists( 'wp_pagenavi' ) ) {
						wp_pagenavi( array(
							'before'        => '<nav class="navigation pagination" role="navigation">',
							'after'         => '</nav>',
							'wrapper_tag'   => 'div',
							'wrapper_class' => 'nav-links',
							'options'       => array(),
							'type'          => 'posts',
							'echo'          => TRUE
						) );
					}
					?>
				</section>
			</section>
			<?php else: ?>

				<p>Sorry, no posts matched your criteria.</p>

			<?php endif; ?>
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