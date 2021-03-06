<?php
$v->layout("banner/view/_theme", ["title" => "Publicações"]); ?>


    <?php if (! empty($banners)):
        $v->insert("elements/bannerHeader", ['banners' => $banners]);
    endif; ?>

    <main role="main" class="container">
        <div class="row text-center">
            <?= $pager->renderHeader(); ?>

            <?php if (! empty($publications)):
                foreach ($publications as $publication) {
                    $v->insert("elements/publicationCard", ['publication' => $publication]);
                }
            endif; ?>
        </div>
    </main>
