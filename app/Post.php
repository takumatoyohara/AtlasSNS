<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
public function user() {
    return $this->belongsTo('App\User');
        }

public function tweetDestroy(Int $posts)
    {
        return $this->/*where('user_id', $user_id)->*/where('id', $posts)->delete();
    }

/*public function update(Request $request, Tweet $tweet)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $tweet->tweetUpdate($tweet->id, $data);

        return redirect('tweets');
    }*/

/*public function update(Int $user_id, Array $post)
    {
        $this->id = $user_id;
        $this->post = $data['post'];
        $this->update();

        return;
    }*/


}
