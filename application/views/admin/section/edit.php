<section class="col-lg-7 connectedSortable">
    <!-- quick email widget -->
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Редактировать  раздел <i class="text-light-blue"><?=$section['name']?></i></h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                        class="fa fa-times"></i></button>
            </div>
            <!-- /. tools -->
        </div>
        <div class="box-body">
            <a href="/admin/section/detail/<?=$section['id']?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Назад в раздел</a><br/><br/>
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
            <? if(isset($mess)): ?>
                <div class="alert alert-<?=$mess_type?>"><?=$mess?></div>
            <? endif ;?>
            <!--   ///////////////////////// EDIT  FORM  /////////////////////////      -->
            <form action="/admin/section/edit/<?=$section['id']?>" method="post" enctype="multipart/form-data">
<!--                1-->
                <div class="form-group">
                    <label for="image">Картинка</label><br/>
                    <? if(!empty($section['image'])):?>
                        <img src="images/small/<?=$section['image']?>" alt=""/>
                    <? endif ?>
                    <input type="file" class="form-control" name="image" value=""/>
                </div>
<!--                2-->
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="name" value="<?=$section['name']?>"/>
                </div>
<!--                3-->
                <div class="form-group">
                    <textarea name="description" class="textarea" placeholder="Описание "
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$section['description']?></textarea>
                </div>
<!--                4-->
                <div class="form-group">
                    <label>Родительский раздел</label>
                    <? if($left_menu['select']):?>
                        <?=$left_menu['select']?>
                    <? endif ?>
                </div>
<!--                5-->
                <div class="box-footer clearfix">
                    <button class="pull-right btn btn-default" type="submit" name="send">Редактировать <i
                            class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</section><!-- /.Left col -->
