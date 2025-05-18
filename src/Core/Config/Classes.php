<?php
use DI\ContainerBuilder;
use Peludors\Core\User\Domain\UserRepository;
use Peludors\Core\User\Infrastructure\Repository\UserMySQLRepository;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    UserRepository::class => \DI\autowire(UserMySQLRepository::class),
]);
return $builder->build();
