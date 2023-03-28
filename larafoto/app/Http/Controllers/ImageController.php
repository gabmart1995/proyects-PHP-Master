<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $imageModel->image_path = null;
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
}
