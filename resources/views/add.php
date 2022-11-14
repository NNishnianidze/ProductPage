{% extends 'layout.php' %}

{% block title %}Product Add{% endblock %}

{% block content %}
<script src="../js/add.js"></script>

<div class="container d-flex align-items-center mt-5">
    <form action="/add" method="post" class="form-signin" id="product_form">

        <div class="row g-3">

            <div class="col-12">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control {{ errors.sku ? 'is-invalid' : '' }}" name="sku" id="sku" placeholder="SKU" required>
                <div class="invalid-feedback d-block">
                    {{ errors.sku| first }}
                </div>
            </div>

            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control {{ errors.name ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Name" required>
                <div class="invalid-feedback d-block">
                    {{ errors.name| first }}
                </div>
            </div>

            <div class="col-12">
                <label for="price" class="form-label">Price ($)</label>
                <input type="text" class="form-control {{ errors.price ? 'is-invalid' : '' }}" name="price" id="price" placeholder="100 $" required>
                <div class="invalid-feedback d-block">
                    {{ errors.price| first }}
                </div>
            </div>

            <div class="col-md-5">
                <label for="productType" class="form-label">Type Switcher</label>
                <select class="form-select" name="productType" id="productType" required>
                    <option value="">Choose...</option>
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>

            <div class="col-12" id="dvd" style="display: none;">
                <label for="size" class="form-label">Size (MB)</label>
                <input type="text" class="form-control options {{ errors.size ? 'is-invalid' : '' }}" id="size" placeholder="500 MB">
                <small class="text-muted">*Please, provide size</small>
            </div>
            <div class="invalid-feedback d-block">
                {{ errors.size| first }}
            </div>

            <div class="col-12" id="book" style="display: none;">
                <label for="weight" class="form-label">Weight (KG)</label>
                <input type="text" class="form-control options {{ errors.weight ? 'is-invalid' : '' }}" id="weight" placeholder="1 KG">
                <small class="text-muted">*Please, provide weight</small>
            </div>
            <div class="invalid-feedback d-block">
                {{ errors.weight| first }}
            </div>

            <div class="col-12" id="furniture" style="display: none;">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control options furniture {{ errors.height ? 'is-invalid' : '' }}" id="height" placeholder="Height">

                <label for="width " class="form-label">Width</label>
                <input type="text" class="form-control options furniture {{ errors.width ? 'is-invalid' : '' }}" id="width" placeholder="Width">

                <label for="length " class="form-label">Length</label>
                <input type="text" class="form-control options furniture {{ errors.length ? 'is-invalid' : '' }}" id="length" placeholder="Length">
                <small class="text-muted">*Please, provide dimensions</small>
            </div>
            <div class="invalid-feedback d-block">
                {{ errors.height| first }}
            </div>
            <div class="invalid-feedback d-block">
                {{ errors.width| first }}
            </div>
            <div class="invalid-feedback d-block">
                {{ errors.length| first }}
            </div>

    </form>
</div>
{% endblock %}