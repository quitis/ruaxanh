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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '@KtZMNXqDwW0M[jFecy728)91i)yP=35f@G$ L0+~bfk|mbc2+Uwip_Jl.cfcj C');
define('SECURE_AUTH_KEY',  'h Q@n8}ppDakbzszX23p{ro?[eFB +uqV K|y?)`x=%sKWU27D^{uvAq5g}LFK-F');
define('LOGGED_IN_KEY',    'm **}jcfV_[MgakJEj xV1j<u$qx}(~F089`(zCMZ|O ar0z&L+=oP`_Wj#n?RE?');
define('NONCE_KEY',        'xk[?8epbJM:dUn&`,.$c,3>lo8_^39 Y9HCo<0*8as#boifHP7TLK8NMC-M;geJD');
define('AUTH_SALT',        '3ZWkj]=>d~Es5AW_RAw-vIXX&0YNXxNg)d1|HJ)jsBJ*l_J3zeVTRo$C87ckVjjb');
define('SECURE_AUTH_SALT', '9*?8.yKV)4;Jjt$t}L[aWkc_Hgq:@:Q88,3$Gs2@A0z?B/Q]H?3q5TO_ffLYv&SQ');
define('LOGGED_IN_SALT',   '{G}=JH;^-jMMeJrBIJc3~3@EoAPE*Mx8x]1?II bop5;difIU&r|;ab:ZoQ(W@8d');
define('NONCE_SALT',       '+R3vH~pL,~7$<c$#SBp`nUGt.*QNP)dt=C)x,CxitUoZ&jM;0fwVm&}tccbj=}4W');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
