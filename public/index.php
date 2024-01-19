<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

use App\App;
use App\Message;

require '../vendor/autoload.php';

define('ROOT', __DIR__ . '/../');
define('URL', 'http://localhost/php-bank-v2/public');

echo App::run();
Message::get();
