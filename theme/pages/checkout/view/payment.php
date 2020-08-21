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
            <div class="row">
                <div class="col-md-4 order-md-1 mb-5">
                    <div class="row mb-3">
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
                    <div class="row">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Entrega</span>
                            <span class="badge badge-secondary badge-pill">3</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Rua</h6>
                                </div>
                                <span"><?= $user->person->address->street; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">Número</h6>
                                </div>
                                <span><?= $user->person->address->number; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Bairro</h6>
                                </div>
                                <span><?= $user->person->address->district; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">Cidade</h6>
                                </div>
                                <span><?= $user->person->address->city; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Estado</h6>
                                </div>
                                <span><?= $user->person->address->state->name; ?></span>
                            </li>
                        </ul>

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
                            <span class="text-muted">R$ 16.50</span>
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
                            <strong>R$ 136.89</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Valor a Pagar</span>
                            <strong>R$ 153.39</strong>
                        </li>
                    </ul>

                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted my-3">Frete</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">CEP</h6>
                            </div>
                            <span><?= $user->person->address->zip_code; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div>
                                <h6 class="my-0">Valor Frete</h6>
                            </div>
                            <span>R$ 16.50</span>
                        </li>
                    </ul>

                    <h4 class="d-flex justify-content-between align-items-center">
                        <span class="text-muted my-3 mb-2">Cotação de Frete</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>

                    <!-- Retorno da cotação de frete-->
                    <div id="freightQuote"></div>

                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="CEP">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Aplicar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 order-md-3 mb-5">
                    <form class="card p-2" action="<?= url("carrinho/pagamento"); ?>">
                        <button type="submit" class="btn btn-danger">Pagamento</button>
                    </form>
                </div>
        </div>
    </main>
