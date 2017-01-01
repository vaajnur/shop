<h3 class="box-title">Компонент <i class="text-light-blue"><?= $component['name'] ?></i></h3>
<p><?= $component['description'] ?></p>
<? if (isset($mess)): ?>
    <div class="alert alert-<?= $mess_type ?>"><?= $mess ?></div>
<? endif; ?>
<div class="box box-success pull-left width_auto">
    <div class="box-header">
        <h3 class="box-title">Добавить поле</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                    class="fa fa-times"></i></button>
        </div>
        <!-- /. tools -->
    </div>
    <div class="box-body">
        <form action="admin/componentsList/component/<?= $component['id'] ?>/<?= $component['latin_name'] ?>"
              method="post" class="form-inline">
            <div class="form-group">
                <label for="">Field name*</label>
                <input type="text" class="form-control" name="name" value="" required=""/>
            </div>
            <div class="form-group">
                <label for="">Название поля*</label>
                <input type="text" class="form-control" name="cyrillic_name" value="" required=""/>
            </div>
            <div class="form-group">
                <label for="">Тип поля*</label><br/>
                <select class="form-control" name="input_type" id="" required="">
                    <? if (isset($input_types)): ?>
                        <? foreach ($input_types as $input_type): ?>
                            <option value="<?= $input_type['name'] ?>"><?= $input_type['cyrillic_name'] ?></option>
                        <? endforeach ?>
                    <? endif ?>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="invisible">доб</label><br/>
                <button type="submit" name="send" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>
                    Добавить поле
                </button>
            </div>
        </form>
    </div>
</div>
<br/><br/>
<table class="table table-bordered table-striped">
    <thead>
    <th>№</th>
    <th>field</th>
    <th>поле</th>
    <th>тип</th>
    <th>ред.</th>
    <th>удал.</th>
    </thead>
    <? if (isset($fields)): ?>
        <tbody>
        <? $counter = 1;
        foreach ($fields as $field) {
            if ($field['name'] != 'id' && $field['name'] != 'section_id' && $field['name'] != 'component_id') {
                ?>
                <tr>
                    <td><?= $counter; ?></td>
                    <td><?= $field['name'] ?></td>
                    <td><?= $field['cyrillic_name'] ?></td>
                    <td><?= $field['input_type'] ?></td>
                    <? if ($field['name'] == 'active') { ?>
                        <td></td>
                        <td></td>
                    <? } else { ?>
                        <td>
                            <a href="/admin/componentsList/editField/<?= $field['id'] ?>/<?= $component['latin_name'] ?>"
                               class="glyphicon glyphicon-pencil edit-component-field" title="edit"></a></td>
                        <td>
                            <a href="/admin/componentsList/deleteField/<?= $field['id'] ?>/<?= $field['name'] ?>/<?= $component['id'] ?>/<?= $component['latin_name'] ?>"
                               class="glyphicon glyphicon-remove" title="delete"></a></td>
                    <? } ?>
                </tr>
                <?
                $counter++;
            }
        }; ?>
        </tbody>
    <? endif ?>
</table>
