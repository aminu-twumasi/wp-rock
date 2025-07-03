<?php

/**
 * The template for displaying the header
 */

// Declare global variables
global $themeGlobals;

$domain = $_SERVER['HTTP_HOST'];
$environment_map = array(
	'local'				=> '.lndo',
	'develop'			=> '.dev',
	'staging'			=> '.staging',
	'maint'				=> '.cmr'
);
if (strpos($domain, $environment_map['local']) !== false) {
	$environment = 'local';
} elseif (strpos($domain, $environment_map['develop']) !== false) {
	$environment = 'develop';
} elseif (strpos($domain, $environment_map['staging']) !== false) {
	$environment = 'staging';
} elseif (strpos($domain, $environment_map['maint']) !== false) {
	$environment = 'maint';
} else {
	$environment = 'prod';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="format-detection" content="telephone=yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php bloginfo(); ?> - <?php the_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="statuscake" />


	<!-- add additional scripts and stylesheets to my_add_theme_scripts() in functions.php -->
	<?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-environment="<?php echo $environment; ?>">

	<!-- HEADER START -->
	<header class="zoo-header">
		<div class="zoo-header__container">
			<!-- Site Icon/Logo (left) -->
			<a href="<?php echo home_url(); ?>" class="zoo-header__logo" aria-label="Homepage">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/dist/logo.jpg" alt="Greenwood Zoo Logo" />
			</a>

			<!-- Zoo Name (center) -->
			<div class="zoo-header__title">Greenwood Zoo</div>

			<!-- Search Icon (right, before burger) -->
			<button class="zoo-header__search-btn" aria-label="Search">
				<span class="icon-search">&#128269;</span>
			</button>

			<!-- Burger Menu Icon (right) -->
			<button class="zoo-header__burger" aria-label="Open menu" aria-expanded="false">
				<span class="icon-burger">&#9776;</span>
			</button>
		</div>

		<!-- Dropdown Navigation Menu (hidden by default) -->
		<nav class="zoo-header__nav" aria-label="Main menu">
			<?php
				wp_nav_menu([
					'theme_location' => 'main-menu',
					'menu_class' => 'zoo-header__menu',
					'container' => false
				]);
			?>
		</nav>

		<!-- Pop-out Search Field (hidden by default) -->
		<div class="zoo-header__search-popout">
			<?php get_search_form(); ?>
		</div>
	</header>
	<!-- END HEADER -->

	<!-- START MAIN -->
	<main id="main" class="main" aria-label="Primary page content">
