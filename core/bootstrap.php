<?php
// Путь до директории с конфигурационными файлами
const DIR_CONFIG = '/../config';

// Подключение автозагрузчика composer
require_once __DIR__ . '/../vendor/autoload.php';

// Функция, возвращающая массив всех настроек приложения
function getConfigs(string $path = DIR_CONFIG): array
{
    $settings = [];
    foreach (scandir(__DIR__ . $path) as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name)) {
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

// Подключаем маршруты
require_once __DIR__ . '/../route/web.php';

// Инициализация приложения
$app = new Src\Application(new Src\Settings(getConfigs()));

$scriptName = $_SERVER['SCRIPT_NAME'];
$requestUri = $_SERVER['REQUEST_URI'];


if (strpos($requestUri, $scriptName) === 0) {
    $prefix = $scriptName;
} else {

    $prefix = str_replace('/index.php', '', $scriptName);
}

$app->route->setPrefix($prefix);

function app() {
    global $app;
    return $app;
}

return $app;