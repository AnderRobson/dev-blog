<?php
$v->layout("checkout/view/_theme", ["title" => "Carrinho"]); ?>

    <?php if (! empty($banners)):
        $v->insert(
            "elements/bannerCheckout",
            [
                'banners' => $banners
            ]
        );
    endif; ?>

    <main role="main" class="container my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-5">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Seu Carrinho</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Frete</h6>
                                <small class="text-muted">Valor Frete</small>
                            </div>
                            <span class="text-muted"><?= formatMoney($cart->getFreight()->getValue()); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Descontos</h6>
                                <small>CODIGO_CUPOM</small>
                            </div>
                            <span class="text-success">- R$ 50.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Sub Total</span>
                            <span><?= formatMoney($cart->getSubTotal()); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Valor a Pagar</span>
                            <strong><?= formatMoney($cart->getTotal()); ?></strong>
                        </li>
                    </ul>

                    <form class="card p-2 mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cupom de Desconto">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Aplicar</button>
                            </div>
                        </div>
                    </form>

                    <form class="card p-2" action="<?= url("carrinho/pagamento"); ?>">
                        <button type="submit" class="btn btn-danger">Pagamento</button>
                    </form>
                </div>
                <div class="col-md-8 order-md-1">
                    <div class="container-fluid">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Código</th>
                                <th scope="col">Título</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Valor Unidade</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (! empty($products)):
                                    foreach ($products as $product) {
                                        $v->insert(
                                            "checkout/view/elements/productCart",
                                            [
                                                'product' => $product,
                                                'productImages' => $product->getImages(1)
                                            ]
                                        );
                                    }
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
