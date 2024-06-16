<section class="h-80 h-custom" id="list-cart">
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
                                    @if(Session::has("cart") !=null)
                                    @foreach (Session::get("cart")->products as $item)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ $item['productinfor']->image_url }}"
                                                class="img-fluid rounded-3" alt="">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{ $item['productinfor']->title }}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <div class="input-group">
                                                <input min="0" max="50" name="quantity" value="{{ $item['quanty'] }}"
                                                    type="number" class="form-control form-control-sm"
                                                    data-id="{{$item['productinfor']->id}}"
                                                    id="quanty-item-{{$item['productinfor']->id}}" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0">{{number_format($item['price'])}}đ</h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#" class="text-muted"><i class="fas fa-times"
                                                    onclick="DeleteListItemCart({{$item['productinfor']->id}})"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <!-- Sample Item End -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="{{ url(" /") }}" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
                                            </h6>
                                        </div>
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a class="btn btn-dark btn-lg btn-update" href="#"
                                                    data-mdb-ripple-color="red">Update Cart</a></h6>
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
                                    <div class="btn-group">
                                        <a class="btn btn-dark btn-lg" href="{{ url("/Check-out") }}"
                                            data-mdb-ripple-color="dark">Register</a>
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