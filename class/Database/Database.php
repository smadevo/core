<?php
namespace App\Database;

use PDO;
use PDOStatement;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * @inheritDoc
 */
final class Database implements \App\Database
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @inheritDoc
     *
     * @uses RecursiveIteratorIterator
     * @uses RecursiveArrayIterator
     */
    public function execute(string $statement, array $parameters = []): PDOStatement
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
        /*
        Flatten parameters.
        */
        $parameters = iterator_to_array(
            new RecursiveIteratorIterator(
                new RecursiveArrayIterator($parameters)
            ),
            false
        );
        /*
        Prepare and execute statement.
        */
        $statement = $this->pdo->prepare(
            /*
            Insert placeholders.
            */
            vsprintf($statement, $placeholders)
        );
        $statement->execute($parameters);

        return $statement;
    }
}
