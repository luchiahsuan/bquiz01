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

    public function count(...$arg)
    {
        return $this->math('count',...$arg); //...???????????????
    }


    public function sum($col, ...$arg)
    {
        return $this->math('sum',$col,...$arg); //...???????????????
    }

    public function max($col,...$arg)
    {
        return $this->math('max',$col,...$arg); //...???????????????
    }

    public function min($col,...$arg)
    {
        return $this->math('min',$col,...$arg); //...???????????????
    }

    public function avg($col,...$arg)
    {
        return $this->math('avg',$col,...$arg); //...???????????????
    }

    private function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    private function math($math, ...$arg)
    {
        switch ($math) {
            case 'count';
                $sql = "select count(*) from $this->table";
                break;
            default;
                $sql = "select $math($arg[0]) from $this->table";
        }

        if (isset($arg[1])) {
            if (is_array($arg[1])) {
                $tmp = $this->arrayToSqlArray($arg[1]);
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $arg[1];
            }
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url)
{
    header("location:" . $url);
}

function q($sql)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db06";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

$Bottom = new DB('bottom');
$Title = new DB('title');
$Ad = new DB('ad');
$Mvim = new DB('mvim');
$Image = new DB('image');
$News = new DB('news');
$Admin = new DB('admin');
$Menu = new DB('menu');
$Total = new DB('total');

if(!isset($_SESSION['visit'])){
$_SESSION['visit']=1;
$total=$Total->find(1);
$total['total']++;
$Total->save($total);
}

// print_r($bot);
// $db->del(4);
// print_r($db->all());
// $db->save(['bottom' => '2022????????????']);
// 118-119?????????116
// $sql="inset into `bottom`(`bottom`) value ('2022????????????')";
// $pdo->exec($sql);

// $row = $db->find(1);
// print_r($row);

// $row['bottom'] = "2023????????????????????????";
// print_r($row);
// $db->save($row);

// echo "???????????????:".$db->count();
// echo "<br>";
// echo "???????????????:".$db->sum('price');
// echo "<br>";
// echo "???????????????:".$db->max('price');
// echo "<br>";
// echo "id?????????:".$db->min('id');
// echo "<br>";
// echo "???????????????:".$db->avg('price');
// echo "<br>";
// echo "<br>";
