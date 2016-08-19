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
							<h1 class="postPage-title u-text--center"><?php the_title(); ?></h1>
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
						// Get current page and append to custom query parameters array
						$custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						$custom_query               = new WP_Query( $custom_query_args );
						$image_attr                 = array(
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
								<div class="medium-8 large-6 column">
									<div class="gridItem gridItem--blog">
										<a href="<?php the_permalink(); ?>" class="js-touchFocus">
											<?php the_post_thumbnail( 'big_blog_img', $image_attr ); ?>
											<span class="gridItem-categoryDecor" style="background-color: #f7941d"></span>
											<div class="gridItem-info">
												<h3><?php the_title(); ?></h3>
												<p><strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong></p>
											</div>
										</a>
									</div>
								</div>

							<?php elseif ( $count > 0 && $count < 3 ) : ?>
								<div class="medium-4 large-3 column">
									<div class="row small-collapse">
										<div class="small-12 halfMedium-6 medium-12 column">
											<div class="gridItem gridItem--blog">
												<a href="<?php the_permalink(); ?>" class="js-touchFocus">
													<?php the_post_thumbnail( 'small_blog_img', $image_attr ); ?>
													<span class="gridItem-categoryDecor" style="background-color: #f7941d"></span>
													<div class="gridItem-info">
														<h3><?php the_title(); ?></h3>
														<p><strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong></p>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>

								<?php elseif ( $count > 2 ) : ?>
								<div class="medium-12 large-3 column">
									<div class="row small-collapse">
										<div class="small-12 halfMedium-6 large-12 column">
											<div class="gridItem gridItem--blog">
												<a href="<?php the_permalink(); ?>" class="js-touchFocus">
													<?php the_post_thumbnail( 'small_blog_img', $image_attr ); ?>
													<span class="gridItem-categoryDecor" style="background-color: #f7941d"></span>

													<div class="gridItem-info">
														<h3><?php the_title(); ?></h3>
														<p><strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong></p>
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

			<!--    Related Posts   -->
					<?php if ( is_active_sidebar( 'sidebar-blog-landing-page' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-blog-landing-page' ); ?>
					<?php endif; ?>

<!--		</section>-->

	</div>

</section>

<?php get_footer(); ?>

