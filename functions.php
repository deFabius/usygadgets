<?php
show_admin_bar( false );
define( 'HOME_PAGE_TITLE', 'Home Page' );
define( 'BUILDER_META_NAME', "use_depagebuilder");

add_action("after_switch_theme", "setup_theme");

function setup_theme() {

    // Check if home page is already available
    if (get_page_by_title(HOME_PAGE_TITLE) == null) {
        // Home page data.
        $home_page_data = array(
            'post_title'    => HOME_PAGE_TITLE,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page'
        );
        
        // Insert the post into the database and get the ID
        $home_page_id = wp_insert_post( $home_page_data );
        add_post_meta( $home_page_id, BUILDER_META_NAME, "true", true );

    } else {
        $page = get_page_by_title( HOME_PAGE_TITLE );
        $home_page_id = $page->ID;
        $use_builder = get_post_meta( $home_page_id, BUILDER_META_NAME, true );
        if ($use_builder != '') {
            update_post_meta( $home_page_id, BUILDER_META_NAME, "true" );
        } else {
            add_post_meta( $home_page_id, BUILDER_META_NAME, "true", true );
        }
    }

    // update site front-page
    update_option( 'page_on_front', $home_page_id );
    update_option( 'show_on_front', 'page' );
} 

add_action('admin_menu', 'link_to_home_page');
add_action( 'wp_enqueue_scripts', 'css_loader' );
add_action( 'init', 'register_menu' );

function link_to_home_page() {
    add_menu_page('HomePage', 'Home Page', 'administrator', 'post.php?post=' . get_page_by_title( HOME_PAGE_TITLE )->ID . '&action=edit', '', 'dashicons-admin-home');
}

function css_loader($hook_suffix) {
    wp_enqueue_style( "open-sans", "//fonts.googleapis.com/css?family=Open+Sans");
    wp_enqueue_style( "style.css", get_stylesheet_directory_uri() . "/css/style.css");
    wp_enqueue_script( "slide-show", get_stylesheet_directory_uri() . "/js/slide-show.js", array( "jquery"));
    wp_enqueue_script("font-awesome", "//use.fontawesome.com/dedf3b6161.js");
    // wp_enqueue_media();
}

function register_menu() {
    register_nav_menu('main-menu',__( 'Main Menu' ));
}


function wpb_widgets_init() {
    
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'wpb' ),
        'id' => 'sidebar-1',
        'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' =>__( 'Front page sidebar', 'wpb'),
        'id' => 'sidebar-2',
        'description' => __( 'Appears on the static front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
    
add_action( 'widgets_init', 'wpb_widgets_init' );
?>