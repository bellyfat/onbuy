<h2>Оформленные заказы</h2>
<table cellpadding="8" border="1" cellspacing="0">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Номер</th>
            <th>Клиент</th>
            <th>Телефон</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($orders as $order): ?>
        <tr>
            <td><?=$order['datetime'];?></td>
            <td>
                <a href="/admin/order/<?=$order['id'];?>">Заказ №<?=$order['id'];?></a>
            </td>
            <td><?=$order['user_name'];?></td>
            <td><?=$order['phone'];?></td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
