<?php
declare(strict_types=1);
namespace App\Controllers\Auth;

use Framework\Controller;
class Register extends Controller{
    public function __construct(private \App\Models\User $model) {}

    public function index(){
        
        return $this->view('auth/register');
    }
    public function store(){
        $data = [
            'name' => $this->request->post['name'],
            'email' => $this->request->post['email'],
            'password' => md5($this->request->post['password'])
        ];
        if ($this->model->findBy('email', $data['email'])) {
            return $this->view('auth/register', [
                'errors' => ['email' => 'Email already exists'],
                'user' => $data
            ]);
        }
        if ($this->model->create($data)) {
            return $this->redirect('/login');
        } else {
            return $this->view('auth/register', [
                'errors' => $this->model->getErrors(),
                'user' => $data
            ]);
        }
    }
}