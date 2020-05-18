<?php
/*
    Template Name: Left Sidebar
*/
    get_header();

    //Vars
    $pID = get_the_ID();
    $pTitle = get_the_title($pID);
    $headerType = get_field('header_type');
?>
<?php if ( $headerType !== 'simple') : ?>
    <div class="container-fluid page-header <?php echo $headerType; ?>">
        <div class="container">
            <h1><?php echo $pTitle; ?></h1>
        </div>
    </div>
<?php endif; ?>

<div id="primary" class="content-area container">
    <div class="row">
        <?php get_sidebar(); ?>
        <main id="main" class="site-main col-md-8">
            <?php if ( $headerType === 'simple') : ?>
                <h1 class="page-title"><?php echo $pTitle; ?></h1>
            <?php endif; ?>
        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; // End of the loop. ?>
        </main><!-- #main -->
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>
