<?php

// Configuration common to all environments
include_once __DIR__ . '/wp-config.common.php';

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
define( 'DB_NAME', 'workup' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'p@6Lq.gBp.8#++rc3Jt}Pb@Ow%*WN9z0&rLv^.>@,4=-7BH;wT+O_lG/w4a(tH]{' );
define( 'SECURE_AUTH_KEY',  '[)&j$B{~:O?;yH[{Om6QP>bWdD|Kb_$UGfHx]8#e#&P@h7/XsvNIv6Og<$-l2!ma' );
define( 'LOGGED_IN_KEY',    '+WG=dmF/I=i$&u.@TZ0<=c>9tIhghN`MnX84q4~9A)t++R3=h@/S1A9( c1.theR' );
define( 'NONCE_KEY',        'J 2B Yk2j$46e8*ON,8hgdj#*qm*RSiSfA%0q,;gP9Vu&sTV0dDPVJLRRj&A)J*W' );
define( 'AUTH_SALT',        'O!e 68z.B@O#:?!SbJ*S]J3:FiAX3SMw9!rgr!28h;n=W)kLl i07x3r9ps&U{u<' );
define( 'SECURE_AUTH_SALT', 'Q@2daXde1.E+iN=`*c9XW.u{+k^608Y[_j 3G0mzXn47auCmLen+Glf]Q=/n+LD;' );
define( 'LOGGED_IN_SALT',   'w]W gxN{`.{&3^L8ws8&WYY l5?9BX.-_q%^M%lU+uz0._e{c-PUi4jXH2pDT&W~' );
define( 'NONCE_SALT',       'Gdi`PAZ%mZ! Vowi$ v1s(ISP#|ppDn|+yRxp  LzWY{mK-=} QU&l:@X!mM$, ;' );

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
