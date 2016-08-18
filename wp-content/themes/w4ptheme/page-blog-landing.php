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
			<section class="row medium-collapse">
				<div class="medium-8 large-10 column medium-centered">
					<h2 class="u-text--center">RECENT POSTS</h2>

					<div class="postsList">
						<!--    postsList-item  -->
						<div class="postsList-item">
							<div class="postsList-item-image">
								<img src="http://placehold.it/880x880" alt="" srcset="http://placehold.it/880x880 460w, http://placehold.it/280x280 768w">
								<span class="postsList-item-categoryDecor" style="background-color: #0177c1"></span>
							</div>
							<div class="postsList-item-body">
								<h3>Opera Made NEW</h3>
								<p>Body font is set to 16px pragmatica-web. All other relationships cascade from the base body font. P size is 1em/1.6em, Pragmatica Light, 300 weight...</p>
								<p><i>BY AUTHOR NAME | <a href="#">CATEGORY</a></i></p>
							</div>
							<div>
								<a href="#" class="btn btn--fullWidth">Read Article</a>
							</div>
						</div>
						<!--   / postsList-item  -->

						<!--    postsList-item  -->
						<div class="postsList-item">
							<div class="postsList-item-image">
								<img src="http://placehold.it/880x880" alt="" srcset="http://placehold.it/880x880 460w, http://placehold.it/280x280 768w">
								<span class="postsList-item-categoryDecor" style="background-color: #f7941d"></span>
							</div>
							<div class="postsList-item-body">
								<h3>Opera Made NEW</h3>
								<p>Body font is set to 16px pragmatica-web. Body font is set to 16px pragmatica-web...</p>
								<div class="postsList-item-info">BY AUTHOR NAME | <a href="#">CATEGORY</a></div>
							</div>
							<div>
								<a href="#" class="btn btn--fullWidth">Read Article</a>
							</div>
						</div>
						<!--   / postsList-item  -->
					</div>

					<!--    pagination form WP theme Twenty Sixteen  -->
					<nav class="navigation pagination" role="navigation">
						<h2 class="screen-reader-text">Posts navigation</h2>
						<div class="nav-links">
							<a class="prev page-numbers" href="#">
								Previous page
							</a>
							<a class="page-numbers" href="#">
								<span class="meta-nav screen-reader-text">Page </span> 1
							</a>
							<span class="page-numbers dots">...</span>
							<a class="page-numbers" href="#">
								<span class="meta-nav screen-reader-text">Page </span> 3
							</a>
                                            <span class="page-numbers current">
            <span class="meta-nav screen-reader-text">Page </span> 4
                                            </span>
							<a class="page-numbers" href="#">
								<span class="meta-nav screen-reader-text">Page </span> 5
							</a>
							<a class="next page-numbers" href="#">
								Next page
							</a>
						</div>
					</nav>

				</div>

			</section>

		</section>

	</div>

</section>


		</section>

	</div>
</section>

<?php get_footer(); ?>

