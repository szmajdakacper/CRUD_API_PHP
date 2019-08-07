<?php
class Database
{
    public $pdo;

    /**
     * Create file log.txt in folder config.
     * First line: mysql:dbname=DBNAME;host=HOSTNAME;charset=utf8
     * Second line: USERNAME
     * Third line: PASSWORT
     */
    public function __construct()
    {
        try {
            @$data = file('config/log.txt');
            if ($data == '') {
                throw new Exception('Database isn\'t correct configurated');
            }
        } catch (Exception $e) {
            Response::responseAndDie('Database', $e->getMessage(), 500);
        }

        $dsn = trim($data[0]);
        $user = trim($data[1]);
        $pass = trim($data[2]);

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            Response::responseAndDie('Database', $e->getMessage(), 500);
        }
    }
}