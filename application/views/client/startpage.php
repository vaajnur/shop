<!-- wpf loader Two -->
<div id="wpf-loader-two">
    <div class="wpf-loader-two-inner">
        <span>Loading</span>
    </div>
</div>
<!-- / wpf loader Two -->
<? if (!empty($components)): ?>
    <? foreach ($components as $key => $comp): ?>
        <? include("application/views/client/component/{$comp['latin_name']}.php"); ?>
    <? endforeach; ?>
<? endif ?>