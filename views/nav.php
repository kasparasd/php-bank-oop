<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid">
        <?php if ($auth) : ?>
            <a class="navbar-brand" href="<?= URL ?>/accounts">UniBanca</a>
        <?php else : ?>
            <a class="navbar-brand" href="<?= URL ?>">UniBanca</a>
        <?php endif ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($auth) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= URL ?>/accounts">Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/php-bank-v2/public/createAccount">Create new Account</a>
                    </li>
                <?php endif ?>
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