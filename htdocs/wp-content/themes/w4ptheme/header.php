<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */
?><!DOCTYPE html>
<html>


<head lang="en">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport"
	      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
	<title><?php wp_title( '|', TRUE, 'right' ); ?></title>
	<link rel="apple-touch-icon-precomposed" sizes="57x57"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-57x57.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="114x114"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-114x114.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="72x72"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-72x72.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="144x144"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-144x144.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="60x60"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-60x60.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="120x120"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-120x120.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="76x76"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-76x76.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="152x152"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-152x152.png"/>
	<link rel="icon" type="image/png"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-196x196.png"
	      sizes="196x196"/>
	<link rel="icon" type="image/png"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-96x96.png"
	      sizes="96x96"/>
	<link rel="icon" type="image/png"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-32x32.png"
	      sizes="32x32"/>
	<link rel="icon" type="image/png"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-16x16.png"
	      sizes="16x16"/>
	<link rel="icon" type="image/png"
	      href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-128.png"
	      sizes="128x128"/>
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF"/>
	<meta name="msapplication-TileImage" content="favicons/mstile-144x144.png"/>
	<meta name="msapplication-square70x70logo"
	      content="favicons/mstile-70x70.png"/>
	<meta name="msapplication-square150x150logo"
	      content="favicons/mstile-150x150.png"/>
	<meta name="msapplication-wide310x150logo"
	      content="favicons/mstile-310x150.png"/>
	<meta name="msapplication-square310x310logo"
	      content="favicons/mstile-310x310.png"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="title" content="<?php wp_title( '|', TRUE, 'right' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="off-canvas-wrapper">
<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
<div class="off-canvas position-right" id="offCanvas" data-off-canvas
     data-position="right" data-auto-focus="false">
	<?php wp_nav_menu( array(
		'theme_location'  => 'primary',
		'menu'            => 'main-menu',
		'container'       => 'nav',
		'container_class' => 'offCanvas-navigation',
		'container_id'    => '',
		'menu_class'      => 'siteNavigation siteNavigation--mobile u-list--plain js-mobileNavigation',
		'menu_id'         => '',
		'echo'            => TRUE,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => new Mobile_Nav_Menu(),
	) ); ?>
	<div class="offCanvas-social">
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

	</div>
