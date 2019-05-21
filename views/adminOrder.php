<p><a href="/admin/">&larr; Назад</a></p>
<h2>Заказ №<?=$order->id;?></h2>
<p><b>Дата:</b> <?=$order->datetime;?></p>
<p><b>Клиент:</b> <?=$order->user_name;?></p>
<p><b>Телефон:</b> <?=$order->phone;?></p>
<table cellpadding="8" border="1" cellspacing="0">
    <thead>
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($basket as $product): ?>
        <tr>
            <td><?=$product['name'];?> (<?=$product['volume'];?>)</td>
            <td><?=$product['price'];?> руб.</td>
            <td><?=$product['quantity'];?></td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
<h3>Всего: <?=$total;?> руб.</h3>
