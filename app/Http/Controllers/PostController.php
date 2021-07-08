<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('title')->paginate(5);

        return view('admin/posts/index', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('content', 'LIKE', "%{$request->search}%")
            ->paginate(5);

        return view('admin/posts/index', [
            'posts' => $posts,
            'filters' => $filters,
        ]);
    }

    public function show($id)
    {
        if (!$post = Post::where('id', $id)->first()) {
            return redirect()->route('posts.index');
        }

        return view('admin/posts/show', compact('post'));
    }

    public function create()
    {
        return view('admin/posts/create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {
            $nameImage = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $nameImage);
            $data['image'] = $image;
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('message', 'Post inserido com sucesso!');
    }

    public function edit($id)
    {
        if (!$post = Post::where('id', $id)->first()) {
            return redirect()->route('posts.index');
        }

        return view('admin/posts/edit', compact('post'));
    }

    public function update(StoreUpdatePost $request)
    {
        if (!$post = Post::where('id', $request->id)->first()) {
            return redirect()->route('posts.index');
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            $nameImage = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $nameImage);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('message', 'Post alterado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$post = Post::where('id', $id)->first()) {
            return redirect()->route('posts.index');
        }

        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    }
}
