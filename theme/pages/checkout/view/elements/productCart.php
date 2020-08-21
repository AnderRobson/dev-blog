<tr>
    <td>
        <img src="<?= urlFile('product/' . $productImages->image); ?>" class="img-fluid img-thumbnail" alt="<?= $product->title; ?>" style="width: 100px; height: 80px;">
    </td>
    <th><?= $product->stock->code; ?></th>
    <td class="text-left"><?= $product->title; ?></td>
    <td><?= $cart->getQuantityItems($product->stock->id) ?></td>
    <td><?= formatMoney($product->getStock()->current_value); ?></td>
</tr>