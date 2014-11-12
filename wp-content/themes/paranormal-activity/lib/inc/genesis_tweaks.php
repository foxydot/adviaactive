<?php
require_once('genesis_tweak_functions.php');
/*** GENERAL ***/
add_theme_support( 'html5' );//* Add HTML5 markup structure
add_theme_support( 'genesis-responsive-viewport' );//* Add viewport meta tag for mobile browsers
add_theme_support( 'custom-background' );//* Add support for custom background
//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
'header',
'nav',
'subnav',
'footer'
) );

/*** HEADER ***/
add_action('wp_head','msdlab_add_apple_touch_icons');
add_filter( 'genesis_search_text', 'msdlab_search_text' ); //customizes the serach bar placeholder
add_filter('genesis_search_button_text', 'msdlab_search_button'); //customize the search form to add fontawesome search button.
add_filter('genesis_structural_wrap-header','msdlab_add_gradient_bar');

/*** NAV ***/
/**
 * Move nav into header
 */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav' );

/*** SIDEBARS ***/
add_action('genesis_before', 'msdlab_ro_layout_logic'); //This ensures that the primary sidebar is always to the left.
add_action('after_setup_theme','msdlab_add_extra_theme_sidebars', 4); //creates widget areas for a hero and flexible widget area
add_filter('widget_text', 'do_shortcode');//shortcodes in widgets

/*** CONTENT ***/
add_filter('genesis_breadcrumb_args', 'msdlab_breadcrumb_args'); //customize the breadcrumb output
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs'); //move the breadcrumbs 
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
add_action('genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs'); //to outside of the loop area
add_action('genesis_before_entry','msd_post_image');//add the image above the entry

add_filter('excerpt_more', 'sp_read_more_link');
add_filter( 'the_content_more_link', 'sp_read_more_link' );

//remove_action( 'genesis_before_post_content', 'genesis_post_info' ); //remove the info (date, posted by,etc.)
remove_action( 'genesis_after_post_content', 'genesis_post_meta' ); //remove the meta (filed under, tags, etc.)
//remove_action( 'genesis_entry_header', 'genesis_post_info' ); //remove the info (date, posted by,etc.)
remove_action( 'genesis_entry_footer', 'genesis_post_meta'); //remove the meta (filed under, tags, etc.)
//add_action( 'msdlab_title_area', 'msdlab_do_post_subtitle' );

add_action( 'genesis_before_post', 'msdlab_post_image', 8 ); //add feature image across top of content on *pages*.
add_filter( 'genesis_next_link_text', 'msdlab_older_link_text', 20);
add_filter( 'genesis_prev_link_text', 'msdlab_newer_link_text', 20);
/*** FOOTER ***/
add_theme_support( 'genesis-footer-widgets', 1 ); //adds automatic footer widgets
//add the menu
add_action('genesis_before_footer','msdlab_do_footer_menu', 20);

remove_action('genesis_footer','genesis_do_footer'); //replace the footer
add_action('genesis_footer','msdlab_do_social_footer');//with a msdsocial support one

/*** HOMEPAGE (BACKEND SUPPORT) ***/
add_action('after_setup_theme','msdlab_add_homepage_hero_flex_sidebars'); //creates widget areas for a hero and flexible widget area
//add_action('after_setup_theme','msdlab_add_homepage_callout_sidebars'); //creates a widget area for a callout bar, usually between the hero and the widget area

/*** SITEMAP ***/
add_action('after_404','msdlab_sitemap');

/*** Blog Header ***/
//add_action('genesis_before_loop','msd_add_blog_header');
add_action('wp_head', 'msdlab_custom_hooks_management');