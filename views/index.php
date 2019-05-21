<div id="carousel" class="carousel slide row" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="img/slide1.png" alt=""/>
        </div>
        <div class="item">
            <img src="img/slide2.png" alt=""/>
        </div>
        <div class="item">
            <img src="img/slide3.png" alt=""/>
        </div>
    </div>
</div>
<div class="row merit">
    <div class="col-xs-6 col-sm-6 col-md-3">
        <a href="#" class="unstyled">
            <div class="valign-wrapper">
                <i class="fa gift" aria-hidden="true"></i>
                Акции и скидки
            </div>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3">
        <a href="#" class="unstyled">
            <div class="valign-wrapper">
                <i class="fa save" aria-hidden="true"></i>
                 Гарантия качества и свежести
            </div>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3">
        <a href="#" class="unstyled">
            <div class="valign-wrapper">
                <i class="fa time" aria-hidden="true"></i>
                Экономия времени
            </div>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3">
        <a href="#" class="unstyled">
            <div class="valign-wrapper">
                <i class="fa care" aria-hidden="true"></i>
                 Быстрая доставка
            </div>
        </a>
    </div>
</div>
<section class="row video-catalog">
    <h2 class="lineback"><span class="h1">Каталог</span></h2>                       
    <div class="col-xs-12 col-md-4">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <a href="/category/5" class="catalog-section">
                    <div class="caption">
                        <p>Бакалея</p>
                    </div>
                    <video loop>
                        <source src="/video/grocery.mp4" type="video/mp4">
                    </video>
                </a>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <a href="/category/6" class="catalog-section">
                    <div class="caption">
                        <p>Хлебобулочные изделия</p>
                    </div>
                    <video loop>
                        <source src="/video/bread.mp4" type="video/mp4">
                    </video>
                </a>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-8">
        <a href="/category/1" class="catalog-section">
            <div class="caption">
                <p>Мясная продукция</p>
            </div>
            <video loop>
                <source src="/video/meat.mp4" type="video/mp4">
            </video>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-4">
        <a href="/category/3" class="catalog-section">
            <div class="caption">
                <p>Сыры и колбасы</p>
            </div>
            <video loop>
                <source src="/video/sausage.mp4" type="video/mp4">
            </video>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-4">
        <a href="/category/8" class="catalog-section">
            <div class="caption">
                <p>Фрукты и овощи</p>
            </div>
            <video loop>
                <source src="/video/veggie.mp4" type="video/mp4">
            </video>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-4">
        <a href="/category/4" class="catalog-section">
            <div class="caption">
                <p>Молочные продукты, яйца</p>
            </div>
            <video loop>
                <source src="/video/dairy.mp4" type="video/mp4">
            </video>
        </a>
    </div>
</section>
<section class="row showcase">
    <h2 class="lineback"><span class="h1">Хиты продаж</span></h2>
    <div class="offer-panel">
        <? foreach($hits as $product): ?>
        <div class="col-xs-6 col-sm-4 col-xl-1 catalog-item">
            <div class="text-center">
                <a href="/product/<?=$product['id'];?>">
                    <div class="item-image">
                        <img src="<?=!empty($product['image'])?'img/products/'.$product['image']:'img/no-thumb.png';?>" alt="<?=$product['name'];?>" class="product-image" />
                    </div>
                    <div class="item-name">
                        <p><?=$product['name'];?></p>
                        <p class="text-muted small"><?=$product['volume'];?></p>
                    </div>
                    <div class="item-price"><?=$product['price'];?></div>
                </a>
            </div>
        </div>
        <? endforeach; ?>
    </div>
</section>
<section class="row about">
    <h2 class="lineback"><span class="h1">О компании</span></h2>
    <div class="col-xs-12">
        <p>Onbuy - это всегда свежие продукты.</p>
        <p>Onbuy - это гарантия качества на каждом этапе работы.</p>
        <p>Onbuy - это ассортимент и индивидуальный подход для каждого покупателя.</p>
        <p>В Он Бай Клаб вы всегда найдете всё необходимое для вашего дома или офиса. В нашем онлайн-гипермаркете огромный выбор продуктов, напитков, свежих овощей и фруктов.</p>
        <p>Для корпоративных клиентов мы так же предлагаем широкий ассортимент канцелярских и офисных товаров.</p>
        <p>Нашими клиентами уже являются тысячи жителей Москвы.</p>
        <p>Мы в Onbuy.club очень ответственно подходим к формированию и доставке каждого заказа. Наши специалисты проходят профессиональное обучение для того, чтобы уделять максимум внимания вашим покупкам. Наши водители имеют большой  опыт перевозки и транспортировки ценных грузов для того чтобы подойти к своей работе с полной ответственностью.</p>
        <p>Дополнительной гарантией качества, является репутация нашего официального партнера – международной немецкой корпорации METRO Cash	&amp;Carry.</p>
        <p>Нас выбирают не просто так. Нас выбирают за наши преимущества.</p>
    </div>   
</section>