<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;


class ImageController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }

    function create() {
        return view('image.create');
    }

    function save(Request $request) {
        
        $data = [
            'description' => $request->input('description'),
            'image' => $request->file('image'),
            'user_id' => (\Auth::user())->id, 
        ];

        $this->validate($request, [
            'description' => 'required',
            'image' => 'required|image',
        ]);

        // upload files
        $imagePathName = time().($data['image'])->getClientOriginalName();
        Storage::disk('images')->put($imagePathName, File::get($data['image']));    
        
        // assign
        $imageModel = new Image();
        $imageModel->description = $data['description'];
        $imageModel->user_id = $data['user_id'];
        $imageModel->image_path = $imagePathName;

        $imageModel->save();

        return redirect()
            ->route('home')
            ->with(['message' => 'La foto ha sido subida correctamente']);
    }

    function getImage($fileName) {
        $file = Storage::disk('images')->get($fileName);

        return new Response($file, 200);
    }

    function detail($id) {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image,
        ]);
    }

    function delete($image_id) {
        $user = \Auth::user();
        $image = Image::find($image_id);
        $comments = Comment::where('image_id', $image_id)->get();
        $likes = Like::where('image_id', $image_id)->get();
        $message = ['message' => 'La imagen no se ha borrado'];

        if (($user && $image) && ($image->user->id == $user->id)) {
            
            // delete comments
            if ($comments && count($comments) > 0) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // delete likes
            if ($likes && count($likes) > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // delete files
            Storage::disk('images')->delete($image->image_path);

            // delete image
            $image->delete();
            $message['message'] = 'La imagen se ha borrado correctamente';
        }

        return redirect()
            ->route('home')
            ->with($message);
    }

    function edit($id) {
        $user = \Auth::user();
        $image = Image::find($id);

        if (($user && $image) && $image->user->id == $user->id) {
            return view('image.edit', ['image' => $image]);
        }

        return redirect()->route('home');
    }

    function update(Request $request) {
        $data = [
            'image_id' => $request->input('image_id'),
            'description' => $request->input('description'),
            'image' => $request->file('image'),
        ];

        $this->validate($request, [
            'description' => 'required',
            'image' => 'image',
        ]);
        
        // assign
        $imageModel = Image::find($data['image_id']);
        $imageModel->description = $data['description'];

        // upload files
        if ($data['image']) {    
            $imagePathName = time().($data['image'])->getClientOriginalName();
            Storage::disk('images')->put($imagePathName, File::get($data['image']));  
            
            $imageModel->image_path = $imagePathName;
        }

        $imageModel->update();

        return redirect()
            ->route('image.detail', ['id' => $data['image_id']])
            ->with(['message' => 'Imagen actualizada con éxito' ]);
    }
}
