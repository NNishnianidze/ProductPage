<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title>{% block title %}ScandiWeb{% endblock %}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #F7F7F7;
        }

        .text-primary {
            color: #d63737 !important;
        }

        .nav-link {
            color: #d63737 !important;
        }

        .nav-pills .nav-link.active {
            background-color: #D5D5D5;
        }

        .page-link {
            color: #d63737 !important;
        }

        .form-check-input:checked {
            background-color: rgb(33, 37, 41);
            border-color: rgb(33, 37, 41);
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-1 fw-bold">Pr<span class="text-primary">oduct List</span></span>
            </a>

            <ul class="nav nav-pills align-items-center">

                {% if requestUri == '/' %}
                <li class="nav-item"><a href="/add" class="nav-link fw-bold fs-5 active">ADD</a></li>
                <li class="nav-item"><button class="nav-link fw-bold fs-5" form="delete_form" type="submit">MASS DELETE</button></li>
                {% endif %}

                {% if requestUri == '/add' %}
                <li class="nav-item">
                    <button class="nav-link fw-bold fs-5 active" form="product_form" name="submit" type="submit">Save</button>
                </li>
                <li class="nav-item"><a href="/" class="nav-link fw-bold fs-5">Cancel</a></li>
                {% endif %}

            </ul>
        </header>
    </div>
    <div class="container mt-4">
        {% block content %}{% endblock %}
    </div>
</body>

</html>