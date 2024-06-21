@extends($layout)
@section('content')
<!DOCTYPE html>
<html lang="en" title="Order Table">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />
    <style>
        * {
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        main.table {
            width: 100%;
            height: 100%;
            margin-top: 30px;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        td {
            text-align: center; /* Căn giữa theo chiều ngang */
            vertical-align: middle; /* Căn giữa theo chiều dọc */
            height: 100px; /* Chiều cao của ô */
        }

        .icon {
            font-size: 25px; /* Tăng kích thước của biểu tượng */
        }

        .order-details-btn {
            background-color: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .order-details-btn:hover {
            background-color: transparent;
        }
        .table-centered {
            margin: 0 auto;
            text-align: center;
        }
        .table-centered th, .table-centered td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>
    <main class="table">
        <section class="table__header">
            <h2>Order List</h2>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Total Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Cancel Order</th>
                        <th>Update</th>
                        <th>Information Details</th>
                        <th>Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderslist as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->total_quantity }}</td>
                        <td>{{ number_format($order->total_price) }}đ</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->status }}</td>
                        <td><a href="admin/orders/cancel-form/{{ $order->id }}"><i class='bx bx-message-alt-x icon'></i></a></td>
                        <td><a href="/orders/edit-order/{{ $order->id }}"><i class='bx bx-message-square-edit icon'></i></a></td>
                        <td><button class="order-details-btn" onclick="viewInforDetails({{ $order->id }})"><i class='bx bx-user icon'></i></button></td>
                        <td><button class="order-details-btn" onclick="viewOrderDetails({{ $order->id}})"><i class='bx bx-basket icon'></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <div id="orderDetailModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Order Details</h2>
            <div id="orderDetailsTable">
                <!-- Order details will be injected here -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
            $(document).ready(function() {
            @if(session('success'))
                alertify.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                alertify.error("{{ session('error') }}");
            @endif
        });
        // Hiển thị chi tiết thông tin đơn hàng
        function viewInforDetails(userId) {
            console.log("xem chi tiết user");
    fetch(`/infor-details/${userId}`)
        .then(response => response.json())
        .then(data => {
            const orderDetailsTable = $('#orderDetailsTable');
            let tableHTML = `
                <table class="table__body">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Note</th>
                            <th>Cancel Reason</th>
                        </tr>
                    </thead>
                    <tbody>`;

            if (data) {
                if (Array.isArray(data)) {
                    data.forEach(order => {
                        tableHTML += `
                            <tr>
                                <td>${order.id}</td>
                                <td>${order.email}</td>
                                <td>${order.address}</td>
                                <td>${order.phone}</td>
                                <td>${order.note}</td>
                                <td>${order.cancel_reason ? order.cancel_reason : 'N/A'}</td>
                            </tr>`;
                    });
                } else {
                    tableHTML += `
                        <tr>
                            <td>${data.id}</td>
                            <td>${data.email}</td>
                            <td>${data.address}</td>
                            <td>${data.phone}</td>
                            <td>${data.note}</td>
                            <td>${data.cancel_reason ? data.cancel_reason : 'N/A'}</td>
                        </tr>`;
                }
            } else {
                tableHTML += `<tr><td colspan="6">No details available</td></tr>`;
            }

            tableHTML += `</tbody></table>`;
            orderDetailsTable.html(tableHTML);
            $('#orderDetailModal').css('display', 'block');
        })
        .catch(error => {
            console.error('Error fetching order details:', error);
        });
      }

        //  hiển thị chi tiết danh sách các sản phảm 
        function viewOrderDetails(orderId) {
            console.log("xem chi tiết orders");
            fetch(`/order-details/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    const orderDetailsTable = document.getElementById('orderDetailsTable');
                    let tableHTML = `
                        <table class="table__body">
                            <thead>
                                <tr>
                         
                                    <th>Order ID</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>`;
                    
                    data.forEach(detail => {
                        tableHTML += `
                            <tr>
                                
                                <td>${detail.order_id}</td>
                                <td>${detail.product_id}</td>
                                <td>${detail.product_name}</td>
                                <td>${detail.quantity}</td>
                                <td>${detail.price}</td>
                            </tr>`;
                    });

                    tableHTML += `</tbody></table>`;
                    orderDetailsTable.innerHTML = tableHTML;
                    document.getElementById('orderDetailModal').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching order details:', error);
                });
        }

        function closeModal() {
            document.getElementById('orderDetailModal').style.display = 'none';
        }
    </script>
</body>
</html>
@endsection