<?php
use DI\ContainerBuilder;
use Peludors\Core\User\Domain\UserRepository;
use Peludors\Core\User\Infrastructure\Repository\UserMySQLRepository;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;


$builder = new ContainerBuilder();
$builder->addDefinitions([
    LoaderInterface::class => DI\factory(function () {
        return new FilesystemLoader(__DIR__ . '/../../../templates');
    }),
    Environment::class => DI\create()
        ->constructor(DI\get(LoaderInterface::class)),
    UserRepository::class => \DI\autowire(UserMySQLRepository::class),
]);
return $builder->build();
