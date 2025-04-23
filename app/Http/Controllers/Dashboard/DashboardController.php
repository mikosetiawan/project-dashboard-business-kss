<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\AccurateHelperService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('read Dashboard');

        $helper = new AccurateHelperService();

        $isTokenExist = $helper->isAccessTokenExist();

        if ($isTokenExist == false) { // jika belum pernah generate access token sama sekali
            return $helper->ouath2Authorization('sales_invoice_view sales_invoice_view', '/dashboard');
        }

        $menus = Menu::orderBy('order')->get();
        return view('pages.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        $this->authorize("read {$menu->name}");
        return view('pages.show', compact('menu'));
    }
}
