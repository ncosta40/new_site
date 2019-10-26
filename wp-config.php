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
define( 'DB_NAME', 'ncostac_site' );

/** MySQL database username */
define( 'DB_USER', 'ncostac_site' );

/** MySQL database password */
define( 'DB_PASSWORD', '3sF0z2cwygEd' );

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
define( 'AUTH_KEY',         'tbpvl9bap6ftgwncehb3pqiu2oqfzhpvdlzdiv5w6ee17zy7vo3ptplpcf6vyxw6' );
define( 'SECURE_AUTH_KEY',  '3eowodzlhhgxkbyk53bh9pp552ckkgkzx49nkhneanbbhuscbcg7s3toq6srfpdm' );
define( 'LOGGED_IN_KEY',    'scpwtrjz6bnrqolpumqhcwdjmxsh4nz38spvwhxvxibj3zo81ujr6hpsoeifyiuo' );
define( 'NONCE_KEY',        '5p7dsmuywd5txdphmstouofedsqbrefrkxrtgyesunvuw8j0obcjm5ajtc6gi7xw' );
define( 'AUTH_SALT',        'bwnsihu3wxps9nytd1r5mhehtilrce8wyaehyzgjaigjnljah8gi5djcskbttllk' );
define( 'SECURE_AUTH_SALT', 'kmougqiou2flenvwokuxisdao8frlu6ryoki5e2qm5px6u064j6s6gm6bhdxppur' );
define( 'LOGGED_IN_SALT',   'dcqpadilc6zmjtmshpkpqcqkzgtrodghggsfrybo7ghbsceo2wswa5bicci8o9vi' );
define( 'NONCE_SALT',       'yme4tbkidj5wyvr6gf6fi70rwcrpnkjrqjgne8ze7tstizh85sxnt6tepbabgbhr' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpop_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
