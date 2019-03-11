<?php

// DB SETTINGS
define('DB_HOST', 'localhost');
define('DB_NAME', 'phpSlider');
define('DB_USER', 'root');
define('DB_PASS', '');

require_once(ROOT . "libs/rb-mysql.php");
R::setup( 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER , DB_PASS );
// R::freeze( TRUE );

?>