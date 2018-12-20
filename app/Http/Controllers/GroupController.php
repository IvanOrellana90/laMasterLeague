<?php

namespace App\Http\Controllers;

use App\Achievements\UserCreateNewGroup;
use App\Group;
use App\Notifications\InvitationToGroup;
use App\Notifications\UserDeleteGroup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function group($id)
    {
        $group = Group::where('id', $id)->first();
        $users = User::where('admin', false)
            ->where('id', '<>', Auth::id())
            ->get();

        foreach ($group->users as $user)
        {
            $user->points = getUserTournamentPoints($group->tournament->id, $user->id);
        }

        return view('group.group', [
            'group' => $group,
            'users' => $users
        ]);
    }

    public function groups()
    {
        $groups = Group::all();
        $users = User::where('admin', false)
            ->where('id', '<>', Auth::id())
            ->get();

        return view('group.groups', [
            'groups' => $groups,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description ' => 'max:400',
            'tournament' => 'required|exists:tournaments,id',
            'users.*' => 'exists:users,id'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $group = new Group();

        $group->user_id = Auth::id();
        $group->name = $request['name'];
        $group->description = $request['description'];
        $group->tournament_id = $request['tournament'];

        if($group->save()) {

            $group->users()->sync([$group->user_id => ['active' => true]]);
            $group->users()->attach($request['users']);

            $mensaje = "Grupo: ".$group->name." ingresado correctamente!";
            $class = "success";

            Auth::user()->unlock(new UserCreateNewGroup());

            foreach ($group->users as $user) {
                if($user->id != Auth::id())
                    $user->notify(new InvitationToGroup($group));
            }

            //return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description ' => 'max:400'
        ]);

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $group = Group::where('id',$request['group_id'])->where('user_id',Auth::id())->first();

        if($group != null)
        {
            $group->name = $request['name'];
            $group->description = $request['description'];

            if($group->save()) {

                $mensaje = "Grupo: ".$group->name." editado correctamente!";
                $class = "success";

                //return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
            }
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);

    }

    public function destroy($id)
    {
        $group = Group::where('id', $id)->first();

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        if($group->user->id != Auth::id()) {
            $mensaje = "No puedes eliminar un grupo de otro usuario!";
            return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
        }

        $nombre = $group->name;

        foreach ($group->users as $user) {
            if($user->id != Auth::id())
                $user->notify(new UserDeleteGroup($group));
        }

        if(DB::table('group_user')->where('group_id', $group->id)->delete())     {
            if($group->delete()) {
                $mensaje = "Grupo: ".$nombre." eliminado correctamente!";
                $class = "success";
            }
        }

        return redirect()->route('groups')->with(['message' => $mensaje, 'class' => $class]);
    }

    public function storeInvitations(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'users.*' => 'exists:users,id'
        ]);

        $count = 0;

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $group = Group::find($request['group_id']);


        foreach ($request['users'] as $user_id)
        {
            if(empty($group->users->where('id', $user_id)->first()))
            {
                $group->users()->attach([$user_id => ['active' => false]]);
                $count ++;
            }

            if($count > 0)
            {
                $mensaje = "Invitaciones enviadas: " .$count;
                $class = "success";
            }
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
    }

    public function confirmGroup($group_id)
    {
        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $group = Group::find($group_id);

        if($user = $group->users->where('id', Auth::id())->first())
        {
            $user->pivot->active = 1;
            if($user->pivot->save())
            {
                $mensaje = "Felicitaciones, ya eres un miembro del grupo: ".$group->name;
                $class = "success";
            }
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
    }

    public function deleteInvitation($group_id)
    {
        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        $group = Group::find($group_id);

        if($user = $group->users->where('id', Auth::id())->first())
        {
            if($user->pivot->delete())
            {
                $mensaje = "Invitación declinada";
                $class = "success";
            }
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
    }
}