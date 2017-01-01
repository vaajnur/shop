<h3 class="box-title">Пользователи</h3>
<br/><br/>
<table class="table table-striped table-hover col-lg-5">
    <thead>
        <tr>
            <th>id</th>
            <th>имя</th>
            <th>пароль</th>
            <th>деталь.</th>
            <th>ред.</th>
            <th>удал.</th>
        </tr>
    </thead>
    <? if(isset($customers)):?>
    <tbody>
        <? foreach($customers as $customer): ?>
        <tr>
            <? foreach ($customer as $val) { ?>
                <td><?= $val ?></td>
            <? } ?>
            <td>
                <a href="/admin/customers/detail/<?= $customer['id'] ?>">
                    <span class="glyphicon glyphicon-eye-open" title="детально"></span>
                </a>
            </td>
            <td>
                <a href="/admin/customers/editCustomer/<?= $customer['id'] ?>">
                    <span class="glyphicon glyphicon-edit" title="редактировать детали"></span>
                </a>
            </td>
            <td>
                <a href="/admin/customers/deleteCustomer/<?/*= $customer['id'] */?>" class="delete_item"
                   data-confirm-title="Удалить запись?"
                   data-confirm-message="Вы действительно хотите удалить пользователя?">
                    <span class="glyphicon glyphicon-trash text-orange" title="удалить"></span>
                </a>
            </td>
        </tr>
        <? endforeach ?>
    </tbody>
    <? endif ?>
</table>