<?php

class Database
{
    private $connection;
    private $host, $port, $db, $user, $password;
    public function __construct()
    {
        $this->host = 'pgsql';
        $this->port = 5432;
        $this->db = 'db';
        $this->user = 'user';
        $this->password = 'secret';

        try {
            $this->connection = pg_connect("host={$this->host} port={$this->port} dbname={$this->db} user={$this->user} password={$this->password}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return false|PgSql\Connection
     */
    public function getConnection(): \PgSql\Connection|bool
    {
        return $this->connection;
    }

    public function sendSql($sql)
    {
        $query = pg_query($this->getConnection(), $sql);

        return $query;
    }
}