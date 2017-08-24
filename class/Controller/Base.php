<?php
namespace App\Controller;

use App\Request;

/**
 * @inheritDoc
 */
abstract class Base implements \App\Controller
{
    /**
     * @inheritDoc
     */
    public function get(Request $request, array $parameters): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function head(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function post(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function put(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function trace(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function options(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function connect(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function patch(Request $request): bool
    {
        $request->sendResponseStatus(405);
        return true;
    }
}
