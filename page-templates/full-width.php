<?php
/*
    Template Name: Full Width
*/
    get_header();

    //Vars
    $pID = get_the_ID();
    $pTitle = get_the_title($pID);
    $headerType = get_field('header_type');
?>
<?php get_page_header($pID); ?>

<div id="primary" class="content-area container">
    <main id="main" class="site-main">
    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; // End of the loop. ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
