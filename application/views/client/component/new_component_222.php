
                <? if (!empty($comp['elements'])): ?>
                    <? foreach ($comp['elements'] as $elem): ?>
                        <? if (isset($elem['image'][0])): ?>
                            <img src="images/medium/<?= $elem['image'][0] ?>" alt="">
                        <? endif ?>
                        <? foreach ($elem as $key => $el): ?>
                            <? if($key != "id" && $key != "section_id" && $key != "active" && $key != "image"): ?>
                                <p><?= $el ?></p>
                            <? endif ?>
                        <? endforeach ?>
                    <? endforeach ?>
                <? endif ?>
                