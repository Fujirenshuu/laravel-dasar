<?php

namespace App\Http\Controllers;


Use App\Models\Post;
use App\Mail\BlogPosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
 
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){            
            return redirect('login');
        }
        $posts = Post::active()->get();
        $view_data = [
        'posts' => $posts
        ];
       return view('posts.index', $view_data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){            
            return redirect('login');
        }

        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check()){            
            return redirect('login');
        }

        $title = $request->input('title');
        $content = $request->input('content');
        
        $post = Post::create([
        'title' => $title,  
        'content' => $content,  
        
    ]);
        $this->notify_telegram($post);

        \Mail::to(Auth::user()->email)->send(new BlogPosted($post));
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    if(!Auth::check()){            
        return redirect('login');
    }

    $post = Post::where('id', $id)->first();
    $comments = $post->comments()->get();
    $totalComments = $post->totalComments();

    $view_data = [
        'post' => $post,
        'comments' => $comments,
        'totalComments' => $totalComments,
    ];

    return view('posts.show', $view_data,);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Auth::check()){            
            return redirect('login');
        }

        $post = Post::select('id', 'title', 'content', 'updated_at')->
        where('id', $id)
        ->first();
        $view_data = [
        'post' => $post
    ];
    return view('posts.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::check()){            
            return redirect('login');
        }

         $title = $request->input('title');
        $content = $request->input('content');
            
        Post::where('id', $id)
        ->update([
        'title' => $title,  
        'content' => $content,  
        'updated_at' => now()->toDateTimeString(),  

    ]);
   return redirect("posts/" . $id);

    }

    /**
     * Remove the specif
     * ied resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::check()){            
            return redirect('login');
        }

        Post::where('id' ,$id )->delete();
        return redirect('posts');
    }
    private function notify_telegram($post){
    $token = "6285979692:AAGQW5Dg0IkR38cTgEcuZFMCVSHQgOO1Z9o";
    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $chat_id = -902736500;
    $content = "Ada postingan baru dengan judul : <strong> \"{$post->title}\"</strong>";
    
       // Mengambil ID postingan
    $postId = $post->id;

    // Menghasilkan tautan postingan dengan menggunakan ID
    $postLink = "http://localhost:8000/posts/" . $postId;

    // Menambahkan tautan ke konten pesan
    $content .= "\n\nTautan Postingan: " . $postLink;

 
     $data = [
        'chat_id' => $chat_id,
        'text' => $content,
        'parse_mode' => 'HTML',
        'disable_notification' => true,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => 'Button 1', 'callback_data' => 'button1'],
                    ['text' => 'Button 2', 'callback_data' => 'button2']
                ],
                [
                    ['text' => 'Button 3', 'callback_data' => 'button3']
                ]
            ]
        ])
    ];
    
     // Mengirim permintaan HTTP menggunakan HTTP client bawaan Laravel
     $response = \Illuminate\Support\Facades\Http::post($url, $data);
 
     // Mengembalikan respons dari permintaan HTTP
     return $response->body();
 }
}
