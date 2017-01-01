<!-- Cart view section -->
<section id="cart-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table aa-wishlist-table">
                        <form action="cart/update" method="post">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Stock Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? if (isset($element)): ?>
                                        <? $counter = 1?>
                                        <? foreach ($element as $el): ?>

                                            <tr>
                                                <td><?= $counter?></td>
                                                <td><a class="remove" href="wishlist/delete/<?= $el['id'] ?>"><fa class="fa fa-close"></fa></a></td>
                                                <td><a href="section/element/<?= $el['id']?>/catalog/1">
                                                        <? if (!empty($el['image'])): ?>
                                                            <img src="images/small/<?= $el['image']['image'] ?>" alt="img">
                                                        <? else: ?>
                                                            <img src="img/man/polo-shirt-1.png" alt="img">
                                                        <? endif ?>
                                                    </a></td>
                                                <td><a class="aa-cart-title" href="section/element/<?= $el['id']?>/catalog/1"><?= $el['name'] ?></a></td>
                                                <td><?= $el['price'] ?></td>
                                                <td>In Stock</td>
                                                <td><a href="cart/add/<?= $el['id'] ?>" class="aa-add-to-cart-btn add-to-cart2">Добавить в корзину</a></td>
                                            </tr>
                                            <? $counter++?>
                                        <? endforeach ?>
                                    <? endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->