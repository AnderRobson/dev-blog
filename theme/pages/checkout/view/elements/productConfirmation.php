<tr>
    <td>
        <img src="<?= urlFile('product/' . $productImages->image); ?>" class="img-fluid img-thumbnail" alt="<?= $product->product->title; ?>" style="width: 100px; height: 80px;">
    </td>
    <th><?= $stock->code; ?></th>
    <td class="text-left"><?= $product->product->title; ?></td>
    <td><?= $product->quantity ?></td>
    <td><?= formatMoney($product->value); ?></td>
</tr>