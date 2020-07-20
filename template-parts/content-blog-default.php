<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Felix
 */

?>

<?php
	$hideAuthor 	= get_field('hide_author', 'options');
	$hideDate 		= get_field('hide_date', 'options');
	$hideCat		= get_field('hide_categories', 'options');
	$hideRelated 	= get_field('hide_related_posts', 'options')
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="row">
			<div class="entry-thumbnail col-md-3">
				<?php the_post_thumbnail('thumbnail'); ?>
			</div>
			<div class="entry-post-content col-md-9">
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( 'post' === get_post_type() ) :
						?>
						<?php if ( !$hideAuthor || !$hideDate || !$hideCat) : ?>
							<div class="entry-meta">
								<?php if ( !$hideDate ) : felix_posted_on(); endif; ?>
								<?php if ( !$hideAuthor ) : felix_posted_by(); endif; ?>
								<?php if ( !$hideCat ) : felix_entry_footer(); endif; ?>
							</div><!-- .entry-meta -->
						<?php endif; ?>

					<?php endif; ?>
				</header>
				<?php echo excerpt(20, false, get_the_ID()); ?>
			</div>
		</div>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
