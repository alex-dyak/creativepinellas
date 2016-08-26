<?php
/*
* Template Name: Blog Landing
*/

get_header(); ?>

<section class="siteBody">
	<div class="row">
		<section class="large-10 large-centered column siteContent">
			<section class="row column">
				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post(); ?>
						<article class="postPage" id="post-<?php the_ID(); ?>">
							<!--    Page title  -->
							<h1
								class="postPage-title u-text--center"><?php the_title(); ?></h1>
							<!--    Page Content    -->
							<div class="postPage-content">
								<?php the_content(); ?>
							</div>
							<!--   / Page Content    -->
						</article>
					<?php endwhile;
				endif; ?>
			</section>

			<section class="row medium-collapse">
				<div class="medium-10 large-12 column medium-centered">
					<div class="row small-collapse">
						<?php
						$custom_query_args = array(
							'post_type'  => 'post',
							'meta_key'   => '_is_ns_featured_post',
							'meta_value' => 'yes',
							'posts_per_page' => 5
						);
						$custom_query      = new WP_Query( $custom_query_args );
						?>

						<?php if ( $custom_query->have_posts() ) :
							$count = 0; ?>
							<!-- the loop -->
							<?php while ( $custom_query->have_posts() ) :
							$custom_query->the_post();

							$category = get_the_category();
							$the_category_id = $category[0]->cat_ID;
							if(function_exists('rl_color')){
								$rl_category_color = rl_color($the_category_id);
							}
							?>
							<?php if ( $count < 5 ) : ?>
							<?php if ( $count == 0 ) : ?>
								<div class="medium-8 large-6 column">
									<div class="gridItem gridItem--blog">
										<a href="<?php the_permalink(); ?>" class="js-touchFocus">

											<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?>" alt=""
											     srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?> 768W,
																<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small_blog_img'); ?> 1024w">

											<span class="gridItem-categoryDecor" style="background-color: <?php echo $rl_category_color; ?>"></span>
											<div class="gridItem-info">
												<h3><?php the_title(); ?></h3>
												<p>
													<strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong>
												</p>
											</div>
										</a>
									</div>
								</div>

							<?php elseif ( $count > 0 && $count < 3 ) :
								?>
								<div class="medium-4 large-3 column">
									<div class="row small-collapse">
										<div
											class="small-12 halfMedium-6 medium-12 column">
											<div
												class="gridItem gridItem--blog">
												<a href="<?php the_permalink(); ?>" class="js-touchFocus">

													<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?>" alt=""
													     srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?> 768W,
																<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small_blog_img'); ?> 1024w">

													<span class="gridItem-categoryDecor" style="background-color: <?php echo $rl_category_color; ?>"></span>
													<div class="gridItem-info">
														<h3><?php the_title(); ?></h3>
														<p>
															<strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong>
														</p>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>

							<?php elseif ( $count > 2 ) :

								?>
								<div class="medium-12 large-3 column">
									<div class="row small-collapse">
										<div class="small-12 halfMedium-6 large-12 column">
											<div class="gridItem gridItem--blog">
												<a href="<?php the_permalink(); ?>" class="js-touchFocus">
													<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?>" alt=""
													     srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?> 768W,
																<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small_blog_img'); ?> 1024w">

													<span class="gridItem-categoryDecor" style="background-color: <?php echo $rl_category_color; ?>"></span>
													<div class="gridItem-info">
														<h3><?php the_title(); ?></h3>
														<p>
															<strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong>
														</p>
													</div>
												</a>
											</div>
										</div>

									</div>
								</div>
							<?php endif; ?>

							<?php $count ++;
						endif; ?>
						<?php endwhile; ?>
							<!-- end of the loop -->

						<?php endif; ?>
						<?php wp_reset_query(); ?>
					</div>
				</div>
			</section>

			<!--    RECENT Posts   -->
			<section class="row medium-collapse">
				<div class="medium-8 large-10 column medium-centered">
					<h2 class="u-text--center"><?php _e( 'RECENT POSTS', 'w4ptheme' ); ?></h2>

					<div class="postsList">
						<?php
						$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$query_args = array(
							'post_type'      => 'post',
							'posts_per_page' => 6,
							'paged'          => $paged
						);
						$the_query  = new WP_Query( $query_args ); ?>
						<?php if ($the_query->have_posts()) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<!--    postsList-item  -->
							<div class="postsList-item">
								<?php $img = get_the_post_thumbnail_url( get_the_ID() );
								if ( $img ) : ?>
									<?php
									$category = get_the_category();
									$the_category_id = $category[0]->cat_ID;
									if(function_exists('rl_color')){
										$rl_category_color = rl_color($the_category_id);
									}
									?>
									<div class="postsList-item-image">
										<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small_blog_img'); ?>" alt=""
											srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small_blog_img'); ?> 460w,
											<?php echo get_the_post_thumbnail_url(get_the_ID(), 'related_post_img'); ?> 768w">
										<span class="postsList-item-categoryDecor"></span>
									</div>
								<?php endif; ?>
								<div class="postsList-item-body">
									<h3><?php the_title(); ?></h3>
									<p><?php the_excerpt_max_charlength(120); ?></p>
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
						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
						<!--   / postsList-item  -->
					</div>
					<?php if ( function_exists( 'wp_pagenavi' ) ) {
						wp_pagenavi( array(
							'before'        => '<nav class="navigation pagination" role="navigation">',
							'after'         => '</nav>',
							'wrapper_tag'   => 'div',
							'wrapper_class' => 'nav-links',
							'options'       => array(),
							'query'         => $the_query,
							'type'          => 'posts',
							'echo'          => TRUE
						) );
					}
					?>
					<?php endif; ?>

				</div>

			</section>

		</section>

	</div>

</section>

<?php get_footer(); ?>

