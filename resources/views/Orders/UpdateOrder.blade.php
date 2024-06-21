@extends($layout)
@section('content')
<!DOCTYPE html>
<html lang="en" title="Coding design">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
            border-radius: 50%;
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
        .modal {
        position: relative;
        }

        .btn-close {
        position: absolute;
        top: 10px;
        right: 10px;
        }
    </style>
</head>
<body>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <section class="vh-400" style="background-color: #ffff;">
                <div class="container py-5 h-100 d-flex justify-content-center align-items-center">
                    <div class="row d-flex justify-content-center align-items-center w-100">
                        <div class="col col-xl-12">
                            <div class="card" style="border-radius: 1rem;">
                                <div class="row g-0 justify-content-center">
                                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                        <div class="card-body p-4 p-lg-5 text-black">
                                            <a href="{{ route('orderlist') }}" class="btn-close" aria-label="Close"></a>
                                            <form action="{{ route('order.update', $order->id) }}" method="post">
                                                @csrf
                                                <div class="modal-header justify-content-center">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/3531/3531989.png" alt="Logo">
                                                    <span class="h2 fw-bold mb-0">Edit Order</span>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>ID</h5>
                                                    <input type="text" class="form-control form-control-lg" value="{{ $order->id }}" disabled>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Name</h5>
                                                    <input type="text" name="name" class="form-control form-control-lg" value="{{ $order->name }}" required>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Email</h5>
                                                    <input type="email" name="email" class="form-control form-control-lg" value="{{ $order->email }}" required>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Address</h5>
                                                    <input type="text" name="address" class="form-control form-control-lg" value="{{ $order->address }}" required>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Phone</h5>
                                                    <input type="text" name="phone" class="form-control form-control-lg" value="{{ $order->phone }}" required>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Note</h5>
                                                    <input type="text" name="note" class="form-control form-control-lg" value="{{ $order->note }}">
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Total Quantity</h5>
                                                    <input type="number" name="total_quantity" class="form-control form-control-lg" value="{{ $order->total_quantity }}" required>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Total Price</h5>
                                                    <input type="text" id="total_price" name="total_price" class="form-control form-control-lg" value="{{ number_format($order->total_price, 0, '', '') }}" required>
                                                </div>                                                
                                                <div class="form-outline mb-4">
                                                    <h5>Payment Method</h5>
                                                    <input type="text" name="payment_method" class="form-control form-control-lg" value="{{ $order->payment_method }}" required>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <h5>Status</h5>
                                                    <select name="status" class="form-control form-control-lg" required>
                                                        <option value="{{ \App\Models\Order::STATUS_PENDING }}" {{ $order->status == \App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>Pending</option>
                                                        <option value="{{ \App\Models\Order::STATUS_PROCESSING }}" {{ $order->status == \App\Models\Order::STATUS_PROCESSING ? 'selected' : '' }}>Processing</option>
                                                        <option value="{{ \App\Models\Order::STATUS_COMPLETED }}" {{ $order->status == \App\Models\Order::STATUS_COMPLETED ? 'selected' : '' }}>Completed</option>
                                                        <option value="{{ \App\Models\Order::STATUS_PAID }}" {{ $order->status == \App\Models\Order::STATUS_PAID ? 'selected' : '' }}>Paid</option>
                                                    </select>
                                                </div>
                                                <!-- Thêm dòng hiển thị validate -->
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="pt-1 mb-4">
                                                    <input type="submit" value="Update Order" class="btn btn-dark btn-lg btn-block w-100">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
</body>
</html>
@endsection




    



