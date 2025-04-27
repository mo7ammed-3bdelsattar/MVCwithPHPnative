<?php 
namespace App\Models;
use PDO;
class User
{

public function getUsers()
{
    $dsn='mysql:host=localhost;dbname=php317;port=3306;charset=utf8';
    $pdo=new PDO($dsn, 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    $stm=$pdo->query("SELECT * FROM `user_info`");
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}
public function getUser($id){
    $dsn='mysql:host=localhost;dbname=php317;port=3306;charset=utf8';
    $pdo=new PDO($dsn, 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    $stm=$pdo->query("SELECT * FROM `user_info` WHERE id=$id");
    $row=$stm->fetchAll(PDO::FETCH_ASSOC);
    if($row){
        return $row;
    }else{
        return [];
    }
}
}
?>  