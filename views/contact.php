<div class="indent">
    <script charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aa4e8489bef80d2d2226e1be5bd17e4843e79772cd83d5c09703e3f3304f235db&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-5 col-md-5">
        <address>
            <p class="text-muted">Адрес:</p>
            <p><?=$company->address;?></p>
        </address>
        <address>
            <p class="text-muted">Телефон:</p>
            <a href="tel:<?=preg_replace('/\D/', '', $company->phone);?>" class="text-success"><?=$company->phone;?></a>
        </address>
        <address>
            <p class="text-muted">Email:</p>
            <a href="mailto:<?=$company->email;?>" class="text-success"><?=$company->email;?></a>
        </address>
        <address>
            <p class="text-muted">Режим работы:</p>
            <p>с 9:00 до 21:00</p>
        </address>
    </div>
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6 feedback">
        <h5>Обратная связь</h5>
        <form method="post" id="feedback">
            <div class="form-group">
                <label class="sr-only" for="name">Имя</label>
                <input type="text" class="form-control verify" id="name" name="name" placeholder="Ваше Имя *" autocomplete="off"/>
            </div>
            <div class="form-group">
                <label class="sr-only" for="phone">Телефон</label>
                <input type="text" class="form-control verify" id="phone" name="phone" placeholder="Телефон *" autocomplete="off"/>
            </div>
            <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"/>
            </div>
             <div class="form-group">
                <label for="message" class="sr-only">Сообщение</label>
                <textarea id="message" class="form-control verify" name="message" placeholder="Ваше сообщение *"></textarea>
            </div>
             <div class="form-group">
                 <input type="submit" name="send" class="btn btn-success btn-lg pull-right" value="Отправить" />
             </div>
        </form>
    </div>
</div>
