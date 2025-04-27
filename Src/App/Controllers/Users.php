<?php 
namespace App\Controllers;
use App\Models\User;
class Users{
    public function index(){
        $model = new User();
        $users =$model->getUsers();
        require_once ('views/users/index.php');
    }
    public function show($id){
        $model = new User();
        if($model->getUser($id)){
        $user =$model->getUser($id);
        }
        require_once ('views/users/show.php');
    }
}