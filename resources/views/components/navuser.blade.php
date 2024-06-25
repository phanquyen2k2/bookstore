<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .navbar {
            margin-bottom: 0; /* Loại bỏ khoảng cách mặc định phía dưới của navbar */
            background-color: #ffffff; /* Thiết lập màu nền trắng cho navbar */
        }
        .content {
            padding-top: 20px; /* Điều chỉnh khoảng cách phía trên của nội dung */
            background-color: #ffffff; /* Thiết lập màu nền trắng cho nội dung */
        }
        body {
            background-color: #f8f9fa; /* Màu nền tổng thể của trang */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route("orderlist.user") }}">HOME USER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
               
                
            </div>
            <a class="nav-link" href="{{ route("index") }}">Home Page</i></a>
        </div>
    </nav>
</body>
</html>
