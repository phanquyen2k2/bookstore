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
    </header>