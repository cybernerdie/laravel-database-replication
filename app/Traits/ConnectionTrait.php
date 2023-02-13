<?php

namespace App\Traits;

use App\Databases\ConnectionManager;

trait ConnectionTrait
{
    /**
     * Get the database connection for the model.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return ConnectionManager::connection();
    }
}
