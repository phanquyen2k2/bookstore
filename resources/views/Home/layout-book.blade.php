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

    
    <!-- Place favicon.ico in the root directory -->
    <!-- Thay đổi favicon -->
    
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
<!-- Thay đổi apple-touch-icon -->
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

<!-- Tất cả các tệp CSS được bao gồm ở đây -->
<!-- CSS chính của Bootstrap framework -->
    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">
     <style>
        body {
    font-family: 'Arial', sans-serif;
    }

     </style>
</head>
<body>
    @include('layouts.header')

    <div class="container">
        

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Book Detail - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles1.css') }}" rel="stylesheet" />
</head>
<body>

<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="{{ $book->image_url }}" alt="{{ $book->title }}" style="width: 100%; max-width: 500px; height: auto;" />
            </div>
            <div class="col-md-6">
                {{-- <div class="small mb-1">Author: {{ $book->author->name }}</div>
                <div class="small mb-1">Category: {{ $book->category->name }}</div> --}}
                <h1 class="display-5 fw-bolder">{{ $book->title }}</h1>
                <div class="fs-5 mb-5">
                    <span>${{ $book->price }}</span>
                </div>
                <p class="lead">{{ $book->description }}</p>
                <form>
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>



<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>


    </div>
    @include('layouts.footer')
       
  
    
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>

       <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>
        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
   
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css" />
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />
       <script>
           function AddCart(id) {
               $.ajax({
                   url: '/Add-Cart/' + id,
                   type: 'GET',
   
               }).done(function (response) {
   
                   RenderCart(response);
                   alertify.success('Added product to cart successfully')
               });
           }
           $("#change-item-cart").on("click", ".remove__btn i", function () {
   
               $.ajax({
                   url: '/Delete-Item-Cart/' + $(this).data("id"),
                   type: 'GET',
   
               }).done(function (response) {
   
                   RenderCart(response);
                   alertify.success('Product deletion was successful')
               });
           });
           function RenderCart(response) {
               $("#change-item-cart").empty();
               $("#change-item-cart").html(response);
               $("#total-quanty-show").text($("#total-quanty-cart").val())
              
           }
       </script>
          
</body>
</html>
