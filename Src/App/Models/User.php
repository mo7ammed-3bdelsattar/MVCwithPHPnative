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
        }
    }
    
}
?>