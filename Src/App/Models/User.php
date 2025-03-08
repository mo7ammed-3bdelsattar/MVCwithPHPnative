<?php 
namespace Src\App\Models;
use PDO;
class User
{

public function getData()
{
    $dsn='mysql:host=localhost;dbname=clinic;port=3306;charset=utf8';
    $pdo=new PDO($dsn, 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    $stm=$pdo->query("SELECT * FROM `users`");
    return $stm->fetch(PDO::FETCH_ASSOC);
}
public function getUser($id){
    $dsn='mysql:host=localhost;dbname=clinic;port=3306;charset=utf8';
    $pdo=new PDO($dsn, 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    $stm=$pdo->query("SELECT * FROM `users` WHERE id=$id");
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row;
    }else{
        return [];
    }
}
}
?>  