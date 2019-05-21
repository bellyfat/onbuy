"use strict";

/**
 * @constructor
 * @param {String} id
 * @property {String} className
 * @property {String} currency Денежная единица
 * @property {String} products_dir URL товара
 * @property {String} image_dir Путь к папке с картинками
 * @property {String} image_error Изображение-заглушка
 * @returns {Container}
 */
function Container() {
    this.id = '';
    this.className = '';
    this.currency = ' р';
    this.products_dir = '/product/';
    this.image_dir = 'img/products/';
    this.image_error = 'img/no-thumb.png';
}
Container.prototype.render = function() {
    var element = document.createElement('div');
    element.id = this.id;
    element.className = this.className;
    return element;
};
Container.prototype.remove = function() {
    var node = document.getElementById(this.id);
    node.parentElement.removeChild(node);
};
Container.prototype.getJson = function(url) {
    sendRequestServer(url,{}, this.init.bind(this));
};
Container.prototype.getTotalAmount = function() {
    sendRequestServer('/basket/amount/', {}, this.changeTotalAmount.bind(this));
};
Container.prototype.changeTotalAmount = function(response) {
    setTotalAmount(response.amount.toFixed(2) + this.currency);
};
/**
 * @constructor
 * @returns {ContainerItem}
 */
function ContainerItem() {
    Container.call(this);
}
ContainerItem.prototype = Object.create(Container.prototype);
Container.prototype.createObjectElement = function(tag,className,children) {
    var element = document.createElement(tag);
    element.className = className;
    children.forEach(function(child) {
        element.appendChild(child);
    });
    return element;
};
Container.prototype.createStringElement = function(tag,className,content) {
    var element = document.createElement(tag);
    element.className = className;
    element.textContent = content;
    return element;
};
ContainerItem.prototype.createProductLink = function(id, children) {
    var link = document.createElement('a');
    link.href = this.products_dir + id;
    children.forEach(function(child) {
        link.appendChild(child);
    });
    return link;
};
ContainerItem.prototype.productImage = function(altText, fileName) {
    var thumb = this.image_error;
    var image = new Image();
    image.className = 'img-responsive';
    image.alt = altText;
    image.src = this.image_dir + fileName;
    image.addEventListener('error', function() { image.src = thumb; });
    return image;
};
ContainerItem.prototype.quantityControl = function() {
    return this.createObjectElement('div', 'count',[
        this.quantityButton('minus'),
        this.quantityInput(),
        this.quantityButton('plus')
    ]);
};
ContainerItem.prototype.quantityInput = function() {
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'quantity';
    input.className = 'form-control';
    input.setAttribute('data-id', this.params.product_id);
    input.disabled = true;
    input.value = this.params.quantity ? this.params.quantity : 1;
    return input;
};
ContainerItem.prototype.quantityButton = function(direction) {
    var button = document.createElement('button');
    button.className = 'btn btn-default btn-round';
    button.classList.add(direction);
    button.addEventListener('click', this.changeCount.bind(this));
    return button;
};
ContainerItem.prototype.changeCount = function(e) {
    setCountProduct(e);
};
