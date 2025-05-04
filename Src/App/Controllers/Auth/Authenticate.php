<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use Framework\Controller;

class Authenticate extends Controller
{
    public function __construct(private \App\Models\User $model) {}
    public function index()
    {
        return $this->view('auth/login');
    }
    public function authenticate()
    {
        $data = [
            'email' => $this->request->post['email'],
            'password' => md5($this->request->post['password'])
        ];
        $user = $this->model->findBy('email', $data['email']);
        if ($user && $user['password'] === $data['password']) {
            $_SESSION['auth'] = $user;
            return $this->redirect('/home');
        } else {
            return $this->view('auth/login', [
                'errors' => ['email' => 'Email or password is incorrect'],
            ]);
        }
    }
    public function destroy()
    {
        unset($_SESSION['auth']);
        session_destroy();
        return $this->redirect('/');
    }
}
