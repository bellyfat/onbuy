"use strict";

/**
 * Основная корзина товаров
 * @property {String} id ID контейнера корзины
 * @property {String} preview ID контейнера предпросмотра корзины
 * @property {BasketItem[]} items Продукты в корзине, экземпляры класса BasketItem
 * @property {String} body Имя класса тела корзины
 * @property {String} wrap Имя класса обертки корзины
 * @returns {Basket}
 */
function Basket() {
    Container.call(this);
    this.id = 'basket';
    this.items = [];
    this.body = '.cart-body';
    this.wrap = '.base';
}
Basket.prototype = Object.create(Container.prototype);
Basket.prototype.init = function(response) {
    if(document.getElementById(this.id) !== null) {
        this.fillBasket(response);
    }
};
Basket.prototype.fillBasket = function(response) {
    this.items = response.basket.map(function(item) {
        return new BasketItem(item); 
    });
    this.render();
};
Basket.prototype.render = function() {
    document.getElementById(this.id).querySelector(this.body).innerHTML = '';
    document.getElementById(this.id).querySelector(this.body).appendChild(this.content());
};
Basket.prototype.content = function() {
    var content = document.createElement('div');
    if(this.items.length > 0) {
        this.getTotalAmount();
        this.hiddenBase(false);
        this.items.forEach(function(item) {
        if (item instanceof BasketItem) {
            content.appendChild(item.init());
        }
    });
    } else {
        this.hiddenBase(true);
        content.className = 'text-center';
        content.textContent = 'В корзине пока нет товаров';
    }
    return content;
};
Basket.prototype.hiddenBase = function(val) {
    var base = document.getElementById(this.id).querySelectorAll(this.wrap);
    for (var i=0; i<base.length; i++ ) {
        base[i].hidden = val;
    }
};

/**
 * Товар в основной корзине
 * @param {Object} params Характеристики продукта
 * @param {String} params.id ID записи в корзие
 * @param {String} params.name Название продукта
 * @param {String} params.volume Объем/вес продукта
 * @param {String} params.price Цена продукта
 * @param {String} params.image Файл изображение
 * @param {String} params.quantity Количество продукта
 * @param {String} params.product_id ID продукта в БД
 * @property {String} id ID строки в корзине
 * @property {String} className Класс строки в корзине
 * @returns {BasketItem}
 */
function BasketItem(params) {
    ContainerItem.call(this);
    this.params = params;
    this.className = 'cart-item';
    this.id = this.className + this.params.id;
}
BasketItem.prototype = Object.create(ContainerItem.prototype);
BasketItem.prototype.init = function() {
    var row = this.render();
    row.appendChild(this.createObjectElement('div','product-name col-xs-12 col-sm-5',[this.productName()]));
    row.appendChild(this.productPrice('product-price col-xs-12 col-sm-6'));
    row.appendChild(this.createObjectElement('div','product-control col-sm-1',[this.productControl()]));
    return row;
};
BasketItem.prototype.productName = function() {
    return this.createProductLink(this.params.product_id, [
        this.createObjectElement('div','',[this.productImage(this.params.name, this.params.image)]),
        this.createObjectElement('div','',[this.createStringElement('p','',this.params.name), this.createStringElement('small','',this.params.volume)])
    ]); 
};
BasketItem.prototype.productPrice = function(className) {
    return this.createObjectElement('div', className,[
        this.getPrice('Цена', '', this.params.price.toFixed(2)),
        this.quantityControl(),
        this.getPrice('Сумма', 'amount', this.calcAmountProduct(this.params.quantity))
    ]);
};
BasketItem.prototype.getPrice = function(title,className,value) {
    return this.createObjectElement('div', '',[
        this.createStringElement('small','',title),
        this.createStringElement('span',className, value + this.currency)
    ]);
};
BasketItem.prototype.calcAmountProduct = function(num) {
    var quantity = num > 0 ? num : 1;
    return (this.params.price * quantity).toFixed(2);
};
BasketItem.prototype.changeCount = function(e) {
    setCountProduct(e);
    this.setAmountProduct(e);
};
BasketItem.prototype.setAmountProduct = function(e) {
    var quantity = e.target.parentElement.querySelector('input').value;
    document.getElementById(this.id).querySelector('.amount').textContent = this.calcAmountProduct(quantity) + this.currency;
};
BasketItem.prototype.productControl = function() {
    var button = document.createElement('button');
    button.className = 'btn btn-danger';
    button.title = 'Удалить';
    button.innerHTML = '<i class="fa fa-trash-o" aria-hidden="true"></i>';
    button.addEventListener('click', this.deleteProduct.bind(this));
    return button;
};
BasketItem.prototype.deleteProduct = function() {
    sendRequestServer('/basket/delete/' + this.params.id, {}, this.handleDeleteProduct.bind(this));
};
BasketItem.prototype.handleDeleteProduct = function() {
    this.remove();
    this.getTotalAmount();
};
BasketItem.prototype.changeTotalAmount = function(response) {
    if (response.amount > 0) {
        Basket.prototype.changeTotalAmount.call(this, response);
    } else {
        renderBasket();
    }
};
/**
 * Предпросмотр корзины товаров
 * @property {String} id
 * @returns {PreviewBasket}
 */
function PreviewBasket() {
    Basket.call(this);
    this.id = 'preview';
}
PreviewBasket.prototype = Object.create(Basket.prototype);
PreviewBasket.prototype.fillBasket = function(response) {
    this.items = response.basket.map(function(item) {
       return new PreviewBasketItem(item); 
    });
    this.render();
};
/**
 * Товар в предпросмотре корзины
 * @param {Object} params Характеристики продукта
 * @returns {PreviewBasketItem}
 */
function PreviewBasketItem(params) {
    BasketItem.call(this, params);
    this.className = 'basket-item';
    this.id = this.className + this.params.id;
};
PreviewBasketItem.prototype = Object.create(BasketItem.prototype);
PreviewBasketItem.prototype.init = function() {
    var row = this.render();
    row.id = this.id;
    row.appendChild(this.createObjectElement('div','',[this.createProductLink(this.params.product_id, [this.productImage(this.params.name, this.params.image)])]));
    row.appendChild(this.createObjectElement('div','basket-item-content',[this.productContent(), this.productPrice()]));
    return row;
};
PreviewBasketItem.prototype.productContent = function() {
    return this.createObjectElement('div','', [
        this.createProductLink(this.params.product_id, [this.createStringElement('span','', this.params.name)]),
        this.productControl()
    ]);
};
PreviewBasketItem.prototype.productPrice = function() {
    return this.getPrice(
        this.params.price + this.currency + ' × ' +this.params.quantity, 
        'amount', 
        this.calcAmountProduct(this.params.quantity)
    );
};
PreviewBasketItem.prototype.handleDeleteProduct = function() {
    BasketItem.prototype.handleDeleteProduct.call(this);
    changeCountCart();
};
PreviewBasketItem.prototype.changeTotalAmount = function(response) {
    if (response.amount > 0) {
        BasketItem.prototype.changeTotalAmount.call(this, response);
    } else {
        renderPreviewBasket();
    }
};
