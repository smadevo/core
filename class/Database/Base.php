<?php
namespace App\Database;

use PDO;
use PDOStatement;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use App\Database;

/**
 * @inheritDoc
 */
abstract class Base extends PDO implements Database
{
    /**
     * @inheritDoc
     */
    final public function execute(string $statement, array $parameters): PDOStatement
    {
        $placeholders = [];

        /*
        Generate the right amount of placeholders
        for a multidimensional array of paramaters.
        */
        foreach ($parameters as $index => $parameter) {
            if (!is_array($parameter)) {
                $placeholders[] = '?';
                continue;
            }
            $placeholders[] = implode(',', array_fill(0, count($parameter), '?'));
        }

        // Flatten parameters.
        $parameters = iterator_to_array(
            new RecursiveIteratorIterator(
                new RecursiveArrayIterator($parameters)
            ),
            false
        );

        // Prepare and execute statement.
        $statement = $this->prepare(
            // Insert placeholders.
            vsprintf($statement, $placeholders)
        );
        $statement->execute($parameters);

        return $statement;
    }
}
