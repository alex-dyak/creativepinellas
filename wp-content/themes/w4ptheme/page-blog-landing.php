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
						);
						$custom_query      = new WP_Query( $custom_query_args );
						$image_attr        = array(
							'alt' => '',
						);
						?>

						<?php if ( $custom_query->have_posts() ) :
							$count = 0; ?>
							<!-- the loop -->
							<?php while ( $custom_query->have_posts() ) :
							$custom_query->the_post(); ?>
							<?php if ( $count < 5 ) : ?>
							<?php if ( $count == 0 ) : ?>
								<?php
								$category = get_the_category();
								$the_category_id = $category[0]->cat_ID;
								if(function_exists('rl_color')){
									$rl_category_color = rl_color($the_category_id);
								}
								?>
								<div class="medium-8 large-6 column">
									<div class="gridItem gridItem--blog">
										<a href="<?php the_permalink(); ?>"
										   class="js-touchFocus">
											<?php the_post_thumbnail( 'big_blog_img', $image_attr ); ?>
											<span class="gridItem-categoryDecor"
											      style="background-color: <?php echo $rl_category_color; ?>"></span>

											<div class="gridItem-info">
												<h3><?php the_title(); ?></h3>

												<p>
													<strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong>
												</p>
											</div>
										</a>
									</div>
								</div>

							<?php elseif ( $count > 0 && $count < 3 ) : ?>
								<?php
								$category = get_the_category();
								$the_category_id = $category[0]->cat_ID;
								if(function_exists('rl_color')){
									$rl_category_color = rl_color($the_category_id);
								}
								?>
								<div class="medium-4 large-3 column">
									<div class="row small-collapse">
										<div
											class="small-12 halfMedium-6 medium-12 column">
											<div
												class="gridItem gridItem--blog">
												<a href="<?php the_permalink(); ?>"
												   class="js-touchFocus">
													<?php the_post_thumbnail( 'small_blog_img', $image_attr ); ?>
													<span
														class="gridItem-categoryDecor"
														style="background-color: <?php echo $rl_category_color; ?>"></span>

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

							<?php elseif ( $count > 2 ) : ?>
								<?php
								$category = get_the_category();
								$the_category_id = $category[0]->cat_ID;
								if(function_exists('rl_color')){
									$rl_category_color = rl_color($the_category_id);
								}
								?>
								<div class="medium-12 large-3 column">
									<div class="row small-collapse">
										<div
											class="small-12 halfMedium-6 large-12 column">
											<div
												class="gridItem gridItem--blog">
												<a href="<?php the_permalink(); ?>"
												   class="js-touchFocus">
													<?php the_post_thumbnail( 'small_blog_img', $image_attr ); ?>
													<span
														class="gridItem-categoryDecor"
														style="background-color: <?php echo $rl_category_color; ?>"></span>

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
						<?php
						// Reset postdata
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>

			<!--    RECENT Posts   -->
			<section class="row medium-collapse">
				<div class="medium-8 large-10 column medium-centered">
					<h2 class="u-text--center">RECENT POSTS</h2>

					<div class="postsList">
						<?php
						$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$query_args = array(
							'post_type'      => 'post',
							'posts_per_page' => 2,
							'paged'          => $paged
						);
						$the_query  = new WP_Query( $query_args ); ?>
						<?php if ($the_query->have_posts()) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<!--    postsList-item  -->
							<div class="postsList-item">
								<?php $img = wp_rp_get_post_thumbnail_img( get_post() );
								if ( $img ) : ?>
									<?php
									$category = get_the_category();
									$the_category_id = $category[0]->cat_ID;
									if(function_exists('rl_color')){
										$rl_category_color = rl_color($the_category_id);
									}
									?>
									<div class="postsList-item-image"><?php echo $img; ?>
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
									<a href="<?php the_permalink(); ?>"
									   class="btn btn--fullWidth"><?php _e( 'Read Article', 'w4ptheme' ); ?></a>
								</div>
							</div>
						<?php endwhile; ?>
						<!--   / postsList-item  -->
					</div>
					<!--    pagination form WP theme Twenty Sixteen  -->
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

