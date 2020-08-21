<?php
$v->layout("home/view/_theme", ["title" => "Home"]); ?>

    <?php if (! empty($banners)):
        $v->insert("elements/banner", ['banners' => $banners]);
    endif; ?>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

<div class="marketing">
    <div class="container">
    <div class="row">
        <div class="col-12 text-center my-5">
            <h1 class="display-3">Seja bem vindo</h1>
            <p>Seja bem vindo ao site dev, espero que você goste</p>
        </div>
    </div>
    </div>

    <!-- Three columns of text below the carousel -->
    <?php foreach($bannersProducts as $key => $banner): ?>
<!--            <img src="" alt="" class="img-fluid d-block" style="object-fit: cover">-->
            <div class="jumbotron" style="background-image: url(<?= urlFile('banner/' . $banner->image); ?>); background-size: 100%; height: 750px; object-fit: cover;">
                <div class="container">
                    <div class="row text-center">

                        <?php
                        $productsBanner = $banner->getProducts();

                        if (! empty($productsBanner)):
                            foreach ($productsBanner as $position => $product) {
                                $v->insert("elements/productCard",
                                    [
                                        'product' => $product->product,
                                        'position' => $position,
                                        'productImages' => $product->product->getImages()
                                    ]
                                );
                            }
                        endif; ?>
                    </div>
                </div>
            </div>

    <?php endforeach; ?>


    <?php if (! empty($publications)):
            $v->insert("elements/publication", ['publications' => $publications]);
    endif; ?>
</div>