<?php

namespace App;

use LessQL\Database;
use PDO;

class OrmService
{

    /**
     * Database connection.
     *
     * @var Database
     */
    protected $article;

    /**
     * OrmService constructor.
     */
    public function __construct()
    {
        // This should be in a config file.
        $this->db = new Database(new PDO('sqlite:data/data.sqlite3'));
    }

    /**
     * Get database connection.
     *
     * @return Database
     */
    public function getDb()
    {
        return $this->db;
    }

}
