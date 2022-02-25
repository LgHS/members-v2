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
        return view('users/profile', ['user' => $user, 'groups' => $this->getUserGroups($user->id), 'roles' => $this->getUserRoles($user->id)]);
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

    protected function getToken() {
        $response = Http::asForm()->post(env('KEYCLOAK_BASE_URL', '').'/realms/master/protocol/openid-connect/token', [
            "grant_type" => "client_credentials",
            "client_id" => "admin-cli",
            "client_secret" => env('KEYCLOAK_ADMINCLI_SECRET', '')
        ]);
        return $response->ok() && isset($response->json()['access_token']) ? $response->json()['access_token'] : null;
    }

    protected function getProfile($email) {
        $token = $this->getToken();
        if($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users', [
                "email" => $email
            ]);
            return $response->ok() && isset($response->json()[0]) ? (object)$response->json()[0] : null;
        }
        return false;
    }

    protected function getUserGroups($id) {
        $token = $this->getToken();
        if($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id.'/groups');
            $groups = $response->ok() ? (object)$response->json() : null;

            foreach($groups as &$group) {
                $group['path'] = substr($group['path'], 1);

            }
            return $groups;
        }
        return false;
    }



    protected function getUserRoles($id) {
        $token = $this->getToken();
        if($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id.'/role-mappings/realm/composite');
            $roles = $response->ok() ? (object)$response->json() : [];

            $data = [];

            foreach($roles as $role) {
                if(!in_array($role['name'], ['default-roles-lghs', 'uma_authorization', 'offline_access'])) {
                    $data[$role['name']] = $role['description'] ?? '';
                }
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/clients');
            $clients = $response->ok() ? (object)$response->json() : [];

            foreach($clients as $client) {
                $clientid = $client['id'];
                $resource = $client['clientId'];
                if(!in_array($resource, ['account', 'sign-in-v2'])) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer '.$token
                    ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id.'/role-mappings/clients/'.$clientid.'/composite');
                    $roles = $response->ok() ? (object)$response->json() : [];

                    foreach($roles as $role) {
                        $data[$resource.'/'.$role['name']] = $role['description'] ?? '';
                    }
                }
            }
            return $data;
        }
        return false;
    }

    protected function updateProfile($id, $data) {
        $token = $this->getToken();
        if($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->put(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id, $data);
            return $response->ok();
        }
        return false;
    }
}
