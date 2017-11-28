<?php get_header(); ?>

<?php
echo "<div class=\"navigation-fixed\">";
wp_nav_menu( array( 
    'theme_location' => 'main-menu', 
    'menu' => 'main-menu',
    'container' => 'div',
    'container_class' => 'main_menu' ) );
echo "</div>";

if ( have_posts() ) {
    while ( have_posts() ) {
 
        the_post(); ?>
 
        <?php the_content(); ?>
 
    <?php }
}
?>

<?php get_footer(); ?>
