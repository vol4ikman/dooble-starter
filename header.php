<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	<!-- dns prefetch -->
	<link href="//www.google-analytics.com" rel="dns-prefetch" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
		
<div class="off-canvas-wrapper">

    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

	<div class="off-canvas position-<?php echo FLOAT;?>" id="offCanvas<?php echo FLOAT;?>" data-off-canvas data-position="<?php echo FLOAT;?>">
		<div class="mobile_menu_wrapper">
			<?php //mobile_menu(); ?>
		</div>
	</div>
	<div class="off-canvas-content" data-off-canvas-content>		
	
		<!-- wrapper -->
		<div class="wrapper">
	
			<!-- header -->
			<header class="header clear" role="banner">
				
					<!-- logo -->
					<div class="logo">
						<a href="<?php echo home_url(); ?>" role="logo">
						</a>
					</div>
					<!-- /logo -->
					
					<!-- nav -->
					<nav class="nav" role="navigation">
						
					</nav>
					<!-- /nav -->
			
			</header>
			<!-- /header -->
