<?php
namespace App;

/**
 * Renders a view.
 */
interface View
{
    /**
     * Renders a view with the given data and sends the output in response to a request.
     *
     * @param array   $data
     * @param Request $request
     *
     * @return void
     */
    public function sendWith(array $data, Request $request): void;
}
