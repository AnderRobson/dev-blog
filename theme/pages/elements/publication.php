<?php

$endPublication = count($publications);

foreach($publications as $position => $publication): ?>
    <div class="jumbotron" style="background-image: url(<?= urlFile('publication/' .  $publication->image); ?>); background-size: 100%; height: 600px; object-fit: cover;">
        <div class="container">
            <?php
                if (($position % 2) == 0):
                ?>
                <div class="row featurette mb-5">
                    <div class="col-md-7 my-5" style="background-color: rgba(255,255,255,0.6)">
                        <h2 class="featurette-heading"><?= $publication->title; ?></h2>
                        <p class="lead"><?= substr($publication->description, 0, 300); ?></p>
                        <p><a class="btn btn-lg btn-danger" href="<?= url($publication->slug); ?>" role="button">Saiba mais ...</a></p>
                    </div>
                    <div class="col-md-5 my-5">
                        <img src="<?= urlFile('publication/' .  $publication->image); ?>" alt="<?= $publication->title; ?>" width="500" height="500">
                    </div>
                </div>
            <?php else: ?>
                <div class="row featurette mb-5">
                    <div class="col-md-5 my-5" style="padding-left: unset;">
                        <img src="<?= urlFile('publication/' .  $publication->image); ?>" alt="<?= $publication->title; ?>" width="500" height="500">
                    </div>
                    <div class="col-md-7 my-5" style="background-color: rgba(255,255,255,0.6); padding-right: 5px;">
                        <h2 class="featurette-heading"><?= $publication->title; ?></h2>
                        <p class="lead"><?= substr($publication->description, 0, 300); ?></p>
                        <p><a class="btn btn-lg btn-danger" href="<?= url($publication->slug); ?>" role="button">Saiba mais ...</a></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach;
