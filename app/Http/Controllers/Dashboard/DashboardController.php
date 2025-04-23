<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Accurate\HelperController;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('read Dashboard');

        $helper = new HelperController();

        $isTokenExist = $helper->isAccessTokenExist();

        if ($isTokenExist == false) { // jika belum pernah generate access token sama sekali
            $helper->ouath2Authorization('sales_invoice_view sales_invoice_view', '/dashboard');
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
