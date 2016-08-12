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
?><!doctype html>

<!--[if lt IE 7 ]>
<html
	class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html
	class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html
	class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head data-template-set="W4P-Theme">

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Always force latest IE rendering engine (even in intranet) -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>"/>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="off-canvas-wrapper">

  <header class="siteHeader">
    <section class="row siteHeader-top">
      <div class="small-9 medium-3 column">
        <div class="siteHeader-logo">
          <a href="<?php echo get_home_url(); ?>" title="Creative Pinellas">
            <svg class='svgIcon svgIcon--logo'>
              <use xlink:href='#logoFull'/>
            </svg>
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

