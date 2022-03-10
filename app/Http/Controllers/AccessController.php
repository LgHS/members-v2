<?php

namespace App\Http\Controllers;

use App\Data\KeycloakData;
use App\Models\Accesses;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('keycloak-roles:members-admin');
    }

    public function generate(Request $request) {
        $access = new Accesses;

        $access->id = $request->get('id');
        $access->api_token = Str::random(40);
        $access->save();
        return redirect()->route('accesses::list');
    }

    public function list(Request $request) {

        $accesses = Accesses::all();

        return view('accesses', ['accesses' => $accesses]);
    }

    public function destroy(Request $request, $api_token) {
        $access = Accesses::where('api_token', $api_token);
        $access->delete();
        return redirect()->back();
    }
}
