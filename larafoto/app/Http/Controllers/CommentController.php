<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }

    function store(Request $request) {
        $data = [
            'content' => $request->input('content'),
            'image_id' => $request->input('image_id'),
            'user_id' => (\Auth::user())->id,
        ];

        $this->validate($request, [
            'content' => 'string|required',
            'image_id' => 'integer|required',
        ]);

        // asigno los valores al nuevo objeto
        $commentModel = new Comment();
        $commentModel->user_id = $data['user_id'];
        $commentModel->image_id = $data['image_id'];
        $commentModel->content = $data['content'];

        $commentModel->save();

        return redirect()
            ->route('image.detail', ['id' => $data['image_id']])
            ->with([
                'message' => 'has publicado tu comentario correctamente',
            ]);
    }

    function delete($id) {
        
        $user = \Auth::user();
        $comment = Comment::find($id);

        // check my own comment
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            return redirect()
                ->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message' => 'Comentario eliminado correctamente',
                ]);
        }

        return redirect()
            ->route('image.detail', ['id' => $comment->image->id])
            ->with([
                'message' => 'El Comentario no se ha podido eliminar',
            ]);
    }
}
