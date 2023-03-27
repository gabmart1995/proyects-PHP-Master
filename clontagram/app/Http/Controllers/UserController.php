<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    function config() {
        return view('user.config');
    }

    function update(Request $request) {

        // user logged
        $user = \Auth::user();
        
        // receive data
        $values = [
            'id' => \Auth::user()->id,
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'nick' => $request->input('nick')
        ];

        // validate form
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$values['id'],
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$values['id'],
        ]);

        // asign new values
        $user->name = $values['name'];
        $user->surname = $values['surname'];
        $user->email = $values['email'];
        $user->nick = $values['nick'];

        // upload image
        if ($imagePath = $request->file('image')) {

            $imageFull = time().$imagePath->getClientOriginalName();

            // save in vitual disk
            Storage::disk('users')->put($imageFull, File::get($imagePath));

            $user->image = $imageFull;
        }

        // execute query
        $user->update();

        // create message flash
        return redirect()
            ->route('config')
            ->with([
                'message' => 'Usuario actualizado correctamente',
            ]);
    }
}