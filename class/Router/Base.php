<?php
namespace App\Router;

use App\Request;
use App\Route;
use App\Router;

/**
 * @inheritDoc
 */
final class Base implements Router
{
    /**
     * @var Route[]
     */
    private $routes;

    /**
     * Constructor.
     *
     * @param Route[] $routes
     */
    public function __construct(Route ...$routes)
    {
        $this->routes = $routes;
    }

    /**
     * @inheritDoc
     */
    public function route(Request $request): void
    {
        foreach ($this->routes as $route) {
            if (!$route->matches($request)) {
                continue;
            }
            $route->handle($request);
            return;
        }
        $request->sendResponseStatus(404);
    }
}
