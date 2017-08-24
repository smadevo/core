<?php
namespace App\Router;

use App\Request;
use App\Route;

/**
 * @inheritDoc
 */
final class Router implements \App\Router
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
            if (!$route->handles($request)) {
                continue;
            }
            return;
        }
        // Not found.
        $request->sendResponseStatus(404);
    }
}
