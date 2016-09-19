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
			<?php
			// check if the repeater field has rows of data
			if (have_rows( 'section' )): ?>
			<!--    Sub page Promo  -->
			<section class="row halfMedium-collapse medium-uncollapse promoList">
				<?php // loop through the rows of data
				while ( have_rows( 'section' ) ) : the_row();
					$img_id = get_sub_field( 'page_image' );
					?>
					<!--   promoList-item  -->
					<div class="halfMedium-6 column">
						<div class="promoList-item">
							<a href="<?php the_sub_field( 'page_link' ); ?>" class="js-touchFocus">
								<div class="promoList-item-image">
									<img src="<?php echo wp_get_attachment_image_url($img_id, 'big_section_img'); ?>" alt=""
									     srcset="<?php echo wp_get_attachment_image_url($img_id, 'big_section_img'); ?> 480w,
											<?php echo wp_get_attachment_image_url($img_id, 'small_section_img'); ?> 1200w">
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
            <?php if ( get_field( 'title' ) ) : ?>
                <section class="promoSpace u-fullSection u-aquaGradient">
                    <div class="promoSpace-inner">
                        <h1><?php echo get_field( 'title' ); ?></h1>
                        <?php if ( get_field( 'description_text' ) ) : ?>
                            <?php echo get_field( 'description_text' ); ?>
                        <?php endif; ?>
                        <?php if ( get_field( 'page_link_1' ) ) : ?>
                            <a href="<?php echo get_field( 'page_link_1' ); ?>" class="btn btn--white"><?php echo strtoupper( get_field( 'button_title' ) ); ?></a>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>
		</section>
	</div>
</section>

<?php get_footer(); ?>
