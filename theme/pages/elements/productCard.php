<div class="row no-gutters rounded flex-md-row m-5 shadow-sm h-md-200 position-relative col-md-3 card">

    <div class="jumbotron jumbotron-fluid" style="background-image: url(<?= urlFile('product/' .  reset($productImages)->image); ?>); background-size: 100%; height: 200px;  object-fit: cover;">

    </div>
    <div class="col p-4 d-flex flex-column position-static card-body" style="height: 430px;">
        <strong class="d-inline-block mb-2 text-primary"><?= $product->title; ?></strong>
        <div class="mb-1 text-muted"><?=  substr($product->description, 0, 130);?></div>
        <a href="<?=  url('products/' . $product->slug);?>" class="mb-5">Continue reading</a>
        <a href="#" data-action="<?= url("carrinho/do_add"); ?>" data-stock="<?= $product->getStock()->id; ?>" class="remove btn btn-outline-danger my-5 active" role="button" aria-pressed="true">
            <i data-feather="shopping-cart"></i> Adicionar ao Carrinho
        </a>
    </div>
</div>