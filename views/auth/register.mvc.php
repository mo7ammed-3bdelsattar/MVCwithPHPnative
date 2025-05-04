<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="min-width: 350px;">
    <h3 class="text-center mb-3">Register</h3>
    <form action="/register/store" method="POST">
      <!-- Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name">
        {% if (isset($errors['name'])) : %}
        <p class="text-danger">{{$errors['name']}}</p>
        {% endif; %}
      </div>
      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email">
        {% if (isset($errors['email'])) : %}
        <p class="text-danger">{{$errors['email']}}</p>
        {% endif; %}
      </div>
      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        {% if (isset($errors['password'])) : %}
        <p class="text-danger">{{$errors['password']}}</p>
        {% endif; %}
      </div>
      <!-- Submit -->
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <div class="text-center mt-3">
      <a href="/login">Already have an account? Login</a>
    </div>
  </div>
</body>

</html>