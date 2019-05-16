<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('admin.partials.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
        @include('admin.partials.topbar')


            <!-- Begin Page Content -->
            <div class="container-fluid">

              <div>

                  <h2 class="text-center">Добавить пост</h2>

                  <div class="col-12">
                      <form action="/admin/add-post" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                              <input type="file" name="upload_image" class="custom-file-input @error('upload_image') is-invalid @enderror"
                                     id="validatedCustomFile" required>
                              <label class="custom-file-label" for="validatedCustomFile">Выбрать файл
                                  изображения...</label>
                              @error('upload_image')
                              <span class="invalid-feedback" role="alert"  style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                          </div>
                          <div class="form-group">

                              <label for="validationServer01">Название статьи</label>
                              <input type="text" class="form-control @error('title') is-invalid @enderror" id="validationServer01" name="title"
                                     placeholder="Название" required>
                              @error('title')
                              <span class="invalid-feedback" role="alert"  style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label for="exampleFormControlSelect1">Категория</label>
                              <select class="form-control @error('category') is-invalid @enderror"  id="exampleFormControlSelect1" name="category" required>
                                  @foreach($categories as $category)
                                      <option value="{{$category->id}}">{{$category->title}}</option>
                                  @endforeach
                              </select>
                              @error('category')
                              <span class="invalid-feedback" role="alert"  style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label for="post-content">Содержание</label>
                              <textarea class="form-control @error('content') is-invalid @enderror" id="post-content" name="content"></textarea>
                              @error('content')
                              <span class="invalid-feedback" role="alert"  style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                          </div>

                          <input class="btn btn-primary" type="submit" value="Добавить пост">
                      </form>
                  </div>

              </div>




            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @include('admin.partials.footer')

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@include('admin.partials.footer-content')
@include('admin.partials.script-asset')

</body>

</html>
