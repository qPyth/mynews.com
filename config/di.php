<?php

use NewsSite\Database;
use NewsSite\Twig\AssetExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\get;

return [
    'server.params' => $_SERVER,
    FilesystemLoader::class => autowire()->constructorParameter('paths', BASE_PATH.'/templates'),
    Environment::class => autowire()->constructorParameter('loader', get(FilesystemLoader::class))
    ->method('addExtension', get(AssetExtension::class)),
    Database::class => autowire()
        ->constructor(
            getenv('DATABASE_DSN'),
            getenv('DATABASE_USERNAME'),
            getenv('DATABASE_PASSWORD'),
        ),
    AssetExtension::class => autowire()
        ->constructorParameter('serverParams', get('server.params')),
    ];

