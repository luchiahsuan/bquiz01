<?php
session_start();
date_default_timezone_get("asia/taipei");

class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db06";
    protected $table;
    protected $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    public function find()
    {

    }

    public function all()
    {

    }

    public function save()
    {

    }

    public function delete()
    {

    }

    public function count()
    {

    }

    public function max()
    {

    }

    public function min()
    {

    }

    public function avg()
    {

    }


}

function dd(){

}

function to(){

}

function q(){
    
}