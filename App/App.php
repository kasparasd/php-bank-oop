<?php

namespace App;

use App\controllers\AccountsController;
use App\controllers\HomeController;
use App\Message;

class App
{
    public static function run()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        array_splice($url, 0, 3);
        return self::router($url);
    }

    private static function router($url)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 1 && $url[0] == '') {
            return (new HomeController)->index();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 1 && $url[0] != '' && $url[0] == 'accounts') {
            return (new AccountsController)->showAll();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 2 && $url[0] == 'deductFunds') {
            return (new AccountsController)->deductFundsView($url[1]);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' & count($url) == 2 && $url[0] == 'deductFunds') {
            return (new AccountsController)->deductFunds($url[1], $_POST);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 2 && $url[0] == 'addFunds') {
            return (new AccountsController)->addFundsView($url[1]);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' & count($url) == 2 && $url[0] == 'addFunds') {
            return (new AccountsController)->addFunds($url[1], $_POST);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 1 && $url[0] == 'createAccount') {
            return (new AccountsController)->create();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' & count($url) == 1 && $url[0] == 'storeAccount') {
            return (new AccountsController)->store($_POST);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 2 && $url[0] == 'delete') {
            return (new AccountsController)->deleteView($url[1]);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' & count($url) == 2 && $url[0] == 'delete') {
            return (new AccountsController)->delete($url[1]);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' & count($url) == 1 && $url[0] == 'no-account') {
           return self::view("noAccount",[]);
        }

        return '<h1>404</h1>';
    }

    public static function view($view, $data)
    {
        extract($data);
        $msg = Message::get()->show();
        ob_start();
        require ROOT . "/views/top.php";
        require ROOT . "/views/$view.php";
        require ROOT . "/views/bottom.php";
        $content = ob_get_clean();
        return $content;
    }

    public static function redirect($url)
    {
        header("Location: " . URL . '/' . $url);
        return null;
    }
}
