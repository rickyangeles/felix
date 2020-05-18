<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Felix
 */

?>

	</div><!-- #content -->
<?php
	$pID = get_the_ID();
	$footerLogo = get_field('footer_logo', 'options');
	$footerCTA = get_field('override_footer_cta', $pID) ? get_field('override_footer_cta', $pID) : get_field('footer_cta', 'options');
	$disableFooter = get_field('hide_footer', $pID);

?>
	<?php if ( !$disableFooter ) : ?>
		<?php if ( is_active_sidebar('footer_menu') ) : ?>
		<div class="container-fluid footer-menu">
			<div class="row">
				<div class="col">
					<?php dynamic_sidebar('footer_menu'); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<footer id="footer" class="site-footer">
			<div class="container">
				<div class="row">
					<!-- Left Footer -->
					<div class="col-md-3 footer-left">
						<?php if ( $footerLogo ) : ?>
							<a href="<?php bloginfo('url') ?>"><img src="<?php echo $footerLogo['url']; ?>" class="footer-logo"></a>
						<?php endif; ?>
						<?php if ( is_active_sidebar('footer_left') ) : ?>
							<?php dynamic_sidebar('footer_left'); ?>
						<?php endif; ?>
					</div>
					<!-- Center Footer -->
					<div class="col-md-6 footer-center">
						<?php if ( is_active_sidebar('footer_center') ) : ?>
							<?php dynamic_sidebar('footer_center'); ?>
						<?php endif; ?>
					</div>
					<!-- Right Footer-->
					<div class="col-md-3 footer-right">
						<?php if ( $footerCTA ) : ?>
							<a href="<?php echo $footerCTA['url']; ?>" class="footer-cta btn btn-primary btn-lg"><?php echo $footerCTA['title']; ?></a>
						<?php endif; ?>
						<?php if ( is_active_sidebar('footer_right') ) : ?>
							<?php dynamic_sidebar('footer_right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'felix' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'felix' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'felix' ), 'felix', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	<?php endif; ?>
</div><!-- #page -->



<?php wp_footer(); ?>



<?php if (is_user_logged_in()) : ?>
	<?php
		$obj_id = get_queried_object_id();
		$current_url = get_permalink( $obj_id );
		$browser = new Browser();
		$b_info = $browser->getBrowser() . '(' . $browser->getVersion() . ')';
		//$one_week = date('M d, Y', strtotime("+1 week"));
	?>
	<!-- Modal content -->
	<div class="modal fade bd-example-modal-md issue-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<iframe class="clickup-embed clickup-dynamic-height" src="https://forms.clickup.com/f/235jg-1645/X52Z4FO1MKB18JYTZZ?Browser=<?php echo $b_info; ?>&Page%20URL=<?php echo $current_url; ?>" frameborder="0" onmousewheel="" width="550px" height="100%" style="background: transparent;"></iframe>
				<script async src="https://app-cdn.clickup.com/assets/js/forms-embed/v1.js"></script>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php
	$facebook = get_field('facebook_url', 'options') ? '"<a class=\'fab fa-facebook-f\' href=\'' . get_field('facebook_url', 'options') . '\'></a>"' : '';
	$twitter = get_field('twitter_url', 'options') ? '"<a class=\'fab fa-twitter\' href=\'' . get_field('twitter_url', 'options') . '\'></a>"' : '';
	$instagram = get_field('instagram_url', 'options') ? '"<a class=\'fab fa-instagram\' href=\'' . get_field('instagram_url', 'options') . '\'></a>"' : '';
	$linkedin = get_field('linkedin_url', 'options') ? '"<a class=\'fab fa-linkedin-in\' href=\'' . get_field('linkedin_url', 'options') . '\'></a>"' : '';
	$pinterest = get_field('pinterest_url', 'options') ? '"<a class=\'fab fa-pinterest-p\' href=\'' . get_field('pinterest_url', 'options') . '\'></a>"' : '';
	$youtube = get_field('youtube_url', 'options') ? '"<a class=\'fab fa-youtube\' href=\'' . get_field('youtube_url', 'options') . '\'></a>"' : '';
	$tripadvisor = get_field('tripadvisor_url', 'options') ? '"<a class=\'fab fa-tripadvisor\' href=\'' . get_field('tripadvisor_url', 'options') . '\'></a>"' : '';
	$yelp = get_field('yelp_url', 'options') ? '"<a class=\'fab fa-yelp\' href=\'' . get_field('yelp_url', 'options') . '\'></a>"' : '';
?>

<?php
	$mobileCTAs = '';
	if ( have_rows('mobile_menu_cta', 'options') ) {
		while ( have_rows('mobile_menu_cta', 'options') ) : the_row();
			$cta = get_sub_field('cta');
			$ctaLink = $cta['url'];
			$ctaText = $cta['title'];
			$buttonColor = get_sub_field('button_color');
			$mobileCTAs .= '"<a class=\'mm-cta ' . $buttonColor . '\' href=\'' . $ctaLink . '\'>' . $ctaText . '</a>",';
		endwhile;
	}
	//echo $mobileCTAs;
?>
<script>
	if ($("#mmenu").length) {
		// init mmenu
		$("#mmenu").mmenu({
			// options

			"extensions": ["position-top", "fullscreen"],
			"slidingSubmenus": true,
			"navbars": [
                  {
                     "position": "top",
                     "content": [
                        "close"
                     ]
                  },
				  {
  					"position": "bottom",
  					"content": [
  						<?php echo $mobileCTAs; ?>
  					]
  				},
                  {
                     "position": "bottom",
					 "content": [
 						<?php echo $facebook; ?>,
 						<?php echo $twitter; ?>,
 						<?php echo $instagram; ?>,
 						<?php echo $linkedin; ?>,
 						<?php echo $pinterest; ?>,
 						<?php echo $youtube; ?>,
 						<?php echo $tripadvisor; ?>,
 						<?php echo $yelp; ?>
 					]
				},
               ]
			}, {
			// configuration
			clone: true
		});
	}
</script>
</body>
</html>
