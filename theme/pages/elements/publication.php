<?php

$endPublication = count($publications);

foreach($publications as $position => $publication):
    if (($position % 2) == 0):
        ?>
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading"><?= $publication->title; ?></h2>
                <p class="lead"><?= substr($publication->description, 0, 300); ?></p>
                <p><a class="btn btn-lg btn-primary" href="<?= url($publication->slug); ?>" role="button">Saiba mais ...</a></p>
            </div>
            <div class="col-md-5">
                <img src="<?= urlFile('publication/' .  $publication->image); ?>" alt="<?= $publication->title; ?>" width="500" height="500">
            </div>
        </div>
    <?php else: ?>
        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading"><?= $publication->title; ?></h2>
                <p class="lead"><?= substr($publication->description, 0, 300); ?></p>
                <p><a class="btn btn-lg btn-primary" href="<?= url($publication->slug); ?>" role="button">Saiba mais ...</a></p>
            </div>
            <div class="col-md-5 order-md-1">
                <img src="<?= urlFile('publication/' .  $publication->image); ?>" alt="<?= $publication->title; ?>" width="500" height="500">
            </div>
        </div>
    <?php endif;
    if ($position != ($endPublication - 1)):
        ?>
        <hr class="featurette-divider">
    <?php
    endif;
endforeach;