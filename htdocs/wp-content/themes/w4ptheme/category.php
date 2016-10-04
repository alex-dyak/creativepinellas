<?php
/**
 * A Simple Category Template
 */

get_header(); ?>

	<section class="siteBody">
		<div class="row">
			<section class="medium-8 large-9 column siteContent siteContent--hasSidebar">
				<?php if (have_posts()) : ?>
				<section class="row column">
					<article class="postPage">
						<!--    Post title  -->
						<h1 class="postPage-title"><?php single_cat_title(); ?></h1>
						<!--    Post Content    -->
						<div class="postPage-content">
							<?php echo category_description(); ?>
						</div>
						<!--    /Post Content    -->
					</article>
				</section>
				<section class="row column">
					<!--    Posts List  -->
					<div class="postsList">
					<?php while ( have_posts() ) : the_post(); ?>
						<!--    postsList-item  -->
						<div class="postsList-item">
							<?php $img = wp_rp_get_post_thumbnail_img( get_post() );
							if ( $img ) : ?>
								<?php
								$category = get_the_category();
								// If post has a category assigned.
								if ($category){
									if ( class_exists('WPSEO_Primary_Term') )
									{
										// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
										$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
										$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
										$term = get_term( $wpseo_primary_term );
										if (is_wp_error($term)) {
											// Default to first category (not Yoast) if an error is returned
											$the_category_id = $category[0]->term_id;
										} else {
											// Yoast Primary category
											$the_category_id = $term->term_id;
										}
									}
									else {
										// Default, display the first category in WP's list of assigned categories
										$the_category_id = $category[0]->term_id;
									}
								}

								if ( function_exists( 'rl_color' ) ) {
									$rl_category_color = rl_color( $the_category_id );
								}
								?>
								<div class="postsList-item-image">
								<?php if ( has_post_thumbnail() ) : ?>
									<img
										src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'small_blog_img' ); ?>"
										alt=""
										srcset="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'small_blog_img' ); ?> 460w,
											<?php echo get_the_post_thumbnail_url( get_the_ID(), 'related_post_img' ); ?> 768w">
								<?php else : ?>
									<?php $img = get_template_directory_uri() . '/images/default_for_grid/cpin-fallback-image-icon.jpg'; ?>
									<img src="<?php echo $img; ?>" alt=""
									     srcset="<?php echo $img; ?> 768w, <?php echo $img; ?> 1024w,  <?php echo $img; ?> 1400w">
								<?php endif; ?>
									<span class="postsList-item-categoryDecor"
									      style="background-color: <?php echo $rl_category_color; ?>"></span>
								</div>
							<?php endif; ?>
							<div class="postsList-item-body">
								<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
								<p><?php the_excerpt_max_charlength(150); ?></p>
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
					</div>
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
				<p><?php _e( 'Sorry, no posts matched your criteria.', 'w4ptheme' ) ?></p>
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
