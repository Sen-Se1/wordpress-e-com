<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ecom_wp' );

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
define( 'AUTH_KEY',         '^C?DEaPFv5<L0ejY_t7P?#L9gQUt$CRdfE3,)!s]5Q0[#My:K;gwK;J[xOd.RS)M' );
define( 'SECURE_AUTH_KEY',  ',IMdD,nkR?az$9]FUWZ6qr)kq=>nI8)}7D#aUWW8+msu44ah 9}_H3qQ54&&s,Lc' );
define( 'LOGGED_IN_KEY',    'GRvxZquDCo6+w^MZNfie2b`lb C-)p#O]4jLTd*P-hV@>cJq7M{USX`+]hi69;B(' );
define( 'NONCE_KEY',        '.}HRC2P7YRND|jLJHY6Z}V~>@Rkc8#C+sibTbp=6CgJY,)YjtkluE38IJE{#@wmB' );
define( 'AUTH_SALT',        '>kgI^B_hpo#VX@J-#o;GQd&jTSW:$Uqi@[j(L+ATAj/$;7Sr=YrLLV?{Y[jZ|{jV' );
define( 'SECURE_AUTH_SALT', '7bgV4ob , ?#U|e*EAM5`SL5 6$cl~N e~Dn.)Gv(~Wo9wvj!u-X&)0i7Z:&7+xT' );
define( 'LOGGED_IN_SALT',   'wa&^J8vn>1hc4}xW`6Muw^W}c9i}a#XA:)vOJ6j+Bg>9G*z,tb7cB+nB+A!yULxh' );
define( 'NONCE_SALT',       '/g`5rEPJ=ok$RY,^wW#v#>t>Bq0C,fN3G+>AF/nzYMNy6j<//(N&}0Z#~nqh&?_U' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
