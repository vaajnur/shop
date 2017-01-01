<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="aa-product-view-slider">
                        <div class="simpleLens-gallery-container" id="demo-1">
                            <div class="simpleLens-container">
                                <div class="simpleLens-big-image-container">
                                    <? if (!empty($element['image'])): ?>
                                        <a data-lens-image="images/<?= $element['image'][0]['image'] ?>"
                                           class="simpleLens-lens-image">
                                            <img src="images/medium/<?= $element['image'][0]['image'] ?>"
                                                 class="simpleLens-big-image">
                                        </a>
                                    <? else: ?>
                                        <a data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                           class="simpleLens-lens-image">
                                            <img src="img/view-slider/medium/polo-shirt-3.png" class="simpleLens-big-image">
                                        </a>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="simpleLens-thumbnails-container">
                                <? if (!empty($element['image'])): ?>
                                    <? foreach ($element['image'] as $img): ?>
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="images/<?= $img['image'] ?>"
                                       data-big-image="images/medium/<?= $img['image'] ?>">
                                        <img src="images/small/<?= $img['image'] ?>">
                                    </a>
                                    <? endforeach ?>
                                <? else: ?>
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                    </a>
                                <? endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="aa-product-view-content">
                        <h3><?=$element['name']?></h3>
                        <div class="aa-price-block">
                            <span class="aa-product-view-price"><?=$element['price']?> руб.</span>
                            <p class="aa-product-avilability">Наличие: <span><?=$element['available']?></span></p>
                        </div>
                        <p>Описание: <?=$element['description']?></p>
                        <h4>Размер</h4>
                        <form action="#" method="post" class="add-to-cart-form">
                        <div class="aa-prod-view-size">
                            <? foreach ($element['fields'] as $field): ?>
                                <? if ($field['name'] == "size") { ?>
                                    <div class="radio">
                                        <? if (!empty($element['avail_fields']["size"][0])) {
                                            foreach ($element['avail_fields']["size"] as $key => $val) {
                                                ?>
                                                <label class="radio-inline" for="rad<?= $val['id'] ?>"><input
                                                        type="radio"
                                                        class=""
                                                        value="<?= $val['id'] ?>"
                                                        id="rad<?= $val['id'] ?>"
                                                        name="<?= $field ?>"/><?= $val['name'] ?>
                                                </label>
                                            <?
                                            }
                                        } ?>
                                    </div>
                                <? } ?>
                            <? endforeach ?>
                        </div>
                        <div class="aa-prod-quantity">
                            <label for="">Доступное количество:</label>
                            <? if (!empty($element['avail_fields']['quantity'])): ?>
                                <select class="form-control" name="quantity" id="">
                                    <? foreach ($element['fields'] as $field3) {
                                        if ($field3['name'] == 'quantity') {
                                            foreach ($field3['name1'] as $key => $name1) {
                                                if ($name1 <= $element['avail_fields']['quantity'][0]['name']) {
                                                    ?>
                                                    <option value="<?= $field3['id1'][$key] ?>"><?= $name1 ?></option>
                                                <?
                                                }
                                            }
                                        }
                                    } ?>
                                </select>
                            <? endif ?>
                        </div>
                        </form>
                        <div class="aa-prod-quantity">
                            <p class="aa-prod-category">Категория: <a href="section/detail/<?= $element['section_id']?>"><?= $element['section']?></a>
                            </p>
                        </div>
                        <div class="aa-prod-view-bottom">
                            <a class="aa-add-to-cart-btn add-to-cart2" href="/cart/add/<?= $element['id']?>">Добавить в корзину</a>
                            <a href="section/element/<?= $element['id'] ?>/<?= $component_name ?>/<?= $component_id ?>" class="aa-add-to-cart-btn">Детально</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->