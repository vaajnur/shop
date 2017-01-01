<h3 class="box-title"><?= $section_info['name'] ?></h3>
<div class="box box-success width_auto pull-left">
    <div class="box-body">
        <form action="/admin/section/addComponent/<?= $section_info['id'] ?>" class="form-inline" method="post">
            <select class="form-control" name="available_component" id="">
                <? if (isset($available_componenet)): ?>
                    <? foreach ($available_componenet as $comp): ?>
                        <option value="<?= $comp['id'] ?>"><?= $comp['name'] ?></option>
                    <? endforeach ?>
                <? endif ?>
            </select>
            <button type="send" class="btn btn-primary btn-sm" name="send_comp"><i class="glyphicon glyphicon-plus"></i>
                Добавить компонент
            </button>
        </form>
    </div>
</div>
<div class="clearfix"></div>
<br/>
<!--//////////////////////////////////  SECTION INFO  /////////////////////////////////-->
<table class="table table-striped col-lg-4">
    <thead>
    <tr>
        <th style="">id</th>
        <th>Картинка</th>
        <th>Название раздела</th>
        <th>Родительский раздел</th>
        <th>Шаблон</th>
        <th>Описание</th>
        <th style="">ред.</th>
        <th style="">удал.</th>
    </tr>
    </thead>
    <? if (!empty($section_info)): ?>
        <tbody>
        <tr>
            <td><?= $section_info['id'] ?></td>
            <td><? if (!empty($section_info['image'])): ?><img src="images/small/<?= $section_info['image'] ?>"
                                                               alt=""/><? endif ?></td>
            <td><?= $section_info['name'] ?></td>
            <td><?= $section_info['parent_name'] ?></td>
            <td><?= $section_info['temp_name'] ?></td>
            <td><?= $section_info['description'] ?></td>
            <td>
                <a href="/admin/section/edit/<?= $section_info['id'] ?>">
                    <span class="glyphicon glyphicon-edit" title="редактировать"></span>
                </a>
            </td>
            <td>
                <a href="/admin/section/delete/<?= $section_info['id'] ?>" class="delete_item"
                   data-confirm-title="Удалить раздел <?= $section_info['name'] ?>?"
                   data-confirm-message="Вы действительно хотите удалить раздел <?= $section_info['name'] ?>?">
                    <span class="glyphicon glyphicon-trash" title="удалить"></span>
                </a>
            </td>
        </tr>
        </tbody>
    <? endif ?>
