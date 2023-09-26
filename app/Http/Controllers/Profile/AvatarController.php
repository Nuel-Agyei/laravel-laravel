<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

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
    public function generate(){
        $result = OpenAI::images()->create([
            "prompt"=> "create an avatar with user name".auth()->user()->name,
            'n' => 2,
            'size' => "256x256"
         ]);

        $content = file_get_contents($result->data[0]->url);

        $filename = Str::random(25);
        $path = Storage::disk('public')->put("avatars/$filename.jpg", $content);

        auth()->user()->update(['avatar' => "avatars/$filename.jpg"]);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
