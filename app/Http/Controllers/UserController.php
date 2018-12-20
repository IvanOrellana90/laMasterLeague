<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user($id)
    {
        $user = User::where('id', $id)->first();

        $userBets = User::join('bets','bets.user_id','=','users.id')
            ->join('matches','bets.match_id','=','matches.id')
            ->where('matches.finished',true)
            ->where('users.id', $id)
            ->first();

        return view('user.user', [
            'user' => $user,
            'userBets' => $userBets
        ]);
    }

    public function userProfile()
    {
        $avatars = Avatar::where('active',true)->get();

        return view('user.profile', [
            'avatars' => $avatars
        ]);
    }

    public function privacity()
    {
        return view('user.privacity');
    }

    public function chat()
    {
        return view('layouts.includes.chat');
    }

    public function chatMessage($id)
    {
        $group = Group::where('id',$id)->first();

        return view('layouts.includes.chatMessage', [
            'group' => $group
        ]);
    }

    public function notifications()
    {
        return view('user.notifications');
    }

    public function specialEvent()
    {
        return view('user.specialEvent');
    }

    public function users()
    {

    }

    public function changeUserAvatar($id)
    {
        $user = Auth::user();
        $user->avatar_id = $id;

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        if($user->save()) {
            $mensaje = "Perfil editado correctamente";
            $class = "success";

            return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users|confirmed',
            'password' => 'required|min:6',
            'name' => 'required|string|max:50'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $avatar = Avatar::where('level',1)->inRandomOrder()->first();

        $user = new User();

        $user->name = ucwords(strtolower($request['name']));
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->avatar_id = $avatar->id;

        if($user->save()) {
            $mensaje = "Usuario: ".$user->name." ".$user->lastName." ingresado correctamente!";
            $class = "success";

            if (Auth::attempt(['email' => $user->email, 'password' => $user->password])) {
                return redirect('/home');
            }

            return redirect()->route('login')->with(['message' => $mensaje, 'class' => $class]);
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'name' => 'required|string|max:50'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $user = User::where('id', Auth::id())->first();
        $checkEmail = User::where('email', $request['email'])->first();

        if($checkEmail == null)
        {
            $user->name = ucwords($request['name']);
            $user->password = Hash::make($request['password']);
            $user->email = $request['email'];

            if($user->save()) {
                $mensaje = "Usuario: ".$user->name." ".$user->lastName." modificado correctamente!";
                $class = "success";

                return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
            }
        } elseif ($checkEmail->id == $user->id)
        {
            $user->name = ucwords($request['name']);
            $user->password = Hash::make($request['password']);
            $user->email = $request['email'];

            if($user->save()) {
                $mensaje = "Usuario: ".$user->name." ".$user->lastName." modificado correctamente!";
                $class = "success";

                return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
            }
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);

    }

}