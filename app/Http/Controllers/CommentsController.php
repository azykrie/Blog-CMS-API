<?php
namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    // Menampilkan semua komentar berdasarkan post
    public function index($postId)
    {
        $comments = comments::with('user')
            ->where('post_id', $postId)
            ->latest()
            ->get();

        return response()->json($comments);
    }

    // Menyimpan komentar baru
    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        // Pastikan post-nya ada
        $post = posts::findOrFail($postId);

        $comment = comments::create([
            'body'    => $request->body,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return response()->json([
            'message' => 'Comment created successfully.',
            'comment' => $comment->load('user'),
        ], 201);
    }
    
    public function update(Request $request, $id)
    {
        $comment = comments::findOrFail($id);

        // Pastikan hanya pemilik comment yang bisa mengedit
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Comment updated successfully.',
            'data'    => $comment,
        ]);
    }

    // Menghapus komentar
    public function destroy($id)
    {
        $comment = comments::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully.']);
    }
}
