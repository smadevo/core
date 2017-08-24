<?php
namespace App\Request;

use App\Controller;
use Throwable;

/**
 * @inheritDoc
 */
abstract class Base implements \App\Request
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
    final public function getHandledBy(Controller $controller): bool
    {
        if (isset($this->parameters[1])) {
            $parameters = array_slice($this->parameters, 1);
        } else {
            $parameters = [];
        }
        switch ($this->getMethod()) {
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
                // Method not allowed.
                $this->sendResponseStatus(405);
                return true;
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
