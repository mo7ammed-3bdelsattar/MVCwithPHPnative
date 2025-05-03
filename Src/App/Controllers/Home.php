<?php 
declare(strict_types=1);

namespace App\Controllers;
use App\Models\User;
use Framework\Viewer;
use Framework\Controller;

class Home extends Controller
{
    public function __construct(private Viewer $viewer){}

    public function index(){
        echo $this->viewer->render('shared/header',['title' => 'Home']);
        echo $this->viewer->render('home/index');
    }
}