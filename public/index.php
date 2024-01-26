<?php

use App\App;
use App\Auth;
use App\Message;
use App\Error;

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

define('DB', 'file');
// maria/file

require '../vendor/autoload.php';

define('ROOT', __DIR__ . '/../');
define('URL', 'http://localhost/php-bank-v2/public');

Auth::get();
Message::get();
Error::get();

echo App::run();
