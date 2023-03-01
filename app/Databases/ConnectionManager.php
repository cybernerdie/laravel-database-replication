<?php

namespace App\Databases;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\QueryExecuted;

class ConnectionManager
{
    public static $userLocation;
    private static $queryOperation = 'write';

     /**
     * Get the user's location.
     *
     * @return string
     */
    protected static function getUserLocation(): string
    {
        return static::$userLocation;
    }

    /**
     * Register a listener for database query events and
     * determine whether the query is a read or write operation.
     *
     * @return void
     */
    public static function registerQueryListener(): void
    {
        DB::listen(function (QueryExecuted $queryExecuted) {
            $query = $queryExecuted->sql;
            $queryType = str_starts_with(trim($query), 'select');
            static::setQueryOperation($queryType);
        });
    }

    /**
     * Set the query operation based on the query type.
     *
     * @param string $queryType The type of query (e.g. "select", "insert", "update", "delete").
     * @return void
     */
    private static function setQueryOperation($queryType): void
    {
        static::$queryOperation = $queryType === 'select' ? 'read' : 'write';
    }

    /**
     * Get the appropriate connection for the current operation.
     *
     * @return \Illuminate\Database\Connection
     */
    public static function connection(): Connection
    {
        if (static::isReadOperation()) {
            $connection = static::getConnectionByLocation();

            return DB::connection($connection);
        }

        return DB::connection();
    }

    /**
     * Get the connection name based on the user's location.
     *
     * @return string
     */
    public static function getConnectionByLocation(): string
    {
        $userLocation = static::getUserLocation();

        $connection = match ($userLocation) {
            WEST_COAST_LOCATION => WEST_COAST_READ_REPLICA_CONNECTION,
            EAST_COAST_LOCATION => EAST_COAST_READ_REPLICA_CONNECTION,
            default => DEFAULT_READ_REPLICA_CONNECTION,
        };

        return $connection;
    }

    /**
     * Determine if the current operation is a read operation.
     *
     * @return bool
     */
    protected static function isReadOperation(): bool
    {
        return static::$queryOperation === 'read';
    }
}
