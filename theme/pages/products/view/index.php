<?php
$v->layout("products/view/_theme", ["title" => "Produtos"]); ?>


    <?php if (! empty($banners)):
        $v->insert("elements/bannerHeader", ['banners' => $banners]);
    endif; ?>

    <main role="main" class="container">
        <div class="row text-center">
            <?= $pager->renderHeader(); ?>

            <?php if (! empty($products)):
                foreach ($products as $product) {
                    $v->insert("elements/productCard", ['product' => $product]);
                }
            endif; ?>
        </div>
    </main>
