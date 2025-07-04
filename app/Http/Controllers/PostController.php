<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(posts::latest()->with('user', 'category')->get());
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $posts = posts::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->content,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post'    => $posts,
        ], 201);
    }

public function show($id)
{
    try {
        $post = posts::with('user', 'category')->findOrFail($id);
        return response()->json($post);
    } catch (ModelNotFoundException $e) {
        return response()->json(['message' => 'Post not found'], 404);
    }
}
    public function update(Request $request, $id)
    {
        $post = posts::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'content'     => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $data = $request->only('title', 'content', 'category_id');

        if ($request->has('title')) {
            $data['slug'] = Str::slug($request->title);
        }

        $post->update($data);

        return response()->json([
            'message' => 'Post updated',
            'post'    => $post,
        ]);
    }

    public function destroy($id)
    {
        $post = posts::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
