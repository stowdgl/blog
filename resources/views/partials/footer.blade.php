<footer class="site-footer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <h3>О нас</h3>
                <p class="mb-4">
                    <img src="{{URL::asset('images/img_1.jpg')}}" alt="Image placeholder" class="img-fluid">
                </p>

                <p>Блог молодого перспективного backend-разработчика. <a href="{{route('about')}}">Читать больше...</a></p>
            </div>
            <div class="col-md-6 ml-auto">
                <div class="row">
                    <div class="col-md-7">
                        <h3>Последние посты</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach($popularPosts as $post)
                                <li>
                                    <a href="/post/{{$post->id}}">
                                        <img src="{{URL::asset('images/img_6.jpg')}}" alt="Image placeholder" class="mr-4">
                                        <div class="text">
                                            <h4>{{$post->title}}</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">{{$post->created}} </span> &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span> {{$post->comments->count()}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-4">

                        <div class="mb-5">
                            <h3>Соц.Сети</h3>
                            <ul class="list-unstyled footer-social">
                                <li><a href="{{env('TELEGRAM_URL')}}"><span class="fa fa-telegram"></span> Telegram</a></li>
                                <li><a href="{{env('INSTAGRAM_URL')}}"><span class="fa fa-instagram"></span> Instagram</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="small">

                    Copyright &copy; <script>document.write(new Date().getFullYear());</script> Все права защищены

                </p>
            </div>
        </div>
    </div>
</footer>