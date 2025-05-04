<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="min-width: 350px;">
    <h3 class="text-center mb-3">Login</h3>
    <form action="/login/auth" method="POST">
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
      </div>
      <!-- Submit -->
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="text-center mt-3">
      <a href="/register">Don't have an account? Register</a>
    </div>
  </div>
</body>

</html>