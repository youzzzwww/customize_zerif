<?php
/******************* add child css support *************************/
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles',99);
function child_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	// add remote fontawesome to solve the display problem
	//wp_enqueue_style( 'zerif_child_fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style('lightbox-min-style', get_stylesheet_directory_uri() . '/css/lightbox.min.css');
}

if ( get_stylesheet() !== get_template() ): 
    add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
         update_option( 'theme_mods_' . get_template(), $value );
         return $old_value; // prevent update to child theme mods
    }, 10, 2 );
    add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
        return get_option( 'theme_mods_' . get_template(), $default );
    } );
endif;

/******************* multilingual with polylang ************************/
add_filter( 'wp_nav_menu_items','add_language_switcher_box', 10, 2 );
function add_language_switcher_box( $items, $args ) {
    $items .= pll_the_languages( array('show_flags'=>1, 'echo'=>0 ) );
    return $items;
}

$multilingual_file = get_stylesheet_directory() . '/enable_polylang_theme_mods.php';
if ( file_exists($multilingual_file) ):
	require_once($multilingual_file);
endif;

/******************* add extra js code *************/
add_action( 'wp_enqueue_scripts', 'add_zerif_child_js' );
function add_zerif_child_js() {
	wp_enqueue_script( 'zerif_child_js', get_stylesheet_directory_uri() . '/js/childjs.js', array("jquery"), false, true); 
	wp_enqueue_script( 'lightbox_min_js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array("jquery"), false, true); 
}

/*********************** add widgets *************/
$widgets_file = get_stylesheet_directory() . '/extra_widgets.php';
if ( file_exists($widgets_file) ):
	require_once($widgets_file);
endif;
?>
