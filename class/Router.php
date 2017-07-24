<?php
namespace App;

/**
 * Routes a request.
 */
interface Router
{
    /**
     * Routes a request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function route(Request $request): void;
}
