<?php

namespace App\Http\Controllers\Accurate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    function authorization(Request $request)
    {
        $code = $request->query('code');
        $route = $request->query('route');

        if (empty($code)) {
            echo 'code is failed to catch';
            die();
        }

        if (!empty($route)) {
            return redirect()->to($route);
        }

        echo '<h3>' . $code . '</h3>';
        die();
    }
}
