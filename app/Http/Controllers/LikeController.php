<?php

namespace App\Http\Controllers;

use App\Like;
use App\Notifications\LikeToTopic;
use App\Reply;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function storeAjax(Request $request)
    {
        $this->validate($request, [
            'topic_id' => 'required',
            'topic' => 'required'
        ]);

        if(doYouLike($request['topic'],$request['topic_id'])) {
            return response()->json(['error'=>'Ya te gusta']);
        } else {

            $like = new Like();

            $like->user_id = Auth::id();
            $like->topic = $request['topic'];
            $like->topic_id = $request['topic_id'];

            if($like->save()) {

                switch ($like->topic) {
                    case "topic":
                        $topic = Topic::where('id', $like->topic_id)->first();
                        if($topic->user->id != Auth::id())
                            $topic->user->notify(new LikeToTopic($topic));
                        break;
                    case "reply":
                        $reply = Reply::where('id', $like->topic_id)->first();
                        if($reply->user->id != Auth::id())
                            $reply->user->notify(new LikeToTopic($reply));
                        break;
                }

                return response()->json(['success'=>'Data is successfully added']);
            }

            return response()->json(['error'=>'Ocurrio un problema']);
        }
    }
}