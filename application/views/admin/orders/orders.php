<h3 class="box-title">Заказы</h3>
<br/><br/>
<table class="table table-bordered table-hover col-lg-12">
    <thead>
        <tr>
            <th>id</th>
            <th>Товар</th>
            <th>Картинка</th>
            <th>Размер</th>
            <th>Количество</th>
            <th>Имя пользователя</th>
            <th>Фамилия</th>
            <th>Способ оплаты</th>
            <th>Статус</th>
            <th>Дата</th>
            <th>ред.</th>
            <th>удал.</th>
        </tr>
    </thead>
    <? if(isset($orders)):?>
    <tbody>
        <? foreach($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><a href="/admin/element/index/1/<?= $order['c_c_id']?>/catalog"><?= $order['c_c_name'] ?></a></td>
            <td><img src="images/small/<?= $order['image'] ?>" alt=""/></td>
            <td><?= $order['isr_name']?></td>
            <td><?= $order['quantity'] ?></td>
            <td><?= $order['c_d_name'] ?></td>
            <td><?= $order['c_d_secondname'] ?></td>
            <td><?= $order['pay_type'] ?></td>
            <td></td>
            <td><?= $order['date']?></td>
            <td>
                <a href="/admin/orders/edit/<?= $order['id'] ?>">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
            <td>
                <a href="/admin/orders/delete/<?= $order['id'] ?>" class="delete_item"
                   data-confirm-title="Удалить запись?"
                   data-confirm-message="Вы действительно хотите удалить эту запись?">
                    <span class="glyphicon glyphicon-trash text-orange"></span>
                </a>
            </td>
        </tr>
        <? endforeach ?>
    </tbody>
    <? endif ?>
</table>