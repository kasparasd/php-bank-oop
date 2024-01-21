<?php require ROOT . 'views/nav.php' ?>

<?php if (isset($_SESSION['accountCreated'])) : ?>
    <div class="col-6 infoAlert" style="margin: auto;">
        <div style="background-color: rgb(0,255,0,0.6);" class="alert alert-dismissible">
        <button class="btn btn-lg" style="float: right; margin: 0; padding: 0; color: crimson;" id="closeBtn">&times;</button>
            <span>

                <h2>New Account created</h2>
                <h4>
                    Name: <b><?= $_SESSION['newAccount']['name']; ?> </b>
                    Last Name: <b><?= $_SESSION['newAccount']['lastName']; ?> </b>
                </h4>
                <h4>
                    Account number: <b><?= $_SESSION['newAccount']['accountNumber']; ?> </b>
                </h4>
            </span>

        </div>
    </div>
<?php endif ?>

<div class="col-6" style="margin: auto;  padding: 2rem; border-radius: 15px; border: 1px solid black;">
    <h2 class="mb-4">Create new bank account</h2>
    <form action="http://localhost/php-bank-v2/public/storeAccount" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" value="">
        </div>
        <div class="form-group">
            <label for="lastName">Last name</label>
            <input class="form-control" type="text" name="lastName" value="">
        </div>

        <div class="form-group">
            <label for="personalNumber">Personal code number</label>
            <input class="form-control" type="text" name="personalNumber" value="">
        </div>
        <div class="form-group">
            <label for="bankAccountNumber">Bank account number</label>
            <input class="form-control" readonly type="text" name="bankAccountNumber" value="<?= $data['accountNumber'] ?>">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>

    <?php require ROOT . 'views/parts/formErrors.php'; ?>

</div>
</body>

</html>
<?php unset($_SESSION['accountCreated']);
unset($_SESSION['newAccount']);
