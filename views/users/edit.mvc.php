{% extends "base.mvc.php" %}
{% block title %} Edit User {% endblock %}
{% block body %}
<h1>Create New User</h1>

<!-- ممكن تحط هنا رسالة نجاح أو خطأ -->
{% if (!empty($successMessage)) : %}
<div class="alert alert-success">{{$successMessage}}</div>
{% endif; %}
<!-- فورم إنشاء المستخدم -->
<div class="container">
    <form class="form-control" action="/users/{{$user['id']}}/update" method="POST">
        {% include "users/form.mvc.php" %}
        <input type="submit" class="btn btn-primary form-control" value="Update User">
    </form>
</div>
{% endblock %}