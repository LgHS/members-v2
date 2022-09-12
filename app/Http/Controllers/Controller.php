<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

        unset($data['id']);
        unset($data['createdTimestamp']);
        unset($data['username']);
        unset($data['enabled']);
        unset($data['totp']);
        unset($data['emailVerified']);
        unset($data['email']);
        unset($data['disableableCredentialTypes']);
        unset($data['requiredActions']);
        unset($data['notBefore']);
        unset($data['access']);

        if($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->put(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users/'.$id, $data);
            return $response->ok();
        }
        return false;
    }

    protected function getRoles() {
        $token = $this->getToken();
        if($token) {
            $data = [];
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/roles');
            $roles = $response->ok() ? (object)$response->json() : [];


            foreach($roles as $role) {
                if(!in_array($role['name'], ['default-roles-lghs', 'uma_authorization', 'offline_access'])) {
                    $data[] = $role['name'] ?? '';
                }
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/clients');
            $clients = $response->ok() ? (object)$response->json() : [];
            foreach($clients as $client) {
                $clientid = $client['id'];
                $resource = $client['clientId'];
                if(!in_array($resource, ['account', 'sign-in-v2', 'realm-management'])) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer '.$token
                    ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/clients/'.$clientid.'/roles');
                    $roles = $response->ok() ? (object)$response->json() : [];

                    foreach($roles as $role) {
                        $data[] = $resource.'/'.$role['name'] ?? '';
                    }
                }

            }
            return $data;
        }
        return [];
    }



    protected function getUsersByRoles($role) {
        $token = $this->getToken();
        if($token) {
            $members = [];

            $realms = [env('KEYCLOAK_REALM', 'master'), 'D54'];

            foreach($realms as $realm) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer '.$token
                ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.$realm.'/roles/'.$role.'/groups');
                $roleGroups = $response->ok() ? $response->json() : [];
    
    
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer '.$token
                ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.$realm.'/roles/'.$role.'/users');
                $roleUsers = $response->ok() ? $response->json() : [];
    
    
                foreach($roleUsers as $user) {
                    if(isset($user['attributes']['cardId']) && count($user['attributes']['cardId']) > 0) {
                        $members[] = reset($user['attributes']['cardId']);
                    }
                }
    
                foreach($roleGroups as $role) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer '.$token
                    ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.$realm.'/groups/'.$role['id'].'/members');
                    $groupUsers = $response->ok() ? (object)$response->json() : null;
                    foreach($groupUsers as $user) {
                        if(isset($user['attributes']['cardId']) && count($user['attributes']['cardId']) > 0) {
                            $members[] = reset($user['attributes']['cardId']);
                        }
                    }
                }
            }
            
            return array_unique($members);
        }
        return [];
    }
}
