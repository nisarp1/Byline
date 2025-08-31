<?php
/**
 * WordPress Configuration for Cloudways Deployment
 * 
 * This file contains the configuration for your Byline WordPress site
 * deployed on Cloudways at: phpstack-1448755-5721123.cloudwaysapps.com
 */

// ** Database settings - Get these from Cloudways ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'YOUR_CLOUDWAYS_DB_NAME' );

/** Database username */
define( 'DB_USER', 'YOUR_CLOUDWAYS_DB_USER' );

/** Database password */
define( 'DB_PASSWORD', 'YOUR_CLOUDWAYS_DB_PASSWORD' );

/** Database hostname */
define( 'DB_HOST', 'YOUR_CLOUDWAYS_DB_HOST' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 * Generate these at: https://api.wordpress.org/secret-key/1.1/salt/
 */
define( 'AUTH_KEY',         'YOUR_UNIQUE_PHRASE_HERE' );
define( 'SECURE_AUTH_KEY',  'YOUR_UNIQUE_PHRASE_HERE' );
define( 'LOGGED_IN_KEY',    'YOUR_UNIQUE_PHRASE_HERE' );
define( 'NONCE_KEY',        'YOUR_UNIQUE_PHRASE_HERE' );
define( 'AUTH_SALT',        'YOUR_UNIQUE_PHRASE_HERE' );
define( 'SECURE_AUTH_SALT', 'YOUR_UNIQUE_PHRASE_HERE' );
define( 'LOGGED_IN_SALT',   'YOUR_UNIQUE_PHRASE_HERE' );
define( 'NONCE_SALT',       'YOUR_UNIQUE_PHRASE_HERE' );

/**#@-*/

/**
 * WordPress database table prefix.
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

/**
 * Site URL Configuration for Cloudways
 */
define( 'WP_HOME', 'https://phpstack-1448755-5721123.cloudwaysapps.com' );
define( 'WP_SITEURL', 'https://phpstack-1448755-5721123.cloudwaysapps.com' );

/**
 * Disable file editing in admin
 */
define( 'DISALLOW_FILE_EDIT', true );

/**
 * Increase memory limit if needed
 */
define( 'WP_MEMORY_LIMIT', '256M' );

/**
 * Auto-save interval
 */
define( 'AUTOSAVE_INTERVAL', 300 );

/**
 * Post revisions
 */
define( 'WP_POST_REVISIONS', 5 );

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
