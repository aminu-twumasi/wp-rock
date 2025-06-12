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
	<header role="banner" aria-label="Global header navigation">
		<nav><?php wp_nav_menu(['theme_location' => 'main-menu']); ?></nav>
		<?php echo get_search_form(); ?>
	</header>
	<!-- END HEADER -->

	<!-- START MAIN -->
	<main id="main" class="main" aria-label="Primary page content">
