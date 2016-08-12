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
				<a href="#" title="Creative Pinellas">
					<svg class='svgIcon svgIcon--logo'>
						<use xlink:href='#logoFull'/>
					</svg>
				</a>
				<!--   / Footer Logo     -->
			</div>
			<div class="medium-10 large-7 column siteFooter-nav">
				<!--        Navigation      -->
				<nav>
					<ul class="siteNavigation siteNavigation--footer u-list--plain u-list--inline">
						<li>
							<a href="#">For the arts community</a>
							<ul class="u-list--plain">
								<li><a href="#">Oure Grants</a></li>
								<li><a href="#">Grant Recipients</a></li>
								<li><a href="#">Learning Center</a></li>
								<li><a href="#">Events for Artists</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Explore the arts</a>
							<ul class="u-list--plain">
								<li><a href="#">Events</a></li>
								<li><a href="#">Venue Directory</a></li>
								<li><a href="#">Local Artists Directory</a></li>
							</ul>
						</li>
						<li><a href="#">New Releases</a></li>
					</ul>
				</nav>
				<!--      / Navigation      -->
			</div>
			<div class="medium-2 column siteFooter-social">
				<!--    Social list, Same as in header  -->
				<div class="siteFooter-blockTitle">
					Socialize
				</div>
				<ul class="socialList u-list--plain u-list--inline">
					<li>
						<a href="#" target="_blank" title="Follow us on Twitter">
							<svg class='svgIcon'>
								<use xlink:href='#twitter'/>
							</svg>
						</a>
					</li>
					<li>
						<a href="#" target="_blank" title="Follow us on Facebook">
							<svg class='svgIcon'>
								<use xlink:href='#facebook'/>
							</svg>
						</a>
					</li>
					<li>
						<a href="#" target="_blank" title="Follow us on Youtube">
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
					<a href="#"><img src="<?php echo get_template_directory_uri() . '/images/uploads/Pinellas_County_Government-white.png' ?>" alt="" width="150"></a>
					<a href="#"><img src="<?php echo get_template_directory_uri() . '/images/uploads/Vspc_reverse_logo.png' ?>" alt="" width="150"></a>
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
<div id="svgPlaceholder"></div>

<?php wp_footer(); ?>
	</body>

</html>
