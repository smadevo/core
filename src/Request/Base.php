<?php
namespace Smadevo\Request;

use Smadevo\Controller;
use Throwable;

/**
 * @inheritDoc
 */
abstract class Base implements \Smadevo\Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $parameters;

    /**
     * Constructor.
     *
     * @param string $method
     * @param string $path
     */
    final public function __construct(string $method, string $path)
    {
        $this->method = $method;
        $this->path   = $path;
    }

    /**
     * @inheritDoc
     */
    final public function matches(string $path): bool
    {
        $pattern          = sprintf('/^%s$/u', str_replace('/', '\/', $path));
        $this->parameters = [];

        return preg_match($pattern, $this->path, $this->parameters) === 1;
    }

    /**
     * @inheritDoc
     */
    final public function getHandledBy(Controller $controller): bool
    {
        if (isset($this->parameters[1])) {
            $parameters = array_slice($this->parameters, 1);
        } else {
            $parameters = [];
        }
        try { switch ($this->method) {
            case 'GET':
                return $controller->get($this, $parameters);
            case 'HEAD':
                return $controller->head($this);
            case 'POST':
                return $controller->post($this);
            case 'PUT':
                return $controller->put($this);
            case 'DELETE':
                return $controller->delete($this);
            case 'TRACE':
                return $controller->trace($this);
            case 'OPTIONS':
                return $controller->options($this);
            case 'CONNECT':
                return $controller->connect($this);
            default:
                /*
                Method not allowed.
                */
                $this->sendResponseStatus(405);
                return true;
        }} catch (Throwable $throwable) {
            /*
            Internal server error.
            */
            $this->sendResponseStatus(500);
            throw $throwable;
        }
    }

    /**
     * @inheritDoc
     */
    abstract public function sendResponseStatus(int $code): void;

    /**
     * @inheritDoc
     */
    abstract public function sendResponseHeader(string $header): void;

    /**
     * @inheritDoc
     */
    abstract public function sendResponseBody(string $body): void;
}
