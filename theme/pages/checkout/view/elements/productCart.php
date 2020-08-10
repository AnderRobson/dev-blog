<tr>
    <td>
        <img src="<?= urlFile('product/semimage.png')?>" class="img-fluid img-thumbnail" alt="<?= $product->title; ?>" style="width: 100px">
    </td>
    <th><?= $product->code; ?></th>
    <td class="text-left"><?= $product->title; ?></td>
    <td><?= rand(1, 10); ?></td>
    <td><?= $product->valor; ?></td>
</tr>