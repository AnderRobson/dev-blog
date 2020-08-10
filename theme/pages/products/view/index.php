<?php
$v->layout("products/view/_theme", ["title" => "Produtos"]); ?>


    <?php if (! empty($banners)):
        $v->insert("elements/bannerHeader", ['banners' => $banners]);
    endif; ?>

    <main role="main" class="container">
        <div class="row text-center">
            <?= $pager->renderHeader(); ?>

            <?php if (! empty($products)):
                foreach ($products as $position => $product) {
                    $v->insert("elements/productCard",
                        [
                            'product' => $product,
                            'position' => $position,
                            'productImages' => $product->getImages()
                        ]
                    );
                }
            endif; ?>
        </div>
    </main>
<?php
    $v->start('css');
        echo css("carousel");
    $v->end();
