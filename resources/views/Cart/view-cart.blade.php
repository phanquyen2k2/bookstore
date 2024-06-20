@extends('Cart.LayoutCart')

@section('title', 'Shopping Cart')

@section('content')
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    </head>
</html>
<section class="h-80 h-custom" style="margin-top: -100px;" id="list-cart">
    <div class="container py-5 h-80">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h2 class="fw-bold mb-0 text-black">Shopping Cart</h2>
                                    </div>
                                    <hr class="my-4">
                                    <!-- Sample Item Start -->
                                    <div class="table-responsive" style="max-height: 300px; overflow-x: auto; overflow-y: auto;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">Image</th>
                                                    <th scope="col" class="text-center">Product Name</th>
                                                    <th scope="col" class="text-center">Quantity</th>
                                                    <th scope="col" class="text-center">Price</th>
                                                    <th scope="col" class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Session::get("cart")->products as $item)
                                                <tr>
                                                    <td style="max-width: 50px;" class="text-center"><img src="{{ $item['productinfor']->image_url }}" class="img-fluid rounded-3" alt=""></td>
                                                    <td class="text-center"><strong>{{ $item['productinfor']->title }}</strong></td>
                                                    <td class="text-center">
                                                        <input min="0" max="50" name="quantity" value="{{ $item['quanty'] }}" type="number" class="form-control form-control-sm text-center" data-id="{{$item['productinfor']->id}}" id="quanty-item-{{$item['productinfor']->id}}" />
                                                    </td>
                                                    <td class="text-center"><strong>{{ number_format($item['price']) }}đ</strong></td>
                                                    <td class="text-center">
                                                        <a href="#" class="text-muted"><i class="fas fa-times" onclick="DeleteListItemCart({{$item['productinfor']->id}})"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                
                                    <!-- Sample Item End -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="{{ url("/") }}" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
                                            </h6>
                                        </div>
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a class="btn btn-dark btn-lg btn-update" href="" data-mdb-ripple-color="red">Update Cart</a></h6>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1 summary-heading">Summary</h3>
                                    <hr class="my-4">
                                    @if(Session::has("cart") !=null)
                                    <div class="d-flex justify-content-between mb-4 shopping-cart-item">
                                        <h5 class="text-uppercase">Items</h5>
                                        <h5>{{ Session::get("cart")->totalQuanty }}</h5>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-5 shopping-cart-item">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5>{{ number_format(Session::get("cart")->totalPrice )}}đ</h5>
                                    </div>
                                    @endif
                                    <div class="btn-group d-flex justify-content-center" style="width: 320px;">
                                        <a class="btn btn-dark btn-lg" href="{{ url("/Check-out") }}" data-mdb-ripple-color="dark">Register</a>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<style>
    body {
        background-color: #ffff;
    }

    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }

    .bg-grey {
        background-color: #eae8e8;
    }

    @media (min-width: 992px) {
        .card-registration-2 .bg-grey {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }

    @media (max-width: 991px) {
        .card-registration-2 .bg-grey {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        /* Khoảng cách giữa các nút */
    }

    .card-registration-2 .summary-heading {
        font-size: 2rem;
        /* Tăng cỡ chữ cho tiêu đề "Summary" */
    }

    .card-registration-2 .shopping-cart-item {
        font-size: 1rem;
        /* Giảm cỡ chữ cho shopping cart */
    }

    .btn-update {
        color: white;
        border-color: black;
    }

    .btn-update:hover,
    .btn-update:active {
        color: black;
        background-color: gray;
    }

    a.btn {
        text-decoration: none;
        /* Loại bỏ gạch ngang dưới chân nút */
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function DeleteListItemCart(id) {
        $.ajax({
            url: '/Delete-Item-List-Cart/' + id,
            type: 'GET',
        }).done(function (response) {
            RenderListCart(response);
            alertify.success('Delete product from cart successfully');
        });
    }
    function RenderListCart(response) {
        $("#list-cart").empty();
        $("#list-cart").html(response);
    }
</script>
<script>
    document.querySelector('.btn-update').addEventListener('click', function (e) {
    e.preventDefault();
    updateCart();
});

function updateCart() {
    let quantities = {};
    document.querySelectorAll('input[name="quantity"]').forEach(function (input) {
        let id = input.getAttribute('data-id');
        let quantity = input.value;
        quantities[id] = quantity;
    });

    fetch('/save-list-item-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ quantities: quantities })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cập nhật lại trang với thông tin giỏ hàng mới
            // document.querySelector('.summary-heading').innerText = `Summary (${data.totalQuanty} items)`;
            // Các phần cập nhật khác nếu cần
            location.reload(); // Tải lại trang để cập nhật giao diện
        } else {
            alert('Cập nhật giỏ hàng thất bại. Vui lòng thử lại.');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
<script>
    $(document).ready(function () {
        $(".btn-update").click(function (event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của nút

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var items = [];

            // Lặp qua từng sản phẩm trong giỏ hàng và thu thập dữ liệu
            $("input[name='quantity']").each(function () {
                var productId = $(this).data("id");
                var newQuantity = $(this).val();
                items.push({
                    key: productId,
                    value: newQuantity
                });
            });

            // Gửi yêu cầu AJAX để cập nhật giỏ hàng
            $.ajax({
                url: '{{ route('save_all_list_item_cart') }}',
                type: 'POST',
                data: {
                    _token: csrfToken,
                    data: items
                },
                success: function (response) {
                    if (response.success) {
                        // Cập nhật tổng số lượng và tổng giá trị
                        $(".summary-heading").text("Summary");
                        $(".shopping-cart-item").eq(0).find("h5").eq(1).text(response.totalQuanty);
                        $(".shopping-cart-item").eq(1).find("h5").eq(1).text(response.totalPrice.toLocaleString('vi-VN') + "đ");
                        // Cập nhật giá và số lượng cho từng sản phẩm (nếu cần)
                        $("input[name='quantity']").each(function () {
                            var productId = $(this).data("id");
                            var newQuantity = $(this).val();
                            // Cập nhật thông tin sản phẩm nếu cần thiết
                        });
                        alertify.success("Cart updated successfully!");

                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                }
            });
        });
    });
</script>
