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
                <select class="form-control new-field-select" name="input_type" id="" required="">
                    <? if (isset($input_types)): ?>
                        <? foreach ($input_types as $input_type): ?>
                            <option value="<?= $input_type['name'] ?>"><?= $input_type['cyrillic_name'] ?></option>
                        <? endforeach ?>
                    <? endif ?>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="add-option-to-comp-block hidden">
                <div class="form-group col-md-3 new-option-block">
                    <label for="">название опции*</label>
                    <div class="add-option-option">
                        <input type="text" name="option_name[]" class="form-control"/>
                        <span class="glyphicon glyphicon-remove text-red"></span>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="invisible">Добавить опцию</label>
                    <button class="btn btn-sm add-option-to-comp-btn"><span class="glyphicon glyphicon-plus"></span>Добавить опцию</button>
                </div>
                <div class="clearfix"></div>
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
    <th>опции</th>
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
                    <td><? $a = $field['input_type'];if($a == "select" || $a == "radio" || $a == "select_multiple"){  // OPTIONS ?>
                        <span class="opts-vals"><?= isset($field['name1']) ?implode(',', $field['name1']) : ''?></span>
                        <span class="opts-ids hidden"><?= isset($field['id1']) ? implode(',' , $field['id1']) : ''?></span>
                        <span class="hover-tooltip btn btn-xs btn-success add-opt" title="добавить опцию">+</span><br><? }?>
                    </td>
                    <? if ($field['name'] == 'active') { ?>
                        <td></td>
                        <td></td>
                    <? } else { ?>
                        <td>
                            <a href="/admin/componentsList/editField/<?= $field['id'] ?>/<?= $component['latin_name'] ?>"
                               class="glyphicon glyphicon-pencil edit-component-field" title="edit"></a></td>
                        <td>
                            <a href="/admin/componentsList/deleteField/<?= $field['id'] ?>/<?= $field['name'] ?>/<?= $component['id'] ?>/<?= $component['latin_name'] ?>"
                               class="glyphicon glyphicon-remove text-red" title="delete"></a></td>
                    <? } ?>
                </tr>
                <?
                $counter++;
            }
        }; ?>
        </tbody>
    <? endif ?>
</table>
