<?php
/**
 * The main category template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Felix
 */

get_header();
?>
	<?php
		$blogLayout		= get_field('blog_layout', 'options');
		$featured_post	= get_field('featured_blog_post', 'options');
		$header_bg		= get_the_post_thumbnail_url($featured_post[0], 'page-header') ? get_the_post_thumbnail_url($featured_post[0], 'page-header') : get_field('blog_archive_banner', 'options');
	?>

	<div class="container-fluid blog-archive-header d-flex justify-content-center align-items-center" style="background-image: url('<?php the_field('blog_archive_banner', 'options'); ?>');">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1><?php echo single_term_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div id="primary" class="content-area container">
		<div class="row">
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
			<main id="main" class="site-main col-md-8 <?php echo $blogLayout . '-layout'; ?>">
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<?php
					endif;
					echo '<div class="blog-wrap">';
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content-blog-'.$blogLayout);

					endwhile;
					echo '</div>';

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div>
	</div><!-- #primary -->

<?php

get_footer();
