<?php
$v->layout("checkout/view/_theme", ["title" => "Pagamento"]); ?>

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
            <div class="ajax_load">
                <div class="ajax_load_box">
                    <div class="ajax_load_box_circle"></div>
                    <div class="ajax_load_box_title jumbotrom">Aguarde, carregando!</div>
                </div>
            </div>
            <div class="form_ajax" style="display: none"></div>
            <div class="row">
                <div class="col-md-4 order-md-1 mb-5">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Cliente</span>
                                <span class="badge badge-secondary badge-pill">3</span>
                            </h4>
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Nome</h6>
                                    </div>
                                    <span class="text-muted"><?= $user->person->first_name . " " . $user->person->last_name; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-light">
                                    <div>
                                        <h6 class="my-0">Email</h6>
                                    </div>
                                    <span><?= $user->email; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Entrega</span>
                                <span class="badge badge-secondary badge-pill">3</span>
                            </h4>
                            <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Rua</h6>
                                </div>
                                <input type="text" id="street" class="input-none text-right" value="<?= $user->person->address->street; ?>" style="max-width: 80%;" readonly>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">Número</h6>
                                </div>
                                <input type="text" id="number" class="input-none text-right" value="<?= $user->person->address->number; ?>" style="max-width: 70%;" readonly>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Bairro</h6>
                                </div>
                                <input type="text" id="district" class="input-none text-right" value="<?= $user->person->address->district; ?>" style="max-width: 80%;" readonly>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">Cidade</h6>
                                </div>
                                <input type="text" id="city" class="input-none text-right" value="<?= $user->person->address->city; ?>" style="max-width: 80%;" readonly>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Estado</h6>
                                </div>
                                <input type="text" id="state" class="input-none text-right" value="<?= $user->person->address->state->initials; ?>" style="max-width: 80%;" readonly>
                            </li>
                        </ul>
                        </div>
                        <div class="col-md-12">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Cupom de Desconto</span>
                                <span class="badge badge-secondary badge-pill">3</span>
                            </h4>

                            <form class="card p-2 mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cupom de Desconto">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger">Aplicar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 order-md-2 mb-5">
                    <div class="row">
                        <div class="col-md-12">
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
                                    <input type="text" id="freight_value_cart" class="input-none text-right" value="<?= formatMoney($cart->getFreight()->getValue());; ?>" style="max-width: 80%;" readonly>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-light"
                                    <?=
                                    empty($cart->getDiscounts()->getTotal())
                                        ?
                                        'style="display: none !important"'
                                        :
                                        '';
                                    ?>
                                >
                                    <div class="text-success">
                                        <h6 class="my-0">Descontos</h6>
                                        <small>CODIGO_CUPOM</small>
                                    </div>
                                    <span class="text-success"><?= formatMoney($cart->getDiscounts()->getTotal()); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Sub Total</span>
                                    <input type="text" id="subtotal" class="input-none text-right" value="<?= formatMoney($cart->getSubTotal()); ?>" style="max-width: 80%;" readonly>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Valor a Pagar</span>
                                    <input type="text" id="total_amount" class="input-none text-right" value="<?= formatMoney($cart->getTotal()); ?>" style="max-width: 80%;" readonly>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted my-3">Frete</span>
                                <span class="badge badge-secondary badge-pill">3</span>
                            </h4>
                            <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">CEP</h6>
                            </div>
                            <input type="text" id="zip_code" class="input-none text-right" value="<?= $user->person->address->zip_code; ?>" style="max-width: 80%;" readonly>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div>
                                <h6 class="my-0">Valor Frete</h6>
                            </div>
                            <input type="text" id="freight_value" class="input-none text-right" value="<?= formatMoney($cart->getFreight()->getValue());; ?>" style="max-width: 80%;" readonly>
                        </li>
                    </ul>
                        </div>
                        <div class="col-md-12 align-self-end">
                            <h4 class="d-flex justify-content-between align-items-center">
                                <span class="text-muted my-3 mb-2">Cotação de Frete</span>
                                <span class="badge badge-secondary badge-pill">3</span>
                            </h4>

                            <!-- Retorno da cotação de frete-->
                            <div id="freightQuote"></div>

                            <form class="card p-2" action="<?= url("carrinho/freight_quote"); ?>" method="post" enctype="multipart/form-data" id="form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="CEP" name="cep">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger" id="freightQuote">Aplicar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 order-md-3 mb-5">
                    <div class="row">
                        <div class="col-md-12">
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
                                    <input type="text" id="freight_value_cart" class="input-none text-right" value="<?= formatMoney($cart->getFreight()->getValue());; ?>" style="max-width: 80%;" readonly>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-light"
                                    <?=
                                    empty($cart->getDiscounts()->getTotal())
                                        ?
                                        'style="display: none !important"'
                                        :
                                        '';
                                    ?>
                                >
                                    <div class="text-success">
                                        <h6 class="my-0">Descontos</h6>
                                        <small>CODIGO_CUPOM</small>
                                    </div>
                                    <span class="text-success"><?= formatMoney($cart->getDiscounts()->getTotal()); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Sub Total</span>
                                    <input type="text" id="subtotal" class="input-none text-right" value="<?= formatMoney($cart->getSubTotal()); ?>" style="max-width: 80%;" readonly>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Valor a Pagar</span>
                                    <input type="text" id="total_amount" class="input-none text-right" value="<?= formatMoney($cart->getTotal()); ?>" style="max-width: 80%;" readonly>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                        </div>
                        <div class="col align-self-end">
                            <form class="card p-2" action="<?= url("carrinho/do_pagamento"); ?>" method="post" enctype="multipart/form-data" id="payment">
                        <button type="submit" class="btn btn-danger">Pagamento</button>
                    </form>
                        </div>
                    </div>
                </div>
        </div>
    </main>
<?php
    $v->start("js");
        echo js("payment");
        echo js("freight");
    $v->end();
