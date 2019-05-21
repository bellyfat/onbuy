<menu class="row nav-catalog list-unstyled">
<? foreach ($category_items as $item): ?>
<li class="col-xs-12 col-sm-6">
    <a href="/catalog/<?=$item['id'];?>" class="unstyled">
        <img src="img/category/<?=isset($item['image']) ? $item['image']: 'category_default.jpg';?>" alt="<?=$item['name'];?>"/>
        <span><?=$item['name'];?></span>
    </a>
</li>
<? endforeach; ?>
</menu>
