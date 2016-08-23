<?php
/*
* Template Name: Section Page
*/

get_header(); ?>

	<section class="siteBody">
		<div class="row">
			<section class="small-centered large-10 column siteContent">
				<section class="row column">
					<?php if ( have_posts() ) :
						while ( have_posts() ) : the_post(); ?>
							<article class="postPage"
							         id="post-<?php the_ID(); ?>">
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
					<?php
					// check if the repeater field has rows of data
					if ( have_rows( 'section' ) ): ?>
              <!--    Sub page Promo  -->
              <section class="row halfMedium-collapse medium-uncollapse promoList">
						<?php // loop through the rows of data
						while ( have_rows( 'section' ) ) : the_row(); ?>
							<!--   promoList-item  -->
							<div class="halfMedium-6 column">
								<div class="promoList-item">
									<a href="<?php the_sub_field( 'page_link' ); ?>"
									   class="js-touchFocus">
										<div class="promoList-item-image">
											<?php
											$image = get_sub_field('page_image');
											$size = 'big_section_img';
											$thumb = $image['sizes'][ $size ];
											$width = $image['sizes'][ $size . '-width' ];
											$height = $image['sizes'][ $size . '-height' ];
											if( !empty( $image ) ): ?>
												<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"
												     width="<?php echo $width; ?>" height="<?php echo $height; ?>"/>
											<?php endif; ?>
										</div>
										<div class="promoList-item-body">
											<h3><?php the_sub_field( 'page_name' ); ?></h3>
											<p><?php the_sub_field( 'description' ); ?></p>
											<span class="promoList-item-categoryDecor" style="background-color: <?php the_sub_field( 'page_color' ); ?>;"></span>
										</div>
										<div class="promoList-item-button">
											<span class="btn btn--white"><?php echo strtoupper( get_sub_field( 'button_text' ) ); ?></span>
										</div>
									</a>
								</div>
								<!--   / promoList-item  -->
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</section>
				<section class="promoSpace u-fullSection u-aquaGradient">
					<div class="promoSpace-inner">
                      <?php if( get_field( 'title' ) ) : ?>
						<h1><?php echo get_field( 'title' ); ?></h1>
                      <?php endif; ?>
                      <?php if( get_field( 'title' ) ) : ?>
						<?php echo get_field( 'description_text' ); ?>
                      <?php endif; ?>
                      <?php if( get_field( 'page_link_1' ) ) : ?>
						<a href="<?php echo get_field( 'page_link_1' ); ?>" class="btn btn--white"><?php echo strtoupper( get_field( 'button_title' ) ); ?></a>
                      <?php endif; ?>
					</div>
				</section>
			</section>
		</div>
	</section>

<?php get_footer(); ?>
