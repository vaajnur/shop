<section class="col-lg-6">
    <!-- quick email widget -->
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Редактирование пользователя</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                        class="fa fa-times"></i></button>
            </div>
            <!-- /. tools -->
        </div>
        <div class="box-body">
            <form action="admin/customers/editCustomerDetails/<?= $customer['customer_id'] ?>" method="post">
                <div class="form-group">
                    <label for="">Имя*</label>
                    <input type="text" class="form-control" name="name" value="<?= $customer['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Фамилия*</label>
                    <input type="text" class="form-control" name="secondname" value="<?= $customer['secondname'] ?>" required="">
                </div>
                <div class="form-group">
                    <label for="">Название компании</label>
                    <input type="text" class="form-control" name="company_name" value="<?= $customer['company_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Email*</label>
                    <input type="email"  class="form-control" name="email" value="<?= $customer['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Телефон*</label>
                    <input type="tel"  class="form-control" name="telephone" placeholder="" value="<?= $customer['telephone'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Адрес</label>
                    <textarea name="address" cols="8" rows="3"><?= $customer['address'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Страна</label>
                    <select class="form-control" name="country">
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
                <div class="form-group">
                    <label for="">Квартира</label>
                    <input type="text" class="form-control" name="flat" value="<?= $customer['flat'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Город*</label>
                    <input type="text" class="form-control" name="city" value="<?= $customer['city'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Почтовый индекс*</label>
                    <input type="text" class="form-control" name="postindex" value="<?= $customer['postindex'] ?>" required>
                </div>
                <div class="box-footer clearfix">
                    <button class="pull-right btn btn-default" type="submit" name="send">
                        Редактировать <i
                            class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</section>