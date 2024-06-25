<div class="wrapper">
    <!-- Start Header Style -->
    <header id="htc__header" class="htc__header__area header--one">
        <!-- Start Mainmenu Area -->
        <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
            <div class="container">
                <div class="row">
                    <div class="menumenu__container clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                            <div class="logo">
                                <img src="https://cdn-icons-png.flaticon.com/512/3531/3531989.png" style="width: 60px; height: auto;">
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                            <nav class="main__menu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li class="drop"><a href="{{ route('index') }}">Home</a></li>
                                    <li class="drop"><a href="{{ route('list.book') }}">Books</a></li>
                                    <li class="drop">
                                        <a href="">Category</a>
                                        <ul class="dropdown">
                                            @foreach($categories as $category)
                                            <li><a href="{{ route("category.products",$category->name) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="drop"><a href="#">Author</a>
                                        <ul class="dropdown">
                                            @foreach($authors as $author)
                                            <li><a href="{{ route("author.products",$author->name) }}">{{ $author->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>    
                                    </li>
                                    <li class="drop"><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li class="drop"><a href="{{ route('index') }}">Home</a></li>
                                            <li class="drop"><a href="{{ route('list.book') }}">Books</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li class="drop"><a href="{{ route('index') }}">Home</a></li>
                                        <li class="drop"><a href="{{ route('list.book') }}">Books</a></li>
                                        <li><a href="#">Pages</a>
                                            <ul>
                                               <li class="drop"><a href="{{ route('index') }}">Home</a></li>
                                               <li class="drop"><a href="{{ route('list.book') }}">Books</a></li>
                                               <li><a href="{{ route('contact') }}">Contact</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>  
                        </div>
                        <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                            <div class="header__right">
                                <div class="header__search">
                                    <a href="{{ route('product.search') }}"><i class="icon-magnifier icons"></i></a>
                                </div>
                                <div class="header__account">
                                    <a href="{{ route('login') }}"><i class="icon-user icons"></i></a>
                                </div>
                                <div class="htc__shopping__cart">
                                    <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-area"></div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
    </header>
        <!-- End Header Area -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Cart Panel -->
            {{--Hiển thị sản phẩm trong giỏ hàng --}}
            <div class="shopping__cart">
                <div id="change-item-cart">
                    @if(Session::has("cart"))
                    <div class="shopping__cart__inner">
                        <div class="offsetmenu__close__btn">
                            <a href="#"><i class="zmdi zmdi-close"></i></a>
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
                                    
                                    <span class="shp__price">{{ number_format($item['productinfor']->price )}}đ x {{ $item['quanty'] }}</span>
                                </div>
                                <div class="remove__btn">
                                    <i class="zmdi zmdi-close" data-id="{{ $item['productinfor']->id }}"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <ul class="shoping__total">
                            <li class="subtotal">Subtotal:</li>
                            <li class="total__price">{{ number_format( Session::get("cart")->totalPrice) }}đ</li>
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
                </div>
            </div>
            
        <!-- End Offset Wrapper -->