<tr>
    <td><?= $order->id; ?></td>
    <td class="bg-<?= $order->getStatus('class'); ?> text-black"><?= $order->getStatus('status') ?></td>
    <td><?= formatMoney($order->sub_total); ?></td>
    <td><?= formatMoney($order->total); ?></td>
</tr>