<?php
namespace App;

/**
 * Provides methods for processing HTTP requests.
 */
interface Controller
{
    /**
     * Processes and responds to a given HTTP GET request.
     *
     * @param Request $request
     * @param array   $parameters
     *
     * @return bool
     */
    public function get(Request $request, array $parameters): bool;

    /**
     * Processes and responds to a given HTTP HEAD request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function head(Request $request): bool;

    /**
     * Processes and responds to a given HTTP POST request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function post(Request $request): bool;

    /**
     * Processes and responds to a given HTTP PUT request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function put(Request $request): bool;

    /**
     * Processes and responds to a given HTTP DELETE request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function delete(Request $request): bool;

    /**
     * Processes and responds to a given HTTP TRACE request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function trace(Request $request): bool;

    /**
     * Processes and responds to a given HTTP OPTIONS request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function options(Request $request): bool;

    /**
     * Processes and responds to a given HTTP CONNECT request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function connect(Request $request): bool;

    /**
     * Processes and responds to a given HTTP PATCH request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function patch(Request $request): bool;
}
