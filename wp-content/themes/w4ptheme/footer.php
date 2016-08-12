<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

?>
<footer class="siteFooter">
	<div class="siteFooter-inner">
		<div class="row medium-collapse">
			<div class="large-3 column siteFooter-logo">
				<!--    Footer Logo     -->
				<a href="<?php echo get_home_url(); ?>"
				   title="Creative Pinellas">
					<img class="header-image svgIcon svgIcon--logo" src="<?php header_image(); ?>"
					     width="<?php echo esc_attr(get_custom_header()->width ); ?>"
					     height="<?php echo esc_attr(get_custom_header()->height ); ?>" alt=""/>
				</a>
				<!--   / Footer Logo     -->
			</div>
			<div class="medium-10 large-7 column siteFooter-nav">
				<!--        Navigation      -->
				<?php wp_nav_menu( array(
					'theme_location'  => 'footer',
					'menu'            => 'footer-menu',
					'container'       => 'nav',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'siteNavigation siteNavigation--footer u-list--plain u-list--inline',
					'menu_id'         => '',
					'echo'            => TRUE,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 2,
					'walker'          => new Footer_Nav_Menu(),
				) ); ?>
				<!--      / Navigation      -->
			</div>
			<div class="medium-2 column siteFooter-social">
				<!--    Social list, Same as in header  -->
				<div class="siteFooter-blockTitle">
					Socialize
				</div>
				<ul class="socialList u-list--plain u-list--inline">
					<li>
						<a href="<?php echo get_option( 'w4p_social_profiles' )['twitter'][1]; ?>"
						   target="_blank" title="Follow us on Twitter">
							<svg class='svgIcon'>
								<use xlink:href='#twitter'/>
							</svg>
						</a>
					</li>
					<li>
						<a href="<?php echo get_option( 'w4p_social_profiles' )['facebook'][1]; ?>"
						   target="_blank" title="Follow us on Facebook">
							<svg class='svgIcon'>
								<use xlink:href='#facebook'/>
							</svg>
						</a>
					</li>
					<li>
						<a href="<?php echo get_option( 'w4p_social_profiles' )['youtube'][1]; ?>"
						   target="_blank" title="Follow us on Youtube">
							<svg class='svgIcon'>
								<use xlink:href='#youtube'/>
							</svg>
						</a>
					</li>
				</ul>

				<!--   / Social list, Same as in header  -->
			</div>
		</div>
		<div class="row">
			<div class="column">
				<!--    Footer logotypes    -->
				<div class="siteFooter-partnerLogos">
					<a href="<?php echo get_option( 'w4p_partners_link_1' ); ?>"><img
							src="<?php echo get_option( 'w4p_partners_logo_1' ); ?>"
							alt="" width="150"></a>
					<a href="<?php echo get_option( 'w4p_partners_link_2' ); ?>"><img
							src="<?php echo get_option( 'w4p_partners_logo_2' ); ?>"
							alt="" width="150"></a>
				</div>
				<!--   / Footer logotypes    -->
			</div>
		</div>
		<div class="row">
			<div class="column">
				<!--    Copyright   -->
				<div class="siteFooter-copyright">
					<p>
						<?php
						if ( $copyright = get_option( 'w4p_copyright' ) ) {
							echo esc_html( $copyright );
						} else {
							echo sprintf( esc_html__( 'Copyright © %d. %s. All Rights Reserved. Creative Pinellas, Inc. 14025 58th Street N. Largo, FL 33760', 'w4ptheme' ), date( 'Y' ), get_bloginfo( 'name' ) );
						}
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>

</div>
</div>
</div>
<div id="svgPlaceholder"></div>

<?php wp_footer(); ?>
</body>

</html>
