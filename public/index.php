<?php

use App\App;
use App\Auth;
use App\Message;
use App\Error;

session_start();

// maria/file
define('DB', 'file');
// define('DB', 'maria');

require '../vendor/autoload.php';

define('ROOT', __DIR__ . '/../');
define('URL', 'http://localhost/php-bank-oop/public');

Auth::get();
Message::get();
Error::get();

echo App::run();
