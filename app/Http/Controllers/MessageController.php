<?php

namespace App\Http\Controllers;

use App\Group;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required|exists:groups,id',
            'content' => 'required|min:10|max:400'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $message = new Message();

        $message->user_id = Auth::id();
        $message->group_id = $request['group_id'];
        $message->content = $request['content'];

        if($message->save()) {
            $mensaje = "Comentario ingresado correctamente!";
            $class = "success";
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
    }

    public function storeAjax(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required|exists:groups,id',
            'content' => 'required|max:400'
        ]);

        $message = new Message();

        $message->user_id = Auth::id();
        $message->group_id = $request['group_id'];
        $message->content = $request['content'];

        if($message->save()) {
            return response()->json(['success'=>'Data is successfully added']);
        }

        return response()->json(['error'=>'Ocurrio un problema']);
    }
}