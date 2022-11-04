{% extends 'layout.php' %}

{% block title %}404 Page{% endblock %}

{% block content %}
<style>
    .text-center {
        height: 100vh;
    }
</style>

<div class="text-center mt-5">
    <h1 class="mt-5">404 Page Not Found!</h1>
    <a href="/" class="nav-link fw-bold fs-5">Go Home</a>
</div>

{% endblock %}