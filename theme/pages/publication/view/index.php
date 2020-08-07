<?php
$v->layout("banner/view/_theme", ["title" => "Publicações"]); ?>


    <?php if (! empty($banners)):
        $v->insert("elements/bannerHeader", ['banners' => $banners]);
    endif; ?>

    <main role="main" class="container">
        <div class="row text-center">
            <h1>Página <?= $pager->page(); ?> de <?= $pager->pages(); ?></h1>
            <?php if (! empty($publications)):
                foreach ($publications as $publication) {
                    $v->insert("elements/publicationCard", ['publication' => $publication]);
                }
            endif; ?>
        </div>
    </main>

    <?= $pager->render();
