<?php require ROOT . 'views/nav.php' ?>
<div style="width: 90%; margin: auto;">

    <form action="<?= URL ?>/accounts" method="get">
        <select name="sort" onchange="this.form.submit()">
            <option value="" selected hidden disabled>
                <?php
                if (isset($_GET['sort'])) {
                    echo $_GET['sort'];
                } else {
                    echo 'Choose here';
                } ?>
            </option>
            <option value="name a-z">name a-z</option>
            <option value="name z-a">name z-a</option>
            <option value="last name a-z">last name a-z</option>
            <option value="last name z-a">last name z-a</option>
            <option value="balance 0-9">balance 0-9</option>
            <option value="balance 9-0">balance 9-0</option>
        </select>
    </form>

    <table class="table">

        <thead>
            <tr>
                <th scope=" col">Name</th>
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
            $accounts = $data['accounts'];
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