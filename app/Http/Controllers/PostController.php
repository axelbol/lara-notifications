<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Notifications\PostNotification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $post = Post::create($data);

        
        // auth()->user()->notify(new PostNotification($post));

        // User::all()
        //     ->except($post->user_id)
        //     ->each(function(User $user) use ($post){
        //         $user->notify(new PostNotification($post));
        //     });
        event(new PostEvent($post));

        return redirect()->back()->with('message', 'Post created sucessfully');
        
    }

    public function index()
    {
        $postNotifications = auth()->user()->unreadNotifications;
        return view('post.notifications', compact('postNotifications'));
    }

    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
                ->when($request->input('id'), function($query) use ($request){
                    return $query->where('id', $request->input('id'));
                })->markAsRead();
        return response()->noContent();
    }
}
