<!doctype html>
<html lang="en">
@include('partials.head')
<body>


<div class="wrap">

  @include('partials.header')

  <section class="site-section pt-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-6">
          <h2 class="mb-4">Категория: {{$category->title.' ('.count($category->posts).')'}}</h2>
        </div>
      </div>
      <div class="row blog-entries">
        <div class="col-md-12 col-lg-8 main-content">
          <div class="row mb-5 mt-5">

            <div class="col-md-12">
              @if(count($category->posts)>0)
              @foreach($category->posts as $post)

                <div class="post-entry-horzontal">
                  <a href="/post/{{$post->id}}">
                    <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url({{URL::asset($post->image)}});"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="{{URL::asset('images/person_1.jpg')}}" alt="Colorlib"> DD</span>&bullet;
                        <span class="mr-2">{{$post->created}} </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                      <h2>{{$post->title}}</h2>
                    </span>
                  </a>
                </div>
                <!-- END post -->

              @endforeach
              @else
                <h4>Посты не найдены...</h4>
              @endif
            </div>
          </div>

          <div class="row mt-5">
            <div class="col-md-12 text-center">
              <nav aria-label="Page navigation" class="text-center">

              </nav>
            </div>
          </div>



        </div>

        <!-- END main-content -->

        @include('partials.sidebar')


      </div>
    </div>
  </section>

  @include('partials.footer')

</div>

@include('partials.script-asset')
</body>
</html>