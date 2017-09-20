<?php
namespace Smadevo\Router;

use Smadevo\Request;
use Smadevo\Route;

/**
 * @inheritDoc
 */
abstract class Base implements \Smadevo\Router
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
    final public function __construct(Route ...$routes)
    {
        $this->routes = $routes;
    }

    /**
     * @inheritDoc
     */
    final public function route(Request $request): void
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
        /*
        Not found.
        */
        $request->sendResponseStatus(404);
    }
}
