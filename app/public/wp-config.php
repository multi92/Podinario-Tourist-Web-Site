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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\Users\DELL\Local Sites\podinario\app\public\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define('AUTH_KEY',         'IJEvL3kXs1340sSgIrDUbx56XwEKx/r/Y3QDi6YXpBELsAW89BQSH3XNwcbFt0qzFO+q0JGZrOvoTn+0Irw8tg==');
define('SECURE_AUTH_KEY',  '18ei0Blh78tJtvOTbZFh92i0KfvMYx5fl/RmP4FJJRKKqGr0fA9oqY/F0jBJ9GFtPX6z+dwByYQdux9TwMifyQ==');
define('LOGGED_IN_KEY',    '+hsqZe6q3fm3UfbbO7oGXXNIxP556yP+BO3Zy9WhJ6nJyBcKN5H8j+v1BhQtNOUw/eoWPj4Z5y6hDWomhAgeDA==');
define('NONCE_KEY',        'Wfj+EM2OUWyFO5jGoBASil9jcfBa5YztU/9Sx1OdbE0Pz1cYJpf9xjt3razkzu/6aAUqsRgdNOXk7xTyFgbJ2w==');
define('AUTH_SALT',        '7tEcr3cyM0P1mufnhigQ4TQygxEixSxNYKCUA/VNB2ZQs8Jpu5wMs5UMT76LYth//9LjeyulwwflaSjvN96KEw==');
define('SECURE_AUTH_SALT', '9McJ0G/C/XwilOBPIy0GV55zMzs/1tjNEqbF7mUjLT0ogIe404DSWtzc6N+GKOu2Mbyj6LdvzULwDvTZAOlRuA==');
define('LOGGED_IN_SALT',   '4MYAwdp1dw/pv/7UVnL88ATyfuTsQzhwCwcVPBtnn4LzxZ0IDpf92OEXeEkZ2xhggeKvAWHbopqO0vDO4fDANQ==');
define('NONCE_SALT',       'X7wDsaCdLV2TUIiImEKpJEtocnzZaH5kY8BeE0C/7xh4/35fY2lmvhLMiOMSV1mjcr/jCun8W51jVtMosQYXhA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
