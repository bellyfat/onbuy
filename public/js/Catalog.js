"use strict";

function Catalog() {
    Container.call(this);
    this.id = 'catalog';
    this.items = [];
}
Catalog.prototype = Object.create(Container.prototype);
Catalog.prototype.getJson = function(url, data) {
    this.showLoadingIcon();
    sendRequestServer(url, data, this.init.bind(this));
};
Catalog.prototype.init = function(response) {
    if(document.getElementById(this.id) != null) {
        this.items = response.catalog.map(function(item) {
            return new CatalogItem(item); 
        });
        this.render();
    }
};
Catalog.prototype.render = function() {
    this.hideLoadingIcon();
    var node = document.getElementById(this.id);
    this.items.forEach(function(item) {
        if (item instanceof CatalogItem) {
            node.appendChild(item.init());
        }
    });
    if (this.items.length == 0) {
        node.appendChild(this.createStringElement('div', 'center-block text-muted', 'В данной категории нет товаров'));
    }
};
Catalog.prototype.showLoadingIcon = function() {
    var icon = this.createObjectElement('div','col-xs-12 text-center loading',[
        this.createStringElement('i', 'fa fa-spinner fa-pulse fa-2x fa-fw text-muted', '')
    ]);
    document.getElementById(this.id).appendChild(icon);
};
Catalog.prototype.hideLoadingIcon = function() {
    var icon = document.querySelector('.loading');
    icon.parentElement.removeChild(icon);
};

function CatalogItem(params) {
    ContainerItem.call(this);
    this.params = params;
    this.className = 'col-xs-6 col-sm-4 col-lg-3';
    this.id = 'catalog-item' + this.params.id;
}
CatalogItem.prototype = Object.create(ContainerItem.prototype);
CatalogItem.prototype.init = function() {
    var row = this.render();
    row.appendChild(this.createObjectElement('div','catalog-item item',[
        this.createObjectElement('div','text-center',[this.productCard(), this.productBuy()])
    ]));
    return row;
};
CatalogItem.prototype.productCard = function() {
    return this.createProductLink(this.params.id, [
        this.createObjectElement('div', 'item-image', [this.productImage(this.params.name, this.params.image)]),
        this.productName('item-name'),
        this.createStringElement('div', 'item-price', this.params.price.toFixed(2) + this.currency)
    ]);
};
CatalogItem.prototype.productName = function(className) {
    return this.createObjectElement('div', className, [
        this.createStringElement('p', '', this.params.name),
        this.createStringElement('p', 'small', this.params.volume)
    ]);
};
CatalogItem.prototype.productBuy = function() {
    return this.createObjectElement('div','item-buy',[
        this.quantityControl(),
        this.addButton()
    ]);
};
CatalogItem.prototype.addButton = function() {
    var button = document.createElement('button');
    button.className = 'btn btn-primary btn-lg';
    button.textContent = 'Купить';
    button.addEventListener('click', this.addToBasket.bind(this));
    return button;
};
CatalogItem.prototype.addToBasket = function() {
    addToBasket(this.params.id, document.getElementById(this.id).querySelector('[name=quantity]').value);
};
