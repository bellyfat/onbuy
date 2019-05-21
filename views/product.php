<div class="row">
    <div class="col-xs-12 col-xl-2 nav-back">
        <a href="/catalog/<?=$product->subcategory;?>" class="unstyled">Назад</a>
    </div>
    <div class="col-xs-12 col-xl-3">
        <h1 class="tovar-name"><?=$product->name;?></h1>
    </div>
</div>
<div class="col-xs-12 col-xl-2 lineright">
    <div class="tovar-card center-block">                                        
        <div class="tovar-image">
            <? if(!empty($product->image)): ?>
            <img src="img/products/<?=$product->image;?>" alt="<?=$product->name;?>" class="product-image" data-zoom-image="img/products/<?=$product->image;?>"/>
            <? else: ?>
            <img src="img/no-thumb.png" alt="" class="product-image"/>
            <? endif; ?>
        </div>
        <div class="tovar-price text-center">
            <span><?=$product->price;?> &#8381;</span>
        </div>
    </div>
    <div class="lineback hidden-xs hidden-sm"></div>
    <div class="col-xs-12 text-center tovar-buy">
        <div class="count">
            <button class="minus btn btn-default btn-round"></button>
            <input type="text" name="quantity" class="form-control number" value="1" />
            <button class="plus btn btn-default btn-round"></button>
        </div>
        <button class="btn btn-primary btn-lg text-uppercase" data-id="<?=$product->id;?>" data-action="buy">Купить</button>
    </div>
</div>
<div class="col-xs-12 col-xl-3 lineleft">
    <div class="tovar-card">
        <div class="tovar-nav">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#description" class="btn btn-info btn-lg" data-toggle="tab">Описание</a></li>
                <li><a href="#composition" class="btn btn-info btn-lg" data-toggle="tab">Состав</a></li>
                <li><a href="#payment" class="btn btn-info btn-lg" data-toggle="tab">Оплата</a></li>
                <li><a href="#delivery" class="btn btn-info btn-lg" data-toggle="tab">Доставка</a></li>
            </ul>
        </div>
        <div class="scroll-area tab-content">                                            
            <div class="tab-pane" id="description">
                <? if(!empty($product->description)): ?>
                <p><?=$product->description;?></p>
                <? endif; ?>
            </div>
            <div class="tab-pane" id="composition">
                <div class="tovar-table">
                    <div>
                        <div>Объём / вес</div>
                        <div><?=$product->volume;?></div>
                    </div>
                    <? if(!empty($product->composition)): ?>
                    <div>
                        <div>Состав</div>
                        <div><?=$product->composition;?></div>
                    </div>
                    <? endif; ?>
                </div>
            </div>
            <div class="tab-pane" id="payment">
                <? if($min_amount > 0): ?>
                <p class="text-danger h5">Минимальная сумма заказа - <?=$min_amount;?> руб.</p>
                <? endif; ?>
                <p class="h5"><b>Способы оплаты Ваших покупок:</b></p>
                <ul class="pull-left">
                    <li>
                        Картой на сайте
                    </li>
                </ul>
                <div class="cards">
                    <a href="/info/payment" target="_blank" title="Картой Visa">
                        <img src="img/visa.png" alt="Картой Visa" class="center-block img-responsive"/>
                    </a>
                    <a href="/info/payment" target="_blank" title="Картой Mastercard">
                        <img src="img/mastercard.png" alt="Картой Mastercard" class="center-block img-responsive"/>
                    </a>
                    <a href="/info/payment" target="_blank" title="Картой Халва">
                        <img src="img/halva.png" alt="Картой Халва" class="center-block img-responsive"/>
                    </a>
                    <a href="/info/payment" target="_blank" title="Картой Совесть">
                        <img src="img/sovest.jpg" alt="Картой Совесть" class="center-block img-responsive"/>
                    </a>
                </div>
                <div class="clearfix"></div>
                <ul class="opl">
                    <li>
                        Банковской картой нашему курьеру при получении заказа<br />
                        <span class="text-danger">(оплата картами "Халва" и "Совесть" возможна только на сайте)</span>
                    </li>
                    <li>Наличными нашему курьеру при получении заказа</li>
                    <li>Безналичным расчетом (банковский перевод) – для корпоративных клиентов</li>
                </ul>
                <div class="text-right small">
                    <a href="/info/payment" target="_blank">Подробно</a>
                </div>
            </div>
            <div class="tab-pane" id="delivery">
                <p class="h5"><b>Доставка в пределах МКАД:</b></p>
                <ul class="dost">
                    <li>День в день при оформлении заказа до 16:00 - <b>350 руб.</b></li>
                    <li>При заказе от 5000 руб. - <span class="text-danger"><b>бесплатно</b></span></li>
                    <li>Турбо-доставка в течение 3 часов - <b>500 руб.</b></li>
                </ul>
                <div class="cleaner_h20"></div>
                <p class="h5"><b>Доставка в пределах 25км от МКАД:</b></p>
                <ul class="dost">
                    <li>Доставка на следующий день после заказа - <b>350 руб.</b></li>
                    <li>При заказе от 10000 руб. - <span class="text-danger"><b>бесплатно</b></span></li>
                </ul>
                <div class="text-right small">
                    <a href="/info/delivery" target="_blank">Подробно</a>
                </div>
            </div>                                            
        </div>
    </div>
    <div class="lineback hidden-xs"><span>Рекомендуем также</span></div>
    <div class="tovar-slider text-center hidden-xs" id="tovar-carousel">
        <div class="slider-nav">
            <button class="prev btn btn-danger"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
        </div>
        <div class="slider">
            <ul>
            <? foreach($recommend as $item): ?>
                <li>
                    <a href="/product/<?=$item['id'];?>">
                        <img src="<?=!empty($item['image'])?'img/products/'.$item['image']:'img/no-thumb.png';?>" alt="<?=$item['name'];?>" class="center-block"/>
                        <p><?=$item['name'];?></p>
                    </a>
                </li>
            <? endforeach; ?>
            </ul>
        </div>
        <div class="slider-nav">
            <button class="btn btn-danger next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
