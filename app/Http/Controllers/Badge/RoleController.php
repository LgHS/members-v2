<?php

namespace App\Http\Controllers\Badge;

use App\Data\KeycloakData;
use App\Http\Controllers\Controller;
use App\Models\Badges;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('keycloak-roles:members-admin');
    }

    public function list(Request $request) {

        $roles = Roles::all();
        return view('badges/roles/list', ['roles' => $roles]);
    }

    public function badgesOrNot(Request $request, $id) {
        $role = Roles::find($id);
        $role->badges = $role->badges == 0 ? 1 : 0;
        $role->update();
        return redirect()->back();
    }

    public function inject(Request $request) {
        $roles = $this->getRoles();

        foreach($roles as $role) {
            $r = Roles::where('role_name', $role)->first();
            if(!$r) {
                $r = new Roles;
                $r->role_name = $role;
                $r->save();
            }
        }
        return redirect()->back();
    }
}
