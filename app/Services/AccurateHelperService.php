<?php

namespace App\Services;

use App\Models\AccurateToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AccurateHelperService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    function ouath2Authorization(string $scope, ?string $route)
    {
        $urlAuth = env('ACCURATE_AUTH_URL');
        $clientId = env('ACCURATE_CLIENT_ID');
        $responseType = env('ACCURATE_RESPONSE_TYPE');
        $redirectUri = env('ACCURATE_CALLBACK_URI');

        return redirect()->away($urlAuth . '?client_id=' . $clientId . '&response_type=' . $responseType . '&redirect_uri=' . $redirectUri . '&scope=' . $scope . '&route=' . $route);
    }

    function getAccessToken(string $authorizationCode, ?string $refreshToken)
    {
        $clientId = env('ACCURATE_CLIENT_ID');
        $clientSecret = env('ACCURATE_CLIENT_SECRET');

        $sign = 'Basic ' . $clientId . ':' . $clientSecret;

        $urlToken = env('ACCURATE_ACCESS_TOKEN_URL');

        if (empty($refreshToken)) { // jika bukan get refresh token
            $accessToken = Http::withHeaders([
                'Authorization' => $sign
            ])->post($urlToken, [
                'code' => $authorizationCode,
                'grant_type' => 'authorization_code',
                'redirect_uri' => env('ACCURATE_CALLBACK_URI')
            ]);
        } else { // jika get refresh token
            $accessToken = Http::withHeaders([
                'Authorization' => $sign
            ])->post($urlToken, [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken
            ]);
        }

        if ($accessToken->successful()) {
            $response = $accessToken->json();

            $saveToken = $this->saveToken($response);

            if (isset($saveToken['error'])) {
                return false;
            }

            return $saveToken;
        } else {
            return ['error' => $accessToken->body()];
        }
    }

    function saveToken(array $responseToken)
    {
        $userSession = $responseToken['user']['email'];

        $accurateToken = AccurateToken::where('access_token', $responseToken['access_token'])
            ->where('user_request', $userSession)
            ->first();

        if (empty($accurateToken)) { // kalo usernya baru generate token

            $crateToken = $this->createToken($responseToken);
            if ($crateToken == false) {
                return ['error' => 'error when create new token'];
            }

            return $responseToken;
        }

        // kalo access token nya ada dan belum expired
        if ($accurateToken->expired_at > time()) {
            unset($accurateToken->id);
            return $accurateToken;
        } else { // kalo access token nya ada tapi expired
            $crateToken = $this->createToken($responseToken);
            if ($crateToken == false) {
                return ['error' => 'error when create new token'];
            }

            return $responseToken;
        }
    }

    function createToken($responseToken): bool
    {
        DB::beginTransaction();

        $userSession = $responseToken['user']['email'];

        $expired = Carbon::createFromTimestamp(time())->addDays(14)->timestamp;
        $accessToken = new AccurateToken();
        $accessToken->access_token = $responseToken['access_token'];
        $accessToken->refresh_token = $responseToken['refresh_token'];
        $accessToken->scopes = $responseToken['scope'];
        $accessToken->expired_at = $expired;
        $accessToken->user_request = $userSession;

        $saveToken = $accessToken->save();

        if ($saveToken == false) {
            DB::rollBack();

            return false;
        }

        DB::commit();

        return true;
    }

    function isAccessTokenExist()
    {
        $user = Auth::user();
        $user = $user->email;
        $getAccessToken = AccurateToken::where('user_request', $user)->first();

        if (empty($getAccessToken)) {
            return false;
        }

        return true;
    }
}
