<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;


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
        ];

        $this->validate($request, [
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $user = \Auth::user();

        // assign
        $imageModel = new Image();
        $imageModel->image_path = null;
        $imageModel->description = $data['description'];
        $imageModel->user_id = $user->id;

        // upload files
        if ($data['image']) {
            $imagePathName = time().($data['image'])->getClientOriginalName();

            Storage::disk('images')->put($imagePathName, File::get($data['image']));    
            
            $imageModel->image_path = $imagePathName;
        }

        $imageModel->save();

        return redirect()
            ->route('home')
            ->with(['message' => 'La foto ha sido subida correctamente']);
    }
}
