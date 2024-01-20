<?php

echo "seeder started\n";

$accounts = [
    [
        'id' => '1',
        'name' => 'Johnathon',
        'lastName' => 'Mischke',
        'accountNumber' => 'LT23 3951 3426 9392 0092',
        'personalCodeNumber' => '46601019466',
        'balance' => round(1000, 2),
    ],
    [
        'id' => '2',
        'name' => 'Anthony',
        'lastName' => 'Serna',
        'accountNumber' => 'LT09 3733 2387 8039 6445',
        'personalCodeNumber' => '61608019493',
        'balance' => round(1100, 2),
    ],
    [
        'id' => '3',
        'name' => 'Erasmo',
        'lastName' => 'Pepper',
        'accountNumber' => 'LT23 3951 3426 9792 4478',
        'personalCodeNumber' => '61809039583',
        'balance' => round(25.99, 2),
    ],
    [
        'id' => '4',
        'name' => 'Diego',
        'lastName' => 'Lanz',
        'accountNumber' => 'LT33 8556 3220 7121 2756',
        'personalCodeNumber' => '36110128966',
        'balance' => round(50000, 2),
    ],
    [
        'id' => '5',
        'name' => 'Zonia',
        'lastName' => 'Block',
        'accountNumber' => 'LT48 4819 3266 9078 4956',
        'personalCodeNumber' => '46407019729',
        'balance' => round(4999.79, 2),
    ],

];

file_put_contents(__DIR__ . '/../accounts.json', json_encode($accounts));
file_put_contents(__DIR__ . '/../accounts-index.json', json_encode(count($accounts) + 1));
echo "seeder finished\n";
