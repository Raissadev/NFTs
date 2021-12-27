<?php

session_start();

require './vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');

define('BASE_URL','http://localhost:8000');
define('BASE_PATH','http://localhost:8000/public');
define('BASE_STORAGE','http://localhost:8000/storage');
define('BASE_STORAGE_USERS','http://localhost:8000/storage/users');
define('BASE_STORAGE_IMAGES','http://localhost:8000/storage/images');
define('BASE_STORAGE_NFTS' ,'http://localhost:8000/storage/nfts');
define('BASE_STORAGE_SHOPS' ,'http://localhost:8000/storage/shops');
//Dashboard
define('BASE_DASHBOARD' ,'http://localhost:3000/dashboard');


?>