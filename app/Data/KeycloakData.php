<?php

namespace App\Data;

use Illuminate\Support\Facades\Http;

class KeycloakData {
    public function getUsers() {
        $token = $this->getToken();
        if($token) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get(env('KEYCLOAK_BASE_URL', '').'/admin/realms/'.env('KEYCLOAK_REALM', 'master').'/users');
            return $response->ok() ? (object)$response->json() : null;
        }
        return false;
    }

    protected function getToken() {
        $response = Http::asForm()->post(env('KEYCLOAK_BASE_URL', '').'/realms/master/protocol/openid-connect/token', [
            "grant_type" => "client_credentials",
            "client_id" => "admin-cli",
            "client_secret" => env('KEYCLOAK_ADMINCLI_SECRET', '')
        ]);
        return $response->ok() && isset($response->json()['access_token']) ? $response->json()['access_token'] : null;
    }
}
