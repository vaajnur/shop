<section id="aa-product-details">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="aa-product-details-area">
<div class="aa-product-details-content">
    <div class="row">
        <!-- Modal view slider -->
        <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="aa-product-view-slider">
                <div id="demo-1" class="simpleLens-gallery-container">
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
                                <a data-big-image="images/medium/<?= $img['image'] ?>"
                                   data-lens-image="images/<?= $img['image'] ?>" class="simpleLens-thumbnail-wrapper"
                                   href="#">
                                    <img src="images/small/<?= $img['image'] ?>">
                                </a>
                            <? endforeach ?>
                        <? else: ?>
                            <? for ($i = 0; $i < 3; $i++): ?>
                                <a data-big-image="img/view-slider/medium/polo-shirt-1.png"
                                   data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                   class="simpleLens-thumbnail-wrapper" href="#">
                                    <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                </a>
                            <? endfor ?>
                        <? endif ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal view content -->
        <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="aa-product-view-content">
                <h3><?= $element['name'] ?></h3>

                <div class="aa-price-block">
                    <span class="aa-product-view-price"><?= $element['price'] ?> руб.</span>

                    <p class="aa-product-avilability">Наличие: <span><?= $element['available'] ?></span></p>
                </div>
                <p>Описание: <?= $element['description'] ?></p>

                <p>Доступные размеры:</p>

                <form action="#" method="post" class="add-to-cart-form">
                    <div class="aa-prod-view-size">
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
                    </div>
                    <!--<h4>Color</h4>
                    <div class="aa-color-tag">
                        <a href="#" class="aa-color-green"></a>
                        <a href="#" class="aa-color-yellow"></a>
                        <a href="#" class="aa-color-pink"></a>
                        <a href="#" class="aa-color-black"></a>
                        <a href="#" class="aa-color-white"></a>
                    </div>-->
                    <div class="aa-prod-quantity">
                        <p>Доступное количество: </p>
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
                    <p class="aa-prod-category">Категория: <a
                            href="section/detail/<?= $element['section_id'] ?>"><?= $element['section'] ?></a>
                    </p>
                </div>
                <div class="aa-prod-view-bottom">
                    <a class="aa-add-to-cart-btn add-to-cart2" href="/cart/add/<?= $element['id'] ?>">Добавить в
                        корзину</a>
                    <? if (isset($_SESSION['user'])): ?>
                        <a class="aa-add-to-wish-btn" href="wishlist/add/<?= $element['id'] ?>">В желания</a>
                    <? endif ?>
                    <!--                    <a class="aa-add-to-cart-btn" href="#">Сравнить</a>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="aa-product-details-bottom">
    <ul class="nav nav-tabs" id="myTab2">
        <li class="active"><a href="#description" data-toggle="tab" aria-expanded="true">Описание</a></li>
        <li class=""><a href="#review" data-toggle="tab" aria-expanded="false">Отзывы</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade active in" id="description">
            <p><?= $element['description'] ?></p>
        </div>
        <div class="tab-pane fade" id="review">
            <div class="aa-product-review-area">
                <h4>2 Reviews for T-Shirt</h4>
                <ul class="aa-review-nav">
                    <li>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>

                                <div class="aa-product-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star-o"></span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>

                                <div class="aa-product-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star-o"></span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </li>
                </ul>
                <h4>Add a review</h4>

                <div class="aa-your-rating">
                    <p>Your Rating</p>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                </div>
                <!-- review form -->
                <form action="" class="aa-review-form">
                    <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                    </div>

                    <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Related product -->
<div class="aa-product-related-item">
<h3>Related Products</h3>
<ul class="aa-product-catg aa-related-item-slider slick-initialized slick-slider">
<button type="button" data-role="none" class="slick-prev slick-arrow slick-disabled" aria-label="Previous"
        role="button" aria-disabled="true" style="display: block;">Previous
