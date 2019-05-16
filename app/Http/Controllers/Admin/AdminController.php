<?php

namespace App\Http\Controllers\Admin;
use http\Message;
use Illuminate\Support\Facades\Artisan;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Tools\UINotification;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\Process\Process;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $pageTitle = 'Панель администратора';
    protected $errors = [];
    protected $comments_count = null;
    public function index(Request $request)
    {
        $categories = Category::all();
        $this->comments_count = Comment::with('posts')->where('is_moderated','=','0')->count();

        $alertComments = Comment::with('posts')->where('is_moderated','=','0')->limit(5)->get();
        foreach ($alertComments as $comment) {
            $comment_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y');
            $comment->created = $comment_created_at;
            $comment->comment = substr($comment->comment, 0, 100);
            $comment->comment= rtrim($comment->comment, "!,.-");
            $comment->comment = substr($comment->comment, 0, strrpos($comment->comment, ' '));
            $comment->comment = $comment->comment . "...";
        }

        return view('admin.index', ['pageTitle' => $this->pageTitle, 'categories' => $categories,'comments_count'=>$this->comments_count,'alertComments'=>$alertComments]);
    }


    public function addCategoryForm()
    {
        $pageTitle = 'Добавить категорию';
        $this->comments_count = Comment::with('posts')->where('is_moderated','=','0')->count();
        $alertComments = Comment::with('posts')->where('is_moderated','=','0')->limit(5)->get();
        foreach ($alertComments as $comment) {
            $comment_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y');
            $comment->created = $comment_created_at;
            $comment->comment = substr($comment->comment, 0, 100);
            $comment->comment= rtrim($comment->comment, "!,.-");
            $comment->comment = substr($comment->comment, 0, strrpos($comment->comment, ' '));
            $comment->comment = $comment->comment . "...";
        }
        return view('admin.addcategory', ['pageTitle' => $pageTitle,'comments_count'=>$this->comments_count,'alertComments'=>$alertComments]);
    }

    public function dbBackup()
    {
        $arr = [];
        exec('php C:\xampp\htdocs\blog.local\artisan backup:run --only-db',$arr);
        if (array_search('Backup completed!',$arr)) {
            UINotification::set('success', 'Дамп базы данных создан!');
            Log::info(json_encode($arr));
            return redirect('/admin');
        }else{
            UINotification::set('error', 'Возникла ошибка во время создания дампа!');
            Log::error(json_encode($arr));
            return redirect('/admin');
        }
    }
    public function requestTable(Request $request)
    {
        $pageTitle = 'Запросы';
        $count = null;
        if (intval($request['page'])) {
            if ($request['page'] == 1) {
                $count = 1;
            } else {
                $count = $request['page'] * 20 - 19;
            }
        } else {
            $count = 1;
        }
        $alertComments = Comment::with('posts')->where('is_moderated','=','0')->limit(5)->get();
        foreach ($alertComments as $comment) {
            $comment_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y');
            $comment->created = $comment_created_at;
            $comment->comment = substr($comment->comment, 0, 100);
            $comment->comment= rtrim($comment->comment, "!,.-");
            $comment->comment = substr($comment->comment, 0, strrpos($comment->comment, ' '));
            $comment->comment = $comment->comment . "...";
        }
        $comments = Comment::with('posts')->where('is_moderated', '=', 0)->orderBy('created_at', 'DESC');
        $this->comments_count = $comments->count();
        $comments = $comments->paginate(20);

        return view('admin.requests', ['pageTitle' => $pageTitle, 'comments' => $comments, 'count' => $count, 'comments_count' => $this->comments_count,'alertComments'=>$alertComments]);
    }

    public function requestAction(Request $request)
    {
        $comment = Comment::with('posts')->find($request['comment_id']);
        if (isset($request['delete'])) {
            $comment->delete();
            UINotification::set('success', 'Комментарий удален!');
        } elseif (isset($request['accept'])) {
            $comment->is_moderated = 1;
            $comment->save();
            UINotification::set('success', 'Комментарий подтвержден!');
        }
        return redirect('/admin/requests');
    }

    public function commentTable(Request $request)
    {
        $pageTitle = 'Комментарии';
        $count = null;
        if (intval($request['page'])) {
            if ($request['page'] == 1) {
                $count = 1;
            } else {
                $count = $request['page'] * 20 - 19;
            }
        } else {
            $count = 1;
        }
        $alertComments = Comment::with('posts')->where('is_moderated','=','0')->limit(5)->get();
        foreach ($alertComments as $comment) {
            $comment_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y');
            $comment->created = $comment_created_at;
            $comment->comment = substr($comment->comment, 0, 100);
            $comment->comment= rtrim($comment->comment, "!,.-");
            $comment->comment = substr($comment->comment, 0, strrpos($comment->comment, ' '));
            $comment->comment = $comment->comment . "...";
        }
        $comments = Comment::with('posts')->where('is_moderated', '=', 1)->orderBy('created_at', 'DESC');
        $this->comments_count = $comments->count();
        $comments = $comments->paginate(20);

        return view('admin.comments', ['pageTitle' => $pageTitle, 'comments' => $comments, 'count' => $count, 'comments_count' => $this->comments_count,'alertComments'=>$alertComments]);
    }
    public function addPostForm()
    {
        $categories = Category::all();
        $pageTitle = 'Добавить пост';
        $comments = Comment::with('posts')->where('is_moderated', '=', 1)->orderBy('created_at', 'DESC');
        $this->comments_count = $comments->count();
        $alertComments = Comment::with('posts')->where('is_moderated','=','0')->limit(5)->get();
        foreach ($alertComments as $comment) {
            $comment_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('F d, Y');
            $comment->created = $comment_created_at;
            $comment->comment = substr($comment->comment, 0, 100);
            $comment->comment= rtrim($comment->comment, "!,.-");
            $comment->comment = substr($comment->comment, 0, strrpos($comment->comment, ' '));
            $comment->comment = $comment->comment . "...";
        }
        return view('admin.addpost', ['categories' => $categories, 'pageTitle' => $pageTitle,'comments_count'=>$this->comments_count,'alertComments'=>$alertComments]);
    }

    public function add_post(Request $request)
    {

        $title = $request['title'];
        $category = $request['category'];
        $content = $request['content'];
        if ($request->hasFile('upload_image')) {
            $rules = [
                'upload_image' =>'bail|image|required',
            ];
            $messages = [
                'required' => 'В поле :attribute должна быть загружена картинка.',
                'image' => 'Можно загружать только файлы картинок',
            ];
            $this->validate($request,$rules,$messages);
            $image = $request->file('upload_image');
            $imageName = md5($request->file('upload_image')->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName);
        }

        $rules = [
            'title' => 'bail|required|unique:posts|max:255',
            'content' => 'bail|required',
            'category' => 'bail|required',
            'upload_image'=>'bail|image|required',
        ];
        $messages = [
            'required' => 'Поле :attribute не может быть пустым.',
            'image' => 'Можно загружать только файлы картинок',
            'unique' => 'Пост с таким названием уже существует',
            'max' => [
                'string' => 'Название поста должно быть короче 255 символов',
            ],
        ];

        $this->validate($request,$rules,$messages);
        try {
            $newPost = new Post;
            $newPost->title = $title;
            $newPost->content = $content;
            $newPost->image = '/storage/' . $imageName;

            $newPost->save();
            $newPost->categories()->attach($category, ['post_id' => $newPost->id]);
            UINotification::set('success', 'Пост успешно добавлен!');
            return redirect('/admin');
        } catch (\Exception $exception) {
            UINotification::set('error', $exception->getMessage());
            return redirect('/admin');
        }
    }


    public function add_category(Request $request)
    {
        $categories = Category::all();

        $title = $request['title'];
        if ($request->hasFile('upload_image')) {
            $rules = [
                'upload_image' =>'bail|image|required',
            ];
            $messages = [
                'required' => 'В поле :attribute должна быть загружена картинка.',
                'image' => 'Можно загружать только файлы картинок',
            ];
            $this->validate($request,$rules,$messages);
            $image = $request->file('upload_image');
            $imageName = md5($request->file('upload_image')->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
        }

        $rules = [
            'title' => 'bail|required|unique:categories|max:255',
            'upload_image' =>'bail|image|required',
        ];
        $messages = [
            'required' => 'Поле :attribute не может быть пустым.',
            'image' => 'Можно загружать только файлы картинок',
            'unique' => 'Категория с таким названием уже существует',
            'max' => [
                'string' => 'Название поста должно быть короче 255 символов',
            ],
        ];

         $this->validate($request,$rules,$messages);
        try {
            $newPost = new Category;
            $newPost->title = $title;
            $newPost->image = '/storage/' . $imageName;

            $newPost->save();
            UINotification::set('success', 'Пост успешно добавлен!');

            $request->session()->save();
            return redirect('/admin');
        } catch (\Exception $exception) {
            UINotification::set('error', $exception->getMessage());
            return redirect('/admin');
        }
    }
}
