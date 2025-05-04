<?php 
declare(strict_types=1);

namespace App\Controllers;
use Framework\Controller;

class Home extends Controller
{
    // public function __construct(protected Viewer $viewer){}

    public function index(){
        return $this->view('home/index');
    }
}