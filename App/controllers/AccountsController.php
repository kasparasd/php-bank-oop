<?php

namespace App\controllers;

use App\App;
use App\DB\FileBase;
use App\Message;

class AccountsController
{
    public function showAll()
    {
        $accounts = (new FileBase('accounts'))->showAll();
        return (new App())->view('bank/accounts', $accounts);
    }
    public function deductFundsView($url)
    {
        $account = (new FileBase('accounts'))->show($url);
        if (count((array) $account) == 0) {
            return App::redirect('no-account');
        }

        return (new App())->view('bank/deductFunds', [
            "title" => "Withdraw",
            "account" => $account
        ]);
    }
    public function deductFunds($url, $data)
    {
        $account = (new FileBase('accounts'))->show($url);

        if ($account->balance < $data['amount']) {
            // ERROR MESSAGE
            print_r('not enough money');
        } else {
            $amountAfterWithdraw = (float) $account->balance - (float) $data['amount'];
            $account->balance = round($amountAfterWithdraw, 2);
            (new FileBase('accounts'))->update($url, $account);
            Message::get()->set('success', $data['amount'] . " eur withdrawed");
        }

        return App::redirect('deductFunds/' . $url);
    }

    public function addFundsView($url)
    {
        $account = (new FileBase('accounts'))->show($url);
        if (count((array) $account) == 0) {
            return App::redirect('no-account');
        }

        return (new App())->view('bank/addFunds', [
            "title" => "Add",
            "account" => $account
        ]);
    }

    public function addFunds($url, $data)
    {
        $account = (new FileBase('accounts'))->show($url);

        $newAmount = (float) $account->balance + (float) $data['amount'];
        $account->balance = round($newAmount, 2);
        (new FileBase('accounts'))->update($url, $account);

        Message::get()->set('success', $data['amount'] . " eur added to account");
        return App::redirect('addFunds/' . $url);
    }

    public function create()
    {

        $accounts = (new FileBase('accounts'))->showAll();

        function generateAccountNumber($accounts)
        {
            $newBankAccountNumber = ['L', 'T'];
            $formatBankAccountNumber = '';

            for ($i = 0; $i < 18; $i++) {
                $newBankAccountNumber[] = rand(0, 9);
            }
            unset($i);

            for ($i = 0; $i < count($newBankAccountNumber); $i++) {
                if ($i % 4 === 0 && $i !== 0) {
                    $formatBankAccountNumber = $formatBankAccountNumber . ' ';
                }
                $formatBankAccountNumber = $formatBankAccountNumber . $newBankAccountNumber[$i];
            }
            unset($i);

            if (array_search($formatBankAccountNumber, array_column($accounts, 'accountNumber'))) {
                return generateAccountNumber($accounts);
            } else {
                return $formatBankAccountNumber;
            }
        }

        $accountNumber = generateAccountNumber($accounts);

        return (new App())->view('bank/create', [
            "title" => "New Account",
            "accountNumber" => $accountNumber
        ]);
    }


    public function store($data)
    {
        $accounts = (new FileBase('accounts'))->showAll();

        function validPersonalCode($code): bool
        {
            // Tikriname, ar ivestas kodas yra skaiciai ir turi teisingą ilgi
            if (!is_numeric($code) || strlen($code) != 11) {
                return false;
            }

            // Isskiriame gimimo metus, menesi, diena
            $metai = substr($code, 1, 2);
            $menuo = substr($code, 3, 2);
            $diena = substr($code, 5, 2);
            // Tikriname gimimo datos validuma
            if (!checkdate($menuo, $diena, $metai)) {
                return false;
            }

            $suma = 0;
            for ($i = 0; $i < 10; $i++) {
                if ($i < 9) {
                    $suma += (int)$code[$i] * ((int)$i + 1);
                } else {
                    $suma += (int)$code[$i] * 1;
                }
            }
            // Tikriname paskutini skaiciu (kontrolini)
            $kontrolinisSk = substr($code, -1);
            // 33908118566
            // Skaičiuojame kontrolini skaiciu
            $liekana = $suma % 11;
            // Jei liekana lygi 10, tai paskutinis kontrolinis skaicius turi buti 0,
            // Jei liekana nelygi 10, tai liekana ir yra paskutinis kontrolinis skaicius

            $liekana = ($liekana == 10) ? 0 : $liekana;

            // Patikriname, ar kontrolinis skaicius atitinka liekana
            if ($liekana != $kontrolinisSk) {
                return false;
            }

            return true;
        }

        $personalCodeOk = 1;
        for ($i = 0; $i < count($accounts); $i++) {
            if ($accounts[$i]->personalCodeNumber == $data['personalNumber']) {
                $personalCodeOk = 0;
            }
        }

        if (!$personalCodeOk) {
            $_SESSION['error'][] = 'Please check your personal code number. It\'s already registered in our system.';
        }
        if (!validPersonalCode($_POST['personalNumber'])) {
            $_SESSION['error'][] = 'Personal code is not correct';
        }
        if (strlen($data['name']) <= 3) {
            $_SESSION['error'][] = 'Name is too short. Minimum 3 symbols required.';
        }
        if (strlen($data['lastName']) <= 3) {
            $_SESSION['error'][] = 'Last name is too short. Minimum 3 symbols required.';
        }

        if ($_SESSION['error']) {
            header('Location:' . URL . '/createAccount');
            exit();
        }

        $newAcc = [
            'balance' => 0,
            'lastName' => $data['lastName'],
            'name' => $data['name'],
            'accountNumber' => $data['bankAccountNumber'],
            'personalCodeNumber' => $data['personalNumber']
        ];
        (new FileBase('accounts'))->create((object)$newAcc);
        $_SESSION['accountCreated'] = 1;
        $_SESSION['newAccount'] = $newAcc;

        return App::redirect('createAccount');
    }

    public function deleteView($id)
    {
        return App::view('bank/delete', [
            'title' => 'Delete account',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $account = (new FileBase('accounts'))->show($id);
        if ($account->balance == 0) {
            (new FileBase('accounts'))->delete($id);
            Message::get()->set('info', 'Account deleted');
            return App::redirect('accounts');
        } else {
            Message::get()->set('info', 'Account you want to delete must be empty');
            return App::redirect('accounts');
        }
    }
}
