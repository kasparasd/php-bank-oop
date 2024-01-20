<?php
if ($err) : ?>
    <ul>
        <?php foreach ($err as $errorMsg) : ?>
            <li style="color: red;"><?= $errorMsg ?></li>
        <?php endforeach ?>
    </ul>
<?php unset($err);
endif ?>