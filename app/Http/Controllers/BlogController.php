<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tools\UINotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Comment;

use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    protected $titles = ['Домашняя', 'Категории', 'Запись', 'О нас', 'Контакты','Ошибка','Категория','Список постов'];
    protected $active_page = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Post::with('comments', 'users', 'categories')->paginate(8);
            $tags = Tag::with('posts')->get();
            $categories = Category::with('posts')->limit(9)->get();
            foreach ($posts as $post) {
                $post_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('F d, Y');
                $post->created = $post_created_at;
                $post->title = substr($post->title, 0, 100);
                $post->title = rtrim($post->title, "!,.-");
                $post->title = substr($post->title, 0, strrpos($post->title, ' '));
                $post->title = $post->title . "...";


                $post->content = substr($post->content, 0, 100);
                $post->content = rtrim($post->content, "!,.-");
                $post->content = substr($post->content, 0, strrpos($post->content, ' '));
                $post->content = $post->content . "...";

            }
            $popularPosts = Post::with('categories', 'comments')->orderBy('views', 'DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            $pageTitle = $this->titles[0];
            $this->active_page = $this->titles[0];
            return view('blog-content.index', ['popularPosts' => $popularPosts, 'active_page' => $this->active_page, 'posts' => $posts, 'categories' => $categories, 'pageTitle' => $pageTitle, 'tags' => $tags]);
        }
        catch (\Exception $exception)
        {
            Log::error('Произошла ошибка. Сообщение исключения: '.$exception->getMessage());
            abort(500);
        }

    }

    public function addComment(Request $request)
    {
        try{
            if (isset($request['comment'])) {
                $comment = new Comment;
                $comment->comment = $request['comment'];
                $comment->author = auth()->user()->username;
                $comment->post_id = intval($request['post_id']);
                $comment->save();
                UINotification::set('success','Комментарий отправлен на модерацию');
                return redirect('/post/'.$request['post_id']);
               }
        }catch (\Exception $exception){
            Log::error('Произошла ошибка. Сообщение исключения: '.$exception->getMessage());
            abort(500);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showPost($id)
    {

        $posts = null;
        $tags = null;
        $pageTitle = null;
        $categories = null;
        $error = null;
        $relatedPosts = null;


        try {
            $tags = Tag::with('posts')->get();
            $posts = Post::with('comments', 'users', 'categories')->find($id);
            $relatedPosts = Post::with('comments', 'users', 'categories')->inRandomOrder()->limit(3)->get();
            $categories = Category::with('posts')->limit(9)->get();
            $pageTitle = $this->titles[2];
            $popularPosts = Post::with('categories')->orderBy('views','DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            try {
                $posts->views = $posts->views + 1;
                $posts->save();
            }catch (\Exception $exception){
                $error['general-error'] = 'Error while processing occured! '.$exception->getMessage();
                Log::error('Error while saving to db! ' . $exception->getMessage());
                $pageTitle = $this->titles[5];
                return view('blog-content.single-post', ['pageTitle'=>$pageTitle,'error' => $error]);
            }
            $posts->created = Carbon::createFromFormat('Y-m-d H:i:s', $posts->created_at)->format('F d, Y');
            $this->active_page = $this->titles[2];
            return view('blog-content.single-post', ['active_page'=>$this->active_page,'popularPosts'=>$popularPosts,'posts' => $posts, 'pageTitle' => $pageTitle, 'categories' => $categories, 'relatedPosts' => $relatedPosts, 'tags' => $tags, 'error' => $error]);

        } catch (\Exception $exception) {
            $error['general-error'] = 'Произошла ошибка. Сообщение исключения: '.$exception->getMessage();
            Log::error('Произошла ошибка. Сообщение исключения: ' . $exception->getMessage());
            $pageTitle = $this->titles[2];
            abort(500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function contact()
    {
        try {
            $this->active_page = $this->titles[4];
            $pageTitle = $this->titles[4];
            $tags = Tag::with('posts')->get();
            $categories = Category::with('posts')->limit(9)->get();
            $popularPosts = Post::with('categories')->orderBy('views', 'DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            return view('blog-content.contact', ['popularPosts' => $popularPosts, 'active_page' => $this->active_page, 'pageTitle' => $pageTitle, 'categories' => $categories, 'tags' => $tags]);
        }catch (\Exception $exception)
        {
            $error['general-error'] = 'Произошла ошибка. Сообщение исключения: '.$exception->getMessage();
            Log::error('Произошла ошибка. Сообщение исключения: ' . $exception->getMessage());
            $pageTitle = $this->titles[4];
            abort(500);
        }
    }


    public function about()
    {
        try {
            $this->active_page = $this->titles[3];
            $pageTitle = $this->titles[3];
            $tags = Tag::with('posts')->get();
            $categories = Category::with('posts')->limit(9)->get();
            $posts = Post::with('categories', 'users')->orderBy('created_at', 'DESC')->limit(9)->get();
            foreach ($posts as $post) {
                $post->created = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('F d, Y');
            }
            $popularPosts = Post::with('categories')->orderBy('views', 'DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            return view('blog-content.about', ['posts' => $posts, 'popularPosts' => $popularPosts, 'active_page' => $this->active_page, 'pageTitle' => $pageTitle, 'categories' => $categories, 'tags' => $tags]);
        }catch (\Exception $exception)
        {
            $error['general-error'] = 'Произошла ошибка. Сообщение исключения: '.$exception->getMessage();
            Log::error('Произошла ошибка. Сообщение исключения: ' . $exception->getMessage());
            $pageTitle = $this->titles[3];
            abort(500);
        }
    }


    public function showCategories()
    {
        try {
            $this->active_page = $this->titles[1];
            $tags = Tag::with('posts')->get();
            $pageTitle = $this->titles[1];
            $categories = Category::with('posts')->paginate(9);

            foreach ($categories as $category) {
                $category_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('F d, Y');
                $category->created = $category_created_at;
            }

            $popularPosts = Post::with('categories')->orderBy('views', 'DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            return view('blog-content.categories', ['popularPosts' => $popularPosts, 'active_page' => $this->active_page, 'categories' => $categories, 'pageTitle' => $pageTitle, 'tags' => $tags]);
        }catch (\Exception $exception){
            $error['general-error'] = 'Произошла ошибка. Сообщение исключения: '.$exception->getMessage();
            Log::error('Произошла ошибка. Сообщение исключения: ' . $exception->getMessage());
            $pageTitle = $this->titles[1];
            abort(500);
        }
    }


    public function showCategory($id)
    {
        try {
            $this->active_page = $this->titles[6];
            $tags = Tag::with('posts')->get();
            $category = Category::with('posts', 'users')->find($id);
            //$posts = Post::with('categories')->paginate(9);   ,'posts' => $posts
            $categories = Category::with('posts')->limit(9)->get();
            $category_id = $id;
            $pageTitle = $this->titles[6] . ' - ' . $category->title;
            $category_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('F d, Y');
            $category->created = $category_created_at;
            $popularPosts = Post::with('categories')->orderBy('views', 'DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            return view('blog-content.category', ['category_id' => $category_id, 'popularPosts' => $popularPosts, 'active_page' => $this->active_page, 'categories' => $categories, 'category' => $category, 'pageTitle' => $pageTitle, 'tags' => $tags]);
        }catch (\Exception $exception)
        {
            $error['general-error'] = 'Произошла ошибка. Сообщение исключения: '.$exception->getMessage();
            Log::error('Произошла ошибка. Сообщение исключения: ' . $exception->getMessage());
            $pageTitle = $this->titles[6];
            abort(500);
        }
    }


    public function showPosts(Request $request)
    {
        try {
            $this->active_page = $this->titles[7];
            $tags = Tag::with('posts')->get();
            $categories = Category::with('posts')->limit(9)->get();
            $posts = Post::with('categories')->orderBy('created_at', 'DESC')->paginate(9);
            foreach ($posts as $post) {
                $post->created = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('F d, Y');
            }
            $pageTitle = $this->titles[7];
            $popularPosts = Post::with('categories')->orderBy('views', 'DESC')->limit(3)->get();
            foreach ($popularPosts as $popularPost) {
                $popularPost->created = Carbon::createFromFormat('Y-m-d H:i:s', $popularPost->created_at)->format('F d, Y');
            }
            if ($request['search']) {
                $posts = Post::with('categories')->where('title', 'LIKE', '%' . $request['search'] . '%')->orderBy('created_at', 'DESC')->paginate(9);
                foreach ($posts as $post) {
                    $post->created = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('F d, Y');
                }
            }
            return view('blog-content.all-posts', ['popularPosts' => $popularPosts, 'active_page' => $this->active_page, 'posts' => $posts, 'categories' => $categories, 'pageTitle' => $pageTitle, 'tags' => $tags]);
        }catch (\Exception $exception){
            $error['general-error'] = 'Произошла ошибка. Сообщение исключения: '.$exception->getMessage();
            Log::error('Произошла ошибка. Сообщение исключения: ' . $exception->getMessage());
            $pageTitle = $this->titles[7];
            abort(500);
        }
    }

    public function showPostsWithTags($id)
    {

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
