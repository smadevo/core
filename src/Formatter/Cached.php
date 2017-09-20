<?php
namespace Smadevo\Formatter;

use Smadevo\Cache;
use Smadevo\Formatter;

/**
 * Caches formatter output.
 *
 * @inheritDoc
 */
abstract class Cached implements \Smadevo\Formatter
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * @var string
     */
    private $key;

    /**
     * Constructor.
     *
     * @param Cache     $cache
     * @param Formatter $formatter
     */
    final public function __construct(Cache $cache, Formatter $formatter)
    {
        $this->cache     = $cache;
        $this->formatter = $formatter;
        $this->key       = get_class($formatter);
    }

    /**
     * @inheritDoc
     */
    final public function format(string $input): string
    {
        $output = $this->cache->getData(
            $input,
            $this->key
        );
        if ($output !== null) {
            return $output;
        }
        $this->cache->setData(
            $output = $this->formatter->format($input),
            $input,
            $this->key
        );
        return $output;
    }
}
