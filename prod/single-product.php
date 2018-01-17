<?php get_header(); ?>

<div class="navigation-fixed">

<?php
wp_nav_menu( array( 
    'theme_location' => 'main-menu', 
    'menu' => 'main-menu',
    'container' => 'div',
    'container_class' => 'main_menu' ) );
?>
</div>

<div class="single-content">

    <div class="side-bar">
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div id="secondary" class="side-bar-widget" role="complementary">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="product-container">

    <?php
    $images = get_post_meta(get_the_ID(), 'product-images', true);

    if(is_array($images)) {
    ?>
    <div class="image-viewer">
        <div class="magnified" style="background-image:url(<?= wp_get_attachment_image_src( $images[0], 'full')[0] ?>)"></div>
        <div class="thumbnail-container">
            <div class="thumbnail-interface thumbnail-interface-left fa fa-angle-left"></div>
            <div class="thumbnail-pics" style="width: <?= count($images) * 150 ?>px">
            <?php
                foreach ($images as $index => $imageId) {
                    $image = wp_get_attachment_image( $imageId, 'thumbnail') ;
                    echo $image;
                }
            ?>
            </div>
            <div class="thumbnail-interface thumbnail-interface-right fa fa-angle-right"></div>
        </div>
    </div>
        <div class="product-description">
        <?php
        };

        if ( have_posts() ) {
            while ( have_posts() ) {
                echo "<div class=\"product-price\">";
                echo get_post_meta(get_the_ID(), 'product-price', true);
                echo "</div>";

                echo "<h1 class=\"product-name\">";
                the_title();
                echo "</h1>";
        
                the_post(); ?>
        
                <?php the_content(); ?>
        
            <?php }
        }
        ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
