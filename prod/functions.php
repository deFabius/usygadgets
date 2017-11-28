<?php
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

function link_to_home_page() {
    add_menu_page('HomePage', 'Home Page', 'administrator', 'post.php?post=' . get_page_by_title( HOME_PAGE_TITLE )->ID . '&action=edit', '', 'dashicons-admin-home');
}

?>