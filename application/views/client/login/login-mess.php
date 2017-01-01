<? if (isset($mess)): ?>
    <div class="alert alert-<?= $mess_type ?>"><?= $mess ?></div>
    <? if (isset($reload)): ?>
        <script>
            setTimeout(
                function () {
                    window.location = window.location
                }, 1000
            )
        </script>
    <? endif ?>
<? endif ?>