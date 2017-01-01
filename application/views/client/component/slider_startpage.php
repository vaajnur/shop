<? if (!empty($comp['elements'])): ?>
    <!-- Start slider -->
    <section id="aa-slider">
        <div class="aa-slider-area">
            <div id="sequence" class="seq">
                <div class="seq-screen">
                    <ul class="seq-canvas">
                        <!-- single slide item -->
                        <? foreach ($comp['elements'] as $elem): ?>

                            <li>
                                <div class="seq-model">
                            <? if (isset($elem['image'][0])): ?>
                                <img data-seq src="images/<?= $elem['image'][0] ?>" alt="Men slide img"/>
                                <? else: ?>
                                <img data-seq src="img/slider/1.jpg" alt="Men slide img"/>
                            <? endif ?>
                                </div>
                                <div class="seq-title">
<!--                                    <span data-seq>Save Up to 75% Off</span>-->

                                    <h2 data-seq><?= $elem['name'] ?></h2>

                                    <p data-seq><?= $elem['subtitle'] ?></p>
<!--                                    <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>-->
                                </div>
                            </li>

                        <? endforeach ?>
                    </ul>
                </div>
                <!-- slider navigation btn -->
                <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                    <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                    <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
                </fieldset>
            </div>
        </div>
    </section>
    <!-- / slider -->
<? endif ?>
