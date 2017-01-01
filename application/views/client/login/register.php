<!-- Cart view section -->
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">
                    <div class="row">
                        <div class="col-lg-offset-3 col-md-6">
                            <div class="aa-myaccount-register">
                                <h4>Регистрация</h4>
                                <form action="login/register" method="post" class="aa-login-form">
                                    <? if(isset($mess)):?>
                                        <div class="alert alert-<?= $mess_type?>"><?= $mess?></div>
                                    <? endif ?>
                                    <label for="">Имя пользвателя или email<span>*</span></label>
                                    <input type="text" name="name" placeholder="">
                                    <label for="">Пароль<span>*</span></label>
                                    <input type="password" name="password" placeholder="">
                                    <button type="submit" name="send" class="aa-browse-btn">Зарегистрироваться</button>
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