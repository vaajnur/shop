<? if (!empty($comp['elements'])): ?>
<article class="aa-blog-content-single">
<? foreach ($comp['elements'] as $elem): ?>
    <h2><?= $elem['title'] ?></h2>
        <? if(isset($elem['image'])){ ?>
            <? foreach($elem['image'] as $img){ ?>
            <figure class="aa-blog-img">
                <img src="images/medium/<?= $img ?>" alt=""/>
            </figure>
            <? } ?>
        <? } ?>
        <p><?= $elem['content'] ?></p>
    <? endforeach; ?>
</article>
<? endif ?>
