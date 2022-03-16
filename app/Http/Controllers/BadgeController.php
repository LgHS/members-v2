<?php

namespace App\Http\Controllers;

use App\Data\KeycloakData;
use App\Models\Badges;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    public function store(Request $request) {
        if($id = $request->get('id')) {
            $badge = Badges::find($id);
        } else {
            $badge = new Badges;
        }

        $users = (array)(new KeycloakData())->getUsers();
        $current_email = Auth::id();
        $current_id = current(array_filter($users, function($v) use ($current_email) {
            return $v['email'] == $current_email;
        }))['id'];

        $badge->user_id = $request->get('user_id');
        if($current_id != $badge->user_id && !Auth::hasRole('badges-admin')) {
            abort(403, 'Access denied');
        }
        $badge->roles_ids = implode(',', $request->get('roles_ids'));
        if(!($badge->is_banned == 'on' && !Auth::hasRole('badges-admin'))){
            $badge->is_banned = $request->get('is_banned', false);
        }
        $badge->welcome_name = $request->get('welcome_name', '');
        $badge->save();
        return redirect()->route('badges::list');
    }

    public function view(Request $request, $id) {

        $roles = Roles::where('badges', 1)->get()->toArray();
        $users = (array)(new KeycloakData())->getUsers();
        $current_email = Auth::id();
        $current_id = current(array_filter($users, function($v) use ($current_email) {
            return $v['email'] == $current_email;
        }))['id'];

        if(Auth::hasRole('badges-admin')) {
            $user_roles = $this->getUserRoles($current_id);
            foreach($roles as $k => $role) {
                if(!key_exists($role['role_name'], $user_roles)) {
                    unset($roles[$k]);
                }
            }
        }

        if($id == 'new') {
            $badge = (object)[];
        } else {
            $badge = Badges::find($id);
            if($current_id != $badge->user_id && !Auth::hasRole('badges-admin')) {
                abort(403, 'Access denied');
            }
        }

        return view('badges/view', ['current_id' => $current_id, 'id' => ($id != 'new' ? $id : null), 'badge' => $badge, 'roles' => $roles, 'users' => $users]);
    }

    public function list(Request $request) {

        $roles = Roles::all()->toArray();
        $users = (array)(new KeycloakData())->getUsers();
        if(Auth::hasRole('badges-admin')) {
            $badges = Badges::all();
        } else {
            $current_email = Auth::id();
            $current_id = current(array_filter($users, function($v) use ($current_email) {
                    return $v['email'] == $current_email;
                }))['id'];
            $badges = Badges::where('user_id', $current_id)->get();
        }
        foreach($badges as &$badge) {
            $roles_ids = explode(',', $badge->roles_ids);
            $badge->roles = array_filter($roles, function($v) use ($roles_ids) {
                return in_array($v['id'], $roles_ids);
            });
            $badge->user = current(array_filter($users, function($v) use ($badge) {
                return $v['id'] == $badge->user_id;
            }))['username'] ?? $badge->welcome_name;
        }
        return view('badges/list', ['badges' => $badges, 'roles' => $roles, 'users' => $users]);
    }

    public function destroy(Request $request, $id) {
        $users = (array)(new KeycloakData())->getUsers();
        $current_email = Auth::id();
        $current_id = current(array_filter($users, function($v) use ($current_email) {
            return $v['email'] == $current_email;
        }))['id'];

        $badge = Badges::find($id);
        if($current_id != $badge->user_id && !Auth::hasRole('badges-admin')) {
            abort(403, 'Access denied');
        }
        $badge->delete();
        return redirect()->back();
    }
}
