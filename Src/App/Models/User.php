<?php 
declare(strict_types=1);

namespace App\Models;
use Framework\Model;
class User extends Model
{
    protected $table='user_info';
    
    protected function validate(array $data){
        if (empty($data['name'])){
            $this->addError('name','Name is required');
        }else if (strlen($data['name']) < 3 || strlen($data['name']) > 50){
            $this->addError('name','Name must be at least 3 and at most 50 characters long');
        }else if (!preg_match('/^[a-zA-Z0-9 _]+$/', $data['name'])){
            $this->addError('name','Name must contain only letters, numbers and underscores');
        }
        if (empty($data['email'])){
            $this->addError('email','Email is required');
        }else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->addError('email','Email is not valid');
        }
        if (empty($data['password'])){
            $this->addError('password','Password is required');
        }
    }
    
}
?>