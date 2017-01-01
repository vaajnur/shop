<!-- Cart view section -->
<section id="checkout">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="checkout-area">
<div class="row">
<div class="col-md-8">
    <div class="checkout-left">
        <div class="panel-group" id="accordion">
            <!-- Coupon section -->
            <div class="panel panel-default aa-checkout-coupon">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            У вас есть купон?
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <input type="text" placeholder="Код купона" class="aa-coupon-code">
                        <input type="submit" value="Применить купон" class="aa-browse-btn">
                    </div>
                </div>
            </div>
            <!-- Login section -->
            <? if (!isset($_SESSION['user'])): ?>
                <div class="panel panel-default aa-checkout-login">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Вход для клиента
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form action="order/login" method="post" class="aa-login-form">
                                <? if (isset($mess)): ?>
                                    <div class="alert alert-<?= $mess_type ?>"><?= $mess ?></div>
                                <? endif ?>
                                <label for="">Имя пользвателя или email<span>*</span></label>
                                <input type="text" placeholder="" name="name" required>
                                <label for="">Пароль<span>*</span></label>
                                <input type="password" placeholder="" name="password" required>
                                <div class="pull-left">
                                <button type="submit" class="aa-browse-btn" name="send_login">Вход</button>
                                <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme">
                                    Запомнить меня</label>
                                <p class="aa-lost-password"><a href="#">Забыли пароль</a></p>
                                </div>
                                <div class="aa-register-now pull-right">
                                    <a href="login/register">Зарегистрироваться!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <? endif ?>
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
                        <? if (!isset($_SESSION['user']) || !isset($customer_details)): ?>
                            <form action="order/addDetails" method="post">
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
                                            <textarea name="address" cols="8" rows="3" placeholder="Адрес*"
                                                      required></textarea>
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
                                        <? if (isset($mess1)): ?>
                                            <div class="alert alert-<?= $mess_type1 ?>"><?= $mess1 ?></div>
                                        <? endif ?>
                                        <button type="submit" class="aa-browse-btn" name="send_details">Добавить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <? else: ?>
                            <div class="">
                                <div class="like-th">
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
                                <div class="like-td">
                                    <? if (isset($customer_details)): ?>
                                        <? foreach ($customer_details as $key=>$info): ?>
                                            <? if($key != "customer_id" && $key != "id"):?>
                                                <div><?= $info ?></div>
                                            <? endif ?>
                                        <? endforeach ?>
                                    <? else: ?>
                                        <? for ($i = 0; $i < 11; $i++): ?>
                                            <div>-</div>
                                        <? endfor ?>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <a href="account">Редактировать данные</a>
                        <? endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="checkout-right">
        <h4>Сумма заказа</h4>

        <div class="aa-order-summary-area">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Товар</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                <? if (isset($element)): ?>
                <? foreach ($element as $el): ?>
                    <tr>
                        <td><?= $el['name'] ?> <strong> x  <?= $el['quantity'] ?></strong></td>
                        <td><?= $el['total'] ?></td>
                    </tr>
                <? endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Предсумма</th>
                    <td><?= $total_sum ?></td>
                </tr>
                <tr>
                    <th>Налог</th>
                    <td>-</td>
                </tr>
                <tr>
                    <th>Сумма</th>
                    <td><?= $total_sum ?></td>
                </tr>
                </tfoot>
                <? endif ?>
            </table>
        </div>
        <h4>Способ оплаты</h4>

        <form action="order/addOrder" method="post">
            <div class="aa-payment-method">
                <label for="cashdelivery"><input type="radio" id="cashdelivery" value="cashdelivery"
                                                 name="pay_type"> Оплата при
                    доставке </label>
                <label for="paypal"><input type="radio" id="paypal" value="paypal" name="pay_type" checked> Via
                    Paypal
                </label>
                <img src="images/AM_mc_vs_dc_ae.jpg" border="0"
                     alt="PayPal Acceptance Mark">
                <? if (isset($mess2)): ?>
                    <div class="alert alert-<?= $mess_type2 ?>"><?= $mess2 ?></div>
                <? endif ?>
                <input type="submit" name="send_order" value="Сделать заказ" class="aa-browse-btn">
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- / Cart view section -->