<!-- Cart view section -->
<section id="cart-view">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="cart-view-area">
<div class="cart-view-table">
<form action="cart/update" method="post">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
    <th></th>
    <th></th><!-- картинка -->
    <th>Продукт</th>
    <th>Цена</th>
    <th>Количество</th>
    <th>Размеры</th>
    <th>Сумма</th>
    <th>Удалить</th>
</tr>
</thead>
<tbody>
<? if (isset($element)): ?>
    <? $counter = 1?>
    <? foreach ($element as $el): ?>
        <tr>
            <td><?= $counter?></td>
            <!-- картинка -->
            <td><a href="section/element/<?= $el['id']?>/catalog/1">
                    <? if (!empty($el['image'])): ?>
                        <img src="images/small/<?= $el['image'][0]['image'] ?>" alt="img">
                    <? else: ?>
                        <img src="img/man/polo-shirt-1.png" alt="img">
                    <? endif ?>
                </a></td>
                <!-- название -->
            <td><a class="aa-cart-title" href="section/element/<?= $el['id']?>/catalog/1"><?= $el['name'] ?></a></td>
            <!-- цена -->
            <td><?= $el['price'] ?> руб.</td>
            <!-- количество -->
            <td>
                <? foreach($el['sizeVAL'] as $size=>$amount): ?>
                    <?= $amount['sizeAmount'] ?>
                    <!-- select для изменения количества -->
                    <? if (!empty($el['avail_fields']['quantity'][0])): ?>
                        <select class="form-control" name="quantity_<?= $el['id'] ?>_<?= $amount['sizeID'] ?>" id="">
                            <? foreach ($el['fields'] as $field3){
                                if ($field3['name'] == 'quantity') { ?>
                                    <option value=""></option>
                                <?    foreach ($field3['name1'] as $key => $name1) {
                                        if ((int)$el['avail_fields']['quantity'][0]['name'] >= (int)$name1){
                                            ?>
                                            <option value="<?= $field3['id1'][$key] ?>"><?= $name1 ?></option>
                                    <?
                                        }
                                    }
                                }
                            } ?>
                        </select>
                    <? endif ?>
                <? endforeach ?>
            </td>
            <!-- размеры -->
            <td>
                <? foreach($el['sizeVAL'] as $size=>$amount): ?>
                <?= $size ?>
                <div class="radio">
                    <? if (!empty($el['avail_fields']["size"][0])) {
                        foreach ($el['avail_fields']["size"] as $key => $val) {
                            ?>
                            <label class="radio-inline" for="rad<?= $el['id']?><?= $amount['sizeID']?><?= $val['id'] ?>"><input
                                    type="radio"
                                    class=""
                                    value="<?= $val['id'] ?>"
                                    id="rad<?= $el['id']?><?= $amount['sizeID']?><?= $val['id'] ?>"
                                    name="size_<?= $el['id']?>_<?= $amount['sizeID']?>"/><?= $val['name'] ?>
                            </label>
                        <?
                        }
                    } ?>
                </div>
                <? endforeach ?>
            </td>
            <!-- сумма -->
            <td><?= $el['total'] ?> руб.</td>
            <!-- удалить -->
            <td>
                <? foreach($el['sizeVAL'] as $size=>$val): ?>
                <a class="remove" href="cart/delete/<?= $el['id'] ?>/<?= $val['sizeID'] ?>">
                    <fa class="fa fa-close"></fa>
                </a><br/><br/>
                <? endforeach ?>
            </td>
        </tr>
        <? $counter++?>
    <? endforeach ?>
<? endif ?>
<tr>
    <td colspan="8" class="aa-cart-view-bottom">
        <div class="aa-cart-coupon">
            <input class="aa-coupon-code" type="text" placeholder="Купон">
            <input class="aa-cart-view-btn" type="submit" value="Применить купон">
        </div>
        <input class="aa-cart-view-btn" type="submit" name="send"
               value="Обновить корзину">
    </td>
</tr>
</tbody>
</table>
</div>
</form>
<!-- Cart Total view -->
<div class="cart-view-total">
    <h4>Сумма корзины</h4>
    <table class="aa-totals-table">
        <tbody>
        <tr>
            <th>Предсумма</th>
            <td><?= $total_sum?> руб.</td>
        </tr>
        <tr>
            <th>Сумма</th>
            <td><?= $total_sum?> руб.</td>
        </tr>
        </tbody>
    </table>
    <a href="order" class="aa-cart-view-btn">Перейти к оформлению</a>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!--  Cart view section -->