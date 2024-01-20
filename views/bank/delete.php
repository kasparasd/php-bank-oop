<?php require ROOT . 'views/nav.php' ?>

  <style>
        .delete {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .delete-container {
            width: 400px;
            height: 200px;
            border-radius: 10px;
            border: 2px solid crimson;
            color: crimson;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .delete-container div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            gap: 10px;
        }
    </style>
    <div class="delete">
        <div class="delete-container">
            <h2>Are you sure?</h2>
            <div>
                <form action="<?= URL ?>/delete/<?= $data['id'] ?>" method="post">
                    <button type="submit" class="btn btn-primary">Yes</button>
                </form>
                <a href="<?= URL ?>/accounts" type="submit" class="btn btn-secondary">No</a>

            </div>
        </div>
    </div>
    </body>

    </html>