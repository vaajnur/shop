<? if (isset($element)): ?>
    <ul>
        <? foreach ($element as $elem): ?>
            <li>
                <a class="aa-cartbox-img" href="section/element/<?= $elem['id'] ?>/catalog/1">
                    <? if ($elem['image']): ?>
                        <img src="images/small/<?= $elem['image'][0]['image'] ?>" alt="img">
                    <? else: ?>
                        <img src="img/woman-small-2.jpg" alt="img">
                    <? endif ?>
                </a>

                <div class="aa-cartbox-info">
                    <h4><a href="section/element/<?= $elem['id'] ?>/catalog/1"><?= $elem['name'] ?></a></h4>

                    <p><?= $elem['quantity'] ?> x <?= $elem['price'] ?></p>
                </div>
                <a class="aa-remove-product" href="cart/delete/<?= $elem['id'] ?>"><span class="fa fa-times"></span></a>
            </li>
        <? endforeach; ?>
        <li>
              <span class="aa-cartbox-total-title">
                Сумма
              </span>
              <span class="aa-cartbox-total-price">
                <?= $total_sum?>
              </span>
        </li>
    </ul>
    <a class="aa-cartbox-checkout aa-primary-btn" href="order">Оформить</a>
<? else: ?>
    <p>Пусто!</p>
<? endif ?>