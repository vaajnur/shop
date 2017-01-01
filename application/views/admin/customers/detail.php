<div class="col-lg-5">
    <h3 class="box-title">Пользователь </h3>

    <div class="like-th">
        <div>id</div>
        <div>Имя</div>
        <div>Фамилия</div>
        <div>Название компании</div>
        <div>Email</div>
        <div>Телефон</div>
        <div>Адрес</div>
        <div>Страна</div>
        <div>Квартира</div>
        <div>Город</div>
        <div>Почтовый индекс</div>
    </div>
    <? if (isset($customer)): ?>
        <div class="like-td">
            <? if (isset($customer)): ?>
                <? foreach ($customer as $key => $info): ?>
                    <? if ($key != "customer_id"): ?>
                        <div><?= $info ?></div>
                    <? else: ?>
                        <? global $customer_id;
                        $customer_id = $info ?>
                    <? endif ?>
                <? endforeach ?>
            <? endif ?>
        </div>
    <? endif ?>
    <div class="clearfix"></div>
    <br/><br/>
    <? if (isset($customer_id)): ?>
        <a href="/admin/customers/editCustomerDetails/<?= $customer_id ?>" class="btn btn-primary">Редактировать</a>
        <a class="btn btn-danger" href="/admin/customers/deleteCustomerDetails/<?= $customer_id ?>">Удалить</a>
    <? endif ?>
</div>
<div class="col-lg-6 orders">
    <h3 class="box-title">История заказов</h3>
    <? if ($orderHistory): ?>
        <? foreach ($orderHistory as $order): ?>
            <div class="box box-solid">
                <div class="box-body">
                    <ul>
                        <? foreach ($order as $name => $value) { ?>
                            <li>
                                <? if($name == 'image'){?>
                                    <?= $name ?>: <img src="images/small/<?= $value ?>" alt=""/>
                                <? }else{ ?>
                                    <?= $name ?>: <?= $value ?>
                                <? } ?>
                            </li>
                        <? } ?>
                    </ul>
                </div>
            </div>
        <? endforeach ?>
    <? endif ?>

</div>