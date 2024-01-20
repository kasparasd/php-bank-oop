<?php if ($msg) : ?>
    <div class="container mt-5" data-remove-after="5" data-removable>
        <div class="row">
            <div class="col-12 justify-content-center">
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                    <?= $msg['text'] ?>
                </div>

            </div>
        </div>
    </div>
<?php endif ?>