@extends('home.app')

@section('title', 'Author')

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
    .category-name {
            margin-top: 10px;
            font-size: 1.5em; /* Điều chỉnh kích thước font tùy ý */
        }
</style>

</head>

<body>
    <section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Author</h2>
                    <p class="category-name">{{ $author->name }}</p>
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

       



</body>

</html>
@endsection