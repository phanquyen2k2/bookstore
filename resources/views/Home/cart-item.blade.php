@if(Session::has("cart"))
<div class="shopping__cart__inner">
    <div class="offsetmenu__close__btn">
        
    </div>
    <div class="shp__cart__wrap">
        @foreach (Session::get("cart")->products as $item)
        <div class="shp__single__product">
            <div class="shp__pro__thumb">
                <a href="#">
                    <img src="{{ $item['productinfor']->image_url }}" alt="product images">
                </a>
            </div>
            <div class="shp__pro__details">
                <h2><a href="product-details.html">{{ $item['productinfor']->title }}</a></h2>
                
                <span class="shp__price">{{ number_format($item['productinfor']->price) }}đ x {{ $item['quanty'] }}</span>
            </div>
            <div class="remove__btn">
                <i class="zmdi zmdi-close" data-id="{{ $item['productinfor']->id }}"></i>
            </div>
        </div>
        @endforeach
    </div>
    <ul class="shoping__total">
        <li class="subtotal">Subtotal:</li>
        <li class="total__price">{{ number_format(Session::get("cart")->totalPrice) }}đ</li>
        <li class="subtotal">Total Quantity:</li>
        <li class="total__price">{{ Session::get("cart")->totalQuanty }}</li>
    </ul>
    <ul class="shopping__btn">
        <li><a href="{{ url("/View-List") }}">View Cart</a></li>
        <li class="shp__checkout"><a href="{{ url("/Check-out") }}">Checkout</a></li>
    </ul>
</div>
@else 
<div class="shopping__cart__inner">
    <div class="offsetmenu__close__btn">
        <a href="#"><i class="zmdi zmdi-close"></i></a>
    </div>
    <h5>No Products</h5>
</div>
@endif