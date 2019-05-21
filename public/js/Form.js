"use strict";

/**
 * @constructor
 * @param {String} id
 * @param {FieldForm[]} fields Поля формы для валидации
 * @returns {Form}
 */
function Form(id, fields) {
    this.id = id;
    this.fields = fields;
    this.element = document.getElementById(this.id);
};
Form.prototype.init = function() { 
    this.element.addEventListener('submit', this.formSubmit.bind(this));
    this.element.addEventListener('reset', this.formReset.bind(this));
};
Form.prototype.formSubmit = function(e) {
    if(!this.validate()) {
        e.preventDefault();        
        this.feedback();
        scrollInvalidForm();
    }
};
Form.prototype.formReset = function() {
    this.fields.forEach(function(field) {
        if (field instanceof FieldForm) {
            field.reset();
        }
    });
};
Form.prototype.validate = function() {
    var valid = true;
    this.fields.forEach(function(field) {
        if (field instanceof FieldForm) {
            if (!field.validate()) {    
                valid = false;
            }
        }
    });
    return valid;
};
Form.prototype.feedback = function() {
    this.fields.forEach(function(field) {
        if (field instanceof FieldForm) {
            field.reset();
            field.feedback();
        } 
    });
};
/**
 * Поле формы
 * @param {String} name Атрибут name поля
 * @param {Object} rule Правила проверки поля
 * @param {String} rule.regexp Регулярное выражение
 * @param {String} rule.message Текст подсказки
 * @returns {FieldForm}
 */
function FieldForm(name, rule) {
    this.name = name;
    this.rule = rule;
    this.required = 'regexp' in this.rule;
    this.element = document.querySelector('[name='+this.name+']');
};
FieldForm.prototype.validate = function() {
    var valid = true;
    var value = this.element.value.trim();
    if (this.element.classList.contains('verify')) {
        valid = this.required ? this.regexpTest(value) : value!='';
    }
    return valid;
};
FieldForm.prototype.regexpTest = function(value) {
    return this.rule.regexp.test(value);
};
FieldForm.prototype.reset = function() {
    if (this.element.classList.contains('invalid')) {
        this.element.classList.remove('invalid');
        this.element.parentElement.removeChild(this.element.parentElement.lastChild);
    }
};
FieldForm.prototype.feedback = function() {
    if (!this.validate()) {
        var helpText = this.element.value.trim() != '' ? this.rule.message : 'Заполните это поле';
        this.element.classList.add('invalid');
        var message = document.createElement('div');
        message.className = 'invalid-feedback';
        message.textContent = helpText; 
        this.element.parentElement.appendChild(message);
    }
};

function FeedbackForm(id, fields) {
    Form.call(this, id, fields);
}
FeedbackForm.prototype = Object.create(Form.prototype);
FeedbackForm.prototype.formSubmit = function(e) {
    e.preventDefault();
    if (this.validate()) {
        sendRequestServer('/contact/feedback/', this.serialize(), this.handleSend.bind(this));
    } else {
        this.feedback();
        scrollInvalidForm();
    }
};
FeedbackForm.prototype.serialize = function() {
    var data = {};
    this.fields.forEach(function(field) {
        if (field instanceof FieldForm) {
            data[field.element.name] = field.element.value;
        }
    });
    return data;
};
FeedbackForm.prototype.handleSend = function(response) {
    this.element.innerHTML = '';
    var message = document.createElement('div');
    message.className = 'alert alert-success';
    message.innerHTML = 'Спасибо за обращение, '+response.client+'!<br />В ближайшее время мы свяжемся с Вами по указанному телефону!';
    this.element.appendChild(message);
};

var rules = {
    'name': [/^[A-Za-zА-Яа-яЁё\s]+$/, 'Поле может содержать буквы и пробелы'],
    'inn': [/^[0-9]{10,12}$/, 'ИНН содержит 10 или 12 цифр'],
    'kpp': [/^[0-9]{9}$/, 'КПП содержит 9 цифр']
};
function validationRule(key) {
    return {
        'regexp': rules[key][0],
        'message': rules[key][1]
    };
}
