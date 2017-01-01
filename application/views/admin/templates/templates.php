<h3>Шаблоны</h3>
<? if ($data): ?>
    <ul>
        <? foreach ($data as $template): ?>
            <li><?= $template['name'] ?></li>
        <? endforeach; ?>
    </ul>
<? endif ?>