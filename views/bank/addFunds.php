<?php require ROOT . 'views/nav.php' ?>

<a style="color: navy; text-decoration: none; margin-left: 70px; display:inline-block" href="<?= URL ?>/accounts">

    <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
        <span>Back to all accounts</span>
    </div>
</a>

<div class="col-7" style="margin: auto;  padding: 2rem; border-radius: 15px; border: 1px solid black;">
    <h2 class="mb-4" style="color: darkgreen;"><b>ADD FUNDS</b></h2>
    <h4>Bank account number: <b> <?= $account->accountNumber ?> </b></h4>
    <h5>Owner: <b> <?= $account->name . ' ' . $account->lastName ?> </b> Current balance:<b> € <?= $account->balance ?></b> </h5>
    <hr class="mb-5">
    <form action="http://localhost/php-bank-v2/public/addFunds/<?= $account->id ?>" method="post">
        <div class="form-group mt-3">
            <label for="amount">Add Funds to account: <b><?= $account->accountNumber ?></b></label>
            <input style="border-color: grey;" class="form-control funds-input" type="number" step="0.01" name="amount">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Add funds</button>
        <!-- <?php if ($_SESSION['error']) : ?>
                    <ul class="mt-2">
                        <li style="color: red;">
                            <?= $_SESSION['error'] ?>
                        </li>
                    </ul>
                <?php endif;
                unset($_SESSION['error']) ?>
                <?php if ($_SESSION['success']) : ?>
                    <ul class="mt-2">
                        <li style="color: green;">
                            <?= $_SESSION['success'] ?>
                        </li>
                    </ul>
                <?php endif;
                unset($_SESSION['success']) ?> -->
    </form>
</div>
</body>
</body>

</html>