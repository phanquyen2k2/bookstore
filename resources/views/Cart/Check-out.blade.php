
@extends('home.app')

@section('title', 'Checkout')

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
                    <strong>${{ Session::get("cart")->totalPrice }}</strong>
                </li>
                @endif
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="" action="{{ route('processCheckout') }}" method="post">
                @csrf
                <div class="row"></div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="name" placeholder="Username" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone">Phone<span class="text-muted">(Optional)</span></label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone number" required="">
                    <div class="invalid-feedback"> Please enter a valid phone number for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
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
                            <option value="VnPayqr">VnPayqr</option>
                        </select>
                    </div>
                </div>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .container {
  max-width: 960px;
}

.lh-condensed { line-height: 1.25; }
    </style>
</head>
<body>
    <script>(function () {
        'use strict'
        window.addEventListener('load', function () {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation')
      
          // Loop over them and prevent submission
          Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
              if (form.checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
              }
              form.classList.add('was-validated')
            }, false)
          })
        }, false)
      }())</script>
      <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
      <script>
          @if(session('error'))
              alertify.error("{{ session('error') }}");
          @endif
      </script>
    
</body>
</html>