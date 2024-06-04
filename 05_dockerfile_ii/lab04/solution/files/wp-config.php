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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

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
define( 'AUTH_KEY',         '$:raF9~uIwt5V+;6BOy6D.v~s^&J`_w!0 AYYd2Q3Wz&zW5JY A<G^w?9MkBBa,A' );
define( 'SECURE_AUTH_KEY',  'D|lnv5y[RhE&O^P$)?Qb#@kqD/w|3!zE$KXOjN|i+N&OUp>0kCC$xBP8LF{8%XIa' );
define( 'LOGGED_IN_KEY',    'VT{f/^V9_V;RoMXp<0HUB`V/0E;u,KkX>sx~l_9$s@t`8T?z,P(qKSs#Wqkku7q?' );
define( 'NONCE_KEY',        'INE!$ay<T_{%xhTl]HQ}MFw}=DS3%Q`[[6FS_pwzhNO#Bj=U8IktGw3oy|A,L+2<' );
define( 'AUTH_SALT',        'RV-px6/y23HAG?uhO7@@iET4)fq@8{IS,HMPZhw?9=kL+?+KZ!$*wb0~SPvee<dJ' );
define( 'SECURE_AUTH_SALT', '8fOgt=?3rO[ag^L?hhwI~%z&u:o;I/AG[22!H^VgiV`qO$N_-?{CR-ni.TJz~~L9' );
define( 'LOGGED_IN_SALT',   'vY)N|d4]gUJ?o;/.,d:f`r8fu![;8c> )B3Ag5#Mnimr|y wJXmL(gJM)hj}O*$`' );
define( 'NONCE_SALT',       't%l8LBg-;1$^+,p00!1`pUc&}CX,E~YE?,6G<w^2qikpQ27=`-Ol9uEzbBZ1BcK8' );

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
