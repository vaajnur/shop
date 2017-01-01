<h3 class="box-title">Элемент</h3>
<br/><br/>
<ul>
    <? if(isset($element)):?>
        <div class="box-body">
        <dl class="dl-horizontal">
        <? foreach ($element as $field=>$elem) { ?>
            <? if($field == "image"): ?>
                <dt><?= $field?></dt>
                <dd>
                    <? if(!empty($elem)):?>
                        <? foreach($elem as $img):?>
                            <img src="images/small/<?= $img ?>" alt=""/>
                        <? endforeach?>
                    <? endif ?>
                </dd>
                <? else:?>
                    <dt><?= $field?></dt>
                    <dd><?= $elem ?></dd>
            <? endif ?>
        <? } ?>
        </dl>
        </div>
    <? endif ?>
</ul>