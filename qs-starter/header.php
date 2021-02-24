<?php
/**
 * Site header
 *
 * @package WordPress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>
		<?php wp_title( '' ); ?>
		<?php
		if ( wp_title( '', false ) ) {
				echo ' :';
		}
		?>
		<?php bloginfo( 'name' ); ?>
	</title>
	<!-- dns prefetch -->
	<link href="//www.google-analytics.com" rel="dns-prefetch" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php /* MANIFEST - https://developer.mozilla.org/en-US/docs/Web/Manifest */ ?>
	<link rel="manifest" href="<?php echo esc_url( THEME ); ?>/manifest.json">
	<?php /* Please create favicon files with http://iconogen.com/ */ ?>
	<link rel="shortcut icon" href="<?php echo esc_url( THEME ); ?>/images/favicon/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( THEME ); ?>/images/favicon/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo esc_url( THEME ); ?>/images/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="<?php echo esc_url( THEME ); ?>/images/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo esc_url( THEME ); ?>/images/favicon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo esc_url( THEME ); ?>/images/favicon/android-chrome-192x192.png" sizes="192x192">
	<meta name="msapplication-square70x70logo" content="<?php echo esc_url( THEME ); ?>/images/favicon/smalltile.png" />
	<meta name="msapplication-square150x150logo" content="<?php echo esc_url( THEME ); ?>/images/favicon/mediumtile.png" />
	<meta name="msapplication-wide310x150logo" content="<?php echo esc_url( THEME ); ?>/images/favicon/widetile.png" />
	<meta name="msapplication-square310x310logo" content="<?php echo esc_url( THEME ); ?>/images/favicon/largetile.png" />

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="off-canvas-wrapper">

	<div class="off-canvas position-<?php echo FLOAT; ?>" id="offCanvas<?php echo FLOAT; ?>" data-off-canvas>
		<!-- Your menu or Off-canvas content goes here -->
		<div class="mobile_menu_wrapper">
			<?php // mobile_menu(); ?>
		</div>
	</div>

	<div class="off-canvas-content" data-off-canvas-content>

		<!-- wrapper -->
		<div class="site-wrapper">

			<!-- header -->
			<header class="header clear" role="banner">

					<button type="button" class="button" data-toggle="offCanvas<?php echo FLOAT; ?>">Open Menu</button>

					<!-- logo -->
					<div class="logo">
						<a href="<?php echo esc_url( home_url() ); ?>" role="logo">
						</a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<nav class="nav" role="navigation">

					</nav>
					<!-- /nav -->

			</header>
			<!-- /header -->
