@extends('home.app')

@section('title', 'List Books')

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
    <!-- Start Category Area -->
    <section class="htc__category__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">List Book</h2>
                        <p>Unfold the world of knowledge: Where every page tells a story. Explore our collection of books on our online store.</p>
                    </div>
                </div>
            </div>
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list clearfix mt--30">
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
                                        <li>{{ number_format($prd->price) }}đ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
    
                        <!-- Phân trang -->
            <div class="row">
                <div class="col-md-12 text-center mt-10 mb-10" >
                    {{ $products->links() }}
                </div>
            </div>

            <!-- End Phân trang -->
    
        </div>
    </section>
    
    <!-- End Category Area -->
@endsection
