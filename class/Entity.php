<?php
namespace App;

/**
 * Provides a magic getter for entities.
 */
trait Entity
{
    /**
     * @inheritDoc
     *
     * @throws LogicException
     */
    public function __get(string $property)
    {
        $method = 'get' . ucfirst($property);
        return $this->$method();
    }
}
