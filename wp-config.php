<?php

/** Enable W3 Total Cache */

define('WP_CACHE', false); // Added by W3 Total Cache



/**

 * The base configurations of the WordPress.

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


define('DB_NAME', 'elumi_technologies');
/** MySQL database username */

define('DB_USER', 'root');

/** MySQL database password */

define('DB_PASSWORD', 'eluminous@2018');


/** MySQL hostname */

define('DB_HOST', 'localhost');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');

define('DISABLE_WP_CRON', 'true');

/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */
define('FS_METHOD','direct');

define('AUTH_KEY',         'UYeTDlF}Q}reBOksgkHbT]rx?9$Re*KDzMtw<d?+vmw`cy2)zLrei~VcPiwM6@#M');

define('SECURE_AUTH_KEY',  'IOP6/VRQrh-Axr;0=4zvS)h-Hr{8E^e3a0)q+`!N?8ucw6=8:mLr&00eN){ {M&l');

define('LOGGED_IN_KEY',    'YO~fmC5?bm_V W?)3YT7 9}Omx{Wiz/`U[~m{(mq2$@&;STds?GkO9L@&04)N?c<');

define('NONCE_KEY',        'VO2y_~minZ$^]$LE[? l%c8(&Xyj5dRj}.ND&&k=Va5:oJA!&z{xu_1a=_okMtjs');

define('AUTH_SALT',        '/ n]k<X]<^:0troMx|PkJA8RvfxSdc+SOQ5e sI( h.0_!>=TK4_Y&w(,]pl!Ma{');

define('SECURE_AUTH_SALT', 'cj~k30Irv%0`:!fV_ATv+v:DYBXH.Uy{<+l_iR;Z1>t.u%[PI$YxfIbp}B.3N$}l');

define('LOGGED_IN_SALT',   'Cy~!1SEtba8@-LctR0=1AyQ9TJH)q;>3|g&v`K_psn&JM([W3QrbnH1JR(S5*1Ai');

define('NONCE_SALT',       '}0r%$7RHQ*EEj#G7D5`se&)0Y`OG,Okh]u4%n:F!Mp*~;cTWG9o{?q9D>ajE,Kt8');



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
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors',0);


/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

//Disable File Edits
define('DISALLOW_FILE_EDIT', true);

//echo "version: ".get_bloginfo( 'version' );
