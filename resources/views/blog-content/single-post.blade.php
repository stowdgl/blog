<!doctype html>
<html lang="en">

@include('partials.head')
<body>
@if(count($error['general-error'])>0)
  <div class="alert alert-danger" role="alert">
    {{'Что-то пошло не так. Пожалуйста попробуйте еще '}}<a href="/error-occured" class="alert-link">раз</a>! Мы уже работаем над ошибкой.
  </div>
  {{exit}}
@endif


    <div class="wrap">

      @include('partials.header')


      <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">
          <div class="col-md-12 col-lg-8 main-content">
            <img src="{{URL::asset($posts->image)}}" alt="Image" class="img-fluid mb-5">
             <div class="post-meta">
                        <span class="author mr-2"><img src="{{URL::asset('images/person_1.jpg')}}" alt="Colorlib" class="mr-2">  </span> &bullet;
                        <span class="mr-2">{{$posts->created}} </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span>{{' '.$posts->comments->where('is_moderated','=','1')->count()}}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-eye"></span>{{$posts->views}}</span>
             </div>
            <h1 class="mb-4">{{$posts->title}}</h1>
            @foreach($posts->categories as $category)<a class="category mb-5" href="/category/{{$category->id}}">{{$category->title}}</a>@endforeach

            <div class="post-content-body">

              @if(preg_match('/(?:<iframe[^>]*)(?:(?:\/>)|(?:>.*?<\/iframe>))/',htmlspecialchars_decode($posts->content))&&!preg_match('/(?:<script[^>]*)(?:(?:\/>)|(?:>.*?<\/script>))/',htmlspecialchars_decode($posts->content)))
                {!!htmlspecialchars_decode($posts->content)!!}
                @else
                  @if(preg_match('/(?:<script[^>]*)(?:(?:\/>)|(?:>.*?<\/script>))/',htmlspecialchars_decode($posts->content)))
                      {{$posts->content}}
                    @else
                        {!!htmlspecialchars_decode($posts->content)!!}
                      @endif
              @endif

              <div class="row mb-5">
              <div class="col-md-12 mb-4">
                <img src="{{URL::asset('images/img_7.jpg')}}" alt="Image placeholder" class="img-fluid">
              </div>
              <div class="col-md-6 mb-4">
                <img src="{{URL::asset('images/img_9.jpg')}}" alt="Image placeholder" class="img-fluid">
              </div>
              <div class="col-md-6 mb-4">
                <img src="{{URL::asset('images/img_11.jpg')}}" alt="Image placeholder" class="img-fluid">
              </div>
            </div>

            </div>

            
            <div class="pt-5">
              <p>Category:  @if(count($posts->categories)==0) None @endif @foreach($posts->categories as $category)<a href="/category/{{$category->id}}">{{$category->title}}</a>@if(count($category)>1){{', '}}@endif @endforeach
                Tags: @if(count($posts->tags)==0) None @endif @foreach($posts->tags as $tag)<a href="#">{{'#'.$tag->title}}</a>@if(count($tag)>1){{', '}}@endif @endforeach</p>
            </div>


            <div class="pt-5">
              <h3 class="mb-5">@if($posts->comments->where('is_moderated','=','1')->count()==0) Нет комментариев. @else {{$posts->comments->where('is_moderated','=','1')->count().' Comments'}} @endif </h3>

              <ul class="comment-list">
                @if($posts->comments->where('is_moderated','=','1')->count()!=0)
                @foreach($posts->comments->where('is_moderated','=','1') as $comment)
                  @if($comment->comment_id ===null)
                <li class="comment">
                  <div class="vcard">
                    <img src="{{URL::asset('images/person_1.jpg')}}" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3> @if($comment->author !==null) {{$comment->author}} @else {{'Anonymous'}} @endif </h3>
                    <div class="meta">{{date('F d, Y',strtotime($comment->created_at))}} at {{date('H:i',strtotime($comment->created_at))}}</div>
                    <p>{{$comment->comment}}</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                  @else
                      <ul class="children">
                        <li class="comment">
                          <div class="vcard">
                            <img src="{{URL::asset('images/person_1.jpg')}}" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>@if($comment->author !==null) {{$comment->author}} @else {{'Anonymous'}} @endif</h3>
                            <div class="meta">{{date('F d, Y',strtotime($comment->created_at))}} at {{date('H:i',strtotime($comment->created_at))}}</div>
                            <p>{{$comment->comment}}</p>
                            <p><a href="#" id="reply" class="reply rounded">Reply</a></p>
                          </div>
                        </li>
                      </ul>

                    </li>
                    @endif
                  @endforeach
                @endif
                  </ul>



              <!-- END comment-list -->
              @if(auth()->check())
                <div class="comment-form-wrap pt-5 mb-5">
                  <h3 class="mb-5" id="title-comment">Leave a comment</h3>
                  <form action="{{route('add-comment')}}" class="p-5 bg-light" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$posts->id}}">
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea name="comment" id="message" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Post Comment" class="btn btn-primary">
                    </div>

                  </form>
                </div>
              @else
                <div class="comment-form-wrap pt-5">
                  <h3 class="mb-5">Чтобы оставить комментарий, пожалуйста войдите или зарегистрируйтесь!</h3>
                </div>
              @endif
            </div>

          </div>

          <!-- END main-content -->

          @include('partials.sidebar')


        </div>
      </div>
    </section>
    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-3 ">Related Post</h2>
          </div>
        </div>
        <div class="row">
          @foreach($relatedPosts as $relatedPost)
          <div class="col-md-6 col-lg-4">
            <a href="#" class="a-block sm d-flex align-items-center height-md" style="background-image: url('{{URL::asset('images/img_2.jpg')}}'); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category">@foreach($posts->categories as $post){{$post->title}}@endforeach</span><br>
                  <span class="mr-2">{{date('F d, Y',strtotime($relatedPost->created_at))}} </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h3>{{$relatedPost->title}}</h3>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>


    </section>
    <!-- END section -->
  
   @include('partials.footer')
      <!-- END footer -->

    </div>

    @include('partials.script-asset')

  </body>
</html>