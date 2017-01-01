<form
    action="/admin/element/edit/<?= $section_id ?>/<?= $elem_id ?>/<?= $component_id ?>/<?= $component_name ?>"
    method="post" class="" enctype="multipart/form-data">
    <? if (isset($fields)): ?>
        <? foreach ($fields as $field): ?>
            <? if ($field['name'] == 'section_id') : ?>
                <!--            section id / component id hidden            -->
                <input type="hidden" name="<?= $field['name'] ?>"
                       value="<?= $section_id ?>"/>
            <? elseif ($field['name'] == 'component_id'): ?>
                <input type="hidden" name="<?= $field['name'] ?>"
                       value="<?= $component_id ?>"/>
            <? endif ?>
            <!--            FIELDS            -->
            <? if ($field['name'] != 'id' && $field['name'] != 'section_id' && $field['name'] != 'component_id') : ?>
                <div class="form-group col-lg-<?= $field['input_type'] == 'textarea' ? '12' : '6' ?>">
                    <label for=""><?= $field['cyrillic_name'] ?></label>
                    <!--                 FIELDS description                -->
                    <? if ($field['input_type'] == 'textarea'): ?>
                        <textarea name="<?= $field['name'] ?>" id="" cols="30"
                                  rows="10"><?= $element[$field['name']] ?></textarea>
                        <!--                   file                 -->
                    <? elseif ($field['input_type'] == 'file_multiple'): ?>
                        <? if (!empty($element[$field['name']])) { ?>
                            <p class="text-orange">удалить отмеченные</p>
                            <? foreach ($element[$field['name']] as $img) { ?>
                                <img class="small_pic2" src="images/small/<?= $img['image'] ?>" alt=""/>
                                <input type="checkbox" name="img_to_delete[]" value="<?= $img['id'] ?>"/>
                            <? } ?>
                        <? } ?>
                        <input type="file"
                               class="form-control" name="<?= $field['name'] ?>[]"
                               placeholder="<?= $field['cyrillic_name'] ?>"
                               multiple/>
                        <!--                   select_multiple OR select                 -->
                    <?
                    elseif ($field['input_type'] == 'select_multiple' || $field['input_type'] == 'select'): ?>
                        <select class="form-control" name="<?= $field['name'] ?><?= $field['input_type'] == 'select' ? '"' : '[]"' . 'multiple' ?> id="">
                            <? if (!empty($field['name1'])) {
                                foreach ($field['id1'] as $key => $id1) {
                                    ?>
                                    <option value="<?= $id1 ?>"
                                        <?= in_array($id1, explode(',' , $element[$field['name']])) ? 'selected' : '' ?>
                                        ><?= $field['name1'][$key] ?></option>
                                <? }
                            } ?>
                        </select>
                        <!--                   radio                 -->
                        <? elseif
                        ($field['input_type'] == 'radio'): ?>
                        <div class="radio">
                            <? if (!empty($field['name1'])) {
                            foreach ($field['id1'] as $key => $id1) {
                            ?>
                            <label for=""><input type="<?= $field['input_type'] ?>" class="form-control" value="<?= $id1 ?>" name="<?= $field['name'] ?>"
                                <?= $element[$field['name']] == $id1? 'checked' : '' ?>
                                    /><?= $field['name1'][$key] ?></label>
                            <? }
                            } ?>
                        </div>
                        <!--                  other                  -->
                    <?
                    else: ?>
                        <input type="<?= $field['input_type'] ?>"
                               class="form-control" name="<?= $field['name'] ?>"
                               placeholder="<?= $field['cyrillic_name'] ?>"
                               value="<?= $element[$field['name']] ?>"/>
                    <? endif; ?>
                </div>
                <!--     ///////////////////////// -->
            <? endif ?>
        <? endforeach ?>
    <? endif ?>
    <div class="box-footer clearfix">
        <button class="pull-right btn btn-info" type="submit" name="send">
            Редактировать <i
                class="fa fa-arrow-circle-right"></i></button>
    </div>
</form>