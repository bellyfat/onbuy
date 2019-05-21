<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?=$title;?></title>
        <base href="/" />
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/main.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div id="maincontent">
            <header class="container-fluid" id="header">
                <div class="row">
                    <div class="container">
                        <div class="row" >
                            <div class="col-xs-6 col-sm-3 col-xl-1">
                                <a href="/">
                                    <img src="img/logo.png" alt="<?=$company->name;?>" class="img-responsive logo"/>
                                </a>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-sm-push-6 col-md-push-0 col-xl-1 phone text-right">
                                <a href="tel:<?=preg_replace('/\D/', '', $company->phone);?>" class="unstyled"><?=$company->phone;?></a>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-sm-pull-3 col-md-pull-0 col-xl-2 searh">
                                <form method="post" action="/catalog/search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="searh"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" name="submit" type="submit"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <!--Mobile menu-->
                            <div class="col-xs-12 hidden-lg hidden-md">
                                <div class="row">
                                   <nav class="navbar navbar-default" role="navigation">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#xs-menu">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                             </button>
                                        </div>
                                        <div class="collapse navbar-collapse" id="xs-menu">
                                            <ul class="nav navbar-nav">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                    <? foreach ($menu as $item): ?>
                                                    <li><a href="/category/<?=$item['id'];?>"><?=$item['name'];?></a></li>
                                                    <? endforeach; ?>
                                                    </ul>
                                                </li>
                                                <li><a href="/info/payment/">Оплата</a></li>
                                                <li><a href="/info/delivery/">Доставка</a></li>
                                                <li><a href="/info/about/">О компании</a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Информация <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="/info/">Как это работает?</a></li>
                                                        <li><a href="/info/returns/">Возврат и обмен</a></li>
                                                        <li><a href="/info/faq/">Помощь</a></li>
                                                        <li><a href="#">Политика конфеденциальности</a></li>
                                                        <li><a href="#">Публичная оферта</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="contact">Контакты</a></li>
                                            </ul>
                                        </div>
                                   </nav> 
                                </div>   
                            </div>
                            <div class="col-xs-9 col-xs-offset-3 col-sm-4 col-sm-offset-8 col-md-offset-0 col-xl-1 text-right customer">
                                <? if($cart): ?>
                                <a href="/basket/" class="basket-open" aria-label="Корзина покупателя">                                        
                                    <i class="fa cart" aria-hidden="true"></i>
                                    <span class="badge"><?=$count?></span>
                                </a>
                                <? endif; ?>
                                <!--<a href="auth" aria-label="Вход в личный кабинет">
                                    <i class="fa user" aria-hidden="true"></i>
                                </a>-->
                                <a href="#" class="visible-xs-inline" aria-label="Поиск">
                                    <i class="fa loop" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <? if($cart): ?>
                        <div class="dropdown-basket basket-open" id="preview">
                            <p class="h5 text-center">Товары в корзине</p>
                            <div class="scroll-area cart-body"></div>
                            <div class="basket-footer base" hidden>
                                <div class="cart-total">
                                    <small>Общая сумма:</small> <span></span>
                                </div>
                                <div class="text-center">
                                    <a href="/basket/" class="btn btn-primary">Перейти в корзину</a>
                                </div>
                            </div>
                        </div>
                        <? endif; ?>
                    </div>
                </div>
            </header>
            <main>
                <div class="container shadow">
<?=$content?>
                </div>
            </main>
            <footer class="container-fluid" id="footer">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <p>
                                    <a href="/" class="unstyled">
                                        <img src="img/logo-white.png" alt="<?=$company->name;?>" class="logo"/>
                                    </a>
                                </p>
                                <a class="sopdu unstyled" href="#" target="_blank">
                                    <small>Разработка сайта:</small>
                                </a>
                            </div>
                            <div class="col-sm-4 col-md-6 hidden-xs">
                                <ul class="list-unstyled">
                                    <li><span>Информация</span></li>
                                    <li><a href="/info/">Как это работает?</a></li>
                                    <li><a href="/info/payment/">Способы оплаты</a></li>
                                    <li><a href="/info/delivery/">Условия доставки</a></li>
                                    <li><a href="/info/returns/">Возврат и обмен</a></li>
                                    <li><a href="#">Политика конфеденциальности</a></li>
                                    <li><a href="#">Публичная оферта</a></li>
                                    <li><a href="/info/faq/">Помощь</a></li>
                                    <li><a href="/info/about/">О компании</a></li>
                                    <li><a href="/contact/">Контакты</a></li>
                                </ul>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3 text-center">
                                <a href="tel:<?=preg_replace('/\D/', '', $company->phone);?>" class="unstyled"><?=$company->phone;?></a>
                                <p><small>Мы в социальных сетях:</small></p>
                                <a href="#" rel="nofollow" target="_blank" class="btn btn-round">
                                    <i class="fa fa-vk" aria-hidden="true"></i>
                                </a>
                                <a href="#" rel="nofollow" target="_blank" class="btn btn-round">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>  
                            </div>    
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="modal fade" id="addToCard" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7 text-center">
                            <h3>Товар добавлен</h3>
                            <p>Товар добален в корзину, оформите заказ или продолжите покупки</p>
                            <button class="btn btn-default btn-lg btn-block" data-dismiss="modal">Продолжить покупки</button>
                            <a href="/basket/" class="btn btn-success btn-lg btn-block">Оформить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? if(isset($background)): ?>
        <div id="background" class="visible-lg visible-md" style="background-image: url(img/category/<?=$background;?>)"></div>
        <? endif; ?>
        <script src="/js/main.min.js"></script>
        <script src="/js/Form.js"></script>
        <script src="/js/Container.js"></script>
        <script src="/js/Catalog.js"></script>
        <script src="/js/Basket.js"></script>
        <script src="/js/custom.js"></script>
    </body>
</html>
