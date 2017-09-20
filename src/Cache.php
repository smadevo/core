<?php
namespace Smadevo;

/**
 * Provides basic caching capabilities.
 */
interface Cache
{
    /**
     * Retrieves cached data for the given group and key.
     *
     * @param string $group
     * @param string $key
     *
     * @return string|null
     */
    public function getData(string $group, string $key): ?string;

    /**
     * Caches data for the given group and key.
     *
     * @param string $data
     * @param string $group
     * @param string $key
     *
     * @return void
     */
    public function setData(string $data, string $group, string $key): void;

    /**
     * Expires the cache for the given group.
     *
     * @param string $group
     *
     * @return void
     */
    public function expire(string $group): void;
}
