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
     * @return void
     */
    public function get(Request $request, array $parameters): void;

    /**
     * Processes and responds to a given HTTP HEAD request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function head(Request $request): void;

    /**
     * Processes and responds to a given HTTP POST request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function post(Request $request): void;

    /**
     * Processes and responds to a given HTTP PUT request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function put(Request $request): void;

    /**
     * Processes and responds to a given HTTP DELETE request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function delete(Request $request): void;

    /**
     * Processes and responds to a given HTTP TRACE request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function trace(Request $request): void;

    /**
     * Processes and responds to a given HTTP OPTIONS request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function options(Request $request): void;

    /**
     * Processes and responds to a given HTTP CONNECT request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function connect(Request $request): void;

    /**
     * Processes and responds to a given HTTP PATCH request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function patch(Request $request): void;
}
