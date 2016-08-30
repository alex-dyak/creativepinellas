<?php
/**
 * The front page template file
 */

get_header(); ?>

	<section class="siteBody">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<section class="homeSection homeSection--homeIntro">
					<div class="row homeSection-text">
						<div
							class="medium-11 medium-centered large-uncentered large-8 column">
							<?php if ( get_field( 'title_what_is_section' ) ) : ?>
								<h1><?php echo get_field( 'title_what_is_section' ); ?></h1>
							<?php endif; ?>
							<?php if ( get_field( 'text_what_is_section' ) ) : ?>
								<p><?php echo get_field( 'text_what_is_section' ); ?>
									<br></p>
							<?php endif; ?>
						</div>
					</div>
					<?php
					// check if the repeater field has rows of data
					if (have_rows( 'explore_art_venues' )):
					$row_count   = count( get_field( 'explore_art_venues' ) );
					$row_counter = 0;
					?>
					<div
						class="row small-collapse homeSection--homeIntro-gridList">
						<?php // loop through the rows of data
						while (have_rows( 'explore_art_venues' )) :
						the_row();
						$img_id = get_sub_field( 'image_explore_art_venues' );
						$row_counter ++;
						?>
						<?php if ($row_counter == $row_count) : ?>
						<div class="medium-4 column end">
							<?php else : ?>
							<div class="medium-4 column">
								<?php endif; ?>
								<div class="promoList-item">
									<?php if ( get_sub_field( 'venue_directory' ) ) : ?>
										<a href="<?php the_sub_field( 'venue_directory' ); ?>"
										   class="js-touchFocus">
											<div class="promoList-item-image">
												<?php if ( $img_id ) : ?>
													<img
														src="<?php echo wp_get_attachment_image_url( $img_id, 'big_section_img' ); ?>"
														alt=""
														srcset="<?php echo wp_get_attachment_image_url( $img_id, 'big_section_img' ); ?> 480w,
								     <?php echo wp_get_attachment_image_url( $img_id, 'big_blog_img' ); ?> 768w,
									 <?php echo wp_get_attachment_image_url( $img_id, 'small_section_img' ); ?> 1200w">
												<?php endif; ?>
											</div>
											<div class="promoList-item-body">
												<?php if ( get_sub_field( 'title_explore_art_venues' ) ) : ?>
													<h3><?php the_sub_field( 'title_explore_art_venues' ); ?></h3>
												<?php endif; ?>
												<?php if ( get_sub_field( 'text_explore_art_venues' ) ) : ?>
													<p><?php the_sub_field( 'text_explore_art_venues' ); ?></p>
												<?php endif; ?>
												<?php if ( get_sub_field( 'color_explore_art_venues' ) ) : ?>
													<span
														class="promoList-item-categoryDecor"
														style="background-color: <?php the_sub_field( 'color_explore_art_venues' ); ?>;"></span>
												<?php endif; ?>
											</div>
											<?php if ( get_sub_field( 'button_text_explore_art_venues' ) ) : ?>
												<div
													class="promoList-item-button">
											<span
												class="btn btn--white"><?php echo strtoupper( get_sub_field( 'button_text_explore_art_venues' ) ); ?></span>
												</div>
											<?php endif; ?>
										</a>
									<?php endif; ?>
								</div>
								<!--   / promoList-item  -->
							</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>
				</section>
				<!-- end .homeIntro -->

				<section class="homeSection communitySection">
					<div class="row homeSection-text">
						<div
							class="medium-11 medium-centered large-uncentered large-8 column">
							<?php if ( get_field( 'title_for_the_art_community' ) ) : ?>
								<h1><?php echo get_field( 'title_for_the_art_community' ); ?></h1>
							<?php endif; ?>
							<?php if ( get_field( 'text_for_the_art_community' ) ) : ?>
								<p><?php echo get_field( 'text_for_the_art_community' ); ?>
									<br></p>
							<?php endif; ?>
						</div>
					</div>
					<?php
					// check if the repeater field has rows of data
					if (have_rows( 'community' )): ?>
					<!--    Sub page Promo  -->
					<div class="row js-community-equalHeight">
						<?php // loop through the rows of data
						while ( have_rows( 'community' ) ) : the_row();
							$img_id = get_sub_field( 'image_community' ); ?>
							<div class="small-4 column">
								<?php if ( get_sub_field( 'url_community' ) ) : ?>
									<a href="<?php the_sub_field( 'url_community' ); ?>"
									   class="communitySection-link" data-equal>
										<?php if ( $img_id ) : ?>
											<span
												class="communitySection-link-imgLayer"
												style="background-image: url(<?php echo wp_get_attachment_image_url( $img_id, 'arts_community_img' ); ?>)"></span>
										<?php endif; ?>
										<?php if ( get_sub_field( 'title_community' ) ) : ?>
											<span
												class="communitySection-link-text js-equalizer"><?php the_sub_field( 'title_community' ); ?></span>
										<?php endif; ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</section>
				<!-- end .communitySection -->

				<?php the_content(); ?>

				<?php if ( get_field( 'posts_our_journal' ) ) : ?>
					<h1><?php echo get_field( 'posts_our_journal' ); ?></h1>
				<?php endif; ?>

			<?php endwhile; ?>
		<?php endif; ?>
	</section>


<?php get_footer(); ?>