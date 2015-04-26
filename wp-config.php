<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'arla_cms');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost:8888');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '|}K57Pt*f@+11FznM<UkEX|2~ehA-Nd=S%fW?Y*0Lk+)HQH7r$(>f_c,t3Z.`jm`'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '_AMEITTkWf-9+3M^{3w%`epV;Qyw.Heye4ZMp3@$P/lQ_n1N!Ld6U(!$op* A-+i'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '_v3@.2apuK$AezDYMA-q{4(,CrFJ{^iT}30st%ck~hToqbw>twk`N;Y+On~H5!1)'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'D<*>5;{ngd+}#2?+:>t8<3!v><+1M_57)jXXjnpJI-9_-T5@pLi}Yey9mN`}.r9^'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', '$|Ro>z0`|-<!7*|e<_vUNh;?nhmyTg<8YsX-?9K zu1Ar2ttQ3ie<[s@fw/KgU:_'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'xibr&`!;nm[{x6XvsHL/h;A0]I1af<x0EGzJiw.Y`X_S>+}u.vs^Z>1O,1^p=?DS'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'JgPz*yL8/<Df{n,uoMa2;YK{ot2~`+@(oI;&se5m)BkxzbUiMGB>Dc-o6K)tWa/,'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '4bQI:|XrsOs%hPzp_M+@r8x wT!p+9i!Yeg lxq,lnJl!Aw4mF7am=Pt[WA4E%$Y'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

