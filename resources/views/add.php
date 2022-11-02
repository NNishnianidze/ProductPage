{% extends 'layout.php' %}

{% block title %}Product Add{% endblock %}

{% block content %}
<script src="../js/add.js"></script>

<div class="container d-flex align-items-center mt-5">
    <form action="/add" method="post" class="form-signin" id="product_form">

        <div class="row g-3">

            {# <div class="col-12" hidden>
                <label for="sku" class="form-label">SKU</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU">
                    <div class=" role="alert">
                        SKU is required.
                    </div>
                </div>
            </div> #}

            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                {% if errors.name[0] is defined %}
                <div class="mt-2 alert alert-danger" role="alert">
                    {{ errors.name[0] }}
                </div>
                {% endif %}

            </div>

            <div class="col-12">
                <label for="price" class="form-label">Price ($)</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="100 $" required>
                {% if errors.price[0] is defined %}
                <div class="mt-2 alert alert-danger" role="alert">
                    {{ errors.price[0] }}
                </div>
                {% endif %}
            </div>

            <div class="col-md-5">
                <label for="productType" class="form-label">Type Switcher</label>
                <select class="form-select" name="productType" id="productType" required>
                    <option value="">Choose...</option>
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>

                {% if errors.size[0] is defined %}
                <div class="mt-2 alert alert-danger" role="alert">
                    {{ errors.size[0] }}
                </div>
                {% endif %}

                {% if errors.weight[0] is defined %}
                <div class="mt-2 alert alert-danger" role="alert">
                    {{ errors.weight[0] }}
                </div>
                {% endif %}

                {% if (errors.height[0] is defined) or (errors.width[0] is defined) or (errors.length[0] is defined) %}
                <div class="mt-2 alert alert-danger" role="alert">
                    Dimensions must be numeric
                </div>
                {% endif %}

            </div>

            <div class="col-12" id="dvd" style="display: none;">
                <label for="size" class="form-label">Size (MB)</label>
                <input type="text" class="form-control options" id="size" placeholder="500 MB">
                <small class="text-muted">*Please, provide size</small>
            </div>

            <div class="col-12" id="book" style="display: none;">
                <label for="weight" class="form-label">Weight (KG)</label>
                <input type="text" class="form-control options" id="weight" placeholder="1 KG">
                <small class="text-muted">*Please, provide weight</small>
            </div>

            <div class="col-12" id="furniture" style="display: none;">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control options furniture" id="height" placeholder="Height">

                <label for="width " class="form-label">Width</label>
                <input type="text" class="form-control options furniture" id="width" placeholder="Width">

                <label for="length " class="form-label">Length</label>
                <input type="text" class="form-control options furniture" id="length" placeholder="Length">
                <small class="text-muted">*Please, provide dimensions</small>
            </div>

    </form>
</div>
{% endblock %}