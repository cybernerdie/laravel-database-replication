<?php

namespace App\Databases;

use Illuminate\Support\Facades\DB;

class ConnectionManager
{
    public static $userLocation;

     /**
     * Get the user's location.
     *
     * @return string
     */
    protected static function getUserLocation()
    {
        return static::$userLocation;
    }

    /**
     * Get the appropriate connection for the current operation.
     *
     * @return \Illuminate\Database\Connection
     */
    public static function connection()
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
    public static function getConnectionByLocation()
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
    protected static function isReadOperation()
    {
        return ! in_array(static::getCurrentMethod(), ['insert', 'update', 'delete']);
    }

    /**
     * Get the current database method being called.
     *
     * @return string
     */
    protected static function getCurrentMethod()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        return $backtrace[1]['function'];
    }
}
