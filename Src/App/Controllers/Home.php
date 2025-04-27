<?php 
namespace App\Controllers;
use App\Models\User;

class Home{
    public function index(){
        require_once ('views/home/index.php');
    }
}