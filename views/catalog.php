<div class="catalog-header">
    <div class="nav-back visible-sm visible-xs">
        <a href="/category/<?=$category;?>" class="unstyled">Назад</a>
    </div>
    <h1 class="text-center page-title"><?=$category_name;?></h1>
    <div class="filter text-right dropdown">
        <div>
            <button role="button" data-toggle="dropdown" data-target="#" class="btn btn-danger" title="Сортировка"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></button>
            <div class="dropdown-menu">
                <div class="dropdown-body">
                    <button type="button" class="close" data-toggle="dropdown" aria-hidden="true">&times;</button>
                    <div class="col-xs-6">
                        <p>
                            <span class="btn-sm">По алфавиту</span>
                        </p>
                        <p>
                            <a href="/catalog/<?=$category_item;?>/?sort=name" title="А-Я" class="btn btn-link sort <?=$sort=='name'? 'current' : '';?>"><i class="fa fa-long-arrow-down" aria-hidden="true"></i>А</a>
                            <a href="/catalog/<?=$category_item;?>/?sort=inverse" title="Я-А" class="btn btn-link sort <?=$sort=='inverse'? 'current' : '';?>"><i class="fa fa-long-arrow-down" aria-hidden="true"></i>Я</a>
                        </p>
                    </div>
                    <div class="col-xs-6">
                        <p>
                            <span class="btn-sm">По цене</span>
                        </p>
                        <p>
                            <a href="/catalog/<?=$category_item;?>/?sort=price" title="По возрастанию" class="btn btn-link sort <?=$sort=='price'? 'current' : '';?>"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></a>
                            <a href="/catalog/<?=$category_item;?>/?sort=reduct" title="По убыванию" class="btn btn-link sort <?=$sort=='reduct'? 'current' : '';?>"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></a>
                        </p>
                    </div>
                </div>                                          
            </div>
        </div>
    </div>
</div>
<div class="row catalog" id="catalog"></div>
<? if($total > $perpage): ?>
<div class="more text-right">
    <button class="btn btn-success" id="more" onclick="displayMore(<?=$category_item;?>, '<?=$sort;?>', <?=$perpage;?>, <?=$total;?>)">Показать еще</button>
</div>
<? endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        renderCatalog(<?=$category_item;?>, '<?=$sort;?>');
    });
</script>
