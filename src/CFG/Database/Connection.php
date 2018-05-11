<?php

namespace CFG\Database;

use CFG\Interfaces\IConnection;
use \PDO;

/**
 *
 */
class Connection implements IConnection
{
    private $dsn;
    private $user;
    private $password;

    public function __construct($dsn, $user, $password)
    {
        $this->dsn      = $dsn;
        $this->user     = $user;
        $this->password = $password;
    }

    public function connect()
    {
        return new \PDO($this->dsn, $this->user, $this->password);
    }
}