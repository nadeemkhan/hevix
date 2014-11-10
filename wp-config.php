<?php
/**
 * The base configurations of the WordPress.2
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'texpos_toropanov');

/** MySQL database username */
define('DB_USER', 'texpos_umain');

/** MySQL database password */
define('DB_PASSWORD', '[CVGDgD@[Z6z');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'W%&uwtt|yy(Y>$a^L$ObHLx)1|C&Tr3hn6.>kq|uqRw`.bP!ts0cfGc[Tde_B>aN');
define('SECURE_AUTH_KEY',  'Z3Y=M%DFw:->9Hj$ bt_T.$z-J|f3pDH.Qsb]__I+60w+lIUfkTUw5mC[XZULdvC');
define('LOGGED_IN_KEY',    ')a!2p4%;RWExO}3Reu@e$<Y&cpSj;h FsM#?t&^<HOb{7@Q4t7cXH_PnDwkA-{+}');
define('NONCE_KEY',        '[tLm-^9KMy]|j;9P &+0Y*PO9?uz!Kg-[V u~a^6?zz]MX-ijbe p9+m2m6iT|~6');
define('AUTH_SALT',        '%-Qru_M-g`+WR!k-vrAR-*e3$T&mx*X/})/v}l$Z~h)uqRRjm]..vtJXoO-WIQq^');
define('SECURE_AUTH_SALT', 'lzNm=iDjmB?1N?xc]Cqp!t|5[jVEL!_TX^QaI~2=_z>~KT[]<Fh:*{ax[*B!aA|(');
define('LOGGED_IN_SALT',   '-w(@HQO=+w|*Fh@4P|10roC(YYHaD-o)G-W-V,pcl7^rsSrghJBe:q^C6se0YCrn');
define('NONCE_SALT',       '26:a61-,2$6;nr3{|<D|kJ&}5dl]0UcZ2q5-B1|1hKTu|fCawUz<nJqQ_WqX>n$$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
