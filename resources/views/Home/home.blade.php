@extends('home.app')

@section('title', 'Home Page')

@section('content')
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

<!-- Start Slider Area -->
<div class="slider__container slider--one bg__cat--3" style="height: 500px; display: flex; align-items: center; justify-content: center;margin-top:20px">
    <div class="slide__container slider__activation__wrap owl-carousel">
        <!-- Start Single Slide -->
        <div class="single__slide animation__style01 slider__fixed--height" style="height: 80%;">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>collection 2024</h2>
                                <h1>emerging books</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                        <div class="slide__thumb">
                            <img src="https://bizbooks.vn/uploads/images/2024/thang-1/4-cuon-sach-nen-doc-2024-bizbooks.jpg" alt="slider images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
        <!-- Start Single Slide -->
        <div class="single__slide animation__style01 slider__fixed--height" style="height: 80%;">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>published 2024</h2>
                                <h1>Promotion</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                        <div class="slide__thumb">
                            <img src="https://307a0e78.vws.vegacdn.vn/view/v2/image/img.media/oanh-nt/banner%20mkt%208.5.24-812x400.png" alt="slider images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
    </div>
</div>
<!-- End Slider Area -->

<!-- Start Category Area -->
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">New Book</h2>
                    <p>Unfold the world of knowledge: Where every page tells a story. Explore our collection of books on our online store.</p>
                </div>
            </div>
        </div>
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list clearfix mt--30">
                    <!-- Start Single Category -->
                    @foreach($products as $prd)
                    <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 mb--30">
                        <div class="category">
                            <div class="ht__cat__thumb">
                                <a href="/book-detail/{{ $prd->id }}">
                                    <img src="{{ $prd->image_url }}" alt="product images" class="product-image">
                                </a>
                            </div>
                            <div class="fr__hover__info">
                                <ul class="product__action">
                                    @if($prd->quanty == 0)
                                        <li><a href="javascript:;"> Out of Stock</a></li>
                                    @else
                                        <li><a onclick="AddCart({{ $prd->id }})" href="javascript:;"><i class="icon-handbag icons" style="font-size: 22px"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="fr__product__inner text-center">
                                <h4><a href="/book-detail/{{ $prd->id }}">{{ $prd->title }}</a></h4>
                                <ul class="fr__pro__prize">
                                    <li>{{ number_format($prd->price)}}đ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <!-- End Single Category -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Category Area -->
    <!-- Phần Sản Phẩm Bán Chạy Nhất -->
    <section class="htc__category__area ptb--10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Best Sellers</h2>
                        <p>Discover bestsellers that readers love.</p>
                    </div>
                </div>
            </div>
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list clearfix mt--30">
                        <!-- Bắt Đầu Danh Mục Đơn -->
                        @foreach($bestSellingProducts as $prd)
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="/book-detail/{{ $prd->id }}">
                                        <img src="{{ $prd->image_url }}" alt="Hình ảnh sản phẩm">
                                    </a>
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        @if($prd->quanty == 0)
                                        <li><a href="javascript:;"> Out of Stock</a></li>
                                    @else
                                        <li><a onclick="AddCart({{ $prd->id }})" href="javascript:;"><i class="icon-handbag icons" style="font-size: 22px"></i></a></li>
                                    @endif
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4><a href="/book-detail/{{ $prd->id }}">{{ $prd->title }}</a></h4>
                                    <ul class="fr__pro__prize">
                                        <li>{{ number_format($prd->price) }}đ</li>
                                    </ul>
                                    <div class="best-selling-quantity">
                                        <small>Total sold: {{ $prd->total_quantity }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Kết Thúc Danh Mục Đơn -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Kết Thúc Phần Sản Phẩm Bán Chạy Nhất -->

<!-- Scripts -->
<script>
    function AddCart(id) {
        $.ajax({
            url: '/Add-Cart/' + id,
            type: 'GET',
            success: function(response) {
                RenderCart(response);
                alertify.success('Added product to cart successfully');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
            }
        });
    }

    $("#change-item-cart").on("click", ".remove__btn i", function () {
        $.ajax({
            url: '/Delete-Item-Cart/' + $(this).data("id"),
            type: 'GET',
            success: function(response) {
                RenderCart(response);
                alertify.success('Product deletion was successful');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
            }
        });
    });

    function RenderCart(response) {
        $("#change-item-cart").empty();
        $("#change-item-cart").html(response);
        $("#total-quanty-show").text($("#total-quanty-cart").val());
    }

    $(document).ready(function() {
        @if(session('success'))
            alertify.success("{{ session('success') }}");
        @endif

        @if ($errors->any())
            alert("{{ $errors->first() }}");
        @endif
    });
</script>
@endsection
