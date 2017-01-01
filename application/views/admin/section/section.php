<h3 class="box-title">Список разделов</h3>
<a href="/admin/section/add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Добавить раздел</a>
<br/><br/>
<? if(isset($mess)): ?>
    <div class="alert alert-<?=$mess_type?>"><?=$mess?></div>
<? endif ;?>
<table class="table table-bordered table-hover col-lg-12">
    <thead>
    <tr>
        <th>id</th>
        <th class="th_image">Картинка</th>
        <th>Название раздела</th>
        <th>Связанный компонент</th>
        <th>Родительский раздел</th>
        <th>Шаблон</th>
        <th>Описание</th>
        <th>ред.</th>
        <th>удал.</th>
    </tr>
    </thead>
    <? if (!empty($sections)): ?>
        <tbody>
        <? foreach ($sections as $section): ?>
            <tr>
                <td><?= $section['sid'] ?></td>
                <td><? if(!empty($section['s_image'])): ?><img src="images/small/<?= $section['s_image'] ?>" alt=""/><? endif ?></td>
                <td><a href="admin/section/detail/<?= $section['sid'] ?>"><?= $section['s_name'] ?></a></td>
                <td><?= $section['c_name'] ?></td>
                <td><?= $section['s2_name'] ?></td>
                <td><?= $section['t_name'] ?></td>
                <td><?= $section['s_description'] ?></td>
                <td>
                    <a href="/admin/section/edit/<?= $section['sid'] ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
                <td>
                    <a href="/admin/section/delete/<?= $section['sid'] ?>" class="delete_item"
                       data-confirm-title="Удалить раздел <?= $section['s_name'] ?>?"
                       data-confirm-message="Вы действительно хотите удалить раздел <?= $section['s_name'] ?>?">
                        <span class="glyphicon glyphicon-trash text-orange"></span>
                    </a>
                </td>
            </tr>
        <? endforeach ?>
        </tbody>
    <? endif ?>
</table>
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>Удалить?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_this">Save changes</button>
            </div>
        </div>
    </div>
</div>