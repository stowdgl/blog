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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Комментарии ожидающие модерации</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <table class="table table-hover">
                                        <caption>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    Showing 1 to 10 of {{$comments_count}} entries
                                                </div>
                                                <div class=" col-md-7">
                                                    {{$comments->links()}}
                                                </div>
                                            </div>
                                        </caption>
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Комментарий</th>
                                            <th scope="col">Автор</th>
                                            <th scope="col">Пост</th>
                                            <th scope="col">Пост</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($comments as $comment)
                                            <tr>
                                                <th scope="row">{{$count++}}</th>
                                                <td>{{$comment->comment}}</td>
                                                <td>{{$comment->author}}</td>
                                                <td>
                                                    <a href="/post/{{$comment->posts->id}}">{{$comment->posts->title}}</a>
                                                </td>
                                                <td>
                                                    <form action="{{route('admin-request-action')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                        <button type="submit" name="accept" class="btn btn-success">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="submit" name="delete" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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
</div>
@include('admin.partials.footer-content')
@include('admin.partials.script-asset')

</body>

</html>