</button>
<!-- start single product item -->
<div aria-live="polite" class="slick-list draggable">
    <div class="slick-track" role="listbox" style="opacity: 1; width: 2392px; left: 0px;">
        <li class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1"
            role="option" aria-describedby="slick-slide00" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="0"><img src="img/man/polo-shirt-2.png"
                                                                     alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="0"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="0">Polo T-Shirt</a></h4>
                    <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50
                        </del></span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="0"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="0"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="0"><span
                        class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-sale" href="#">SALE!</span>
        </li>
        <li class="slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="-1" role="option"
            aria-describedby="slick-slide01" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="0"><img src="img/women/girl-2.png"
                                                                     alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="0"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="0">Lorem ipsum doller</a></h4>
                    <span class="aa-product-price">$45.50</span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="0"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="0"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="0"><span
                        class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
        </li>
        <li class="slick-slide slick-active" data-slick-index="2" aria-hidden="false" tabindex="-1" role="option"
            aria-describedby="slick-slide02" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="0"><img src="img/man/t-shirt-1.png"
                                                                     alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="0"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
            </figure>
            <figcaption>
                <h4 class="aa-product-title"><a href="#" tabindex="0">T-Shirt</a></h4>
                <span class="aa-product-price">$45.50</span>
            </figcaption>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="0"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="0"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="0"><span
                        class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-hot" href="#">HOT!</span>
        </li>
        <li class="slick-slide slick-active" data-slick-index="3" aria-hidden="false" tabindex="-1" role="option"
            aria-describedby="slick-slide03" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="0"><img src="img/women/girl-3.png"
                                                                     alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="0"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="0">Lorem ipsum doller</a></h4>
                    <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50
                        </del></span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="0"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="0"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="0"><span
                        class="fa fa-search"></span></a>
            </div>
        </li>
        <li class="slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1" role="option"
            aria-describedby="slick-slide04" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="-1"><img src="img/man/polo-shirt-1.png"
                                                                      alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="-1"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="-1">Polo T-Shirt</a></h4>
                    <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50
                        </del></span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="-1"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="-1"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="-1"><span
                        class="fa fa-search"></span></a>
            </div>
        </li>
        <li class="slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1" role="option"
            aria-describedby="slick-slide05" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="-1"><img src="img/women/girl-4.png"
                                                                      alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="-1"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="-1">Lorem ipsum doller</a></h4>
                    <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50
                        </del></span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="-1"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="-1"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="-1"><span
                        class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
        </li>
        <li class="slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1" role="option"
            aria-describedby="slick-slide06" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="-1"><img src="img/man/polo-shirt-4.png"
                                                                      alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="-1"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="-1">Polo T-Shirt</a></h4>
                    <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50
                        </del></span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="-1"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="-1"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="-1"><span
                        class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-hot" href="#">HOT!</span>
        </li>
        <li class="slick-slide" data-slick-index="7" aria-hidden="true" tabindex="-1" role="option"
            aria-describedby="slick-slide07" style="width: 244px;">
            <figure>
                <a class="aa-product-img" href="#" tabindex="-1"><img src="img/women/girl-1.png"
                                                                      alt="polo shirt img"></a>
                <a class="aa-add-card-btn" href="#" tabindex="-1"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                <figcaption>
                    <h4 class="aa-product-title"><a href="#" tabindex="-1">This is Title</a></h4>
                    <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50
                        </del></span>
                </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Wishlist" tabindex="-1"><span class="fa fa-heart-o"></span></a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"
                   tabindex="-1"><span class="fa fa-exchange"></span></a>
                <a href="#" data-toggle2="tooltip" data-placement="top" title="" data-toggle="modal"
                   data-target="#quick-view-modal" data-original-title="Quick View" tabindex="-1"><span
                        class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-sale" href="#">SALE!</span>
        </li>
    </div>
</div>
<!-- start single product item -->

<!-- start single product item -->

<!-- start single product item -->

<!-- start single product item -->

<!-- start single product item -->

<!-- start single product item -->

<!-- start single product item -->

<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button"
        style="display: block;" aria-disabled="false">Next
</button>
</ul>
<!-- quick view modal -->
<div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="row">
                    <!-- Modal view slider -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="aa-product-view-slider">
                            <div class="simpleLens-gallery-container" id="demo-1">
                                <div class="simpleLens-container">
                                    <div class="simpleLens-big-image-container">
                                        <a class="simpleLens-lens-image"
                                           data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                            <img src="img/view-slider/medium/polo-shirt-1.png"
                                                 class="simpleLens-big-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="simpleLens-thumbnails-container">
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                    </a>
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                    </a>

                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal view content -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>

                            <div class="aa-price-block">
                                <span class="aa-product-view-price">$34.99</span>

                                <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae
                                repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>

                            <div class="aa-prod-view-size">
                                <a href="#">S</a>
                                <a href="#">M</a>
                                <a href="#">L</a>
                                <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                                <form action="">
                                    <select name="" id="">
                                        <option value="0" selected="1">1</option>
                                        <option value="1">2</option>
                                        <option value="2">3</option>
                                        <option value="3">4</option>
                                        <option value="4">5</option>
                                        <option value="5">6</option>
                                    </select>
                                </form>
                                <p class="aa-prod-category">
                                    Category: <a href="#">Polo T-Shirt</a>
                                </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                                <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To
                                    Cart</a>
                                <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- / quick view modal -->
</div>
</div>
</div>
</div>
</div>
</section>