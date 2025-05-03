<?php
$container = new Framework\Container;
$container->set(App\Database::class, function (): object {
    return new App\Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
});
$container->set(Framework\TemplateViewerInterface::class, function (): object {
    return new Framework\MVCTemplateViewer;
});
return $container;