<?php 
namespace Src\App\Controllers;
use Src\App\Models\User;
class UserController{
    public function index(){
        $model = new User();
        $users =$model->getData();
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