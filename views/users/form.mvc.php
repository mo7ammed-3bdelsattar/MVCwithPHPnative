<a href="/users" class="btn btn-primary">Back to User List</a>
<div class="mb-3">
    <label for="name">Name:</label>
    <input type="text" name="name" class="form-control" id="name" value="{{$user['name']}}">
    {% if (isset($errors['name'])) : %}
        <p class="text-danger">{{$errors['name']}}</p>
    {% endif; %}
</div>
<div class="mb-3">

    <label for="email">Email:</label>
    <input type="email" class="form-control" name="email" id="email" value="{{$user['email']}}">
    {% if (isset($errors['email'])) : %}
        <p class="text-danger">{{$errors['email']}}</p>
    {% endif; %}
</div>
<div class="mb-3">
    <label for="password">Password:</label>
    <input type="password" class="form-control" name="password" id="password" value="{{$user['password']}}">
    {% if (isset($errors['password'])) : %}
        <p class="text-danger">{{$errors['password']}}</p>
    {% endif; %}
</div>