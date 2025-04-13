<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller; 

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $this->authorize('read Report');
        return view('pages.report.index'); 
    }
}
