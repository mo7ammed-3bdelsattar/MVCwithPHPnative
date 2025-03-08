<?php 
namespace Src\App\Controllers;
use Src\App\Models\User;

class HomeController{
    public function index(){
        require_once ('views/home/index.php');
    }
}