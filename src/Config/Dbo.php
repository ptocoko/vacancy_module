<?php


namespace App\Config;


use PDO;

class Dbo extends PDO
{
    public function __construct()
    {
        $dsn = getenv("DATABASE_URL");
        $user = getenv("DB_USER");
        $password = getenv("DB_PASSWORD");
        parent::__construct($dsn, $user, $password);
        parent::setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);
        parent::setAttribute(self::ATTR_DEFAULT_FETCH_MODE, self::FETCH_ASSOC);
    }
}
