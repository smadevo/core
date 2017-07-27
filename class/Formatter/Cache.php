<?php
namespace App\Formatter;

use App\Formatter;

/**
 * Provides basic caching capabilities.
 *
 * @inheritDoc
 */
interface Cache extends Formatter
{
    /**
     * Expires the cache.
     *
     * @param string $input
     *
     * @return void
     */
    public function expire(string $input): void;
}
