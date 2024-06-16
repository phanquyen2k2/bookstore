<!-- resources/views/layouts/app.blade.php -->
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        /* Basic styling for the product card */
        .category {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            transition: box-shadow 0.3s ease;
            border-radius: 15px;
            background: #fffefe; /* Light background color */
        }
        .category:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .ht__cat__thumb img {
            width: 100%;
            height: auto;
        }
        .fr__hover__info {
            position: relative;
            margin-top: 10px;
        }
        .fr__hover__info ul {
            list-style: none;
            padding: 0;
        }
        .fr__hover__info ul li {
            display: inline-block;
            margin: 0 5px;
        }
        .fr__hover__info ul li a {
            color: #333;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .fr__hover__info ul li a:hover {
            color: #f39c12;
        }
        .fr__product__inner h4 a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .fr__product__inner h4 a:hover {
            color: #f39c12;
        }
        .fr__pro__prize {
            list-style: none;
            padding: 0;
            margin-top: 5px;
        }
        .fr__pro__prize li {
            display: inline-block;
            margin: 0 5px;
            font-size: 16px;
        }
        .fr__pro__prize .old__prize {
            text-decoration: line-through;
            color: #888;
        }
    </style>

<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/core.css') }}">
<link rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<!-- Modernizr JS -->
<script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body>
    @include('layouts.header')
        @yield('content')
    @include('layouts.footer')
</body>
</html>
 <!-- Include JavaScript files -->
 <script src="{{ asset('js/vendor/jquery-3.2.1.min.js') }}"></script>
 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/plugins.js') }}"></script>
 <script src="{{ asset('js/slick.min.js') }}"></script>
 <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('js/waypoints.min.js') }}"></script>
 <script src="{{ asset('js/main.js') }}"></script>

<!-- AlertifyJS for notifications -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />

<script>
    function AddCart(id) {
        $.ajax({
            url: '/Add-Cart/' + id,
            type: 'GET',
            success: function(response) {
                RenderCart(response);
                alertify.success('Added product to cart successfully');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
            }
        });
    }

    $("#change-item-cart").on("click", ".remove__btn i", function () {
        console.log("đã vào xóa");
        $.ajax({
            url: '/Delete-Item-Cart/' + $(this).data("id"),
            type: 'GET',
            success: function(response) {
                RenderCart(response);
                alertify.success('Product deletion was successful');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
            }
        });
    });

    function RenderCart(response) {
        $("#change-item-cart").empty();
        $("#change-item-cart").html(response);
        $("#total-quanty-show").text($("#total-quanty-cart").val());
    }

    $(document).ready(function() {
        @if(session('success'))
            alertify.success("{{ session('success') }}");
        @endif
    });
</script>
