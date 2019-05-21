<?php
namespace onbuy\engine;

use onbuy\interfaces\IRenderer;

class Render implements IRenderer {
    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);
        $templatePath = App::call()->config['templates_dir'] . $template . '.php';
        include $templatePath;
        return ob_get_clean();
    }
}
