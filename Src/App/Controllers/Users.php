<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Framework\Response;
use Framework\Controller;

class Users extends Controller
{

    public function __construct(private User $model) {}

    public function index(): Response
    {
        $users = $this->model->findAll();
        // echo $this->viewer->render('shared/header', ['title' => 'Users']);
        return $this->view('users/index', [
            'users' => $users,
            'total' => $this->model->numRows()
        ]);
    }
    public function show(string $id): Response
    {
        $user = $this->model->find($id);
        return $this->view('users/show', [
            'user' => $user
        ]);
    }
    public function create(): Response
    {
        return $this->view('users/create');
    }
    public function store(): Response
    {
        $data = [
            'name' => $this->request->post['name'],
            'email' => $this->request->post['email'],
            'password' => md5($this->request->post['password']),
        ];
        if ($this->model->findBy('email', $data['email'])) {
            return $this->view('users/create', [
                'errors' => ['email' => 'Email already exists'],
                'user' => $data
            ]);
        }
        if ($this->model->create($data)) {
            return $this->redirect("/users/{$this->model->getInsertId()}/show");
        } else {
            return $this->view('users/create', [
                'errors' => $this->model->getErrors(),
                'user' => $data
            ]);
        }
    }
    public function edit(string $id): Response
    {
        $user = $this->model->find($id);
        return $this->view('users/edit', [
            'user' => $user
        ]);
    }
    public function update(string $id): Response
    {
        $user = $this->model->find($id);
        $user['name'] = $this->request->post['name'];
        $user['email'] = $this->request->post['email'];
        $userByEmail = $this->model->findBy('email', $this->request->post['email']);
        // exit(($userByEmail['id'] !== $user['id']));
        if ($userByEmail && ($userByEmail['id'] !== $user['id'])) {
            return $this->view('users/edit', [
                'errors' => ['email' => 'Email already exists'],
                'user' => $user
            ]);
        }
        if ($user['password'] !== $this->request->post['password']) {
            $user['password'] = md5($this->request->post['password']);
        }
        if ($this->model->update($id, $user)) {
            return $this->redirect("/users/{$id}/show");
        } else {
            return $this->view('users/edit', [
                'errors' => $this->model->getErrors(),
                'user' => $user
            ]);
        }
    }
    public function destroy(string $id): Response
    {
        $user = $this->model->find($id);
        if ($this->model->delete($id)) {
            return $this->redirect('/users');
        } else {
            return $this->view('users/show', [
                'errors' => $this->model->getErrors(),
                'user' => $user
            ]);
        }
    }
}
