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
            <h2 class="mb-4">Категории: </h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row mb-5 mt-5">

              <div class="col-md-12">
                @if(count($categories)>0)
                @foreach($categories as $category)
                <div class="post-entry-horzontal">
                  <a href="/category/{{$category->id}}">
                    <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url({{URL::asset($category->image)}});"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="{{URL::asset('images/person_1.jpg')}}" alt="Colorlib"> Colorlib</span>&bullet;
                        <span class="mr-2">{{$category->created}} </span> &bullet;
                        <span class="mr-2">{{$category->posts->count()==1?$category->posts->count().' post':$category->posts->count().' posts'}}</span>
                      </div>
                      <h2>{{$category->title}}</h2>
                    </span>
                  </a>
                </div>
                <!-- END post -->
                @endforeach
                  @endif
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-md-12 text-center">
                <nav aria-label="Page navigation" class="text-center">
                  {{$categories->links()}}
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