<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/php-bank-v2/public/">UniBanca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://localhost/php-bank-v2/public/accounts">Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/php-bank-v2/public/createAccount">Create new Account</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if ($auth) : ?>
                    <div class="me-3">Hello, <?= $auth ?></div>
                    <form action="<?= URL ?>/logout" method="post">
                        <button class="btn btn-outline-danger" type=" submit">
                            Logout
                        </button>
                    </form>
                <?php else : ?>
                    <a href="<?= URL ?>/login" class="btn btn-outline-primary">Login</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>
<?php require ROOT . 'views/parts/message.php' ?>