</div>
<div class="off-canvas-content" data-off-canvas-content>
	<?php if (is_front_page()): ?>
	<header class="siteHeader siteHeader--headerSection">
		<?php else : ?>
		<header class="siteHeader">
			<?php endif; ?>
			<div class="row siteHeader-inner">
				<section class="row column siteHeader-top">
					<div class="small-8 medium-3 column">
						<div class="siteHeader-logo">
							<a href="<?php echo get_home_url(); ?>"
							   title="Creative Pinellas">
								<svg class='svgIcon svgIcon--logo'>
									<use xlink:href='#logoFull'/>
								</svg>
							</a>
						</div>
					</div>
					<div class="small-4 medium-9 column u-text--right">
						<div class="show-for-medium siteHeader-social">
							<ul class="socialList u-list--plain u-list--inline">
								<li>
									<a href="<?php echo get_option( 'w4p_social_profiles' )['twitter'][1]; ?>"
									   target="_blank"
									   title="Follow us on Twitter">
										<svg class='svgIcon'>
											<use xlink:href='#twitter'/>
										</svg>
									</a>
								</li>
								<li>
									<a href="<?php echo get_option( 'w4p_social_profiles' )['facebook'][1]; ?>"
									   target="_blank"
									   title="Follow us on Facebook">
										<svg class='svgIcon'>
											<use
												xlink:href='#facebook'/>
										</svg>
									</a>
								</li>
								<li>
									<a href="<?php echo get_option( 'w4p_social_profiles' )['youtube'][1]; ?>"
									   target="_blank"
									   title="Follow us on Youtube">
										<svg class='svgIcon'>
											<use xlink:href='#youtube'/>
										</svg>
									</a>
								</li>
							</ul>
							<!-- /build -->
						</div>
						<?php wp_nav_menu( array(
							'theme_location'  => 'contacts',
							'menu'            => 'contacts',
							'container'       => 'nav',
							'container_class' => 'show-for-medium siteHeader-topNav',
							'container_id'    => '',
							'menu_class'      => 'siteNavigation u-list--plain u-list--inline',
							'menu_id'         => '',
							'echo'            => TRUE,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => '',
						) ); ?>

						<?php wp_nav_menu( array(
							'theme_location'  => 'primary',
							'menu'            => 'main-menu',
							'container'       => 'nav',
							'container_class' => 'siteHeader-mainNav',
							'container_id'    => '',
							'menu_class'      => 'siteNavigation siteNavigation--header u-list--plain u-list--inline u-text--left js-touchNav',
							'menu_id'         => '',
							'echo'            => TRUE,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 2,
							'walker'          => new Main_Nav_Menu(),
						) ); ?>
						<a href="#"
						   class="siteHeader-searchToggle searchToggle js-toggle"
						   data-toggle="widget_search"><i
								class="fa fa-search"
								aria-hidden="true"></i></a>
						<a href="#"
						   class="hide-for-large mobileNavToggle js-mobileNavToggle"
						   data-toggle="offCanvas" data-open="CLOSE"
						   data-close="MENU">
									<span
										class="mobileNavToggle-hamburger"><span></span></span>
						</a>
					</div>
				</section>
				<section
					class="row column medium-collapse siteHeader-widgets">
					<div class="medium-6 medium-offset-6 column">
						<div id="search-2" class="widget widget_search">
							<form role="search" method="get"
							      id="searchform"
							      action="http://creativepinellas.loc/">
								<div class="row medium-collapse">
									<div class="small-8 column">
										<label for="s"
										       class="screen-reader-text">Search
											for:</label>
										<input type="search" id="s"
										       name="s" value=""
										       placeholder="e.g gallery opening">
									</div>
									<div class="small-4 column">
										<input type="submit"
										       value="Search"
										       id="searchsubmit"
										       class="btn btn--fullWidth btn--white">
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
				<?php if ( is_front_page() ):
					$frontpage_id = get_option( 'page_on_front' );
					if ( $frontpage_id ): ?>
						<section class="row column headerSection">
							<?php if ( get_field( 'header_image', $frontpage_id ) ) :
								$img_id = get_field( 'header_image', $frontpage_id ); ?>
								<div class="medium-6 large-7 column">
									<div class="headerSection-poster">
										<img
											src="<?php echo wp_get_attachment_image_url( $img_id, 'header_img' ); ?>"
											alt=""
											srcset="<?php echo wp_get_attachment_image_url( $img_id, 'header_img' ); ?> 480w,
								            <?php echo wp_get_attachment_image_url( $img_id, 'header_img_1600x1080' ); ?> 768w,
											<?php echo wp_get_attachment_image_url( $img_id, 'header_img_1060x715' ); ?> 1200w">
									</div>
								</div>
							<?php endif; ?>
							<div class="medium-6 large-5 column">
								<div class="headerSection-text">
									<?php if ( get_field( 'header_title', $frontpage_id ) ) : ?>
										<h1><?php echo get_field( 'header_title', $frontpage_id ); ?></h1>
									<?php endif; ?>
									<?php if ( get_field( 'header_text', $frontpage_id ) ) : ?>
										<p class=""><?php echo get_field( 'header_text', $frontpage_id ); ?></p>
									<?php endif; ?>
									<?php if ( get_field( 'event_url', $frontpage_id ) ) : ?>
										<a href="<?php echo get_field( 'event_url', $frontpage_id ); ?>"
										   class="btn btn--white"><?php echo strtoupper( __( 'See Event', 'w4ptheme' ) ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</section>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</header>

