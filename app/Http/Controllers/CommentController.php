<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'image_id' => 'required|integer',
            'content' => 'required|string|max:255',
        ]);
    
        $comment = Comment::create($validatedData);
        return redirect()->back()->with('status', 'Comment added successfully!');
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'integer',
            'image_id' => 'integer',
            'content' => 'string|max:255',
            'rating' => 'nullable|integer|min:1|max:5', // Añadir validación para rating opcional
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validatedData);
        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('status', 'Comment deleted successfully!');
    }

    public function pdf() {
        $pdf = Pdf::loadView('pdf');
    }
}