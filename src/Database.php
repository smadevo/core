<?php
namespace Smadevo;

use PDOStatement;

/**
 * Encapsulates a database connection.
 */
interface Database
{
    /**
     * Builds and executes a prepared statement.
     *
     * @param string $statement
     * @param array  $parameters
     *
     * @return PDOStatement
     */
    public function execute(string $statement, array $parameters = []): PDOStatement;
}
