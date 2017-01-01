<!-- product category -->
<section id="aa-product-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                <div class="aa-product-catg-content">
                    <h1><?= $section_info['name'] ?></h1>
                    <? if (!empty($sub_sections)): ?>
                        <h3>Подкатегории: </h3>
                        <? foreach ($sub_sections as $sub): ?>
                            <div class="col-md-4 col-sm-4">
                                <article class="aa-blog-content-single">
                                    <h4><a href="section/category/<? echo($sub['id']); ?>"><? echo($sub['name']); ?></a>
                                    </h4>
                                    <figure class="aa-blog-img">
                                        <a href="section/category/<? echo($sub['id']); ?>">
                                            <? if (isset($sub['image'])): ?>
                                                <img src="images/medium/<?= $sub['image'] ?>" alt="fashion img" class="w300_h200">
                                                <? else: ?>
                                                <img src="img/fashion/3.jpg" alt="fashion img">
                                            <? endif ?>
                                        </a>
                                    </figure>
                                    <p><? echo($sub['description']); ?></p>
                                </article>
                            </div>
                        <? endforeach; ?>
                    <? endif; ?>
                    <? if (!empty($components)): ?>
                        <? foreach ($components as $key => $comp): ?>
                            <? include("application/views/client/component/{$comp['latin_name']}.php"); ?>
                        <? endforeach; ?>
                    <? endif ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                <aside class="aa-sidebar">
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Категории</h3>
                        <?= $left_menu['ul_category'] ?>
                    </div>
                    <? if (!empty($components)): ?>
                    <div class="aa-sidebar-widget">
                        <h3>Фильтровать по цене</h3>
                        <!-- price range -->
                        <div class="aa-sidebar-price-range">
                            <form action="">
                                <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                                </div>
                                <span id="skip-value-lower" class="example-val">30.00</span>
                                <span id="skip-value-upper" class="example-val">100.00</span>
                                <button class="aa-filter-btn" type="submit">Filter</button>
                            </form>
                        </div>
                    </div>
                    <? endif ?>
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Недавно просмотренные</h3>

                        <div class="aa-recently-views">
                            <ul>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>

                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>

                                        <p>1 x $250</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Самые популярные</h3>

                        <div class="aa-recently-views">
                            <ul>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>

                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>

                                        <p>1 x $250</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>

        </div>
    </div>
</section>
<!-- / product category -->
