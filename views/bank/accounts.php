<?php require ROOT . 'views/nav.php' ?>
<div style="width: 90%; margin: auto;">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Personal code number</th>
                <th scope="col">Bank account number</th>
                <th scope="col">Balance</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $accounts = $data;
            usort($accounts, function ($a, $b) {
                if ($a->lastName == $b->lastName) {
                    return 0;
                } else return ($a->lastName < $b->lastName ? -1 : 1);
            });
            foreach ($accounts as $id => $account) : ?>
                <tr onMouseOver="style.borderBottom='1px solid crimson'" onMouseOut="style.borderBottom='1px solid rgb(222, 226, 230)'">
                    <td><?= $account->name ?></td>
                    <td><?= $account->lastName ?></td>
                    <td><?= $account->personalCodeNumber ?></td>
                    <td><?= $account->accountNumber ?></td>
                    <td><?= '€ ' . $account->balance ?></td>
                    <td><a href="<?= URL ?>/addFunds/<?= $account->id ?>" class="btn btn-success btn-sm"> Add funds </a></td>
                    <td><a href="<?= URL ?>/deductFunds/<?= $account->id ?>" class="btn btn-warning btn-sm"> Withdraw funds </a></td>
                    <td><a href="<?= URL ?>/delete/<?= $account->id ?>" class="btn btn-danger btn-sm"> Delete </a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>