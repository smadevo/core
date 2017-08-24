<?php
namespace App;

/**
 * Matches and handles a request.
 */
interface Route
{
    /**
     * Matches a request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function matches(Request $request): bool;

    /**
     * Tries to handle a request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function handles(Request $request): bool;
}
