<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }    

    function like($image_id) {
        $user = \Auth::user();

        // if like exists
        $result =  Like::where('user_id', $user->id)
            ->where('image_id', (int) $image_id)
            ->count() == 0;

        if ($result) {
            $likeModel = new Like();
            $likeModel->user_id = $user->id;
            $likeModel->image_id = (int) $image_id;

            $likeModel->save();
            
            return response()->json([
                'like' => $likeModel,
            ]);
        }

        return response()->json([
            'message' => 'El like ya existe',
        ]);
    }

    function dislike($image_id) {
        $user = \Auth::user();

        // if like exists
        $likeModel =  Like::where('user_id', $user->id)
            ->where('image_id', (int) $image_id)
            ->first();

        if ($likeModel) {
            $likeModel->delete();
            
            return response()->json([
                'like' => $likeModel,
                'message' => 'Has dado dislike correctamente',
            ]);
        }

        return response()->json([
            'message' => 'El like no existe',
        ]);
    }

    function index() {
        $likes = Like::where('user_id', (\Auth::user())->id)
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('like.index', [
            'likes' => $likes,
        ]);
    }
}
