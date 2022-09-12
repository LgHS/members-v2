<?php

namespace App\Http\Controllers;

use App\Data\KeycloakData;
use App\Models\Badges;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BadgeController extends Controller
{
    public function store(Request $request) {
  
        
        $email = Auth::id();

        $profile = (array)(new KeycloakData())->getProfile($email);

        $data = [
            'attributes' => [
                'cardId' => Str::uuid()->toString()
            ]
        ];
        $id = $profile['id'];
        $this->updateProfile($id, $data);
        return redirect()->route('badges::list');
    }

    public function list(Request $request) {

        
        $email = Auth::id();
        $profile = (array)(new KeycloakData())->getProfile($email);

        $cardId = reset($profile['attributes']['cardId']);

        return view('badges/list', ['cardId' => $cardId]);
    }

}
