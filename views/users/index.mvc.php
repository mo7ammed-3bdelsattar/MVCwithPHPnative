{% extends "base.mvc.php" %}
{% block title %} Users {% endblock %}
{% block body %}
        <h1>User List</h1>
        <table class="table table-borered table-striped">
            <p>Total: {{total}}</p>
            <a href="/users/create" class="btn btn-primary">Create User</a>
            <caption>User List</caption>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            {% foreach ($users as $user): %}
            <tr>
                <td>{{ user['id'] }}</td>
                <td>{{ user['name'] }}</td>
                <td>{{ user['email'] }}</td>
                <td>
                    <a href="/users/{{user['id']}}/show" class="btn btn-primary">View</a>
                    <a href="/users/{{user['id']}}/edit" class="btn btn-warning">Edit</a>
                    <form action="/users/{{user['id']}}/destroy" class="d-inline" method="POST">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure, you want to delete this User??')">Delete</button>
                    </form>
                </td>
            </tr>
            {% endforeach; %}
        </table>
{% endblock %}