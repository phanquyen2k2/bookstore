@extends('home.app')

@section('title', 'Author')

@section('content')
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    
</head>

<body>
   
       <!-- Start Offset Wrapper -->
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover; padding-top: 50px;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="{{ route('index') }}" style="font-weight: bold; font-size: 18px;"> Home </a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a class="breadcrumb-item" href="{{ route('list.book') }}" style="font-weight: bold; font-size: 18px;"> Books </a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active" style="font-weight: bold; font-size: 18px;"> {{ $books->title }} </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Product Details Area -->
<section class="htc__product__details bg__white ptb--20" style="margin-top:50px">
    <!-- Start Product Details Top -->
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <!-- Start Product Big Images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <img src="{{ asset($books->image_url) }}" alt="full-image" style="width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                        <!-- End Product Big Images -->
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-20 xmt-20">
                    <div class="ht__product__dtl" >
                        <h2 style="font-size: 28px; ">{{ $books->title }}</h2>
                        <h6 style="margin-bottom: 10px; margin-top:10px">Author: <span><a href="{{ route("author.products",$books->author->name) }}">{{ $books->author->name }}</a></span></h6>
                        <ul class="pro__prize" style="list-style: none; padding: 0;">
                            <li style="font-size: 24px;font-weight: bold; ">Price: {{number_format($books->price) }}đ</li>
                            <li> + Free Shipping</li>
                        </ul>
                        <div class="ht__pro__desc">
                            <div class="sin__desc" style="margin-bottom: 10px;margin-top:10px">
                                @if($books->quanty)
                                <p><span style="font-weight: bold;">Availability:</span> {{ $books->quanty }}</p>
                                @else
                                <p><span style="font-weight: bold;">Availability:</span>Out of stock</p>
                                @endif
                            </div>
                            <div class="sin__desc" style="margin-bottom: 10px;margin-top:10px">
                                <p><span style="font-weight: bold;">Categories:</span></p>
                                <ul class="pro__cat__list" style="list-style: none; padding: 0;">
                                    <li><a href="{{ route("category.products",$books->category->name) }}">{{ $books->category->name }}</a></li>
                                </ul>
                            </div>
                          
                              
                            
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        @if($books->quanty == 0)
                                        <li><a href="javascript:;"> Out of Stock</a></li>
                                        @else
                                        <li><a href="{{ route('addcart.detail', $books->id) }}"><i class="icon-handbag icons" style="font-size: 35px"></i> 
                                        </a></li>
                                        @endif
                                    </ul>
                                </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Details Top -->
</section>
<!-- End Product Details Area -->

<!-- Start Product Description -->
<section class="htc__produc__decription bg__white" style="padding: 30px 0;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Start List And Grid View -->
                <ul class="pro__details__tab" role="tablist" style="text-align: center;">
                    <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab" style="font-size: 18px; font-weight: bold;">Description</a></li>
                </ul>
                <!-- End List And Grid View -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="ht__pro__details__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                        <div class="pro__tab__content__inner">
                            <p style="font-size: 16px; line-height: 1.6;">{{ $books->description }}</p>
                        </div>
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Description -->

</body>

</html>
@endsection
