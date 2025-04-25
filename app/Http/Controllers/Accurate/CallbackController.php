<?php

namespace App\Http\Controllers\Accurate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccurateHelperService;
use Illuminate\Http\RedirectResponse;

class CallbackController extends Controller
{
    function authorization(Request $request): RedirectResponse
    {
        $code = $request->query('code');
        $error = $request->query('error');

        if (!empty($error)) {
            echo '<pre>';
            print_r('error getting auth code:' . $error);
            die();
        }

        $helper = new AccurateHelperService();

        $getAccessToken = $helper->getAccessToken($code, null);

        if (isset($getAccessToken['error'])) {
            echo '<h2>' . $getAccessToken['error'] . '</h2>';
            die();
        }

        return redirect()->to('/dashboard');

        // echo '<pre>';
        // print_r($getAccessToken);
        // die();
    }
}
