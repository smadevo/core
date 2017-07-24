<?php
namespace App\Controller;

use App\Controller;
use App\Request;

/**
 * @inheritDoc
 */
abstract class Base implements Controller
{
    /**
     * @inheritDoc
     */
    public function get(Request $request, array $parameters): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function head(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function post(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function put(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function delete(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function trace(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function options(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function connect(Request $request): void
    {
        $request->sendResponseStatus(405);
    }

    /**
     * @inheritDoc
     */
    public function patch(Request $request): void
    {
        $request->sendResponseStatus(405);
    }
}
