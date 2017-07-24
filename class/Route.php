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
     * Handles a request.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handle(Request $request): void;
}
