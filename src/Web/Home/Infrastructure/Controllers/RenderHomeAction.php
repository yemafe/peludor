<?php
namespace Peludors\Web\Home\Infrastructure\Controllers;

use Flight;
use Peludors\Web\Home\Application\RenderHome;
use Peludors\Web\Home\Application\RenderHomeQuery;

readonly class RenderHomeAction
{
    public function __construct(
        private RenderHome $renderHome
    ) {}

    public function __invoke(): void
    {
        $query = new RenderHomeQuery();
        $result = $this->renderHome->__invoke($query);
        echo Flight::view()->render('index.twig', [
            'homeSections' => $result
        ]);
        //echo Flight::view()->render('index.twig');
    }
}
