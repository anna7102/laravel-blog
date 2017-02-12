<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Tag;

use Illuminate\Http\Request;

use Illuminate\Session\Store;


class PostController extends Controller
{
    public function getIndex(Store $session)
    {
        //$post = new Post();
        //$posts = $post->getPosts($session);

        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('blog.index', ['posts' => $posts]);

    }

    public function getAdminIndex(Store $session)
    {
        //$post = new Post();
        //$posts = $post->getPosts($session);

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.index', ['posts' => $posts]);

    }

    public function getPost(Store $session, $id)
    {
       $post = Post::where('id', $id)->with('likes')->first();
       // $post = Post::find($id);
        return view('blog.post', ['post' => $post]);

    }

    public function getLikePost(Store $session, $id)
    {
        $post = Post::find($id);
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }

    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit(Store $session, $id)
    {
        //$post = new Post();
        //$post = $post->getPost($session, $id);
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);
    }

    public function getAdminDelete($id)
    {
        //$post = new Post();
        //$post = $post->getPost($session, $id);
        $post = Post::find($id);
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post Deleted');
    }

    public function postAdminCreate(Store $session, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post([
            'title' => $request->input('title'),
            'content' =>  $request->input('content')
        ]);

        $post->save();
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));


        //$post->addPost($session, $request->input('title'), $request->input('content'));
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post Created, Title is : ' .$request->input('title') );

    }

    public function postAdminUpdate(Store $session, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        //$post = new Post();
        //$post->editPost($session, $request->input('id'),$request->input('title'), $request->input('content'));
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        //$post->tags()->detach();
        //$post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post updated, Title is : ' .$request->input('title') );

    }

}
