<?php
namespace Peludors\Web\Home\Infrastructure\Controllers;

use Flight;
use Peludors\Web\Home\Application\RenderHome;
use Peludors\Web\Home\Application\RenderHomeQuery;

class RenderHomeAction
{
    public function __construct(
        //private RenderHome $renderHome
    ) {}

    public function __invoke(): void
    {
        //$query = new RenderHomeQuery();

       /* echo Flight::view()->render('index.twig', [
            'homeSections' => $this->renderHome->__invoke($query)->toArray()
        ]);*/
        echo Flight::view()->render('index.twig');
    }
}
