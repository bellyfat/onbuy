<? if(isset($count)): ?>
<div class="row">
    <div class="col-xs-12 col-md-8 order-form">
        <form method="post" id="order">
            <div class="lineback">
                <span class="h4">Плательщик</span>
            </div>
            <div class="form-group">
                <div class="radio">
                    <input name="client" type="radio" id="person" value="person" data-check-id="default">
                    <label for="person">Физическое лицо</label>
                </div>
                <div class="radio">
                    <input name="client" type="radio" id="company" value="company">
                    <label for="company">Организация</label>
                </div>
            </div>
            <div class="form-horizontal well" data-hide-id="person" data-show-id="company">
                <div class="form-group require">
                    <label for="company-name" class="col-sm-3 col-md-4 col-lg-3 control-label">Название компании</label>
                    <div class="col-sm-9 col-md-8 col-lg-9">
                        <input name="company-name" type="text" class="form-control" id="company-name">
                    </div>
                </div>
                <div class="form-group require">
                    <label for="inn" class="col-sm-3 col-md-4 col-lg-3 control-label">ИНН</label>
                    <div class="col-sm-9 col-md-8 col-lg-9">
                        <input name="inn" type="text" class="form-control" id="inn">
                    </div>
                </div>
                <div class="form-group require">
                    <label for="kpp" class="col-sm-3 col-md-4 col-lg-3 control-label">КПП</label>
                    <div class="col-sm-9 col-md-8 col-lg-9">
                        <input name="kpp" type="text" class="form-control" id="kpp">
                    </div>
                </div>
                <div class="form-group require">
                    <label for="company-address" class="col-sm-3 col-md-4 col-lg-3 control-label">Юр. адрес</label>
                    <div class="col-sm-9 col-md-8 col-lg-9">
                        <input name="company-address" type="text" class="form-control" id="company-address">
                    </div>
                </div>
            </div>
            <div class="lineback">
                <span class="h4">Способ доставки</span>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group tab-toggle">
                        <? foreach($delivery as $method): ?>
                        <div class="radio">
                            <input name="delivery" type="radio" id="<?=$method['name'];?>" value="<?=$method['id'];?>" 
                            <?=$method['price'] > 0 ? 'data-price="'.$method['price'].'"':'';?> 
                            <?=$method['name']!='takeout' ? 'data-report="address"':'';?>
                            <?=$method['id']==1 ? 'data-check-id="default"' : '';?> />
                            <label for="<?=$method['name'];?>"><?=$method['title'];?></label>
                        </div>
                        <? endforeach; ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="tab-content delivery">
                        <? foreach($delivery as $method): ?>
                        <div class="tab-pane <?=$method['name'];?>">
                            <h5><?=$method['title'];?></h5>
                            <? if(!empty($method['description'])): ?>
                            <p><?=$method['description'];?></p>
                            <? endif; ?>
                            <? if(!empty($method['time'])): ?>
                            <p>Срок доставки: <b><?=$method['time'];?></b></p>
                            <? endif; ?>
                            <? if($method['price'] > 0): ?>
                            <p>Стоимость: <b><?=$method['price'];?> руб.</b></p>
                            <? else: ?>
                            <p><b>Бесплатно</b></p>
                            <? endif; ?>
                        </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="well" data-hide-id="takeout" id="address">
                <div class="form-group require">
                    <label for="locate" class="control-label">Улица, дом</label>
                    <input name="locate" type="text" id="locate" class="form-control verify" />
                </div>
                <div class="form-group">
                    <label for="number" class="control-label">Подъезд, этаж, квартира</label>
                    <input name="number" type="text" id="number" class="form-control"/>
                </div>
            </div>
            <div class="lineback">
                <span class="h4">Способ оплаты</span>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group tab-toggle">
                        <div class="radio" data-hide-id="company" data-show-id="person">
                            <input name="pay" type="radio" id="card" value="card" data-check-id="person">
                            <label for="card">Картой на сайте</label>
                        </div>
                        <div class="radio" data-hide-id="company" data-show-id="person">
                            <input name="pay" type="radio" id="cash" value="cash">
                            <label for="cash">Наличными курьеру</label>
                        </div>
                        <div class="radio" data-hide-id="person" data-show-id="company">
                            <input name="pay" type="radio" id="bank" value="bank" data-check-id="company">
                            <label for="bank">Банковский перевод</label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="tab-content pay">
                        <div class="tab-pane card">
                            <h5>Картой на сайте</h5>
                            <p>Принимаются банковские карты Visa, Mastercard, а также Халва и Совесть</p>
                        </div>
                        <div class="tab-pane cash">
                            <h5>Наличными курьеру</h5>
                            <p>Пожалуйста, укажите в комментарии сумму необходимой сдачи</p>
                        </div>
                        <div class="tab-pane bank">
                            <h5>Банковский перевод</h5>
                            <p>Счет на оплату придет на указанный e-mail после подтверждения заказа</p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="lineback">
                <span class="h4">Покупатель</span>
            </div>
            <div class="well form-horizontal">
                <div class="form-group require">
                    <label for="name" class="col-sm-2 control-label">Ваше Имя</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" id="name" class="form-control verify"/>
                    </div>
                </div>
                <div class="form-group require">
                    <label for="phone" class="col-sm-2 control-label">Телефон</label>
                    <div class="col-sm-10">
                        <input name="phone" type="text" id="phone" class="form-control verify"/>
                    </div>
                </div>
                <div class="form-group require">
                    <label for="email" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" id="email" class="form-control verify"/>
                    </div>
                </div>
            </div>
            <div class="lineback">
                <span class="h4">Дополнительно</span>
            </div>
            <div class="well">
                <div class="form-group">
                    <label for="comment" class="control-label">Комментарий к заказу</label>
                    <textarea id="comment" name="comment" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="order" class="btn btn-success btn-lg">Оформить заказ</button>
                <p class="small">Нажимая кнопку «Оформить заказ», я даю свое согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных в Согласии на обработку персональных данных</p>
            </div>
        </form>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="result">
            <div class="result-head">
                <span>Ваш заказ</span>
                <a href="/basket/" class="btn btn-success btn-sm">Изменить</a>
            </div>
            <div class="result-line">
                <small>Товаров <?=$count;?> на сумму:</small>
                <span><span id="amount"><?=$amount;?></span> р</span>
            </div>
            <div class="result-line">
                <small>Доставка:</small>
                <span><span id="carry"></span> р</span>
            </div>
            <div class="result-total">
                <span>Итого:</span>
                <span><span id="total"></span> р</span>
            </div>
        </div>
    </div>
</div>
<? elseif(!empty($order_id)): ?>
<div class="row">
    <div class="col-xs-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
        <div class="well text-center">
            <h4>Заказ успешно отправлен!</h4>
            <p>Номер заказа <b><?=$order_id;?></b></p>
            <p>В ближайшее время наш оператор свяжется с Вами по указанному телефону для подтверждения заказа.</p>
            <? if($pay=='bank'): ?>
            <p>Счет на оплату будет отправлен на указанный e-mail после подтверждения заказа оператором.</p>
            <? elseif($pay=='card'): ?>
            <a href="#" class="text-success">Ссылка на оплату картой на сайте</a>
            <? endif; ?>
            <p class="h5 lower">Спасибо, что выбрали Onbuy!</p>
        </div>
    </div>
</div>
<? endif; ?>
