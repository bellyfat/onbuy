<div id="basket">
    <div class="cart-head hidden-xs text-muted text-center base" hidden>
        <div class="col-sm-5">Товар</div>
        <div class="col-sm-4">Цена / Количество</div>
        <div class="col-sm-2">Сумма</div>
    </div>
    <div class="cart-body"></div>
    <div class="cart-footer base" hidden>
        <div class="col-xs-6 col-sm-7">
            <button data-action="order" class="btn btn-success btn-lg">Оформить заказ</button>
        </div>
        <div class="col-xs-6 col-sm-4 cart-total">
            <small>Всего:</small> <span></span>
        </div>
        <div class="col-sm-1 text-center">
            <button class="btn btn-danger" id="recount" title="Пересчитать корзину">
                <i class="fa fa-refresh" aria-hidden="true"></i>
            </button>
        </div>
        <? if($min_amount > 0): ?>
        <div class="col-xs-12 help-block lower">
            <p>Минимальный заказ <?=$min_amount;?> руб.</p>
        </div>
        <? endif; ?>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        renderBasket();
    });
</script>
