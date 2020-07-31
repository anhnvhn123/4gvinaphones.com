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

// ** MySQL settings ** //
/** The name of the database for WordPress */
//define( 'DB_NAME', 'dangky3g4gcom' );
//
///** MySQL database username */
//define( 'DB_USER', 'root' );
//
///** MySQL database password */
//define( 'DB_PASSWORD', '123456aA' );
//
///** MySQL hostname */
//define( 'DB_HOST', '10.1.31.52' );
//
///** Database Charset to use in creating database tables. */
//define( 'DB_CHARSET', 'utf8' );
//
///** The Database Collate type. Don't change this if in doubt. */
//define( 'DB_COLLATE', '' );

define( 'DB_NAME', '4gvinaphonescom' );

/** MySQL database username */
define( 'DB_USER', '4gvina' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456aA' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|J-cu. >6X?a+fRwB<pcwv7;No}VC`Jj*Lx*/y6U>Bbc+W+*+jf!3K:Z)VGG4w <');
define('SECURE_AUTH_KEY',  'gInex(ypzuxM+@Q1t5/f)%5u^YEu-pyl-z j28[Q.+[O+Q],NVzHD=x{<V>@JBB(');
define('LOGGED_IN_KEY',    'D)4.R~FCo<1=#5=sivY*.V0ZfD_3#>^AYKQ<<x|,2FU`B$W^t]I8YOm:eI`q;XaP');
define('NONCE_KEY',        'Od%n}8Y[rJJ}48<5YGHd$Cq9AMW=hZc>|fTb7Yv}ce0szE6_J7sZ|1^zlrQ&!$SX');
define('AUTH_SALT',        ' upvm<|@5P#cE=yK=i4AQ(|g>Qw%][yV{*187*y-]V9*`=h~U+>nHV/j-O>-sJ(9');
define('SECURE_AUTH_SALT', '{(.y%puwt5/|aoes,&j.ho13)tx5ty,J%f;]]?V27R EQ*>V}1u~x|B0aqQlb[;=');
define('LOGGED_IN_SALT',   '7qMr_--_Bz2jK/i|)+E-ER~4-}-.vEGp7bBn%NNwBWZWbJbF^R/(?4Nf1Q:s@SY ');
define('NONCE_SALT',       'cnqbbzI4<?,UvX-avu!YpiI~x$[U~Am>yS87dNuvPknM +.rX2.^ uZ]yMGKbo)%');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define('FS_METHOD', 'direct');
define('FS_CHMOD_DIR', 0775);
define('FS_CHMOD_FILE', 0664);
define('WP_AUTO_UPDATE_CORE', false);

define('WP_CACHE', true);

/** WordPress Custom Config. **/
define('ZWP_BRAND_KEY', 'zvn');
define('WP_DEBUG', False);
define('ZWP_REGION_NAME', 'han1');



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
