<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Felix
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Get Fields -->
<?php
	$fixed 					= get_field('fixed_header', 'options') ? ' fixed-top' : '';
	$search 				= get_field('search_icon', 'options');
	$iconLocation 			= get_field('header_icon_location', 'options');
	$searchLocation 		= get_field('header_search_location', 'options');
	$ctaLocation 			= get_field('header_cta_location', 'options');
	$topMenu				= get_field('disable_top_menu', 'options');
	$topMenuLocation 		= get_field('top_menu_location', 'options');
	$socialHeader 			= get_field('social_header', 'options');
	$socialHeaderLocation 	= get_field('social_header_location', 'options');
	$pID 					= get_the_ID();
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'felix' ); ?></a>
	<header id="masthead" class="site-header<?php echo $fixed; ?>">
		<?php if ( !$topMenu ) : ?>
			<?php if ( ($topMenuLocation === 'own' || $socialHeaderLocation === 'own')) : ?>
				<div class="container-fluid top-nav d-lg-block">
					<div class="container d-flex align-items-end flex-column">
						<div class="col-md-12">
							<?php if ( $topMenuLocation === 'own') : ?>
								<?php if ( has_nav_menu('top-menu') ) : ?>
									<?php wp_nav_menu( array('theme_location' => 'top-menu') ); ?>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ( $socialHeaderLocation === 'own') : ?>
								<div class="ml-auto header-social d-md-block">
									<?php echo header_social(); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<nav class="navbar navbar-expand-lg">
			<div class="container">
				<a class="navbar-brand logo" href="<?php echo get_option("siteurl"); ?>">
					<img src="<?php echo header_logo(); ?>" alt="<?php echo get_site_url(); ?>">
				</a>
				<a href="#mmenu" class="mmenu-trigger"><i class="fal fa-bars"></i></a>
				<nav id="mmenu" class="mmenu mobile-menu">
					<?php wp_nav_menu( array('theme_location'  => 'mobile-menu' )); ?>
					<?php //wp_nav_menu( array('theme_location'  => 'main-nav', 'menu'  => 'main-nav' )); ?>
				</nav>
				<?php if ( !get_field('hide_header_menu', $pID) ): ?>
					<div class="d-flex align-items-end flex-column social-nav-wrap">
						<?php if ( $socialHeaderLocation === 'menu' || $topMenuLocation === 'menu') : ?>
							<div class="social-top-nav">
								<?php if ( $socialHeaderLocation === 'menu') : ?>
									<div class="ml-auto header-social d-md-block">
										<?php echo header_social(); ?>
									</div>
								<?php endif; ?>
								<?php if ( $topMenuLocation === 'menu' ) : ?>
									<?php wp_nav_menu( array('theme_location' => 'top-menu') ); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="main-nav">
							<?php
						        wp_nav_menu( array(
									'theme_location' => 'main-menu',
									'menu_id'        => 'main-menu',
						            'depth'             => 2,
						            'container'         => 'div',
						            'container_class'   => 'collapse navbar-collapse justify-content-end',
						            'container_id'      => 'navbarSupportedContent',
						            'menu_class'        => 'nav navbar-nav',
						            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						            'walker'            => new WP_Bootstrap_Navwalker(),
						        ) );
					        ?>
						</div>
					</div>
				<?php else : ?>
					<ul id="main-menu" class="nav navbar-nav">
						<?php echo get_header_cta(); ?>
					</ul>
				<?php endif; ?>
			</div>
		</nav>
	</header><!-- #masthead -->
	<?php if ( get_field('fixed_header', 'options') ) : ?>
		<div class="header-space"></div>
	<?php endif; ?>
	<!-- page title -->
	<div id="content" class="site-content container-fluid">
