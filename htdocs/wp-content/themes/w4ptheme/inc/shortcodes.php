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

/**
 * Shortcode to blog content.
 *
 * @param $atts
 *
 * @return string
 */
function posts_for_home_page( $atts ) {
	if ( ! $atts ) {
		$atts = array();
	}
	if ( ! $atts['post_number'] ) {
		$atts['post_number'] = 12;
	}
	if ( ! $atts['category'] ) {
		$atts['category'] = '';
	}
	if ( ! $atts['featured'] ) {
		$atts['featured'] = 0;
	}

	extract( shortcode_atts( array(
		'page_number' => $atts['post_number'],
		'category'    => $atts['category'],
		'featured'    => $atts['featured']
	), $atts ) );

	$query_args = array(
		'post_type'      => 'post',
		'category_name'  => $atts['category'],
		'posts_per_page' => $atts['post_number'],
	);

	if ( $atts['featured'] && $atts['featured'] == 1 ) {
		$query_args['meta_key']   = '_is_ns_featured_post';
		$query_args['meta_value'] = 'yes';
	}
	$the_query = new WP_Query( $query_args );
	ob_start();
	?>

	<?php if ( $the_query->have_posts() ) : ?>
		<?php  while ( $the_query->have_posts() ) : $the_query->the_post();
			$category        = get_the_category();
			$the_category_id = $category[0]->cat_ID;
			if ( function_exists( 'rl_color' ) ) {
				$rl_category_color = rl_color( $the_category_id );
			}
			?>
			<div class="column">
				<div class="gridItem gridItem--blog">
					<a href="<?php the_permalink() ?>" class="js-touchFocus">
						<img
							src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'big_blog_img' ); ?>"
							alt=""
							srcset="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'big_section_img' ); ?> 480w,
																     <?php echo get_the_post_thumbnail_url( get_the_ID(), 'big_blog_img' ); ?> 768w,
																     <?php echo get_the_post_thumbnail_url( get_the_ID(), 'img_680x680' ); ?> 1024w,
																     <?php echo get_the_post_thumbnail_url( get_the_ID(), 'img_940x940' ); ?> 1400w">
						<span class="gridItem-categoryDecor"
						      style="background-color: <?php echo $rl_category_color; ?>"></span>

						<div class="gridItem-info">
							<h3><?php echo strtoupper( get_the_title() ); ?></h3>

							<p><?php the_excerpt_max_charlength( 100 ); ?></p>

							<p>
								<strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong>
							</p>

							<p class="u-text--upper">
								<i><?php echo strtoupper( $category[0]->cat_name ); ?></i>
							</p>
						</div>
					</a>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif;
	$output = ob_get_contents();

	return $output;
}

add_shortcode( 'blog', 'posts_for_home_page' );

/**
 * Shortcode to Recipients list.
 *
 * @param $atts
 *
 * @return string
 */
function recipients_list( $atts ) {

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
	ob_start(); ?>
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
	ob_end_clean();

	return $output;
}

add_shortcode( 'recipients_list', 'recipients_list' );
