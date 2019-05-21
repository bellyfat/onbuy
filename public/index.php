<?php
session_start();
use onbuy\engine\{Autoload, App};

include "../engine/Autoload.php";
$config = include __DIR__ . "/../config/config.php";

spl_autoload_register([new Autoload(), 'loadClass']);

try {
    App::call()->run($config);
} catch (\PDOException $e) {
    echo 'PDO error! ';
    echo $e->getMessage();
} catch (\Exception $e) {
    echo $e->getMessage();
}
