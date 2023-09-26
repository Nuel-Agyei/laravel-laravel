<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'avatar' => ['required','image'],
        ]);
        //$path = $request->file('avatar')->store('avatars', 'public');

        $path = Storage::disk('public')->put('avatars',$request->file('avatar'));

        if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
        }

        auth()->user()->update(['avatar'=> $path]);

        // dd(auth()->user()->avatar);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
