<?php
// ROOT of the project (filesystem path)
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/software-monitoring');
// BASE URL of the project (web path)
define('BASE_URL', '/software-monitoring');




// PHP paths (for require/include)
define('PAGES_PATH', BASE_URL . '/pages');
define('API_PATH', BASE_URL . '/api');
define('ASSETS_PATH', BASE_URL . '/src/assets');
define("GLOBAL_SRC", BASE_URL . '/src');
define('VIEWS_PAGES_PATH', ROOT_PATH . '/views');


//VIEWS paths (for HTML)
define('VIEWS_COMPONENTS_PATH', ROOT_PATH . '/views/components');
