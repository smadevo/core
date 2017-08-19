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
     * @param Request $request
     * @param array   $data
     *
     * @return void
     */
    public function sendTo(Request $request, array $data): void;
}
