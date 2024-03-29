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

        
        $profile['attributes']['cardId'] = Str::uuid()->toString();

        $id = $profile['id'];
        $this->updateProfile($id, $profile);
        return redirect()->route('badges::list');
    }

    public function list(Request $request) {

        
        $email = Auth::id();
        $profile = (array)(new KeycloakData())->getProfile($email);

        $cardId = isset($profile['attributes']['cardId']) ? reset($profile['attributes']['cardId']) : '';

        return view('badges/list', ['cardId' => $cardId]);
    }

}
