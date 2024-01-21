<?php

namespace App\controllers;

use App\App;
use App\DB\FileBase;
use App\Message;
use App\Error;

class AccountsController
{
    public function showAll($request)
    {
        $accounts = (new FileBase('accounts'))->showAll();
        $sort = $request['sort'] ?? null;

        if ($sort == 'name a-z') {
            usort($accounts, fn ($a, $b) => $a->name <=> $b->name);
        }
        if ($sort == 'name z-a') {
            usort($accounts, fn ($a, $b) => $b->name <=> $a->name);
        }
        if ($sort == 'last name a-z') {
            usort($accounts, fn ($a, $b) => $a->lastName <=> $b->lastName);
        }
        if ($sort == 'last name z-a') {
            usort($accounts, fn ($a, $b) => $b->lastName <=> $a->lastName);
        }
        if ($sort == 'balance 0-9') {
            usort($accounts, fn ($a, $b) => $a->balance <=> $b->balance);
        }
        if ($sort == 'balance 9-0') {
            usort($accounts, fn ($a, $b) => $b->balance <=> $a->balance);
        }

        return (new App())->view('bank/accounts', [
            'accounts' => $accounts,
            "title" => 'All Accounts'
        ]);
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
            Message::get()->set('danger', "Not enough money in bank account");
        } else if ($data['amount'] <= 0) {
            Message::get()->set('danger', "You can't withdraw 0 or negative amounts");
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
            return App::view('404', [
                "title" => 404
            ]);
        }

        return (new App())->view('bank/addFunds', [
            "title" => "Add",
            "account" => $account
        ]);
    }

    public function addFunds($url, $data)
    {
        $account = (new FileBase('accounts'))->show($url);
        if ($data['amount'] <= 0) {
            Message::get()->set('danger', "You can't add 0 or negative amounts");
        } else {

            $newAmount = (float) $account->balance + (float) $data['amount'];
            $account->balance = round($newAmount, 2);
            (new FileBase('accounts'))->update($url, $account);

            Message::get()->set('success', $data['amount'] . " eur added to account");
        }
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

        $errors = [];

        if (!$personalCodeOk) {
            $errors[] = 'Please check your personal code number. It\'s already registered in our system.';
        }
        if (!validPersonalCode($_POST['personalNumber'])) {
            $errors[] = 'Personal code is not correct';
        }
        if (strlen($data['name']) <= 3) {
            $errors[] = 'Name is too short. Minimum 3 symbols required.';
        }
        if (strlen($data['lastName']) <= 3) {
            $errors[] = 'Last name is too short. Minimum 3 symbols required.';
        }

        if ($errors) {
            Error::set($errors);
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
