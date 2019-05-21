function sendRequestServer(url, data, callback) {
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        error: function() {
            alert('Ошибка обработки запроса!');
        },
        success: function(response) {
            callback(response);
        }
    });
}
function setCountProduct(e) {
    var $input = $(e.target).parent().find('input');
    var value = $(e.target).hasClass('plus') ? +$input.val() + 1 : +$input.val() - 1;
    $input.val(value < 1 ? 1 : value);
}
function scrollInvalidForm(){
    $('body,html').animate({
        scrollTop: $('.invalid:first').offset().top - 100
    }, 400);
}
var catalogPage = 0;
function renderCatalog(id, sort) {
    var data = {'sort': sort, 'page': catalogPage++};
    (new Catalog()).getJson('/catalog/apiCatalog/'+id, data);
}
function renderSearchCatalog(term) {
    var data = {'searh': term, 'page': catalogPage++};
    (new Catalog()).getJson('/catalog/searchCatalog/', data);
}
function displayMore(id, sort, perpage, total) {
    renderCatalog(id, sort);
    trackLastPage(perpage, total);
}
function displaySearchMore(term, perpage, total) {
    renderSearchCatalog(term);
    trackLastPage(perpage, total);
}
function trackLastPage(perpage, total) {
    if((perpage * catalogPage) >= total) {
        $('.more').remove();
    }
}
function addToBasket(id, quantity) {
    var url = '/product/addBasket/'+ id;
    sendRequestServer(url, {'quantity': quantity}, handleAddToBasket);
}
function handleAddToBasket(response) {
    if (response.adding) {
        $('#addToCard').modal('show');
        changeCountCart();
        renderPreviewBasket();
    }
}
function changeCountCart() {
    var url = '/basket/count/';
    sendRequestServer(url, {}, setCountCart);
}
function setCountCart(response) {
    var text = response.count > 0 ? response.count : '';
    $('.customer .badge').text(text);
}
function renderBasket() {
    (new Basket()).getJson('/basket/apiBasket/');
}
function renderPreviewBasket() {
    if ($(window).width() > 768) {
        (new PreviewBasket()).getJson('/basket/apiBasket/');
    }
}
function setTotalAmount(total) {
    $('.cart-total span').text(total);
}
function recountBasket(fields, idx, complete) {
    if ($(fields[idx]).length) {
        var url = '/basket/recount/' + $(fields[idx]).data('id');
        var data = {'quantity': $(fields[idx]).val()};
        var callback = function() { recountBasket(fields, ++idx, complete); };
        sendRequestServer(url, data, callback);
    } else {
        complete();
    }
}
function handleRecountBasket() {
    (new Basket()).getTotalAmount();
}
function requestOrder() {
    sendRequestServer('/basket/amount/', {}, handleRequestOrder);
}
function handleRequestOrder(response) {
    if(response.amount >= response.min) {
        $(location).attr('href','/order/');
    } else {
        (new Basket()).changeTotalAmount(response);
        $('.help-block p').addClass('text-danger');
    }
}
$(function() {
    $('[data-action=buy]').on('click', function() {
        var quantity = $('[name=quantity]').val() ? $('[name=quantity]').val() : 1;
        addToBasket($(this).data('id'), quantity);
    });
    $('#recount').on('click', function() {
        recountBasket($('[name=quantity]'), 0, handleRecountBasket);
    });
    $('[data-action=order]').on('click', function() {
        recountBasket($('[name=quantity]'), 0, requestOrder);
    });
    if ($('#preview').length) {
        renderPreviewBasket();
    }
    //Order
    if ($('form#order').length) {
        var order = new Form('order', [
            new FieldForm('company-name', {}),
            new FieldForm('inn', validationRule('inn')),
            new FieldForm('kpp', validationRule('kpp')),
            new FieldForm('address', {}),
            new FieldForm('locate', {}),
            new FieldForm('name', validationRule('name')),
            new FieldForm('phone', {}),
            new FieldForm('email', {}),
        ]);
        order.init();
    }
    //Feedback
    if ($('form#feedback').length) {
        var feedback = new FeedbackForm('feedback', [
            new FieldForm('name', validationRule('name')),
            new FieldForm('phone', {}),
            new FieldForm('email', {}),
            new FieldForm('message', {}),
        ]);
        feedback.init();
    }
});
