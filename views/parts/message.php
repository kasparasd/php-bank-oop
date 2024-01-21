<?php if ($msg) : ?>
    <div class="container mt-5 infoAlert" data-remove-after="5" data-removable>
        <div class="row">
            <div class="col-12 justify-content-center">
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                    <button class="btn btn-lg" style="float: right; margin: 0; padding: 0; color: crimson;" id="closeBtn">&times;</button>
                    <?= $msg['text'] ?>
                </div>

            </div>
        </div>
    </div>
<?php endif ?>