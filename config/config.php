<?php
/**
 * Main configuration file
 */

// Site configuration
$siteConfig = [
    'site_name'        => 'Game Database',
    'site_description' => 'Your comprehensive resource for weapons, armor, monsters, and locations in your favorite games.',
    'site_url'         => 'http://localhost/web4',
    'admin_email'      => 'admin@example.com',
    'debug_mode'       => true,  // Set to false in production
    'timezone'         => 'America/Chicago',
    'version'          => '1.0.0',
];

// Set timezone
date_default_timezone_set($siteConfig['timezone']);

// Error reporting based on debug mode
if ($siteConfig['debug_mode']) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Define common paths
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH . '/config');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PAGES_PATH', ROOT_PATH . '/pages');
define('IMAGES_PATH', ROOT_PATH . '/images');
define('CSS_PATH', ROOT_PATH . '/css');
define('JS_PATH', ROOT_PATH . '/js');
define('API_PATH', ROOT_PATH . '/api');
