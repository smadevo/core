<?php
namespace Smadevo;

use Throwable;

/**
 * Encapsulates an HTTP connection and request data.
 */
interface Request
{
    /**
     * Compares the request path with a given path.
     *
     * @param string $path
     *
     * @return bool
     */
    public function matches(string $path): bool;

    /**
     * Executes the request method on a given controller.
     *
     * @param Controller $controller
     *
     * @return bool
     *
     * @throws Throwable
     */
    public function getHandledBy(Controller $controller): bool;

    /**
     * Responds with a given HTTP response status.
     *
     * @param int $code An HTTP response status code.
     *
     * @return void
     */
    public function sendResponseStatus(int $code): void;

    /**
     * Responds with a given HTTP response header.
     *
     * @param string $header
     *
     * @return void
     */
    public function sendResponseHeader(string $header): void;

    /**
     * Responds with a given HTTP response body.
     *
     * @param string $body
     *
     * @return void
     */
    public function sendResponseBody(string $body): void;
}
