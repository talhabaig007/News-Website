<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'awam' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'y1NW|(AwI};Xc|kv^DWDhK5^[<S+APV#}kPO:|%r2f r*>*&?}[:Y;;tgeyhK86R' );
define( 'SECURE_AUTH_KEY',  '=BMj&H%  0`dRE+9H3pB5UeF<^cTdE2eegv&+1o4Nz!QeHc?5Fmf>MdC7KL!U.NG' );
define( 'LOGGED_IN_KEY',    '3BZ`^5@RMjH33K;KxlZh|@H~?bt&<gJ6aRLMp#kYH@LqzM.*Mw%hEUG%E#6@Gc-z' );
define( 'NONCE_KEY',        '#P)3<8.%,d]<ZOUl?$g0m%_9=[OGYOL!Y1R%g+ZPo<7Fe%yr(=JSEI!6dL1oOlru' );
define( 'AUTH_SALT',        'I~VKu>,6v[4>9/2QTs}$`k)n92Rwim+M-N1Ho>73l8}W2[}K *75eH ,O 94s6Su' );
define( 'SECURE_AUTH_SALT', '4X&-{Yky(;;FbCG@o_yoS2)~^*&o%G8#A72Rla8_Ze9f,amGI!M}|QY#N4:S<#[[' );
define( 'LOGGED_IN_SALT',   'VEKVZ9QYhQ%;m51j%Vs3ChyB3Ox!PS$ETgg>~qgRAOxl`-yWff);md+!U<GY4m;-' );
define( 'NONCE_SALT',       'P<<iu{PRSogU=|GcL1W9f6f$*Y+rF5z]b$#huh;Z8i7%d|Hok1xL<#cTCWdYjz0b' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
