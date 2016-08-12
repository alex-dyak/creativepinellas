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
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-57x57.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-114x114.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-72x72.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-144x144.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-60x60.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-120x120.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-76x76.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-152x152.png"/>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-196x196.png" sizes="196x196"/>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-96x96.png" sizes="96x96"/>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-32x32.png" sizes="32x32"/>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-16x16.png" sizes="16x16"/>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-128.png" sizes="128x128"/>
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF"/>
	<meta name="msapplication-TileImage" content="favicons/mstile-144x144.png"/>
	<meta name="msapplication-square70x70logo" content="favicons/mstile-70x70.png"/>
	<meta name="msapplication-square150x150logo" content="favicons/mstile-150x150.png"/>
	<meta name="msapplication-wide310x150logo" content="favicons/mstile-310x150.png"/>
	<meta name="msapplication-square310x310logo" content="favicons/mstile-310x310.png"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="off-canvas-wrapper">
	<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<div class="off-canvas position-right" id="offCanvas" data-off-canvas data-position="right" data-auto-focus="false">
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu'            => 'main-menu',
				'container'       => 'nav',
				'container_class' => 'offCanvas-navigation',
				'container_id'    => '',
				'menu_class'      => 'siteNavigation siteNavigation--mobile u-list--plain js-mobileNavigation',
				'menu_id'         => '',
				'echo'            => true,
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
						<a href="<?php echo get_option( 'w4p_social_profiles' )['twitter'][1]; ?>" target="_blank" title="Follow us on Twitter">
							<svg class='svgIcon'>
								<use xlink:href='#twitter'/>
							</svg>
						</a>
					</li>
					<li>
						<a href="<?php echo get_option( 'w4p_social_profiles' )['facebook'][1]; ?>" target="_blank" title="Follow us on Facebook">
							<svg class='svgIcon'>
								<use xlink:href='#facebook'/>
							</svg>
						</a>
					</li>
					<li>
						<a href="<?php echo get_option( 'w4p_social_profiles' )['youtube'][1]; ?>" target="_blank" title="Follow us on Youtube">
							<svg class='svgIcon'>
								<use xlink:href='#youtube'/>
							</svg>
						</a>
					</li>
				</ul>

			</div>
		</div>
<div class="off-canvas-content" data-off-canvas-content>
  <header class="siteHeader">
    <section class="row siteHeader-top">
      <div class="small-9 medium-3 column">
        <div class="siteHeader-logo">
          <a href="<?php echo get_home_url(); ?>" title="Creative Pinellas">
	          <img class="header-image svgIcon svgIcon--logo" src="<?php header_image(); ?>"
	               width="<?php echo esc_attr(get_custom_header()->width ); ?>"
	               height="<?php echo esc_attr(get_custom_header()->height ); ?>" alt=""/>
          </a>
        </div>
      </div>
      <div class="small-3 medium-9 column u-text--right">
        <div class="show-for-medium siteHeader-social">
          <!-- build:section blocks.socialList -->
	        <ul class="socialList u-list--plain u-list--inline">
		        <li>
			        <a href="<?php echo get_option( 'w4p_social_profiles' )['twitter'][1]; ?>" target="_blank" title="Follow us on Twitter">
				        <svg class='svgIcon'>
					        <use xlink:href='#twitter'/>
				        </svg>
			        </a>
		        </li>
		        <li>
			        <a href="<?php echo get_option( 'w4p_social_profiles' )['facebook'][1]; ?>" target="_blank" title="Follow us on Facebook">
				        <svg class='svgIcon'>
					        <use xlink:href='#facebook'/>
				        </svg>
			        </a>
		        </li>
		        <li>
			        <a href="<?php echo get_option( 'w4p_social_profiles' )['youtube'][1]; ?>" target="_blank" title="Follow us on Youtube">
				        <svg class='svgIcon'>
					        <use xlink:href='#youtube'/>
				        </svg>
			        </a>
		        </li>
	        </ul>
	        <!-- /build -->
        </div>
	        <?php wp_nav_menu( array(
		        'theme_location' => 'contacts',
		        'menu'            => 'contacts',
		        'container'       => 'nav',
		        'container_class' => 'show-for-medium siteHeader-topNav',
		        'container_id'    => '',
		        'menu_class'      => 'siteNavigation u-list--plain u-list--inline',
		        'menu_id'         => '',
		        'echo'            => true,
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
		        'theme_location' => 'primary',
		        'menu'            => 'main-menu',
		        'container'       => 'nav',
		        'container_class' => 'show-for-large',
		        'container_id'    => '',
		        'menu_class'      => 'siteNavigation siteNavigation--header u-list--plain u-list--inline u-text--left',
		        'menu_id'         => '',
		        'echo'            => true,
		        'fallback_cb'     => 'wp_page_menu',
		        'before'          => '',
		        'after'           => '',
		        'link_before'     => '',
		        'link_after'      => '',
		        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		        'depth'           => 2,
		        'walker'          => new Main_Nav_Menu(),
	        ) ); ?>

        <button type="button" class="hide-for-large mobileNavToggle js-mobileNavToggle" data-toggle="offCanvas" data-open="CLOSE" data-close="MENU">
          <span class="mobileNavToggle-hamburger"><span></span></span>
        </button>
      </div>
    </section>
  </header>

