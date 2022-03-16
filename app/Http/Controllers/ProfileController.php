<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $email = null)
    {
        if($email && !Auth::hasRole('members-admin')) {
            abort(403, 'Access denied');
        }
        if(!$email) $email = Auth::id();
        $user = $this->getProfile($email);
        return view('users/profile', ['user' => $user]);
    }

    public function roles(Request $request)
    {
        $email = Auth::id();
        $user = $this->getProfile($email);
        return view('users/roles', ['groups' => $this->getUserGroups($user->id), 'roles' => $this->getUserRoles($user->id)]);
    }

    public function update(Request $request) {

        $current_user = Auth::id();
        $current_email = $request->get('current_email');

        if($current_email != $current_user && !Auth::hasRole('members-admin')) {
            abort(403, 'Access denied');
        }

        $data = $request->all();
        $validated = $request->validate([
            'username' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'attributes.phoneNumber' => 'required',
            'attributes.street' => 'required',
            'attributes.postal_code' => 'required',
            'attributes.locality' => 'required',
            'attributes.country' => 'required',
        ]);
        $id = $data['id'];
        unset($data['_token']);
        unset($data['current_email']);
        unset($data['email']); // Disable editing email
        unset($data['id']);
        $this->updateProfile($id, $data);
        return redirect()->back();
    }

}
