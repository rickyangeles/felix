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
	<div class="container-fluid blog-single-header d-flex justify-content-center align-items-center" style="background-image:url('<?php the_field('blog_archive_banner', 'options'); ?>');">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
				<?php $meta = get_post_meta( get_the_ID(), '', true ); print_r($meta); ?>

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
