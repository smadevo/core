<?php
namespace App\Request;

use App\Controller;
use App\Request;

/**
 * @inheritDoc
 */
abstract class Base implements Request
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @inheritDoc
     */
    final public function matches(string $path): bool
    {
        $pattern          = sprintf('/^%s$/u', str_replace('/', '\/', $path));
        $this->parameters = [];

        return preg_match($pattern, $this->getPath(), $this->parameters) === 1;
    }

    /**
     * @inheritDoc
     */
    final public function getHandledBy(Controller $controller): void
    {
        if (isset($this->parameters[1])) {
            $parameters = array_slice($this->parameters, 1);
        } else {
            $parameters = [];
        }
        switch ($this->getMethod()) {
            case 'GET':
                $controller->get($this, $parameters);
                break;
            case 'HEAD':
                $controller->head($this);
                break;
            case 'POST':
                $controller->post($this);
                break;
            case 'PUT':
                $controller->put($this);
                break;
            case 'DELETE':
                $controller->delete($this);
                break;
            case 'TRACE':
                $controller->trace($this);
                break;
            case 'OPTIONS':
                $controller->options($this);
                break;
            case 'CONNECT':
                $controller->connect($this);
                break;
            default:
                // Method not allowed.
                $this->sendResponseStatus(405);
                break;
        }
    }

    /**
     * Returns the request method for internal use.
     *
     * @return string
     */
    abstract protected function getMethod(): string;

    /**
     * Returns the request path for internal use.
     *
     * @return string
     */
    abstract protected function getPath(): string;

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
