<?php
session_start();
date_default_timezone_set("Asia/Taipei");

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

    public function find($id)
    {
        $sql = "select * from $this->table";

        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id`='$id'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function all(...$arg)
    {
        $sql = "select * from $this->table";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arrayToSqlArray($arg[0]);
                $sql = $sql . " Where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($array)
    {
        if (isset($array['id'])) {
            $id = $array['id'];
            unset($array['id']);
            $tmp = $this->arrayToSqlArray($array);
            $sql = "update $this->table set" . join(",", $tmp) . " where `id`='$id'";
        } else {
            $cols = array_keys($array);
            $sql = "insert into $this->table (`" . join("`,`", $cols) . "`) values('" . join("','", $array) . "')";
        }
        echo $sql;
        $this->pdo->exec($sql);
    }

    public function del($id)
    {
        $sql = "delete from $this->table";

        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id`='$id'";
        }

        return $this->pdo->exec($sql);
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

    private function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }
}

function dd()
{
}

function to()
{
}

function q()
{
}

$db = new DB('bottom');
// $bot = $db->all();
// print_r($bot);
// $db->del(4);
// print_r($db->all());
// $db->save(['bottom' => '2022頁尾版權']);
// 118-119等同於116
// $sql="inset into `bottom`(`bottom`) value ('2022頁尾版權')";
// $pdo->exec($sql);

$row=$db->find(1);
print_r($row);

$row['bottom']="2023科技大學版權所有";
print_r($row);
$db->save($row);
