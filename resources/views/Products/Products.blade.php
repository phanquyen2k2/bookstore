@extends('Admin.LayoutAdmin');
@section('content')
<!DOCTYPE html>
<html lang="en" title="Coding design">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <style>
        * {
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        main.table {
            width: 100%;
            height: 100vh;
            box-shadow: 0 0.4rem 0.8rem #0005;
            border-radius: 0.8rem;
            overflow: hidden;
        }

        .table__header {
            width: 100%;
            height: 10%;
            background-color: #fff;
            padding: 0.8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table__header .input-group {
            width: 35%;
            height: 100%;
            background-color: #f0f0f0;
            padding: 0 0.8rem;
            border-radius: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.2s;
        }

        .table__header .input-group:hover {
            width: 45%;
            background-color: #e0e0e0;
            box-shadow: 0 0.1rem 0.4rem #0002;
        }

        .table__header .input-group img {
            width: 1.2rem;
            height: 1.2rem;
        }

        .table__header .input-group input {
            width: 100%;
            padding: 0 0.5rem 0 0.3rem;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .table__body {
            width: 95%;
            max-height: calc(89% - 1.6rem);
            background-color: #fff;
            margin: 0.8rem auto;
            border-radius: 0.6rem;
            overflow: auto;
        }

        .table__body::-webkit-scrollbar {
            width: 0.5rem;
            height: 0.5rem;
        }

        .table__body::-webkit-scrollbar-thumb {
            border-radius: 0.5rem;
            background-color: #0004;
            visibility: hidden;
        }

        .table__body:hover::-webkit-scrollbar-thumb {
            visibility: visible;
        }

        table {
            width: 100%;
        }

        td img {
            width: 36px;
            height: 36px;
            border-radius: 10px; */
            vertical-align: middle;
        }

        table, th, td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: left;
        }

        thead th {
            position: sticky;
            top: 0;
            left: 0;
            background-color: #d5d1de;
            cursor: pointer;
            text-transform: capitalize;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr {
            --delay: 0.1s;
            transition: 0.5s ease-in-out var(--delay), background-color 0s;
        }

        tbody tr.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        tbody tr:hover {
            background-color: #f1f1f1 !important;
        }

        tbody tr td,
        tbody tr td p,
        tbody tr td img {
            transition: 0.2s ease-in-out;
        }

        tbody tr.hide td,
        tbody tr.hide td p {
            padding: 0;
            font: 0 / 0 sans-serif;
            transition: 0.2s ease-in-out 0.5s;
        }

        tbody tr.hide td img {
            width: 0;
            height: 0;
            transition: 0.2s ease-in-out 0.5s;
        }
        td {
            text-align: center; /* Căn giữa theo chiều ngang */
            vertical-align: middle; /* Căn giữa theo chiều dọc */
            height: 100px; /* Chiều cao của ô */
        }

        .icon {
            font-size: 25px; /* Tăng kích thước của biểu tượng */
        }
        .modal-dialog {
            max-width: 70%; /* Tăng chiều rộng của modal */
            margin: auto;
            margin-top: 20px;
        }
        .close {
            font-size: 2rem;
            position: absolute;
            right: 1rem;
            top: 1rem;
            cursor: pointer;
        }
        .modal-content {
            padding: 2rem; /* Thêm khoảng đệm bên trong modal */
        }
        .modal-header {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .modal-header img {
            width: 100px;
            height: auto;
        }
        .modal-header .h2 {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    
    <main class="table">
        <section class="table__header">
            <h2>Product List</h2>
            <a  class="btn btn-primary" href="{{ route('add-product') }}">Add Products</a>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Quanty</th>
                        <th>Delete At</th>
                        <th>Update</th>
                        <th>Restore</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                      
                        <td>${{ number_format($book->price) }}</td>
                        <td><img src="{{ $book->image_url }}" alt="Book Image" style="width: 120px; height:100px"></td>
                        <td>{{ $book->author->name }}</td> <!-- Assuming 'name' is the column containing author names -->
                        <td>{{ $book->category->name }}</td> <!-- Assuming 'name' is the column containing category names -->
                        <td>{{ $book->quanty }}</td>
                        <td>{{ $book->deleted_at }}</td>
                        <td><a href="/products/edit-product/{{ $book->id}}"><i class='bx bx-message-square-edit icon'></i></td>
                        <td><a href="/products/restore/{{ $book->id}}"><i class='bx bx-archive-in icon'></i></a></td>
                        <td><a href="/products/delete/{{ $book->id}}"><i class='bx bx-trash icon'></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

<script>
    $(document).ready(function() {
        @if(session('success'))
        alertify.success("{{ session('success') }}");
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        @if ($errors->any())
            // Hiển thị thông báo lỗi sử dụng Alertify
            alert("{{ $errors->first() }}");
        @endif
    });
</script>
 <!-- JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
@endsection
    



