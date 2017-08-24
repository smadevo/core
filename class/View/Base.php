<?php
namespace App\View;

use App\Request;
use Throwable;

/**
 * @inheritDoc
 */
abstract class Base implements \App\View
{
    /**
     * @inheritDoc
     */
    final public function sendTo(Request $request, array $data): void
    {
        $type    = $this->getType();
        $charset = $this->getCharset();
        $body    = $this->renderTemplateWith($data);
        $length  = strlen($body);

        $request->sendResponseHeader(
            "Content-Type: {$type}; charset={$charset}"
        );
        $request->sendResponseHeader(
            "Content-Length: {$length}"
        );
        $request->sendResponseBody($body);
    }

    /**
     * Renders a template with the given data.
     *
     * @param array $data
     *
     * @return string
     *
     * @throws Throwable
     */
    protected function renderTemplateWith(array $data): string
    {
        extract($data);
        try {
            ob_start();
            set_include_path(
                dirname($this->getTemplate())
            );
            include $this->getTemplate();
            restore_include_path();
            return ob_get_clean();
        } catch (Throwable $throwable) {
            restore_include_path();
            ob_end_clean();
            throw $throwable;
        }
    }

    /**
     * Returns the output’s MIME type.
     *
     * @return string
     */
    abstract protected function getType(): string;

    /**
     * Returns the output’s character set.
     *
     * @return string
     */
    abstract protected function getCharset(): string;

    /**
     * Returns the template path relative to the entry script.
     *
     * @return string
     */
    abstract protected function getTemplate(): string;
}