</table>
<div class="clearfix"></div>
<!--///////////////////////////////////////////////////////////////////-->
<? if (!empty($components)): ?>
    <!--  ///////////////////////////////////////////// MESS ///////////////////////////////////////////// -->
    <? if (isset($mess['image_upload_err'])): ?>
        <? foreach ($mess['image_upload_err'] as $img => $mess): ?>
            <div class="alert alert-danger">
                <?= $img ?>
                <? foreach ($mess as $mess2): ?>
                    <?= $mess2 ?>
                <? endforeach ?>
            </div>
        <? endforeach ?>
    <? endif; ?>
    <? if (isset($mess['image_resize_err'])): ?>
        <? foreach ($mess['image_resize_err'] as $img => $mess): ?>
            <div class="alert alert-danger">
                <?= $img ?>
                <? foreach ($mess as $mess2): ?>
                    <?= $mess2 ?>
                <? endforeach ?>
            </div>
        <? endforeach ?>
    <? endif; ?>
    <? if (isset($mess['added'])): ?>
        <div class="alert alert-success">Элемент добавлен!</div>
    <? endif; ?>
    <!--     /////////////////////////////////////////////   COMPONENTS ///////////////////////   -->
    <? foreach ($components as $key => $comp): ?>
        <h4><span class="glyphicon glyphicon-info-sign"></span> Компонент: <b><?= $comp['name'] ?></b>
            <a href="admin/section/deleteComponent/<?= $section_info['id'] ?>/<?= $comp['id'] ?>" class="text-danger delete_item"
               data-confirm-title="Удалить компонент?"
               data-confirm-message="Вы действительно хотите удалить этот компонент?"><span class="glyphicon glyphicon-remove" title="удалить компонент из раздела"></span></a>
        </h4>
        <!-- ///////////////////////////////////////////// ELEMENTS //////////////////////////////////// -->
        <h5><span class="glyphicon glyphicon-th"></span> Элементы:</h5>
        <a href="#" class="btn btn-success" data-toggle="modal"
           data-target="#addElement<?= $comp['latin_name'] ?>"><i class="glyphicon glyphicon-plus"></i> Добавить
            элемент</a><br/><br/>
        <!--   TABLE     -->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <? foreach ($comp['fields'] as $field): ?>
                    <? if ($field['name'] != 'component_id' && $field['name'] != 'section_id'): ?>
                        <th>
                            <?= $field['cyrillic_name'] ?>
                        </th>
                    <? endif ?>
                <? endforeach; ?>
                <th style="">ред.</th>
                <th style="">удал.</th>
            </tr>
            </thead>
            <!-- ////////////////////////////////////////// TBODY //////////////////////////////////// -->
            <? if (!empty($comp['elements'])): ?>
                <tbody>
                <? foreach ($comp['elements'] as $elem): ?>
                <tr>
                    <? foreach ($elem as $name => $el): ?>
                        <? if ( $name == 'section_id'): ?>
                        <? elseif ($name == 'image'): ?>
                            <td><span>
                                    <? if (!empty($el)) { ?>
                                        <? foreach ($el as $img): ?>
                                            <img src="images/small/<?= $img ?>" class="preview_pic" alt=""/>
                                        <? endforeach ?>
                                    <? } ?>
                                </span></td>
                        <?
                        else: ?>
                            <td><span><?= $el ?></span></td>
                        <? endif ?>
                    <? endforeach; ?>
                    <td>
                        <a class="edit-element" data-toggle="modal"
                           data-href="/admin/element/edit/<?= $section_info['id'] ?>/<?= $elem['id'] ?>/<?= $comp['id'] ?>/<?= $comp['latin_name'] ?>"
                           data-target="#editElement<?= $comp['latin_name'] ?>">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </td>
                    <td>
                        <a href="/admin/element/delete/<?= $section_info['id'] ?>/<?= $elem['id'] ?>/<?= $comp['id'] ?>/<?= $comp['latin_name'] ?>"
                           class="delete_item"
                           data-confirm-title="Удалить элемент?"
                           data-confirm-message="Вы действительно хотите удалить этот элемент?">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
                <? endforeach; ?><!-- endforeach $comp['elements']   -->
                </tbody>
            <? endif ?>
            <!--       end elements             -->
        </table>
        <div class="clearfix"></div>
        <!-- ////////////////////////////////////////// MODAL for ADD ///////////////////////////////////////////// -->
        <div class="modal fade" id="addElement<?= $comp['latin_name'] ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Добавить элемент</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Left col -->
                        <div class="box-body">
                            <form
                                action="/admin/element/add/<?= $section_info['id'] ?>/<?= $comp['id'] ?>/<?= $comp['latin_name'] ?>"
                                method="post" class="" enctype="multipart/form-data">
                                <? if (isset($comp['fields'])): ?>
                                    <? foreach ($comp['fields'] as $field): ?>
                                        <!--            FIELDS            -->
                                        <? if ($field['name'] != 'id' && $field['name'] != 'section_id' && $field['name'] != 'component_id') : ?>
                                            <div class="form-group col-md-6">
                                                <label for=""><?= $field['cyrillic_name'] ?></label>
                                                <!--                 FIELDS description                -->
                                                <? if ($field['input_type'] == 'textarea'): ?>
                                                    <textarea name="<?= $field['name'] ?>" id="" cols="30"
                                                              rows="10"></textarea>
                                                    <!--                   file                 -->
                                                <? elseif ($field['input_type'] == 'file_multiple'): ?>
                                                    <input type="file"
                                                           class="form-control" name="<?= $field['name'] ?>[]"
                                                           placeholder="<?= $field['cyrillic_name'] ?>"
                                                           multiple/>
                                                    <!--                  other                  -->
                                                <?
                                                else: ?>
                                                    <input type="<?= $field['input_type'] ?>"
                                                           class="form-control" name="<?= $field['name'] ?>"
                                                           placeholder="<?= $field['cyrillic_name'] ?>"/>
                                                <? endif; ?>
                                            </div>
                                        <? endif ?>
                                        <!--     ///////////////////////// -->
                                    <? endforeach ?>
                                <? endif ?>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" type="submit" name="send">
                                        Добавить <i
                                            class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////////////// MODAL for EDIT ///////////////////////////////////////////// -->
        <div class="modal fade" id="editElement<?= $comp['latin_name'] ?>" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Редактировать элемент</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
<? endif ?>