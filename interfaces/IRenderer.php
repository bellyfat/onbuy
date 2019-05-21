<?php
namespace onbuy\interfaces;

interface IRenderer {
    public function renderTemplate($template, $params = []);
}
