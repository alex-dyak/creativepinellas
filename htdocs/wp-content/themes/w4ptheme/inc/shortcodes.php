<?php
/**
 * W4P Theme Custom Shortcodes
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @package WordPress
 * @subpackage W4P-Theme
 */

/**
 * ------------------------------
 * Custom Shortcodes starts here.
 * ------------------------------
 */

function resipients_list( $atts ) {

	if ( ! $atts ) {
		$atts               = array();
		$atts['recipients'] = 4;
	}
	extract( shortcode_atts( array(
		'recipients' => $atts['recipients']
	), $atts ) );

	$query_args = array(
		'post_type'      => 'artist',
		'meta_key'       => 'artist_grant_recipient',
		'meta_value'     => '1',
		'posts_per_page' => $atts['recipients']
	);
	$the_query  = new WP_Query( $query_args );
	ob_start();?>
	<?php if ( $the_query->have_posts() ) : ?>
		<!--    RECIPIENTS List   -->

				<h2 class="u-text--center"><?php _e( 'RECIPIENTS LIST', 'w4ptheme' ); ?></h2>

				<div class="postsList">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<!--    postsList-item  -->
						<div class="postsList-item">
							<?php $img = get_the_post_thumbnail_url( get_the_ID() );
							if ( $img ) : ?>
								<div class="postsList-item-image">
									<img
										src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'small_blog_img' ); ?>"
										alt=""
										srcset="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'small_blog_img' ); ?> 460w,
											<?php echo get_the_post_thumbnail_url( get_the_ID(), 'related_post_img' ); ?> 768w">
									<span
										class="postsList-item-categoryDecor"></span>
								</div>
							<?php endif; ?>
							<div class="postsList-item-body">
								<h3><?php the_title(); ?></h3>

								<p><?php the_excerpt_max_charlength( 100 ); ?></p>

								<p><i>
										<?php $term_list = wp_get_post_terms( get_the_ID(), 'artist_media' ); ?>
										<?php if ( ! empty( $term_list ) ) :
											$count = count( $term_list );
											foreach ( $term_list as $key => $term ) : ?>
												<?php if ( $key == $count - 1 ) : ?>
													<?php echo strtoupper( $term->name ); ?>
												<?php else : ?>
													<?php echo strtoupper( $term->name ); ?><?php echo ', '; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
										<?php echo ' | ' . get_field( 'artist_genre' ); ?>
									</i></p>
							</div>
							<div>
								<a href="<?php the_permalink(); ?>"
								   class="btn btn--fullWidth"><?php _e( 'Read More', 'w4ptheme' ); ?></a>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<!--   / postsList-item  -->
				</div>

	<?php endif;
	$output = ob_get_contents();
	return $output;
}

add_shortcode( 'resipients_list', 'resipients_list' );
