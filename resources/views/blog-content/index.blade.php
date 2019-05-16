<!doctype html>
<html lang="en">
  @include('partials.head')
  <body>
    

    <div class="wrap">

      @include('partials.header')


      <section class="site-section pt-5 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">


              @foreach($posts->take(3) as $post)

              <div class="owl-carousel owl-theme home-slider">
                <div>
                  <a href="/post/{{$post->id}}" class="a-block d-flex align-items-center height-lg" style="background-image: url('{{URL::asset('images/img_1.jpg')}}'); ">
                    <div class="text half-to-full">
                      <span class="category mb-5">@foreach($post->categories as $category){{$category->title}}@endforeach</span>
                      <div class="post-meta">
                        
                        <span class="author mr-2"><img src="{{URL::asset('images/person_1.jpg')}}" alt="Colorlib"> @if(count($post->users)>0)@foreach($post->users as $user){{$user->name}}@endforeach @else Anonymous @endif</span>&bullet;
                        <span class="mr-2">{{$post->created}} </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> {{$post->comments->where('is_moderated','=','1')->count()}}</span>
                        
                      </div>
                      <h3>{{$post->title}}</h3>
                      <p>{{$post->content}}</p>
                    </div>
                  </a>
                </div>


                @endforeach

              </div>
              
            </div>
          </div>
          
        </div>


      </section>
      <!-- END section -->

      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Последние посты</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row">

                @if(count($posts)>0)
                @foreach($posts as $post)
                <div class="col-md-6">
                  <a href="/post/{{$post->id}}" class="blog-entry element-animate" data-animate-effect="fadeIn">
                    <img src="{{$post->image}}" alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="@if(count($post->users)>0)@foreach($post->users as $user){{$user->photo}} @endforeach @else /images/person_1.jpg @endif" alt="Image">@if(count($post->users)>0)@foreach($post->users as $user){{$user->name}}@endforeach @else Anonymous  @endif</span>&bullet;
                        <span class="mr-2">{{$post->created}}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments">{{$post->comments->where('is_moderated','=','1')->count()}}</span></span> &bullet;
                        <span class="ml-2"><span class="fa fa-eye">{{$post->views}}</span></span>
                      </div>
                      <h2>{{$post->title}}</h2>
                    </div>
                  </a>
                </div>
                @endforeach
                  @endif
              </div>

              <div class="row mt-5">
                <div class="col-md-12 text-center">
                  <nav aria-label="Page navigation" class="text-center">
                    {{$posts->links()}}
                  </nav>
                </div>
              </div>


            </div>

            <!-- END main-content -->

            @include('partials.sidebar')

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