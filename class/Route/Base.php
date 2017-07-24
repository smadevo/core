<?php
namespace App\Route;

use App\Controller;
use App\Request;
use App\Route;

/**
 * @inheritDoc
 */
final class Base implements Route
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
    public function __construct(string $path, Controller $controller)
    {
        $this->path       = $path;
        $this->controller = $controller;
    }

    /**
     * @inheritDoc
     */
    public function matches(Request $request): bool
    {
        return $request->matches($this->path);
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        $request->getHandledBy($this->controller);
    }
}
