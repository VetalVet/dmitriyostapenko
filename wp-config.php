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
define( 'DB_NAME', 'dmitriyostap' );

/** Database username */
define( 'DB_USER', 'dmitriyostap' );

/** Database password */
define( 'DB_PASSWORD', 'HqMuAqGITJ45U131' );

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
define( 'AUTH_KEY',         '_,,h!#|P!z9zo[{y?K=w#3K:s9lDYW~HpQnw`EgO5,4)4x>V&wS5~%2&qn*Q><,B' );
define( 'SECURE_AUTH_KEY',  '#{9OH:vAo07[t5r{Z$;$@Ct4!$tKy}?s555c;^B8@U%6jQOgR.-?:7l[9JkfGLM<' );
define( 'LOGGED_IN_KEY',    'I1@~|@<qH`YYIG7P7t&})ANxIlo&a$Ul7J.8|cN1lqqJ7}5jx*<x1/P:zU(/3B4g' );
define( 'NONCE_KEY',        '2CyFQ,FrEOGnNz:I_:SG_V6y2H&FHT6v@`7e~SRSR&*m=2TNfCFK#<1>gSE_F0;7' );
define( 'AUTH_SALT',        '#$+?cn&kTr##Iir.H8_2*A%KTOD-YN)GOp-ArR_f}vH?#Ed,~zJe:RLNd=8u>0:y' );
define( 'SECURE_AUTH_SALT', 'Ven]Va}%l.yzdQ8.%AWaR/y/L%s;qjhRi~b{_cElWuHwzXdC%!^`[ARp2OW}hZ$[' );
define( 'LOGGED_IN_SALT',   'MUC@~|6>0_d3DKJypelOUG6{* Wp7XGE|(J-b.f{IG  Q&tYl_<QYh:XeJfT459f' );
define( 'NONCE_SALT',       'FQ.b{qjcd%P&4)>JBxn9l ^nrO1?.tNYd6|9.*fD/JZu_<wo%8$U 50l?DEKE8QD' );

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
