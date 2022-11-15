{% extends 'layout.php' %}

{% block title %}Product List{% endblock %}

{% block content %}
<script src="../js/index.js"></script>

<form action="/delete" method="post" id="delete_form">
    <div class="loader row row-cols-1 row-cols-md-4 mb-4 text-center">
        {% for product in products %}
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <input name="{{ product.id|raw }}" value="{{ product.productType|raw }}" class="delete-checkbox position-absolute top-0 start-0 translate-middle form-check-input mt-4 ms-4 justify-content-start" type="checkbox">

                <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{ product.id|raw }}</li>
                        <li>{{ product.name|raw }}</li>
                        <li>{{ product.price|raw }}$</li>

                        {% if product.productType|raw == 'DVD' %}
                        <li>Size: {{ product.size|raw }}MB</li>
                        {% endif %}

                        {% if product.productType|raw == 'Book' %}
                        <li>Weight: {{ product.weight|raw }}KG</li>
                        {% endif %}

                        {% if product.productType|raw == 'Furniture' %}
                        <li>Dimension: {{ product.height|raw }}x{{ product.width|raw }}x{{ product.length|raw }}</li>
                        {% endif %}
                    </ul>
                </div>
            </div>
        </div>
        {% else %}
        <h1 class="card-title"><small class="text-muted fw-light">Products have'n b been added yet</small></h1>
        {% endfor %}

    </div>
</form>
{% if totalPages > 1 %}

<nav class="align-self-en">
    <ul class="pagination justify-content-end">
        {% for i in 1..totalPages  %}
        <li class="page-item"><a class="page-link" href="/?page={{ i }}">{{ i }}</a></li>
        {% else %}
        {% endfor %}
    </ul>
</nav>

{% endif %}
{% endblock %}