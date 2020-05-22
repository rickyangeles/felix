<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Felix
 */

get_header();
?>
	<?php $img = get_the_post_thumbnail_url('page-header') ? get_the_post_thumbnail_url('page-header') : get_field('page_header_image', 'options'); ?>
	<div class="container-fluid blog-single-header d-flex justify-content-center align-items-center" style="background-image:url('<?php the_post_thumbnail_url('slider_image'); ?>');">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
					<div class="entry-meta">
						<?php
						felix_posted_on();
						felix_posted_by();
						?>
					</div><!-- .entry-meta -->
				</div>
			</div>
		</div>
	</div>
	<div id="primary" class="content-area container">
		<div class="row">
		<?php if ( !get_field('hide_sidebar') ) : ?>
			<main id="main" class="site-main col-md-8">
		<?php else : ?>
			<main id="main" class="site-main col">
		<?php endif; ?>
				<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						the_post_navigation( array(
							'prev_text'		=> __( '<strong>Previus Post</strong><br><span>%title</span>' ),
							'next_text'		=> __( '<strong>Next Post</strong><br><span>%title</span>' )
						) );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				?>
			</main><!-- #main -->
			<?php if ( !get_field('hide_sidebar') ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
