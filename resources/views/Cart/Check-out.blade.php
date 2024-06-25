
@extends('Cart.LayoutCart')

@section('title', 'Check Out')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                @if(Session::has("cart") !=null)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Quanty</h6>
                    </div>
                    <span class="text-muted">{{ Session::get("cart")->totalQuanty }}</span>
                </li>
               
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{ number_format(Session::get("cart")->totalPrice )}}đ</strong>
                </li>
                @endif
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="" action="{{ route('processCheckout') }}" method="post">
                @csrf
                @if($userData)
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="name" placeholder="Username" value="{{ $userData['name'] }}" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ $userData['email'] }}" required="">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                @else
                <!-- Nếu người dùng chưa đăng nhập, hiển thị form nhập thông tin -->
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="name" placeholder="Username" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                @endif
                
                <div class="mb-3">
                    <label for="phone">Phone<span class="text-muted">(Optional)</span></label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone number" required="">
                    <div class="invalid-feedback"> Please enter a valid phone number for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                <div class="mb-3">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" name="note" placeholder="Notes to the seller or shipper">
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="pay">Phương thức thanh toán</label>
                        <select class="custom-select d-block w-100" id="pay" name="payment_method" required="">
                            <option value="">Choose...</option>
                            <option value="COD">COD</option>
                            <option value="VnPayqr">VnPay</option>
                        </select>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">  
    </footer>
</div>
</section>
   
@endsection