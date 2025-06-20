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
define( 'DB_NAME', 'rrblogs' );

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
define( 'AUTH_KEY',         '=7{B_s[jk;ujKa(mcr 4uA}%u$lwNq#j_:.#ZcB@G/ROJCgRRKf-?:w;Ay:~V$[F' );
define( 'SECURE_AUTH_KEY',  'G0C}n|*38ob[aD/oNxtf,kp7o<p-~~2+:,*%u(D~epIF%3m2<c0}/oba1 T5KZp9' );
define( 'LOGGED_IN_KEY',    '9sc>lck1rkpIt/I}K e/@6}5SAB?x-%j*:; j1ncsMT?1pneH2XOMY}R9Cs<Y[qR' );
define( 'NONCE_KEY',        'X2Zzb,G[>#b.A]X=#eXC<SpyP8Lv|7km:UwVI&5vh_4/|<)@DBOiP]q50apI;EFZ' );
define( 'AUTH_SALT',        'iJW52poWr_$O,8XO;*FV6{>V>5yv<355>7};YnAF,~w[1{W*e};I~-Q3~Stz^afZ' );
define( 'SECURE_AUTH_SALT', 'y-fJ4}@Ogk^Dfr4DRFq7nJayoVI88(`qu.;x(kF5`BPc,aXB8GMO>B[PMJfr)>,+' );
define( 'LOGGED_IN_SALT',   'AnQTV_h|1-;b?ZU wW&T6Hu:FpSx~q7 V~CVW^3I4=#yQ%pCJqI=qBN>]}Yn&ol@' );
define( 'NONCE_SALT',       'QrUdHF_`}Z0}]+5g8P&.$V<E%W~=BDe`_{XIMRjikY&ZfD`T,!>#s*GgF+}U7$hj' );

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
