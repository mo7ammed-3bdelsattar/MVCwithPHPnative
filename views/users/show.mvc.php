{% extends "base.mvc.php" %}
{% block title %} User {% endblock %}
{% block body %}

<table class="table table-borered table-striped">
    <a href="/users" class="btn btn-primary">Back to User List</a>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <tr>
        <td>{{ $user['id'] }}</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>
            <a href="/users/{{$user['id']}}/edit" class="btn btn-warning">Edit</a>
            <form action="/users/{{$user['id']}}/destroy" class="d-inline" method="POST">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure, you want to delete this User??')">Delete</button>
            </form>
        </td>

    </tr>
</table>
{% endblock %}