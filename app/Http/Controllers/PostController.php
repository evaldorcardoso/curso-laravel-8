<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::orderBy('id', 'DESC')->paginate();        
        $posts = Post::latest()->paginate();        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        //dd($post);
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post criado com sucesso!');
    }

    public function show($id)
    {
        //$post = Post::where('id',$id)->first();
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');
        }
        $post->delete();
        
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post deletado com sucesso!');
    }

    public function edit($id)
    {
        //$post = Post::where('id',$id)->first();
        if(!$post = Post::find($id)){
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        //$post = Post::where('id',$id)->first();
        if(!$post = Post::find($id)){
            return redirect()->back();
        }
        $post->update($request->all());

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post atualizado com sucesso!');
    }

    public function search(Request $request)
    {
        //dd("pesquisando por {$request->search}");
        //$posts = Post::where('title', '=', "%{$request->search}%")
        //                ->orWhere('content', 'LIKE', "%{$request->search}%")
        //                ->toSql();
        //dd($posts);
        $filters = $request->except('_token');
        $posts = Post::where('title', '=', "{$request->search}")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate();
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
