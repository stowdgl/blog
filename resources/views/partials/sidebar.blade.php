<div class="col-md-12 col-lg-4 sidebar">
    <div class="sidebar-box search-form-wrap">
        <form action="/posts" class="search-form">
            <div class="form-group">
                <span class="icon fa fa-search"></span>
                <input type="text" class="form-control" id="s" name="search" placeholder="Введите и нажмите Enter...">
            </div>
        </form>
    </div>
    <!-- END sidebar-box -->
    <div class="sidebar-box">
        <div class="bio text-center">
            <img src="{{URL::asset('images/person_1.jpg')}}" alt="Image Placeholder" class="img-fluid">
            <div class="bio-body">
                <h2>David Craig</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
                <p class="social">
                    <a href="{{env('TELEGRAM_URL')}}" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="{{env('INSTAGRAM_URL')}}" class="p-2"><span class="fa fa-telegram"></span></a>
                </p>
            </div>
        </div>
    </div>
    <!-- END sidebar-box -->
    <div class="sidebar-box">
        <h3 class="heading">Популярные посты</h3>
        <div class="post-entry-sidebar">
            <ul>
                @if(count($popularPosts)>0)
                @foreach($popularPosts as $post)
                <li>
                    <a href="/post/{{$post->id}}">
                        <img src="{{URL::asset('images/img_2.jpg')}}" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h4>{{$post->title}}</h4>
                            <div class="post-meta">
                                <span class="mr-2">{{$post->created}}</span>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
                    @endif
            </ul>
        </div>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
        <h3 class="heading">Категории</h3>
        <ul class="categories">
            @if(count($categories)>0)
            @foreach($categories as $category)
                <li><a href="/category/{{$category->id}}">{{$category->title}} <span>({{$category->posts->count()}})</span></a></li>
            @endforeach
                @endif
        </ul>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
        <h3 class="heading">Теги</h3>
        <ul class="tags">

            {{--@foreach($posts as $post )
                @foreach($post->tags as $tag)
            <li><a href="/posts?search-by-tag={{$tag->title}}">{{$tag->title}}</a></li>
                    @endforeach
                @endforeach--}}
                @foreach($tags as $tag)
                <li><a href="/posts?search-by-tag={{$tag->title}}">{{$tag->title}}</a></li>

            @endforeach
        </ul>
    </div>
</div>
<!-- END sidebar -->
