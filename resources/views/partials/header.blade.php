<header role="banner">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="@if(!auth()->check()) col-5 @else col-7 @endif social">
                    <a href="{{env('TELEGRAM_URL')}}"><span class="fa fa-telegram"></span></a>
                    <a href="{{env('INSTAGRAM_URL')}}"><span class="fa fa-instagram"></span></a>
                </div>
                @if(auth()->check())
                <div class="col-2 dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{auth()->user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="/logout" method="post">
                            @csrf
                        <button type="submit" class="dropdown-item">Выйти</button>
                        </form>
                    </div>
                </div>
                    @else
                    <div class="col-2 authreg" style="color:#fff;">
                        <a href="/register">Зарегистрироваться</a>
                    </div>
                    <div class="col-2 authreg" style="color:#fff;">
                        <a href="/login">Войти</a>
                    </div>
                @endif

                <div class="col-3 search-top ">
                    <!-- <a href="#"><span class="fa fa-search"></span></a> -->
                    <form action="/posts" class="search-top-form">
                        <span class="icon fa fa-search"></span>
                        <input type="text" id="s" name="search" placeholder="Введите и нажмите Enter..." value="{{old('search')}}">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container logo-wrap">
        <div class="row pt-5">
            <div class="col-12 text-center">
                <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
                <h1 class="site-logo"><a href="{{route('home-page')}}">Wordify</a></h1>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container">


            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if($active_page=='Домашняя') active @endif" href="{{route('home-page')}}">Домашняя</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($active_page=='Список постов') active @endif" href="{{route('all-posts')}}">Список постов</a>
                    </li>
                    {{--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Travel</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="category.html">Asia</a>
                            <a class="dropdown-item" href="category.html">Europe</a>
                            <a class="dropdown-item" href="category.html">Dubai</a>
                            <a class="dropdown-item" href="category.html">Africa</a>
                            <a class="dropdown-item" href="category.html">South America</a>
                        </div>

                    </li>--}}

                    <li class="nav-item">
                        <a class="nav-link @if($active_page=='Категории') active @endif" href="{{route('categories')}}">Категории</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($active_page=='О нас') active @endif" href="{{route('about')}}">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($active_page=='Контакты') active @endif" href="{{route('contact')}}">Контакты</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>
<!-- END header -->