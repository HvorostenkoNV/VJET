<?
define("SITE_PATH",   realpath($_SERVER["DOCUMENT_ROOT"]));
define("REQUEST_URL", explode("?", str_replace("index.php", "", $_SERVER["REQUEST_URI"]))[0]);

define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_HOST", "localhost");
define("DB_NAME", "v_jet");