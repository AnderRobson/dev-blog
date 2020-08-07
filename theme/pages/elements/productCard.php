<div class="row no-gutters rounded flex-md-row m-5 shadow-sm h-md-250 position-relative col-md-3 card">
    <img src="<?=  urlFile('publication/' .  $product->image);?>" class="card-img-top" width="200" height="250" alt="<?= $product->title; ?>">
    <div class="col p-4 d-flex flex-column position-static card-body">
        <strong class="d-inline-block mb-2 text-primary"><?= $product->title; ?></strong>
        <div class="mb-1 text-muted"><?=  substr($product->description, 0, 100);?></div>
        <a href="<?=  url('products/' . $product->slug);?>" class="stretched-link">Continue reading</a>
    </div>
</div>