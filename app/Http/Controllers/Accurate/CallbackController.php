<?php

namespace App\Http\Controllers\Accurate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccurateHelperService;

class CallbackController extends Controller
{
    function authorization(Request $request)
    {
        $code = $request->query('code');
        $route = $request->query('route');
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

        if (!empty($route)) {
            return redirect()->to($route);
        }

        echo '<h3>' . $code . '</h3>';
        die();
    }
}
