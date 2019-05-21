<? if(isset($term)): ?>
    <p class="h5 login">По запросу: <b class="text-success"><?=$term;?></b> <?=$count>0 ? 'найдено товаров: <b>'.$count.'</b>' : 'товаров не найдено';?></p>
    <? if($count > 0): ?>
    <div class="row catalog" id="catalog"></div>
        <? if($count > $perpage): ?>
        <div class="more text-right">
            <button class="btn btn-success" id="more" onclick="displaySearchMore('<?=$term;?>', <?=$perpage;?>, <?=$count;?>)">Показать еще</button>
        </div>
        <? endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        renderSearchCatalog('<?=$term;?>');
    });
</script>
    <? endif; ?>
<? endif; ?>
