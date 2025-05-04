{% extends "base.mvc.php" %}
{% block title %} Home {% endblock %}
{% block body %}
 <h1 style="text-align:center;">hello evrebody!!</h1>
 {{ $_SESSION['user'] }}
{% endblock %}