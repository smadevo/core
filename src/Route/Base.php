<?php
namespace Smadevo\Route;

use Smadevo\Controller;
use Smadevo\Request;

/**
 * @inheritDoc
 */
abstract class Base implements \Smadevo\Route
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var Controller
     */
    private $controller;

    /**
     * Constructor.
     *
     * @param string     $path
     * @param Controller $controller
     */
    final public function __construct(string $path, Controller $controller)
    {
        $this->path       = $path;
        $this->controller = $controller;
    }

    /**
     * @inheritDoc
     */
    final public function matches(Request $request): bool
    {
        return $request->matches($this->path);
    }

    /**
     * @inheritDoc
     */
    final public function handles(Request $request): bool
    {
        return $request->getHandledBy($this->controller);
    }
}
