<!-- Cart view section -->
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="aa-myaccount-login">
                                <h4>Вход</h4>
                                <form action="" method="post" class="aa-login-form">
                                    <? if(isset($mess)):?>
                                        <div class="alert alert-<?= $mess_type?>"><?= $mess?></div>
                                    <? endif ?>
                                    <label for="">Имя пользвателя или email<span>*</span></label>
                                    <input type="text" placeholder="" name="name">
                                    <label for="">Пароль<span>*</span></label>
                                    <input type="password" placeholder="" name="password">
                                    <button type="submit" class="aa-browse-btn" name="send">Вход</button>
                                    <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Запомнить меня</label>
                                    <p class="aa-lost-password"><a href="#">Забыли пароль</a></p>
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