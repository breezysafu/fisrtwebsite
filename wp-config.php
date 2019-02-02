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
define('DB_NAME', '1website');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'rusakhatun');

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
define('AUTH_KEY',         '2.aF}2I4j)V5Od]SL1YqLJBNz:Bu*{/Pty}z[QefrB5BPJ>_M&|?^r(dK|56vPG~');
define('SECURE_AUTH_KEY',  '7z=N]+ x{/gaOt{2<5k8aCtwf))oF mD,wVA~]=u!&^1ScQ(&hKsEHNCKL[A:(M{');
define('LOGGED_IN_KEY',    '7M?BK}ITn0zC.*B<3&gI ;#eQ1HuV{57R|!Ehr(rr+D_UNW ~0d5aiuFF(]7d5>9');
define('NONCE_KEY',        '8:cY/NC:KPKW)E`ZCqbY5#*&iVs?>mw7)>^.}I7XOV[26_@O/7)lFi&u,<J)l1jk');
define('AUTH_SALT',        '<W;880GE.-*L~WL?Ci!Cs(`s 9cZJNG-BU!`.ar_2]0~YW)*NhV ~y=Hp087ayX.');
define('SECURE_AUTH_SALT', '/uC{Z[&)x3SXs96I-1<cj-_xJBbs`u0fl^xi]DX1d9N [nc,w__VHX|JHr#,$a3t');
define('LOGGED_IN_SALT',   '3pWw!$T3xn7ppQu]x5R3^q@{26vHmW4[nMk`k6>-Hl5;b5mNMgv&Kw};VTNs@k{x');
define('NONCE_SALT',       'k0PTh/XC:{$&jUk!#f?0{db_#;8.cr3zRLVx~XL/%>N>1k/!!S|vf^cvcu=P|nr/');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
