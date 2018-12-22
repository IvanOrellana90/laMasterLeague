<?php

namespace App\Http\Controllers;

use App\Achievements\UserCreateNewTopic;
use App\Notifications\RepliedToTopic;
use App\Reply;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function forum()
    {
        $topics = Topic::all();

        return view('forum.forum', [
            'topics' => $topics
        ]);
    }

    public function slidePanel($id)
    {
        $topic = Topic::where('id',$id)->first();

        return view('forum.includes.slidePanel', [
            'topic' => $topic
        ]);
    }

    public function storeReply(Request $request)
    {
        $this->validate($request, [
            'topic' => 'required|exists:topics,id',
            'content' => 'required|min:10|max:400'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $reply = new Reply();

        $reply->user_id = Auth::id();
        $reply->topic_id = $request['topic'];
        $reply->content = $request['content'];

        if($reply->save()) {
            $mensaje = "Comentario ingresado correctamente!";
            $class = "success";

            // Actualizar topic para mostrar ultimos actualizados primeros en el foro

            $topic = Topic::where('id', $reply->topic->id)->first();
            $topic->updated_at = $reply->created_at;

            if($topic->save()) {
                $reply->topic->user->notify(new RepliedToTopic($reply));

                return redirect()->route('forum')->with(['message' => $mensaje, 'class' => $class]);
            }
        }

        return redirect()->route('forum')->with(['message' => $mensaje, 'class' => $class]);
    }

    public function storeTopic(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:topics',
            'content' => 'required|min:10|max:1000',
            'category' => 'required'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $topic = new Topic();

        $topic->user_id = Auth::id();
        $topic->title = $request['title'];
        $topic->content = $request['content'];
        $topic->category = $request['category'];

        if($topic->save()) {
            $mensaje = "Tema: ".$topic->title." ingresado correctamente!";
            $class = "success";

            Auth::user()->unlock(new UserCreateNewTopic());

            return redirect()->route('forum')->with(['message' => $mensaje, 'class' => $class]);
        }

        return redirect()->route('forum')->with(['message' => $mensaje, 'class' => $class]);
    }

    public function destroyTopic($id)
    {
        $topic = Topic::where('id', $id)->first();

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        if($topic->user->id != Auth::id() && !$topic->user->admin) {
            $mensaje = "No puedes eliminar un tema de otro usuario!";
            return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
        }

        $nombre = $topic->name;

        if($topic->delete() || Reply::where('topic_id',$topic->id)->delete())
        {
            $mensaje = "Tema: ".$nombre." eliminado correctamente!";
            $class = "success";
        }

        return redirect()->route('forum')->with(['message' => $mensaje, 'class' => $class]);
    }
}