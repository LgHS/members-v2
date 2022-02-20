<?php

namespace App\Data;

use Illuminate\Support\Facades\Http;

class KeycloakData {

    protected $access_token;

    function __construct()
    {
        $response = Http::asForm()->post(env('KEYCLOAK_BASE_URL', '').'/realms/master/protocol/openid-connect/token', [
            "grant_type" => "client_credentials",
            "client_id" => "admin-cli",
            "client_secret" => env('KEYCLOAK_ADMINCLI_SECRET', '')
        ]);
        $this->access_token = $response->ok() && isset($response->json()['access_token']) ? $response->json()['access_token'] : null;
    }

    public function getUsers() {
        if($this->access_token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->access_token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users');
            return $response->ok() ? (object)$response->json() : null;
        }
        return false;
    }

    public function getProfile($email) {
        if($this->access_token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->access_token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users', [
                "email" => $email
            ]);
            return $response->ok() && isset($response->json()[0]) ? (object)$response->json()[0] : null;
        }
        return false;
    }

    public function getUserGroups($id) {
        if($this->access_token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->access_token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id.'/groups');
            $groups = $response->ok() ? (object)$response->json() : null;

            foreach($groups as &$group) {
                $group['path'] = substr($group['path'], 1);

            }
            return $groups;
        }
        return false;
    }

    public function getUserRoles($id) {
        if($this->access_token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->access_token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id.'/role-mappings/realm/composite');
            $roles = $response->ok() ? (object)$response->json() : [];

            $data = [];

            foreach($roles as $role) {
                if(!in_array($role['name'], ['default-roles-lghs', 'uma_authorization', 'offline_access'])) {
                    $data[$role['name']] = $role['description'] ?? '';
                }
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->access_token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/clients');
            $clients = $response->ok() ? (object)$response->json() : [];

            foreach($clients as $client) {
                $clientid = $client['id'];
                $resource = $client['clientId'];
                if(!in_array($resource, ['account', 'sign-in-v2'])) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer '.$this->access_token
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

    public function updateProfile($id, $data) {
        if($this->access_token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->access_token
            ])->put(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id, $data);
            return $response->ok();
        }
        return false;
    }
}
