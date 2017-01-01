<h3>Компоненты</h3>
<section class="col-lg-6 pull-right">
    <!-- quick email widget -->
    <? if (isset($data['mess'])): ?>
        <div class="alert alert-<?= $data['mess_type'] ?>"><?= $data['mess'] ?></div>
    <? endif; ?>
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Добавить компонент</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                        class="fa fa-times"></i></button>
            </div>
            <!-- /. tools -->
        </div>
        <div class="box-body">
            <!--   ///////////////////////// ADD  FORM  /////////////////////////      -->
            <form action="/admin/componentsList" method="post" enctype="multipart/form-data">
                <!--                1  -->
                <div class="form-group">
                    <label for="name">Название компонента*</label>
                    <input type="text" class="form-control" name="name" placeholder="" required/>
                </div>
                <!--                2  -->
                <div class="form-group">
                    <label for="latin_name">Component name*</label>
                    <input type="text" class="form-control" name="latin_name" value="" required/>
                </div>
                <!--                3 -->
                <div class="form-group">
                    <label for="">Описание</label>
                    <textarea name="description" class="textarea" placeholder=""
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="box-footer clearfix">
                    <button class="pull-right btn btn-primary" type="submit" name="send">Добавить <i
                            class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
            <!--   ADD  FORM        -->
        </div>
    </div>
</section><!-- /.Left col -->

<table class="table table-striped col-lg-6 pull-left">
    <thead>
    <th>id</th>
    <th>название</th>
    <th>описание</th>
<!--    <th>ред.</th>-->
    <th>деталь.</th>
    <th>удал.</th>
    </thead>
    <? if ($components): ?>
        <tbody>
        <? foreach ($components as $component): ?>
            <tr>
                <td><?= $component['id'] ?></td>
                <td><?= $component['name'] ?></td>
                <td><?= $component['description'] ?></td>
<!--                <td><a href="/admin/componentsList/component/<?/*= $component['latin_name'] */?>"
                       class="glyphicon glyphicon-pencil"></a>
                </td>-->
                <td>
                    <a href="/admin/componentsList/component/<?= $component['id'] ?>">
                        <span class="glyphicon glyphicon-edit" title="ред."></span>
                    </a>
                </td>
                <td><a href="/admin/componentsList/delete/<?= $component['id'] ?>/<?= $component['latin_name'] ?>"
                       class="glyphicon glyphicon-remove text-red delete_item"
                       data-confirm-title="Удалить раздел?"
                       data-confirm-message="Вы действительно хотите удалить компонент <?= $component['name'] ?> и все связанные с компонентом данные?"></a></td>
            </tr>
        <? endforeach; ?>
        </tbody>
    <? endif; ?>
</table>