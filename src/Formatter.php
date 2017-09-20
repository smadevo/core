<?php
namespace Smadevo;

/**
 * Formats view data.
 */
interface Formatter
{
    /**
     * Formats an input string and returns the formatted result.
     *
     * @param string $input
     *
     * @return string
     */
    public function format(string $input): string;
}
