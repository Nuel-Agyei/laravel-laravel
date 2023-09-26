<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'avatar' => ['required','image'],
        ]);
        $path = $request->file('avatar')->store('avatars', 'public');

        if($request->user()->avatar){

        }
        auth()->user()->update(['avatar'=> $path]);
        // dd(auth()->user()->avatar);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
