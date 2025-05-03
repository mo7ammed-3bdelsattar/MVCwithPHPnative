<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Framework\Controller;

class Users extends Controller
{
    public function index(){
        echo "Admin Users Index";
    }
}