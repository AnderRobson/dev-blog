<div class="row no-gutters rounded flex-md-row m-5 shadow-sm h-md-250 position-relative col-md-3 card">
    <?php if ($productImages): ?>
        <div id="productShop<?= $position; ?>" class="carousel slide img-product" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach($productImages as $key => $productImage) : ?>
                    <div class="carousel-item <?= $key == 0 ? 'active' : '';?>">
                        <img
                            src="<?=  urlFile('product/' .  $productImage->image);?>"
                            class="img-product"
                            width="200"
                            height="200"
                            alt="<?= $product->title; ?>"
                        >
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($productImages) > 1): ?>
                <a class="carousel-control-prev" href="#productShop<?= $position; ?>" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#productShop<?= $position; ?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="col p-4 d-flex flex-column position-static card-body">
        <strong class="d-inline-block mb-2 text-primary"><?= $product->title; ?></strong>
        <div class="mb-1 text-muted"><?=  substr($product->description, 0, 100);?></div>
        <a href="<?=  url('products/' . $product->slug);?>">Continue reading</a>
    </div>
</div>