<!-- Cart view section -->
<section id="cart-view">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="cart-view-area">

<div class="panel-group" id="accordion">
<!-- orders history -->
<div class="panel panel-default aa-checkout-billaddress">
<div class="panel-heading">
<h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
        История заказов
    </a>
</h4>
</div>
<div id="collapseOne" class="panel-collapse collapse">
<div class="panel-body">

    <div class="cart-view-table">
        <div class="table-responsive">
            <h3>История заказов</h3>
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Продукт</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Способ оплаты</th>
                    <th>Дата</th>
                </tr>
                </thead>
                <tbody>
                <? if (isset($element)): ?>
                    <? $counter = 1 ?>
                    <? foreach ($element as $el): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><a href="section/element/<?= $el['id'] ?>/catalog/1">
                                    <? if (!empty($el['image'])): ?>
                                        <img src="images/small/<?= $el['image'] ?>" alt="img">
                                    <? else: ?>
                                        <img src="img/man/polo-shirt-1.png" alt="img">
                                    <? endif ?>
                                </a></td>
                            <td><a class="aa-cart-title"
                                   href="section/element/<?= $el['id'] ?>/catalog/1"><?= $el['name'] ?></a></td>
                            <td><?= $el['price'] ?></td>
                            <td><?= $el['quantity'] ?></td>
                            <td><?= $el['pay_type'] ?></td>
                            <td><?= $el['date']?></td>
                        </tr>
                        <? $counter++ ?>
                    <? endforeach ?>
                <? endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<!-- Billing Details -->
<div class="panel panel-default aa-checkout-billaddress">
<div class="panel-heading">
    <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
            Ваши данные
        </a>
    </h4>
</div>
<div id="collapseThree" class="panel-collapse collapse in">
    <div class="panel-body">
        <? if (isset($mess)): ?>
            <div class="alert alert-<?= $mess_type ?>"><?= $mess ?></div>
        <? endif ?>
        <? if (isset($customer_details)): ?>
            <form method="post" action="account/edit">
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="name" placeholder="Имя*" value="<?= $customer_details['name'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="secondname" placeholder="Фамилия*"
                                   value="<?= $customer_details['secondname'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="company_name" placeholder="Название компании"
                                   value="<?= $customer_details['company_name'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="email" name="email" placeholder="Email*"
                                   value="<?= $customer_details['email'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="tel" name="telephone" placeholder="Телефон*"
                                   value="<?= $customer_details['telephone'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-checkout-single-bill">
                            <textarea name="address" cols="8" rows="3" placeholder="Адрес"><?= $customer_details['address'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-checkout-single-bill">
                            <select name="country">
                                <option value="0">Россия</option>
                                <option value="1">Australia</option>
                                <option value="2">Afganistan</option>
                                <option value="3">Bangladesh</option>
                                <option value="4">Belgium</option>
                                <option value="5">Brazil</option>
                                <option value="6">Canada</option>
                                <option value="7">China</option>
                                <option value="8">Denmark</option>
                                <option value="9">Egypt</option>
                                <option value="10">India</option>
                                <option value="11">Iran</option>
                                <option value="12">Israel</option>
                                <option value="13">Mexico</option>
                                <option value="14">UAE</option>
                                <option value="15">UK</option>
                                <option value="16">USA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="flat" placeholder="Квартира."
                                   value="<?= $customer_details['flat'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="city" placeholder="Город*"
                                   value="<?= $customer_details['city'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" placeholder="District">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="postindex" placeholder="Почтовый индекс*"
                                   value="<?= $customer_details['postindex'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="aa-browse-btn" name="send">Редактировать</button>
                    </div>
                </div>
            </form>
            <!--     ////////////////////////////////   ADD DETAILS  ////////////////////////////////            -->
        <? else: ?>
            <form action="account/add" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="name" placeholder="Имя*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="secondname" placeholder="Фамилия*" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="company_name" placeholder="Название компании">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="email" name="email" placeholder="Email*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="tel" name="telephone" placeholder="Телефон*" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-checkout-single-bill">
                            <textarea name="address" cols="8" rows="3" placeholder="Адрес*"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-checkout-single-bill">
                            <select name="country">
                                <option value="0">Россия</option>
                                <option value="1">Australia</option>
                                <option value="2">Afganistan</option>
                                <option value="3">Bangladesh</option>
                                <option value="4">Belgium</option>
                                <option value="5">Brazil</option>
                                <option value="6">Canada</option>
                                <option value="7">China</option>
                                <option value="8">Denmark</option>
                                <option value="9">Egypt</option>
                                <option value="10">India</option>
                                <option value="11">Iran</option>
                                <option value="12">Israel</option>
                                <option value="13">Mexico</option>
                                <option value="14">UAE</option>
                                <option value="15">UK</option>
                                <option value="16">USA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="flat" placeholder="Квартира.">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="city" placeholder="Город*" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" placeholder="District">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aa-checkout-single-bill">
                            <input type="text" name="postindex" placeholder="Почтовый индекс*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="aa-browse-btn" name="send">Добавить</button>
                    </div>
                </div>
            </form>
        <? endif ?>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- / Cart view section -->