<div class="aa-product-catg-head">
    <div class="aa-product-catg-head-left">
        <!--<form action="" class="aa-sort-form">
            <label for="">Sort by</label>
            <select name="">
                <option value="1" selected="Default">Default</option>
                <option value="2">Name</option>
                <option value="3">Price</option>
                <option value="4">Date</option>
            </select>
        </form>
        <form action="" class="aa-show-form">
            <label for="">Show</label>
            <select name="">
                <option value="1" selected="12">12</option>
                <option value="2">24</option>
                <option value="3">36</option>
            </select>
        </form>-->
    </div>
    <div class="aa-product-catg-head-right">
        <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
        <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
    </div>
</div>
<div class="aa-product-catg-body">
    <ul class="aa-product-catg">
        <? if (!empty($comp['elements'])): ?>
            <? foreach ($comp['elements'] as $elem): ?>
                <!--                --><? // if ($elem['active'] != true): ?>
                <!-- start single product item -->
                <li>
                    <figure>
                        <a class="aa-product-img"
                           href="section/element/<?= $elem['id'] ?>/<?= $comp['latin_name'] ?>/<?= $comp['id'] ?>">
                            <? if (isset($elem['image'][0])): ?>
                                <img src="images/medium/<?= $elem['image'][0] ?>" alt="">
                            <? else: ?>
                                <img src="img/women/girl-1.png" alt="polo shirt img">
                            <? endif ?></a>
                        <!--<a class="aa-add-card-btn add-to-cart2" href="/cart/add/<?/*= $elem['id'] */?>"><span
                                class="fa fa-shopping-cart"></span>Добавить в корзину</a>-->
                        <figcaption>
                            <h4 class="aa-product-title"><a
                                    href="section/element/<?= $elem['id'] ?>"><?= $elem['name'] ?></a>
                            </h4>
                            <span class="aa-product-price"><?= $elem['price'] ?> руб.</span><span class="aa-product-price"><del>
                                    $65.50
                                </del></span>
                            <p class="aa-product-descrip"><?= $elem['description'] ?></p>
                        </figcaption>
                    </figure>
                    <div class="aa-product-hvr-content">
                        <? if(isset($_SESSION['user'])):?>
                        <a href="wishlist/add/<?= $elem['id'] ?>" data-toggle="tooltip" data-placement="top"
                           title="Добавить в список желаний" class="add-to-wishlist"><span
                                class="fa fa-heart-o"></span></a>
                        <? endif ?>
<!--                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span-->
<!--                                class="fa fa-exchange"></span></a>-->
                        <a class="cat_quick_mod" href="section/element/<?= $elem['id'] ?>/<?= $comp['latin_name'] ?>/<?= $comp['id'] ?>/1" data-toggle2="tooltip" data-placement="top" title="быстрый просмотр" data-toggle="modal"
                           data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                    </div>
                    <!-- product badge -->
<!--                    <span class="aa-badge aa-sale" href="#">SALE!</span>-->
                </li>
                <!--     active           --><? // endif; ?>
            <? endforeach; ?>
        <? endif ?>
    </ul>
    <div class="clearfix"></div>
    <!--   /////////////// PAGINATION                 -->
    <div class="aa-product-catg-pagination">
        <nav>
            <ul class="pagination">
                <? if($page != 1): ?>
                    <li>
                        <a href="<?= $url ?>/<?= $page-1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <? endif ?>
                <? if(isset($pagination)): ?>
                    <? foreach($pagination as $pages):?>
                        <li><a href="<?= $url?>/<?= $pages ?>"><?= $pages ?></a></li>
                    <? endforeach ?>
                <? endif ?>
                <? if($page <$pages):?>
                    <li>
                        <a href="<?= $url ?>/<?= $page+1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <? endif ?>
            </ul>
        </nav>
    </div>
    <!-- quick view modal -->
    <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

    </div>
</div>