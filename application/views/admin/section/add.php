<section class="col-lg-7 connectedSortable">
    <!-- quick email widget -->
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Добавить раздел</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                        class="fa fa-times"></i></button>
            </div>
            <!-- /. tools -->
        </div>
        <div class="box-body">
            <? if (isset($data['mess'])): ?>
                <div class="alert alert-<?= $data['mess_type'] ?>"><?= $data['mess'] ?></div>
            <? endif; ?>
            <!--   ///////////////////////// ADD  FORM  /////////////////////////      -->
            <form action="/admin/section/add" method="post" enctype="multipart/form-data">
                <!--                1  -->
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Название раздела"/>
                </div>
                <!--                2  -->
                <div class="form-group">
                    <label for="image">Картинка</label>
                    <input type="file" class="form-control" name="image" value=""/>
                </div>
                <!--                3 -->
                <div class="form-group">
                    <textarea name="description" class="textarea" placeholder="Описание "
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <!--                4 -->
                <div class="form-group">
                    <p>Родительский раздел</p>
                    <? if (isset($left_menu['select'])): ?>
                        <?= $left_menu['select'] ?>
                    <? endif ?>
                </div>
                <!--               5 -->
                <div class="form-group">
                    <p>Выберите компонент</p>
                    <select class="form-control" name="component_id" id="">
                        <? if (isset($data['components_list'])): ?>
                            <? foreach ($data['components_list'] as $component): ?>
                                <option value="<?= $component['id'] ?>"><?= $component['name'] ?></option>
                            <? endforeach ?>
                        <? endif ?>
                    </select>
                </div>
                <!--               6 -->
                <div class="form-group">
                    <p>Выберите шаблон</p>
                    <select class="form-control" name="template_id" id="">
                        <? if ($data['templates']): ?>
                            <? foreach ($data['templates'] as $template): ?>
                                <option value="<?= $template['id'] ?>"><?= $template['name'] ?></option>
                            <? endforeach ?>
                        <? endif ?>
                    </select>
                </div>
                <div class="box-footer clearfix">
                    <button class="pull-right btn btn-default" type="submit" name="send">Добавить <i
                            class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
            <!--   ADD  FORM        -->
        </div>
    </div>
</section><!-- /.Left col -->
