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
?>
	<section class="homeSection homeSection--journalSection">
		<div class="row homeSection-text">
			<div class="medium-11 medium-centered large-uncentered large-8 column">
				<?php if ( get_field( 'title_our_journal' ) ) : ?>
					<h1><?php echo get_field( 'title_our_journal' ); ?></h1>
				<?php endif; ?>
				<?php if ( get_field( 'text_our_journal' ) ) : ?>
					<p><?php echo get_field( 'text_our_journal' ); ?>
						<br></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="row expanded small-collapse small-up-1 medium-up-3 xlarge-up-4 xxlarge-up-5 entityGrid">
			<?php
			if( $atts['featured'] && $atts['featured'] == 1 ) {
				$query_args = array(
					'post_type'      => 'post',
					'category_name' => $atts['category'],
					'posts_per_page' => $atts['post_number'],
					'meta_key'       => '_is_ns_featured_post',
					'meta_value'     => 'yes'
				);
			} else {
				$query_args = array(
					'post_type'      => 'post',
					'category_name' => $atts['category'],
					'posts_per_page' => $atts['post_number'],
				);
			}
			$the_query  = new WP_Query( $query_args ); ?>

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
								<span class="gridItem-categoryDecor" style="background-color: <?php echo $rl_category_color; ?>"></span>
								<div class="gridItem-info">
									<h3><?php echo strtoupper( get_the_title() ); ?></h3>
									<p><?php the_excerpt_max_charlength( 100 ); ?></p>
									<p><strong><?php _e( 'Read Post', 'w4ptheme' ); ?></strong></p>
									<p class="u-text--upper"><i><?php echo strtoupper( $category[0]->cat_name ); ?></i></p>
								</div>
							</a>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</section>
<?php
}
add_shortcode( 'blog', 'posts_for_home_page' );