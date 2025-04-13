<?php 


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller; 
use App\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('read Dashboard');
        $menus = Menu::orderBy('order')->get();
        return view('pages.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        $this->authorize("read {$menu->name}");
        return view('pages.show', compact('menu'));
    }
}
