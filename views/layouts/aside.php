<div class="row">
    <aside class="col-md-3 hidden-xs hidden-sm">
        <div class="left-menu">
            <a href="#catalog-menu" class="btn btn-primary btn-lg" data-toggle="collapse">Каталог</a>
            <div id="catalog-menu" class="collapse">
                <? foreach ($menu as $category): ?>
                <div class="panel">
                    <a href="#category<?=$category['id'];?>" class="btn btn-link btn-lg" data-toggle="collapse" data-parent="#catalog-menu" <?=$category['id']==$current ? 'aria-expanded="true"': '';?>><?=$category['name'];?></a>
                    <div id="category<?=$category['id'];?>" class="collapse<?=$category['id']==$current ? ' in': '';?>">
                        <ul class="list-unstyled">
                            <? foreach ($menu_items as $item): ?>
                            <? if($item['category_id'] == $category['id']): ?>
                            <li <?=$item['id']==$current_item ? 'class="active"' : '';?>>
                                <a href="/catalog/<?=$item['id'];?>"><?=$item['name'];?></a>
                            </li>
                            <? endif; ?>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </div>
                <? endforeach; ?>
            </div>
        </div>
    </aside>
    <div class="col-xs-12 col-md-9">
        <? if(isset($pagetitle)): ?>
        <h1 class="text-center page-title"><?=$pagetitle;?></h1>
        <? endif; ?>
        <?=$content;?>
    </div>
</div>
