@extends('home.app')

@section('title', 'Home Page')

@section('content')
<head>
    <style>
        .align-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .search-form {
            width: 50%; /* Adjust the width as needed */
            border-radius:5px; 
        }
        .rounded-input {
            border-radius: 20px; /* Adjust the radius as needed */
        }
    </style>
    <style>
        .category {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }
    
        .ht__cat__thumb img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    
        .fr__product__inner {
            padding: 15px 0;
        }
    
        .product__list > div {
            margin-bottom: 30px;
        }
    
        .fr__product__inner h4 {
            margin: 0;
            padding: 0;
            font-size: 1.2em;
            line-height: 1.4em;
            height: 2.8em; /* Set height to fit 2 lines of text */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Number of lines to show */
            -webkit-box-orient: vertical;
        }
    </style>    
</head>
<body>
    <!-- Start Slider Area -->
    <!-- Start Category Area -->
    <section class="htc__category__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Search Book</h2>
                        <p>Unfold the world of knowledge: Where every page tells a story. Explore our collection of books on our online store.</p>
                    </div>
                </div>
            </div>
            <div class="align-center">
                <form class="search-form form-inline" action="{{ route('product.search') }}" method="GET">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Search products..." aria-label="Search products..." aria-describedby="button-addon2" name="query" style="flex-grow: 1;">
                        
                    </div>
                </form>
            </div>
            <!-- End Search Form -->
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list clearfix mt--30">
                        @if($products->count() > 0)
                            <!-- Start Single Category -->
                            @foreach($products as $prd)
                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="category">
                                        <div class="ht__cat__thumb">
                                            <a href="/book-detail/{{ $prd->id }}">
                                                <img src="{{ $prd->image_url }}" alt="product images">
                                            </a>
                                        </div>
                                        <div class="fr__hover__info">
                                            <ul class="product__action">
                                                <li><a onclick="AddCart({{ $prd->id }})" href="javascript:"><i class="icon-handbag icons" style="font-size: 22px"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="fr__product__inner">
                                            <h4><a href="/book-detail/{{ $prd->id }}">{{ $prd->title }}</a></h4>
                                            <ul class="fr__pro__prize">
                                                <li>${{ number_format($prd->price)}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- End Single Category -->
                        @else
                            <div class="col-md-12 text-center">
                                <h2>No products found. Please search for products.</h2>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Phân trang -->
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $products->links() }}
            </div>
        </div>
        <!-- End Phân trang -->
        </div>
    </section>
</body>


    <!-- End Category Area -->
@endsection
