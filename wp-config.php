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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '|0_lH?DSvKVqHWA3YZzH,+ZbHi@[zpTDECCk@@3>rte?*eKME/i>,%^wrfVlC2@I' );
define( 'SECURE_AUTH_KEY',  'SyRB>i=RLg`s$Eej}D.()Yhr-:O TdbfZ*:CcNvrps[9WJg|^JGNrWxr^9AytKV~' );
define( 'LOGGED_IN_KEY',    'tj$.*X7hA.fPjS:70[[n9wIG!Wep2(C(:Qd[cPk3M#pLfwCg[;Wt5q/V.)>1C$#h' );
define( 'NONCE_KEY',        'DMOmWyTO0gw]w>QD<m-R^W6))x7Iks>5.NJt:r_7TpX!;o{+{[hlN/k^7l(=zPLX' );
define( 'AUTH_SALT',        'xBLe{F3`z/$MpeB|#PYJ/yI[ O(vCaCV7~Waf@2`)_w,wKU6uj/_/@zT+V<ymK!Q' );
define( 'SECURE_AUTH_SALT', '*j|;6rB?9a+q#;.C?gG;}A2Pm_Zj,~@SI_p#q%n23}H.=.ei(=,T8izJnu@cOr.1' );
define( 'LOGGED_IN_SALT',   'pn#hY[JGZ #<}ulQ>$ePr`~q[D}8(i&B>zXcG|0 <wt$(z#^YJ3_)-Vm5ym0MD,H' );
define( 'NONCE_SALT',       'ygWkbD%J/b84$;|k=_~cr%A9*W%k0*Ia*)^>q^}4)5?^36)jiTVNg/Z/(h N<<@j' );

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
