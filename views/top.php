<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Untitled' ?></title>
    <link rel="stylesheet" href="<?= URL ?>/main.css?v=<?= time() ?>">
    <script src="<?= URL ?>/main.js?v=<?= time() ?> defer"></script>
</head>

<body>
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
                <form class="d-flex">
                    <a class="nav-link" href="http://localhost/php-bank-v2/public/">Logout</a>

                </form>
            </div>
        </div>
    </nav>
    <?php require ROOT . 'views/message.php' ?>