<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hrms-help' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'arpi10682595' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8tEm]![A9}a%]CA!>U_&mpBBotL;R`-2NI*R@xEspPW74<>_s@7CAg(~32FPPOJ~' );
define( 'SECURE_AUTH_KEY',  'g071_vWls`fJ(%UB@uh#A3t}T-A=[Zo2XNF.~vGc(eAFRgOT(A{V1J$h7T(x+~`W' );
define( 'LOGGED_IN_KEY',    'y~}^e /+H4F4@ *nYzZwqYa@u`kG@$A_/gnfTN2c^>U@+sU^*vM+a+Rr$G0qbu1#' );
define( 'NONCE_KEY',        ',>-ZIRy8tALx],|tXNl)dG?TV4Lh6g.Y`+|J.I7z%DICE!E:fK_|ilI .0iJ_=C#' );
define( 'AUTH_SALT',        'f.YnuC^mZp=(_+wq?(}[g<6dM~(QBT_B3Mtyk#.eL^;lrtuPei8plVDKb={_h(Rn' );
define( 'SECURE_AUTH_SALT', ';hL #@A?4]FBz28EP_r~~=sR8#c]xYdu 2x%YLv7%/~IvLwIQ`CjaSs9i,qNTfV-' );
define( 'LOGGED_IN_SALT',   '^b>47dYW{/;hhUkHZ}_eI3*tmq4H#n]9Fq0$v]f.2_~zqQiz~lby-`{ RMFHl(ls' );
define( 'NONCE_SALT',       ':u;*j.@u,rooE4wXmMQfhaP+<SZe?_Eep.]`D8Xp8b*_yxBBu6,cwFT+KCH}tKZ~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

