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
	$footer_copyright_text = get_field('footer_copyright_text', 'options');

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
					<!-- Footer One -->
					<div class="col-md footer-one">
						<?php if ( $footerLogo ) : ?>
							<a href="<?php bloginfo('url') ?>"><img src="<?php echo $footerLogo['url']; ?>" class="footer-logo"></a>
						<?php endif; ?>
						<?php if ( is_active_sidebar('footer_one') ) : ?>
							<?php dynamic_sidebar('footer_one'); ?>
						<?php endif; ?>
					</div>
					<!-- Footer Two -->
					<div class="col-md footer-two">
						<?php if ( is_active_sidebar('footer_two') ) : ?>
							<?php dynamic_sidebar('footer_two'); ?>
						<?php endif; ?>
					</div>
					<!-- Footer Three -->
					<div class="col-md footer-three">
						<?php if ( is_active_sidebar('footer_three') ) : ?>
							<?php dynamic_sidebar('footer_three'); ?>
						<?php endif; ?>
					</div>
					<!-- Footer Four -->
					<div class="col-md footer-four">
						<?php if ( $footerCTA ) : ?>
							<a href="<?php echo $footerCTA['url']; ?>" class="footer-cta btn btn-primary btn-lg"><?php echo $footerCTA['title']; ?></a>
						<?php endif; ?>
						<?php if ( is_active_sidebar('footer_four') ) : ?>
							<?php dynamic_sidebar('footer_four'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->
		<div class="site-info">
			<div>
				<span>Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>, All Rights Reserved
					<?php if ( $footer_copyright_text ) : ?>
						<?php echo $footer_copyright_text; ?>
					<?php endif; ?>
				</span>
			</div>
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
	$disableHeaderCTA 	= get_field('disable_header_cta', $pID);
	$cta			  	= get_field('header_cta_override') ? get_field('header_cta_override') : get_field('header_cta', 'options');
	if ( $cta ) {
		$ctaLink			= $cta['url'];
		$ctaText			= $cta['title'];
	}

	if ( !$disableHeaderCTA ) {
		$mobileCTA = '"<a class=\'mm-cta secondary button\' href=\'' . $ctaLink . '\'>' . $ctaText . '</a>",';
	}
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
				  <?php if ( !$disableHeaderCTA ) : ?>
					  {
	  					"position": "bottom",
	  					"content": [
	  						<?php echo $mobileCTA; ?>
	  					]
					},
				  <?php endif; ?>
               ]
			}, {
			// configuration
			clone: true
		});
	}
</script>
</body>
</html>
