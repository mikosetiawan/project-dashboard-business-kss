<?php

namespace App\Http\Controllers\Accurate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    function authorization(Request $request): void
    {
        $code = $request->query('code');

        if (empty($code)) {
            echo 'code is failed to catch';
            die();
        }

        echo '<h3>' . $code . '</h3>';
        die();
    }
}
