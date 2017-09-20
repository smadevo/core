<?php
namespace Smadevo;

/**
 * Provides a magic getter for entities.
 */
trait Entity
{
    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get(string $property)
    {
        $method = 'get' . ucfirst($property);
        return $this->$method();
    }
}
